<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('PUT')) {
            return $this->handleBulkOperations($request);
        }

        $query = Payment::query()->with('paymentMethod');

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Payment method filter
        if ($request->filled('payment_method_id')) {
            $query->withPaymentMethod($request->payment_method_id);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->ordered()->get();
        $paymentMethods = PaymentMethod::active()->ordered()->get();

        return view('admin.payments.index', compact('payments', 'paymentMethods'));
    }

    public function create(): View
    {
        $paymentMethods = PaymentMethod::active()->ordered()->get();
        return view('admin.payments.create', compact('paymentMethods'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'name' => 'required|string|max:255',
            'min' => 'required|numeric|min:0',
            'max' => 'required|numeric|gt:min',
            'note' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_input' => 'nullable|url|max:500',
            'status' => 'nullable|boolean',
            'bonus' => 'nullable|json',
            
            // Vietnamese Bank fields
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'signature' => 'nullable|string|max:255',
            'webhook_url' => 'nullable|url',
            
            // Binance fields
            'binance_id' => 'nullable|string|max:255',
            'api_key' => 'nullable|string|max:255',
            'secret_key' => 'nullable|string|max:255',
            
            // Payeer fields
            'merchant_id' => 'nullable|string|max:255',
            'success_url' => 'nullable|url',
            'fail_url' => 'nullable|url',
            'status_url' => 'nullable|url',
        ]);

        $payment = new Payment();
        $payment->fill($validated);
        
        // Handle status checkbox
        $payment->status = $request->has('status') ? 1 : 0;
        $payment->domain = request()->getHost();

        // Handle bonus JSON
        if ($request->filled('bonus')) {
            try {
                $payment->bonus = json_decode($request->bonus, true);
            } catch (\Exception $e) {
                return back()->withErrors(['bonus' => 'Invalid JSON format for bonus configuration.'])->withInput();
            }
        }

        // Handle image
        $imageResult = $this->handleImageUpload($request, null);
        if ($imageResult['error']) {
            return back()->withErrors(['image_input' => $imageResult['message']])->withInput();
        }
        if ($imageResult['image']) {
            $payment->image = $imageResult['image'];
        }

        // Generate signature if not provided
        if (empty($payment->signature)) {
            $payment->signature = hash('sha256', $payment->name . time() . rand(1000, 9999));
        }

        // Save first to get ID
        $payment->save();

        // Generate and save webhook URL after getting ID
        $payment->webhook_url = url("/webhook/sieuthicode?type={$payment->id}");
        $payment->save();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Tài khoản thanh toán đã được tạo thành công! Webhook URL: ' . $payment->webhook_url);
    }

    public function show(Payment $payment): JsonResponse
    {
        $payment->load('paymentMethod');
        return response()->json($payment);
    }

    public function edit(Payment $payment): View
    {
        $paymentMethods = PaymentMethod::active()->ordered()->get();
        return view('admin.payments.edit', compact('payment', 'paymentMethods'));
    }

    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $validated = $request->validate([
            'payment_method_id' => 'required|exists:payment_methods,id',
            'name' => 'required|string|max:255',
            'min' => 'required|numeric|min:0', 
            'max' => 'required|numeric|gt:min',
            'note' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_input' => 'nullable|url|max:500',
            'status' => 'boolean',
            'bonus' => 'nullable|json',
            
            // Vietnamese Bank fields
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'signature' => 'nullable|string|max:255',
            'webhook_url' => 'nullable|url',
            
            // Binance fields
            'binance_id' => 'nullable|string|max:255',
            'api_key' => 'nullable|string|max:255',
            'secret_key' => 'nullable|string|max:255',
            
            // Payeer fields
            'merchant_id' => 'nullable|string|max:255',
            'success_url' => 'nullable|url',
            'fail_url' => 'nullable|url',
            'status_url' => 'nullable|url',
        ]);

        $payment->fill($validated);
        
        // Handle status checkbox
        $payment->status = $request->has('status') ? 1 : 0;

        // Handle bonus JSON
        if ($request->filled('bonus')) {
            try {
                $payment->bonus = json_decode($request->bonus, true);
            } catch (\Exception $e) {
                return back()->withErrors(['bonus' => 'Invalid JSON format for bonus configuration.'])->withInput();
            }
        }

        // Handle image
        $imageResult = $this->handleImageUpload($request, $payment);
        if ($imageResult['error']) {
            return back()->withErrors(['image_input' => $imageResult['message']])->withInput();
        }
        if ($imageResult['image']) {
            $payment->image = $imageResult['image'];
        }

        // Generate signature if not provided
        if (empty($payment->signature)) {
            $payment->signature = hash('sha256', $payment->name . time() . rand(1000, 9999));
        }

        // Update webhook URL to ensure it's current
        $payment->webhook_url = url("/webhook/sieuthicode?type={$payment->id}");

        $payment->save();

        return redirect()->route('admin.payments.index')
            ->with('success', 'Tài khoản thanh toán đã được cập nhật thành công! Webhook URL: ' . $payment->webhook_url);
    }

    public function destroy(Payment $payment): JsonResponse
    {
        if (!$payment->canDelete()) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa thanh toán này vì đang có giao dịch liên quan!'
            ], 400);
        }

        // Delete image
        if ($payment->image && !filter_var($payment->image, FILTER_VALIDATE_URL)) {
            \Storage::disk('public')->delete('payments/' . $payment->image);
        }

        $payment->delete();

        return response()->json([
            'success' => true,
            'message' => 'Thanh toán đã được xóa thành công!'
        ]);
    }

    public function toggleStatus(Payment $payment): JsonResponse
    {
        $payment->toggleStatus();

        return response()->json([
            'success' => true,
            'status' => $payment->status ? 1 : 0,
            'message' => 'Trạng thái đã được cập nhật thành công!'
        ]);
    }

    private function handleBulkOperations(Request $request): JsonResponse
    {
        if ($request->has('action') && $request->action === 'reorder') {
            $payments = $request->input('payments', []);
            
            if (Payment::reorder(collect($payments)->pluck('id')->toArray())) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thứ tự đã được cập nhật thành công!'
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Có lỗi xảy ra khi xử lý yêu cầu!'
        ], 400);
    }

    /**
     * Handle image upload or URL input
     */
    private function handleImageUpload(Request $request, ?Payment $payment = null): array
    {
        // Upload file
        if ($request->hasFile('image')) {
            // Delete old image if updating and it's a file (not URL)
            if ($payment && $payment->image && !filter_var($payment->image, FILTER_VALIDATE_URL)) {
                \Storage::disk('public')->delete('payments/' . $payment->image);
            }

            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('payments', $filename, 'public');
            
            return ['error' => false, 'image' => $filename];
        }
        
        // Use URL
        if ($request->filled('image_input')) {
            $imageUrl = trim($request->image_input);
            if (!filter_var($imageUrl, FILTER_VALIDATE_URL)) {
                return ['error' => true, 'message' => 'URL hình ảnh không hợp lệ.'];
            }

            // Delete old image if updating and it's a file (not URL)
            if ($payment && $payment->image && !filter_var($payment->image, FILTER_VALIDATE_URL)) {
                \Storage::disk('public')->delete('payments/' . $payment->image);
            }

            return ['error' => false, 'image' => $imageUrl];
        }

        return ['error' => false, 'image' => null];
    }
}