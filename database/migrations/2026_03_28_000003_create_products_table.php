<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('domain');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->text('warranty_policy')->nullable();

            // Category & Group
            $table->foreignId('product_category_id')->nullable()->constrained('product_categories')->nullOnDelete();
            $table->foreignId('product_group_id')->nullable()->constrained('product_groups')->nullOnDelete();
            $table->string('group_tag')->nullable(); // Tên nhãn trong nhóm

            // Connection type: Manual | Api
            $table->enum('type', ['Manual', 'Api'])->default('Manual');

            // API fields (khi type = Api)
            $table->unsignedBigInteger('api_provider_id')->nullable();
            $table->string('api_service_id')->nullable(); // ID dịch vụ bên provider

            // Processing type (khi type = Manual)
            $table->string('process_type')->nullable(); // e.g. key, account, file...

            // Pricing
            $table->decimal('cost_price', 20, 10)->default(0);   // Giá vốn
            $table->decimal('price', 20, 10)->default(0);         // Giá bán lẻ
            $table->decimal('price_1', 20, 10)->default(0);       // Giá đại lý
            $table->decimal('price_2', 20, 10)->default(0);       // Giá nhà phân phối

            // Price percent helpers
            $table->decimal('price_percent', 8, 2)->default(110);
            $table->decimal('price_1_percent', 8, 2)->default(108);
            $table->decimal('price_2_percent', 8, 2)->default(105);

            // Min/Max order quantity
            $table->unsignedInteger('min')->default(1);
            $table->unsignedInteger('max')->default(1);

            // Auto sync price with provider
            $table->boolean('sync')->default(false);

            // Status: In stock | Out of stock | Inactive
            $table->enum('status', ['In stock', 'Out of stock', 'Inactive'])->default('In stock');

            $table->integer('position')->default(0);
            $table->timestamps();

            $table->index('domain');
            $table->index('product_category_id');
            $table->index('status');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
