<?php

namespace App\Http\Middleware;

use App\Models\Config;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return abort(401, 'Unauthorized');
        }

        $site = Config::where('domain', $request->getHost())->first();
        $user = Auth::user();
        
        // if ($user->role !== 'admin' || Auth::id() !== (int) $site->user_id) {
        //     return abort(403, 'Forbidden');
        // }
        if ($user->role !== 'admin') {
            return abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
