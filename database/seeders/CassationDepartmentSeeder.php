<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CassationDepartment;

class CassationDepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            [
                'department_code' => 'CIV100',
                'department_name_ar' => 'الشؤون المدنية',
                'department_name_en' => 'Civil Affairs',
                'department_type' => 'civil',
            ],
            [
                'department_code' => 'COM200',
                'department_name_ar' => 'الشؤون التجارية',
                'department_name_en' => 'Commercial Affairs',
                'department_type' => 'commercial',
            ],
            [
                'department_code' => 'CRM300',
                'department_name_ar' => 'الشؤون الجنائية',
                'department_name_en' => 'Criminal Affairs',
                'department_type' => 'criminal',
            ],
            [
                'department_code' => 'ADM400',
                'department_name_ar' => 'الشؤون الإدارية',
                'department_name_en' => 'Administrative Affairs',
                'department_type' => 'administrative',
            ],
            [
                'department_code' => 'CON500',
                'department_name_ar' => 'الشؤون الدستورية',
                'department_name_en' => 'Constitutional Affairs',
                'department_type' => 'constitutional',
            ],
            [
                'department_code' => 'DIS600',
                'department_name_ar' => 'الشؤون التأديبية',
                'department_name_en' => 'Disciplinary Affairs',
                'department_type' => 'disciplinary',
            ],
        ];

        foreach ($departments as $dept) {
            CassationDepartment::updateOrCreate(
                ['department_type' => $dept['department_type']],
                $dept
            );
        }
    }
}
