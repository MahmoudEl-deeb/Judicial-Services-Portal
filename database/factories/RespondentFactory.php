<?php

namespace Database\Factories;

use App\Models\CourtCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class RespondentFactory extends Factory
{
    public function definition(): array
    {
        $arabicNames = [
            'خالد عبدالعزيز محمد',
            'هند أحمد عبدالرحمن',
            'يوسف محمود الحسني',
            'آمال سعد الدين',
            'إبراهيم علي المحمدي',
            'ليلى حسام الطاهر',
            'عبدالله محمد السيد',
            'سارة يوسف العربي',
            'حسن أحمد الشريف',
            'نادية عمر القاضي'
        ];

        $egyptianAddresses = [
            'شارع النيل، الزمالك، القاهرة',
            'شارع الهرم، الهرم، الجيزة',
            'كورنيش النيل، الإسكندرية',
            'شارع الجمهورية، وسط البلد، القاهرة',
            'شارع التحرير، الدقي، الجيزة',
            'شارع صلاح سالم، مصر الجديدة، القاهرة',
            'شارع الملك فيصل، الهرم، الجيزة',
            'شارع 26 يوليو، الزمالك، القاهرة',
            'كورنيش المعادي، المعادي، القاهرة',
            'شارع الجيش، الإسكندرية'
        ];

        return [
            'case_id' => CourtCase::factory(),
            'full_name' => fake()->randomElement($arabicNames),
            'national_id' => fake()->unique()->numerify('##############'),
            'phone' => '+2' . fake()->randomElement(['010', '011', '012', '015']) . fake()->numerify('#########'),
            'email' => fake()->optional()->email(),
            'address' => fake()->randomElement($egyptianAddresses),
            'type' => fake()->randomElement(['individual', 'company', 'government']),
            'representative_name' => fake()->optional()->randomElement($arabicNames),
        ];
    }
}