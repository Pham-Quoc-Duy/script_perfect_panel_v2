<?php

namespace App\Http\Controllers\CronController;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ApiProvider;
use App\Smm\Smm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CronStatusController extends Controller
{
    public function updateOrdersStatus(Request $request)
    {
        $providerId = $request->query('provider');
        
        if (!$providerId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Provider ID is required'
            ], 400);
        }

        // Lấy thông tin ApiProvider
        $provider = ApiProvider::find($providerId);
        
        if (!$provider) {
            return response()->json([
                'status' => 'error',
                'message' => 'Provider not found'
            ], 404);
        }

        // Lấy tất cả orders có status khác completed, canceled, failed, partial
        $orders = Order::where('provider_id', $providerId)
            ->whereNotIn('status', ['completed', 'canceled', 'failed', 'partial'])
            ->whereNotNull('orders_api')
            ->where('orders_api', '!=', '')
            ->get();

        if ($orders->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No orders to update',
                'provider_id' => $providerId,
                'provider_name' => $provider->name
            ]);
        }

        // Khởi tạo Smm
        $smm = new Smm();
        $smm->api_url = $provider->link;
        $smm->api_key = $provider->api_key;

        // Lấy danh sách orders_api
        $ordersApi = $orders->pluck('orders_api')->toArray();
        
        $updated = 0;
        $errors = 0;
        $results = [];

        try {
            // Gọi multiStatus
            $response = $smm->multiStatus($ordersApi);
            
            if (isset($response->error)) {
                Log::error('Smm multiStatus error', [
                    'provider_id' => $providerId,
                    'error' => $response['error']
                ]);
                
                return response()->json([
                    'status' => 'error',
                    'message' => $response['error'],
                    'provider_id' => $providerId
                ], 500);
            }

            // Cập nhật từng order
            foreach ($orders as $order) {
                $orderApi = $order->orders_api;
                
                if (isset($response->$orderApi)) {
                    $statusData = (array) $response->$orderApi;
                    
                    try {
                        // Normalize status từ API (Completed -> completed, Pending -> pending)
                        $apiStatus = $statusData['status'] ?? $order->status;
                        $normalizedStatus = strtolower($apiStatus);
                        
                        // Cập nhật thông tin order
                        $order->status = $normalizedStatus;
                        $order->start_count = $statusData['start_count'] ?? $order->start_count;
                        $order->remains = $statusData['remains'] ?? $order->remains;
                        
                        // Xử lý hoàn balance khi status từ SMM là "Canceled"
                        if ($normalizedStatus === 'canceled') {
                            $remains = $statusData['remains'] ?? 0;
                            $quantity = $order->quantity ?? 0;
                            
                            // Kiểm tra nếu remains < quantity (tức là đã chạy được một phần)
                            if ($remains > 0 && $remains < $quantity) {
                                $charge = floatval($statusData['charge'] ?? 0);
                                
                                // Tính tiền hoàn lại: refund = charge * (remains / quantity)
                                $refundAmount = $charge * ($remains / $quantity);
                                
                                // Lấy user của order
                                $user = $order->user;
                                
                                if ($user) {
                                    // Cộng balance cho user
                                    $user->balance += $refundAmount;
                                    $user->save();
                                    
                                    // Cập nhật status order thành "partial"
                                    $order->status = 'partial';
                                    
                                    Log::info('Order refund processed', [
                                        'order_id' => $order->id,
                                        'user_id' => $user->id,
                                        'refund_amount' => $refundAmount,
                                        'remains' => $remains,
                                        'quantity' => $quantity,
                                        'charge' => $charge
                                    ]);
                                }
                            }
                        }
                        
                        // Lưu response_data - fix array_merge error
                        $existingData = is_array($order->response_data) ? $order->response_data : [];
                        $order->response_data = array_merge(
                            $existingData,
                            ['last_status_check' => now()->toDateTimeString(), 'status_response' => $statusData]
                        );
                        
                        $order->save();
                        $updated++;
                        
                        // Thêm tất cả orders vào results
                        $results[] = [
                            'orders_api' => $orderApi,
                            'status' => $order->status,
                            'start_count' => $order->start_count,
                            'remains' => $order->remains
                        ];
                    } catch (\Exception $e) {
                        $errors++;
                        
                        $results[] = [
                            'orders_api' => $orderApi,
                            'status' => 'error',
                            'message' => $e->getMessage()
                        ];
                        
                        Log::error('Error updating order', [
                            'order_id' => $order->id,
                            'error' => $e->getMessage()
                        ]);
                    }
                }
            }
            
            return response()->json([
                'status' => 'success',
                'message' => "Cron job status order completed"
            ]);
            
        } catch (\Exception $e) {
            Log::error('Cron status update failed', [
                'provider_id' => $providerId,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'provider_id' => $providerId
            ], 500);
        }
    }
    public function statusLoopOrders(Request $request)
    {
        // Lấy tất cả orders là loop (dripfeed=true), còn vòng lặp chưa hoàn thành
        // và là order gốc (loop_parent_id = null)
        $loopOrders = Order::where('dripfeed', true)
            ->whereNotNull('loop_quantity')
            ->whereNotNull('loop_spacing')
            ->whereRaw('loop_current < loop_quantity')
            ->whereNull('loop_parent_id')
            ->whereNotIn('status', ['canceled', 'failed'])
            ->get();

        if ($loopOrders->isEmpty()) {
            return response()->json(['status' => 'success', 'message' => 'No loop orders to process', 'processed' => 0]);
        }

        $processed = 0;
        $skipped = 0;
        $errors = 0;
        $results = [];

        foreach ($loopOrders as $parentOrder) {
            try {
                $lastOrder = Order::where(function ($q) use ($parentOrder) {
                    $q->where('id', $parentOrder->id)->orWhere('loop_parent_id', $parentOrder->id);
                })->orderByDesc('id')->first();

                if (!$lastOrder->isCompleted()) {
                    $skipped++;
                    $results[] = ['parent_order_id' => $parentOrder->id, 'last_order_id' => $lastOrder->id, 'skipped_reason' => 'Last order not completed (status: ' . $lastOrder->status . ')'];
                    continue;
                }

                if (!$parentOrder->isLoopSpacingReached()) {
                    $skipped++;
                    $nextRun = $parentOrder->loop_last_run->addMinutes($parentOrder->loop_spacing);
                    $results[] = ['parent_order_id' => $parentOrder->id, 'skipped_reason' => 'Loop spacing not reached. Next run at: ' . $nextRun->toDateTimeString()];
                    continue;
                }

                $provider = ApiProvider::find($parentOrder->provider_id);
                if (!$provider || !$provider->status) {
                    $errors++;
                    $results[] = ['parent_order_id' => $parentOrder->id, 'error' => 'Provider not found or inactive'];
                    continue;
                }

                $service = \App\Models\Service::find($parentOrder->service_id);
                if (!$service) {
                    $errors++;
                    $results[] = ['parent_order_id' => $parentOrder->id, 'error' => 'Service not found'];
                    continue;
                }

                $smm = new Smm();
                $smm->api_url = $provider->link;
                $smm->api_key = $provider->api_key;

                $apiData = ['service' => $parentOrder->service_api];
                if ($parentOrder->reaction) $apiData['reaction'] = $parentOrder->reaction;

                $serviceType = $service->type_service ?? 'Default';
                $parentOrderData = is_array($parentOrder->order_data) ? $parentOrder->order_data : [];

                switch ($serviceType) {
                    case 'Custom Comments':
                        $apiData['link'] = $parentOrder->link;
                        if ($parentOrder->comment) $apiData['comments'] = str_replace(["\r\n", "\r"], "\n", $parentOrder->comment);
                        if ($parentOrder->quantity) $apiData['quantity'] = $parentOrder->quantity;
                        break;
                    case 'Package':
                        $apiData['link'] = $parentOrder->link;
                        break;
                    case 'Subscriptions':
                        $apiData['username'] = $parentOrderData['username'] ?? '';
                        $apiData['min']      = $parentOrderData['min'] ?? $service->min;
                        $apiData['max']      = $parentOrderData['max'] ?? $service->max;
                        $apiData['delay']    = $parentOrderData['delay'] ?? 0;
                        if (!empty($parentOrderData['posts']))     $apiData['posts']     = $parentOrderData['posts'];
                        if (!empty($parentOrderData['old_posts'])) $apiData['old_posts'] = $parentOrderData['old_posts'];
                        if (!empty($parentOrderData['expiry']))    $apiData['expiry']    = $parentOrderData['expiry'];
                        break;
                    default:
                        $apiData['link']     = $parentOrder->link;
                        $apiData['quantity'] = $parentOrder->quantity;
                        break;
                }

                $response = $smm->order($apiData);
                $apiError = is_object($response) && isset($response->error) ? $response->error
                    : (is_array($response) && isset($response['error']) ? $response['error'] : null);

                if ($apiError) {
                    $errors++;
                    Log::error('Loop order API error', ['parent_order_id' => $parentOrder->id, 'error' => $apiError]);
                    $results[] = ['parent_order_id' => $parentOrder->id, 'error' => $apiError];
                    continue;
                }

                $newLoopCurrent = $parentOrder->loop_current + 1;

                $newOrder = Order::create([
                    'user_id'        => $parentOrder->user_id,
                    'service_id'     => $parentOrder->service_id,
                    'link'           => $parentOrder->link,
                    'comment'        => $parentOrder->comment,
                    'quantity'       => $parentOrder->quantity,
                    'rate'           => $parentOrder->rate,
                    'charge'         => $parentOrder->charge,
                    'total'          => $parentOrder->total,
                    'start_count'    => 0,
                    'remains'        => $parentOrder->quantity,
                    'status'         => 'pending',
                    'currency'       => $parentOrder->currency,
                    'domain'         => $parentOrder->domain,
                    'type'           => $parentOrder->type,
                    'service_api'    => $parentOrder->service_api,
                    'provider_id'    => $parentOrder->provider_id,
                    'provider_name'  => $parentOrder->provider_name,
                    'refill'         => $parentOrder->refill,
                    'cancel'         => $parentOrder->cancel,
                    'dripfeed'       => false,
                    'reaction'       => $parentOrder->reaction,
                    'orders_api'     => $response->order ?? null,
                    'response_data'  => ['api_response' => (array)$response, 'created_at' => now()->toIso8601String()],
                    'order_data'     => $parentOrder->order_data,
                    'loop_parent_id' => $parentOrder->id,
                    'loop_current'   => $newLoopCurrent,
                ]);

                $parentOrder->loop_current  = $newLoopCurrent;
                $parentOrder->loop_last_run = now();
                $parentOrder->save();

                $processed++;
                $results[] = ['parent_order_id' => $parentOrder->id, 'new_order_id' => $newOrder->id, 'loop_current' => $newLoopCurrent, 'loop_quantity' => $parentOrder->loop_quantity, 'orders_api' => $newOrder->orders_api];

                Log::info('Loop order created', ['parent_order_id' => $parentOrder->id, 'new_order_id' => $newOrder->id, 'loop_current' => $newLoopCurrent]);

            } catch (\Exception $e) {
                $errors++;
                Log::error('Loop order processing failed', ['parent_order_id' => $parentOrder->id, 'error' => $e->getMessage()]);
                $results[] = ['parent_order_id' => $parentOrder->id, 'error' => $e->getMessage()];
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Loop orders processed', 'processed' => $processed, 'skipped' => $skipped, 'errors' => $errors, 'results' => $results]);
    }

    public function processScheduledOrders(Request $request)
    {
        // Lấy tất cả orders awaiting có schedule_time <= now
        $orders = Order::where('status', 'awaiting')
            ->whereNotNull('schedule_time')
            ->where('schedule_time', '<=', now())
            ->get();

        if ($orders->isEmpty()) {
            return response()->json(['status' => 'success', 'message' => 'No scheduled orders to process', 'processed' => 0]);
        }

        $processed = 0;
        $errors = 0;
        $results = [];

        foreach ($orders as $order) {
            try {
                $provider = ApiProvider::find($order->provider_id);

                // Không có provider hoặc provider inactive → chỉ set pending, không gọi API
                if (!$provider || !$provider->status) {
                    $order->status = 'pending';
                    $order->start_time = now();
                    $order->save();
                    $processed++;
                    $results[] = ['order_id' => $order->id, 'status' => 'pending', 'note' => 'No provider'];
                    continue;
                }

                $service = \App\Models\Service::find($order->service_id);
                $serviceType = $service->type_service ?? 'Default';
                $orderData = is_array($order->order_data) ? $order->order_data : [];

                $smm = new Smm();
                $smm->api_url = $provider->link;
                $smm->api_key = $provider->api_key;

                $apiData = ['service' => $order->service_api];
                if ($order->reaction) $apiData['reaction'] = $order->reaction;

                switch ($serviceType) {
                    case 'Custom Comments':
                        $apiData['link'] = $order->link;
                        if ($order->comment) $apiData['comments'] = str_replace(["\r\n", "\r"], "\n", $order->comment);
                        if ($order->quantity) $apiData['quantity'] = $order->quantity;
                        break;
                    case 'Package':
                        $apiData['link'] = $order->link;
                        break;
                    case 'Subscriptions':
                        $apiData['username'] = $orderData['username'] ?? '';
                        $apiData['min']      = $orderData['min'] ?? ($service->min ?? 0);
                        $apiData['max']      = $orderData['max'] ?? ($service->max ?? 0);
                        $apiData['delay']    = $orderData['delay'] ?? 0;
                        if (!empty($orderData['posts']))     $apiData['posts']     = $orderData['posts'];
                        if (!empty($orderData['old_posts'])) $apiData['old_posts'] = $orderData['old_posts'];
                        if (!empty($orderData['expiry']))    $apiData['expiry']    = $orderData['expiry'];
                        break;
                    default:
                        $apiData['link']     = $order->link;
                        $apiData['quantity'] = $order->quantity;
                        break;
                }

                $response = $smm->order($apiData);
                $apiError = is_object($response) && isset($response->error) ? $response->error
                    : (is_array($response) && isset($response['error']) ? $response['error'] : null);

                if ($apiError) {
                    $errors++;
                    Log::error('Scheduled order API error', ['order_id' => $order->id, 'error' => $apiError]);
                    $results[] = ['order_id' => $order->id, 'error' => $apiError];
                    continue;
                }

                $order->status     = 'pending';
                $order->start_time = now();
                $order->orders_api = $response->order ?? null;
                $order->response_data = array_merge(
                    is_array($order->response_data) ? $order->response_data : [],
                    ['scheduled_dispatch' => now()->toIso8601String(), 'api_response' => (array)$response]
                );
                $order->save();

                $processed++;
                $results[] = ['order_id' => $order->id, 'orders_api' => $order->orders_api, 'status' => 'pending'];

                Log::info('Scheduled order dispatched', ['order_id' => $order->id, 'orders_api' => $order->orders_api]);

            } catch (\Exception $e) {
                $errors++;
                Log::error('Scheduled order processing failed', ['order_id' => $order->id, 'error' => $e->getMessage()]);
                $results[] = ['order_id' => $order->id, 'error' => $e->getMessage()];
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Scheduled orders processed', 'processed' => $processed, 'errors' => $errors, 'results' => $results]);
    }
}
