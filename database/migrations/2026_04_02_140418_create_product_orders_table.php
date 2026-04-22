<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('domain')->nullable();
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');
            $table->string('provider_product_order_id')->nullable();
            $table->enum('status', ['Awaiting', 'Manual', 'Pending', 'In progress', 'Completed', 'Partial', 'Canceled', 'Failed'])->default('Awaiting');
            $table->decimal('amount', 16, 4)->default(0);
            $table->decimal('charge', 16, 4)->default(0);
            $table->integer('quantity')->default(1);
            $table->text('note')->nullable();
            $table->timestamps();

            $table->index('domain');
            $table->index('user_id');
            $table->index('status');
            $table->index('product_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_orders');
    }
};
