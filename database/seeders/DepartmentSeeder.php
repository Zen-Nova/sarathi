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
    ];

    foreach ($departments as $dept) {
        // This will update existing records or insert new ones if missing safely
        \App\Models\Department::updateOrCreate(
            ['slug' => \Illuminate\Support\Str::slug($dept['en'])], // Unique lookup key
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