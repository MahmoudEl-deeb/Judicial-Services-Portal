<?php


namespace Database\Factories;

use App\Models\User;
use App\Models\CassationDepartment;
use Illuminate\Database\Eloquent\Factories\Factory;

class JudgeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'judge_code' => 'J' . fake()->unique()->numberBetween(1000, 9999),
            'department_id' => CassationDepartment::factory(),
            'appointment_date' => fake()->dateTimeBetween('-10 years', '-1 year'),
        ];
    }
}
