<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventSpin;
use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function spin(Request $request, $eventId)
    {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Vui lòng đăng nhập'
            ], 401);
        }

        $event = Event::where('id', $eventId)
            ->where('domain', $request->getHost())
            ->first();

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Sự kiện không tồn tại'
            ], 404);
        }

        if (!$event->isActive()) {
            return response()->json([
                'success' => false,
                'message' => 'Sự kiện đã kết thúc'
            ], 400);
        }

        if (!$event->canUserSpin($user->id)) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã hết lượt hôm nay'
            ], 400);
        }

        try {
            DB::beginTransaction();

            $reward = $this->getRandomReward($event->rewards);
            
            // Lấy dữ liệu currency của user
            $userCurrency = $user->currency ?? 'VND';
            $currencyData = Currency::where('code', $userCurrency)->first();
            $exchangeRate = $currencyData ? $currencyData->exchange_rate : 1;
            
            // Tính amount để hiển thị (amount * exchange_rate)
            $displayAmount = round(($reward['amount'] * $exchangeRate) * 100) / 100;

            // Lưu amount gốc vào reward_amount
            EventSpin::create([
                'event_id' => $event->id,
                'user_id' => $user->id,
                'reward_name' => $reward['name'],
                'reward_amount' => $reward['amount'],
                'ip_address' => $request->ip(),
            ]);

            // Cộng amount gốc vào balance
            if ($reward['amount'] > 0) {
                $user->increment('balance', $reward['amount']);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'reward' => $reward,
                'displayAmount' => $displayAmount,
                'currency' => [
                    'code' => $userCurrency,
                    'symbol' => $currencyData && $currencyData->symbol ? $currencyData->symbol : '$',
                    'symbol_position' => $currencyData && $currencyData->symbol_position ? $currencyData->symbol_position : 'before',
                    'exchange_rate' => $exchangeRate
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra'
            ], 500);
        }
    }

    private function getRandomReward($rewards)
    {
        $totalProbability = array_sum(array_column($rewards, 'probability'));
        $random = mt_rand(1, $totalProbability * 100) / 100;
        
        $currentProbability = 0;
        foreach ($rewards as $reward) {
            $currentProbability += $reward['probability'];
            if ($random <= $currentProbability) {
                return $reward;
            }
        }
        
        return end($rewards);
    }
}
