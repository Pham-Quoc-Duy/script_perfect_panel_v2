<?php

namespace App\Http\Controllers\CronController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Payment, User, Transaction, Currency,Recharge};
use Illuminate\Support\Str;

class CronBinanceController extends Controller
{
    public function __invoke(Request $request)
    {
        return $this->handle($request);
    }

    public function binanceStore(Request $request)
    {
        return $this->handle($request);
    }

    public function binance(Request $request)
    {
        // Lấy orderId và expectedAmount từ request
        $orderId = $request->input('orderId');
        $expectedAmount = (float) $request->input('amount', 0);
        
        if (!$orderId) {
            return response()->json([
                'success' => false,
                'message' => 'Thiếu orderId'
            ]);
        }

        // Lấy config từ bảng payments với payment_method type = 'binance'
        $binancePayment = \App\Models\Payment::whereHas('paymentMethod', function($query) {
            $query->where('type', 'binance');
        })->where('status', true)->first();

        if (!$binancePayment) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy cấu hình Binance'
            ]);
        }

        $apiKey    = $binancePayment->api_key;
        $apiSecret = $binancePayment->secret_key;

        if (!$apiKey || !$apiSecret) {
            return response()->json([
                'success' => false,
                'message' => 'Thiếu API Key hoặc Secret Key'
            ]);
        }

        // Gọi API Binance
        $daysBack = 7;
        $endpoint = 'https://api.binance.com/sapi/v1/pay/transactions';
        $nowMs    = (int) (microtime(true) * 1000);
        $startMs  = $nowMs - ($daysBack * 24 * 60 * 60 * 1000);

        $params = [
            'transactionType' => 1,
            'startTime'       => $startMs,
            'endTime'         => $nowMs,
            'limit'           => 100,
            'recvWindow'      => 60000,
            'timestamp'       => $nowMs,
        ];

        ksort($params);
        $query     = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        $signature = hash_hmac('sha256', $query, $apiSecret);
        $url       = $endpoint . '?' . $query . '&signature=' . $signature;

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTPHEADER     => ['X-MBX-APIKEY: ' . $apiKey],
        ]);
        $raw = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode !== 200) {
            return response()->json([
                'success' => false,
                'message' => 'Lỗi kết nối API Binance'
            ]);
        }

        $res = json_decode($raw, true);
        $transactions = $res['data'] ?? [];

        // Tìm transaction theo orderId
        $transaction = null;
        foreach ($transactions as $tx) {
            if (($tx['orderId'] ?? '') == $orderId || ($tx['transactionId'] ?? '') == $orderId) {
                $transaction = $tx;
                break;
            }
        }

        if (!$transaction) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy giao dịch với orderId: ' . $orderId
            ]);
        }

        // Lấy note từ transaction
        $note = $transaction['note'] ?? null;
        if (!$note) {
            return response()->json([
                'success' => false,
                'message' => 'Giao dịch không có note'
            ]);
        }

        // Tìm user theo transfer_code
        $user = User::where('transfer_code', $note)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Không tìm thấy user với transfer_code: ' . $note
            ]);
        }

        // Lấy amount từ fundsDetail
        $fundsDetail = $transaction['fundsDetail'] ?? [];
        $totalAmount = 0;
        foreach ($fundsDetail as $fund) {
            $totalAmount += (float) ($fund['amount'] ?? 0);
        }

        if ($totalAmount <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Số tiền không hợp lệ'
            ]);
        }

        // Kiểm tra amount từ input và amount từ API
        if ($expectedAmount > 0) {
            // Cho phép sai lệch 0.01 (do làm tròn)
            if (abs($totalAmount - $expectedAmount) > 0.01) {
                return response()->json([
                    'success' => false,
                    'message' => 'Số tiền không khớp. Bạn nhập: ' . number_format($expectedAmount, 2) . ' USDT, nhưng giao dịch thực tế: ' . number_format($totalAmount, 2) . ' USDT'
                ]);
            }
        }

        // Kiểm tra giao dịch đã tồn tại chưa
        $existingTransaction = Transaction::where('transaction_id', 'BINANCE_' . $orderId)->first();
        if ($existingTransaction) {
            return response()->json([
                'success' => false,
                'message' => 'Giao dịch đã được xử lý trước đó'
            ]);
        }

        // Cập nhật balance cho user
        DB::beginTransaction();
        try {
            $balanceBefore = $user->balance;
            $user->balance += $totalAmount;
            
            // Tạo transfer_code mới (random)
            $newTransferCode = $this->generateUniqueTransferCode();
            $user->transfer_code = $newTransferCode;
            
            $user->save();

            // Lưu transaction
            Transaction::create([
                'user_id'        => $user->id,
                'transaction_id' => 'BINANCE_' . $orderId,
                'type'           => 'deposit',
                'amount'         => $totalAmount,
                'description'    => 'Nạp tiền Binance - Order: ' . $orderId,
                'status'         => 'completed',
                'payment_method' => 'binance',
                'domain'         => $request->getHost(),
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Cron job binance completed',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }

    protected function handle(Request $request)
    {
        $request->validate([
            'amount'   => 'required|numeric|min:0.1',
            'order_id' => 'required|string',
            'method'   => 'nullable|string',
        ]);

        $user = $request->user();
        if (!$user) {
            return $this->error('UNAUTHENTICATED', 'Vui lòng đăng nhập.');
        }

        $apiKey    = s('binance_api_key');
        $apiSecret = s('api_secret_binance');
        $binanceId = s('binance_account_id');

        if (!$apiKey || !$apiSecret || !$binanceId) {
            return $this->error('BINANCE_NOT_CONFIGURED', 'Thiếu cấu hình Binance.');
        }

        $clientAmount = (float) $request->input('amount');
        $orderIdInput = trim($request->input('order_id'));
        $domain       = $request->getHost();

        // chặn nạp lại
        if (
            Recharge::where('method', 'BINANCE')->where('transaction_id', $orderIdInput)->where('domain', $domain)->exists()
            || Transaction::where('transaction_code', 'BINANCE_' . $orderIdInput)->where('domain', $domain)->exists()
        ) {
            return $this->error('DUPLICATED_ORDER', 'Order ID này đã được sử dụng.', [
                'order_id' => $orderIdInput,
            ], 409);
        }

        // lấy giao dịch từ Binance
        $binanceTx = $this->fetchSingleBinanceOrder($apiKey, $apiSecret, $orderIdInput);
        if (!$binanceTx) {
            return $this->error(
                'ORDER_NOT_FOUND',
                'Không tìm thấy giao dịch trên Binance. Vui lòng kiểm tra lại Order ID.',
                ['order_id' => $orderIdInput],
                404
            );
        }

        // user đã chuyển tới đúng ID chưa
        $txReceiverId = $binanceTx['receiverInfo']['binanceId']
            ?? $binanceTx['counterpartyId']
            ?? $binanceTx['uid']
            ?? null;

        if ($txReceiverId && (string)$txReceiverId !== (string)$binanceId) {
            return $this->error('WRONG_PAYEE', 'Giao dịch không chuyển tới đúng Binance ID.', [
                'expected' => $binanceId,
                'actual'   => $txReceiverId,
            ]);
        }

        // amount thực
        $binanceAmount = isset($binanceTx['amount']) ? (float)$binanceTx['amount'] : 0.0;
        $binanceAsset  = strtoupper($binanceTx['currency'] ?? 'USDT');

        // cho lệch 0.01
        if (abs($binanceAmount - $clientAmount) > 0.01) {
            return $this->error('AMOUNT_MISMATCH', 'Số tiền không khớp.', [
                'input_amount'   => $clientAmount,
                'binance_amount' => $binanceAmount,
                'asset'          => $binanceAsset,
            ]);
        }

        // quy -> VND
        $amountVND = $this->mapBinanceAmountToVND($binanceAmount, $binanceAsset);
        if ($amountVND <= 0) {
            return $this->error('CONVERT_FAILED', 'Không thể quy đổi số tiền từ Binance.');
        }

        // VND -> USD
        $currencyVND     = Currency::where('code', 'VND')->first();
        $exchangeRateVND = $currencyVND->exchange_rate ?? 26000;
        $incrementUSD    = $amountVND / $exchangeRateVND;

        DB::beginTransaction();
        try {
            $recharge = Recharge::create([
                'user_id'        => $user->id,
                'transaction_id' => $orderIdInput,
                'request_id'     => $orderIdInput,
                'method'         => 'BINANCE',
                'type'           => 'binance_intern',
                'amount'         => $amountVND,
                'real_amount'    => $amountVND,
                'bonus'          => 0,
                'description'    => "Nạp nội bộ Binance (#{$orderIdInput}) {$binanceAmount} {$binanceAsset}",
                'status'         => 'completed',
                'domain'         => $domain,
            ]);

            $before = $user->balance;
            $user->balance       = $user->balance + $incrementUSD;
            $user->total_deposit = $user->total_deposit + $incrementUSD;
            $user->save();

            Transaction::create([
                'user_id'          => $user->id,
                'transaction_code' => 'BINANCE_' . $orderIdInput,
                'type'             => 'add',
                'balance_before'   => $before,
                'balance_after'    => $user->balance,
                'amount'           => $incrementUSD,
                'description'      => "Nạp nội bộ Binance (#{$orderIdInput}) {$binanceAmount} {$binanceAsset}",
                'status'           => 'success',
                'domain'           => $domain,
            ]);

            DB::commit();

            return response()->json([
                'success'  => true,
                'message'  => 'Cron job status order completed',
                'reload'   => true,
                'order_id' => $orderIdInput,
            ], 200);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->error('INTERNAL_ERROR', $e->getMessage(), [], 500);
        }
    }

    protected function fetchSingleBinanceOrder(string $apiKey, string $apiSecret, string $orderId, int $daysBack = 1): ?array
    {
        $endpoint = 'https://api.binance.com/sapi/v1/pay/transactions';
        $nowMs    = (int) (microtime(true) * 1000);
        $startMs  = $nowMs - ($daysBack * 24 * 60 * 60 * 1000);

        $params = [
            'transactionType' => 1,
            'startTime'       => $startMs,
            'endTime'         => $nowMs,
            'limit'           => 100,
            'recvWindow'      => 5000,
            'timestamp'       => $nowMs,
        ];

        ksort($params);
        $query     = http_build_query($params, '', '&', PHP_QUERY_RFC3986);
        $signature = hash_hmac('sha256', $query, $apiSecret);
        $url       = $endpoint . '?' . $query . '&signature=' . $signature;

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_HTTPHEADER     => ['X-MBX-APIKEY: ' . $apiKey],
        ]);
        $raw = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);

        if ($err) {
            return null;
        }

        $res = json_decode($raw, true);
        if (!is_array($res) || !isset($res['data']) || !is_array($res['data'])) {
            return null;
        }

        foreach ($res['data'] as $item) {
            $itemOrderId = (string)($item['orderId'] ?? '');
            $itemTxnId   = (string)($item['transactionId'] ?? '');
            if ($itemOrderId === (string)$orderId || $itemTxnId === (string)$orderId) {
                return $item;
            }
        }

        return null;
    }

    protected function mapBinanceAmountToVND(float $amount, string $currency): int
    {
        if ($amount <= 0) return 0;

        if ($currency === 'VND') {
            return (int) round($amount);
        }

        $stable = ['USDT', 'BUSD', 'USDC'];
        if (in_array($currency, $stable, true)) {
            $rate = (float) (Currency::where('code', 'VND')->value('exchange_rate') ?? 28000);
            return (int) round($amount * $rate);
        }

        return 0;
    }

    protected function generateUniqueTransferCode(): string
    {
        do {
            // Tạo mã random 8 ký tự (chữ hoa)
            $code = strtoupper(Str::random(8));
            
            // Kiểm tra xem mã đã tồn tại chưa
            $exists = User::where('transfer_code', $code)->exists();
        } while ($exists);
        
        return $code;
    }

    protected function error(string $code, string $message, array $extra = [], int $status = 400)
    {
        return response()->json(array_merge([
            'success'    => false,
            'error_code' => $code,
            'message'    => $message,
        ], $extra), $status);
    }
}
