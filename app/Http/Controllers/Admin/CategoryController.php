<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Platform;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Process name field - return array instead of JSON string
     * Let the mutator handle JSON encoding
     */
    private function processNameField(array $nameData): array
    {
        // Sanitize and ensure English name exists
        $nameData = array_map(function ($name) {
            return trim(strip_tags($name));
        }, $nameData);

        if (empty($nameData['en'])) {
            throw new \InvalidArgumentException('English name is required');
        }

        // Remove empty values
        $nameData = array_filter($nameData, function ($name) {
            return !empty($name);
        });

        return $nameData;  // Return array, not JSON string
    }

    /**
     * Display a listing of the resource.
     * Handles search, filter, bulk operations, and drag-and-drop reordering
     */
    public function index(Request $request)
    {
        // Handle reorder action (drag-and-drop)
        if ($request->isMethod('put') && $request->has('action') && $request->input('action') === 'reorder') {
            return $this->handleReorder($request);
        }

        // Handle bulk operations
        if ($request->has('bulk_action') && $request->has('category_ids')) {
            return $this->handleBulkAction($request);
        }

        // Build query for platforms with eager loading and count to avoid N+1
        $platformQuery = Platform::where('domain', getDomain())
            ->withCount('categories');

        // Filter platforms by status if needed
        if ($request->filled('platform_status')) {
            $platformQuery->where('status', $request->boolean('platform_status'));
        } else {
            // Default: only show active platforms for display
            $platformQuery->where('status', 1);
        }

        // Search platforms if needed
        if ($request->filled('platform_search')) {
            $platformSearch = $request->platform_search;
            $platformQuery->where('name', 'like', "%{$platformSearch}%");
        }

        // Sort platforms by position first, then by created_at for stability
        $platformSortBy = $request->get('platform_sort_by', 'position');
        $platformSortOrder = $request->get('platform_sort_order', 'asc');
        $platformQuery->orderBy($platformSortBy, $platformSortOrder);
        if ($platformSortBy !== 'created_at') {
            $platformQuery->orderBy('created_at', 'desc');
        }

        $platforms = $platformQuery->get();

        // Build query for categories with eager loading and count to avoid N+1
        $categoryQuery = Category::query()
            ->with('platform')
            ->withCount('services') // Add this so $category->services_count is always available
            ->where('domain', getDomain());

        // Search functionality - use JSON_SEARCH to find in ANY language
        if ($request->filled('search')) {
            $search = "%{$request->search}%";
            $categoryQuery->whereRaw("JSON_SEARCH(name, 'one', ?) IS NOT NULL", [$search]);
        }

        // Filter by platform
        if ($request->filled('platform_id')) {
            $categoryQuery->where('platform_id', $request->platform_id);
        }

        // Filter by status (use boolean for safety)
        if ($request->filled('status')) {
            $categoryQuery->where('status', $request->boolean('status'));
        }

        // Sort categories: prioritize position, fallback to created_at for stability
        $categorySortBy = $request->get('sort_by', 'position');
        $categorySortOrder = $request->get('sort_order', 'asc');
        $categoryQuery->orderBy($categorySortBy, $categorySortOrder);
        if ($categorySortBy !== 'created_at') {
            $categoryQuery->orderBy('created_at', 'desc'); // fallback for stable sort
        }

        // Get data (use get() because drag-drop needs all data)
        $categories = $categoryQuery->get();

        // Group categories by platform_id for efficient processing
        $categoriesByPlatform = $categories->groupBy('platform_id');

        // Prepare display data (plat_cat) - maintain platform position order
        $plat_cat = $platforms->map(function ($platform) use ($categoriesByPlatform) {
            $image = $platform->image ?? 'fa-solid fa-star';
            $platformCategories = $categoriesByPlatform->get($platform->id, collect());

            // Sort categories within platform by position
            $sortedCategories = $platformCategories->sortBy('position')->values();

            return [
                'id' => $platform->id,
                'name' => $platform->name ?? 'Unknown Platform',
                'image' => $image,
                'position' => $platform->position ?? 0,
                'categories' => $sortedCategories,
                'category_count' => $sortedCategories->count(),
                'is_image_icon' => filter_var($image, FILTER_VALIDATE_URL) ? true : false,
                'status' => $platform->status ?? 1,
                'created_at' => $platform->created_at,
                'updated_at' => $platform->updated_at,
            ];
        })->sortBy('position')->values(); // Ensure platforms are sorted by position

        // Return JSON for AJAX requests
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'categories' => $categories,
                    'platforms' => $platforms,
                    'plat_cat' => $plat_cat,
                    'grouped' => $categoriesByPlatform,
                ],
                'meta' => [
                    'total_platforms' => $platforms->count(),
                    'total_categories' => $categories->count(),
                    'active_platforms' => $platforms->where('status', 1)->count(),
                    'active_categories' => $categories->where('status', 1)->count(),
                ]
            ]);
        }
$languages = \App\Models\Language::where('status', true)->where('code', '!=', 'en')->where('domain', getDomain())->orderBy('code')->get();
        // Pass data to view
        return view('adminpanel.category.index', compact(
            'plat_cat',      // Main data structure for display
            'platforms',     // All platforms (for modals, selects, etc.)
            'categories',     // All categories (if view needs direct access)
            'languages'     
        ))->with('plat', $platforms); // Add backward compatibility for $plat variable
    }

    /**
     * Handle reorder/drag-and-drop action for both platforms and categories
     */
    private function handleReorder(Request $request)
    {
        try {
            // Handle platform reordering
            if ($request->has('platforms')) {
                $validated = $request->validate([
                    'platforms' => 'required|array',
                    'platforms.*.id' => 'required|exists:platforms,id',
                    'platforms.*.position' => 'required|integer|min:0'
                ]);

                foreach ($validated['platforms'] as $platformData) {
                    Platform::where('id', $platformData['id'])
                        ->where('domain', getDomain()) // Security: ensure domain match
                        ->update(['position' => $platformData['position']]);
                }

                \Log::info('Platform positions updated', [
                    'platforms' => $validated['platforms'],
                    'domain' => getDomain()
                ]);

                return response()->json([
                    'success' => 'Update Successfully'
                ]);
            }

            // Handle category reordering
            if ($request->has('categories')) {
                $validated = $request->validate([
                    'categories' => 'required|array',
                    'categories.*.id' => 'required|exists:categories,id',
                    'categories.*.position' => 'required|integer|min:0'
                ]);

                foreach ($validated['categories'] as $categoryData) {
                    Category::where('id', $categoryData['id'])
                        ->where('domain', getDomain()) // Security: ensure domain match
                        ->update(['position' => $categoryData['position']]);
                }

                \Log::info('Category positions updated', [
                    'categories' => $validated['categories'],
                    'domain' => getDomain()
                ]);

                return response()->json([
                    'success' => 'Update Successfully'
                ]);
            }

            // If neither platforms nor categories are provided
            return response()->json([
                'success' => false,
                'message' => 'Không có dữ liệu để cập nhật vị trí'
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Reorder validation failed', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Reorder failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật vị trí: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $languages = \App\Models\Language::where('status', true)->where('code', '!=', 'en')->where('domain', getDomain())->orderBy('code')->get();
        $plat = Platform::where('domain', getDomain())->where('status', 1)->orderBy('position', 'asc')->get();
        return view('adminpanel.category.create', compact('plat', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform_id' => 'required|exists:platforms,id',
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.*' => 'nullable|string|max:255',
            'display' => 'nullable|in:0,1',
            'status' => 'nullable|boolean'
        ]);

        try {
            // Process name field to ensure it's properly formatted
            if (isset($validated['name'])) {
                $validated['name'] = $this->processNameField($validated['name']);
            }

            $validated['status'] = $request->boolean('status', true);
            $validated['domain'] = getDomain();
            $validated['display'] = $validated['display'] ?? 0;
            $validated['position'] = Category::where('platform_id', $validated['platform_id'])
                ->where('domain', getDomain())
                ->max('position') ?? 0;
            $validated['position']++;

            // Get platform image and set it as category image if not provided
            $platform = Platform::find($validated['platform_id']);
            if ($platform && $platform->image) {
                $validated['image'] = $platform->image;
            }

            $category = Category::create($validated);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Danh mục đã được tạo thành công!',
                    'category' => $category
                ]);
            }

            return redirect()->route('admin.category.index')->with('success', 'Danh mục đã được tạo thành công!');
        } catch (\InvalidArgumentException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage()
                ], 422);
            }

            return redirect()->back()->withErrors(['name' => $e->getMessage()]);
        } catch (\Exception $e) {
            \Log::error('Category creation failed', [
                'error' => $e->getMessage(),
                'data' => $validated ?? []
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Có lỗi xảy ra khi tạo danh mục'
                ], 500);
            }

            return redirect()->back()->with('error', 'Có lỗi xảy ra khi tạo danh mục');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Category $category)
    {
        $category->load('platform');

        return $request->expectsJson() || $request->ajax()
            ? response()->json(['success' => true, 'category' => $category])
            : view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Category $category)
    {
        $category->load('platform');
        $platforms = Platform::where('domain', getDomain())->get();
        
        // Get providers for the category's platform
        $providers = [];
        if ($category->platform_id) {
            $providers = \App\Models\Provider::where('platform_id', $category->platform_id)
                ->where('domain', getDomain())
                ->where('status', 1)
                ->orderBy('name', 'asc')
                ->get();
        }
        
        // Get languages for translations
        $languages = \App\Models\Language::where('status', true)
            ->where('code', '!=', 'en')
            ->where('domain', getDomain())
            ->orderBy('code')
            ->get();
        
        // Return JSON for AJAX requests
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'category' => $category,
                'platforms' => $platforms,
                'providers' => $providers,
                'languages' => $languages
            ]);
        }
        
        return view('adminpanel.category.edit', compact('category', 'platforms', 'providers', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     * Handles status toggle, quick updates, bulk operations, and form updates
     */
    public function update(Request $request, Category $category = null)
    {
        // Handle bulk operations
        if ($request->has('bulk_action') && $request->has('category_ids')) {
            return $this->handleBulkAction($request);
        }

        // Handle status toggle (from status-switch component)
        if ($request->has('toggle_status')) {
            if (!$category) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy danh mục!'], 404);
            }

            // Convert to boolean - handle both string and integer
            $statusValue = $request->input('status');
            if (is_string($statusValue)) {
                $status = filter_var($statusValue, FILTER_VALIDATE_BOOLEAN);
            } else {
                $status = (bool) $statusValue;
            }

            $entityId = $request->input('entity_id', $category->id);

            // Ensure entityId is not null or empty
            if (empty($entityId)) {
                $entityId = $category->id;
            }

            if ($category->status !== $status) {
                $category->update(['status' => $status]);

                \Log::info('Category status toggled', [
                    'category_id' => $category->id,
                    'entity_id' => $entityId,
                    'old_status' => !$status,
                    'new_status' => $status
                ]);

                $message = $status ? 'Danh mục đã được kích hoạt!' : 'Danh mục đã được vô hiệu hóa!';
            } else {
                $message = 'Trạng thái không thay đổi!';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $status,
                'entity_id' => $entityId,
                'category' => $category->fresh()
            ]);
        }

        // Handle quick field update (from quick-edit component)
        if ($request->has('field')) {
            if (!$category) {
                return response()->json(['success' => false, 'message' => 'Không tìm thấy danh mục!'], 404);
            }

            $field = $request->input('field');
            $value = $request->input('value');

            // Define allowed fields for quick update
            $allowedFields = [
                'status' => 'boolean',
                'position' => 'integer|min:0'
            ];

            if (!array_key_exists($field, $allowedFields)) {
                return response()->json(['success' => false, 'message' => 'Trường không được phép cập nhật!'], 400);
            }

            $oldValue = $category->{$field};

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
                    $category->update([$field => $value]);

                    \Log::info('Category field updated', [
                        'category_id' => $category->id,
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
                    'category' => $category->fresh()
                ]);
            } catch (\InvalidArgumentException $e) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 400);
            } catch (\Exception $e) {
                \Log::error('Quick update failed', [
                    'category_id' => $category->id,
                    'field' => $field,
                    'value' => $value,
                    'error' => $e->getMessage()
                ]);

                return response()->json(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật!'], 500);
            }
        }

        // Handle regular form update
        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy danh mục!'], 404);
        }

        $validated = $request->validate([
            'platform_id' => 'sometimes|required|exists:platforms,id',
            'name' => 'sometimes|required|array',
            'name.en' => 'sometimes|required|string|max:255',
            'name.*' => 'nullable|string|max:255',
            'image' => 'sometimes|nullable|string|max:500',
            'image_file' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'position' => 'sometimes|nullable|integer|min:0'
        ]);

        // Process name field to JSON
        if (isset($validated['name'])) {
            $validated['name'] = $this->processNameField($validated['name']);
        }

        // Handle image upload
        if ($request->hasFile('image_file')) {
            // Delete old image if exists
            if ($category->image && !filter_var($category->image, FILTER_VALIDATE_URL)) {
                \Storage::disk('public')->delete('categories/' . $category->image);
            }

            $image = $request->file('image_file');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('categories', $imageName, 'public');
            $validated['image'] = $imageName;
        }

        // Handle status separately
        if ($request->has('status')) {
            $validated['status'] = 1;
        } else {
            $validated['status'] = 0;
        }

        // Prepare data for update - only include changed fields
        $updateData = [];
        $originalCategory = $category->getOriginal();

        foreach ($validated as $field => $value) {
            if ($field === 'name') {
                // For JSON fields, compare as JSON
                if (json_encode($originalCategory[$field] ?? []) !== json_encode($value)) {
                    $updateData[$field] = $value;
                }
            } else {
                if (($originalCategory[$field] ?? null) != $value) {
                    $updateData[$field] = $value;
                }
            }
        }

        if (!empty($updateData)) {
            $category->update($updateData);

            \Log::info('Category updated', [
                'category_id' => $category->id,
                'updated_fields' => array_keys($updateData),
                'changes' => $updateData
            ]);

            $message = 'Danh mục đã được cập nhật thành công!';
        } else {
            $message = 'Không có thay đổi nào được thực hiện!';
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'category' => $category->fresh(),
                'updated_fields' => array_keys($updateData ?? []),
                'message' => 'Update Successfully'
            ]);
        }

        return redirect()->route('admin.category.index')->with('success', $message);
    }

    /**
     * Remove the specified resource from storage.
     * Handles single and bulk delete
     */
    public function destroy(Request $request, Category $category = null)
    {
        if ($request->has('bulk_action')) {
            return $this->handleBulkAction($request);
        }

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy danh mục!'], 404);
        }

        $category->delete();

        return $request->expectsJson()
            ? response()->json(['success' => true])
            : redirect()->route('admin.category.index')->with('success', 'Danh mục đã được xóa thành công!');
    }

    /**
     * Handle bulk actions (private method)
     */
    private function handleBulkAction(Request $request)
    {
        $validated = $request->validate([
            'category_ids' => 'required|array',
            'category_ids.*' => 'exists:categories,id',
            'bulk_action' => 'required|string|in:activate,deactivate,delete',
            'bulk_data' => 'sometimes|array'
        ]);

        $categoryIds = $validated['category_ids'];
        $action = $validated['bulk_action'];

        try {
            $updatedCount = 0;
            $processedIds = [];

            switch ($action) {
                case 'activate':
                    // Get categories that actually need to be updated (not already active)
                    $categoriesToUpdate = Category::whereIn('id', $categoryIds)->where('status', false)->pluck('id')->toArray();
                    if (!empty($categoriesToUpdate)) {
                        $updatedCount = Category::whereIn('id', $categoriesToUpdate)->update(['status' => true]);
                        $processedIds = $categoriesToUpdate;
                    }
                    break;

                case 'deactivate':
                    // Get categories that actually need to be updated (not already inactive)
                    $categoriesToUpdate = Category::whereIn('id', $categoryIds)->where('status', true)->pluck('id')->toArray();
                    if (!empty($categoriesToUpdate)) {
                        $updatedCount = Category::whereIn('id', $categoriesToUpdate)->update(['status' => false]);
                        $processedIds = $categoriesToUpdate;
                    }
                    break;

                case 'delete':
                    $processedIds = $categoryIds;  // All selected IDs will be deleted
                    $updatedCount = Category::whereIn('id', $categoryIds)->delete();
                    break;

                default:
                    throw new \Exception('Hành động không hợp lệ');
            }

            // Log the bulk action with detailed information
            \Log::info('Category bulk action completed', [
                'action' => $action,
                'requested_ids' => $categoryIds,
                'processed_ids' => $processedIds,
                'updated_count' => $updatedCount
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'updated_count' => $updatedCount,
                    'processed_ids' => $processedIds
                ]);
            }

            return redirect()->route('admin.category.index')->with('success', 'Hành động đã hoàn thành!');
        } catch (\Exception $e) {
            \Log::error('Category bulk action failed', [
                'action' => $action,
                'category_ids' => $categoryIds,
                'error' => $e->getMessage()
            ]);

            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }

            return redirect()->route('admin.category.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Toggle category status
     */
    public function toggleStatus(Request $request, Category $category)
    {
        try {
            $newStatus = $request->input('status', !$category->status);
            $newStatus = is_string($newStatus) ? filter_var($newStatus, FILTER_VALIDATE_BOOLEAN) : (bool) $newStatus;

            $category->update(['status' => $newStatus]);

            return response()->json([
                'success' => 'Update Successfully',
            ]);
        } catch (\Exception $e) {
            \Log::error('Category status toggle failed', [
                'category_id' => $category->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật trạng thái'
            ], 500);
        }
    }
}
