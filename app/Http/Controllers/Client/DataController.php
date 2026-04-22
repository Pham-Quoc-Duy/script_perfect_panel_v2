<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Config;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Platform;
use App\Models\Service;
use App\Models\ChildPanel;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\TicketSubject; 
use App\Models\Transaction;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User; 
use App\Smm\Smm;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DataController extends Controller
{
    /**
     * Check if API error is in keep_orders list
     */
    private function isErrorInKeepOrders($apiError): bool
    {
        $config = Config::where('domain', getDomain())->first();
        if (!$config) return false;

        $keepOrders = $config->getKeepOrders();
        if (empty($keepOrders)) return false;

        foreach ($keepOrders as $keepError) {
            if (stripos($apiError, $keepError) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Bump orders table AUTO_INCREMENT by a random step if fake_order_status is enabled.
     */
    private function applyFakeOrderId(int $lastOrderId): void
    {
        $config = Config::where('domain', getDomain())
            ->select('fake_order_status', 'fake_order_step_min', 'fake_order_step_max')
            ->first();

        if (!$config || !$config->fake_order_status) return;

        $min  = max(1, (int) ($config->fake_order_step_min ?? 1));
        $max  = max($min, (int) ($config->fake_order_step_max ?? 100));
        $next = $lastOrderId + rand($min, $max);

        DB::statement("ALTER TABLE orders AUTO_INCREMENT = {$next}");
    }

    /**
     * Create new order - Optimized single function
     */
    public function createOrder(Request $request): JsonResponse
    {
        try {
            // Get service first to determine validation rules
            $service = Service::where('domain', getDomain())
                ->find($request->service);
            if (!$service) {
                return response()->json([
                    'status' => 'error',
                    'success' => false,
                    'message' => 'Service does not exist'
                ], 422);
            }

            $serviceType = $service->type_service ?? 'Default';

            // Build validation rules based on service type
            $rules = [
                'service' => 'required|exists:services,id',
                'check' => 'nullable|boolean',
            ];

            $messages = [
                'service.required' => 'Please select a service',
                'service.exists' => 'Service does not exist',
            ];
 
            switch ($serviceType) {
                case 'Custom Comments':
                    $rules['link'] = 'required|url';
                    $rules['comments'] = 'required|string';
                    $rules['quantity'] = 'nullable|integer|min:1';
                    $messages['link.required'] = 'Please enter a link';
                    $messages['link.url'] = 'Invalid link format';
                    $messages['comments.required'] = 'Please enter comments';
                    break;

                case 'Package':
                    $rules['link'] = 'required|url';
                    $messages['link.required'] = 'Please enter a link';
                    $messages['link.url'] = 'Invalid link format';
                    break;

                case 'Subscriptions':
                    $rules['username'] = 'required|string';
                    $rules['min'] = 'required|integer|min:1';
                    $rules['max'] = 'required|integer|min:1';
                    $rules['delay'] = 'required|integer|min:0';
                    $rules['posts'] = 'nullable|integer|min:0';
                    $rules['old_posts'] = 'nullable|integer|min:0';
                    $rules['expiry'] = 'nullable|date';
                    $messages['username.required'] = 'Please enter username';
                    $messages['min.required'] = 'Please enter minimum quantity';
                    $messages['max.required'] = 'Please enter maximum quantity';
                    $messages['delay.required'] = 'Please enter delay';
                    break;

                case 'Default':
                default:
                    $rules['link'] = 'required|url';
                    $rules['quantity'] = 'required|integer|min:1';
                    $rules['runs'] = 'nullable|integer|min:1';
                    $rules['interval'] = 'nullable|integer|min:1';
                    $rules['delay'] = 'nullable|integer|min:0';
                    $messages['link.required'] = 'Please enter a link';
                    $messages['link.url'] = 'Invalid link format';
                    $messages['quantity.required'] = 'Please enter quantity';
                    $messages['quantity.integer'] = 'Quantity must be a number';
                    $messages['quantity.min'] = 'Quantity must be greater than 0';
                    break;
            }

            // Add optional fields for all types
            $rules = array_merge($rules, [
                'expiry' => 'nullable|date',
                'username' => 'nullable|string',
                'keywords' => 'nullable|string',
                'comments' => 'nullable|string',
                'hashtag' => 'nullable|string',
                'hashtags' => 'nullable|string',
                'usernames' => 'nullable|string',
                'mediaUrl' => 'nullable|url',
                'posts' => 'nullable|integer',
                'old_posts' => 'nullable|integer',
                'min' => 'nullable|integer',
                'max' => 'nullable|integer',
                'country' => 'nullable|string|max:2',
                'device' => 'nullable|integer|between:1,5',
                'type_of_traffic' => 'nullable|integer|between:1,3',
                'google_keyword' => 'nullable|string',
                'referring_url' => 'nullable|url',
                // Loop order fields (áp dụng cho tất cả service types)
                'loop_quantity' => 'nullable|integer|min:1',
                'loop_spacing'  => 'nullable|integer|min:1',
                'schedule_time' => 'nullable|date',
            ]);

            // Validate request
            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => 'Validation failed'
                ], 422);
            }

            $user = Auth::user();
            $service = Service::where('domain', getDomain())
                ->findOrFail($request->service);
            $serviceType = $service->type_service ?? 'Default';

            // Validate quantity for Default service type
            if ($serviceType === 'Default') {
                if ($request->quantity < $service->min || $request->quantity > $service->max) {
                    return response()->json([
                        'status' => 'error',
                        'success' => false,
                        'message' => "Quantity less than minimal ({$service->min})" . ($request->quantity > $service->max ? " or greater than maximum ({$service->max})" : '')
                    ], 422);
                }
            }

            // Validate quantity for Custom Comments service type
            if ($serviceType === 'Custom Comments') {
                $quantity = $request->quantity ?? 0;
                if ($quantity > 0 && ($quantity < $service->min || $quantity > $service->max)) {
                    return response()->json([
                        'status' => 'error',
                        'success' => false,
                        'message' => "Quantity less than minimal ({$service->min})" . ($quantity > $service->max ? " or greater than maximum ({$service->max})" : '')
                    ], 422);
                }
            }

            // Validate min/max for Subscriptions
            if ($serviceType === 'Subscriptions') {
                $min = $request->min ?? $service->min;
                $max = $request->max ?? $service->max;
                
                if ($min < $service->min || $max > $service->max) {
                    return response()->json([
                        'status' => 'error',
                        'success' => false,
                        'message' => "Min/Max values must be within service limits ({$service->min} - {$service->max})"
                    ], 422);
                }
                
                if ($min > $max) {
                    return response()->json([
                        'status' => 'error',
                        'success' => false,
                        'message' => "Minimum quantity cannot be greater than maximum quantity"
                    ], 422);
                }
            }

            // Calculate charge based on service type
            $rateField = match ($user->level ?? 'retail') {
                'agent'       => 'rate_agent',
                'distributor' => 'rate_distributor',
                default       => 'rate_retail',
            };
            $rate = (float) ($service->{$rateField} ?? $service->rate_retail ?? 0);
            $quantity = 0;
            
            switch ($serviceType) {
                case 'Package':
                    // Package: fixed rate (usually per 1 package)
                    $quantity = 1;
                    $total = $rate;
                    break;
                    
                case 'Subscriptions':
                    // Subscriptions: calculate based on max quantity
                    $quantity = $request->max ?? $service->max;
                    $total = ($quantity / 1000) * $rate;
                    break;
                    
                case 'Custom Comments':
                    // Custom Comments: use quantity from request, or calculate from comments
                    $quantity = $request->quantity ?? 0;
                    // If quantity is 0 or not provided, calculate from comment lines
                    if ($quantity == 0 && $request->filled('comments')) {
                        $comments = trim($request->comments);
                        $lines = $comments ? explode("\n", $comments) : [];
                        $quantity = count(array_filter($lines, fn($line) => trim($line) !== ''));
                    }
                    $total = ($quantity / 1000) * $rate;
                    break;
                    
                case 'Default':
                default:
                    // Default: use quantity from request
                    $quantity = $request->quantity;
                    $total = ($quantity / 1000) * $rate;
                    break;
            }

            if ($user->balance < $total) {
                return response()->json([
                    'status' => 'error',
                    'success' => false,
                    'message' => 'Insufficient balance to create this order'
                ], 422);
            }

            // Build order data
            $orderData = [
                'user_id' => $user->id,
                'service_id' => $service->id,
                'link' => $request->link ?? '',
                'comment' => $request->comments ?? null,
                'quantity' => $quantity,
                'rate' => $rate,
                'charge' => $total,
                'total' => $total,
                'start_count' => 0,
                'remains' => $quantity,
                'status' => 'pending',
                'currency' => 'USD',
                'domain' => getDomain(),
                'type' => 'normal',
                'service_api' => $service->service_api ?? null,
                'provider_id' => $service->provider_id ?? null,
                'provider_name' => $service->provider->name ?? null,
                'refill' => $service->refill ?? false,
                'cancel' => $service->cancel ?? false,
                'dripfeed' => $request->boolean('check', false),
                'reaction' => $service->reaction ?? null,
            ];

            // Add dripfeed settings (runs/interval từ dripfeed widget)
            if ($orderData['dripfeed'] && $request->filled(['runs', 'interval'])) {
                $orderData['loop_quantity'] = $request->runs;
                $orderData['loop_spacing'] = $request->interval;
            }

            // Loop order: lưu loop_quantity / loop_spacing độc lập (ưu tiên field trực tiếp)
            if ($request->filled('loop_quantity')) {
                $orderData['loop_quantity'] = (int) $request->loop_quantity;
            }
            if ($request->filled('loop_spacing')) {
                $orderData['loop_spacing'] = (int) $request->loop_spacing;
            }

            // Add schedule time (từ delay minutes hoặc schedule_time datetime trực tiếp)
            if ($request->filled('schedule_time')) {
                $orderData['schedule_time'] = \Carbon\Carbon::parse($request->schedule_time);
                $orderData['status'] = 'awaiting';
            } elseif ($request->filled('delay') && $request->delay > 0) {
                $orderData['schedule_time'] = now()->addMinutes($request->delay);
            }

            // Collect all order data for JSON storage
            $orderDataArray = [
                'service_name' => $service->name,
                'service_id' => $service->id,
                'service_type' => $serviceType,
                'link' => $request->link ?? '',
                'quantity' => $quantity,
                'rate' => $rate,
                'charge' => $total,
                'total' => $total,
                'dripfeed' => $orderData['dripfeed'],
                'refill' => $orderData['refill'],
                'cancel' => $orderData['cancel'],
                'type' => $orderData['type'],
                'currency' => $orderData['currency'],
            ];

            // Add dripfeed data if applicable
            if ($orderData['dripfeed']) {
                $orderDataArray['loop_quantity'] = $orderData['loop_quantity'] ?? null;
                $orderDataArray['loop_spacing'] = $orderData['loop_spacing'] ?? null;
            }

            // Luôn lưu loop_quantity / loop_spacing nếu có (kể cả không dripfeed)
            if (!empty($orderData['loop_quantity'])) {
                $orderDataArray['loop_quantity'] = $orderData['loop_quantity'];
            }
            if (!empty($orderData['loop_spacing'])) {
                $orderDataArray['loop_spacing'] = $orderData['loop_spacing'];
            }

            // Add schedule time if applicable
            if (isset($orderData['schedule_time'])) {
                $orderDataArray['schedule_time'] = $orderData['schedule_time'];
            }

            // Add additional fields
            $additionalFields = ['expiry', 'username', 'keywords', 'comments', 'hashtag', 'hashtags', 'usernames', 'mediaUrl', 'posts', 'old_posts', 'min', 'max', 'country', 'device', 'type_of_traffic', 'google_keyword', 'referring_url'];
            foreach ($additionalFields as $field) {
                if ($request->filled($field)) {
                    $orderDataArray[$field] = $request->input($field);
                }
            }

            // Store order_data as JSON
            $orderData['order_data'] = json_encode(array_filter($orderDataArray), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

            // Create order in transaction
            $apiResponse = null;
            $apiError = null;
            $isErrorKept = false;

            DB::transaction(function () use ($orderData, $user, $total, $service, $request, &$order, &$apiResponse, &$apiError, &$isErrorKept) {
                $provider = $service->provider;

                $saveTransaction = function () use ($user, $total, &$order) {
                    // Convert to decimal string to avoid scientific notation (e.g. 1.0E-7)
                    $totalStr   = number_format((float)$total, 9, '.', '');
                    $balanceStr = number_format((float)$user->balance, 9, '.', '');
                    $balanceAfter = bcsub($balanceStr, $totalStr, 9);
                    Transaction::create([
                        'user_id'        => $user->id,
                        'order_id'       => $order->id,
                        'amount'         => -$total,
                        'type'           => 'order',
                        'status'         => 'completed',
                        'payment_method' => 'balance',
                        'transaction_id' => 'ORDER-' . $order->id,
                        'description'    => 'Order #' . $order->id . ' - Service #' . $order->service_id,
                        'balance_after'  => $balanceAfter,
                        'domain'         => getDomain(),
                    ]);
                };

                // Nếu là scheduled order (awaiting), chỉ lưu DB, không gọi Smm
                if (($orderData['status'] ?? 'pending') === 'awaiting') {
                    $order = Order::create($orderData);
                    $user->decrement('balance', $total);
                    $saveTransaction();
                    return;
                }

                if ($provider && $provider->status) {
                    $smm = new Smm();
                    $smm->api_url = $provider->link;
                    $smm->api_key = $provider->api_key;

                    // Get service type (default to 'Default' if not set)
                    $serviceType = $service->type_service ?? 'Default';

                    // Build API data based on service type
                    $apiData = ['service' => $service->service_api];

                    if ($service->reaction) {
                        $apiData['reaction'] = $service->reaction;
                    }
                    switch ($serviceType) {
                        case 'Custom Comments':
                            // Custom Comments: service, link, comments
                            $apiData['link'] = $request->link;
                            if ($request->filled('comments')) {
                                // Normalize line breaks to \n for comments list
                                $comments = str_replace(["\r\n", "\r"], "\n", $request->comments);
                                $apiData['comments'] = $comments;
                            }
                            // Send quantity if provided (calculated from comment lines)
                            if ($request->filled('quantity')) {
                                $apiData['quantity'] = $request->quantity;
                            }
                            
                            // Debug log
                            Log::info('Custom Comments API Data', [
                                'apiData' => $apiData,
                                'request_comments' => $request->comments,
                                'request_quantity' => $request->quantity
                            ]);
                            break;

                        case 'Package':
                            // Package: service, link only
                            $apiData['link'] = $request->link;
                            break;

                        case 'Subscriptions':
                            // Subscriptions: service, username, min, max, posts, old_posts, delay, expiry
                            $apiData['username'] = $request->username;
                            $apiData['min'] = $request->min ?? $service->min;
                            $apiData['max'] = $request->max ?? $service->max;
                            $apiData['delay'] = $request->delay ?? 0;
                            
                            if ($request->filled('posts')) {
                                $apiData['posts'] = $request->posts;
                            }
                            if ($request->filled('old_posts')) {
                                $apiData['old_posts'] = $request->old_posts;
                            }
                            if ($request->filled('expiry')) {
                                // Convert expiry to d/m/Y format if needed
                                $expiry = $request->expiry;
                                if (strtotime($expiry)) {
                                    $apiData['expiry'] = date('d/m/Y', strtotime($expiry));
                                } else {
                                    $apiData['expiry'] = $expiry;
                                }
                            }
                            break;

                        case 'Default':
                        default:
                            // Default: service, link, quantity, runs (optional), interval (optional)
                            $apiData['link'] = $request->link;
                            $apiData['quantity'] = $request->quantity;
                            
                            // Add dripfeed parameters if enabled
                            if ($orderData['dripfeed']) {
                                if (isset($orderData['loop_quantity'])) {
                                    $apiData['runs'] = $orderData['loop_quantity'];
                                }
                                if (isset($orderData['loop_spacing'])) {
                                    $apiData['interval'] = $orderData['loop_spacing'];
                                }
                            }
                            break;
                    }

                    $response = $smm->order($apiData);
                    $apiResponse = $response;

                    // Check for API error - handle both object and array responses
                    $apiError = null;
                    if (is_object($response) && isset($response->error)) {
                        $apiError = $response->error;
                    } elseif (is_array($response) && isset($response['error'])) {
                        $apiError = $response['error'];
                    }

                    if ($apiError) {
                        $isErrorKept = $this->isErrorInKeepOrders($apiError);

                        if (!$isErrorKept) {
                            Log::warning('SMM API error: ' . $apiError);
                            throw new \Exception($apiError);
                        }

                        // Error is in keep_orders, proceed with order creation but mark as failed
                        Log::info('API error is in keep_orders list: ' . $apiError);
                    }

                    $order = Order::create($orderData);
                    $user->decrement('balance', $total);

                    // If error is kept, update status to failed and add error to order_data
                    if ($isErrorKept) {
                        $orderDataArray = json_decode($orderData['order_data'], true) ?? [];
                        $orderDataArray['api_error'] = $apiError;
                        $orderDataArray['error_status'] = 'kept_error';
                        $orderDataArray['api_response'] = (array)$response;
                        $orderDataArray['created_at'] = now()->toIso8601String();
                        
                        $order->update([
                            'status'        => 'failed',
                            'service_api'   => $service->service_api ?? $order->service_api,
                            'provider_id'   => $provider->id,
                            'provider_name' => $provider->name,
                            'response_data' => json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                            'orders_api'    => $response->order ?? null,
                            'order_data'    => json_encode($orderDataArray, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                        ]);
                    } else {
                        $order->update([
                            'provider_id' => $provider->id,
                            'provider_name' => $provider->name,
                            'response_data' => json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE),
                            'orders_api' => $response->order ?? null,
                        ]);
                    }
                    $saveTransaction();
                } else {
                    $order = Order::create($orderData);
                    $user->decrement('balance', $total);
                    $saveTransaction();
                }
            });

            $this->applyFakeOrderId($order->id);

            $user->refresh();

            // Parse multilingual service name
            $serviceName = $service->name;
            if (is_string($serviceName)) {
                $parsed = json_decode($serviceName, true);
                $serviceName = $parsed[$user->lang ?? 'en'] ?? $parsed['en'] ?? $serviceName;
            } elseif (is_array($serviceName)) {
                $serviceName = $serviceName[$user->lang ?? 'en'] ?? $serviceName['en'] ?? reset($serviceName);
            }

            // Format values with user currency
            $userCurrency = Currency::where('code', $user->currency ?? 'USD')
                ->where('status', true)->first();
            $sym     = $userCurrency->symbol ?? '$';
            $symPos  = $userCurrency->symbol_position ?? 'before';
            $exRate  = (float) ($userCurrency->exchange_rate ?? 1);

            $fmtMoney = function ($v) use ($sym, $symPos, $exRate) {
                $converted = rtrim(rtrim(number_format((float)$v * $exRate, 7), '0'), '.') ?: '0';
                return $symPos === 'before' ? $sym . $converted : $converted . $sym;
            };

            // Build order response
            $orderResponse = [
                'id'               => $order->id,
                'service'          => $serviceName,
                'link'             => $order->link,
                'quantity'         => $order->quantity,
                'charge'           => $fmtMoney($total),
                'original_charge'  => $fmtMoney($rate),
                'original_balance' => $fmtMoney($user->balance + $total),
                'balance'          => $fmtMoney($user->balance),
                'converted'        => false,
                'currency_template'=> $symPos === 'before' ? $sym . '{{value}}' : '{{value}}' . $sym,
            ];

            // Add comments for Custom Comments service type
            if ($serviceType === 'Custom Comments' && $order->comment) {
                $orderResponse['comments'] = $order->comment;
            }

            return response()->json([
                'status' => 'success',
                'data' => [
                    'success' => 1,
                    'order' => $orderResponse,
                    'url' => '/orders/' . $order->id,
                ],
                'success' => true,
                'message' => 'Order created successfully',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            $errorMsg = $e->getMessage();

            Log::error('Error creating order: ' . $errorMsg, [
                'user_id' => Auth::id(),
                'request_data' => $request->all(),
                'exception' => $e
            ]);

            return response()->json([
                'status' => 'error',
                'success' => false,
                'message' => $errorMsg
            ], 422);
        }
    }

    public function getCategoriesByPlatform($platformId)
    {
        if ($platformId === 'all') {
            $categories = Category::where('domain', getDomain())
                ->with('platform')
                ->orderBy('position')
                ->get();
        } else {
            $categories = Category::where('platform_id', $platformId)
                ->where('domain', getDomain())
                ->orderBy('position')
                ->get();
        }

        return response()->json($categories->map(function ($cat) {
            return [
                'id' => $cat->id,
                'name' => $cat->name,
                'image' => $cat->image ? asset($cat->image) : null,
            ];
        }));
    }

    public function getServicesByCategory($categoryId)
    {
        $services = Service::where('category_id', $categoryId)
            ->where('domain', getDomain())
            ->where('status', 1)
            ->orderBy('position')
            ->get();

        return response()->json($services->map(function ($service) {
            return [
                'id' => $service->id,
                'name' => $service->name,
                'rate_formatted' => $service->rate_formatted,
                'min' => $service->min,
                'max' => $service->max,
                'description' => $service->description,
                'note' => $service->note,
                'average_time' => $service->average_time,
                'type_service' => $service->type_service,
                'attributes' => $service->attributes ? json_decode($service->attributes, true) : [],
            ];
        }));
    }

    /**
     * Create new ticket
     */
    public function createTicket(Request $request): JsonResponse
    {
        $rules = [
            'category' => 'required|string',
            'subcategory' => 'nullable|string',
            'message' => 'required|string|max:5000',
            'custom_fields' => 'sometimes|array',
            'attachments.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,gif,pdf,txt,csv',
        ];

        $messages = [
            'category.required' => 'Vui lòng chọn danh mục',
            'message.required' => 'Vui lòng nhập nội dung',
            'message.max' => 'Nội dung không được quá 5000 ký tự',
            'attachments.*.max' => 'File không được lớn hơn 5MB',
            'attachments.*.mimes' => 'File phải có định dạng: jpg, jpeg, png, gif, pdf, txt, csv',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $category = $request->input('category');
            $subcategory = $request->input('subcategory');

            $ticketSubject = TicketSubject::where('category', $category)
                ->where('subcategory', $subcategory)
                ->first() ?? TicketSubject::where('category', $category)
                ->whereNull('subcategory')
                ->first();

            // Nếu không tìm thấy subject, tạo mới hoặc lấy subject đầu tiên của category
            if (!$ticketSubject) {
                $ticketSubject = TicketSubject::firstOrCreate(
                    ['category' => $category, 'subcategory' => null],
                    ['show_message_only' => false, 'status' => 1, 'sort_order' => 0]
                );
            }

            $subject = $subcategory ? $category . ' - ' . $subcategory : $category;
            $customFields = $request->input('custom_fields', []);

            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('ticket-attachments', $fileName, 'public');
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'file_name' => $fileName,
                        'file_path' => $filePath,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                    ];
                }
            }

            $ticket = Ticket::create([
                'user_id' => Auth::id(),
                'domain' => getDomain(),
                'subject_id' => $ticketSubject->id,
                'subject' => $subject,
                'message' => $request->input('message'),
                'custom_fields' => $customFields,
                'status' => 'open',
                'priority' => 'medium',
            ]);

            TicketReply::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'message' => $request->input('message'),
                'is_admin' => false,
                'attachments' => $attachments,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Ticket đã được tạo thành công.',
                'ticket_id' => $ticket->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating ticket: ' . $e->getMessage() . ' | Line: ' . $e->getLine() . ' | File: ' . $e->getFile());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tạo ticket. Vui lòng thử lại.',
                'debug' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Reply to ticket
     */
    public function replyTicket(Request $request, $ticketId): JsonResponse
    {
        $request->validate([
            'TicketMessageForm.message' => 'required|string|max:5000',
            'attachments.*' => 'nullable|file|max:5120|mimes:jpg,jpeg,png,gif,pdf,txt,csv',
        ], [
            'TicketMessageForm.message.required' => 'Vui lòng nhập tin nhắn',
            'TicketMessageForm.message.max' => 'Tin nhắn không được quá 5000 ký tự',
            'attachments.*.max' => 'File không được lớn hơn 5MB',
            'attachments.*.mimes' => 'File phải có định dạng: jpg, jpeg, png, gif, pdf, txt, csv',
        ]);

        try {
            $ticket = Auth::user()->tickets()->findOrFail($ticketId);

            if ($ticket->status === 'closed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Không thể trả lời ticket đã đóng.'
                ], 400);
            }

            $attachments = [];
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $filePath = $file->storeAs('ticket-attachments', $fileName, 'public');
                    $attachments[] = [
                        'original_name' => $file->getClientOriginalName(),
                        'file_name' => $fileName,
                        'file_path' => $filePath,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                    ];
                }
            }

            DB::transaction(function () use ($ticket, $request, $attachments, &$reply) {
                $reply = TicketReply::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => Auth::id(),
                    'message' => $request->input('TicketMessageForm.message'),
                    'is_admin' => false,
                    'attachments' => $attachments,
                ]);

                $ticket->update([
                    'status' => 'open',
                    'last_reply_at' => now(),
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Tin nhắn đã được gửi thành công.',
                'reply' => $reply->load('user'),
            ]);
        } catch (\Exception $e) {
            Log::error('Error replying to ticket: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi gửi tin nhắn. Vui lòng thử lại.'
            ], 500);
        }
    }

    /**
     * Close ticket
     */
    public function closeTicket(Request $request, $ticketId): JsonResponse
    {
        try {
            $ticket = Auth::user()->tickets()->findOrFail($ticketId);

            if ($ticket->status === 'closed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket đã được đóng trước đó.'
                ], 400);
            }

            $ticket->update(['status' => 'closed']);

            return response()->json([
                'success' => true,
                'message' => 'Ticket đã được đóng thành công.',
                'redirect' => route('clients.tickets.index')
            ]);
        } catch (\Exception $e) {
            Log::error('Error closing ticket: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi đóng ticket. Vui lòng thử lại.'
            ], 500);
        }
    }

    /**
     * Get ticket replies
     */
    public function getTicketMessages($ticketId): JsonResponse
    {
        try {
            $ticket = Auth::user()->tickets()->findOrFail($ticketId);

            $replies = $ticket
                ->replies()
                ->with('user')
                ->orderBy('created_at')
                ->get()
                ->map(function ($reply) {
                    return [
                        'id' => $reply->id,
                        'message' => $reply->message,
                        'user' => [
                            'id' => $reply->user->id,
                            'name' => $reply->user->name,
                        ],
                        'is_admin' => $reply->is_admin,
                        'attachments' => $reply->attachments,
                        'created_at' => $reply->created_at->format('H:i'),
                        'created_at_full' => $reply->created_at->toISOString(),
                    ];
                });

            return response()->json([
                'success' => true,
                'replies' => $replies
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting ticket replies: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi tải tin nhắn.'
            ], 500);
        }
    }

    /**
     * Get subcategories by category
     */
    public function getTicketSubcategories(Request $request): JsonResponse
    {
        $category = $request->get('category');

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category is required'
            ], 400);
        }

        $subcategories = TicketSubject::where('category', $category)
            ->where('status', 1)
            ->orderBy('sort_order')
            ->get(['id', 'subcategory', 'show_message_only', 'required_fields']);

        return response()->json([
            'success' => true,
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Get all ticket categories
     */
    public function getTicketCategories(): JsonResponse
    {
        $categories = TicketSubject::where('status', 1)
            ->select('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return response()->json([
            'success' => true,
            'categories' => $categories
        ]);
    }

    /**
     * Update user currency
     */
    public function updateCurrency(Request $request): JsonResponse
    {
        $request->validate([
            'currency_code' => 'required|string|size:3',
            'currency_symbol' => 'required|string|max:10',
            'currency_name' => 'required|string|max:100'
        ]);

        $user = Auth::user();
        $currency = Currency::where('code', strtoupper($request->currency_code))->where('status', 1)->first();

        if (!$currency) {
            return response()->json(['success' => false, 'message' => 'Currency not found'], 400);
        }

        $user->update(['currency' => $currency->code]);

        $balance = $currency->exchange_rate > 0 ? $user->balance / $currency->exchange_rate : $user->balance;
        $decimals = $balance >= 1000 ? 0 : ($balance >= 100 ? 1 : ($balance >= 10 ? 2 : 3));
        $formatted = rtrim(number_format($balance, $decimals), '0.');
        $formattedBalance = $currency->symbol_position === 'before' ? $currency->symbol . $formatted : $formatted . $currency->symbol;

        return response()->json([
            'success' => true,
            'data' => [
                'currency_code' => $currency->code,
                'currency_symbol' => $currency->symbol,
                'currency_name' => $currency->name,
                'symbol_position' => $currency->symbol_position,
                'formatted_balance' => $formattedBalance
            ]
        ]);
    }

    /**
     * Update user language
     */
    public function updateLanguage(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            $user->update(['lang' => $request->lang]);

            return response()->json([
                'success' => true,
                'message' => 'Language updated successfully',
                'lang' => $request->lang
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating language: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating language'
            ], 500);
        }
    }

    /**
     * Update user email
     */
    public function updateEmail(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'required|string'
        ]);

        try {
            $user = Auth::user();

            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect'
                ], 400);
            }

            $user->update(['email' => $request->email]);

            return response()->json([
                'success' => true,
                'message' => 'Email updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating email: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating email'
            ], 500);
        }
    }

    /**
     * Update user password
     */
    public function updatePassword(Request $request): JsonResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed'
        ], [
            'password.confirmed' => 'The password confirmation does not match'
        ]);

        try {
            $user = Auth::user();

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect'
                ], 400);
            }

            $user->update(['password' => Hash::make($request->password)]);

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating password: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating password'
            ], 500);
        }
    }

    /**
     * Update user timezone
     */
    public function updateTimezone(Request $request): JsonResponse
    {
        $request->validate([
            'timezone' => 'required|string'
        ]);

        try {
            $user = Auth::user();
            $timezone = $request->timezone;
            
            // Log timezone value for debugging
            Log::info('Updating timezone: ' . $timezone);
            
            // Get valid timezone offsets from helper
            $timezoneHelper = new \App\Helpers\Timezone();
            $validTimezones = $timezoneHelper->getTimezones();
            $validOffsets = array_column($validTimezones, 'timezone');
            
            // Check if timezone offset is valid
            if (!in_array($timezone, $validOffsets)) {
                Log::warning('Invalid timezone offset attempted: ' . $timezone);
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid timezone. Please select a valid timezone.'
                ], 400);
            }

            // Update user timezone
            $user->update(['timezone' => $timezone]);
            
            Log::info('Timezone updated successfully for user ' . $user->id . ': ' . $timezone);

            // Find timezone label for response
            $timezoneLabel = '';
            foreach ($validTimezones as $tz) {
                if ($tz['timezone'] === $timezone) {
                    $timezoneLabel = $tz['label'];
                    break;
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Timezone updated successfully',
                'timezone' => $timezone,
                'timezone_label' => $timezoneLabel
            ]);
        } catch (\Exception $e) {
            Log::error('Error updating timezone: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'timezone' => $request->timezone ?? 'null'
            ]);
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating timezone'
            ], 500);
        }
    }

    /**
     * Handle order actions (refill, cancel)
     */
    public function orderAction(Request $request, $id): JsonResponse
    {
        try {
            $order = Auth::user()->orders()->findOrFail($id);
            $action = $request->route()->getName();
            $action = str_replace('clients.orders.', '', $action);

            switch ($action) {
                case 'refill':
                    if ($order->refill != 1) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'This order cannot be refilled'
                        ], 400);
                    }

                    // Call provider API for refill
                    $apiResponse = $this->callProviderApi($order, 'refill');
                    
                    // Check if API call failed
                    if (!$this->isApiActionSuccessful($apiResponse, $order->orders_api)) {
                        $errorMsg = $this->getApiErrorMessage($apiResponse, $order->orders_api);
                        Log::warning('Refill API error: ' . $errorMsg);
                        return response()->json([
                            'status' => 'error',
                            'message' => $errorMsg
                        ], 400);
                    }

                    $order->update([
                        'refill' => 0,
                        'refill_status' => 'pending'
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'btn_text' => 'Refill requested',
                        'action' => 'refill'
                    ]);

                case 'cancel':
                    if ($order->cancel != 1) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'This order cannot be canceled'
                        ], 400);
                    }

                    // Call provider API for cancel
                    $apiResponse = $this->callProviderApi($order, 'cancel');
                    
                    // Check if API call failed
                    if (!$this->isApiActionSuccessful($apiResponse, $order->orders_api)) {
                        $errorMsg = $this->getApiErrorMessage($apiResponse, $order->orders_api);
                        Log::warning('Cancel API error: ' . $errorMsg);
                        return response()->json([
                            'status' => 'error',
                            'message' => $errorMsg
                        ], 400);
                    }

                    $user = $order->user;
                    $user->increment('balance', $order->charge);
                    $order->update([
                        'cancel' => 0,
                        'cancel_status' => 'pending'
                    ]);

                    return response()->json([
                        'status' => 'success',
                        'btn_text' => 'Cancel requested',
                        'action' => 'cancel'
                    ]);

                default:
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid action'
                    ], 400);
            }
        } catch (\Exception $e) {
            Log::error('Error processing order action: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing your request'
            ], 500);
        }
    }

    /**
     * Handle order report (cancel/refill/speedup request)
     */
    public function orderReport(Request $request, $id): JsonResponse
    {
        $request->validate([
            'type' => 'required|in:1,2,3',
        ]);

        try {
            $order = Auth::user()->orders()->findOrFail($id);

            $ticketMap = [
                '1' => 'canceled',
                '2' => 'refill',
                '3' => 'speedup',
            ];

            $order->update(['ticket' => $ticketMap[$request->input('type')]]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Create product order
     */
    public function createOrderProduct(Request $request, $id): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $user    = Auth::user();
            $product = Product::where('domain', getDomain())
                ->where('status', true)
                ->findOrFail($id);

            $quantity = (int) $request->input('quantity', 1);

            // Validate min/max
            if ($product->min && $quantity < $product->min) {
                return response()->json(['status' => 'error', 'message' => "Minimum quantity is {$product->min}"], 422);
            }
            if ($product->max && $quantity > $product->max) {
                return response()->json(['status' => 'error', 'message' => "Maximum quantity is {$product->max}"], 422);
            }

            $charge = (float) $product->price * $quantity;

            if ($user->balance < $charge) {
                return response()->json(['status' => 'error', 'message' => 'Insufficient balance'], 422);
            }

            $productOrder = null;
            DB::transaction(function () use ($user, $product, $quantity, $charge, &$productOrder) {
                $productOrder = ProductOrder::create([
                    'user_id'    => $user->id,
                    'domain'     => getDomain(),
                    'product_id' => $product->id,
                    'status'     => $product->type === 'manual' ? 'Manual' : 'Pending',
                    'amount'     => $charge,
                    'charge'     => $charge,
                    'quantity'   => $quantity,
                ]);

                $user->decrement('balance', $charge);

                // Record transaction
                $balanceAfter = number_format((float)$user->balance - $charge, 9, '.', '');
                Transaction::create([
                    'user_id'        => $user->id,
                    'order_id'       => null,
                    'amount'         => -$charge,
                    'type'           => 'order',
                    'status'         => 'completed',
                    'payment_method' => 'balance',
                    'transaction_id' => 'PRODUCT-' . $productOrder->id,
                    'description'    => 'Product order #' . $productOrder->id . ' - ' . $product->name,
                    'balance_after'  => $balanceAfter,
                    'domain'         => getDomain(),
                ]);
            });

            return response()->json([
                'status'   => 'success',
                'message'  => 'Order successfully',
                'order_id' => $productOrder->id ?? null,
                'charge'   => $charge,
                'redirect' => '/product_orders',
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Call provider API for order actions
     */
    private function callProviderApi(Order $order, string $action): array
    {
        // Check if order has provider info
        if (!$order->provider_id || !$order->orders_api) {
            return ['error' => 'Order does not have provider information'];
        }

        // Get provider
        $provider = ApiProvider::where('domain', getDomain())
            ->find($order->provider_id);
        if (!$provider || !$provider->status) {
            return ['error' => 'Provider is not available'];
        }

        // Initialize SMM API client
        $smm = new Smm();
        $smm->api_url = $provider->link;
        $smm->api_key = $provider->api_key;

        // Call appropriate API method
        try {
            if ($action === 'cancel') {
                $response = $smm->cancel($order->orders_api);
            } elseif ($action === 'refill') {
                $response = $smm->refill($order->orders_api);
            } else {
                return ['error' => 'Invalid action'];
            }

            // Convert object to array if needed
            if (is_object($response)) {
                $response = json_decode(json_encode($response), true);
            }

            return $response;
        } catch (\Exception $e) {
            Log::error("API {$action} error: " . $e->getMessage());
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Check if API action was successful
     * API returns array with order data, check if action succeeded
     */
    private function isApiActionSuccessful(array $apiResponse, int|string $orderId): bool
    {
        // If error key exists at top level, it's a general error
        if (isset($apiResponse['error'])) {
            return false;
        }

        // API returns array of results, find the order result
        if (is_array($apiResponse) && !empty($apiResponse)) {
            foreach ($apiResponse as $result) {
                if (isset($result['order']) && $result['order'] == $orderId) {
                    // Check if action succeeded (value should be 1 or true, not an error array)
                    $actionKey = array_key_first(array_diff_key($result, ['order' => null]));
                    if ($actionKey) {
                        $actionValue = $result[$actionKey];
                        // If it's an array with 'error' key, action failed
                        if (is_array($actionValue) && isset($actionValue['error'])) {
                            return false;
                        }
                        // If value is 1 or true, action succeeded
                        return $actionValue == 1 || $actionValue === true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Get error message from API response
     */
    private function getApiErrorMessage(array $apiResponse, int|string $orderId): string
    {
        // Check for top-level error
        if (isset($apiResponse['error'])) {
            return $apiResponse['error'];
        }

        // Find error in order-specific response
        if (is_array($apiResponse) && !empty($apiResponse)) {
            foreach ($apiResponse as $result) {
                if (isset($result['order']) && $result['order'] == $orderId) {
                    $actionKey = array_key_first(array_diff_key($result, ['order' => null]));
                    if ($actionKey) {
                        $actionValue = $result[$actionKey];
                        if (is_array($actionValue) && isset($actionValue['error'])) {
                            return $actionValue['error'];
                        }
                    }
                }
            }
        }

        return 'An error occurred while processing your request';
    }

    /**
     * Generate 2FA code and send to user email
     */
    public function twoFaGenerate(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            
            // Generate a random 6-digit code
            $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Store the code in session with expiry (10 minutes)
            session(['2fa_code' => $code, '2fa_code_expires' => now()->addMinutes(10)]);
            
            // Send code to user email
            Mail::raw("Your two-factor authentication code is: {$code}\n\nThis code will expire in 10 minutes.", function ($message) use ($user) {
                $message->to($user->email)
                    ->subject('Two-Factor Authentication Code');
            });
            
            return response()->json([
                'success' => true,
                'message' => 'A verification code has been sent to your email address'
            ]);
        } catch (\Exception $e) {
            Log::error('Error generating 2FA code: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while sending the verification code'
            ], 500);
        }
    }

    /**
     * Approve 2FA code and enable 2FA
     */
    public function twoFaApprove(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'code' => 'required|string|size:6'
            ]);
            
            $user = Auth::user();
            $submittedCode = $request->code;
            
            // Check if code exists in session
            if (!session('2fa_code')) {
                return response()->json([
                    'success' => false,
                    'message' => 'No verification code found. Please request a new one.'
                ], 400);
            }
            
            // Check if code has expired
            if (now()->isAfter(session('2fa_code_expires'))) {
                session()->forget(['2fa_code', '2fa_code_expires']);
                return response()->json([
                    'success' => false,
                    'message' => 'Verification code has expired. Please request a new one.'
                ], 400);
            }
            
            // Verify code
            if ($submittedCode !== session('2fa_code')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid verification code. Please try again.'
                ], 400);
            }
            
            // Code is valid - enable 2FA for user
            $user->update(['two_factor_enabled' => true]);
            
            // Clear session
            session()->forget(['2fa_code', '2fa_code_expires']);
            
            return response()->json([
                'success' => true,
                'message' => 'Two-factor authentication has been enabled successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Error approving 2FA code: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while verifying the code'
            ], 500);
        }
    }

    /**
     * Generate new API key for user
     */
    public function generateApiKey(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            
            // Generate new unique API key
            do {
                $apiKey = Str::random(64);
            } while (User::where('api_key', $apiKey)->exists());
            
            // Update user's API key
            $user->update(['api_key' => $apiKey]);
            
            return response()->json([
                'success' => true,
                'message' => 'API key generated successfully',
                'api_key' => $apiKey
            ]);
        } catch (\Exception $e) {
            Log::error('Error generating API key: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while generating API key'
            ], 500);
        }
    }

    /**
     * Create child panel
     */
    public function createChildPanel(Request $request): JsonResponse
    {
        try {
            // Validation rules
            $validator = Validator::make($request->all(), [
                'domain' => [
                    'required',
                    'string',
                    'max:255',
                    'unique:child_panels,domain_panel',
                    'regex:/^(?!:\/\/)([a-zA-Z0-9-_]+\.)*[a-zA-Z0-9][a-zA-Z0-9-_]+\.[a-zA-Z]{2,11}?$/i'
                ],
                'currency' => 'required|string',
                'username' => 'required|string|max:255',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'domain.required' => 'Domain is required',
                'domain.regex' => 'Invalid domain name',
                'domain.unique' => 'This domain is already registered',
                'username.required' => 'Admin username is required',
                'password.required' => 'Admin password is required',
                'password.confirmed' => 'Password confirmation does not match',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                    'message' => $validator->errors()->first()
                ], 422);
            }

            // Get config for child panel cost
            $config = Config::where('domain', getDomain())->first();
            $cost = $config->child_panel_cost ?? 0;

            // Check user balance
            $user = Auth::user();
            if ($user->balance < $cost) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient balance. Required: $' . number_format($cost, 2)
                ], 422);
            }

            // Initialize Cloudflare
            $cloudflare = new \App\Library\CloudflareCustom();

            // Check if Cloudflare is configured
            if (!$cloudflare->isConfigured()) {
                $configStatus = $cloudflare->getConfigStatus();
                
                Log::error('Cloudflare not properly configured', [
                    'domain' => $request->domain,
                    'user_id' => $user->id,
                    'config_status' => $configStatus
                ]);
                
                $missingFields = implode(', ', $configStatus['missing_fields']);
                
                return response()->json([
                    'success' => false,
                    'message' => "Cloudflare is not properly configured. Missing fields: $missingFields. Please contact administrator.",
                    'code' => 'CLOUDFLARE_NOT_CONFIGURED',
                    'missing_fields' => $configStatus['missing_fields']
                ], 422);
            }

            try {
                // Create domain with automatic DNS and IP configuration
                $cloudflareResult = $cloudflare->createDomainWithAutoConfig($request->domain);
                
                if ($cloudflareResult['status'] !== 'success') {
                    Log::error('Cloudflare domain creation failed', [
                        'domain' => $request->domain,
                        'error' => $cloudflareResult['message'],
                        'code' => $cloudflareResult['code'] ?? null
                    ]);
                    
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to configure domain on Cloudflare: ' . $cloudflareResult['message'],
                        'cloudflare_error' => $cloudflareResult['message'],
                        'code' => $cloudflareResult['code'] ?? null
                    ], 422);
                }
                
                $cloudflareData = $cloudflareResult['data'];
                Log::info('Cloudflare domain created', [
                    'domain' => $request->domain,
                    'zone_id' => $cloudflareData['zone_id']
                ]);
                
            } catch (\Exception $cfException) {
                Log::error('Cloudflare exception', [
                    'domain' => $request->domain,
                    'error' => $cfException->getMessage()
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Cloudflare error: ' . $cfException->getMessage()
                ], 422);
            }

            // Create child panel in transaction
            $childPanel = DB::transaction(function () use ($user, $cost, $request, $cloudflareData) {
                $childPanel = ChildPanel::create([
                    'user_id' => $user->id,
                    'domain' => getDomain(),
                    'domain_panel' => strtolower($request->domain),
                    'price' => $cost,
                    'status' => 'pending',
                ]);

                // Store admin credentials and settings
                $childPanel->setSetting('admin_username', $request->username);
                $childPanel->setSetting('admin_password', Hash::make($request->password));
                $childPanel->setSetting('currency', $request->currency);

                // Store Cloudflare data
                $childPanel->setSetting('cloudflare_zone_id', $cloudflareData['zone_id']);
                $childPanel->setSetting('cloudflare_dns_id', $cloudflareData['dns_id']);
                $childPanel->setSetting('cloudflare_nameserver1', $cloudflareData['nameserver1']);
                $childPanel->setSetting('cloudflare_nameserver2', $cloudflareData['nameserver2']);
                $childPanel->setSetting('cloudflare_status', $cloudflareData['zone_status']);
                $childPanel->setSetting('cloudflare_configured_at', $cloudflareData['created_at']);

                // Deduct cost from user balance
                if ($cost > 0) {
                    $user->decrement('balance', $cost);
                }

                return $childPanel;
            });

            return response()->json([
                'success' => true,
                'message' => 'Child panel created successfully. Domain configured on Cloudflare.',
                'data' => [
                    'id' => $childPanel->id,
                    'domain' => $childPanel->domain_panel,
                    'cloudflare' => [
                        'zone_id' => $cloudflareData['zone_id'],
                        'nameserver1' => $cloudflareData['nameserver1'],
                        'nameserver2' => $cloudflareData['nameserver2'],
                        'status' => $cloudflareData['zone_status'],
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error creating child panel', [
                'domain' => $request->domain ?? null,
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
