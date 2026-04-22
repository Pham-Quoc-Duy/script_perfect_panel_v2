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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->decimal('balance', 15, 8)->default(4);
            $table->decimal('spent', 15, 8)->default(4);
            $table->string('api_key')->unique()->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('timezone')->default(14400);
            $table->string('lang')->default('en');
            $table->string('currency')->default('USD');
            
            // User level and role
            $table->enum('level', ['retail', 'agent', 'distributor'])->default('retail');
            $table->enum('role', ['member', 'admin'])->default('member');
            
            // Transfer code for money transfers
            $table->string('transfer_code')->unique()->nullable();
            
            // Referral code
            $table->string('referral_code')->unique()->nullable();
            
            // 2FA Authentication
            $table->boolean('two_factor_enabled')->default(false);
            $table->string('two_factor_secret')->nullable();
            $table->text('two_factor_recovery_codes')->nullable();
            $table->timestamp('two_factor_confirmed_at')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
            $table->string('domain')->nullable();
            
            // Indexes for performance
            $table->index('email');
            $table->index('username');
            $table->index('api_key');
            $table->index('is_active');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
