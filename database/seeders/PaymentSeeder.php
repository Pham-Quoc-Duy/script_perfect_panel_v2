<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        // Ensure ACB and Binance payment methods exist
        DB::table('payment_methods')->insertOrIgnore([
            [
                'name'     => 'SIEUTHICODE - ACB',
                'type'     => 'bank_vn',
                'image'    => 'https://i.imgur.com/P7EFing.png',
                'position' => 1,
                'status'   => 1,
                'domain'   => '127.0.0.1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name'     => 'FPayAZ - Binance - USDT',
                'type'     => 'binance',
                'image'    => 'https://i.imgur.com/iBEGgng.png',
                'position' => 14,
                'status'   => 1,
                'domain'   => '127.0.0.1',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);

        $acbId     = DB::table('payment_methods')->where('name', 'SIEUTHICODE - ACB')->value('id');
        $binanceId = DB::table('payment_methods')->where('name', 'FPayAZ - Binance - USDT')->value('id');

        // Skip if transaction_id already exists (idempotent)
        $existing = DB::table('payments')
            ->whereIn('transaction_id', [
                'TXN17725579327524', 'TXN17725579327525', 'TXN17725579327526',
                'TXN17725579321368', 'TXN17725579321369', 'TXN17725579321370',
            ])
            ->pluck('transaction_id')
            ->toArray();

        $rows = [
            // ACB - 500k → bonus 10% (bậc >= 500k)
            [
                'user_id'           => 1,
                'payment_method_id' => $acbId,
                'transaction_id'    => 'TXN17725579327524',
                'amount'            => 500000.00,
                'bonus_amount'      => 50000.00,
                'total_amount'      => 550000.00,
                'currency'          => 'VND',
                'exchange_rate'     => 26500.0000,
                'status'            => 'completed',
                'note'              => 'Nạp tiền qua ACB',
                'payment_info'      => json_encode(['account' => '18145511', 'bank' => 'ACB']),
                'domain'            => '127.0.0.1',
                'created_at'        => Carbon::parse('2026-03-19 10:00:00'),
                'updated_at'        => Carbon::parse('2026-03-19 10:00:00'),
            ],
            // ACB - 200k → bonus 5% (bậc >= 100k)
            [
                'user_id'           => 1,
                'payment_method_id' => $acbId,
                'transaction_id'    => 'TXN17725579327525',
                'amount'            => 200000.00,
                'bonus_amount'      => 10000.00,
                'total_amount'      => 210000.00,
                'currency'          => 'VND',
                'exchange_rate'     => 26500.0000,
                'status'            => 'pending',
                'note'              => 'Nạp tiền qua ACB',
                'payment_info'      => json_encode(['account' => '18145511', 'bank' => 'ACB']),
                'domain'            => '127.0.0.1',
                'created_at'        => Carbon::parse('2026-03-23 08:30:00'),
                'updated_at'        => Carbon::parse('2026-03-23 08:30:00'),
            ],
            // ACB - 100k → bonus 5% (bậc >= 100k)
            [
                'user_id'           => 1,
                'payment_method_id' => $acbId,
                'transaction_id'    => 'TXN17725579327526',
                'amount'            => 100000.00,
                'bonus_amount'      => 5000.00,
                'total_amount'      => 105000.00,
                'currency'          => 'VND',
                'exchange_rate'     => 26500.0000,
                'status'            => 'completed',
                'note'              => 'Nạp tiền qua ACB',
                'payment_info'      => json_encode(['account' => '18145511', 'bank' => 'ACB']),
                'domain'            => '127.0.0.1',
                'created_at'        => Carbon::parse('2026-03-10 14:20:00'),
                'updated_at'        => Carbon::parse('2026-03-10 14:20:00'),
            ],
            // Binance - $100 → bonus 10% (bậc >= $100)
            [
                'user_id'           => 1,
                'payment_method_id' => $binanceId,
                'transaction_id'    => 'TXN17725579321368',
                'amount'            => 100.00,
                'bonus_amount'      => 10.00,
                'total_amount'      => 110.00,
                'currency'          => 'USD',
                'exchange_rate'     => 1.0000,
                'status'            => 'completed',
                'note'              => 'Nạp tiền qua Binance',
                'payment_info'      => json_encode(['method' => 'USDT', 'binance_id' => '228223025']),
                'domain'            => '127.0.0.1',
                'created_at'        => Carbon::parse('2026-03-21 09:15:00'),
                'updated_at'        => Carbon::parse('2026-03-21 09:15:00'),
            ],
            // Binance - $50 → bonus 7% (bậc >= $50)
            [
                'user_id'           => 1,
                'payment_method_id' => $binanceId,
                'transaction_id'    => 'TXN17725579321369',
                'amount'            => 50.00,
                'bonus_amount'      => 3.50,
                'total_amount'      => 53.50,
                'currency'          => 'USD',
                'exchange_rate'     => 1.0000,
                'status'            => 'pending',
                'note'              => 'Nạp tiền qua Binance',
                'payment_info'      => json_encode(['method' => 'USDT', 'binance_id' => '228223025']),
                'domain'            => '127.0.0.1',
                'created_at'        => Carbon::parse('2026-03-24 07:00:00'),
                'updated_at'        => Carbon::parse('2026-03-24 07:00:00'),
            ],
            // Binance - $10 → bonus 3% (bậc >= $10)
            [
                'user_id'           => 1,
                'payment_method_id' => $binanceId,
                'transaction_id'    => 'TXN17725579321370',
                'amount'            => 10.00,
                'bonus_amount'      => 0.30,
                'total_amount'      => 10.30,
                'currency'          => 'USD',
                'exchange_rate'     => 1.0000,
                'status'            => 'processing',
                'note'              => 'Nạp tiền qua Binance',
                'payment_info'      => json_encode(['method' => 'USDT', 'binance_id' => '228223025']),
                'domain'            => '127.0.0.1',
                'created_at'        => Carbon::parse('2026-03-22 16:45:00'),
                'updated_at'        => Carbon::parse('2026-03-22 16:45:00'),
            ],
        ];

        $toInsert = array_filter($rows, fn($r) => !in_array($r['transaction_id'], $existing));

        if (!empty($toInsert)) {
            DB::table('payments')->insert(array_values($toInsert));
        }
    }
}
