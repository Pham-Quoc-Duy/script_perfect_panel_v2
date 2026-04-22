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
        Schema::create('currency', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('symbol');
            $table->decimal('exchange_rate', 15, 8)->default(1.00000000);
            $table->string('name');
            $table->boolean('sync')->default(false);
            $table->tinyInteger('status')->default(1);
            $table->enum('symbol_position', ['before', 'after'])->default('before');
            $table->string('domain')->nullable();
            $table->timestamps();
            
            // Indexes for better performance
            $table->index('status');
            $table->index('domain');
            $table->index('code');
            $table->index(['status', 'domain']);
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency');
    }
};