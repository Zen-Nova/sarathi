<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['en' => 'Administration', 'np' => 'प्रशासन'],
            ['en' => 'Passport & Visa', 'np' => 'राहदानी र भिसा'],
            ['en' => 'National ID', 'np' => 'राष्ट्रिय परिचयपत्र'],
            ['en' => 'Transport', 'np' => 'यातायात व्यवस्था'],
        ];

        foreach ($departments as $dept) {
            Department::updateOrCreate(
                ['slug' => Str::slug($dept['en'])],
                [
                    'name_en' => $dept['en'],
                    'name_np' => $dept['np'],
                    'description_en' => "Department handling {$dept['en']} related applications and workflows.",
                    'description_np' => "{$dept['np']} सम्बन्धी आवेदन तथा कार्यप्रवाह हेर्ने शाखा।",
                    'is_active' => true,
                ]
            );
        }
    }
}