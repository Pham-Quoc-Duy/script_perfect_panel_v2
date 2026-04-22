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
        Schema::create('child_panels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Panel Information
            $table->string('domain'); // Domain from getDomain()
            $table->string('domain_panel')->unique(); // Domain from user input
            
            // Statistics
            $table->integer('total_orders')->default(0);
            $table->integer('total_services')->default(0);
            $table->integer('total_users')->default(0);
            
            // Access Level
            $table->decimal('price', 15, 2)->default(0);
            $table->string('access')->default('child');
            
            // Settings (JSON)
            $table->json('settings')->nullable();
            
            // Status & Dates
            $table->enum('status', ['pending', 'completed', 'suspended'])->default('pending');
            $table->timestamp('last_sync_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('user_id');
            $table->index('domain');
            $table->index('domain_panel');
            $table->index('access');
            $table->index('status');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('child_panels');
    }
};
