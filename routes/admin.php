<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    AnalyticsController,
    ProductController,
    MessageController,
    DashboardController,
    UserController,
    OrderController,
    TransactionController,
    ReportController,
    SettingController,
    PlatformController,
    CategoryController,
    ServiceController,
    ApiProviderController,
    LanguageController,
    CurrencyController,
    PaymentMethodController,
    PaymentController,
    TicketController,
    TicketSubjectController,
    ActivityLogController,
    EventController,
    CronJobController,
    AccountController,
    ServiceSyncLogController,
    AffiliateController,
    ApiController,
    NewsController
};

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Update admin language
    Route::post('update-language', function (\Illuminate\Http\Request $request) {
        $lang = $request->input('lang', 'vi');
        $allowed = ['en', 'vi'];
        if (!in_array($lang, $allowed)) {
            return response()->json(['success' => false, 'message' => 'Invalid language'], 400);
        }
        session(['language' => $lang]);
        if ($user = \Illuminate\Support\Facades\Auth::user()) {
            $user->update(['lang' => $lang]);
        }
        return response()->json(['success' => true, 'lang' => $lang]);
    })->name('update-language');
    
    // Redirect /admin to /admin/orders
    Route::get('/', function () {
        return redirect()->route('admin.orders.index');
    });
    
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::get('product_orders', [ProductController::class, 'product_orders'])->name('products.orders.index');
    Route::get('product_orders/{status}', [ProductController::class, 'product_orders'])->name('products.orders.status')
        ->where('status', 'manual|awaiting|failed|pending|inprogress|completed|partial|canceled');
    Route::post('product_orders/{id}/status', [ProductController::class, 'updateOrderStatus'])->name('products.orders.update_status');
    Route::post('product_orders/{id}/result', [ProductController::class, 'updateOrderResult'])->name('products.orders.update_result');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/warehouse', [ProductController::class, 'warehouse'])->name('products.warehouse');
    Route::get('products/add', [ProductController::class, 'add'])->name('products.add');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::post('products/reorder', [ProductController::class, 'reorder'])->name('products.reorder');
    Route::post('products/category', [ProductController::class, 'storeCategory'])->name('products.category.store');
    Route::post('products/group', [ProductController::class, 'storeGroup'])->name('products.group.store');
    Route::get('products/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    
    // Users Management
    // Route::prefix('users')->name('users.')->group(function () {
    //     Route::get('/', [UserController::class, 'index'])->name('index');
    //     Route::put('/', [UserController::class, 'index'])->name('bulk-update'); // For bulk operations
    //     Route::get('/create', [UserController::class, 'create'])->name('create');
    //     Route::post('/', [UserController::class, 'store'])->name('store');
    //     Route::get('/{user}', [UserController::class, 'show'])->name('show');
    //     Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    //     Route::put('/{user}', [UserController::class, 'update'])->name('update');
    //     Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    //     Route::post('/{user}/update-balance', [UserController::class, 'updateBalance'])->name('update-balance');
    // });

    Route::prefix('accounts')->name('accounts.')->group(function () {
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::put('/', [AccountController::class, 'index'])->name('bulk-update'); // For bulk operations
        Route::post('/', [AccountController::class, 'store'])->name('store');
        Route::get('/{username}/payment', [AccountController::class, 'payment'])->name('payment');
        Route::get('/{username}/customrates', [AccountController::class, 'customRates'])->name('customrates');
        Route::get('/{username}/signinhistory', [AccountController::class, 'signInHistory'])->name('signinhistory');
        Route::get('/{username}/transactions', [AccountController::class, 'transactions'])->name('transactions');
        Route::get('/{username}/affiliates', [AccountController::class, 'affiliates'])->name('affiliates');
        Route::get('/{username}', [AccountController::class, 'show'])->name('show');
        Route::put('/{accounts}', [AccountController::class, 'update'])->name('update');
        Route::delete('/{accounts}', [AccountController::class, 'destroy'])->name('destroy');
        Route::post('/{accounts}/update-balance', [AccountController::class, 'updateBalance'])->name('update-balance');
    });

    Route::prefix('platform')->name('platform.')->group(function () {
        Route::get('/', [PlatformController::class, 'index'])->name('index');
        Route::put('/', [PlatformController::class, 'index'])->name('bulk-update'); // For bulk operations
        Route::get('/create', [PlatformController::class, 'create'])->name('create');
        Route::post('/', [PlatformController::class, 'store'])->name('store');
        Route::get('/{platform}', [PlatformController::class, 'show'])->name('show');
        Route::get('/{platform}/edit', [PlatformController::class, 'edit'])->name('edit');
        Route::put('/{platform}', [PlatformController::class, 'update'])->name('update');
        Route::delete('/{platform}', [PlatformController::class, 'destroy'])->name('destroy');
        
        // API routes
        Route::post('/{platform}/toggle-status', [PlatformController::class, 'toggleStatus'])->name('toggle-status');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::put('/', [CategoryController::class, 'index'])->name('bulk-update');
        Route::get('/add', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        
        // API routes
        Route::post('/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('toggle-status');
    });

    Route::prefix('services')->name('services.')->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::put('/', [ServiceController::class, 'index'])->name('bulk-update'); // For bulk operations
        Route::get('/add', [ServiceController::class, 'add'])->name('add');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/', [ServiceController::class, 'store'])->name('store');
        
        // Import routes - GET for form, POST for processing
        Route::get('/import', [ServiceController::class, 'import'])->name('import');
        Route::post('/import', [ServiceController::class, 'storeImport'])->name('import.store');
        
        // Edit and Update routes with query string
        Route::get('/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/edit', [ServiceController::class, 'update'])->name('update');
        
        // Provider services API routes
        Route::get('/provider/{provider}/services', [ServiceController::class, 'getProviderServices'])->name('provider-services');
        Route::post('/provider/{provider}/sync', [ServiceController::class, 'syncProviderServices'])->name('sync-provider');
        
        // Categories API route
        Route::get('/categories', [ServiceController::class, 'getCategories'])->name('categories');
        
        // Languages API route
        Route::get('/languages', [ServiceController::class, 'getLanguages'])->name('languages');
        
        // Providers API route
        Route::get('/providers', [ServiceController::class, 'getProviders'])->name('providers');
        
        // Providers by category API route
        Route::get('/providers-by-category/{category}', [ServiceController::class, 'getProvidersByCategory'])->name('providers-by-category');
        
        // Individual service routes
        Route::get('/{service}', [ServiceController::class, 'show'])->name('show');
        Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
        Route::post('/{service}/sync-api', [ServiceController::class, 'syncFromApi'])->name('sync-api');
        
        // API routes
        Route::post('/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('toggle-status');
    });

    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::post('/', [OrderController::class, 'index'])->name('bulk-action'); // For bulk operations
        Route::get('/{status}', [OrderController::class, 'index'])->name('status')
            ->where('status', 'manual|failed|awaiting|ticket|pending|processing|inprogress|completed|partial|canceled');
        Route::get('/{orders}/edit', [OrderController::class, 'edit'])->name('edit')->where('orders', '[0-9]+');
        Route::put('/{orders}', [OrderController::class, 'update'])->name('update')->where('orders', '[0-9]+');
        Route::post('/{orders}/update-status', [OrderController::class, 'updateOrderStatus'])->name('update-status-order');
        Route::post('/{orders}/resend', [OrderController::class, 'resendOrder'])->name('resend-order');
        Route::post('/update-status-provider', [OrderController::class, 'updateOrderStatusProvider'])->name('update-status-provider');
        Route::delete('/{orders}', [OrderController::class, 'destroy'])->name('destroy')->where('orders', '[0-9]+');
    });

    Route::prefix('language')->name('language.')->group(function () {
        Route::get('/', [LanguageController::class, 'index'])->name('index');
        Route::get('/create', [LanguageController::class, 'create'])->name('create');
        Route::post('/', [LanguageController::class, 'store'])->name('store');
        Route::get('/{language}', [LanguageController::class, 'show'])->name('show');
        Route::get('/{language}/edit', [LanguageController::class, 'edit'])->name('edit');
        Route::put('/{language}', [LanguageController::class, 'update'])->name('update');
        Route::delete('/{language}', [LanguageController::class, 'destroy'])->name('destroy');
        
        // API routes
        Route::post('/{language}/toggle-status', [LanguageController::class, 'toggleStatus'])->name('toggle-status');
    });

    Route::prefix('currency')->name('currency.')->group(function () {
        Route::get('/', [CurrencyController::class, 'index'])->name('index');
        Route::get('/create', [CurrencyController::class, 'create'])->name('create');
        Route::post('/', [CurrencyController::class, 'store'])->name('store');
        
        // API routes - phải đặt trước route {currency}
        Route::post('/fetch-rates', [CurrencyController::class, 'fetchRates'])->name('fetch-rates');
        Route::post('/update-rates', [CurrencyController::class, 'updateRates'])->name('update-rates');
        Route::post('/update-currencies', [CurrencyController::class, 'updateCurrencies'])->name('update-currencies');
        
        Route::get('/{currency}', [CurrencyController::class, 'show'])->name('show');
        Route::get('/{currency}/edit', [CurrencyController::class, 'edit'])->name('edit');
        Route::put('/{currency}', [CurrencyController::class, 'update'])->name('update');
        Route::delete('/{currency}', [CurrencyController::class, 'destroy'])->name('destroy');
        Route::post('/{currency}/toggle-status', [CurrencyController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{currency}/toggle-sync', [CurrencyController::class, 'toggleSync'])->name('toggle-sync');
    });

    // Payments Management
    Route::prefix('payments')->name('payments.')->group(function () {
        // Payment Methods sub-routes
        Route::prefix('methods')->name('method.')->group(function () {
            Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
            Route::put('/', [PaymentMethodController::class, 'index'])->name('bulk-update'); // For bulk operations and reorder
            Route::get('/create', [PaymentMethodController::class, 'create'])->name('create');
            Route::post('/', [PaymentMethodController::class, 'store'])->name('store');
            Route::put('/{paymentMethod}', [PaymentMethodController::class, 'update'])->name('update');
            Route::delete('/{paymentMethod}', [PaymentMethodController::class, 'destroy'])->name('destroy');
            Route::get('/{paymentMethod}', [PaymentMethodController::class, 'show'])->name('show');
            Route::post('/{paymentMethod}/toggle-status', [PaymentMethodController::class, 'toggleStatus'])->name('toggle-status');
        });
        // Payment transactions routes
        Route::get('/history', [PaymentMethodController::class, 'history'])->name('history');
        Route::get('/history-data', [PaymentMethodController::class, 'historyData'])->name('history-data');
    });

    

    // API Providers Management
    Route::prefix('providers')->name('providers.')->group(function () {
        Route::get('/', [ApiProviderController::class, 'index'])->name('index');
        Route::put('/', [ApiProviderController::class, 'index'])->name('bulk-update'); // For bulk operations and reordering
        Route::get('/create', [ApiProviderController::class, 'create'])->name('create');
        Route::post('/', [ApiProviderController::class, 'store'])->name('store');
        Route::get('/{providers}', [ApiProviderController::class, 'show'])->name('show');
        Route::get('/{providers}/edit', [ApiProviderController::class, 'edit'])->name('edit');
        Route::put('/{providers}', [ApiProviderController::class, 'update'])->name('update');
        Route::delete('/{providers}', [ApiProviderController::class, 'destroy'])->name('destroy');
        Route::post('/{providers}/balance', [ApiProviderController::class, 'getBalance'])->name('balance');
        Route::post('/{providers}/toggle-status', [ApiProviderController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/sync-all-balances', [ApiProviderController::class, 'syncAllBalances'])->name('sync-all-balances');
    });

    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::delete('/reply/{reply}', [TicketController::class, 'deleteReply'])->name('reply.destroy');
        Route::get('/user/{username}', [TicketController::class, 'showByUsername'])->name('show.username');
        Route::get('/user/{username}/new-messages', [TicketController::class, 'getNewMessagesByUsername'])->name('new-messages.username');
        Route::post('/user/{username}/reply', [TicketController::class, 'replyByUsername'])->name('reply.username');
        // Route truy cập trực tiếp bằng username: /admin/messages/{username}
        Route::get('/{username}', [TicketController::class, 'indexByUsername'])->name('index.username')
            ->where('username', '[a-zA-Z][a-zA-Z0-9_.-]*');
        Route::post('/{messages}/reply', [TicketController::class, 'reply'])->name('reply');
        Route::put('/{messages}/status', [TicketController::class, 'updateStatus'])->name('update-status');
        Route::put('/{messages}/assign', [TicketController::class, 'assign'])->name('assign');
        Route::delete('/{messages}', [TicketController::class, 'destroy'])->name('destroy');
    });

    // Tickets list (order tickets)
    Route::get('tickets', [TicketController::class, 'ticketList'])->name('tickets.index');
    Route::post('tickets/update-status', [TicketController::class, 'updateTicketStatus'])->name('tickets.update-status');

    // News
    Route::get('news', [NewsController::class, 'index'])->name('news.index');
    Route::post('news', [NewsController::class, 'store'])->name('news.store');
    Route::get('news/{news}', [NewsController::class, 'show'])->name('news.show');
    Route::put('news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    // Ticket Subjects Management
    Route::prefix('ticket-subjects')->name('ticket-subjects.')->group(function () {
        Route::get('/', [TicketSubjectController::class, 'index'])->name('index');
        Route::get('/create', [TicketSubjectController::class, 'create'])->name('create');
        Route::post('/', [TicketSubjectController::class, 'store'])->name('store');
        Route::get('/{ticketSubject}', [TicketSubjectController::class, 'show'])->name('show');
        Route::get('/{ticketSubject}/edit', [TicketSubjectController::class, 'edit'])->name('edit');
        Route::put('/{ticketSubject}', [TicketSubjectController::class, 'update'])->name('update');
        Route::delete('/{ticketSubject}', [TicketSubjectController::class, 'destroy'])->name('destroy');
        Route::patch('/{ticketSubject}/toggle-status', [TicketSubjectController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/reorder', [TicketSubjectController::class, 'reorder'])->name('reorder');
        
        // API endpoint for getting subcategories
        Route::get('/api/subcategories', [TicketSubjectController::class, 'getSubcategories'])->name('api.subcategories');
    });

    // Orders Management
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    
    // Transactions Management
    Route::get('transactions', [TransactionController::class, 'index'])->name('transactions.index');
    
    // Events Management
    Route::resource('events', EventController::class);
    Route::post('events/{event}/toggle-status', [EventController::class, 'toggleStatus'])->name('events.toggle-status');
    Route::get('events-history', [EventController::class, 'history'])->name('events.history');
    
    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/analytics', [ReportController::class, 'analytics'])->name('analytics');
        Route::get('/export', [ReportController::class, 'export'])->name('export');
    });

    // Affiliates
    Route::prefix('affiliates')->name('affiliates.')->group(function () {
        Route::get('/', [AffiliateController::class, 'index'])->name('index');
        Route::post('/', [AffiliateController::class, 'store'])->name('store');
        Route::get('/{affiliate}', [AffiliateController::class, 'show'])->name('show');
        Route::put('/{affiliate}', [AffiliateController::class, 'update'])->name('update');
        Route::delete('/{affiliate}', [AffiliateController::class, 'destroy'])->name('destroy');
    });

    // Admin API docs
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('/', [ApiController::class, 'index'])->name('index');
        Route::post('/change-key', [ApiController::class, 'changeKey'])->name('change-key');
    });
    
    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'general'])->name('general');
        Route::get('/general', [SettingController::class, 'general'])->name('general');
        Route::get('/theme', [SettingController::class, 'theme'])->name('theme');
        Route::get('/design', [SettingController::class, 'design'])->name('design');
        Route::get('/price', [SettingController::class, 'price'])->name('price');
        Route::get('/service', [SettingController::class, 'service'])->name('service');
        Route::get('/product', [SettingController::class, 'product'])->name('product');
        Route::get('/language', [SettingController::class, 'language'])->name('language');
        Route::get('/currency', [SettingController::class, 'currency'])->name('currency');
        Route::get('/support', [SettingController::class, 'support'])->name('support');
        Route::get('/security', [SettingController::class, 'security'])->name('security');
        Route::get('/smtp', [SettingController::class, 'smtp'])->name('smtp');
        Route::get('/modules', [SettingController::class, 'modules'])->name('modules');
        Route::get('/social', [SettingController::class, 'social'])->name('social');
        Route::get('/pricing', [SettingController::class, 'pricing'])->name('pricing');
        Route::get('/notifications', [SettingController::class, 'notifications'])->name('notifications');
        Route::get('/email', [SettingController::class, 'email'])->name('email');
        Route::get('/advanced', [SettingController::class, 'advanced'])->name('advanced');
        Route::get('/keep-orders', [SettingController::class, 'keepOrders'])->name('keep-orders');
        Route::get('/cloudflare', [SettingController::class, 'cloudflare'])->name('cloudflare');
        
        Route::put('/general', [SettingController::class, 'updateGeneral'])->name('update.general');
        Route::put('/terms', [SettingController::class, 'updateTerms'])->name('update.terms');
        Route::put('/theme', [SettingController::class, 'updateTheme'])->name('update.theme');
        Route::put('/design', [SettingController::class, 'updateDesign'])->name('update.design');
        Route::put('/price', [SettingController::class, 'updatePrice'])->name('update.price');
        Route::put('/service', [SettingController::class, 'updateService'])->name('update.service');
        Route::put('/social', [SettingController::class, 'updateSocial'])->name('update.social');
        Route::put('/pricing', [SettingController::class, 'updatePricing'])->name('update.pricing');
        Route::put('/notifications', [SettingController::class, 'updateNotifications'])->name('update.notifications');
        Route::put('/email', [SettingController::class, 'updateEmail'])->name('update.email');
        Route::put('/advanced', [SettingController::class, 'updateAdvanced'])->name('update.advanced');
        Route::put('/keep-orders', [SettingController::class, 'updateKeepOrders'])->name('update.keep-orders');
        Route::put('/cloudflare', [SettingController::class, 'updateCloudflare'])->name('update.cloudflare');
        Route::post('/upload-logo', [SettingController::class, 'uploadLogo'])->name('upload-logo');
        Route::post('/update-custom-css', [SettingController::class, 'updateCustomCss'])->name('update-custom-css');
        Route::post('/update-currency', [SettingController::class, 'updateCurrency'])->name('update.currency_settings');
        Route::post('/modules/enable', [SettingController::class, 'enableModule'])->name('modules.enable');
        Route::post('/modules/config', [SettingController::class, 'updateModuleConfig'])->name('modules.config');
    });

    // Analytics
    Route::get('analytics', [AnalyticsController::class, 'index'])->name('analytics.index');

    // Activity Logs
    Route::get('activity', [ActivityLogController::class, 'index'])->name('activity.index');

    // Service Sync Logs
    Route::prefix('service_sync_logs')->name('service_sync_logs.')->group(function () {
        Route::get('/', [ServiceSyncLogController::class, 'index'])->name('index');
        Route::get('/data', [ServiceSyncLogController::class, 'data'])->name('data');
        Route::post('/mark-read', [ServiceSyncLogController::class, 'markRead'])->name('mark-read');
        Route::post('/{log}/mark-read', [ServiceSyncLogController::class, 'markOne'])->name('mark-one');
    });
    
    // Cron Jobs Management
    Route::prefix('cron-jobs')->name('cron-jobs.')->group(function () {
        Route::get('/', [CronJobController::class, 'index'])->name('index');
        Route::post('/run-status', [CronJobController::class, 'runStatusUpdate'])->name('run-status');
        Route::post('/run-sync', [CronJobController::class, 'runSyncServices'])->name('run-sync');
        Route::post('/run-all', [CronJobController::class, 'runAllProviders'])->name('run-all');
    });

    // Child Panels Management
    Route::prefix('child-panels')->name('child-panels.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\ChildPanelController::class, 'index'])->name('index');
        Route::post('create-domain', [\App\Http\Controllers\Admin\ChildPanelController::class, 'createDomain'])->name('create-domain');
        Route::get('{childPanel}', [\App\Http\Controllers\Admin\ChildPanelController::class, 'show'])->name('show');
        Route::post('{childPanel}/approve', [\App\Http\Controllers\Admin\ChildPanelController::class, 'approve'])->name('approve');
        Route::post('{childPanel}/suspend', [\App\Http\Controllers\Admin\ChildPanelController::class, 'suspend'])->name('suspend');
        Route::post('{childPanel}/status', [\App\Http\Controllers\Admin\ChildPanelController::class, 'updateStatus'])->name('update-status');
        Route::post('{childPanel}/settings', [\App\Http\Controllers\Admin\ChildPanelController::class, 'updateSettings'])->name('update-settings');
        Route::get('{childPanel}/settings', [\App\Http\Controllers\Admin\ChildPanelController::class, 'getSettings'])->name('get-settings');
        Route::delete('{childPanel}', [\App\Http\Controllers\Admin\ChildPanelController::class, 'destroy'])->name('destroy');
    });
});
