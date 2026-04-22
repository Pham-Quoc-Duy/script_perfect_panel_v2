<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo ticket subjects
        $subjects = [
            // Orders category - có subcategories
            [
                'category' => 'Orders',
                'subcategory' => 'Cancel',
                'show_message_only' => false,
                'required_fields' => json_encode([
                    [
                        'id' => 'order_id',
                        'name' => 'Order ID',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => '10867110,10867210,10867500'
                    ]
                ]),
                'status' => 1,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Orders',
                'subcategory' => 'Refill',
                'show_message_only' => false,
                'required_fields' => json_encode([
                    [
                        'id' => 'order_id',
                        'name' => 'Order ID',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => '10867110,10867210,10867500'
                    ]
                ]),
                'status' => 1,
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Orders',
                'subcategory' => 'Speed up',
                'show_message_only' => false,
                'required_fields' => json_encode([
                    [
                        'id' => 'order_id',
                        'name' => 'Order ID',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => '10867110,10867210,10867500'
                    ]
                ]),
                'status' => 1,
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category' => 'Orders',
                'subcategory' => 'Fake complete',
                'show_message_only' => false,
                'required_fields' => json_encode([
                    [
                        'id' => 'order_id',
                        'name' => 'Order ID',
                        'type' => 'text',
                        'required' => true,
                        'placeholder' => '10867110,10867210,10867500'
                    ]
                ]),
                'status' => 1,
                'sort_order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Payments category - chỉ hiển thị message
            [
                'category' => 'Payments',
                'subcategory' => null,
                'show_message_only' => true,
                'required_fields' => null,
                'status' => 1,
                'sort_order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Other category - chỉ hiển thị message
            [
                'category' => 'Other',
                'subcategory' => null,
                'show_message_only' => true,
                'required_fields' => null,
                'status' => 1,
                'sort_order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('ticket_subjects')->insert($subjects);
    }
}