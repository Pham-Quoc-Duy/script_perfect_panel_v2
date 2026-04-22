<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptimizeResponse
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only add headers to successful responses
        if ($response->isSuccessful() || $response->isRedirection()) {
            // Add cache headers for static assets
            if ($request->is('*.css', '*.js', '*.png', '*.jpg', '*.jpeg', '*.gif', '*.svg', '*.woff', '*.woff2')) {
                $response->header('Cache-Control', 'public, max-age=31536000, immutable');
            }

            // Add security headers
            $response->header('X-Content-Type-Options', 'nosniff');
            $response->header('X-Frame-Options', 'SAMEORIGIN');
            $response->header('X-XSS-Protection', '1; mode=block');
        }

        return $response;
    }
}
