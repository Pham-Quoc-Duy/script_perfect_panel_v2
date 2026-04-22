<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Kho sản phẩm (warehouse) - danh sách kho
        Schema::create('product_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('domain');
            $table->integer('position')->default(0);
            $table->timestamps();

            $table->index('domain');
        });

        // Hàng tồn kho - từng item trong kho
        Schema::create('product_goods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warehouse_id')->constrained('product_warehouses')->onDelete('cascade');
            $table->text('content'); // Nội dung sản phẩm (key, account, link...)
            $table->boolean('used')->default(false);
            $table->timestamps();

            $table->index('warehouse_id');
            $table->index('used');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_goods');
        Schema::dropIfExists('product_warehouses');
    }
};
