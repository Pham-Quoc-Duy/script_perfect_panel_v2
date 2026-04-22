<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        $domain = config('app.domain', '127.0.0.1');

        $languages = [
            ['code' => 'vi', 'name' => 'Tiếng Việt', 'status' => true],
            ['code' => 'en', 'name' => 'English',    'status' => true],
        ];

        foreach ($languages as $lang) {
            Language::firstOrCreate(
                ['code' => $lang['code'], 'domain' => $domain],
                ['name' => $lang['name'], 'status' => $lang['status'], 'domain' => $domain]
            );
        }
    }
}
