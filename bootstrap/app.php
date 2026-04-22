<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            // Web (client / public)
            __DIR__ . '/../routes/web.php',

            // Admin (đã tự prefix + middleware bên trong)
            __DIR__ . '/../routes/admin.php',
        ],
        api: __DIR__ . '/../routes/api.php',
        channels: __DIR__ . '/../routes/channels.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // Webhook routes without middleware
            Route::middleware([])->group(base_path('routes/webhook.php'));
            
            // Cron routes
            Route::prefix('cron')->group(base_path('routes/crons.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // Alias middleware (clean & explicit)
        $middleware->alias([
            'auth' => \App\Http\Middleware\VerifyAuth::class,
            'client' => \App\Http\Middleware\Client::class,
            'admin'  => \App\Http\Middleware\Admin::class,
            'locale' => \App\Http\Middleware\SetLocale::class,
        ]);

        // Add optimization middleware
        $middleware->append(\App\Http\Middleware\OptimizeResponse::class);
        
        // Add locale middleware to web group
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
