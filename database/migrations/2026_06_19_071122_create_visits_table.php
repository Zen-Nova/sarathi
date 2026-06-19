<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            // Secure unique token to identify this specific tracking session via URL/Cookie
            $table->string('tracking_token')->unique();
            
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            // Nullable initially because citizen chooses service *after* scanning the entry QR code
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            
            // Timestamps for workflow duration mapping
            $table->timestamp('entered_at');
            $table->timestamp('exited_at')->nullable();
            
            // Phase 2 Feedback Fields
            $table->boolean('is_completed')->nullable(); // true = Task Done, false = Failed
            $table->integer('rating')->nullable();       // 1 to 5 star metric if completed
            
            $table->string('citizen_name')->nullable();
            $table->string('citizen_phone')->nullable();

            // If task failed, store predefined structural categories or complaints
            $table->string('failure_reason')->nullable(); // e.g., 'server_down', 'missing_documents'
            $table->text('citizen_comments')->nullable(); // Optional text narrative field
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};