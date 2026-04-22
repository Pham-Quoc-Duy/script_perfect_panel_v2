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
        Schema::create('api_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('type');
            $table->string('link')->nullable();
            $table->string('api_key');
            $table->string('rate_api')->nullable();
            $table->decimal('balance', 15, 8)->default(0);
            $table->string('fixed_decimal')->default('4');
            $table->boolean('warning')->default(true);
            $table->string('currency')->default('USD');
            $table->text('note')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->string('domain')->nullable();

            // Indexes
            $table->index('type');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_providers');
    }
};
