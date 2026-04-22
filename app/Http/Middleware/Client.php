<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Closure;

class Client
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            // Lấy thông tin site theo domain
            $site = Config::where('domain', $request->getHost())->first();

            // Không có config - chỉ cho phép vào install
            if (!$site) {
                return $request->path() === 'install' ? $next($request) : redirect(route('install'));
            }

            // Có config - kiểm tra truy cập install
            if ($request->path() === 'install') {
                // Config đầy đủ (status=1 và có user_id) - không cho vào install
                if ($site->status == 1 && $site->user_id) {
                    return redirect('/');
                }
                // Config chưa đầy đủ - chuyển về login
                return redirect(route('login'));
            }

            // Config đầy đủ (status=1 và có user_id) - cho phép truy cập tất cả
            if ($site->status == 1 && $site->user_id) {
                return $next($request);
            }

            // Config chưa đầy đủ - các router khác vẫn vào được bình thường
            return $next($request);
        } catch (\Exception $e) {
            return redirect(route('install'));
        }
    }
}