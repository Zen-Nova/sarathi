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

            // Unique token for each citizen visit/session
            $table->string('tracking_token')->unique();

            // Selected department and service
            $table->foreignId('department_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('service_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Visit timing
            $table->timestamp('entered_at');
            $table->timestamp('exited_at')->nullable();

            // Feedback result
            $table->boolean('is_completed')->nullable();
            $table->unsignedTinyInteger('rating')->nullable();

            // Optional citizen identity
            $table->string('citizen_name')->nullable();
            $table->string('citizen_phone', 20)->nullable();

            // Failure reason stores key like: server_down, missing_doc, long_queue
            $table->string('failure_reason', 50)->nullable();

            // Optional feedback/comment
            $table->text('citizen_comments')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visits');
    }
};