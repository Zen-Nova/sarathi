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
            RequiredDocumentSeeder::class,
            VisitSeeder::class,
            UserSeeder::class,
        ]);
    }
}   