<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DepartmentSeeder::class,
            ServiceSeeder::class,
            ServiceStepSeeder::class,
            VisitSeeder::class,
            userSeeder::class,
        ]);
    }
}