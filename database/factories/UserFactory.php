<?php

// database/factories/UserFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $arabicFirstNames = [
            'أحمد', 'محمد', 'علي', 'حسن', 'حسام', 'خالد', 'عمر', 'يوسف', 'إبراهيم', 'عبدالله',
            'فاطمة', 'عائشة', 'خديجة', 'مريم', 'زينب', 'سارة', 'نور', 'هند', 'ليلى', 'آمال'
        ];
        
        $arabicLastNames = [
            'المصري', 'أحمد', 'محمد', 'علي', 'حسن', 'عبدالرحمن', 'الشريف', 'العربي', 'السيد', 
            'إبراهيم', 'عثمان', 'الطاهر', 'المحمدي', 'الأحمدي', 'العلي', 'الحسني', 'القاضي'
        ];

        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'first_name' => fake()->randomElement($arabicFirstNames),
            'last_name' => fake()->randomElement($arabicLastNames),
            'national_id' => fake()->unique()->numerify('##############'),
            'phone' => '+2' . fake()->randomElement(['01', '02', '03']) . fake()->numerify('#########'),
            'status' => fake()->randomElement(['active', 'inactive', 'suspended']),
            'email_verified_at' => fake()->optional()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function active()
    {
        return $this->state(['status' => 'active']);
    }

    public function verified()
    {
        return $this->state(['email_verified_at' => now()]);
    }
}
