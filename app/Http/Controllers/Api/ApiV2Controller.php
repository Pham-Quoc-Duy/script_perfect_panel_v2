<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Service;
use App\Models\User; 
use App\Smm\Smm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;

class ApiV2Controller extends Controller
{
    /**
     * Helper: Validate user API key
     */
    private function validateUser(string $apiKey): ?User
    {
        $user = User::where('api_key', $apiKey)->first();
        return ($user && $user->is_active) ? $user : null;
    }

    /**
     * Helper: Check required fields
     */
    private function checkRequired(Request $request, array $fields): ?JsonResponse
    {
        foreach ($fields as $field) {
            if (!$request->has($field)) {
                return response()->json(['error' => 'Incorrect request'], 200);
            }
        }
        return null;
    }

    /**
     * Helper: Parse multilingual field
     */
    private function parseField($value, string $default = 'Unknown'): string
    {
        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return $decoded['en'] ?? $value;
        }
        return is_array($value) ? ($value['en'] ?? $default) : $default;
    }

    /**
     * Helper: Get user rate by level
     */
    private function getUserRate(User $user, Service $service): float
    {
        return match ($user->level) {
            'distributor' => $service->rate_distributor ?? $service->rate_agent ?? $service->rate_retail,
            'agent' => $service->rate_agent ?? $service->rate_retail,
            default => $service->rate_retail,
        };
    }

    /**
     * Get user balance
     */
    public function balance(Request $request): JsonResponse
    {
        try {
            $check = $this->checkRequired($request, ['api_key']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->api_key);
            if (!$user) {
                return response()->json(['error' => 'Invalid API key'], 200);
            }

            return response()->json([
                'balance' => (float) $user->balance,
                'currency' => 'USD'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Incorrect request'], 200);
        }
    }

    /**
     * Get services list
     */
    public function services(Request $request): JsonResponse
    {
        try {
            $check = $this->checkRequired($request, ['api_key']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->api_key);
            if (!$user) {
                return response()->json(['error' => 'Invalid API key'], 200);
            }

            $services = Service::with('category')
                ->where('status', true)
                ->ordered()
                ->get()
                ->map(fn(Service $service) => [
                    'service' => (int) $service->id,
                    'name' => $this->parseField($service->name),
                    'type' => $service->type_service ?: 'Default',
                    'category' => $this->parseField($service->category?->name, 'General'),
                    'rate' => number_format($this->getUserRate($user, $service), 4, '.', ''),
                    'min' => (int) $service->min,
                    'max' => (int) $service->max,
                    'refill' => (bool) $service->refill,
                    'cancel' => (bool) $service->cancel,
                ])
                ->values();

            return response()->json($services, 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Incorrect request'], 200);
        }
    }

    /**
     * Create order
     */
    public function create(Request $request): JsonResponse
    {
        try {
            $check = $this->checkRequired($request, ['api_key', 'service']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->api_key);
            if (!$user) {
                return response()->json(['error' => 'Invalid or inactive account'], 200);
            }

            // Get service to determine type
            $service = Service::find($request->service);
            if (!$service) {
                return response()->json(['error' => 'Service not found'], 200);
            }

            $serviceType = $service->type_service ?? 'Default';

            // Validate required fields based on service type
            $requiredFields = ['api_key', 'service'];

            switch ($serviceType) {
                case 'Custom Comments':
                    $requiredFields = array_merge($requiredFields, ['link', 'comments']);
                    break;
                case 'Package':
                    $requiredFields = array_merge($requiredFields, ['link']);
                    break;
                case 'Subscriptions':
                    $requiredFields = array_merge($requiredFields, ['username', 'min', 'max', 'delay']);
                    break;
                case 'Default':
                default:
                    $requiredFields = array_merge($requiredFields, ['link', 'quantity']);
                    break;
            }

            $check = $this->checkRequired($request, $requiredFields);
            if ($check)
                return $check;

            // Authenticate as the API user
            auth()->setUser($user);

            // Build request data for DataController
            $requestData = [
                'service' => $request->service,
                'link' => $request->link,
                'quantity' => $request->quantity,
                'runs' => $request->runs,
                'interval' => $request->interval,
                'delay' => $request->delay,
                'check' => $request->check,
                // Handle 'comments' field from API (map to 'comments' for DataController)
                'comments' => $request->comments ?? $request->comment,
                'username' => $request->username,
                'keywords' => $request->keywords,
                'hashtag' => $request->hashtag,
                'hashtags' => $request->hashtags,
                'usernames' => $request->usernames,
                'mediaUrl' => $request->mediaUrl,
                'posts' => $request->posts,
                'old_posts' => $request->old_posts,
                'min' => $request->min,
                'max' => $request->max,
                'country' => $request->country,
                'device' => $request->device,
                'type_of_traffic' => $request->type_of_traffic,
                'google_keyword' => $request->google_keyword,
                'referring_url' => $request->referring_url,
                'expiry' => $request->expiry,
                'reactType' => $request->reactType,
            ];

            // Create a new request for DataController with API data
            $orderRequest = new Request($requestData);
            $orderRequest->setUserResolver(function () use ($user) {
                return $user;
            });

            // Call DataController's createOrder method
            $dataController = new \App\Http\Controllers\Client\DataController();
            $response = $dataController->createOrder($orderRequest);

            // Get the response data
            $responseData = $response->getData(true);

            // Check if order was created successfully
            if (isset($responseData['success']) && $responseData['success'] && isset($responseData['order_id'])) {
                // Return simple format: {"order": order_id}
                return response()->json([
                    'order' => (int) $responseData['order_id']
                ], 200);
            }

            // If there's an error, return it
            if (isset($responseData['message'])) {
                return response()->json([
                    'error' => $responseData['message']
                ], 200);
            }

            // Fallback error
            return response()->json([
                'error' => 'An error occurred while creating the order'
            ], 200);
        } catch (Exception $e) {
            Log::error('API create order error: ' . $e->getMessage());
            return response()->json([
                'error' => $e->getMessage() ?: 'An error occurred while creating the order. Please try again.'
            ], 200);
        }
    }

    /**
     * Get order status
     */
    public function status(Request $request): JsonResponse
    {
        try {
            // Support both 'order' and 'order_id' parameter names
            $orderId = $request->input('order') ?? $request->input('order_id');

            if (!$orderId) {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            $check = $this->checkRequired($request, ['api_key']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->api_key);
            if (!$user) {
                return response()->json(['error' => 'Invalid API key'], 200);
            }

            // Check if this is a provider request (has api_url)
            if ($request->has('api_url')) {
                $smm = new Smm();
                $smm->api_key = $request->api_key;
                $smm->api_url = $request->api_url;

                return response()->json([
                    'status' => 'success',
                    'data' => $smm->status($orderId)
                ], 200);
            }

            // Local database request - get order from database
            $order = Order::where('id', $orderId)
                ->where('user_id', $user->id)
                ->first();

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 200);
            }

            // If order doesn't have provider info, return local status
            if (!$order->orders_api || !$order->apiProvider) {
                return response()->json([
                    'charge' => number_format($order->charge, 5, '.', ''),
                    'start_count' => (string) $order->start_count,
                    'status' => ucfirst($order->status),
                    'remains' => (string) $order->remains,
                    'currency' => $order->currency ?? 'USD'
                ], 200);
            }

            // Get status from provider
            try {
                $smm = new Smm();
                $smm->api_key = $order->apiProvider->api_key;
                $smm->api_url = $order->apiProvider->api_url;

                $providerStatus = $smm->status($order->orders_api);

                return response()->json([
                    'charge' => number_format($order->charge, 5, '.', ''),
                    'start_count' => (string) ($providerStatus->start_count ?? $order->start_count),
                    'status' => $providerStatus->status ?? ucfirst($order->status),
                    'remains' => (string) ($providerStatus->remains ?? $order->remains),
                    'currency' => $order->currency ?? 'USD'
                ], 200);
            } catch (Exception $e) {
                // If provider request fails, return local status
                return response()->json([
                    'charge' => number_format($order->charge, 5, '.', ''),
                    'start_count' => (string) $order->start_count,
                    'status' => ucfirst($order->status),
                    'remains' => (string) $order->remains,
                    'currency' => $order->currency ?? 'USD'
                ], 200);
            }
        } catch (Exception $e) {
            Log::error('API status error: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request'], 200);
        }
    }

    /**
     * Get multiple orders status
     */
    public function multiStatus(Request $request): JsonResponse
    {
        try {
            $check = $this->checkRequired($request, ['api_key']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->api_key);
            if (!$user) {
                return response()->json(['error' => 'Invalid API key'], 200);
            }

            // Support both 'orders' (comma-separated string) and 'order_ids' (array)
            $orderIds = [];
            if ($request->has('orders')) {
                // Parse comma-separated string
                $orderIds = array_map('trim', explode(',', $request->orders));
                $orderIds = array_filter($orderIds);  // Remove empty values
            } elseif ($request->has('order_ids')) {
                $orderIds = is_array($request->order_ids) ? $request->order_ids : [$request->order_ids];
            } else {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            // Limit to 100 IDs
            $orderIds = array_slice($orderIds, 0, 100);

            if (empty($orderIds)) {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            // Check if this is a provider request (has api_url)
            if ($request->has('api_url')) {
                $smm = new Smm();
                $smm->api_key = $request->api_key;
                $smm->api_url = $request->api_url;
                return response()->json($smm->multiStatus($orderIds), 200);
            }

            // Local database request - get orders and group by provider
            $orders = Order::whereIn('id', $orderIds)
                ->where('user_id', $user->id)
                ->with('apiProvider')
                ->get()
                ->keyBy('id');

            $results = [];

            foreach ($orderIds as $orderId) {
                $order = $orders->get($orderId);

                // Order not found or doesn't belong to user
                if (!$order) {
                    $results[(string) $orderId] = ['error' => 'Incorrect order ID'];
                    continue;
                }

                // If order doesn't have provider info, return local status
                if (!$order->orders_api || !$order->apiProvider) {
                    $results[(string) $orderId] = [
                        'charge' => number_format($order->charge, 5, '.', ''),
                        'start_count' => (string) $order->start_count,
                        'status' => ucfirst($order->status),
                        'remains' => (string) $order->remains,
                        'currency' => $order->currency ?? 'USD'
                    ];
                    continue;
                }

                // Get status from provider
                try {
                    $smm = new Smm();
                    $smm->api_key = $order->apiProvider->api_key;
                    $smm->api_url = $order->apiProvider->api_url;

                    $providerStatus = $smm->status($order->orders_api);

                    $results[(string) $orderId] = [
                        'charge' => number_format($order->charge, 5, '.', ''),
                        'start_count' => (string) ($providerStatus->start_count ?? $order->start_count),
                        'status' => $providerStatus->status ?? ucfirst($order->status),
                        'remains' => (string) ($providerStatus->remains ?? $order->remains),
                        'currency' => $order->currency ?? 'USD'
                    ];
                } catch (Exception $e) {
                    // If provider request fails, return local status
                    $results[(string) $orderId] = [
                        'charge' => number_format($order->charge, 5, '.', ''),
                        'start_count' => (string) $order->start_count,
                        'status' => ucfirst($order->status),
                        'remains' => (string) $order->remains,
                        'currency' => $order->currency ?? 'USD'
                    ];
                }
            }

            return response()->json($results, 200);
        } catch (Exception $e) {
            Log::error('API multi-status error: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request'], 200);
        }
    }

    /**
     * Create refill request
     */
    public function refill(Request $request): JsonResponse
    {
        try {
            // Support both 'order' and 'order_id' parameter names
            $orderId = $request->input('order') ?? $request->input('order_id');

            if (!$orderId) {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            $check = $this->checkRequired($request, ['api_key']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->api_key);
            if (!$user) {
                return response()->json(['error' => 'Invalid API key'], 200);
            }

            // Check if this is a provider request (has api_url)
            if ($request->has('api_url')) {
                $smm = new Smm();
                $smm->api_key = $request->api_key;
                $smm->api_url = $request->api_url;

                return response()->json($smm->refill($orderId), 200);
            }

            // Local database request - get order from database
            $order = Order::where('id', $orderId)
                ->where('user_id', $user->id)
                ->first();

            if (!$order) {
                return response()->json(['error' => 'Order not found'], 200);
            }

            // Check if order can be refilled
            if (!$order->refill) {
                return response()->json(['error' => 'This order cannot be refilled'], 200);
            }

            // If order doesn't have provider info, return error
            if (!$order->orders_api || !$order->apiProvider) {
                return response()->json(['error' => 'Order does not have provider information'], 200);
            }

            // Call provider API for refill
            try {
                $smm = new Smm();
                $smm->api_key = $order->apiProvider->api_key;
                $smm->api_url = $order->apiProvider->api_url;

                $providerResponse = $smm->refill($order->orders_api);

                // Check if refill was successful
                $refillSuccess = false;
                if (is_object($providerResponse)) {
                    $refillSuccess = isset($providerResponse->refill) && $providerResponse->refill == 1;
                } elseif (is_array($providerResponse)) {
                    $refillSuccess = isset($providerResponse['refill']) && $providerResponse['refill'] == 1;
                }

                if ($refillSuccess) {
                    $order->update([
                        'refill' => 0,
                        'refill_status' => 'pending'
                    ]);

                    return response()->json(['refill' => 1], 200);
                } else {
                    // Provider returned error
                    $errorMsg = 'Refill failed';
                    if (is_object($providerResponse) && isset($providerResponse->error)) {
                        $errorMsg = $providerResponse->error;
                    } elseif (is_array($providerResponse) && isset($providerResponse['error'])) {
                        $errorMsg = $providerResponse['error'];
                    }

                    return response()->json(['error' => $errorMsg], 200);
                }
            } catch (Exception $e) {
                Log::error("API refill error for order {$orderId}: " . $e->getMessage());
                return response()->json(['error' => 'An error occurred while refilling the order'], 200);
            }
        } catch (Exception $e) {
            Log::error('API refill error: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request'], 200);
        }
    }

    /**
     * Create multiple refill requests
     */
    public function multiRefill(Request $request): JsonResponse
    {
        try {
            $check = $this->checkRequired($request, ['api_key']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->api_key);
            if (!$user) {
                return response()->json(['error' => 'Invalid API key'], 200);
            }

            // Support both 'orders' (comma-separated string) and 'order_ids' (array)
            $orderIds = [];
            if ($request->has('orders')) {
                // Parse comma-separated string
                $orderIds = array_map('trim', explode(',', $request->orders));
                $orderIds = array_filter($orderIds);  // Remove empty values
            } elseif ($request->has('order_ids')) {
                $orderIds = is_array($request->order_ids) ? $request->order_ids : [$request->order_ids];
            } else {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            // Limit to 100 IDs
            $orderIds = array_slice($orderIds, 0, 100);

            if (empty($orderIds)) {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            // Check if this is a provider request (has api_url)
            if ($request->has('api_url')) {
                $smm = new Smm();
                $smm->api_key = $request->api_key;
                $smm->api_url = $request->api_url;
                return response()->json($smm->multiRefill($orderIds), 200);
            }

            // Local database request - process each order
            $results = [];

            foreach ($orderIds as $orderId) {
                $order = Order::where('id', $orderId)
                    ->where('user_id', $user->id)
                    ->first();

                // Order not found or doesn't belong to user
                if (!$order) {
                    $results[] = [
                        'order' => (int) $orderId,
                        'refill' => ['error' => 'Incorrect order ID']
                    ];
                    continue;
                }

                // Check if order can be refilled
                if (!$order->refill) {
                    $results[] = [
                        'order' => (int) $orderId,
                        'refill' => ['error' => 'This order cannot be refilled']
                    ];
                    continue;
                }

                // If order doesn't have provider info, return error
                if (!$order->orders_api || !$order->apiProvider) {
                    $results[] = [
                        'order' => (int) $orderId,
                        'refill' => ['error' => 'Order does not have provider information']
                    ];
                    continue;
                }

                // Call provider API for refill
                try {
                    $smm = new Smm();
                    $smm->api_key = $order->apiProvider->api_key;
                    $smm->api_url = $order->apiProvider->api_url;

                    $providerResponse = $smm->refill($order->orders_api);

                    // Check if refill was successful
                    $refillSuccess = false;
                    if (is_object($providerResponse)) {
                        $refillSuccess = isset($providerResponse->refill) && $providerResponse->refill == 1;
                    } elseif (is_array($providerResponse)) {
                        $refillSuccess = isset($providerResponse['refill']) && $providerResponse['refill'] == 1;
                    }

                    if ($refillSuccess) {
                        $order->update([
                            'refill' => 0,
                            'refill_status' => 'pending'
                        ]);

                        $results[] = [
                            'order' => (int) $orderId,
                            'refill' => 1
                        ];
                    } else {
                        // Provider returned error
                        $errorMsg = 'Refill failed';
                        if (is_object($providerResponse) && isset($providerResponse->error)) {
                            $errorMsg = $providerResponse->error;
                        } elseif (is_array($providerResponse) && isset($providerResponse['error'])) {
                            $errorMsg = $providerResponse['error'];
                        }

                        $results[] = [
                            'order' => (int) $orderId,
                            'refill' => ['error' => $errorMsg]
                        ];
                    }
                } catch (Exception $e) {
                    Log::error("API refill error for order {$orderId}: " . $e->getMessage());
                    $results[] = [
                        'order' => (int) $orderId,
                        'refill' => ['error' => 'An error occurred while refilling the order']
                    ];
                }
            }

            return response()->json($results, 200);
        } catch (Exception $e) {
            Log::error('API multi-refill error: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request'], 200);
        }
    }

    /**
     * Cancel order(s)
     * Supports both single order and multiple orders (comma-separated)
     */
    public function cancel(Request $request): JsonResponse
    {
        try {
            $check = $this->checkRequired($request, ['api_key']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->api_key);
            if (!$user) {
                return response()->json(['error' => 'Invalid API key'], 200);
            }

            // Parse order IDs - support both 'order' (single) and 'orders' (multiple)
            $orderIds = [];
            if ($request->has('orders')) {
                // Parse comma-separated string
                $orderIds = array_map('trim', explode(',', $request->orders));
                $orderIds = array_filter($orderIds);  // Remove empty values
            } elseif ($request->has('order')) {
                $orderIds = [$request->order];
            } else {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            // Limit to 100 IDs
            $orderIds = array_slice($orderIds, 0, 100);

            if (empty($orderIds)) {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            // Check if this is a provider request (has api_url)
            if ($request->has('api_url')) {
                $smm = new Smm();
                $smm->api_key = $request->api_key;
                $smm->api_url = $request->api_url;

                return response()->json($smm->cancel($orderIds), 200);
            }

            // Local database request - process each order
            $results = [];

            foreach ($orderIds as $orderId) {
                $order = Order::where('id', $orderId)
                    ->where('user_id', $user->id)
                    ->first();

                // Order not found or doesn't belong to user
                if (!$order) {
                    $results[] = [
                        'order' => (int) $orderId,
                        'cancel' => ['error' => 'Incorrect order ID']
                    ];
                    continue;
                }

                // Check if order can be canceled
                if (!$order->cancel) {
                    $results[] = [
                        'order' => (int) $orderId,
                        'cancel' => ['error' => 'This order cannot be canceled']
                    ];
                    continue;
                }

                // If order doesn't have provider info, handle local cancel
                if (!$order->orders_api || !$order->apiProvider) {
                    // Local cancel - refund the charge
                    $user->increment('balance', $order->charge);
                    $order->update([
                        'cancel' => 0,
                        'cancel_status' => 'completed',
                        'status' => 'canceled'
                    ]);

                    $results[] = [
                        'order' => (int) $orderId,
                        'cancel' => 1
                    ];
                    continue;
                }

                // Call provider API for cancel
                try {
                    $smm = new Smm();
                    $smm->api_key = $order->apiProvider->api_key;
                    $smm->api_url = $order->apiProvider->api_url;

                    $providerResponse = $smm->cancel($order->orders_api);

                    // Check if cancel was successful
                    $cancelSuccess = false;
                    if (is_object($providerResponse)) {
                        $cancelSuccess = isset($providerResponse->cancel) && $providerResponse->cancel == 1;
                    } elseif (is_array($providerResponse)) {
                        $cancelSuccess = isset($providerResponse['cancel']) && $providerResponse['cancel'] == 1;
                    }

                    if ($cancelSuccess) {
                        // Refund the charge
                        $user->increment('balance', $order->charge);
                        $order->update([
                            'cancel' => 0,
                            'cancel_status' => 'completed',
                            'status' => 'canceled'
                        ]);

                        $results[] = [
                            'order' => (int) $orderId,
                            'cancel' => 1
                        ];
                    } else {
                        // Provider returned error
                        $errorMsg = 'Cancel failed';
                        if (is_object($providerResponse) && isset($providerResponse->error)) {
                            $errorMsg = $providerResponse->error;
                        } elseif (is_array($providerResponse) && isset($providerResponse['error'])) {
                            $errorMsg = $providerResponse['error'];
                        }

                        $results[] = [
                            'order' => (int) $orderId,
                            'cancel' => ['error' => $errorMsg]
                        ];
                    }
                } catch (Exception $e) {
                    Log::error("API cancel error for order {$orderId}: " . $e->getMessage());
                    $results[] = [
                        'order' => (int) $orderId,
                        'cancel' => ['error' => 'An error occurred while canceling the order']
                    ];
                }
            }

            // Return array format for multiple orders, single object for single order
            if (count($orderIds) === 1) {
                return response()->json($results[0], 200);
            }

            return response()->json($results, 200);
        } catch (Exception $e) {
            Log::error('API cancel error: ' . $e->getMessage());
            return response()->json(['error' => 'Incorrect request'], 200);
        }
    }

    /**
     * Handle old API format (action-based)
     */
    public function handleAction(Request $request): JsonResponse
    {
        try {
            $check = $this->checkRequired($request, ['key', 'action']);
            if ($check)
                return $check;

            $user = $this->validateUser($request->key);
            if (!$user) {
                return response()->json(['error' => 'Incorrect request'], 200);
            }

            return match ($request->action) {
                'balance' => response()->json([
                    'balance' => (float) $user->balance,
                    'currency' => 'USD'
                ], 200),
                'services' => $this->services(new Request(['api_key' => $request->key])),
                'add' => $this->create($request->merge(['api_key' => $request->key])),
                'status' => $this->handleStatusAction($request),
                'cancel' => $this->handleCancelAction($request),
                'refill' => $this->handleRefillAction($request),
                default => response()->json(['error' => 'Incorrect request'], 200),
            };
        } catch (Exception $e) {
            return response()->json(['error' => 'Incorrect request'], 200);
        }
    }

    /**
     * Handle status action - route to single or multi status
     */
    private function handleStatusAction(Request $request): JsonResponse
    {
        // Check if this is a multi-status request
        if ($request->has('orders') || $request->has('order_ids')) {
            return $this->multiStatus($request->merge(['api_key' => $request->key]));
        }

        // Single status request
        if ($request->has('order')) {
            return $this->status($request->merge(['api_key' => $request->key, 'order' => $request->order]));
        }

        return response()->json(['error' => 'Incorrect request'], 200);
    }

    /**
     * Handle cancel action - route to single or multi cancel
     */
    private function handleCancelAction(Request $request): JsonResponse
    {
        // Check if this is a multi-cancel request
        if ($request->has('orders')) {
            return $this->cancel($request->merge(['api_key' => $request->key]));
        }

        // Single cancel request
        if ($request->has('order')) {
            return $this->cancel($request->merge(['api_key' => $request->key, 'order' => $request->order]));
        }

        return response()->json(['error' => 'Incorrect request'], 200);
    }

    /**
     * Handle refill action - route to single or multi refill
     */
    private function handleRefillAction(Request $request): JsonResponse
    {
        // Check if this is a multi-refill request
        if ($request->has('orders')) {
            return $this->multiRefill($request->merge(['api_key' => $request->key]));
        }

        // Single refill request
        if ($request->has('order')) {
            return $this->refill($request->merge(['api_key' => $request->key, 'order' => $request->order]));
        }

        return response()->json(['error' => 'Incorrect request'], 200);
    }
}
