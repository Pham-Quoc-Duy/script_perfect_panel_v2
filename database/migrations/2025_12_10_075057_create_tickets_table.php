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
        // Tạo bảng ticket_subjects
        Schema::create('ticket_subjects', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('subcategory')->nullable();
            $table->boolean('show_message_only')->default(false);
            $table->json('required_fields')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            // Indexes
            $table->index('status');
            $table->index('sort_order');
        });

        // Tạo bảng tickets
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('domain')->nullable();
            $table->foreignId('subject_id')->constrained('ticket_subjects')->onDelete('cascade');
            $table->string('subject');
            $table->text('message');
            $table->json('custom_fields')->nullable();
            $table->enum('status', ['open', 'answered', 'closed'])->default('open');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->timestamp('last_reply_at')->nullable();
            $table->foreignId('assigned_to')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            
            // Indexes
            $table->index('domain');
            $table->index('user_id');
            $table->index('status');
            $table->index('priority');
            $table->index('created_at');
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
        Schema::dropIfExists('ticket_subjects');
    }
};
