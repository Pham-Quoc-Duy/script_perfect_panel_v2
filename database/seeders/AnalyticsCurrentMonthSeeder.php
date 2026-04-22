<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnalyticsCurrentMonthSeeder extends Seeder
{
    public function run(): void
    {
        $serviceIds = DB::table('services')->pluck('id')->toArray();
        $userIds    = DB::table('users')->where('role', 'member')->pluck('id')->toArray();

        if (empty($serviceIds) || empty($userIds)) {
            $this->command->warn('Không có services hoặc users. Chạy AnalyticsSeeder trước.');
            return;
        }

        $statuses = ['pending', 'processing', 'in_progress', 'completed', 'completed', 'completed', 'partial', 'canceled'];
        $rows = [];

        for ($i = 0; $i < 100; $i++) {
            $qty       = rand(500, 30000);
            $rate      = round(rand(5, 20) / 10, 2);
            $charge    = round($qty * $rate / 1000, 4);
            $daysAgo   = rand(0, 25); // trong tháng hiện tại
            $createdAt = Carbon::now()->subDays($daysAgo)->subHours(rand(0, 23));

            $rows[] = [
                'user_id'    => $userIds[array_rand($userIds)],
                'service_id' => $serviceIds[array_rand($serviceIds)],
                'link'       => 'https://example.com/' . rand(1000, 9999),
                'quantity'   => $qty,
                'rate'       => $rate,
                'charge'     => $charge,
                'total'      => $charge,
                'remains'    => rand(0, $qty),
                'status'     => $statuses[array_rand($statuses)],
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }

        foreach (array_chunk($rows, 50) as $chunk) {
            DB::table('orders')->insert($chunk);
        }

        $this->command->info('Đã thêm ' . count($rows) . ' orders trong tháng ' . now()->format('Y-m'));
    }
}
