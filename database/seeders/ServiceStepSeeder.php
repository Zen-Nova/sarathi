<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceStep;
use Illuminate\Database\Seeder;

class ServiceStepSeeder extends Seeder
{
    public function run(): void
    {
        $renewalService = Service::where('name_en', 'Passport Renewal')->first();

        if ($renewalService) {
            $steps = [
                [
                    'step_number' => 1,
                    'room_number' => 'Room 101',
                    'counter_number' => 'Counter A',
                    'title_en' => 'Document Verification',
                    'title_np' => 'कागजात प्रमाणीकरण',
                ],
                [
                    'step_number' => 2,
                    'room_number' => 'Room 102',
                    'counter_number' => 'Counter C',
                    'title_en' => 'Biometric Capture',
                    'title_np' => 'बायोमेट्रिक विवरण सङ्कलन',
                ],
                [
                    'step_number' => 3,
                    'room_number' => 'Room 105',
                    'counter_number' => 'Counter 2',
                    'title_en' => 'Fee Payment & Receipt Collection',
                    'title_np' => 'राजस्व बुझाउने र रसिद लिने',
                ],
            ];

            foreach ($steps as $step) {
                // Safely update or insert based on the unique composite constraint key
                ServiceStep::updateOrCreate(
                    [
                        'service_id' => $renewalService->id,
                        'step_number' => $step['step_number'],
                    ],
                    [
                        'room_number' => $step['room_number'],
                        'counter_number' => $step['counter_number'],
                        'title_en' => $step['title_en'],
                        'title_np' => $step['title_np'],
                    ]
                );
            }
        }
    }
}