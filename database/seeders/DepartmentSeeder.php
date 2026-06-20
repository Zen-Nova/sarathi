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
            ['en' => 'Vehicle Registration', 'np' => 'सवारी दर्ता'],
            ['en' => 'Driving License', 'np' => 'सवारी चालक अनुमतिपत्र'],
            ['en' => 'Public Services', 'np' => 'सार्वजनिक सेवा'],
            ['en' => 'Taxation', 'np' => 'कर विभाग'],
            ['en' => 'Land Management', 'np' => 'भूमि व्यवस्था'],
            ['en' => 'Health Services', 'np' => 'स्वास्थ्य सेवा'],
            ['en' => 'Education', 'np' => 'शिक्षा विभाग'],
            ['en' => 'Social Welfare', 'np' => 'सामाजिक कल्याण'],
            ['en' => 'Employment', 'np' => 'रोजगार विभाग'],
            ['en' => 'Legal Affairs', 'np' => 'कानूनी मामला'],
            ['en' => 'Inland Revenue Department', 'np' => 'आन्तरिक राजस्व विभाग'],
            ['en' => 'Customs', 'np' => 'भन्सार विभाग'],
            ['en' => 'Foreign Affairs', 'np' => 'विदेश विभाग'],
            ['en' => 'Nepal Police', 'np' => 'नेपाल प्रहरी'],
            ['en' => 'Armed Police Force', 'np' => 'सशस्त्र प्रहरी बल'],
            ['en' => 'Nepal Army', 'np' => 'नेपाल सेना'],
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