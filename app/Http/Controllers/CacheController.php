<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class CacheController extends Controller
{
    /**
     * Clear view cache
     */
    public function clearViewCache()
    {
        Artisan::call('view:clear');
        
        return response()->json([
            'success' => true,
            'message' => 'View cache cleared successfully!'
        ]);
    }
}
