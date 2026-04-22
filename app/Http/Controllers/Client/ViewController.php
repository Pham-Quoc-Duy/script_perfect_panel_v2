<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ApiProvider;
use App\Models\Category;
use App\Models\Config;
use App\Models\Currency;
use App\Models\Language;
use App\Models\Order;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Platform;
use App\Models\Service;
use App\Models\Ticket;
use App\Models\TicketSubject;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

/**
 * ViewController - Xử lý hiển thị giao diện
 */
class ViewController extends Controller
{
    /**
     * Display dashboard
     */
    public function dashboard(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $user = Auth::user();
        $userLang = $user->lang ?? 'en';
        $currency_code = $user->currency ?? 'USD';

        // Get currency
        $currency = Currency::where('status', true)
            ->where('code', $currency_code)
            ->first();

        if (!$currency) {
            $currency = (object) [
                'code' => 'USD',
                'symbol' => '$',
                'symbol_position' => 'before',
                'exchange_rate' => 1
            ];
        }

        // Get statistics
        $userOrders = Order::where('user_id', $user->id);
        $totalOrders = $userOrders->count();
        $totalSpent = $userOrders->sum('charge');
        $pendingOrders = $userOrders->where('status', 'pending')->count();
        $completedOrders = $userOrders->where('status', 'completed')->count();

        // Format balance
        $balance = $user->balance;
        if ($currency->exchange_rate > 0) {
            $balance = $balance / $currency->exchange_rate;
        }
        $balanceFormatted = ($currency->symbol_position === 'before' ? $currency->symbol : '') . 
                           number_format($balance,8) . 
                           ($currency->symbol_position === 'after' ? $currency->symbol : '');

        // Orders by status for chart
        $ordersByStatus = $userOrders->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Revenue by date (last 30 days)
        $revenueByDate = $userOrders->where('created_at', '>=', now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(charge) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total', 'date')
            ->toArray();

        // Recent orders
        $recentOrders = $userOrders->with(['service.category.platform'])
            ->latest()
            ->limit(5)
            ->get();

        $data = [
            'balance_formatted' => $balanceFormatted,
            'total_orders' => $totalOrders,
            'pending_orders' => $pendingOrders,
            'completed_orders' => $completedOrders,
            'total_spent' => $totalSpent,
            'orders_by_status' => $ordersByStatus,
            'revenue_by_date' => $revenueByDate,
            'recent_orders' => $recentOrders,
            'currency_symbol' => $currency->symbol,
        ];

        return view("clients.theme-{$theme}.dashboard", compact('data'));
    }

    public function index(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $user = Auth::user();
        $userLevel = $user->level ?? 'retail';
        $userLang = $user->lang ?? 'en';
        $currency_code = $user->currency ?? 'USD';

        // Get service ID from URL query parameter or route parameter
        $serviceId = request('service') ?? request('serviceId');
        $selectedService = null;

        // Simplified currency lookup - no domain checking
        $currency = Currency::where('status', true)
            ->where('code', $currency_code)
            ->first();

        // If no currency found, create a default one
        if (!$currency) {
            $currency = (object) [
                'code' => 'USD',
                'symbol' => '$',
                'symbol_position' => 'before',
                'exchange_rate' => 1
            ];
        }

        $serviceFixedDecimals = Service::join(
            'api_providers',
            'services.provider_id',
            '=',
            'api_providers.id'
        )
            ->where('services.status', true)
            ->pluck('api_providers.fixed_decimal', 'services.id');

        $formatNumber = function ($n, $decimals = null) {
            if ($decimals !== null) {
                $n = number_format((float) $n, $decimals, '.', '');
            }

            $n = (string) $n;
            // Xóa các số 0 ở cuối nhưng giữ lại ít nhất một chữ số sau dấu phẩy nếu có
            if (str_contains($n, '.')) {
                $n = rtrim($n, '0');
                // Nếu kết thúc bằng dấu phẩy, xóa nó
                $n = rtrim($n, '.');
            }
            return $n;
        };

        $formatPrice = function ($rate, $serviceId = null) use (
            $currency,
            $currency_code,
            $formatNumber,
            $serviceFixedDecimals
        ) {
            // Lấy fixed_decimal từ Provider của service
            $fixedDecimal = $serviceId && isset($serviceFixedDecimals[$serviceId])
                ? $serviceFixedDecimals[$serviceId]
                : null;

            // Áp dụng exchange rate nếu cần (chia để chuyển đổi)
            if (
                $currency &&
                $currency->code === $currency_code &&
                $currency->exchange_rate > 0
            ) {
                $rate *= $currency->exchange_rate;
            }

            // Format rate theo fixed_decimal của Provider
            $rate = $formatNumber($rate, $fixedDecimal);

            return ($currency->symbol_position ?? 'before') === 'before'
                ? ($currency->symbol ?? '$') . $rate
                : $rate . ($currency->symbol ?? '$');
        };

        // Platforms - with domain checking
        $platforms = Platform::where('status', true)
            ->orderBy('position', 'asc')
            ->get(['id', 'name', 'image']);

        // Categories + xử lý tên đa ngôn ngữ - with domain checking
        $categories = Category::where('status', true)
            ->orderBy('position')
            ->get(['id', 'name', 'platform_id', 'image'])
            ->map(fn($c) => [
                'id' => $c->id,
                'name' => $c->name[$userLang] ?? $c->name['en'] ?? reset($c->name),
                'platform_id' => $c->platform_id,
                'image' => $c->image,
            ])
            ->values();

        // Services + rate theo level + tên đa ngôn ngữ - with domain checking
        $services = Service::where('status', true)
            ->orderBy('position', 'asc')
            ->get()
            ->map(function ($svc) use ($userLevel, $userLang, $formatPrice) {
                // Rate theo level
                $rateField = match ($userLevel) {
                    'agent' => 'rate_agent',
                    'distributor' => 'rate_distributor',
                    default => 'rate_retail'
                };

                $rate = $svc->{$rateField} ?? $svc->rate_retail ?? 0;

                // Tên đa ngôn ngữ - name is cast to json, so it's already an array
                $name = $svc->name;
                if (is_array($name)) {
                    $name = $name[$userLang] ?? $name['en'] ?? reset($name) ?? '';
                }
                $name = (string) $name;

                // Ensure all fields are strings, not arrays
                $description = $svc->description ?? '';
                if (is_array($description)) {
                    $description = json_encode($description);
                }
                $description = (string) $description;

                $note = $svc->note ?? '';
                if (is_array($note)) {
                    $note = json_encode($note);
                }
                $note = (string) $note;

                $averageTime = $svc->average_time ?? '';
                if (is_array($averageTime)) {
                    $averageTime = json_encode($averageTime);
                }
                $averageTime = (string) $averageTime;

                $title = $svc->title ?? '';
                if (is_array($title)) {
                    $title = json_encode($title);
                }
                $title = (string) $title;

                $attributes = $svc->attributes ?? '';
                if (is_array($attributes)) {
                    $attributes = json_encode($attributes);
                }
                $attributes = (string) $attributes;

                return [
                    'id' => $svc->id,
                    'name' => $name,
                    'image' => $svc->image,
                    'title' => $title,
                    'category_id' => $svc->category_id,
                    'description' => $description,
                    'note' => $note,
                    'average_time' => $averageTime,
                    'min' => $svc->min ?? 1,
                    'max' => $svc->max ?? 100000,
                    'rate_raw' => (float) $rate,
                    'rate_formatted' => $formatPrice($rate, $svc->id),
                    'position' => $svc->position ?? 0,
                    'attributes' => $attributes,
                    'type_service' => $svc->type_service ?? 'Default',
                    'type_radio' => $svc->type_service ?? '',
                    'refill' => ($svc->refill ?? 0),
                    'cancel' => ($svc->cancel ?? 0),
                    'dripfeed' => ($svc->dripfeed ?? 0),
                ];
            })
            ->values();

        $data = [
            'platforms' => $platforms,
            'categories' => $categories,
            'services' => $services,
            'selectedService' => $serviceId ? $services->firstWhere('id', (int) $serviceId) : null,
        ];

        return view("clients.theme-{$theme}.new", compact('data'));
    }

    /**
     * Display services list
     */
    public function servicesIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $user = Auth::user();
        $userLevel = $user->level ?? 'retail';
        $userLang = $user->lang ?? 'en';
        $currency_code = $user->currency ?? 'USD';

        // Simplified currency lookup
        $currency = Currency::where('status', true)
            ->where('code', $currency_code)
            ->first();

        if (!$currency) {
            $currency = (object) [
                'code' => 'USD',    
                'symbol' => '$',
                'symbol_position' => 'before',
                'exchange_rate' => 1
            ];
        }

        $serviceFixedDecimals = Service::join('api_providers', 'services.provider_id', '=', 'api_providers.id')
            ->where('services.status', true)
            ->pluck('api_providers.fixed_decimal', 'services.id');

        $formatNumber = function ($n, $decimals = null) {
            if ($decimals !== null) {
                $n = number_format((float) $n, $decimals, '.', '');
            }
            $n = (string) $n;
            // Xóa các số 0 ở cuối nhưng giữ lại ít nhất một chữ số sau dấu phẩy nếu có
            if (str_contains($n, '.')) {
                $n = rtrim($n, '0');
                // Nếu kết thúc bằng dấu phẩy, xóa nó
                $n = rtrim($n, '.');
            }
            return $n;
        };

        $formatPrice = function ($rate, $serviceId = null) use ($currency, $currency_code, $formatNumber, $serviceFixedDecimals) {
            $fixedDecimal = $serviceId && isset($serviceFixedDecimals[$serviceId]) ? $serviceFixedDecimals[$serviceId] : null;

            if ($currency && $currency->code === $currency_code && $currency->exchange_rate > 0) {
                $rate *= $currency->exchange_rate;
            }

            $rate = $formatNumber($rate, $fixedDecimal);
            return ($currency->symbol_position ?? 'before') === 'before'
                ? ($currency->symbol ?? '$') . $rate
                : $rate . ($currency->symbol ?? '$');
        };

        // Get categories - simplified
        $categories = Category::where('status', true)
            ->whereHas('services', fn($q) => $q->where('status', true))
            ->orderBy('position')
            ->get()
            ->map(fn($c) => [
                'id' => $c->id,
                'name' => $c->name[$userLang] ?? $c->name['en'] ?? reset($c->name),
                'image' => $c->image,
                'platform_id' => $c->platform_id,
            ]);

        // Get services - simplified
        $services = Service::where('status', true)
            ->orderBy('position', 'asc')
            ->get()
            ->map(function ($svc) use ($userLevel, $userLang, $formatPrice) {
                $rateField = match ($userLevel) {
                    'agent' => 'rate_agent',
                    'distributor' => 'rate_distributor',
                    default => 'rate_retail'
                };

                $rate = $svc->{$rateField} ?? $svc->rate_retail ?? 0;

                // Tên đa ngôn ngữ - name is cast to json, so it's already an array
                $name = $svc->name;
                if (is_array($name)) {
                    $name = $name[$userLang] ?? $name['en'] ?? reset($name) ?? '';
                }
                $name = (string) $name;

                // Ensure all fields are strings, not arrays
                $description = $svc->description ?? '';
                if (is_array($description)) {
                    $description = json_encode($description);
                }
                $description = (string) $description;

                $averageTime = $svc->average_time ?? '';
                if (is_array($averageTime)) {
                    $averageTime = json_encode($averageTime);
                }
                $averageTime = (string) $averageTime;

                return [
                    'id' => $svc->id,
                    'name' => $name,
                    'category_id' => $svc->category_id,
                    'image' => $svc->image ? asset($svc->image) : null,
                    'description' => $description,
                    'min' => $svc->min ?? 1,
                    'max' => $svc->max ?? 100000,
                    'rate_formatted' => $formatPrice($rate, $svc->id),
                    'average_time' => $averageTime,
                    'attributes' => is_array($svc->attributes) ? $svc->attributes : (json_decode($svc->attributes ?? '[]', true) ?? []),
                ];
            });

        // Group services by category_id
        $groupedServices = $services->groupBy('category_id');

        $platforms = Platform::where('status', true)->orderBy('position')->get(['id', 'name', 'image']);

        return view("clients.theme-{$theme}.services.index", compact('categories', 'services', 'groupedServices', 'platforms'));
    }

    /**
     * Display service details
     */
    public function servicesShow($id): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $service = Service::where('status', true)
            ->where('id', $id)
            ->with(['category.platform'])
            ->firstOrFail();

        return view("clients.theme-{$theme}.services.show", compact('service'));
    }

    /**
     * Display orders list
     */
    public function ordersIndex(string $status = null): View
    {
        $config = Config::first();
        $theme  = $config ? ($config->default_interface ?? 'default') : 'default';

        $user     = auth()->user();
        $userLang = $user->lang ?? 'en';

        // Currency của user
        $currency = Currency::where('status', true)
            ->where('code', $user->currency ?? 'USD')
            ->first();
        if (!$currency) {
            $currency = (object)['symbol' => '$', 'symbol_position' => 'before', 'exchange_rate' => 1, 'code' => 'USD'];
        }
        $sym    = $currency->symbol;
        $symPos = $currency->symbol_position ?? 'before';
        $exRate = (float) ($currency->exchange_rate ?? 1);

        $query = Order::where('user_id', $user->id)->with('service');

        // Status từ route segment hoặc query param
        $status = $status ?? request('status');
        if ($status && !in_array($status, ['', 'all'])) {
            $query->where('status', $status);
        }

        // Date range từ start/end params
        $start = request('start');
        $end   = request('end');
        if ($start && $end) {
            $query->whereBetween('created_at', [
                str_replace('/', '-', $start) . ' 00:00:00',
                str_replace('/', '-', $end)   . ' 23:59:59',
            ]);
        }

        // Search
        $type    = request('type', '0');
        $keyword = request('keyword');
        if ($keyword) {
            $query->where(function ($q) use ($type, $keyword) {
                match ($type) {
                    '1' => $q->where('id', 'like', "%{$keyword}%"),
                    '2' => $q->where('link', 'like', "%{$keyword}%"),
                    '3' => $q->where('service_id', 'like', "%{$keyword}%"),
                    default => $q->where('id', 'like', "%{$keyword}%")
                                 ->orWhere('link', 'like', "%{$keyword}%")
                                 ->orWhere('service_id', 'like', "%{$keyword}%"),
                };
            });
        }

        $orders = $query->latest()->paginate(20)->withQueryString();

        // Format name + charge trong controller — view chỉ echo
        $orders->getCollection()->transform(function ($order) use ($userLang, $sym, $symPos, $exRate) {
            // Service name theo ngôn ngữ user
            $name = $order->service->name ?? 'N/A';
            if (is_array($name)) {
                $name = $name[$userLang] ?? $name['en'] ?? reset($name) ?? 'N/A';
            }
            $order->service_name = (string) $name;

            // Charge: DB lưu USD → convert sang currency user
            $amount = $exRate > 0 ? (float) $order->charge * $exRate : (float) $order->charge;
            $str    = rtrim(rtrim(number_format($amount, 8, '.', ''), '0'), '.');
            if ($str === '' || $str === '.') $str = '0';
            $order->charge_display = $symPos === 'before' ? $sym . $str : $str . ' ' . $sym;

            return $order;
        });

        return view("clients.theme-{$theme}.orders.index", compact('orders'));
    }

    /**
     * Display order details
     */
    public function ordersShow($id): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $order = Order::where('user_id', auth()->id())
            ->where('id', $id)
            ->with(['service.category.platform'])
            ->firstOrFail();

        return view("clients.theme-{$theme}.orders.show", compact('order'));
    }

    /**
     * Display API documentation
     */
    public function apiIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        return view("clients.theme-{$theme}.api.index");
    }

    /**
     * Display add funds page
     */
    public function addFundsIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $user = Auth::user();
        $currencyCode = $user->currency ?? 'USD';

        $currency = Currency::where('status', true)->where('code', $currencyCode)->first();
        if (!$currency) {
            $currency = (object)[
                'code' => 'USD', 'symbol' => '$',
                'symbol_position' => 'before', 'exchange_rate' => 1,
            ];
        }

        $nonDecimalCodes = Currency::where('status', true)
            ->whereIn('code', ['VND', 'JPY', 'KRW', 'IDR', 'CLP', 'HUF', 'TWD'])
            ->pluck('code')->toArray();

        // Get active payment methods
        $payments = PaymentMethod::active()->ordered()->get();

        // Get current user's payment transactions
        $transactions = Payment::where('user_id', $user->id)
            ->with('paymentMethod')
            ->ordered()
            ->get();

        return view("clients.theme-{$theme}.addfunds.index", compact('payments', 'transactions', 'currency', 'nonDecimalCodes'));
    }

    /**
     * Display invoice page for a payment
     */
    public function invoiceView(int $id): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $payment = Payment::where('id', $id)
            ->where('user_id', Auth::id())
            ->with('paymentMethod')
            ->firstOrFail();

        return view("clients.theme-{$theme}.addfunds.invoice", compact('payment', 'config'));
    }

    /**
     * Display bank transfer payment page
     */ 
    public function addFundsPayment(string $ref): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $amount = request('amount');
        $paymentId = request('payment_id');

        $payment = null;
        if ($paymentId) {
            $payment = PaymentMethod::find($paymentId);
        }

        // Fallback: get first active bank_vn method
        if (!$payment) {
            $payment = PaymentMethod::active()
                ->whereIn('type', ['bank_vn', 'bank'])
                ->first();
        }

        return view("clients.theme-{$theme}.addfunds.payment", compact('ref', 'amount', 'payment'));
    }

    /**
     * Display refill page
     */
    public function refillIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $query = Order::where('user_id', auth()->id())
            ->whereIn('refill_status', ['pending', 'completed', 'rejected'])
            ->with(['service.category.platform']);

        // Filter by refill_status if provided (từ /refill/{status} hoặc ?status=)
        $status = request()->route('status') ?? request('status');
        if ($status && $status !== 'all') {
            $query->where('refill_status', $status);
        }

        // Search functionality
        $search = request('keyword', request('search'));
        $type   = request('type', '0');
        if ($search) {
            $query->where(function ($q) use ($search, $type) {
                if ($type == '1') {
                    // Refill ID = orders.id
                    $q->where('id', $search);
                } elseif ($type == '2') {
                    // Order ID = orders_api
                    $q->where('orders_api', 'like', "%{$search}%");
                } else {
                    // All fields
                    $q->where('id', 'like', "%{$search}%")
                      ->orWhere('orders_api', 'like', "%{$search}%")
                      ->orWhere('link', 'like', "%{$search}%")
                      ->orWhereHas('service', fn($sq) => $sq->where('name', 'like', "%{$search}%"));
                }
            });
        }

        $refills = $query->latest()->paginate(20);

        return view("clients.theme-{$theme}.refill.index", compact('refills'));
    }

    /**
     * Display product orders page
     */
    public function productOrdersIndex(): View
    {
        $config = Config::first();
        $theme  = $config ? ($config->default_interface ?? 'default') : 'default';
        $user   = Auth::user();

        $currency = Currency::where('status', true)->where('code', $user->currency ?? 'USD')->first();
        if (!$currency) {
            $currency = (object)['symbol' => '$', 'symbol_position' => 'before', 'exchange_rate' => 1, 'code' => 'USD'];
        }
        $sym    = $currency->symbol;
        $symPos = $currency->symbol_position ?? 'before';
        $exRate = (float)($currency->exchange_rate ?? 1);

        $orders = \App\Models\ProductOrder::where('user_id', $user->id)
            ->where('domain', getDomain())
            ->with('product')
            ->latest()
            ->paginate(20);

        return view("clients.theme-{$theme}.product_orders.index", compact('orders', 'sym', 'symPos', 'exRate'));
    }

    /**
     * Display products page
     */
    public function productsIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $categoryId = request('category');
        $keyword    = request('keyword');

        $categories = ProductCategory::where('domain', getDomain())
            ->where('status', true)
            ->orderBy('position')
            ->get();

        $query = Product::where('domain', getDomain())
            ->where('status', true)
            ->with('category', 'group')
            ->orderBy('position');

        if ($categoryId) {
            $query->where('product_category_id', $categoryId);
        }
        if ($keyword) {
            $query->where('name', 'like', "%{$keyword}%");
        }

        // Group by product_group_id for display
        $products = $query->get()->groupBy('product_group_id');
        $groups   = \App\Models\ProductGroup::where('domain', getDomain())
            ->orderBy('position')->get()->keyBy('id');

        return view("clients.theme-{$theme}.products.index", compact('categories', 'products', 'groups'));
    }

    /**
     * Display product detail page
     */
    public function productShow(string $slug): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $product = Product::where('domain', getDomain())
            ->where('slug', $slug)
            ->where('status', true)
            ->firstOrFail();

        return view("clients.theme-{$theme}.products.show", compact('product'));
    }

    /**
     * Display update (service sync logs) page
     */
    public function updateIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $logs = \App\Models\ServiceSyncLog::forDomain()
            ->with('service')
            ->latest()
            ->paginate(50);

        return view("clients.theme-{$theme}.update.index", compact('logs'));
    }

    /**
     * Display cashflow page
     */
    public function cashflowIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        $user = Auth::user();

        $orderId = request('id');

        $currency = Currency::where('status', true)
            ->where('code', $user->currency ?? 'USD')
            ->first();
        if (!$currency) {
            $currency = (object)['symbol' => '$', 'symbol_position' => 'before', 'exchange_rate' => 1, 'code' => 'USD'];
        }
        $sym    = $currency->symbol;
        $symPos = $currency->symbol_position ?? 'before';
        $exRate = (float)($currency->exchange_rate ?? 1);

        $query = Transaction::where('user_id', $user->id)
            ->where('domain', getDomain())
            ->latest();

        if ($orderId) {
            $query->where('order_id', $orderId);
        }

        $transactions = $query->paginate(50);
        $order = $orderId ? Order::where('user_id', $user->id)->find($orderId) : null;

        return view("clients.theme-{$theme}.cashflow.index", compact('transactions', 'orderId', 'order', 'sym', 'symPos', 'exRate'));
    }

    /**
     * Display affiliates page
     */
    public function affiliatesIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        
        return view("clients.theme-{$theme}.affiliates.index", [
            'config' => $config
        ]);
    }

    /**
     * Display refunds page
     */
    public function refundsIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $query = Order::where('user_id', auth()->id())
            ->whereIn('status', ['canceled', 'partial'])
            ->where('charge', '>', 0)
            ->with(['service.category.platform']);

        // Filter by order status if provided
        $orderStatus = request('order_status');
        if ($orderStatus && $orderStatus !== 'all') {
            $query->where('status', $orderStatus);
        }

        // Search functionality
        $search = request('search');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q
                    ->where('id', 'like', "%{$search}%")
                    ->orWhere('link', 'like', "%{$search}%");
            });
        }

        // Filter by last 90 days (optional, can be removed for testing)
        if (request('show_all') !== '1') {
            $query->where('created_at', '>=', now()->subDays(90));
        }

        $refunds = $query->latest()->paginate(20);

        return view("clients.theme-{$theme}.refunds.index", compact('refunds'));
    }

    /**
     * Display child panel page
     */
    public function childPanelIndex(): View
    {
        $config = Config::first();
        $theme  = $config ? ($config->default_interface ?? 'default') : 'default';

        $user         = Auth::user();
        $currencyCode = $user->currency ?? 'USD';
        $baseCost     = (float) ($config->child_panel_cost ?? 0);

        // Tính cost theo currency của user
        $currency = Currency::where('status', true)->where('code', $currencyCode)->first();
        $rate     = $currency ? (float) $currency->exchange_rate : 1;
        $costFormatted = $rate > 1
            ? number_format($baseCost * $rate, 0, '.', ',') . ' ' . $currencyCode
            : '$' . number_format($baseCost, 2);

        return view("clients.theme-{$theme}.childpanel.index", compact('config', 'costFormatted', 'currencyCode'));
    }

    /**
     * Display tickets page
     */
    public function ticketsIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        // Load ticket subjects
        $ticketSubjects = TicketSubject::active()->ordered()->get();
        $categories = $ticketSubjects->pluck('category')->unique()->values();
        $categoriesData = $categories;

        $query = Auth::user()
            ->tickets()
            ->with(['ticketSubject'])
            ->withCount(['replies as unread_count' => function ($query) {
                $query->whereNull('read_at')->where('is_admin', true);
            }]);

        // Filter by status if provided
        if (request('status')) {
            $query->where('status', request('status'));
        }

        // Search functionality
        if (request('search')) {
            $search = request('search');
            $query->where('subject', 'like', "%{$search}%");
        }

        $tickets = $query
            ->orderBy('last_reply_at', 'desc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view("clients.theme-{$theme}.tickets.index", compact('tickets', 'ticketSubjects', 'categories', 'categoriesData'));
    }

    /**
     * Display create ticket page
     */
    public function ticketsCreate(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        return view("clients.theme-{$theme}.tickets.create");
    }

    /**
     * Display ticket details
     */
    public function ticketsShow($id): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $ticket = Auth::user()
            ->tickets()
            ->with(['user', 'assignedTo', 'ticketSubject', 'replies.user'])
            ->findOrFail($id);

        // Mark admin replies as read
        $ticket
            ->replies()
            ->where('is_admin', true)
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view("clients.theme-{$theme}.tickets.show", compact('ticket'));
    }

    /**
     * Display mass order page
     */
    public function massOrderIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        return view("clients.theme-{$theme}.mass.index");
    }

    /**
     * Display account page
     */
    public function accountIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';

        $user = Auth::user();
        $userLang = $user->lang ?? 'en';
        $userTimezone = $user->timezone ?? '0';

        $languages = Language::where('status', true)->get(['code', 'name'])->toArray();
        if (empty($languages)) {
            $languages = [
                ['code' => 'en', 'name' => 'English'],
                ['code' => 'vi', 'name' => 'Vietnam'],
            ];
        }
        $timezones = (new \App\Helpers\Timezone())->getTimezones();
        $currencies = Currency::where('status', true)->orderBy('code')->get(['id', 'code', 'name', 'symbol', 'exchange_rate', 'symbol_position']);

        $data = [
            'lang'          => $userLang,
            'languages'     => $languages,
            'timezone'      => $userTimezone,
            'timezones'     => $timezones,
            'currencies'    => $currencies,
            'user_currency' => $user->currency ?? 'USD',
            'login_history' => \App\Models\ActivityLog::where('user_id', $user->id)
                                ->where('type', 'login')
                                ->latest('created_at')
                                ->limit(20)
                                ->get(['activity', 'created_at'])
                                ->map(function ($log) {
                                    $act = $log->activity ?? [];
                                    if (!is_array($act)) $act = json_decode($act, true) ?? [];
                                    return [
                                        'time' => $log->created_at->format('Y-m-d H:i'),
                                        'ip'   => $act['ip_address'] ?? '—',
                                        'ua'   => $act['user_agent'] ?? '—',
                                    ];
                                }),
        ];

        $settingsView = "clients.theme-{$theme}.settings.index";
        $accountView  = "clients.theme-{$theme}.account.index";
        $viewName = view()->exists($settingsView) ? $settingsView : $accountView;

        return view($viewName, compact('data'));
    }

    public function notificationsIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        return view("clients.theme-{$theme}.account.notifications");
    }

    /**
     * Display cooperate page
     */
    public function cooperateIndex(): View
    {
        $config = Config::first();
        $theme = $config ? ($config->default_interface ?? 'default') : 'default';
        return view("clients.theme-{$theme}.cooperate.index");
    }
}
