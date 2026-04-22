<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Webhook\PaymentWebhookController;

/*
|--------------------------------------------------------------------------
| Webhook Routes
|--------------------------------------------------------------------------
|
| These routes are loaded without CSRF protection and other web middleware
| to handle external webhook calls from payment providers.
|
*/

// Payment webhook routes
Route::get('/webhook/sieuthicode', [PaymentWebhookController::class, 'handlePayment'])
    ->name('webhook.sieuthicode.get');
Route::post('/webhook/sieuthicode', [PaymentWebhookController::class, 'handlePayment'])
    ->name('webhook.sieuthicode');

// Test webhook endpoint
Route::get('/webhook/test', [PaymentWebhookController::class, 'test'])
    ->name('webhook.test');
Route::post('/webhook/test', [PaymentWebhookController::class, 'test'])
    ->name('webhook.test.post');