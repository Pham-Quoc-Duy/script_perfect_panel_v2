<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    public function index(Request $request)
    {
        // Trả về view nếu không phải AJAX
        if (!$request->ajax() && !$request->wantsJson()) {
            return view('adminpanel.affiliates.index');
        }

        $query = Affiliate::with(['referrer', 'referred'])->where('domain', $request->getHost());
        
        if ($request->referrer_id) $query->where('referrer_id', $request->referrer_id);
        if ($request->referred_id) $query->where('referred_id', $request->referred_id);
        if ($request->status) $query->where('status', $request->status);
        if ($request->referrer) {
            $query->whereHas('referrer', fn($q) => $q->where('username', 'like', '%' . $request->referrer . '%'));
        }
        
        return response()->json($query->latest()->paginate($request->per_page ?? 15));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'referrer_id' => 'required|exists:users,id',
            'referred_id' => 'required|exists:users,id|different:referrer_id',
            'referral_code' => 'nullable|string|max:255',
            'commission_rate' => 'required|numeric|min:0|max:100',
            'status' => 'required|in:active,inactive,suspended',
            'note' => 'nullable|string'
        ]);
        $validated['domain'] = $request->getHost();

        return response()->json(Affiliate::create($validated), 201);
    }

    public function show(Request $request, $id)
    {
        $affiliate = Affiliate::where('domain', $request->getHost())->findOrFail($id);
        return response()->json($affiliate->load(['referrer', 'referred']));
    }

    public function update(Request $request, $id)
    {
        $affiliate = Affiliate::where('domain', $request->getHost())->findOrFail($id);
        
        $validated = $request->validate([
            'referral_code' => 'nullable|string|max:255',
            'commission_rate' => 'sometimes|numeric|min:0|max:100',
            'status' => 'sometimes|in:active,inactive,suspended',
            'note' => 'nullable|string'
        ]);

        $affiliate->update($validated);
        return response()->json($affiliate);
    }

    public function destroy(Request $request, $id)
    {
        $affiliate = Affiliate::where('domain', $request->getHost())->findOrFail($id);
        $affiliate->delete();
        return response()->json(['message' => 'Affiliate deleted successfully']);
    }
}