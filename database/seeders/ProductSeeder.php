<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGroup;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $domain = config('app.domain', '127.0.0.1');

        // Categories
        $cats = [
            ['name' => 'Zalo',     'position' => 1],
            ['name' => 'Facebook', 'position' => 2],
            ['name' => 'Account',  'position' => 3],
        ];
        $catIds = [];
        foreach ($cats as $cat) {
            $catIds[$cat['name']] = ProductCategory::firstOrCreate(
                ['name' => $cat['name'], 'domain' => $domain],
                ['status' => true, 'position' => $cat['position']]
            )->id;
        }

        // Groups
        $groups = [
            ['name' => 'Nhóm Zalo',           'position' => 1],
            ['name' => 'Tài khoản Facebook',   'position' => 2],
            ['name' => 'Tài khoản Premium',    'position' => 3],
        ];
        $groupIds = [];
        foreach ($groups as $g) {
            $groupIds[$g['name']] = ProductGroup::firstOrCreate(
                ['name' => $g['name'], 'domain' => $domain],
                ['position' => $g['position']]
            )->id;
        }

        // Products
        $products = [
            [
                'name'                => 'Nhóm Zalo 500 - 1000 thành viên thật',
                'slug'                => 'nhom-zalo-500-1000-thanh-vien-that',
                'thumbnail'           => 'https://cdn.pixabay.com/photo/2021/01/05/06/40/icon-5889010_640.png',
                'description'         => '<p>Nhóm Zalo thật, thành viên Việt Nam, giao hàng trong 24h.</p>',
                'warranty_policy'     => '<p>Bảo hành 7 ngày nếu nhóm bị xóa hoặc không đủ thành viên.</p>',
                'product_category_id' => $catIds['Zalo'],
                'product_group_id'    => $groupIds['Nhóm Zalo'],
                'group_tag'           => '500-1000',
                'type'                => 'Manual',
                'process_type'        => 'Manual',
                'cost_price'          => 3.00,
                'price'               => 5.00,
                'price_1'             => 4.80,
                'price_2'             => 4.50,
                'price_percent'       => 110,
                'price_1_percent'     => 108,
                'price_2_percent'     => 105,
                'min'                 => 1,
                'max'                 => 100,
                'status'              => 'In stock',
                'position'            => 1,
            ],
            [
                'name'                => 'Nhóm Zalo 1000 - 1500 thành viên thật',
                'slug'                => 'nhom-zalo-1000-1500-thanh-vien-that',
                'thumbnail'           => 'https://cdn.pixabay.com/photo/2021/01/05/06/40/icon-5889010_640.png',
                'description'         => '<p>Nhóm Zalo thật, thành viên Việt Nam, giao hàng trong 24h.</p>',
                'warranty_policy'     => '<p>Bảo hành 7 ngày nếu nhóm bị xóa hoặc không đủ thành viên.</p>',
                'product_category_id' => $catIds['Zalo'],
                'product_group_id'    => $groupIds['Nhóm Zalo'],
                'group_tag'           => '1000-1500',
                'type'                => 'Manual',
                'process_type'        => 'Manual',
                'cost_price'          => 5.00,
                'price'               => 8.00,
                'price_1'             => 7.70,
                'price_2'             => 7.20,
                'price_percent'       => 110,
                'price_1_percent'     => 108,
                'price_2_percent'     => 105,
                'min'                 => 1,
                'max'                 => 50,
                'status'              => 'In stock',
                'position'            => 2,
            ],
            [
                'name'                => 'Nhóm Zalo 1700 - 2000 thành viên thật',
                'slug'                => 'nhom-zalo-1700-2000-thanh-vien-that',
                'thumbnail'           => 'https://cdn.pixabay.com/photo/2021/01/05/06/40/icon-5889010_640.png',
                'description'         => '<p>Nhóm Zalo thật, thành viên Việt Nam, giao hàng trong 24h.</p>',
                'warranty_policy'     => '<p>Bảo hành 7 ngày nếu nhóm bị xóa hoặc không đủ thành viên.</p>',
                'product_category_id' => $catIds['Zalo'],
                'product_group_id'    => $groupIds['Nhóm Zalo'],
                'group_tag'           => '1700-2000',
                'type'                => 'Manual',
                'process_type'        => 'Manual',
                'cost_price'          => 8.00,
                'price'               => 12.00,
                'price_1'             => 11.50,
                'price_2'             => 11.00,
                'price_percent'       => 110,
                'price_1_percent'     => 108,
                'price_2_percent'     => 105,
                'min'                 => 1,
                'max'                 => 20,
                'status'              => 'In stock',
                'position'            => 3,
            ],
            [
                'name'                => 'Tài khoản Facebook cá nhân Việt Nam',
                'slug'                => 'tai-khoan-facebook-ca-nhan-viet-nam',
                'thumbnail'           => 'https://cdn.pixabay.com/photo/2021/06/15/12/28/facebook-6338507_640.png',
                'description'         => '<p>Tài khoản Facebook Việt Nam, đã xác minh số điện thoại.</p>',
                'warranty_policy'     => '<p>Bảo hành 3 ngày nếu tài khoản bị khóa do lỗi từ phía chúng tôi.</p>',
                'product_category_id' => $catIds['Facebook'],
                'product_group_id'    => $groupIds['Tài khoản Facebook'],
                'group_tag'           => 'Cá nhân',
                'type'                => 'Manual',
                'process_type'        => 'Manual',
                'cost_price'          => 2.00,
                'price'               => 3.50,
                'price_1'             => 3.30,
                'price_2'             => 3.10,
                'price_percent'       => 110,
                'price_1_percent'     => 108,
                'price_2_percent'     => 105,
                'min'                 => 1,
                'max'                 => 500,
                'status'              => 'In stock',
                'position'            => 1,
            ],
            [
                'name'                => 'Tài khoản Facebook Business',
                'slug'                => 'tai-khoan-facebook-business',
                'thumbnail'           => 'https://cdn.pixabay.com/photo/2021/06/15/12/28/facebook-6338507_640.png',
                'description'         => '<p>Tài khoản Facebook Business đã xác minh, sẵn sàng chạy quảng cáo.</p>',
                'warranty_policy'     => '<p>Bảo hành 3 ngày nếu tài khoản bị khóa do lỗi từ phía chúng tôi.</p>',
                'product_category_id' => $catIds['Facebook'],
                'product_group_id'    => $groupIds['Tài khoản Facebook'],
                'group_tag'           => 'Business',
                'type'                => 'Manual',
                'process_type'        => 'Manual',
                'cost_price'          => 10.00,
                'price'               => 15.00,
                'price_1'             => 14.50,
                'price_2'             => 14.00,
                'price_percent'       => 110,
                'price_1_percent'     => 108,
                'price_2_percent'     => 105,
                'min'                 => 1,
                'max'                 => 100,
                'status'              => 'In stock',
                'position'            => 2,
            ],
            [
                'name'                => 'Canva Premium 1 tháng',
                'slug'                => 'canva-premium-1-thang',
                'thumbnail'           => 'https://cdn.pixabay.com/photo/2022/01/30/17/54/canva-6981481_640.png',
                'description'         => '<p>Tài khoản Canva Pro, dùng riêng, đầy đủ tính năng premium.</p>',
                'warranty_policy'     => '<p>Bảo hành đủ 30 ngày, đổi mới nếu hết hạn sớm.</p>',
                'product_category_id' => $catIds['Account'],
                'product_group_id'    => $groupIds['Tài khoản Premium'],
                'group_tag'           => '1 tháng',
                'type'                => 'Manual',
                'process_type'        => 'Manual',
                'cost_price'          => 1.50,
                'price'               => 2.50,
                'price_1'             => 2.30,
                'price_2'             => 2.10,
                'price_percent'       => 110,
                'price_1_percent'     => 108,
                'price_2_percent'     => 105,
                'min'                 => 1,
                'max'                 => 999,
                'status'              => 'In stock',
                'position'            => 1,
            ],
            [
                'name'                => 'Netflix Premium 1 tháng',
                'slug'                => 'netflix-premium-1-thang',
                'thumbnail'           => 'https://cdn.pixabay.com/photo/2019/11/05/15/44/netflix-4603951_640.png',
                'description'         => '<p>Tài khoản Netflix Premium 4K, dùng riêng, không chia sẻ.</p>',
                'warranty_policy'     => '<p>Bảo hành đủ 30 ngày, đổi mới nếu hết hạn sớm.</p>',
                'product_category_id' => $catIds['Account'],
                'product_group_id'    => $groupIds['Tài khoản Premium'],
                'group_tag'           => '1 tháng',
                'type'                => 'Manual',
                'process_type'        => 'Manual',
                'cost_price'          => 2.50,
                'price'               => 4.00,
                'price_1'             => 3.80,
                'price_2'             => 3.50,
                'price_percent'       => 110,
                'price_1_percent'     => 108,
                'price_2_percent'     => 105,
                'min'                 => 1,
                'max'                 => 999,
                'status'              => 'In stock',
                'position'            => 2,
            ],
        ];

        foreach ($products as $p) {
            Product::firstOrCreate(
                ['slug' => $p['slug'], 'domain' => $domain],
                array_merge($p, ['domain' => $domain])
            );
        }

        $this->command->info('Created ' . count($products) . ' sample products.');
    }
}
