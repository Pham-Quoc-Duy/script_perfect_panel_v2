<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CronController\CronStatusController;
use App\Http\Controllers\CronController\CronSyncController;
use App\Http\Controllers\CronController\CronBinanceController;

// Cập nhật trạng thái orders theo provider
Route::get('/status/orders', [CronStatusController::class, 'updateOrdersStatus']);

// Đồng bộ services từ API provider
Route::get('/sync/services', [CronSyncController::class, 'syncServices']);

Route::get('/binance/transactions', [CronBinanceController::class, 'binance']);
Route::post('/loop/orders', [CronStatusController::class, 'statusLoopOrders']);
Route::get('/schedule/orders', [CronStatusController::class, 'processScheduledOrders']);

