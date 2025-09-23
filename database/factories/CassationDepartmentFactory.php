<?php

// database/factories/CassationDepartmentFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CassationDepartmentFactory extends Factory
{
    private static $departmentTypes = [
        'civil' => ['Civil Affairs', 'الشؤون المدنية'],
        'commercial' => ['Commercial Affairs', 'الشؤون التجارية'],
        'criminal' => ['Criminal Affairs', 'الشؤون الجنائية'],
        'administrative' => ['Administrative Affairs', 'الشؤون الإدارية'],
        'constitutional' => ['Constitutional Affairs', 'الشؤون الدستورية'],
        'disciplinary' => ['Disciplinary Affairs', 'الشؤون التأديبية']
    ];

    public function definition(): array
    {
        $type = fake()->randomElement(array_keys(self::$departmentTypes));
        $names = self::$departmentTypes[$type];
        
        return [
            'department_code' => strtoupper(substr($type, 0, 3)) . fake()->unique()->numberBetween(100, 999),
            'department_name_ar' => $names[1],
            'department_name_en' => $names[0],
            'department_type' => $type,
            'head_judge_id' => null, // Will be set in seeder
        ];
    }
}
