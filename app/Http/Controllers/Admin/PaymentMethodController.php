<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('PUT')) {
            return $this->handleBulkOperations($request);
        }

        $query = PaymentMethod::query()->withCount('payments');

        // Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $paymentMethods = $query->ordered()->get()->map(function ($method) {
            $config = $method->config ? json_decode($method->config) : null;
            $method->currency = $config->currency ?? 'USD';
            $method->bonus = $config && isset($config->bonus) && $config->bonus;
            $method->config_name = $config->name ?? null;
            $method->account = $config->account ?? null;
            $method->account_name = $config->account_name ?? null;
            return $method;
        });

        return view('adminpanel.payment-methods.index', compact('paymentMethods'));
    }

    public function create(): View
    {
        return view('admin.payment-methods.create');
    }

    public function history(Request $request): View
    {
        $paymentMethods = PaymentMethod::where('status', 1)->get();
        
        // Get default data for today
        $startDate = \Carbon\Carbon::now()->startOfDay();
        $endDate = \Carbon\Carbon::now()->endOfDay();
        
        $payments = \App\Models\Payment::query() 
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with('user', 'paymentMethod')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($payment) {
                return [
                    'account' => $payment->user->username ?? '',
                    'amount' => $payment->amount ?? 0,
                    'bonus_amount' => $payment->bonus_amount ?? 0,
                    'method_name' => $payment->paymentMethod->name ?? '',
                    'created_at' => $payment->created_at->format('Y-m-d H:i:s'),
                    'details' => $payment->note ?? ''
                ];
            });
        
        $total = $payments->sum('amount');
        
        return view('adminpanel.payment-methods.history', compact('paymentMethods', 'payments', 'total'));
    }

    public function historyData(Request $request): JsonResponse
    {
        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $methodId = $request->input('method_id');

            $query = \App\Models\Payment::query();

            // Filter by date range
            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [
                    \Carbon\Carbon::createFromFormat('Y/m/d', $startDate)->startOfDay(),
                    \Carbon\Carbon::createFromFormat('Y/m/d', $endDate)->endOfDay()
                ]);
            }

            // Filter by payment method
            if ($methodId) {
                $query->where('payment_method_id', $methodId);
            }

            $payments = $query->with('user', 'paymentMethod')
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($payment) {
                    return [
                        'account' => $payment->user->username ?? '',
                        'amount' => $payment->amount ?? 0,
                        'bonus_amount' => $payment->bonus_amount ?? 0,
                        'method_name' => $payment->paymentMethod->name ?? '',
                        'created_at' => $payment->created_at->format('Y-m-d H:i:s'),
                        'details' => $payment->note ?? ''
                    ];
                });

            $total = $payments->sum('amount');

            return response()->json([
                'success' => true,
                'data' => $payments,
                'total' => $total
            ]);
        } catch (\Exception $e) {
            \Log::error('Payment history data fetch failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            // Debug: Log request data
            \Log::info('Payment method store request', [
                'all' => $request->all(),
                'has_name' => $request->has('name'),
                'name_value' => $request->input('name')
            ]);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'nullable|string|in:bank_vn,binance,payeer,other',
                'method_payment_id' => 'nullable|integer|min:0|max:20',
                'image' => 'nullable|string',
                'min' => 'nullable|numeric|min:0',
                'max' => 'nullable|numeric|min:0',
                'max_transactions' => 'nullable|integer|min:0',
                'max_total_funds' => 'nullable|numeric|min:0',
                'details' => 'nullable|string',
                'config' => 'nullable|string',
                'bonus' => 'nullable|string'
            ]);

            $paymentMethod = new PaymentMethod();
            $paymentMethod->method_payment_id = $validated['method_payment_id'] ?? null;
            $paymentMethod->name = $validated['name'];
            $paymentMethod->type = $validated['type'] ?? 'other';
            $paymentMethod->image = $validated['image'] ?? null;
            $paymentMethod->min = (float)($validated['min'] ?? 0);
            $paymentMethod->max = (float)($validated['max'] ?? 0);
            $paymentMethod->max_transactions = (int)($validated['max_transactions'] ?? 0);
            $paymentMethod->max_total_funds = (float)($validated['max_total_funds'] ?? 0);
            $paymentMethod->details = $validated['details'] ?? null;
            $paymentMethod->domain = request()->getHost();
            $paymentMethod->status = 1;
            $paymentMethod->position = (PaymentMethod::max('position') ?? 0) + 1;
            
            // Xử lý config - lưu dưới dạng JSON
            if (!empty($validated['config'])) {
                $configData = is_string($validated['config']) 
                    ? json_decode($validated['config'], true) 
                    : $validated['config'];
                
                if (is_array($configData)) {
                    $paymentMethod->config = json_encode($configData, JSON_UNESCAPED_UNICODE);
                } else {
                    $paymentMethod->config = $validated['config'];
                }
            }
            
            // Xử lý bonus - lưu dưới dạng JSON
            if (!empty($validated['bonus'])) {
                $bonusData = is_string($validated['bonus']) 
                    ? json_decode($validated['bonus'], true) 
                    : $validated['bonus'];
                
                if (is_array($bonusData)) {
                    // Chuyển đổi format từ {quantity, percent} sang {min, percent}
                    $formattedBonus = [];
                    foreach ($bonusData as $bonus) {
                        $formattedBonus[] = [
                            'min' => $bonus['quantity'] ?? $bonus['min'] ?? 0,
                            'percent' => $bonus['percent'] ?? 0
                        ];
                    }
                    $paymentMethod->bonus = json_encode($formattedBonus, JSON_UNESCAPED_UNICODE);
                }
            }

            $paymentMethod->save();

            return response()->json([
                'success' => true,
                'message' => 'Phương thức thanh toán đã được tạo thành công!',
                'data' => $paymentMethod
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Payment method validation failed', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . implode(', ', $e->errors()['name'] ?? ['The name field is required.']),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Payment method creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 400);
        }
    }

    public function show(PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->load('payments');
        
        // Parse bonus từ JSON
        if ($paymentMethod->bonus) {
            try {
                $paymentMethod->bonus = json_decode($paymentMethod->bonus, true);
            } catch (\Exception $e) {
                $paymentMethod->bonus = [];
            }
        }
        
        // Parse config từ JSON
        if ($paymentMethod->config) {
            try {
                $paymentMethod->config = json_decode($paymentMethod->config, true);
            } catch (\Exception $e) {
                $paymentMethod->config = [];
            }
        }
        
        return response()->json($paymentMethod);
    }

    public function edit(PaymentMethod $paymentMethod): View
    {
        // Parse JSON fields để hiển thị trong form
        if ($paymentMethod->config) {
            try {
                $paymentMethod->config = json_decode($paymentMethod->config, true);
            } catch (\Exception $e) {
                $paymentMethod->config = [];
            }
        }
        
        if ($paymentMethod->bonus) {
            try {
                $paymentMethod->bonus = json_decode($paymentMethod->bonus, true);
            } catch (\Exception $e) {
                $paymentMethod->bonus = [];
            }
        }
        
        return view('adminpanel.payment-methods.update', compact('paymentMethod'));
    }

    public function update(Request $request, PaymentMethod $paymentMethod): JsonResponse
    {
        try {
            \Log::info('Payment method update request', [
                'method_id' => $paymentMethod->id,
                'content_type' => $request->header('Content-Type'),
                'is_json' => $request->isJson(),
                'all' => $request->all()
            ]);

            // Validate dữ liệu
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'type' => 'nullable|string|in:bank_vn,binance,payeer,other',
                'image' => 'nullable|string',
                'min' => 'nullable|numeric|min:0',
                'max' => 'nullable|numeric|min:0',
                'max_transactions' => 'nullable|integer|min:0',
                'max_total_funds' => 'nullable|numeric|min:0',
                'details' => 'nullable|string',
                'config' => 'nullable|string',
                'bonus' => 'nullable|string'
            ]);

            // Cập nhật các field cơ bản
            $paymentMethod->name = $validated['name'];
            // Chỉ cập nhật type nếu được gửi từ form, nếu không giữ type cũ
            if (!empty($validated['type'])) {
                $paymentMethod->type = $validated['type'];
            }
            $paymentMethod->image = $validated['image'] ?? $paymentMethod->image;
            $paymentMethod->min = (float)($validated['min'] ?? 0);
            $paymentMethod->max = (float)($validated['max'] ?? 0);
            $paymentMethod->max_transactions = (int)($validated['max_transactions'] ?? 0);
            $paymentMethod->max_total_funds = (float)($validated['max_total_funds'] ?? 0);
            $paymentMethod->details = $validated['details'] ?? null;

            // Xử lý config - merge với config cũ để không mất các key hiện có
            if (!empty($validated['config'])) {
                $newConfigData = is_string($validated['config'])
                    ? json_decode($validated['config'], true)
                    : $validated['config'];

                if (is_array($newConfigData)) {
                    $oldConfigData = [];
                    if ($paymentMethod->config) {
                        $decoded = is_string($paymentMethod->config)
                            ? json_decode($paymentMethod->config, true)
                            : $paymentMethod->config;
                        if (is_array($decoded)) {
                            $oldConfigData = $decoded;
                        }
                    }
                    // Giữ key cũ nếu key mới rỗng, ghi đè nếu key mới có giá trị
                    $mergedConfig = $oldConfigData;
                    foreach ($newConfigData as $key => $value) {
                        if ($value !== '' && $value !== null) {
                            $mergedConfig[$key] = $value;
                        } elseif (!isset($mergedConfig[$key])) {
                            $mergedConfig[$key] = $value;
                        }
                    }
                    $paymentMethod->config = json_encode($mergedConfig, JSON_UNESCAPED_UNICODE);
                } else {
                    $paymentMethod->config = $validated['config'];
                }
            }
            
            // Xử lý bonus - lưu dưới dạng JSON
            if (!empty($validated['bonus'])) {
                $bonusData = is_string($validated['bonus']) 
                    ? json_decode($validated['bonus'], true) 
                    : $validated['bonus'];
                
                if (is_array($bonusData)) {
                    // Chuyển đổi format từ {quantity, percent} sang {min, percent}
                    $formattedBonus = [];
                    foreach ($bonusData as $bonus) {
                        $formattedBonus[] = [
                            'min' => $bonus['quantity'] ?? $bonus['min'] ?? 0,
                            'percent' => $bonus['percent'] ?? 0
                        ];
                    }
                    $paymentMethod->bonus = json_encode($formattedBonus, JSON_UNESCAPED_UNICODE);
                }
            }

            $paymentMethod->save();

            return response()->json([
                'success' => true,
                'message' => 'Phương thức thanh toán đã được cập nhật thành công!',
                'data' => $paymentMethod
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Payment method validation failed', [
                'method_id' => $paymentMethod->id,
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . implode(', ', $e->errors()['name'] ?? ['The name field is required.']),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Payment method update failed', [
                'method_id' => $paymentMethod->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ], 400);
        }
    }

    public function destroy(PaymentMethod $paymentMethod): JsonResponse
    {
        if (!$paymentMethod->canDelete()) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xóa phương thức thanh toán này vì đang có thanh toán liên quan!'
            ], 400);
        }

        // Delete image
        if ($paymentMethod->image && !filter_var($paymentMethod->image, FILTER_VALIDATE_URL)) {
            \Storage::disk('public')->delete('payment-methods/' . $paymentMethod->image);
        }

        $paymentMethod->delete();

        return response()->json([
            'success' => true,
            'message' => 'Phương thức thanh toán đã được xóa thành công!'
        ]);
    }

    public function toggleStatus(PaymentMethod $paymentMethod): JsonResponse
    {
        $paymentMethod->toggleStatus();

        return response()->json([
            'success' => true,
            'status' => $paymentMethod->status ? 1 : 0,
            'message' => 'Trạng thái đã được cập nhật thành công!'
        ]);
    }

    private function handleBulkOperations(Request $request): JsonResponse
    {
        try {
            if ($request->has('action') && $request->action === 'reorder') {
                $validated = $request->validate([
                    'payment_methods' => 'required|array',
                    'payment_methods.*.id' => 'required|exists:payment_methods,id',
                    'payment_methods.*.position' => 'required|integer|min:0'
                ]);

                foreach ($validated['payment_methods'] as $methodData) {
                    PaymentMethod::where('id', $methodData['id'])
                        ->update(['position' => $methodData['position']]);
                }

                \Log::info('Payment method positions updated', [
                    'payment_methods' => $validated['payment_methods']
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Update Successfully'
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi xử lý yêu cầu!'
            ], 400);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Reorder validation failed', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Reorder failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request' => $request->all()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra khi cập nhật vị trí: ' . $e->getMessage()
            ], 500);
        }
    }
}