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
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            
            // Referrer and Referred User
            $table->foreignId('referrer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('referred_id')->constrained('users')->onDelete('cascade');
            
            // Affiliate Information
            $table->string('referral_code')->nullable();
            $table->decimal('commission_rate', 5, 4)->default(0);
            $table->decimal('total_earned', 15, 4)->default(0);
            $table->decimal('total_orders', 15, 4)->default(0);
            $table->integer('orders_count')->default(0);
            
            // Status and Dates
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->timestamp('first_order_at')->nullable();
            $table->timestamp('last_order_at')->nullable();
            $table->text('note')->nullable();
            
            $table->timestamps();
            $table->string('domain')->nullable();
            
            // Indexes
            $table->unique(['referrer_id', 'referred_id']);
            $table->index(['referrer_id', 'status']);
            $table->index(['referred_id', 'status']);
            $table->index('referral_code');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};