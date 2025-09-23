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
        // Get users with judge_secretary role
        $secretaryUsers = User::role('judge_secretary')->get();
        
        foreach ($secretaryUsers as $user) {
            JudgeSercretory::create([
                'user_id' => $user->id,
                'employee_id' => 'EMP' . str_pad(JudgeSercretory::count() + 1, 4, '0', STR_PAD_LEFT),
                'judge_id' => Judge::inRandomOrder()->first()->id,
                'department_id' => CassationDepartment::inRandomOrder()->first()->id,
            ]);
        }

        // Create additional secretaries if needed
        $neededSecretaries = 30 - $secretaryUsers->count();
        if ($neededSecretaries > 0) {
            JudgeSercretory::factory()->count($neededSecretaries)->create();
        }
    }
}
