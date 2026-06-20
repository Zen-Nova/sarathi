<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            
            // Dual-language support for the service name (e.g., Passport Renewal / राहदानी नवीकरण)
            $table->string('name_en');
            $table->string('name_np');
            
            $table->string('slug')->unique();
            $table->text('desc_en')->nullable();
            $table->text('desc_ne')->nullable();
            $table->string('est_en')->nullable();
            $table->string('est_ne')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};