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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['spin', 'box'])->default('spin');
            $table->boolean('status')->default(true);
            $table->integer('max_spins_per_day')->default(1);
            $table->integer('max_spins_total')->default(0);
            $table->json('rewards');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('domain')->nullable();
            $table->timestamps();
            
            // Indexes
            $table->index(['status', 'start_date', 'end_date']);
            $table->index('domain');
            $table->index('created_at');
        });

        Schema::create('event_spins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('reward_name');
            $table->decimal('reward_amount', 15, 4)->default(0);
            $table->string('ip_address')->nullable();
            $table->timestamp('created_at')->useCurrent();
            
            // Indexes
            $table->index(['event_id', 'user_id', 'created_at']);
            $table->index('user_id');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_spins');
        Schema::dropIfExists('events');
    }
};
