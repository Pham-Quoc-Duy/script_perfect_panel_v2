<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiProvider;
use App\Smm\Smm;
use Illuminate\Http\Request;

class ApiProviderController extends Controller
{
    public function index(Request $request)
    {
        // Handle reorder action (drag-and-drop)
        if ($request->isMethod('put') && $request->has('action') && $request->input('action') === 'reorder') {
            return $this->handleReorder($request);
        }

        $query = ApiProvider::where('domain', getDomain());

        if ($request->filled('type')) $query->where('type', $request->type);
        if ($request->filled('status')) $query->where('status', $request->boolean('status'));
        if ($request->filled('search')) $query->where('name', 'like', "%{$request->search}%");

        // Order by position by default (for drag-drop sorting), or by specified sort
        $sortBy = $request->get('sort_by', 'position');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder);
        
        // Fallback to created_at for stability if not sorting by position
        if ($sortBy !== 'created_at') {
            $query->orderBy('created_at', 'desc');
        }

        $providers = $request->expectsJson() 
            ? $query->get()
            : $query->paginate($request->get('per_page', 10));

        return $request->expectsJson()
            ? response()->json(['success' => true, 'data' => $providers])
            : view('adminpanel.provider.index', compact('providers'));
    }

    public function create()
    {
        return view('admin.provider.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:api_providers',
            'type' => 'required|string|max:100',
            'link' => 'nullable|url|max:500',
            'api_key' => 'required|string|max:500',
            'rate_api' => 'nullable|numeric|min:0',
            'balance' => 'nullable|numeric|min:0',
            'fixed_decimal' => 'nullable|string',
            'warning' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'note' => 'nullable|string',
            'format' => 'nullable|in:json,form',
            'timeout' => 'nullable|integer|min:0'
        ]);

        $validated['fixed_decimal'] = $validated['fixed_decimal'] ?? '4';
        $validated['status'] = $request->boolean('status', true);
        $validated['domain'] = getDomain();

        // Kiểm tra API và lấy balance
        if (!empty($validated['link']) && !empty($validated['api_key'])) {
            try {
                $result = $this->fetchBalance($validated['link'], $validated['api_key'], $validated['format'] ?? 'json', $validated['timeout'] ?? 0);
                
                if (!isset($result['balance'])) {
                    $error = $result['error'] ?? 'Không thể lấy số dư từ API';
                    if ($request->expectsJson() || $request->ajax()) {
                        return response()->json(['success' => false, 'message' => $error], 400);
                    }
                    return back()->withInput()->with('error', $error);
                }
                
                $validated['balance'] = $result['balance'];
                if (isset($result['currency'])) $validated['currency'] = $result['currency'];
                
            } catch (\Exception $e) {
                \Log::error('API failed', ['link' => $validated['link'], 'error' => $e->getMessage()]);
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Lỗi API: ' . $e->getMessage()], 400);
                }
                return back()->withInput()->with('error', $e->getMessage());
            }
        }

        $provider = ApiProvider::create($validated);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'data' => $provider]);
        }

        return redirect()->route('admin.provider.index');
    }

    public function show(Request $request, $id)
    {
        $provider = ApiProvider::where('domain', getDomain())->findOrFail($id);
        
        return $request->expectsJson() || $request->ajax()
            ? response()->json(['success' => true, 'data' => $provider])
            : view('admin.provider.show', compact('provider'));
    }

    public function update(Request $request, $id)
    {
        $provider = ApiProvider::where('domain', getDomain())->findOrFail($id);

        // Toggle status
        if ($request->has('toggle_status')) {
            $status = $request->boolean('status');
            $provider->update(['status' => $status]);
            $message = $status ? "Kích hoạt thành công!" : "Vô hiệu hóa thành công!";
            return response()->json(['success' => true, 'message' => $message, 'status' => $status]);
        }

        // Quick update
        if ($request->has('field')) {
            $field = $request->input('field');
            $value = $request->input('value');
            
            if (!in_array($field, ['status', 'balance', 'type'])) {
                return response()->json(['success' => false, 'message' => 'Trường không hợp lệ!'], 400);
            }
            
            $provider->update([$field => $value]);
            return response()->json(['success' => true, 'message' => 'Updated Success', 'provider' => $provider->fresh()]);
        }

        // Regular update
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255|unique:api_providers,name,' . $id,
            'type' => 'sometimes|string|max:100',
            'link' => 'nullable|url|max:500',
            'api_key' => 'nullable|string|max:500',
            'rate_api' => 'nullable|numeric|min:0',
            'balance' => 'nullable|numeric|min:0',
            'fixed_decimal' => 'nullable|string',
            'warning' => 'nullable|numeric|min:0',
            'currency' => 'nullable|string|max:10',
            'note' => 'nullable|string'
        ]);

        // Don't update api_key if it's empty
        if (empty($validated['api_key'])) {
            unset($validated['api_key']);
        }

        $validated['fixed_decimal'] = $validated['fixed_decimal'] ?? '4';
        if ($request->has('status')) $validated['status'] = $request->boolean('status');

        $provider->update($validated);
        $message = "API Provider <strong>{$provider->name}</strong> đã được cập nhật!";

        return response()->json(['success' => true, 'message' => $message, 'data' => $provider->fresh()]);
    }

    public function destroy(Request $request, $id)
    {
        $provider = ApiProvider::where('domain', getDomain())->findOrFail($id);
        $name = $provider->name;
        $provider->delete();
        
        return response()->json(['success' => true, 'message' => "Đã xóa {$name} thành công!"]);
    }

    public function getBalance(Request $request, $id)
    {
        $provider = ApiProvider::where('domain', getDomain())->findOrFail($id);
        
        if (!$provider->link || !$provider->api_key) {
            return response()->json(['success' => false, 'error' => 'Thiếu API URL hoặc API Key'], 400);
        }

        try {
            $result = $this->fetchBalance($provider->link, $provider->api_key, $provider->format ?? 'json', $provider->timeout ?? 0);
            
            if (isset($result['balance'])) {
                $provider->update([
                    'balance' => $result['balance'],
                    'currency' => $result['currency'] ?? $provider->currency
                ]);
                
                return response()->json([
                    'success' => true,
                    'balance' => $result['balance'],
                    'currency' => $result['currency'] ?? $provider->currency
                ]);
            }
            
            return response()->json(['success' => false, 'error' => $result['error'] ?? 'Lỗi không xác định'], 400);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => 'Lỗi API: ' . $e->getMessage()], 500);
        }
    }

    public function syncAllBalances(Request $request)
    {
        $providers = ApiProvider::where('domain', getDomain())
            ->where('status', true)
            ->whereNotNull('link')
            ->whereNotNull('api_key')
            ->get();
        
        $results = $providers->map(function ($provider) {
            try {
                $result = $this->fetchBalance($provider->link, $provider->api_key, $provider->format ?? 'json', $provider->timeout ?? 0);
                
                if (isset($result['balance'])) {
                    $provider->update([
                        'balance' => $result['balance'],
                        'currency' => $result['currency'] ?? $provider->currency
                    ]);
                    
                    return ['id' => $provider->id, 'success' => true, 'balance' => $result['balance'], 'currency' => $result['currency'] ?? $provider->currency];
                }
                
                return ['id' => $provider->id, 'success' => false, 'error' => $result['error'] ?? 'Lỗi không xác định'];
            } catch (\Exception $e) {
                return ['id' => $provider->id, 'success' => false, 'error' => $e->getMessage()];
            }
        });
        
        return response()->json(['success' => true, 'results' => $results]);
    }

    public function toggleStatus(Request $request, $id)
    {
        $provider = ApiProvider::where('domain', getDomain())->findOrFail($id);
        
        $newStatus = !$provider->status;
        $provider->update(['status' => $newStatus]);
        
        $message = $newStatus ? 'Kích hoạt thành công!' : 'Vô hiệu hóa thành công!';
        
        return response()->json([
            'success' => true,
            'message' => $message,
            'status' => $newStatus
        ]);
    }

    private function fetchBalance($api_url, $api_key, $format = 'json', $timeout = 0)
    {
        $smm = new Smm();
        $smm->api_url = $api_url;
        $smm->api_key = $api_key;
        $smm->format = $format;
        $smm->timeout = $timeout;
        
        $result = $smm->balance();
        
        // Convert object to array if needed
        if (is_object($result)) {
            $result = (array) $result;
        }
        
        return $result ?? [];
    }

    private function handleReorder(Request $request)
    {
        try {
            if ($request->has('providers')) {
                $validated = $request->validate([
                    'providers' => 'required|array',
                    'providers.*.id' => 'required|integer|exists:api_providers,id',
                    'providers.*.position' => 'required|integer|min:1'
                ]);

                foreach ($validated['providers'] as $providerData) {
                    $updated = ApiProvider::where('id', $providerData['id'])
                        ->where('domain', getDomain())
                        ->update(['position' => $providerData['position']]);
                    
                    if (!$updated) {
                        throw new \Exception("Provider ID {$providerData['id']} not found or unauthorized");
                    }
                }

                \Log::info('Provider positions updated', [
                    'providers' => $validated['providers'],
                    'domain' => getDomain(),
                    'count' => count($validated['providers'])
                ]);

                return response()->json([
                    'success' => 'Update Successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Không có dữ liệu để cập nhật vị trí'
            ], 400);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Reorder validation failed', [
                'errors' => $e->errors(),
                'request' => $request->all(),
                'domain' => getDomain()
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
                'request' => $request->all(),
                'domain' => getDomain()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật vị trí: ' . $e->getMessage()
            ], 500);
        }
    }
}
