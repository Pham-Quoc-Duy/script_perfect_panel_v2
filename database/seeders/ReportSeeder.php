<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $domain = '127.0.0.1';
        $year   = Carbon::now()->year;

        // Lấy dữ liệu hiện có
        $userIds       = DB::table('users')->where('domain', $domain)->pluck('id')->toArray();
        $serviceIds    = DB::table('services')->pluck('id')->toArray();
        $methodIds     = DB::table('payment_methods')->where('status', true)->pluck('id')->toArray();
        $providerNames = DB::table('api_providers')->where('domain', $domain)->pluck('name')->toArray();

        if (empty($userIds))    $userIds    = DB::table('users')->pluck('id')->toArray();
        if (empty($methodIds))  $methodIds  = [1];
        if (empty($serviceIds)) $serviceIds = [1];
        if (empty($providerNames)) $providerNames = ['smmcoder.com'];

        $statuses = ['completed', 'completed', 'completed', 'partial', 'canceled', 'processing', 'pending'];

        // ── Orders: 1200 bản ghi trải đều 12 tháng ───────────────────────────
        $orders = [];
        for ($month = 1; $month <= 12; $month++) {
            $daysInMonth = Carbon::create($year, $month)->daysInMonth;
            // Số đơn mỗi tháng dao động 80-150
            $count = rand(80, 150);

            for ($i = 0; $i < $count; $i++) {
                $day      = rand(1, $daysInMonth);
                $qty      = rand(500, 100000);
                $rate     = round(rand(3, 25) / 10, 2);
                $total    = round($qty * $rate / 1000, 4);
                $profit   = round($total * rand(5, 20) / 100, 4);
                $status   = $statuses[array_rand($statuses)];
                $date     = Carbon::create($year, $month, $day, rand(0, 23), rand(0, 59));

                $orders[] = [
                    'user_id'       => $userIds[array_rand($userIds)],
                    'service_id'    => $serviceIds[array_rand($serviceIds)],
                    'provider_name' => $providerNames[array_rand($providerNames)],
                    'link'          => 'https://example.com/' . rand(10000, 99999),
                    'quantity'      => $qty,
                    'rate'          => $rate,
                    'charge'        => $total,
                    'total'         => $total,
                    'remains'       => $status === 'completed' ? 0 : rand(0, $qty),
                    'status'        => $status,
                    'domain'        => $domain,
                    'created_at'    => $date,
                    'updated_at'    => $date,
                ];
            }
        }

        foreach (array_chunk($orders, 100) as $chunk) {
            DB::table('orders')->insert($chunk);
        }

        // ── Payments: 400 bản ghi trải đều 12 tháng ──────────────────────────
        $payments = [];
        for ($month = 1; $month <= 12; $month++) {
            $daysInMonth = Carbon::create($year, $month)->daysInMonth;
            $count = rand(25, 45);

            for ($i = 0; $i < $count; $i++) {
                $day    = rand(1, $daysInMonth);
                $amount = round(rand(5, 500) + rand(0, 99) / 100, 2);
                $date   = Carbon::create($year, $month, $day, rand(0, 23), rand(0, 59));

                $payments[] = [
                    'user_id'           => $userIds[array_rand($userIds)],
                    'payment_method_id' => $methodIds[array_rand($methodIds)],
                    'total_amount'      => $amount,
                    'amount'            => $amount,
                    'bonus_amount'      => 0,
                    'transaction_id'    => strtoupper(\Illuminate\Support\Str::random(16)),
                    'status'            => 'completed',
                    'domain'            => $domain,
                    'created_at'        => $date,
                    'updated_at'        => $date,
                ];
            }
        }

        foreach (array_chunk($payments, 100) as $chunk) {
            DB::table('payments')->insert($chunk);
        }

        $this->command->info('ReportSeeder: ' . count($orders) . ' orders + ' . count($payments) . ' payments inserted.');
    }
}
