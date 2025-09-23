<?php
namespace Database\Seeders;

use App\Models\CassationDepartment;
use Illuminate\Database\Seeder;

class CassationDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'department_code' => 'CIV001',
                'department_name_ar' => 'الدائرة المدنية الأولى',
                'department_name_en' => 'First Civil Department',
                'department_type' => 'civil'
            ],
            [
                'department_code' => 'COM001',
                'department_name_ar' => 'الدائرة التجارية الأولى',
                'department_name_en' => 'First Commercial Department',
                'department_type' => 'commercial'
            ],
            [
                'department_code' => 'CRM001',
                'department_name_ar' => 'الدائرة الجنائية الأولى',
                'department_name_en' => 'First Criminal Department',
                'department_type' => 'criminal'
            ],
            [
                'department_code' => 'ADM001',
                'department_name_ar' => 'الدائرة الإدارية الأولى',
                'department_name_en' => 'First Administrative Department',
                'department_type' => 'administrative'
            ],
            [
                'department_code' => 'CON001',
                'department_name_ar' => 'الدائرة الدستورية',
                'department_name_en' => 'Constitutional Department',
                'department_type' => 'constitutional'
            ],
        ];

        foreach ($departments as $dept) {
            CassationDepartment::create($dept);
        }

        // Create additional random departments
        CassationDepartment::factory()->count(5)->create();
    }
}