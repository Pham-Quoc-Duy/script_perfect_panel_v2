<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServiceSyncLogSeeder extends Seeder
{
    public function run(): void
    {
        $domain = '127.0.0.1';

        // Bỏ qua nếu đã có dữ liệu
        if (DB::table('service_sync_logs')->where('domain', $domain)->exists()) {
            $this->command->info('ServiceSyncLogSeeder: đã có dữ liệu, bỏ qua.');
            return;
        }

        // Lấy services thực tế nếu có, không thì dùng ID giả
        $services = DB::table('services')
            ->select('id', 'provider_id', 'provider_name', 'service_api')
            ->where('domain', $domain)
            ->limit(10)
            ->get()
            ->toArray();

        // Dữ liệu mẫu nếu DB trống
        if (empty($services)) {
            $services = [
                (object)['id' => 1666, 'provider_id' => 1, 'provider_name' => 'smmking.vip',    'service_api' => '29342'],
                (object)['id' => 1663, 'provider_id' => 1, 'provider_name' => 'smmking.vip',    'service_api' => '29340'],
                (object)['id' => 1502, 'provider_id' => 1, 'provider_name' => 'smmking.vip',    'service_api' => '28100'],
                (object)['id' => 1671, 'provider_id' => 2, 'provider_name' => 'mualike.biz',    'service_api' => '5285'],
                (object)['id' => 1735, 'provider_id' => 3, 'provider_name' => 'smm.baostar.net','service_api' => '6552'],
                (object)['id' => 1734, 'provider_id' => 3, 'provider_name' => 'smm.baostar.net','service_api' => '6551'],
                (object)['id' => 1649, 'provider_id' => 4, 'provider_name' => 'liketrusted.com','service_api' => '79'],
                (object)['id' => 1542, 'provider_id' => 4, 'provider_name' => 'liketrusted.com','service_api' => '79'],
                (object)['id' => 1670, 'provider_id' => 5, 'provider_name' => 'boosterviews.com','service_api' => '1161'],
                (object)['id' => 1392, 'provider_id' => 4, 'provider_name' => 'liketrusted.com','service_api' => '79'],
            ];
        }

        $now = Carbon::now();
        $rows = [];

        // --- Price increase logs ---
        foreach (array_slice($services, 0, 3) as $svc) {
            $old = round(0.07 + mt_rand(0, 30) / 1000, 4);
            $new = round($old + mt_rand(1, 10) / 1000, 4);
            $rows[] = $this->makeRow($svc, 'price_increase', 'rate', $old, $new, $now->copy()->subHours(mt_rand(1, 12)), $domain);
        }

        // --- Price decrease logs ---
        foreach (array_slice($services, 3, 2) as $svc) {
            $old = round(0.15 + mt_rand(0, 50) / 1000, 4);
            $new = round($old - mt_rand(5, 50) / 1000, 4);
            $rows[] = $this->makeRow($svc, 'price_decrease', 'rate', $old, $new, $now->copy()->subHours(mt_rand(13, 24)), $domain);
        }

        // --- Min/Max change logs ---
        foreach (array_slice($services, 5, 3) as $svc) {
            $old = mt_rand(1000, 50000);
            $new = mt_rand(100000, 2000000);
            $rows[] = $this->makeRow($svc, 'min_max_change', 'max', $old, $new, $now->copy()->subDays(mt_rand(1, 3)), $domain);
        }

        // --- Action change logs ---
        foreach (array_slice($services, 8, 2) as $svc) {
            $old = mt_rand(1000000, 5000000);
            $new = mt_rand(100000, 500000);
            $rows[] = $this->makeRow($svc, 'min_max_change', 'max', $old, $new, $now->copy()->subDays(mt_rand(3, 7)), $domain, true);
        }

        // Thêm một số log đã đọc (lịch sử cũ hơn)
        foreach (array_slice($services, 0, 5) as $svc) {
            $old = round(0.05 + mt_rand(0, 20) / 1000, 4);
            $new = round($old + mt_rand(1, 5) / 1000, 4);
            $rows[] = $this->makeRow($svc, 'price_increase', 'rate', $old, $new, $now->copy()->subDays(mt_rand(7, 30)), $domain, true);
        }

        DB::table('service_sync_logs')->insert($rows);

        $this->command->info('ServiceSyncLogSeeder: đã tạo ' . count($rows) . ' bản ghi.');
    }

    private function makeRow(object $svc, string $changeType, string $field, float $old, float $new, Carbon $date, string $domain, bool $isRead = false): array
    {
        return [
            'service_id'   => $svc->id,
            'provider_id'  => $svc->provider_id,
            'provider_name'=> $svc->provider_name,
            'service_api'  => $svc->service_api,
            'change_type'  => $changeType,
            'field_changed'=> $field,
            'old_value'    => $old,
            'new_value'    => $new,
            'is_read'      => $isRead,
            'domain'       => $domain,
            'created_at'   => $date,
            'updated_at'   => $date,
        ];
    }
}
