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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // Basic order information
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('link');
            $table->longText('comment')->nullable();
            $table->integer('quantity');
            
            // Pricing information
            $table->decimal('rate', 15, 8)->default(4);
            $table->decimal('charge', 15, 8)->default(4);
            $table->decimal('total', 15, 8)->default(4);
            
            // Order progress tracking
            $table->integer('start_count')->default(0);
            $table->integer('remains')->default(0);
            
            // Provider information
            $table->string('orders_api')->nullable();
            $table->string('service_api')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('type')->default('default');
            
            // Service features
            $table->boolean('refill')->default(false);
            $table->enum('refill_status', ['pending', 'rejected', 'completed'])->nullable();
            $table->boolean('cancel')->default(false);
            $table->enum('cancel_status', ['pending', 'rejected', 'completed'])->nullable();
            $table->boolean('dripfeed')->default(false);
            
            // Ticket information (for support requests like speedup, refill, cancel)
            $table->string('ticket')->nullable();
            
            // Loop functionality
            $table->integer('loop_quantity')->nullable();
            $table->integer('loop_spacing')->nullable();
            
            // Time tracking
            $table->timestamp('schedule_time')->nullable();
            $table->timestamp('start_time')->nullable();
            $table->timestamp('success_time')->nullable();
            
            // Additional information
            $table->text('note')->nullable();
            $table->string('reaction')->nullable();
            $table->enum('status', ['awaiting', 'pending', 'processing', 'in_progress', 'completed', 'partial', 'canceled','failed'])->default('pending');
            $table->string('currency')->default('USD');
            
            // JSON data columns
            $table->json('order_data')->nullable();
            $table->json('response_data')->nullable();
            
            $table->timestamps();
            $table->string('domain')->nullable();
            
            // Performance indexes
            $table->index('user_id');
            $table->index('service_id');
            $table->index('status');
            $table->index('created_at');
            $table->index('provider_id');
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};