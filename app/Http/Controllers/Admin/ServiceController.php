<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceApi;
use App\Models\Category;
use App\Models\ApiProvider;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Process name field - return array instead of JSON string
     * Let the mutator handle JSON encoding
     */
    private function processNameField(array $nameData): array
    {
        // Sanitize and ensure English name exists
        $nameData = array_map(function($name) {
            return trim(strip_tags($name));
        }, $nameData);
        
        if (empty($nameData['en'])) {
            throw new \InvalidArgumentException('English name is required');
        }
        
        // Remove empty values
        $nameData = array_filter($nameData, function($name) {
            return !empty($name);
        });
        
        return $nameData; // Return array, not JSON string
    }

    /**
     * Process attributes field - handle array or JSON string input
     * Returns clean array of attributes (never NULL, always array)
     */
    private function processAttributesField($attributesFromRequest): array
    {
        $attributes = [];
        
        // Log input
        \Log::debug('processAttributesField - Input:', [
            'input_type' => gettype($attributesFromRequest),
            'input_value' => is_array($attributesFromRequest) ? json_encode($attributesFromRequest) : $attributesFromRequest,
            'is_null' => is_null($attributesFromRequest),
            'is_empty_string' => $attributesFromRequest === '',
            'is_empty_array' => $attributesFromRequest === []
        ]);
        
        // Nếu input là null hoặc rỗng, trả về array rỗng
        if ($attributesFromRequest === null || $attributesFromRequest === '' || $attributesFromRequest === []) {
            \Log::debug('processAttributesField - Returning empty array');
            return $attributes;
        }
        
        // Handle JSON string input
        if (is_string($attributesFromRequest) && !empty($attributesFromRequest)) {
            try {
                $decoded = json_decode($attributesFromRequest, true);
                if (is_array($decoded)) {
                    $attributes = $decoded;
                }
            } catch (\Exception $e) {
                \Log::warning('Failed to decode attributes JSON', [
                    'input' => $attributesFromRequest,
                    'error' => $e->getMessage()
                ]);
                return [];
            }
        } elseif (is_array($attributesFromRequest)) {
            // Already an array
            $attributes = $attributesFromRequest;
        }
        
        // Filter and clean attributes
        $attributes = array_filter($attributes, function($item) {
            return !empty($item) && is_string($item);
        });
        
        // Reindex array to ensure no key issues
        $attributes = array_values($attributes);
        
        // Trim whitespace from each attribute
        $attributes = array_map(function($attr) {
            return trim($attr);
        }, $attributes);
        
        // Remove duplicates
        $attributes = array_unique($attributes);
        
        // Reindex again after removing duplicates
        $attributes = array_values($attributes);
        
        // Log output theo format yêu cầu
        \Log::debug('processAttributesField - Output:', [
            'array' => $attributes,
            'isEmpty' => empty($attributes),
            'type' => 'array',
            'json' => json_encode($attributes)
        ]);
        
        // Luôn trả về array (có thể rỗng nhưng không bao giờ NULL)
        return is_array($attributes) ? $attributes : [];
    }

    /**
     * Process reaction field - normalize and validate
     * Returns null if empty, otherwise returns normalized string
     */
    private function processReactionField($reactionInput): ?string
    {
        // Return null if input is null or empty string
        if (is_null($reactionInput) || $reactionInput === '') {
            return null;
        }

        // Trim whitespace
        $reaction = trim($reactionInput);
        
        // Return null if empty after trimming
        if (empty($reaction)) {
            return null;
        }

        // Convert to uppercase
        $reaction = strtoupper($reaction);
        
        // Remove extra spaces between words
        $reaction = preg_replace('/\s+/', ' ', $reaction);
        
        // Validate format: should contain only letters, numbers, spaces, commas, hyphens
        if (!preg_match('/^[A-Z0-9\s,\-]+$/', $reaction)) {
            throw new \InvalidArgumentException('Reaction chỉ được chứa chữ cái, số, dấu phẩy và dấu gạch ngang');
        }
        
        \Log::debug('Reaction processed', [
            'input' => $reactionInput,
            'output' => $reaction,
            'length' => strlen($reaction)
        ]);
        
        return $reaction;
    }
    public function index(Request $request)
    {
        // Handle reorder action (PUT request)
        if ($request->isMethod('PUT') && $request->input('action') === 'reorder') {
            return $this->reorder($request);
        }

        // Build query with relationships - only load what we need
        $query = Service::query()
            ->with(['category:id,name,platform_id,image', 'category.platform:id,name,image'])
            ->where('domain', getDomain());

        // Search by ID or name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', $search)
                  ->orWhere('name->en', 'like', '%' . $search . '%')
                  ->orWhere('name->vi', 'like', '%' . $search . '%')
                  ->orWhere('title', 'like', '%' . $search . '%');
            });
        }

        // Sort by position asc, then id desc by default
        $sortBy = $request->get('sort_by', 'position');
        $sortOrder = $request->get('sort_order', 'asc');
        $query->orderBy($sortBy, $sortOrder)->orderBy('id', 'desc');

        // Add pagination for better performance
        $services = $query->paginate(50);

        // Return JSON for AJAX requests
        if ($request->expectsJson() || $request->ajax()) {
            $html = view('admin.services.partials.services-list', compact('services'))->render();
            
            return response()->json([
                'success' => true,
                'html' => $html,
                'data' => $services
            ]);
        }

        // Get all platforms with their categories and services
        $domain = getDomain();
        $platforms = \App\Models\Platform::where('domain', $domain)
            ->where('status', 1)
            ->orderBy('position', 'asc')
            ->get();

        // Get all categories with services
        $allCategories = Category::where('domain', $domain)
            ->with(['platform:id,name,image', 'services' => function($q) {
                $q->orderBy('position', 'asc');
            }])
            ->orderBy('position', 'asc')
            ->get();

        // Prepare plat_cat structure: Platform -> Category -> Services
        $plat_cat = [];
        foreach ($platforms as $platform) {
            $platformData = [
                'id' => $platform->id,
                'name' => $platform->name,
                'image' => $platform->image,
                'position' => $platform->position,
                'categories' => []
            ];

            // Get categories for this platform
            $platformCategories = $allCategories->where('platform_id', $platform->id);
            
            foreach ($platformCategories as $category) {
                $categoryData = [
                    'id' => $category->id,
                    'name' => is_array($category->name) ? ($category->name['en'] ?? reset($category->name)) : $category->name,
                    'image' => $category->image,
                    'position' => $category->position,
                    'services' => $category->services ?? collect()
                ];
                
                $platformData['categories'][] = $categoryData;
            }

            if (!empty($platformData['categories'])) {
                $plat_cat[] = $platformData;
            }
        }

        // Only load languages and providers for initial page load
        $languages = \App\Models\Language::where('status', true)
            ->where('domain', $domain)
            ->select('id', 'name', 'code', 'flag')
            ->get();
            
        $providers = \App\Models\ApiProvider::where('domain', $domain)
            ->where('status', true)
            ->select('id', 'name', 'link')
            ->orderBy('name')
            ->get();

        return view('adminpanel.services.index', compact('services', 'plat_cat', 'languages', 'providers'));
    }

    /**
     * Reorder services positions
     */
    protected function reorder(Request $request)
    {
        try {
            $services = $request->input('services', []);
            
            foreach ($services as $item) {
                Service::where('id', $item['id'])->update(['position' => $item['position']]);
            }

            return response()->json([
                'success' => 'Update Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource (adminpanel).
     */
    public function add(Request $request)
    {
        $categories = Category::with('platform')->where('domain', getDomain())->get();
        $languages = \App\Models\Language::where('status', true)->where('code', '!=', 'en')->where('domain', getDomain())->orderBy('code')->get();
        $providers = \App\Models\ApiProvider::where('domain', getDomain())
            ->where('status', true)
            ->orderBy('name')
            ->get();
        $config = \App\Models\Config::first();
        $markupConfig = [
            'markup_retail' => ($config && $config->markup_retail > 0) ? $config->markup_retail : 110.0,
            'markup_agent' => ($config && $config->markup_agent > 0) ? $config->markup_agent : 108.0,
            'markup_distributor' => ($config && $config->markup_distributor > 0) ? $config->markup_distributor : 105.0
        ];

        return view('adminpanel.services.add', compact('categories', 'languages', 'markupConfig', 'providers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categories = Category::with('platform')->where('domain', getDomain())->get();
        $languages = \App\Models\Language::where('status', true)->where('code', '!=', 'en')->where('domain', getDomain())->orderBy('code')->get();
        // Get providers for the domain
        $providers = \App\Models\ApiProvider::where('domain', getDomain())
            ->where('status', true)
            ->orderBy('name')
            ->get();
        // Debug: Check if languages are loaded
        \Log::info('Languages loaded for service create:', ['count' => $languages->count(), 'languages' => $languages->pluck('name', 'code')->toArray()]);
        
        // Get markup configuration from Config table
        $config = \App\Models\Config::first();
        
        // Ensure we have valid numeric values, fallback to defaults if null or 0
        $markupConfig = [
            'markup_retail' => ($config && $config->markup_retail > 0) ? $config->markup_retail : 110.0,
            'markup_agent' => ($config && $config->markup_agent > 0) ? $config->markup_agent : 108.0,
            'markup_distributor' => ($config && $config->markup_distributor > 0) ? $config->markup_distributor : 105.0
        ];
        
        // Debug: Log markup config values
        \Log::info('Markup config loaded:', [
            'config_exists' => $config ? 'yes' : 'no',
            'markup_retail_raw' => $config ? $config->markup_retail : 'null',
            'markup_agent_raw' => $config ? $config->markup_agent : 'null', 
            'markup_distributor_raw' => $config ? $config->markup_distributor : 'null',
            'final_config' => $markupConfig
        ]);
        
        return view('admin.services.create', compact('categories', 'languages', 'markupConfig','providers'));
    }

    /**
     * Show the form for importing services.
     */
    public function import(Request $request)
    {
        $categories = Category::with('platform')->where('domain', getDomain())->get();
        $providers = \App\Models\ApiProvider::where('domain', getDomain())
            ->where('status', true)
            ->orderBy('name')
            ->get();
        
        // Get markup configuration from Config table
        $config = \App\Models\Config::first();
        $markupConfig = [
            'markup_retail' => ($config && $config->markup_retail > 0) ? $config->markup_retail : 110.0,
            'markup_agent' => ($config && $config->markup_agent > 0) ? $config->markup_agent : 108.0,
            'markup_distributor' => ($config && $config->markup_distributor > 0) ? $config->markup_distributor : 105.0
        ];

        return view('adminpanel.services.import', compact('categories', 'providers', 'markupConfig'));
    }

    /**
     * Store imported services - Import multiple services at once (batch)
     */
    public function storeImport(Request $request)
    {
        try {
            $validated = $request->validate([
                'category_id' => 'required|exists:categories,id',
                'provider_id' => 'required|exists:api_providers,id',
                'services' => 'required|array|min:1',
                'services.*' => 'required|integer',
                'services_data' => 'required|array|min:1',
                'services_data.*.service_id' => 'required|integer',
                'services_data.*.rate_retail' => 'required|numeric|min:0',
                'services_data.*.rate_agent' => 'required|numeric|min:0',
                'services_data.*.rate_distributor' => 'required|numeric|min:0',
                'services_data.*.rate_retail_up' => 'required|numeric|min:0',
                'services_data.*.rate_agent_up' => 'required|numeric|min:0',
                'services_data.*.rate_distributor_up' => 'required|numeric|min:0',
                'services_data.*.sync_enabled' => 'sometimes|boolean',
                'markup_config' => 'required|array',
                'markup_config.markup_retail' => 'required|numeric|min:0',
                'markup_config.markup_agent' => 'required|numeric|min:0', 
                'markup_config.markup_distributor' => 'required|numeric|min:0'
            ]);

            \Log::info('=== IMPORT START ===', ['services_count' => count($validated['services_data'])]);

            $domain = getDomain();

            // Get provider
            $provider = \App\Models\ApiProvider::where('domain', $domain)
                ->where('id', $validated['provider_id'])
                ->where('status', true)
                ->firstOrFail();

            \Log::info('Provider found', ['id' => $provider->id, 'name' => $provider->name]);

            // Get provider services
            $smm = new \App\Smm\Smm();
            $smm->api_url = $provider->link;
            $smm->api_key = $provider->api_key;
            $providerServices = $smm->services();

            \Log::info('Provider services fetched', ['type' => gettype($providerServices)]);

            // Convert object to array if needed
            if (is_object($providerServices)) {
                $providerServices = json_decode(json_encode($providerServices), true);
                \Log::info('Converted object to array');
            }

            if (!is_array($providerServices)) {
                \Log::error('Invalid provider services response', [
                    'type' => gettype($providerServices),
                    'response' => is_string($providerServices) ? $providerServices : json_encode($providerServices)
                ]);
                return response()->json(['success' => false, 'message' => 'Không thể lấy danh sách dịch vụ'], 400);
            }

            \Log::info('Provider services count', ['count' => count($providerServices)]);

            // Build lookup map by service ID
            $psMap = [];
            foreach ($providerServices as $ps) {
                // Convert object to array if needed
                if (is_object($ps)) {
                    $ps = json_decode(json_encode($ps), true);
                }
                
                $serviceId = $ps['service'] ?? $ps['id'] ?? null;
                if ($serviceId) {
                    $psMap[$serviceId] = $ps;
                }
            }

            \Log::info('Lookup map built', ['map_size' => count($psMap)]);

            $categoryImage = \App\Models\Category::find($validated['category_id'])?->image;
            $errors = [];
            $imported = 0;
            $serviceRecords = [];

            // Process all services in batch
            foreach ($validated['services_data'] as $index => $serviceData) {
                $serviceId = $serviceData['service_id'];

                // Check if service exists in provider
                if (!isset($psMap[$serviceId])) {
                    $errors[] = "Service ID {$serviceId} không tìm thấy";
                    \Log::warning("Service not found", ['service_id' => $serviceId]);
                    continue;
                }

                $ps = $psMap[$serviceId];
                $rate = floatval($ps['rate'] ?? 0);

                if ($rate <= 0 || empty($ps['name'])) {
                    $errors[] = "Service ID {$serviceId} dữ liệu không hợp lệ";
                    \Log::warning("Invalid service data", ['service_id' => $serviceId, 'rate' => $rate]);
                    continue;
                }

                // Calculate rates
                $rRetail = floatval($serviceData['rate_retail']);
                $rAgent = floatval($serviceData['rate_agent']);
                $rDist = floatval($serviceData['rate_distributor']);
                $rRetailUp = floatval($serviceData['rate_retail_up']);
                $rAgentUp = floatval($serviceData['rate_agent_up']);
                $rDistUp = floatval($serviceData['rate_distributor_up']);
                $sync = $serviceData['sync_enabled'] ?? true;

                // Prepare service data
                $serviceRecords[] = [
                    'category_id' => $validated['category_id'],
                    'type' => 'api',
                    'type_service' => $ps['type'] ?? '0',
                    'name' => json_encode(['en' => $ps['name']]),
                    'title' => $ps['title'] ?? $ps['name'],
                    'description' => $ps['description'] ?? '',
                    'image' => $categoryImage,
                    'rate_original' => $rate,
                    'rate_retail' => $rRetail,
                    'rate_agent' => $rAgent,
                    'rate_distributor' => $rDist,
                    'rate_retail_up' => $rRetailUp,
                    'rate_agent_up' => $rAgentUp,
                    'rate_distributor_up' => $rDistUp,
                    'min' => max(1, intval($ps['min'] ?? 1)),
                    'max' => max(1, intval($ps['max'] ?? 10000)),
                    'refill' => (bool)($ps['refill'] ?? false) ? 1 : 0,
                    'cancel' => (bool)($ps['cancel'] ?? false) ? 1 : 0,
                    'dripfeed' => (bool)($ps['dripfeed'] ?? false) ? 1 : 0,
                    'status' => 1,
                    'sync_rate' => $sync ? 1 : 0,
                    'sync_min_max' => 1,
                    'sync_action' => 1,
                    'service_api' => $serviceId,
                    'provider_id' => $provider->id,
                    'provider_name' => $provider->name,
                    'domain' => $domain,
                    'position' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                $imported++;
            }

            \Log::info('Services prepared', ['imported' => $imported, 'errors' => count($errors)]);

            // Batch upsert all services at once (much faster)
            if (!empty($serviceRecords)) {
                \Log::info('Starting upsert', ['records' => count($serviceRecords)]);
                
                \DB::table('services')->upsert(
                    $serviceRecords,
                    ['service_api', 'domain', 'provider_id'],
                    ['category_id', 'rate_retail', 'rate_agent', 'rate_distributor', 'rate_retail_up', 'rate_agent_up', 'rate_distributor_up', 'updated_at']
                );

                \Log::info('Upsert completed');
            }

            \Log::info('=== IMPORT END ===', ['success' => true, 'imported' => $imported]);

            // Build list of imported services with their IDs
            $importedServices = [];
            foreach ($validated['services_data'] as $serviceData) {
                $importedServices[] = [
                    'service_id' => $serviceData['service_id']
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'imported_count' => $imported,
                    'error_count' => count($errors),
                    'imported_services' => $importedServices,
                    'error_services' => $errors
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error', ['errors' => $e->errors()]);
            return response()->json(['success' => false, 'message' => 'Please select category', 'errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            \Log::error('=== IMPORT ERROR ===', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:api,manual',
            'type_service' => 'nullable|string',
            'name' => 'required|array',
            'name.en' => 'required|string|max:255',
            'name.*' => 'nullable|string|max:255',
            'rate_original' => 'nullable|numeric|min:0|required_if:type,manual',
            'rate_retail' => 'required|numeric|min:0',
            'rate_agent' => 'required|numeric|min:0',
            'rate_distributor' => 'required|numeric|min:0',
            'rate_retail_up' => 'nullable|numeric|min:0',
            'rate_agent_up' => 'nullable|numeric|min:0',
            'rate_distributor_up' => 'nullable|numeric|min:0',
            'provider_id' => 'nullable|string|required_if:type,api',
            'provider_service_id' => 'nullable|string|required_if:type,api',
            'provider_name' => 'nullable|string',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string|max:500',
            'attributes' => 'nullable|array',
            'attributes.*' => 'nullable|string|max:255',
            'min' => 'nullable|integer|min:1',
            'max' => 'nullable|integer|min:1',
            'position' => 'nullable|integer|min:0',
            'average_time' => 'nullable|string|max:255',
            'note' => 'nullable|string',
            'reaction' => 'nullable|string|max:500',
            'sync_rate' => 'sometimes|nullable',
            'sync_min_max' => 'sometimes|nullable',
            'sync_action' => 'sometimes|nullable',
            'service_api' => 'sometimes|nullable|string'
        ]);

        // Set defaults and process data
        $validated['min'] = $validated['min'] ?? 1;
        $validated['max'] = $validated['max'] ?? 10000;

        // Nếu image không phải URL hợp lệ (FA class hoặc rỗng), lấy từ category
        $imageInput = $request->input('image');
        if ($imageInput && filter_var($imageInput, FILTER_VALIDATE_URL)) {
            $validated['image'] = $imageInput;
        } else {
            $category = \App\Models\Category::find($validated['category_id']);
            $validated['image'] = ($category && !empty($category->image)) ? $category->image : null;
        }

        // Process name field to JSON
        if (isset($validated['name'])) {
            $validated['name'] = $this->processNameField($validated['name']);
        }
        
        // Handle boolean fields - use request->boolean() to properly convert
        $validated['status'] = $request->boolean('status', false);
        $validated['refill'] = $request->boolean('refill', false);
        $validated['cancel'] = $request->boolean('cancel', false);
        $validated['dripfeed'] = $request->boolean('dripfeed', false);
        $validated['sync_rate'] = $request->boolean('sync_rate', false);
        $validated['sync_min_max'] = $request->boolean('sync_min_max', false);
        $validated['sync_action'] = $request->boolean('sync_action', false);
        $validated['domain'] = getDomain();

        // Handle service_api field
        if ($validated['type'] === 'api') {
            if (isset($validated['provider_service_id']) && $validated['provider_service_id']) {
                $validated['service_api'] = $validated['provider_service_id'];
            } elseif ($request->has('service_api') && $request->input('service_api')) {
                $validated['service_api'] = $request->input('service_api');
            }
        } else {
            // Manual mode: clear provider fields
            $validated['provider_id'] = null;
            $validated['provider_name'] = null;
            $validated['service_api'] = null;
        }

        // Handle attributes conversion - store method
        $validated['attributes'] = $this->processAttributesField($request->input('attributes'));
        
        // Log attributes theo format yêu cầu
        \Log::info('=== CREATE SERVICE ATTRIBUTES ===', [
            'attributes_input' => $request->input('attributes'),
            'attributes_processed' => [
                'array' => $validated['attributes'],
                'isEmpty' => empty($validated['attributes']),
                'type' => 'array',
                'json' => json_encode($validated['attributes'])
            ]
        ]);

        // Handle reaction field - normalize and validate
        if ($request->has('reaction')) {
            try {
                $validated['reaction'] = $this->processReactionField($request->input('reaction'));
                
                \Log::info('=== CREATE SERVICE REACTION ===', [
                    'reaction_input' => $request->input('reaction'),
                    'reaction_processed' => $validated['reaction']
                ]);
            } catch (\Exception $e) {
                \Log::error('Error processing reaction in store', [
                    'reaction_input' => $request->input('reaction'),
                    'error' => $e->getMessage()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi xử lý reaction: ' . $e->getMessage()
                ], 500);
            }
        }

        $service = Service::create($validated);
        
        // Log after save theo format yêu cầu
        \Log::info('=== SERVICE CREATED ===', [
            'service_id' => $service->id,
            'attributes_saved' => [
                'array' => $service->attributes,
                'isEmpty' => empty($service->attributes),
                'type' => 'array',
                'json' => json_encode($service->attributes)
            ]
        ]);
        $message = "Dịch vụ <strong>{$service->getName()}</strong> đã được tạo thành công!";

        return $request->expectsJson()
            ? response()->json(['success' => true, 'message' => $message, 'service' => $service])
            : redirect()->route('admin.services.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Service $service)
    {
        $service->load(['category.platform', 'provider']);
        
        // If this is an API service, try to get additional info from provider
        if ($service->type === 'api' && $service->provider_id && $service->service_api) {
            try {
                // Get provider service info
                $provider = $service->provider;
                if ($provider && $provider->status) {
                    $smm = new \App\Smm\Smm();
                    $smm->api_url = $provider->link;
                    $smm->api_key = $provider->api_key;
                    
                    $providerServices = $smm->services();
                    
                    // Convert object to array if needed
                    if (is_object($providerServices)) {
                        $providerServices = json_decode(json_encode($providerServices), true);
                    }
                    
                    if (is_array($providerServices)) {
                        // Find the matching service
                        $matchingService = collect($providerServices)->first(function ($s) use ($service) {
                            // Convert object to array if needed
                            if (is_object($s)) {
                                $s = json_decode(json_encode($s), true);
                            }
                            return ($s['service'] ?? $s['id'] ?? null) == $service->service_api;
                        });
                        
                        if ($matchingService) {
                            // Convert to array if object
                            if (is_object($matchingService)) {
                                $matchingService = json_decode(json_encode($matchingService), true);
                            }
                            
                            $service->provider_service_name = $matchingService['name'] ?? null;
                            $service->provider_service_rate = $matchingService['rate'] ?? null;
                            $service->provider_service_min = $matchingService['min'] ?? null;
                            $service->provider_service_max = $matchingService['max'] ?? null;
                            $service->provider_service_type = $matchingService['type'] ?? null;
                        }
                    }
                }
            } catch (\Exception $e) {
                // Log error but don't fail the request
                \Log::warning('Failed to fetch provider service info for service ' . $service->id, [
                    'error' => $e->getMessage()
                ]);
            }
        }
        
        return $request->expectsJson() || $request->ajax()
            ? response()->json(['success' => true, 'service' => $service])
            : view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        // Get service ID from query string
        $serviceId = $request->query('id');
        
        if (!$serviceId) {
            return redirect()->route('admin.services.index')->with('error', 'Không tìm thấy dịch vụ');
        }
        
        $service = Service::findOrFail($serviceId);
        $service->load(['category.platform']);
        
        // OPTIMIZED: Only select necessary fields to reduce memory usage
        $categories = Category::with('platform:id,name,image')
            ->where('domain', getDomain())
            ->select('id', 'name', 'platform_id', 'image')
            ->get()
            ->filter(function($category) {
                return is_object($category) && $category->id && $category->platform;
            });
            
        // OPTIMIZED: Only select necessary fields
        $languages = \App\Models\Language::where('status', true)
            ->where('code', '!=', 'en')
            ->where('domain', getDomain())
            ->select('id', 'name', 'code')
            ->orderBy('code')
            ->get();
            
        // OPTIMIZED: Only select necessary fields
        $providers = \App\Models\ApiProvider::where('domain', getDomain())
            ->where('status', true)
            ->select('id', 'name', 'fixed_decimal')
            ->orderBy('name')
            ->get();
        
        $config = \App\Models\Config::where('domain', getDomain())
            ->where('status', true)
            ->first();
        
        // Prepare markup config with fallback values
        $markupConfig = [
            'markup_retail' => ($config && $config->markup_retail > 0) ? $config->markup_retail : 110.0,
            'markup_agent' => ($config && $config->markup_agent > 0) ? $config->markup_agent : 108.0,
            'markup_distributor' => ($config && $config->markup_distributor > 0) ? $config->markup_distributor : 105.0
        ];
            
        return view('adminpanel.services.edit', compact('service', 'categories', 'languages', 'providers', 'markupConfig'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Get service ID from query string
        $serviceId = $request->query('id');
        
        if (!$serviceId) {
            return response()->json([
                'success' => false, 
                'message' => 'Không tìm thấy dịch vụ'
            ], 404);
        }
        
        try {
            $service = Service::findOrFail($serviceId);
        } catch (\Exception $e) {
            \Log::error('Service not found', [
                'service_id' => $serviceId,
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => "Không tìm thấy dịch vụ với ID: {$serviceId}"
            ], 404);
        }
        
        // Handle status toggle (from status-switch component)
        if ($request->has('toggle_status')) {
            $status = $request->boolean('status', false);
            $entityId = $request->input('entity_id', $service->id);
            
            if ($service->status !== $status) {
                $service->update(['status' => $status]);
                $message = $status 
                    ? "Kích hoạt dịch vụ ID #{$entityId} thành công!" 
                    : "Vô hiệu hóa dịch vụ ID #{$entityId} thành công!";
            } else {
                $message = "Trạng thái dịch vụ ID #{$entityId} không thay đổi!";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'status' => $status,
                'entity_id' => $entityId,
                'service' => $service->fresh()
            ]);
        }

        // Validate request data
        try {
            // Log incoming request for debugging
            \Log::info('=== UPDATE SERVICE REQUEST ===', [
                'service_id' => $serviceId,
                'method' => $request->method(),
                'content_type' => $request->header('Content-Type'),
                'has_name' => $request->has('name'),
                'has_category_id' => $request->has('category_id'),
                'has_rate_retail' => $request->has('rate_retail'),
                'has_attributes' => $request->has('attributes'),
                'name_value' => $request->input('name'),
                'category_id_value' => $request->input('category_id'),
                'attributes_value' => $request->input('attributes'),
                'all_keys' => array_keys($request->except(['_token', '_method'])),
                'request_sample' => $request->only(['type', 'category_id', 'name', 'rate_retail', 'min', 'max'])
            ]);
            
            $validated = $request->validate([
                'category_id' => 'sometimes|required|exists:categories,id',
                'type' => 'sometimes|required|in:api,manual',
                'type_service' => 'sometimes|nullable|string|in:Package,Default,Custom Comments,Mentions Hashtag,Special',
                'name' => 'sometimes|array',
                'name.en' => 'sometimes|required|string|max:255',
                'name.*' => 'nullable|string|max:255',
                'rate_original' => 'sometimes|nullable|numeric|min:0|required_if:type,manual',
                'rate_retail' => 'sometimes|required|numeric|min:0',
                'rate_agent' => 'sometimes|required|numeric|min:0',
                'rate_distributor' => 'sometimes|required|numeric|min:0',
                'rate_retail_up' => 'sometimes|nullable|numeric|min:0',
                'rate_agent_up' => 'sometimes|nullable|numeric|min:0',
                'rate_distributor_up' => 'sometimes|nullable|numeric|min:0',
                'provider_id' => 'sometimes|nullable|string|required_if:type,api',
                'provider_service_id' => 'sometimes|nullable|string|required_if:type,api',
                'provider_name' => 'sometimes|nullable|string',
                'title' => 'sometimes|nullable|string|max:255',
                'description' => 'sometimes|nullable|string',
                'image' => 'sometimes|nullable|url|max:500',
                'attributes' => 'sometimes|nullable|array',
                'attributes.*' => 'nullable|string|max:255',
                'min' => 'sometimes|nullable|integer|min:1',
                'max' => 'sometimes|nullable|integer|min:1',
                'position' => 'sometimes|nullable|integer|min:0',
                'average_time' => 'sometimes|nullable|string|max:255',
                'note' => 'sometimes|nullable|string',
                'reaction' => 'sometimes|nullable|string|max:500',
                'sync_rate' => 'sometimes|nullable',
                'sync_min_max' => 'sometimes|nullable',
                'sync_action' => 'sometimes|nullable',
                'service_api' => 'sometimes|nullable|string',
                'total_limit' => 'sometimes|nullable|integer|min:1',
                'limit' => 'sometimes|nullable|integer|min:1',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation failed for service update', [
                'service_id' => $serviceId,
                'errors' => $e->errors(),
                'request_data' => $request->except(['_token', '_method'])
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        }

        // Handle default values for required fields if they are being updated
        if (array_key_exists('min', $validated) && is_null($validated['min'])) {
            $validated['min'] = 1;
        }
        if (array_key_exists('max', $validated) && is_null($validated['max'])) {
            $validated['max'] = 10000;
        }
        if (array_key_exists('type', $validated) && is_null($validated['type'])) {
            $validated['type'] = 'manual';
        }

        // Process name field to JSON
        if (isset($validated['name'])) {
            try {
                $validated['name'] = $this->processNameField($validated['name']);
            } catch (\Exception $e) {
                \Log::error('Error processing name field', [
                    'service_id' => $serviceId,
                    'name_data' => $validated['name'],
                    'error' => $e->getMessage()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi xử lý tên dịch vụ: ' . $e->getMessage()
                ], 500);
            }
        }

        // Handle boolean fields
        if ($request->has('status')) {
            $validated['status'] = 1;
        } else {
            $validated['status'] = 0;
        }

        if ($request->has('refill')) {
            $validated['refill'] = 1;
        } else {
            $validated['refill'] = 0;
        }

        if ($request->has('cancel')) {
            $validated['cancel'] = 1;
        } else {
            $validated['cancel'] = 0;
        }

        if ($request->has('dripfeed')) {
            $validated['dripfeed'] = 1;
        } else {
            $validated['dripfeed'] = 0;
        }

        // Handle sync options - use request->boolean() to properly convert checkbox values
        $validated['sync_rate'] = $request->boolean('sync_rate', false);
        $validated['sync_min_max'] = $request->boolean('sync_min_max', false);
        $validated['sync_action'] = $request->boolean('sync_action', false);

        // Handle service_api field
        if (isset($validated['type']) && $validated['type'] === 'manual') {
            // Manual mode: force null for provider fields regardless of what was sent
            $validated['provider_id'] = null;
            $validated['provider_name'] = null;
            $validated['service_api'] = null;
            // Force update these fields even if not in validated array
            $service->provider_id = null;
            $service->provider_name = null;
            $service->service_api = null;
        } elseif (isset($validated['provider_service_id']) && $validated['provider_service_id']) {
            $validated['service_api'] = $validated['provider_service_id'];
        } elseif ($request->has('service_api') && $request->input('service_api')) {
            $validated['service_api'] = $request->input('service_api');
        }

        // Handle attributes conversion
        try {
            $validated['attributes'] = $this->processAttributesField($request->input('attributes'));
            
            // Log attributes
            \Log::info('=== UPDATE SERVICE ATTRIBUTES ===', [
                'service_id' => $serviceId,
                'attributes_input' => $request->input('attributes'),
                'attributes_processed' => [
                    'array' => $validated['attributes'],
                    'isEmpty' => empty($validated['attributes']),
                    'type' => 'array',
                    'json' => json_encode($validated['attributes'])
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error processing attributes', [
                'service_id' => $serviceId,
                'attributes_input' => $request->input('attributes'),
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Lỗi xử lý thuộc tính: ' . $e->getMessage()
            ], 500);
        }

        // Handle reaction field - normalize and validate
        if ($request->has('reaction')) {
            try {
                $validated['reaction'] = $this->processReactionField($request->input('reaction'));
                
                \Log::info('=== UPDATE SERVICE REACTION ===', [
                    'service_id' => $serviceId,
                    'reaction_input' => $request->input('reaction'),
                    'reaction_processed' => $validated['reaction']
                ]);
            } catch (\Exception $e) {
                \Log::error('Error processing reaction', [
                    'service_id' => $serviceId,
                    'reaction_input' => $request->input('reaction'),
                    'error' => $e->getMessage()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Lỗi xử lý reaction: ' . $e->getMessage()
                ], 500);
            }
        }

        // Update service
        try {
            $service->update($validated);
            
            // Log after update
            \Log::info('=== SERVICE UPDATED ===', [
                'service_id' => $service->id,
                'attributes_saved' => [
                    'array' => $service->attributes,
                    'isEmpty' => empty($service->attributes),
                    'type' => 'array',
                    'json' => json_encode($service->attributes)
                ],
                'updated_fields' => array_keys($validated)
            ]);
        } catch (\Exception $e) {
            \Log::error('Error updating service', [
                'service_id' => $serviceId,
                'validated_data' => $validated,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Lỗi khi lưu dịch vụ: ' . $e->getMessage()
            ], 500);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => 'Cập nhật dịch vụ thành công!',
                'service' => $service->fresh()
            ]);
        }
        
        return redirect()->route('admin.services.index')
            ->with('success', "Dịch vụ <strong>{$service->getName()}</strong> đã được cập nhật thành công!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Service $service)
    {
        $serviceName = $service->getName();
        $service->delete();
        $message = "Đã xóa dịch vụ {$serviceName} thành công!";

        return $request->expectsJson()
            ? response()->json(['success' => true, 'message' => $message])
            : redirect()->route('admin.services.index')->with('success', $message);
    }

    /**
     * Get categories for AJAX requests
     */
    public function getCategories(Request $request)
    {
        $categories = Category::with('platform:id,name,image')
            ->where('domain', getDomain())
            ->whereHas('platform')
            ->select('id', 'name', 'platform_id', 'image')
            ->get();

        return response()->json([
            'success' => true,
            'categories' => $categories->map(function($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->getName(),
                    'platform_name' => optional($category->platform)->name ?? 'N/A',
                    'platform_image' => optional($category->platform)->image,
                    'image' => $category->image,
                    'search_text' => strtolower((optional($category->platform)->name ?? 'N/A') . ' ' . $category->getName())
                ];
            })
        ]);
    }

    /**
     * Get languages for AJAX requests
     */
    public function getLanguages(Request $request)
    {
        $languages = \App\Models\Language::where('status', true)
            ->where('code', '!=', 'en')
            ->where('domain', getDomain())
            ->orderBy('code')
            ->select('id', 'name', 'code', 'flag')
            ->get();

        return response()->json([
            'success' => true,
            'languages' => $languages
        ]);
    }

    /**
     * Get providers for AJAX requests
     */
    public function getProviders(Request $request)
    {
        $providers = \App\Models\ApiProvider::where('domain', getDomain())
            ->where('status', true)
            ->orderBy('name')
            ->select('id', 'name', 'url')
            ->get();

        return response()->json([
            'success' => true,
            'providers' => $providers
        ]);
    }

    /**
     * Get providers for a specific category
     */
    public function getProvidersByCategory(Request $request, $categoryId)
    {
        try {
            $category = Category::findOrFail($categoryId);
            
            // Get all services in this category
            $services = Service::where('cat_id', $categoryId)
                ->where('domain', getDomain())
                ->distinct()
                ->pluck('provider_id')
                ->filter()
                ->toArray();
            
            // Get providers that have services in this category
            $providers = \App\Models\ApiProvider::whereIn('id', $services)
                ->where('domain', getDomain())
                ->where('status', true)
                ->orderBy('name')
                ->select('id', 'name', 'url')
                ->get();
            
            // If no providers found, return all providers
            if ($providers->isEmpty()) {
                $providers = \App\Models\ApiProvider::where('domain', getDomain())
                    ->where('status', true)
                    ->orderBy('name')
                    ->select('id', 'name', 'url')
                    ->get();
            }
            
            return response()->json([
                'success' => true,
                'providers' => $providers,
                'category_id' => $categoryId
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get provider services using Smm class with caching
     */
    public function getProviderServices(Request $request, $providerId)
    {
        try {
            // Validate provider ID
            if (!$providerId || !is_numeric($providerId)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid provider ID'
                ], 400);
            }

            // Get provider
            $provider = \App\Models\ApiProvider::where('domain', getDomain())
                ->where('id', $providerId)
                ->where('status', true)
                ->first();

            if (!$provider) {
                return response()->json([
                    'success' => false,
                    'message' => 'Provider not found or inactive'
                ], 404);
            }

            // Validate provider credentials
            if (empty($provider->link) || empty($provider->api_key)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Provider API URL or API Key is not configured'
                ], 422);
            }

            // Try to get from cache first (5 minutes)
            $cacheKey = 'provider_services_' . $providerId . '_' . md5($provider->link);
            $cachedServices = \Cache::get($cacheKey);
            
            if ($cachedServices !== null) {
                return response()->json([
                    'success' => true,
                    'services' => $cachedServices,
                    'count' => count($cachedServices),
                    'cached' => true
                ]);
            }

            // Initialize Smm and set credentials
            $smm = new \App\Smm\Smm();
            $smm->api_url = $provider->link;
            $smm->api_key = $provider->api_key;

            // Get services from provider
            $services = $smm->services();

            // Convert object to array if needed
            if (is_object($services)) {
                $services = json_decode(json_encode($services), true);
            }

            // Validate response
            if (!is_array($services)) {
                \Log::warning('Invalid response from provider', [
                    'provider_id' => $providerId,
                    'response_type' => gettype($services),
                    'response' => is_string($services) ? $services : json_encode($services)
                ]);
                
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid response from provider'
                ], 500);
            }

            // Transform services data - return full service information
            $transformedServices = collect($services)->map(function ($s) {
                // Ensure $s is an array
                if (is_object($s)) {
                    $s = json_decode(json_encode($s), true);
                }
                
                return [
                    'id' => $s['service'] ?? $s['id'] ?? null,
                    'name' => $s['name'] ?? 'Unknown',
                    'rate' => floatval($s['rate'] ?? 0),
                    'min' => intval($s['min'] ?? 1),
                    'max' => intval($s['max'] ?? 10000),
                    'type' => $s['type'] ?? 'Default',
                    'platform' => $s['platform'] ?? null,
                    'category' => $s['category'] ?? null,
                    'refill' => isset($s['refill']) ? (bool)$s['refill'] : false,
                    'cancel' => isset($s['cancel']) ? (bool)$s['cancel'] : false,
                    'dripfeed' => isset($s['dripfeed']) ? (bool)$s['dripfeed'] : false,
                    'title' => $s['title'] ?? null,
                    'description' => $s['description'] ?? null,
                ];
            })->filter(function ($s) {
                return !is_null($s['id']) && $s['rate'] > 0;
            })->values()->toArray();

            // Cache the result for 5 minutes
            \Cache::put($cacheKey, $transformedServices, now()->addMinutes(5));

            return response()->json([
                'success' => true,
                'services' => $transformedServices,
                'count' => count($transformedServices),
                'cached' => false
            ]);
        } catch (\Exception $e) {
            \Log::error('Error fetching provider services', [
                'provider_id' => $providerId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch services: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Sync service data from API
     */
    public function syncFromApi(Request $request, Service $service)
    {
        try {
            if (!$service->hasApiService()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Service is not linked to an API service'
                ], 400);
            }

            $synced = $service->syncFromApi();

            if ($synced) {
                return response()->json([
                    'success' => true,
                    'message' => 'Service synced successfully from API',
                    'service' => $service->fresh()
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Failed to sync service from API'
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error syncing service: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Sync all services from provider
     */
    public function syncProviderServices(Request $request, $providerId)
    {
        try {
            $result = \App\Models\ServiceApi::syncFromProvider($providerId);

            return response()->json($result);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error syncing provider services: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Toggle service status
     */
    public function toggleStatus(Request $request, Service $service)
    {
        try {
            $newStatus = $request->input('status', !$service->status);
            $newStatus = is_string($newStatus) ? filter_var($newStatus, FILTER_VALIDATE_BOOLEAN) : (bool) $newStatus;
            
            $service->update(['status' => $newStatus]);
            
            return response()->json([
                'success' => 'Update Successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Service status toggle failed', [
                'service_id' => $service->id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật trạng thái'
            ], 500);
        }
    }
}