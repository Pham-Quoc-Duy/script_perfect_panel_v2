<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiV2Controller;
use App\Http\Controllers\Api\ApiAdminV1Controller;
use App\Http\Controllers\Auth\AuthController;

Route::prefix('v2')->group(function () {
    Route::match(['get', 'post'], '/', [ApiV2Controller::class, 'handleAction']);
});

Route::post('/admin/v1', [ApiAdminV1Controller::class, 'handleAction']);
Route::post('/adminapi/v2', [ApiAdminV1Controller::class, 'handleAction']);
Route::post('/oauth_google', [AuthController::class, 'loginGoogle']);