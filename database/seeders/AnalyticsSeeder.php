<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AnalyticsSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Platforms ─────────────────────────────────────────────────────
        $platforms = [
            ['name' => 'Facebook',  'image' => null, 'position' => 1, 'status' => true],
            ['name' => 'TikTok',    'image' => null, 'position' => 2, 'status' => true],
            ['name' => 'Instagram', 'image' => null, 'position' => 3, 'status' => true],
            ['name' => 'YouTube',   'image' => null, 'position' => 4, 'status' => true],
        ];

        $platformIds = [];
        foreach ($platforms as $p) {
            $id = DB::table('platforms')->insertGetId(array_merge($p, [
                'created_at' => now(), 'updated_at' => now(),
            ]));
            $platformIds[$p['name']] = $id;
        }

        // ── 2. Categories ─────────────────────────────────────────────────────
        $categories = [
            ['platform' => 'Facebook',  'name' => 'Facebook Followers'],
            ['platform' => 'Facebook',  'name' => 'Facebook Likes'],
            ['platform' => 'Facebook',  'name' => 'Facebook Comments'],
            ['platform' => 'TikTok',    'name' => 'TikTok Followers'],
            ['platform' => 'TikTok',    'name' => 'TikTok Views'],
            ['platform' => 'Instagram', 'name' => 'Instagram Followers'],
            ['platform' => 'YouTube',   'name' => 'YouTube Views'],
        ];

        $categoryIds = [];
        foreach ($categories as $c) {
            $id = DB::table('categories')->insertGetId([
                'platform_id' => $platformIds[$c['platform']],
                'name'        => json_encode(['en' => $c['name'], 'vi' => $c['name']]),
                'position'    => 0,
                'status'      => true,
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
            $categoryIds[$c['name']] = $id;
        }

        // ── 3. Services ───────────────────────────────────────────────────────
        $services = [
            ['cat' => 'Facebook Followers', 'name' => 'Facebook Profile/Page Followers | Hidden | Max 1M | Instant | 10K/Day',       'rate' => 0.5],
            ['cat' => 'Facebook Followers', 'name' => 'Facebook Followers | Bot Vietnam | Max 10M | Instant | Refill 30 Day',         'rate' => 0.8],
            ['cat' => 'Facebook Followers', 'name' => 'Facebook Follow Profile/Page | Vietnam | Instant | Cancel/Refund | 10K/Day',   'rate' => 1.2],
            ['cat' => 'Facebook Likes',     'name' => 'Facebook Post Reaction Vietnam | Like 👍 | Instant | 5K - 10K/Day',            'rate' => 0.6],
            ['cat' => 'Facebook Likes',     'name' => 'Facebook Post Reaction Vietnam | Love ❤️ | Instant | 5K - 10K/Day',            'rate' => 0.6],
            ['cat' => 'Facebook Comments',  'name' => 'Facebook Comments Post | Data Vietnam | Instant | No refill | 500-1K/Day',     'rate' => 2.0],
            ['cat' => 'TikTok Followers',   'name' => 'TikTok Follow | Vietnam | Max 50K | Instant | No refill | 2K/Day',             'rate' => 0.9],
            ['cat' => 'TikTok Views',       'name' => 'TikTok Video Views | Max Unlimited | Instant | No refill | 100K/Day',          'rate' => 0.1],
            ['cat' => 'Instagram Followers','name' => 'Instagram Followers | Max 200K | Real | Instant | 5K/day',                     'rate' => 1.5],
            ['cat' => 'YouTube Views',      'name' => 'YouTube Views | High Retention | Max 1M | Instant | 10K/Day',                  'rate' => 0.3],
        ];

        $serviceIds = [];
        foreach ($services as $s) {
            $id = DB::table('services')->insertGetId([
                'category_id'    => $categoryIds[$s['cat']],
                'name'           => json_encode(['en' => $s['name'], 'vi' => $s['name']]),
                'rate_original'  => $s['rate'],
                'rate_retail'    => $s['rate'] * 1.2,
                'rate_agent'     => $s['rate'] * 1.1,
                'min'            => 100,
                'max'            => 1000000,
                'type'           => 'api',
                'status'         => true,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
            $serviceIds[] = $id;
        }

        // ── 4. Users ──────────────────────────────────────────────────────────
        $usernames = ['admin_demo', 'user_vip1', 'user_vip2', 'user_vip3', 'user_vip4',
                      'user_vip5', 'user_vip6', 'user_vip7', 'user_vip8', 'user_vip9',
                      'user_normal1', 'user_normal2', 'user_normal3'];

        $userIds = [];
        foreach ($usernames as $i => $username) {
            // Spread creation across the year
            $createdAt = Carbon::now()->subMonths(rand(0, 11))->subDays(rand(0, 28));

            $existing = DB::table('users')->where('username', $username)->first();
            if ($existing) {
                $userIds[] = $existing->id;
                continue;
            }

            $id = DB::table('users')->insertGetId([
                'name'          => ucfirst(str_replace('_', ' ', $username)),
                'username'      => $username,
                'email'         => $username . '@demo.com',
                'password'      => Hash::make('password'),
                'balance'       => rand(10, 500),
                'spent'         => rand(50, 2000),
                'api_key'       => \Illuminate\Support\Str::random(32),
                'is_active'     => true,
                'role'          => $i === 0 ? 'admin' : 'member',
                'level'         => ['retail', 'agent', 'distributor'][rand(0, 2)],
                'referral_code' => \Illuminate\Support\Str::random(8),
                'created_at'    => $createdAt,
                'updated_at'    => $createdAt,
            ]);
            $userIds[] = $id;
        }

        // ── 5. Orders ─────────────────────────────────────────────────────────
        $statuses = ['pending', 'processing', 'in_progress', 'completed', 'completed',
                     'completed', 'partial', 'canceled', 'awaiting', 'canceled'];

        $ordersData = [];
        for ($i = 0; $i < 300; $i++) {
            $serviceId = $serviceIds[array_rand($serviceIds)];
            $userId    = $userIds[array_rand($userIds)];
            $qty       = rand(100, 50000);
            $rate      = round(rand(5, 20) / 10, 2);
            $charge    = round($qty * $rate / 1000, 4);
            $status    = $statuses[array_rand($statuses)];

            // Spread across last 12 months, heavier on recent months
            $daysAgo   = rand(0, 365);
            $createdAt = Carbon::now()->subDays($daysAgo)->subHours(rand(0, 23));

            $ordersData[] = [
                'user_id'    => $userId,
                'service_id' => $serviceId,
                'link'       => 'https://example.com/profile/' . rand(1000, 9999),
                'quantity'   => $qty,
                'rate'       => $rate,
                'charge'     => $charge,
                'total'      => $charge,
                'remains'    => $status === 'completed' ? 0 : rand(0, $qty),
                'status'     => $status,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        // Chunk insert for performance
        foreach (array_chunk($ordersData, 50) as $chunk) {
            DB::table('orders')->insert($chunk);
        }

        // ── 6. Transactions (deposits) ────────────────────────────────────────
        $transData = [];
        foreach ($userIds as $uid) {
            $count = rand(2, 8);
            for ($j = 0; $j < $count; $j++) {
                $daysAgo   = rand(0, 365);
                $createdAt = Carbon::now()->subDays($daysAgo)->subHours(rand(0, 23));
                $amount    = round(rand(5, 200) + rand(0, 99) / 100, 2);

                $transData[] = [
                    'user_id'        => $uid,
                    'amount'         => $amount,
                    'type'           => 'order',
                    'status'         => 'completed',
                    'payment_method' => ['Bank Transfer', 'USDT', 'Momo', 'VNPay'][rand(0, 3)],
                    'transaction_id' => strtoupper(\Illuminate\Support\Str::random(12)),
                    'description'    => 'Nạp tiền vào tài khoản',
                    'balance_after'  => $amount + rand(10, 100),
                    'created_at'     => $createdAt,
                    'updated_at'     => $createdAt,
                ];
            }
        }

        foreach (array_chunk($transData, 50) as $chunk) {
            DB::table('transactions')->insert($chunk);
        }

        $this->command->info('AnalyticsSeeder: đã tạo ' . count($serviceIds) . ' services, ' . count($userIds) . ' users, ' . count($ordersData) . ' orders, ' . count($transData) . ' transactions.');
    }
}
