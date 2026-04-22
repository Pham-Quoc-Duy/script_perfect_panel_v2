<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_sync_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->nullable();
            $table->unsignedBigInteger('provider_id')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('service_api')->nullable();
            // change_type: price_increase, price_decrease, min_max_change, action_change
            $table->string('change_type')->default('price_increase');
            $table->decimal('old_value', 15, 8)->nullable();
            $table->decimal('new_value', 15, 8)->nullable();
            $table->string('field_changed')->nullable(); // rate, min, max, status
            $table->boolean('is_read')->default(false);
            $table->string('domain')->nullable();
            $table->timestamps();

            $table->index(['domain', 'is_read']);
            $table->index(['service_id']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_sync_logs');
    }
};
