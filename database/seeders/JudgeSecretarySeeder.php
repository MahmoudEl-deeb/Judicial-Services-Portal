<?php

namespace Database\Seeders;

use App\Models\JudgeSercretory;
use App\Models\User;
use App\Models\Judge;
use App\Models\CassationDepartment;
use Illuminate\Database\Seeder;

class JudgeSecretarySeeder extends Seeder
{
    public function run(): void
    {
        JudgeSercretory::factory()->count(30)->create();
    }
}
