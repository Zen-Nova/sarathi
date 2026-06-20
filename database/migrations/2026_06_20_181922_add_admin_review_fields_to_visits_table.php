<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->timestamp('alert_acknowledged_at')->nullable()->after('failure_reason');
            $table->text('admin_notes')->nullable()->after('alert_acknowledged_at');
        });
    }

    public function down(): void
    {
        Schema::table('visits', function (Blueprint $table) {
            $table->dropColumn([
                'alert_acknowledged_at',
                'admin_notes',
            ]);
        });
    }
};