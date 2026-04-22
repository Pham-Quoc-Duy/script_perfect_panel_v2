<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function index()
    {
        $apiKey = auth()->user()?->api_key;
        return view('adminpanel.api.index', compact('apiKey'));
    }

    public function changeKey(Request $request)
    {
        $user   = auth()->user();
        $newKey = Str::random(32);
        $user->update(['api_key' => $newKey]);

        return response()->json(['key' => $newKey]);
    }
}
