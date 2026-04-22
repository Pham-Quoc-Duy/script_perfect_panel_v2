<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class VerifyAuth
{
    /**
     * Middleware kiểm tra xác thực user
     * Đảm bảo user đã đăng nhập trước khi truy cập route
     */
     public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // If not authenticated, proceed with the request
        return $next($request);
    }
}
