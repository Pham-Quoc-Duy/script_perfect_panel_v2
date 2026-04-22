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
                            $this->handleCanceledOrder($order, $statusData);
                        }
                        
                        // Lưu response_data 
                        
                        $order->save();
                        $updated++;
                        
                        // Thêm tất cả orders vào results
                        $results[] = [
                            'orders_api' => $orderApi,
                            'status' => $normalizedStatus,
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
}
