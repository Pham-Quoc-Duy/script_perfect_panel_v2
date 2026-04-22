<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CronJobController extends Controller
{
    public function index()
    {
        // Lấy danh sách providers
        $providers = ApiProvider::where('status', 1)->get();
        
        return view('admin.cron-jobs.index', compact('providers'));
    }
    
    public function runStatusUpdate(Request $request)
    {
        $providerId = $request->input('provider_id');
        
        if (!$providerId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vui lòng chọn nhà cung cấp'
            ], 400);
        }
        
        try {
            $url = url('/crons/status/orders?provider=' . $providerId);
            $response = Http::timeout(300)->get($url);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Đã chạy cập nhật trạng thái đơn hàng thành công',
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            Log::error('Error running status update cron', [
                'provider_id' => $providerId,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function runSyncServices(Request $request)
    {
        $providerId = $request->input('provider_id');
        
        if (!$providerId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Vui lòng chọn nhà cung cấp'
            ], 400);
        }
        
        try {
            $url = url('/crons/sync/services?provider=' . $providerId);
            $response = Http::timeout(300)->get($url);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Đã đồng bộ dịch vụ thành công',
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            Log::error('Error running sync services cron', [
                'provider_id' => $providerId,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 500);
        }
    }
    
    public function runAllProviders(Request $request)
    {
        $cronType = $request->input('cron_type');
        
        if (!in_array($cronType, ['status', 'sync'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Loại cron không hợp lệ'
            ], 400);
        }
        
        $providers = ApiProvider::where('status', 1)->get();
        
        if ($providers->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không có nhà cung cấp nào đang hoạt động'
            ], 400);
        }
        
        $results = [];
        $success = 0;
        $failed = 0;
        
        foreach ($providers as $provider) {
            try {
                if ($cronType === 'status') {
                    $url = url('/crons/status/orders?provider=' . $provider->id);
                } else {
                    $url = url('/crons/sync/services?provider=' . $provider->id);
                }
                
                $response = Http::timeout(300)->get($url);
                
                if ($response->successful()) {
                    $success++;
                    $results[] = [
                        'provider_id' => $provider->id,
                        'provider_name' => $provider->name,
                        'status' => 'success',
                        'data' => $response->json()
                    ];
                } else {
                    $failed++;
                    $results[] = [
                        'provider_id' => $provider->id,
                        'provider_name' => $provider->name,
                        'status' => 'error',
                        'message' => 'HTTP ' . $response->status()
                    ];
                }
            } catch (\Exception $e) {
                $failed++;
                $results[] = [
                    'provider_id' => $provider->id,
                    'provider_name' => $provider->name,
                    'status' => 'error',
                    'message' => $e->getMessage()
                ];
                
                Log::error('Error running cron for provider', [
                    'provider_id' => $provider->id,
                    'cron_type' => $cronType,
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        return response()->json([
            'status' => 'success',
            'message' => "Đã chạy xong cho {$success} nhà cung cấp, {$failed} lỗi",
            'results' => $results
        ]);
    }
}
