<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerifyCsrfToken extends Middleware
{
    /**
     * Routes được loại trừ khỏi CSRF verification
     */
    protected $except = [
        'webhook/*',
    ];

    /**
     * Handle the request
     */
    public function handle(Request $request, \Closure $next)
    {
        // Kiểm tra xem request có cần CSRF verification không
        if ($this->shouldSkipCsrf($request)) {
            return $next($request);
        }

        // Log CSRF verification attempts trong development
        if (config('app.debug')) {
            Log::debug('CSRF Verification', [
                'path' => $request->path(),
                'method' => $request->method(),
                'has_token' => $request->has('_token'),
                'has_bearer' => (bool) $request->bearerToken(),
                'ip' => $request->ip(),
            ]);
        }

        return parent::handle($request, $next);
    }

    /**
     * Kiểm tra xem request có nên bỏ qua CSRF verification không
     */
    protected function shouldSkipCsrf(Request $request): bool
    {
        // Bỏ qua GET, HEAD, OPTIONS requests
        if ($request->isMethodSafe()) {
            return true;
        }

        // Bỏ qua webhook routes
        if ($request->is('webhook/*')) {
            Log::debug('CSRF skipped: Webhook route', [
                'path' => $request->path(),
            ]);
            return true;
        }

        // Bỏ qua API routes với bearer token
        if ($request->is('api/*') && $request->bearerToken()) {
            Log::debug('CSRF skipped: API with bearer token', [
                'path' => $request->path(),
            ]);
            return true;
        }

        return false;
    }

    /**
     * Xử lý CSRF token mismatch
     */
    protected function tokensMatch($request)
    {
        $token = $request->input('_token') ?: $request->bearerToken();

        if (!$token) {
            Log::warning('CSRF Token Missing', [
                'path' => $request->path(),
                'method' => $request->method(),
                'ip' => $request->ip(),
            ]);
            return false;
        }

        // Log token validation
        if (config('app.debug')) {
            Log::debug('CSRF Token Validation', [
                'path' => $request->path(),
                'has_token' => true,
            ]);
        }

        return parent::tokensMatch($request);
    }
}
