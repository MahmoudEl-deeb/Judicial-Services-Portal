<?php

namespace Database\Factories;

use App\Models\CourtCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppellantFactory extends Factory
{
    public function definition(): array
    {
        $arabicNames = [
            'أحمد محمد علي المصري',
            'فاطمة عبدالرحمن السيد',
            'محمد حسن إبراهيم أحمد',
            'عائشة خالد عثمان',
            'علي يوسف المحمدي',
            'مريم سعد الدين العلي',
            'حسام الدين محمود',
            'نور الهدى عبدالله',
            'عمر أنس الشريف',
            'زينب محمد الطاهر'
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
        ];
    }
}