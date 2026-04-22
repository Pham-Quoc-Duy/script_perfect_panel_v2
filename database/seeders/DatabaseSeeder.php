<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            PaymentMethodSeeder::class,
            PaymentSeeder::class,
            ServiceSyncLogSeeder::class,
            AnalyticsSeeder::class,
            TicketCategorySeeder::class,
            TicketSeeder::class,
            NewsSeeder::class,
            ProductSeeder::class,
            LanguageSeeder::class,
        ]);
    }
}
