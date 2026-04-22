<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        // Build query with domain filter
        $query = Transaction::query()->with('user')->where('domain', $request->getHost());

        $transactions = $query->orderBy('created_at', 'desc')->paginate($request->get('per_page', 15));

        return $request->expectsJson() 
            ? response()->json(['success' => true, 'data' => $transactions])
            : view('admin.payments.transactions', compact('transactions'));
    }
}