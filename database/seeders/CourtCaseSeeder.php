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
        $lawyers = Lawyer::all();
        $judges = Judge::all();
        $departments = CassationDepartment::all();

        CourtCase::factory()->count(100)->create()->each(function ($case) use ($lawyers, $judges, $departments) {
            $case->update([
                'lawyer_id' => $lawyers->random()->id,
                'assigned_judge_id' => $judges->random()->id,
                'department_id' => $departments->random()->id,
            ]);
        });
    }
}
