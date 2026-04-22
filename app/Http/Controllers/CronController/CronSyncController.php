<?php

namespace App\Http\Controllers\CronController;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ApiProvider;
use App\Smm\Smm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CronSyncController extends Controller
{
    public function syncServices(Request $request)
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

        // Lấy tất cả services của provider
        $services = Service::where('provider_id', $providerId)
            ->whereNotNull('service_api')
            ->where('service_api', '!=', '')
            ->get();

        if ($services->isEmpty()) {
            return response()->json([
                'status' => 'success',
                'message' => 'No services to sync',
                'provider_id' => $providerId,
                'provider_name' => $provider->name
            ]);
        }

        // Khởi tạo Smm
        $smm = new Smm();
        $smm->api_url = $provider->link;
        $smm->api_key = $provider->api_key;

        $updated = 0;
        $skipped = 0;
        $errors = 0;
        $results = [];

        try {
            // Gọi services() để lấy danh sách services từ API
            $apiServices = $smm->services();
            
            if (isset($apiServices->error)) {
                Log::error('Smm services error', [
                    'provider_id' => $providerId,
                    'error' => $apiServices['error']
                ]);
                
                return response()->json([
                    'status' => 'error',
                    'message' => $apiServices['error'],
                    'provider_id' => $providerId
                ], 500);
            }

            // Tạo map service_api => service data từ API
            $apiServicesMap = [];
            foreach ($apiServices as $apiService) {
                if (isset($apiService->service)) {
                    $apiServicesMap[$apiService->service] = (array) $apiService;
                }
            }

            // Cập nhật từng service
            foreach ($services as $service) {
                $serviceApi = $service->service_api;
                
                if (!isset($apiServicesMap[$serviceApi])) {
                    $skipped++;
                    continue;
                }

                $apiData = $apiServicesMap[$serviceApi];
                
                try {
                    $updated_fields = [];
                    
                    // Kiểm tra sync_rate
                    if ($service->sync_rate == 1 && isset($apiData['rate'])) {
                        $rateOriginal = (float) $apiData['rate'];
                        $service->rate_original = $rateOriginal;
                        
                        // Tính toán rate_retail, rate_agent, rate_distributor
                        $service->rate_retail = $rateOriginal * $service->rate_retail_up;
                        $service->rate_agent = $rateOriginal * $service->rate_agent_up;
                        $service->rate_distributor = $rateOriginal * $service->rate_distributor_up;
                        
                        $updated_fields[] = 'rate';
                    }
                    
                    // Kiểm tra sync_min_max
                    if ($service->sync_min_max == 1) {
                        if (isset($apiData['min'])) {
                            $service->min = $apiData['min'];
                            $updated_fields[] = 'min';
                        }
                        if (isset($apiData['max'])) {
                            $service->max = $apiData['max'];
                            $updated_fields[] = 'max';
                        }
                    }
                    
                    // Kiểm tra sync_action (refill, cancel, dripfeed)
                    if ($service->sync_action == 1) {
                        if (isset($apiData['refill'])) {
                            $service->refill = (bool) $apiData['refill'];
                            $updated_fields[] = 'refill';
                        }
                        if (isset($apiData['cancel'])) {
                            $service->cancel = (bool) $apiData['cancel'];
                            $updated_fields[] = 'cancel';
                        }
                        if (isset($apiData['dripfeed'])) {
                            $service->dripfeed = (bool) $apiData['dripfeed'];
                            $updated_fields[] = 'dripfeed';
                        }
                    }
                    
                    // Nếu có field nào được update thì save
                    if (!empty($updated_fields)) {
                        $service->save();
                        $updated++;
                        
                        $results[] = [
                            'service_id' => $service->id,
                            'service_api' => $serviceApi,
                            'updated_fields' => $updated_fields,
                            'rate_original' => $service->rate_original ?? null,
                            'rate_retail' => $service->rate_retail ?? null,
                            'min' => $service->min ?? null,
                            'max' => $service->max ?? null
                        ];
                    } else {
                        $skipped++;
                    }
                    
                } catch (\Exception $e) {
                    $errors++;
                    $results[] = [
                        'service_id' => $service->id,
                        'service_api' => $serviceApi,
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ];
                    
                    Log::error('Error syncing service', [
                        'service_id' => $service->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }
            
            return response()->json([
                'status' => 'success',
                'message' => "Cron job sync services completed"
            ]);
            
        } catch (\Exception $e) {
            Log::error('Cron sync failed', [
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
