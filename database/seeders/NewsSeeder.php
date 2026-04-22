<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['category' => 'Notification',   'title' => 'He thong bao tri luc 2:00 AM ngay 01/04/2026. Vui long hoan thanh don hang truoc thoi gian nay.'],
            ['category' => 'New service',    'title' => 'Dich vu moi: TikTok Follow Vietnam | Instant | 10K/Day | Best Price'],
            ['category' => 'Change service', 'title' => '[Price Decrease] 1108 | Instagram Follow Vietnam | Instant | No refill | $0.50 -> $0.30'],
            ['category' => 'Change service', 'title' => '[Price Decrease] 1200 | Facebook Page Like | $0.80 -> $0.60'],
            ['category' => 'Notification',   'title' => 'Chuc mung nam moi 2026! Giam gia 20% tat ca dich vu trong thang 1'],
            ['category' => 'New service',    'title' => 'Dich vu moi: YouTube Watch Time | 4000 Hours | Instant | Guaranteed'],
            ['category' => 'Change service', 'title' => '[Price Increase] 1500 | Facebook Post Like | $0.20 -> $0.25'],
            ['category' => 'Notification',   'title' => 'He thong nap tien tu dong qua MOMO da hoat dong tro lai binh thuong'],
        ];

        foreach ($items as $i => $item) {
            DB::table('news')->insert([
                'category'   => $item['category'],
                'title'      => $item['title'],
                'content'    => null,
                'domain'     => '127.0.0.1',
                'created_at' => now()->subHours(($i + 1) * 3),
                'updated_at' => now()->subHours(($i + 1) * 3),
            ]);
        }

        $this->command->info('Da tao ' . count($items) . ' news items.');
    }
}
