<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->integer('method_payment_id')->nullable();
            $table->string('name');
            $table->string('type')->default('other');
            $table->string('image')->nullable();
            $table->string('currency', 10)->default('USD');
            $table->decimal('min', 15, 2)->default(0);
            $table->decimal('max', 15, 2)->default(0);
            $table->integer('max_transactions')->default(0);
            $table->decimal('max_total_funds', 15, 2)->default(0);
            $table->json('bonus')->nullable();
            $table->string('details')->nullable();
            $table->json('config')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('status')->default(true);
            $table->string('domain')->nullable();
            $table->timestamps();
            
            $table->index('status');
            $table->index(['status', 'position']);
            $table->index('currency');
            $table->index('domain');
            $table->index('type');
            $table->index('method_payment_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};