<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Visit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VisitSeeder extends Seeder
{
    public function run(): void
    {
        $services = Service::with('department')->get();

        if ($services->isEmpty()) {
            return;
        }

        foreach ($services as $service) {
            // Successful completed visit
            Visit::create([
                'tracking_token' => 'TRK-' . strtoupper(Str::random(12)),
                'department_id' => $service->department_id,
                'service_id' => $service->id,
                'citizen_name' => null,
                'citizen_phone' => null,
                'citizen_comments' => 'Quick processing time, very smooth process.',
                'failure_reason' => null,
                'is_completed' => true,
                'rating' => 5,
                'entered_at' => now()->subMinutes(45),
                'exited_at' => now()->subMinutes(15),
            ]);

            // Failed/incomplete visit
            Visit::create([
                'tracking_token' => 'TRK-' . strtoupper(Str::random(12)),
                'department_id' => $service->department_id,
                'service_id' => $service->id,
                'citizen_name' => 'Ram Bahadur',
                'citizen_phone' => '+9779851000000',
                'citizen_comments' => 'The line was too long and system went offline.',
                'failure_reason' => 'server_down',
                'is_completed' => false,
                'rating' => null,
                'entered_at' => now()->subHours(2),
                'exited_at' => now()->subHours(1),
            ]);
        }
    }
}