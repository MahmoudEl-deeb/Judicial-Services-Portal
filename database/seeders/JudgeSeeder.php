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
        // Get users with judge role
        $judgeUsers = User::role('judge')->get();
        
        foreach ($judgeUsers as $user) {
            Judge::create([
                'user_id' => $user->id,
                'judge_code' => 'J' . str_pad(Judge::count() + 1, 4, '0', STR_PAD_LEFT),
                'department_id' => CassationDepartment::inRandomOrder()->first()->id,
                'appointment_date' => fake()->dateTimeBetween('-10 years', '-1 year'),
            ]);
        }

        // Create additional judges if needed
        $neededJudges = 20 - $judgeUsers->count();
        if ($neededJudges > 0) {
            Judge::factory()->count($neededJudges)->create();
        }

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