<?php

namespace App\Http\Controllers\Webhook;

use App\Http\Controllers\Controller;
use App\Models\{Payment, User, Transaction, Currency};
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Facades\{DB, Log};
use Illuminate\Support\Str;
 
class PaymentWebhookController extends Controller
{
    public function handlePayment(Request $request): JsonResponse
    {
        try {
            $payment = Payment::find($request->query('type'));
            if (!$payment) {
                return response()->json(['status' => 'error', 'message' => 'Payment method not found'], 404);
            }

            if ($request->isMethod('GET')) {
                return response()->json(['status' => true, 'msg' => 'OK']);
            }

            Log::info('Webhook received', ['url' => $request->fullUrl(), 'body' => $request->all()]);

            return response()->json($this->processTransactions($payment, $request));

        } catch (\Exception $e) {
            Log::error('Webhook error', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['status' => 'error', 'message' => 'Internal server error'], 500);
        }
    }

    private function processTransactions(Payment $payment, Request $request): array
    {
        $transactions = $request->input('transactions', []);

        if (!is_array($transactions) || empty($transactions)) {
            return ['status' => 'error', 'message' => 'Invalid data format'];
        }

        DB::beginTransaction();
        try {
            foreach ($transactions as $txn) {
                $this->handleTransaction($payment, $txn);
            }
            DB::commit();
            return ['status' => 'success', 'msg' => 'OK'];
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function handleTransaction(Payment $payment, array $data): void
    {
        if (!isset($data['type'], $data['transactionID'], $data['amount'], $data['description']) 
            || $data['type'] !== 'IN') {
            return;
        }

        $code = trim(explode(' ', trim($data['description']))[0]);
        $user = User::where('transfer_code', $code)->first();
        
        if (!$user || Transaction::where('transaction_id', $data['transactionID'])->where('user_id', $user->id)->exists()) {
            return;
        }

        $this->processDeposit($user, $payment, (float) $data['amount'], $data['transactionID'], $data['description']);
    }

    private function processDeposit(User $user, Payment $payment, float $amountVND, string $transactionId, string $description): void
    {
        $vndRate = Currency::where('code', 'VND')->where('status', 1)->value('exchange_rate');

        // Convert VND to base currency: 25000 / 26252 = 0.95228...
        $amount = $amountVND / $vndRate;
        
        // Calculate bonus on base amount
        $bonus = $payment->getBonusForAmount($amount);
        $totalAmount = $amount + $bonus;

        // Get bonus percentage for description
        $bonusPercent = 0;
        if ($bonus > 0 && $amount > 0) {
            $bonusPercent = ($bonus / $amount) * 100;
        }

        // Create deposit transaction
        Transaction::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'type' => 'deposit',
            'status' => 'completed',
            'payment_method' => $payment->name,
            'transaction_id' => $transactionId,
            'description' => $description,
            'domain' => getDomain()
        ]);

        // Create bonus transaction if bonus exists
        if ($bonus > 0) {
            Transaction::create([
                'user_id' => $user->id,
                'amount' => $bonus,
                'type' => 'bonus',
                'status' => 'completed',
                'payment_method' => $payment->name,
                'transaction_id' => $transactionId,
                'description' => "Bonus {$bonusPercent}% for {$amount} addfunds",
                'domain' => getDomain()
            ]);
        }

        // Update user balance with total amount and transfer code
        $user->increment('balance', $totalAmount);
        $user->update(['transfer_code' => strtoupper(Str::random(8))]);
    }

}
