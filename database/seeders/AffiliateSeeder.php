<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AffiliateSeeder extends Seeder
{
    public function run(): void
    {
        $domain = request()->getHost() ?: '127.0.0.1';

        // Lấy 10 user đầu tiên để tạo quan hệ affiliate
        $userIds = DB::table('users')->limit(10)->pluck('id')->toArray();

        if (count($userIds) < 2) {
            $this->command->warn('Cần ít nhất 2 users để tạo affiliate data.');
            return;
        }

        $data = [];
        $used = [];

        foreach ($userIds as $referrerId) {
            foreach ($userIds as $referredId) {
                if ($referrerId === $referredId) continue;
                $key = $referrerId . '-' . $referredId;
                if (isset($used[$key])) continue;
                $used[$key] = true;

                $ordersCount   = rand(0, 50);
                $totalEarned   = round($ordersCount * rand(1, 10) * 0.05, 4);
                $firstOrderAt  = $ordersCount > 0 ? Carbon::now()->subDays(rand(30, 365)) : null;
                $lastOrderAt   = $ordersCount > 0 ? Carbon::now()->subDays(rand(0, 29)) : null;
                $statuses      = ['active', 'active', 'active', 'inactive', 'suspended'];

                $data[] = [
                    'referrer_id'     => $referrerId,
                    'referred_id'     => $referredId,
                    'referral_code'   => 'REF' . strtoupper(substr(md5($referrerId . $referredId), 0, 8)),
                    'commission_rate' => round(rand(3, 15) / 100, 4),
                    'total_earned'    => $totalEarned,
                    'total_orders'    => $totalEarned,
                    'orders_count'    => $ordersCount,
                    'status'          => $statuses[array_rand($statuses)],
                    'first_order_at'  => $firstOrderAt,
                    'last_order_at'   => $lastOrderAt,
                    'note'            => null,
                    'domain'          => $domain,
                    'created_at'      => Carbon::now()->subDays(rand(60, 365)),
                    'updated_at'      => Carbon::now(),
                ];

                if (count($data) >= 20) break 2;
            }
        }

        // Tránh duplicate unique(referrer_id, referred_id)
        DB::table('affiliates')->insertOrIgnore($data);

        $this->command->info('Đã tạo ' . count($data) . ' affiliate records.');
    }
}
