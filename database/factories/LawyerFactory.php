<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LawyerFactory extends Factory
{
    public function definition(): array
    {
        $arabicSpecializations = [
            'القانون المدني',
            'القانون الجنائي',
            'القانون التجاري',
            'القانون الإداري',
            'القانون الدستوري',
            'قانون العمل',
            'قانون الأحوال الشخصية',
            'القانون الضريبي',
            'القانون البحري',
            'القانون العقاري'
        ];

        return [
            'user_id' => User::factory(),
            'bar_registration_number' => 'نقابة/' . fake()->unique()->numberBetween(10000, 99999),
            'bar_registration_image' => 'bar_registrations/' . fake()->uuid() . '.pdf',
            'specialization' => fake()->randomElement($arabicSpecializations),
        ];
    }

}