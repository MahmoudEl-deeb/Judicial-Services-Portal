<?php

namespace Database\Seeders;

use App\Models\CourtCase;
use App\Models\Lawyer;
use App\Models\Judge;
use App\Models\CassationDepartment;
use Illuminate\Database\Seeder;

class CourtCaseSeeder extends Seeder
{
    public function run(): void
    {
        CourtCase::factory()->count(100)->create();
    }
}
