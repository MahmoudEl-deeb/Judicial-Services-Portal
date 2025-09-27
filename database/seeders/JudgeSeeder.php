<?php

namespace Database\Seeders;

use App\Models\Judge;
use App\Models\User;
use App\Models\CassationDepartment;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class JudgeSeeder extends Seeder
{
    public function run(): void
    {
        Judge::factory()->count(20)->create();

        // Assign head judges to departments
        $departments = CassationDepartment::all();
        $judges = Judge::all();

        foreach ($departments as $department) {
            $departmentJudge = $judges->where('department_id', $department->id)->first();
            if ($departmentJudge) {
                $department->update(['head_judge_id' => $departmentJudge->user_id]);
            }
        }
    }
}
