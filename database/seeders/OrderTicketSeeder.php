<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderTicketSeeder extends Seeder
{
    public function run(): void
    {
        $users = DB::table('users')->pluck('id')->toArray();
        $services = DB::table('services')->select('id', 'name', 'provider_name', 'provider_id')->get();

        if (empty($users) || $services->isEmpty()) {
            $this->command->warn('Cần có users và services trước.');
            return;
        }

        $ticketTypes = ['speedup', 'refill', 'cancel'];
        $statuses = ['pending', 'processing', 'completed'];
        $count = 0;

        // Tạo 15 orders có ticket, phân bổ đều theo service
        foreach ($services->take(5) as $service) {
            foreach ($ticketTypes as $ticket) {
                $userId = $users[array_rand($users)];
                DB::table('orders')->insert([
                    'user_id'       => $userId,
                    'service_id'    => $service->id,
                    'link'          => 'https://example.com/profile/' . $userId,
                    'quantity'      => rand(100, 5000),
                    'rate'          => rand(1, 10) / 1000,
                    'charge'        => rand(1, 50) / 100,
                    'total'         => rand(1, 50) / 100,
                    'start_count'   => rand(0, 1000),
                    'remains'       => rand(0, 500),
                    'provider_name' => $service->provider_name ?: 'smmcoder.com',
                    'provider_id'   => $service->provider_id ?: '1',
                    'ticket'        => $ticket,
                    'status'        => $statuses[array_rand($statuses)],
                    'note'          => match($ticket) {
                        'speedup' => 'Khách yêu cầu tăng tốc đơn hàng',
                        'refill'  => 'Khách yêu cầu bảo hành lại',
                        'cancel'  => 'Khách yêu cầu hủy đơn',
                    },
                    'created_at'    => now()->subHours(rand(1, 72)),
                    'updated_at'    => now()->subMinutes(rand(1, 60)),
                    'domain'        => 'localhost',
                ]);
                $count++;
            }
        }

        $this->command->info("Đã tạo $count orders có ticket (speedup/refill/cancel).");
    }
}
