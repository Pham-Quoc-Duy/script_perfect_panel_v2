<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Smm\Smm;
use App\Models\Service;
use App\Models\User;
use App\Models\ApiProvider;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request, $status = null)
    {
        // Handle bulk operations
        if ($request->has('bulk_action') && $request->has('order_ids')) {
            return $this->handleBulkAction($request);
        }

        // Build query with domain filter
        $query = Order::query()->with(['user', 'service.category.platform'])->where('domain', getDomain());

        // Handle status from URL path
        if ($status) {
            $request->merge(['status_from_url' => $status]);
            
            // Map URL status to filter logic
            switch ($status) {
                case 'manual':
                    $query->where('status', 'pending')
                          ->where(function($q) {
                              $q->whereNull('orders_api')
                                ->orWhere('orders_api', '');
                          });
                    break;
                case 'failed':
                    // Filter by 'failed' status directly
                    $query->where('status', 'failed');
                    break;
                case 'awaiting':
                    // Filter by 'awaiting' status directly
                    $query->where('status', 'awaiting');
                    break;
                case 'ticket':
                    // Filter orders that have ticket data
                    $query->whereNotNull('ticket')
                          ->where('ticket', '!=', '');
                    break;
                case 'pending':
                    $query->where('status', 'pending');
                    break;
                case 'processing':
                    $query->where('status', 'processing');
                    break;
                case 'inprogress':
                    $query->where('status', 'in_progress');
                    break;
                case 'completed':
                    $query->where('status', 'completed');
                    break;
                case 'partial':
                    $query->where('status', 'partial');
                    break;
                case 'canceled':
                    $query->where('status', 'canceled');
                    break;
            }
        }

        // Search by order ID - apply regardless of status
        if ($request->filled('order_id')) {
            $query->where('id', $request->order_id);
        }

        // Search by orders_api (API Order ID) - apply regardless of status
        if ($request->filled('orders_api')) {
            $query->where('orders_api', 'like', "%{$request->orders_api}%");
        }

        // Search by NCC order ID (provider order ID) - apply regardless of status
        if ($request->filled('ncc_order_id')) {
            $query->where('provider_id', $request->ncc_order_id);
        }

        // Search by link - exact match
        if ($request->filled('link')) {
            $query->where('link', $request->link);
        }

        // Search by username - apply regardless of status
        if ($request->filled('username')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('username', 'like', "%{$request->username}%");
            });
        }

        // Search by provider name - apply regardless of status
        if ($request->filled('provider_name')) {
            $query->where('provider_name', 'like', "%{$request->provider_name}%");
        }

        // Main status filter (only if not already filtered by URL status)
        if (!$status && $request->filled('main_status')) {
            switch ($request->main_status) {
                case 'manual':
                    $query->where('status', 'pending');
                    break;
                case 'failed':
                    $query->where('status', 'canceled');
                    break;
                case 'waiting':
                    $query->whereIn('status', ['pending', 'processing']);
                    break;
                case 'support':
                    $query->where('status', 'partial');
                    break;
            }
        }

        // Detailed status filter (only if not already filtered by URL status)
        if (!$status && $request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Service filter - apply regardless of status
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->service_id);
        }

        // User filter - apply regardless of status
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Provider filter - apply regardless of status
        if ($request->filled('provider_id')) {
            $providerId = $request->provider_id;
            
            switch ($providerId) {
                case 'manual':
                case 'Manual':
                    // Filter for manual orders (orders without provider or with specific manual provider)
                    $query->where(function($q) {
                        $q->whereNull('provider_name')
                          ->orWhere('provider_name', '')
                          ->orWhere('provider_name', 'manual');
                    });
                    break;
                case 'all_providers':
                case 'Api':
                    // Filter for orders that have a provider
                    $query->whereNotNull('provider_name')
                          ->where('provider_name', '!=', '')
                          ->where('provider_name', '!=', 'manual');
                    break;
                default:
                    // Filter by specific provider ID - match by provider name
                    $provider = ApiProvider::find($providerId);
                    if ($provider) {
                        $query->where('provider_name', $provider->name);
                    }
                    break;
            }
        }

        // Platform filter (through service->category relationship) - apply regardless of status
        if ($request->filled('platform_id')) {
            $query->whereHas('service.category', function($q) use ($request) {
                $q->where('platform_id', $request->platform_id);
            });
        }

        // Sorting
        switch ($request->get('sort')) {
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }

        // Date range filter - apply regardless of status
        if ($request->filled('date_from')) {
            $query->where('created_at', '>=', $request->date_from . ' 00:00:00');
        }
        
        if ($request->filled('date_to')) {
            $query->where('created_at', '<=', $request->date_to . ' 23:59:59');
        }

        // General search functionality (for backward compatibility)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('link', 'like', "%{$search}%")
                  ->orWhereHas('user', function($userQuery) use ($search) {
                      $userQuery->where('username', 'like', "%{$search}%")
                               ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Paginate results (15 items per page)
        $orders = $query->paginate(15);

        // Get data for dropdowns
        // Services: get id and name (only 'en' from JSON)
        $services = Service::select('id', 'name')
            ->where('status', true)
            ->orderBy('name->en')
            ->get()
            ->map(function($service) {
                // Extract 'en' value from JSON name field
                $nameData = is_array($service->name) ? $service->name : json_decode($service->name, true);
                $enName = is_array($nameData) ? ($nameData['en'] ?? 'N/A') : 'N/A';
                
                return [
                    'id' => $service->id,
                    'name' => $enName
                ];
            });
        
        $users = User::select('id', 'username')->orderBy('username')->get();
        $providers = ApiProvider::select('id', 'name')->where('status', true)->orderBy('name')->get();

        // Preserve search parameters for view
        $searchParams = [
            'order_id' => $request->input('order_id'),
            'orders_api' => $request->input('orders_api'),
            'ncc_order_id' => $request->input('ncc_order_id'),
            'link' => $request->input('link'),
            'username' => $request->input('username'),
            'provider_name' => $request->input('provider_name'),
            'service_id' => $request->input('service_id'),
            'user_id' => $request->input('user_id'),
            'provider_id' => $request->input('provider_id'),
            'platform_id' => $request->input('platform_id'),
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'main_status' => $request->input('main_status'),
            'status' => $request->input('status'),
            'search' => $request->input('search'),
            'sort' => $request->input('sort')
        ];

        // Count orders for badges
        $manualCount = Order::where('domain', getDomain())
            ->where('status', 'pending')
            ->where(function($q) {
                $q->whereNull('orders_api')
                  ->orWhere('orders_api', '');
            })
            ->count();

        $failedCount = Order::where('domain', getDomain())
            ->where('status', 'failed')
            ->count();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true, 
                'data' => $orders->items(),
                'pagination' => [
                    'total' => $orders->total(),
                    'per_page' => $orders->perPage(),
                    'current_page' => $orders->currentPage(),
                    'last_page' => $orders->lastPage(),
                    'from' => $orders->firstItem(),
                    'to' => $orders->lastItem()
                ]
            ]);
        }

        return view('adminpanel.orders.index', compact('orders', 'services', 'users', 'providers', 'status', 'searchParams', 'manualCount', 'failedCount'));
    }

    public function show(Request $request, $id)
    {
        $order = Order::with(['user', 'service'])->where('domain', getDomain())->findOrFail($id);

        return $request->expectsJson()
            ? response()->json(['success' => true, 'order' => $order])
            : view('adminpanel.orders.show', compact('order'));

        return view('adminpanel.orders.show', compact('order'));
    }

    public function update(Request $request, $id = null)
    {
        // Handle bulk operations
        if ($request->has('bulk_action') && $request->has('order_ids')) {
            return $this->handleBulkAction($request);
        }

        $order = Order::where('domain', getDomain())->findOrFail($id);

        // Handle status toggle (from status-switch component)
        if ($request->has('toggle_status')) {
            $status = $request->input('status');
            $entityId = $request->input('entity_id', $order->id);
            
            // Ensure entityId is not null or empty
            if (empty($entityId)) {
                $entityId = $order->id;
            }
            
            if ($order->status !== $status) {
                // If status is canceled, add charge to user's balance and set charge to 0
                if ($status === 'canceled' && $order->charge > 0) {
                    $user = User::find($order->user_id);
                    if ($user) {
                        $user->increment('balance', $order->charge);
                    }
                    $order->update(['status' => $status, 'charge' => 0]);
                } else {
                    $order->update(['status' => $status]);
                }
                $statusText = match($status) {
                    'awaiting' => 'Đang chờ',
                    'pending' => 'Chờ xử lý',
                    'processing' => 'Đang xử lý',
                    'in_progress' => 'Đang chạy',
                    'completed' => 'Hoàn thành',
                    'partial' => 'Hoàn tiền một phần',
                    'canceled' => 'Đã hủy',
                    'failed' => 'Thất bại',
                    default => 'Không xác định'
                };
                
                $message = "Cập nhật trạng thái đơn hàng ID #{$entityId} thành {$statusText} thành công!";
            } else {
                $message = "Trạng thái đơn hàng ID #{$entityId} không thay đổi!";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $status,
                'entity_id' => $entityId,
                'order' => $order->fresh()
            ]);
        }

        // Handle quick status change
        if ($request->has('quick_status')) {
            $status = $request->input('quick_status');
            
            // If status is canceled, add charge to user's balance and set charge to 0
            if ($status === 'canceled' && $order->charge > 0) {
                $user = User::find($order->user_id);
                if ($user) {
                    $user->increment('balance', $order->charge);
                }
                $order->update(['status' => $status, 'charge' => 0]);
            } else {
                $order->update(['status' => $status]);
            }
            
            $statusText = match($status) {
                'pending' => 'Chờ xử lý',
                'processing' => 'Đang xử lý',
                'in_progress' => 'Đang chạy',
                'completed' => 'Hoàn thành',
                'partial' => 'Hoàn tiền một phần',
                'canceled' => 'Hủy',
                default => 'Không xác định'
            };
            
            return response()->json([
                'success' => true,
                'message' => "Đã cập nhật trạng thái đơn hàng #{$order->id} thành {$statusText}",
                'order_id' => $order->id,
                'status' => $status
            ]);
        }

        // Handle add start count (replace, not add)
        if ($request->has('add_start_count')) {
            $startCount = $request->input('start_count', 0);
            
            $order->update(['start_count' => (int)$startCount]);
            
            return response()->json([
                'success' => true,
                'order_id' => $order->id,
            ]);
        }

        // Handle note update
        if ($request->has('note')) {
            $note = $request->input('note');
            
            $order->update(['note' => $note]);
            
            return response()->json([
                'success' => true,
                'order_id' => $order->id
            ]);
        }

        // Handle update orders_api (mã đơn hàng NCC)
        if ($request->has('orders_api')) {
            $ordersApi = $request->input('orders_api');
            $order->update([
                'orders_api' => $ordersApi,
                'status'     => 'pending',
            ]);
            
            return response()->json([
                'success' => true,
                'message' => "Đã cập nhật mã đơn hàng NCC: {$ordersApi}",
                'order_id' => $order->id,
                'orders_api' => $ordersApi
            ]);
        }

        // Handle ticket update (yêu cầu)
        if ($request->has('ticket')) {
            $ticket = strtolower(trim($request->input('ticket') ?? ''));
            
            // Map display names to database values
            $ticketMap = [
                'cancel' => 'canceled',
                'canceled' => 'canceled',
                'refill' => 'refill',
                'speedup' => 'speedup',
                '' => null
            ];
            
            if (!array_key_exists($ticket, $ticketMap)) {
                return response()->json(['success' => false, 'message' => 'Invalid ticket type'], 400);
            }
            
            $order->update(['ticket' => $ticketMap[$ticket]]);
            
            return response()->json(['success' => true]);
        }

        // Handle regular form update
        $validated = $request->validate([
            'status' => 'sometimes|required|in:pending,processing,in_progress,completed,partial,canceled',
            'start_count' => 'sometimes|nullable|integer|min:0',
            'remains' => 'sometimes|nullable|integer|min:0'
        ]);

        // Prepare data for update - only include changed fields
        $updateData = [];
        $originalOrder = $order->getOriginal();

        foreach ($validated as $field => $value) {
            if (($originalOrder[$field] ?? null) != $value) {
                $updateData[$field] = $value;
            }
        }

        if (!empty($updateData)) {
            $order->update($updateData);
        }

        return $request->expectsJson()
            ? response()->json(['success' => 'Update Successfully'])
            : redirect()->back()->with('success', 'Update Successfully');
    }

    public function destroy(Request $request, $id = null)
    {
        // Handle bulk delete
        if ($request->has('bulk_action') && $request->has('order_ids')) {
            return $this->handleBulkAction($request);
        }

        $order = Order::where('domain', getDomain())->findOrFail($id);
        $orderId = $order->id;
        $order->delete();
        $message = "Đã xóa đơn hàng ID #{$orderId} thành công!";

        return $request->expectsJson()
            ? response()->json(['success' => true, 'message' => $message])
            : redirect()->back()->with('success', $message);
    }

    public function updateOrderStatus(Request $request, $id)
    {
        try {
            $order = Order::where('domain', getDomain())->findOrFail($id);
            $status = $request->input('status');
            $remains = $request->input('remains');

            // Map display status to database status
            $statusMap = [
                'Chờ xử lý' => 'pending',
                'Đang xử lý' => 'processing',
                'Đang chạy' => 'in_progress',
                'In progress' => 'in_progress',
                'Hoàn thành' => 'completed',
                'Completed' => 'completed',
                'Hoàn tiền một phần' => 'partial',
                'Partial' => 'partial',
                'Hủy' => 'canceled',
                'Canceled' => 'canceled',
                'Đang chờ' => 'awaiting',
                'Awaiting' => 'awaiting',
                'Thất bại' => 'failed',
                'Failed' => 'failed'
            ];

            // Convert display status to database status if needed
            $dbStatus = $statusMap[$status] ?? $status;

            // Validate status
            $validStatuses = ['pending', 'processing', 'in_progress', 'completed', 'partial', 'canceled', 'awaiting', 'failed'];
            if (!in_array($dbStatus, $validStatuses)) {
                return response()->json(['success' => false], 400);
            }

            // Prepare update data
            $updateData = ['status' => $dbStatus];

            // Auto-update remains and charge based on status
            if ($dbStatus === 'completed') {
                // When status is completed, set remains to 0
                $updateData['remains'] = 0;
            } elseif (in_array($dbStatus, ['in_progress', 'processing'])) {
                // When status is in_progress or processing, set remains to quantity
                $updateData['remains'] = $order->quantity;
            } elseif ($dbStatus === 'partial' && $remains !== null) {
                // When status is partial and remains is provided
                $remainsValue = (int)$remains;
                $updateData['remains'] = $remainsValue;
                
                // Calculate charge_used: (remains / quantity) * total
                if ($order->quantity > 0 && $order->total > 0) {
                    $chargeUsed = ($remainsValue / $order->quantity) * $order->total;
                    $newCharge = $order->charge - $chargeUsed;
                    $updateData['charge'] = max(0, $newCharge); // Ensure charge doesn't go below 0
                    
                    // Add charge_used to user's balance
                    $user = User::find($order->user_id);
                    if ($user) {
                        $user->increment('balance', $chargeUsed);
                    }
                }
            } elseif ($dbStatus === 'canceled') {
                // When status is canceled, add charge to user's balance and set charge to 0
                if ($order->charge > 0) {
                    $user = User::find($order->user_id);
                    if ($user) {
                        $user->increment('balance', $order->charge);
                    }
                    $updateData['charge'] = 0;
                }
            }

            // Update order status and related fields
            $order->update($updateData);

            return response()->json(['success' => 'Update Successfully']);

        } catch (\Exception $e) {
            \Log::error('Error updating order status', [
                'order_id' => $id,
                'error' => $e->getMessage()
            ]);

            return response()->json(['success' => false], 500);
        }
    }

    public function resendOrder(Request $request, $id)
    {
        try {
            $order = Order::with('service')->where('domain', getDomain())->findOrFail($id);
            
            if (!in_array($order->status, ['failed'])) {
                return response()->json(['success' => false, 'message' => "Chỉ có thể gửi lại đơn hàng có trạng thái 'canceled' hoặc 'failed'"], 400);
            }

            if (empty($order->provider_id)) {
                return response()->json(['success' => false, 'message' => "Đơn hàng #{$order->id} không có provider_id"], 400);
            }

            $apiProvider = ApiProvider::findOrFail($order->provider_id);
            $service = $order->service ?? Service::findOrFail($order->service_id);

            $smm = new Smm();
            $smm->api_url = $apiProvider->link;
            $smm->api_key = $apiProvider->api_key;

            if (!empty($apiProvider->note)) {
                try {
                    $config = json_decode($apiProvider->note, true);
                    if (isset($config['headers']) && is_array($config['headers'])) {
                        $smm->headers = array_map(fn($k, $v) => "$k: $v", array_keys($config['headers']), $config['headers']);
                    }
                    if (isset($config['cookies'])) {
                        $smm->cookies = $config['cookies'];
                    }
                } catch (\Exception $e) {}
            }

            $response = json_decode(json_encode($smm->order([
                'link' => $order->link,
                'service' => $order->service_api,
                'quantity' => $order->quantity
            ])), true);

            if (isset($response['order'])) {
                $order->update([
                    'orders_api' => $response['order'],
                    'status' => 'pending',
                    'order_data' => json_encode($response),
                    'response_data' => json_encode($response)
                ]);

                return response()->json([
                    'success' => true,
                    'message' => "Resend Order Successfully",
                ]);
            }

            $order->update([
                'order_data' => json_encode(['error' => $response['error'] ?? '']),
                'response_data' => json_encode($response)
            ]);

            return response()->json([
                'success' => false,
                'message' => $response['error'] ?? '',
            ], 400);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateOrderStatusProvider(Request $request)
    {
        try {
            $orderId = $request->input('order_id');
            if (empty($orderId)) return response()->json(['success' => false, 'message' => 'Order ID is required'], 400);

            $order = Order::where('domain', getDomain())->where('id', $orderId)->with('service')->first();
            if (!$order) return response()->json(['success' => false, 'message' => 'Order not found'], 404);
            if (empty($order->provider_id) || empty($order->orders_api))
                return response()->json(['success' => false, 'message' => 'Order has no provider or orders_api'], 400);

            $apiProvider = ApiProvider::find($order->provider_id);
            if (!$apiProvider) return response()->json(['success' => false, 'message' => 'Provider not found'], 404);

            $smm = new Smm();
            $smm->api_url = $apiProvider->link;
            $smm->api_key = $apiProvider->api_key;

            $response = $smm->status($order->orders_api);
            $response = is_array($response) ? (object) $response : $response;

            // Provider returned error (no status) — still success:true so bulk continues
            if (!$response || !isset($response->status)) {
                $raw = $response->error ?? ($response ? json_encode($response, JSON_UNESCAPED_UNICODE) : 'No response from provider');
                // Strip redundant "Provider error: " prefix if present
                $msg = preg_replace('/^Provider error:\s*/i', '', $raw);
                return response()->json(['success' => true, 'message' => $msg, 'provider_error' => true]);
            }

            $statusMap = [
                'pending' => 'pending', 'Pending' => 'pending',
                'processing' => 'processing', 'Processing' => 'processing',
                'in progress' => 'in_progress', 'In progress' => 'in_progress', 'In Progress' => 'in_progress',
                'completed' => 'completed', 'Completed' => 'completed',
                'partial' => 'partial', 'Partial' => 'partial',
                'canceled' => 'canceled', 'Canceled' => 'canceled',
                'failed' => 'failed', 'Failed' => 'failed',
            ];

            $providerStatus = trim($response->status);
            $newStatus = $statusMap[$providerStatus] ?? null;

            if (!$newStatus) return response()->json(['success' => false, 'message' => 'Unknown status: ' . $providerStatus], 400);

            $updateData = ['status' => $newStatus];

            if ($newStatus === 'completed')                          $updateData['remains'] = 0;
            elseif (in_array($newStatus, ['in_progress', 'processing'])) $updateData['remains'] = $order->quantity;
            elseif ($newStatus === 'canceled' && $order->charge > 0) {
                User::find($order->user_id)?->increment('balance', $order->charge);
                $updateData['charge'] = 0;
            }

            if (isset($response->start_count))                      $updateData['start_count'] = $response->start_count;
            if (isset($response->remains) && $newStatus === 'partial') $updateData['remains']  = $response->remains;
            if (isset($response->charge))                            $updateData['charge']      = $response->charge;

            $order->update($updateData);

            return response()->json(['success' => true, 'message' => "Updated to $newStatus", 'status' => $newStatus, 'order' => $order->fresh()]);

        } catch (\Exception $e) {
            \Log::error('updateOrderStatusProvider', ['order_id' => $request->input('order_id'), 'error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
