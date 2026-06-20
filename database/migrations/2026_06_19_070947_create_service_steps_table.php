<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            
            // Step ordering (e.g., Step 1, Step 2, Step 3...)
            $table->integer('step_number');
            
            // Dynamic office identifiers
            $table->string('room_number')->nullable();
            $table->string('counter_number')->nullable();
            
            // Dual-language operational instructions & documentation requirements
            $table->string('title_en');
            $table->string('title_np');
            $table->text('instructions_en')->nullable();
            $table->text('instructions_np')->nullable();
            $table->json('requirements_en')->nullable();
            $table->json('requirements_ne')->nullable();
            
            $table->timestamps();
            
            // Ensure proper structural ordering uniqueness
            $table->unique(['service_id', 'step_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_steps');
    }
};