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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            // The unique identifier used in the QR code URL (e.g., ?office=passport)
            $table->string('slug')->unique(); 
            
            // Dual-language support columns
            $table->string('name_en');
            $table->string('name_np'); // Nepali Name
            
            $table->text('description_en')->nullable();
            $table->text('description_np')->nullable();
            
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};