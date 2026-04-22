<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\DataController;
use App\Http\Controllers\Client\ViewController;
use App\Http\Controllers\Client\EventController;
use App\Http\Controllers\CacheController;
use Illuminate\Support\Facades\Route;

// ============================================
// All other routes with Client Middleware
// ============================================
Route::middleware(['client'])->group(function () {

    Route::get('/', function () {
        if (auth()->check()) {
            return redirect()->route('clients.new');
        }
        return view('landing-page.lang-1');
    })->name('landing');

    Route::get('/install', [AuthController::class, 'showInstall'])->name('install');
    Route::post('/install', [AuthController::class, 'install'])->name('install.store');

    Route::get('/signin', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/signin', [AuthController::class, 'login'])->name('login.store');

    Route::get('/signup', [AuthController::class, 'showRegister'])->name('signup');
    Route::post('/signup', [AuthController::class, 'register'])->name('signup.store');

    Route::get('/resetpassword', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/resetpassword', [AuthController::class, 'sendResetLink'])->name('password.email');

    Route::get('/logout', function () {
        Auth::logout();
        return redirect()->route('login');
    })->name('logout');

    // ============================================
    // Protected Client Routes (Authenticated users only)
    // ============================================
    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/new', [ViewController::class, 'index'])->name('clients.new');
        Route::get('/dashboard', [ViewController::class, 'index'])->name('clients.dashboard');

        // Orders
        Route::prefix('orders')->name('clients.orders.')->group(function () {
            Route::get('/', [ViewController::class, 'ordersIndex'])->name('index');
            Route::get('search', [ViewController::class, 'ordersIndex'])->name('search');
            Route::get('refunds', [ViewController::class, 'refundsIndex'])->name('refunds');
            Route::get('{status}', [ViewController::class, 'ordersIndex'])->name('status')
                ->where('status', 'pending|processing|inprogress|completed|partial|canceled');
            Route::get('{id}', [ViewController::class, 'ordersShow'])->name('show');
            Route::post('create', [DataController::class, 'createOrder'])->name('store');
            Route::get('{id}/refill', [DataController::class, 'orderAction'])->name('refill');
            Route::get('{id}/cancel', [DataController::class, 'orderAction'])->name('cancel');
            Route::post('{id}/report', [DataController::class, 'orderReport'])->name('report');
        });

        Route::prefix('services')->name('clients.services.')->group(function () {
            Route::get('/', [ViewController::class, 'servicesIndex'])->name('index');
            Route::get('{id}', [ViewController::class, 'servicesShow'])->name('show');
        });

        // API Documentation
        Route::get('/api', [ViewController::class, 'apiIndex'])->name('clients.api.index');
        Route::get('/apidoc', [ViewController::class, 'apiIndex'])->name('clients.api.index');

        // Add Funds
        Route::get('/addfunds', [ViewController::class, 'addFundsIndex'])->name('clients.addfunds.index');
        Route::get('/addfunds/invoice/{id}', [ViewController::class, 'invoiceView'])->name('clients.addfunds.invoice');
        Route::get('/addfunds/{ref}', [ViewController::class, 'addFundsPayment'])->name('clients.addfunds.payment');

        // Refill
        Route::get('/refill', [ViewController::class, 'refillIndex'])->name('clients.refill.refill');
        Route::get('/refill/{status}', [ViewController::class, 'refillIndex'])->name('clients.refill.status')
            ->where('status', 'all|pending|inprogress|completed|rejected|error');

        // Cashflow
        Route::get('/cashflow', [ViewController::class, 'cashflowIndex'])->name('clients.cashflow.index');

        // Update (service sync logs)
        Route::get('/update', [ViewController::class, 'updateIndex'])->name('clients.update.index');

        // Products
        Route::get('/products', [ViewController::class, 'productsIndex'])->name('clients.products.index');
        Route::get('/products/{slug}', [ViewController::class, 'productShow'])->name('clients.products.show');
        Route::post('/product-order/{id}', [DataController::class, 'createOrderProduct'])->name('clients.products.order');
        Route::get('/product_orders', [ViewController::class, 'productOrdersIndex'])->name('clients.product_orders.index');

        // Affiliates
        Route::get('/affiliates', [ViewController::class, 'affiliatesIndex'])->name('clients.affiliates.index');

        // Child Panel
        Route::get('/child-panel', [ViewController::class, 'childPanelIndex'])->name('clients.childpanel.index');
        Route::get('/childpanel', [ViewController::class, 'childPanelIndex'])->name('clients.childpanel.index');
        Route::post('/child-panel', [DataController::class, 'createChildPanel'])->name('clients.childpanel.store');

        // Tickets
        Route::prefix('tickets')->name('clients.tickets.')->group(function () {
            Route::get('/', [ViewController::class, 'ticketsIndex'])->name('index');
            Route::post('create', [DataController::class, 'createTicket'])->name('store');
            Route::get('{id}', [ViewController::class, 'ticketsShow'])->name('show');
            Route::post('{id}/reply', [DataController::class, 'replyTicket'])->name('reply');
            Route::put('{id}/close', [DataController::class, 'closeTicket'])->name('close');
            Route::get('{id}/messages', [DataController::class, 'getTicketMessages'])->name('messages');
        });
 
        // Alias /viewticket/{id} -> tickets show
        Route::get('/viewticket/{id}', [ViewController::class, 'ticketsShow'])->name('clients.viewticket');

        // Mass Order — accessible via both /massorder and /mass
        Route::get('/massorder', [ViewController::class, 'massOrderIndex'])->name('clients.massorder.index');
        Route::get('/mass', [ViewController::class, 'massOrderIndex'])->name('clients.mass.index');

        // Account Management
        Route::prefix('account')->name('clients.account.')->group(function () {
            Route::get('/', [ViewController::class, 'accountIndex'])->name('index');
            Route::post('update-currency', [DataController::class, 'updateCurrency'])->name('update-currency');
            Route::post('update-language', [DataController::class, 'updateLanguage'])->name('update-language');
            Route::post('update-timezone', [DataController::class, 'updateTimezone'])->name('update-timezone');
            Route::post('update-email', [DataController::class, 'updateEmail'])->name('update-email');
            Route::post('update-password', [DataController::class, 'updatePassword'])->name('update-password');
            Route::post('2fa-generate', [DataController::class, 'twoFaGenerate'])->name('2fa-generate');
            Route::post('2fa-approve', [DataController::class, 'twoFaApprove'])->name('2fa-approve');
            Route::post('generate-api-key', [DataController::class, 'generateApiKey'])->name('generate-api-key');
        });

        // Settings (alias of account with same actions)
        Route::prefix('settings')->name('clients.settings.')->group(function () {
            Route::get('/', [ViewController::class, 'accountIndex'])->name('index');
            Route::post('update-currency', [DataController::class, 'updateCurrency'])->name('update-currency');
            Route::post('update-language', [DataController::class, 'updateLanguage'])->name('update-language');
            Route::post('update-timezone', [DataController::class, 'updateTimezone'])->name('update-timezone');
            Route::post('update-email', [DataController::class, 'updateEmail'])->name('update-email');
            Route::post('update-password', [DataController::class, 'updatePassword'])->name('update-password');
            Route::post('2fa-generate', [DataController::class, 'twoFaGenerate'])->name('2fa-generate');
            Route::post('2fa-approve', [DataController::class, 'twoFaApprove'])->name('2fa-approve');
            Route::post('generate-api-key', [DataController::class, 'generateApiKey'])->name('generate-api-key');
        });

        // Notifications
        Route::prefix('notifications')->name('clients.notifications.')->group(function () {
            Route::get('/', [ViewController::class, 'notificationsIndex'])->name('index');
            Route::post('connect-telegram', [DataController::class, 'connectTelegram'])->name('connect-telegram');
            Route::post('update', [DataController::class, 'updateNotifications'])->name('update');
        });

        // Cooperate
        Route::get('/cooperate', [ViewController::class, 'cooperateIndex'])->name('clients.cooperate.index');

        // Event Spin
        Route::post('/events/{event}/spin', [EventController::class, 'spin'])->name('clients.events.spin');
    });

    // ============================================
    // Public API Routes (AJAX calls)
    // ============================================
    Route::prefix('api')->name('api.')->group(function () {
        Route::get('categories-by-platform/{platformId}', [DataController::class, 'getCategoriesByPlatform'])->name('categories.by-platform');
        Route::get('services-by-category/{categoryId}', [DataController::class, 'getServicesByCategory'])->name('services.by-category');
        Route::get('categories', [DataController::class, 'getCategoriesByPlatform'])->name('categories.all');

        // Ticket API (for authenticated users)
        Route::middleware('auth')->group(function () {
            Route::get('ticket-categories', [DataController::class, 'getTicketCategories'])->name('clients.api.ticket-categories');
            Route::get('ticket-subcategories', [DataController::class, 'getTicketSubcategories'])->name('clients.api.ticket-subcategories');
        });
    });
});

// ============================================
// Utility Routes (No middleware restrictions)
// ============================================
Route::get('/clear-view-cache', [CacheController::class, 'clearViewCache'])->name('clear.view.cache');
