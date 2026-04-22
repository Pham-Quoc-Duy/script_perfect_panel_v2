<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Cache lang data theo singleton — chỉ đọc file 1 lần/request
        $this->app->singleton('langData', function () {
            $lang = Auth::user()?->lang ?? 'en';
            $file = resource_path("lang/{$lang}.json");
            if (!file_exists($file)) $file = resource_path('lang/en.json');
            return ['lang' => $lang, 'data' => json_decode(file_get_contents($file), true) ?? []];
        });

        View::composer('*', function ($view) {
            $config = Config::where('domain', getDomain())->first();

            $view->with([
                'authUser'             => Auth::user(),
                'config'               => $config ?? new Config(),
                'totalServices'        => Service::count(),
                'totalOrders'          => Order::count(),
                'totalCompletedOrders' => Order::where('status', 'completed')->count(),
            ]);

            if (!Auth::check()) return;

            $user            = Auth::user();
            $currencies      = Currency::active()->orderBy('name')->get(['code', 'symbol', 'name', 'exchange_rate', 'symbol_position']);
            $userCurrencyData = formatUserCurrency($user, $currencies, ['VND', 'JPY', 'KRW']);

            $resolved = $this->app->make('langData');

            $view->with([
                'currencies'      => $currencies,
                'userCurrency'    => $userCurrencyData['currency'],
                'formattedBalance'=> $userCurrencyData['balance'],
                'formattedSpent'  => $userCurrencyData['spent'],
                'userLang'        => $resolved['lang'],
                'langData'        => $resolved['data'],
            ]);
        });
    }
}
