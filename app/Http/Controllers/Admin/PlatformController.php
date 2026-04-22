<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    public function index(Request $request)
    {
        // Handle reorder action (for drag-and-drop)
        if ($request->isMethod('put') && $request->has('action') && $request->input('action') === 'reorder') {
            return $this->handleReorder($request);
        }

        // Handle bulk operations
        if ($request->has('bulk_action') && $request->has('platform_ids')) {
            return $this->handleBulkAction($request);
        }

        // Build query with search and filters
        $query = Platform::where('domain', $request->getHost())->withCount('categories');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        // Sort by position first, then by created_at
        $sortBy = $request->get('sort_by', 'position');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);

        $platforms = $query->get();

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => $platforms
            ]);
        }

        return view('admin.platform.index', compact('platforms'));
    }

    /**
     * Handle reorder/drag-and-drop action
     */
    private function handleReorder(Request $request)
    {
        try {
            $validated = $request->validate([
                'platforms' => 'required|array',
                'platforms.*.id' => 'required|exists:platforms,id',
                'platforms.*.position' => 'required|integer|min:0'
            ]);

            foreach ($validated['platforms'] as $platformData) {
                Platform::where('id', $platformData['id'])
                    ->update(['position' => $platformData['position']]);
            }

            return response()->json([
                'success' => 'Update Successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Reorder failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật vị trí'
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $platforms = Platform::where('status',1)->where('domain',getDomain())->get();
        return view('adminpanel.platform.create',compact('platforms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'image' => 'nullable|string|max:500',
                'position' => 'nullable|integer|min:0'
            ]);

            // Validate image format if provided
            if (!empty($validated['image'])) {
                $image = trim($validated['image']);
                $isFontAwesome = preg_match('/^(fa[sbrld]?\s+)?fa-/', $image);
                $isUrl = filter_var($image, FILTER_VALIDATE_URL);
                
                if (!$isFontAwesome && !$isUrl) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Biểu tượng phải là Font Awesome class hoặc URL hình ảnh hợp lệ'
                    ], 422);
                }
            }

            $validated['status'] = $request->boolean('status', true);
            $validated['domain'] = $request->getHost();
            $validated['position'] = $validated['position'] ?? (Platform::max('position') ?? 0) + 1;

            $platform = Platform::create($validated);

            return response()->json([
                'success' => true,
                'platform' => $platform,
                'message' => 'Nền tảng đã được tạo thành công!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Platform creation failed', ['error' => $e->getMessage()]);
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tạo nền tảng: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Platform $platform)
    {
        $platform->loadCount('categories');
        
        return $request->expectsJson() || $request->ajax()
            ? response()->json(['success' => true, 'platform' => $platform])
            : view('admin.platform.show', compact('platform'));
    }

    /**
     * Show platform details in modal format
     */
    
    public function edit(Request $request, Platform $platform)
    {
        return view('admin.platform.edit', compact('platform'));
    }

    /**
     * Update the specified resource in storage.
     * Handles status toggle, quick updates, bulk operations, and form updates
     */
    public function update(Request $request, Platform $platform = null)
    {
        
        // Handle bulk operations
        if ($request->has('bulk_action') && $request->has('platform_ids')) {
            return $this->handleBulkAction($request);
        }

        // Handle status toggle (from status-switch component)
        if ($request->has('toggle_status')) {
            if (!$platform) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy nền tảng!'], 404);
            }

            $status = (bool) $request->input('status', 1);
            $entityId = $request->input('entity_id', $platform->id);
            
            if ($platform->status !== $status) {
                $platform->update(['status' => $status]);
                
                \Log::info('Platform status toggled', [
                    'platform_id' => $platform->id,
                    'entity_id' => $entityId,
                    'old_status' => !$status,
                    'new_status' => $status
                ]);
            }

            return response()->json([
                'success' => true,
                'status' => $status,
                'entity_id' => $entityId,
                'platform' => $platform->fresh()
            ]);
        }

        // Handle quick field update (from quick-edit component)
        if ($request->has('field')) {
            if (!$platform) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy nền tảng!'], 404);
            }

            $field = $request->input('field');
            $value = $request->input('value');

            // Define allowed fields for quick update
            $allowedFields = [
                'status' => 'boolean',
                'name' => 'string|max:255',
                'position' => 'integer|min:0'
            ];

            if (!array_key_exists($field, $allowedFields)) {
                return response()->json(['success' => false, 'message' => 'Trường không được phép cập nhật!'], 400);
            }

            $oldValue = $platform->{$field};
            
            try {
                // Validate field-specific rules
                switch ($field) {
                    case 'status':
                        $value = (bool) $value;
                        break;
                    case 'position':
                        $value = (int) $value;
                        if ($value < 0) {
                            throw new \InvalidArgumentException('Vị trí không được âm!');
                        }
                        break;
                }

                if ($oldValue != $value) {
                    $platform->update([$field => $value]);
                    
                    \Log::info('Platform field updated', [
                        'platform_id' => $platform->id,
                        'field' => $field,
                        'old_value' => $oldValue,
                        'new_value' => $value
                    ]);
                    
                    $message = 'Cập nhật thành công!';
                } else {
                    $message = 'Giá trị không thay đổi!';
                }

                return response()->json([
                    'success' => true,
                    'message' => $message,
                    'field' => $field,
                    'old_value' => $oldValue,
                    'new_value' => $value,
                    'platform' => $platform->fresh()
                ]);

            } catch (\InvalidArgumentException $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
            } catch (\Exception $e) {
                \Log::error('Quick update failed', [
                    'platform_id' => $platform->id,
                    'field' => $field,
                    'value' => $value,
                    'error' => $e->getMessage()
                ]);
                
                return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật!'], 500);
            }
        }

        // Handle regular form update
        if (!$platform) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy nền tảng!'], 404);
        }

        try {
            $validated = $request->validate([
                'name' => 'sometimes|required|string|max:255',
                'image' => 'sometimes|nullable|string|max:500',
                'position' => 'sometimes|nullable|integer|min:0'
            ]);

            // Validate image format if provided
            if (!empty($validated['image'])) {
                $image = trim($validated['image']);
                $isFontAwesome = preg_match('/^(fa[sbrld]?\s+)?fa-/', $image);
                $isUrl = filter_var($image, FILTER_VALIDATE_URL);
                
                if (!$isFontAwesome && !$isUrl) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Biểu tượng phải là Font Awesome class hoặc URL hình ảnh hợp lệ'
                    ], 422);
                }
            }

            // Handle status separately to avoid validation conflict
            $validated['status'] = $request->boolean('status', true);

            // Prepare data for update - only include changed fields
            $updateData = [];
            $originalPlatform = $platform->getOriginal();

            foreach ($validated as $field => $value) {
                if ($originalPlatform[$field] != $value) {
                    $updateData[$field] = $value;
                }
            }

            if (!empty($updateData)) {
                $platform->update($updateData);
                
                \Log::info('Platform updated', [
                    'platform_id' => $platform->id,
                    'updated_fields' => array_keys($updateData),
                    'changes' => $updateData
                ]);
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'platform' => $platform->fresh(),
                    'updated_fields' => array_keys($updateData ?? []),
                    'message' => 'Update Successfully'
                ]);
            }

            return redirect()->route('admin.platform.index')->with('success', 'Nền tảng đã được cập nhật thành công!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Platform update failed', [
                'platform_id' => $platform->id,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật nền tảng: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * Handles single and bulk delete
     */
    public function destroy(Request $request, Platform $platform = null)
    {
        if ($request->has('bulk_action')) {
            return $this->handleBulkAction($request);
        }

        if (!$platform) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy nền tảng!'], 404);
        }

        $platform->delete();

        return $request->expectsJson()
            ? response()->json(['success' => true])
            : redirect()->route('admin.platform.index')->with('success', 'Nền tảng đã được xóa thành công!');
    }

    /**
     * Handle bulk actions (private method)
     */
    private function handleBulkAction(Request $request)
    {
        $validated = $request->validate([
            'platform_ids' => 'required|array',
            'platform_ids.*' => 'exists:platforms,id',
            'bulk_action' => 'required|string|in:activate,deactivate,delete',
            'bulk_data' => 'sometimes|array'
        ]);

        $platformIds = $validated['platform_ids'];
        $action = $validated['bulk_action'];

        try {
            $updatedCount = 0;

            switch ($action) {
                case 'activate':
                    $updatedCount = Platform::whereIn('id', $platformIds)->update(['status' => true]);
                    break;

                case 'deactivate':
                    $updatedCount = Platform::whereIn('id', $platformIds)->update(['status' => false]);
                    break;

                case 'delete':
                    $updatedCount = Platform::whereIn('id', $platformIds)->delete();
                    break;

                default:
                    throw new \Exception('Hành động không hợp lệ');
            }

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'updated_count' => $updatedCount
                ]);
            }

            return redirect()->route('admin.platform.index')->with('success', 'Hành động đã hoàn thành!');

        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            return redirect()->route('admin.platform.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Toggle platform status
     */
    public function toggleStatus(Request $request, Platform $platform)
    {
        try {
            $newStatus = $request->input('status', !$platform->status);
            $newStatus = is_string($newStatus) ? filter_var($newStatus, FILTER_VALIDATE_BOOLEAN) : (bool) $newStatus;
            
            $platform->update(['status' => $newStatus]);
            
            return response()->json([
                'success' => true,
                'status' => $newStatus ? 1 : 0,
                'platform' => $platform->fresh()
            ]);
        } catch (\Exception $e) {
            \Log::error('Platform status toggle failed', [
                'platform_id' => $platform->id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật trạng thái'
            ], 500);
        }
    }
}