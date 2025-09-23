<?php
namespace Database\Factories;

use App\Models\User;
use App\Models\Judge;
use App\Models\CassationDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class JudgeSercretoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'employee_id' => 'EMP' . fake()->unique()->numberBetween(1000, 9999),
            'judge_id' => null, // Will be set in seeder
            'department_id' => CassationDepartment::factory(),
        ];
    }
}
