<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductOrder;
use App\Models\User;
use App\Models\Product;

class ProductOrderSeeder extends Seeder
{
    public function run(): void
    {
        $users    = User::limit(5)->pluck('id')->toArray();
        $products = Product::limit(6)->pluck('id', 'name')->toArray();
        $domain   = '127.0.0.1';

        if (empty($users)) {
            $this->command->warn('No users found. Skipping ProductOrderSeeder.');
            return;
        }

        $statuses = ['Awaiting', 'Manual', 'Pending', 'In progress', 'Completed', 'Canceled', 'Failed'];

        $samples = [
            ['status' => 'Canceled',    'amount' => 0,      'charge' => 12,    'quantity' => 1],
            ['status' => 'Completed',   'amount' => 150000, 'charge' => 150000,'quantity' => 1],
            ['status' => 'In progress', 'amount' => 50000,  'charge' => 50000, 'quantity' => 2],
            ['status' => 'Awaiting',    'amount' => 0,      'charge' => 99000, 'quantity' => 1],
            ['status' => 'Failed',      'amount' => 0,      'charge' => 30000, 'quantity' => 1],
            ['status' => 'Pending',     'amount' => 75000,  'charge' => 75000, 'quantity' => 3],
            ['status' => 'Manual',      'amount' => 200000, 'charge' => 200000,'quantity' => 1],
            ['status' => 'Completed',   'amount' => 120000, 'charge' => 120000,'quantity' => 1],
        ];

        $productIds = array_values(array_filter(array_values($products)));

        foreach ($samples as $i => $sample) {
            ProductOrder::create([
                'user_id'                  => $users[$i % count($users)],
                'domain'                   => $domain,
                'product_id'               => !empty($productIds) ? $productIds[$i % count($productIds)] : null,
                'provider_product_order_id'=> $sample['status'] !== 'Awaiting' ? 'PO-' . rand(10000, 99999) : null,
                'status'                   => $sample['status'],
                'amount'                   => $sample['amount'],
                'charge'                   => $sample['charge'],
                'quantity'                 => $sample['quantity'],
                'note'                     => null,
                'created_at'               => now()->subDays(rand(0, 30)),
                'updated_at'               => now()->subDays(rand(0, 5)),
            ]);
        }

        $this->command->info('Created ' . count($samples) . ' product orders.');
    }
}
