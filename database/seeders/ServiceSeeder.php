<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Department::where('slug', 'administration')->first();
        $passport = Department::where('slug', 'passport-visa')->first();

        if ($admin) {
            Service::create([
                'department_id' => $admin->id,
                'name_en' => 'General Inquiry',
                'name_np' => 'साधारण सोधपुछ',
                'is_active' => true,
            ]);
        }

        if ($passport) {
            Service::create([
                'department_id' => $passport->id,
                'name_en' => 'New Passport Application',
                'name_np' => 'नयाँ राहदानी आवेदन',
                'is_active' => true,
            ]);
            
            Service::create([
                'department_id' => $passport->id,
                'name_en' => 'Passport Renewal',
                'name_np' => 'राहदानी नवीकरण',
                'is_active' => true,
            ]);
        }
    }
}