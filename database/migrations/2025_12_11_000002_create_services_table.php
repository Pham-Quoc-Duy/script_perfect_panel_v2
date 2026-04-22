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
        // Drop existing services table if exists
        Schema::dropIfExists('services');
        
        Schema::create('services', function (Blueprint $table) { 
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->json('name');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('position')->default(0);
            $table->json('attributes')->nullable();
            $table->decimal('rate_original', 15, 8)->default(4);

            // Markup rates for different customer types
            $table->decimal('rate_retail', 15, 8)->nullable();
            $table->decimal('rate_agent', 15, 8)->nullable();
            $table->decimal('rate_distributor', 15, 8)->nullable();
            
            // Additional rate fields
            $table->decimal('rate_retail_up', 15, 8)->nullable();
            $table->decimal('rate_agent_up', 15, 8)->nullable();
            $table->decimal('rate_distributor_up', 15, 8)->nullable();
            
            // Sync configuration
            $table->boolean('sync_rate')->default(false);
            $table->boolean('sync_min_max')->default(false);
            $table->boolean('sync_action')->default(false);
            
            $table->integer('min')->default(1);
            $table->integer('max')->default(10000);
            $table->string('service_api')->nullable();
            $table->string('provider_name')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('type')->default('api');
            $table->string('type_service')->nullable();
            $table->string('type_radio')->nullable();
            $table->boolean('refill')->default(false);
            $table->boolean('cancel')->default(false);
            $table->boolean('dripfeed')->default(false);
            $table->string('average_time')->nullable();
            $table->text('note')->nullable();
            $table->string('reaction')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->string('domain')->nullable();

            // Indexes
            $table->index(['category_id', 'status']);
            $table->index(['status', 'type']);
            $table->index('provider_name');
            $table->index('sync_action');
            $table->index('created_at');
            $table->index('domain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
