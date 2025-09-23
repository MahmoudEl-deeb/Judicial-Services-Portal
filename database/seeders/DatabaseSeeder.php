<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CassationDepartmentSeeder::class,
            UserSeeder::class,
            JudgeSeeder::class,
            JudgeSecretarySeeder::class,
            LawyerSeeder::class,
            ServiceTypeSeeder::class,
            CourtCaseSeeder::class,
            ServiceRequestSeeder::class,
            AppellantRespondentSeeder::class,
        ]);
    }
}
