<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceType;
use App\Models\CassationDepartment;

class ServiceTypeSeeder extends Seeder
{
    public function run(): void
    {
        $serviceTypes = [
            'cassation_appeal_filing' => ['تقديم طعن بالنقض', 'Cassation Appeal Filing', 'خدمة تقديم الطعون بالنقض أمام محكمة النقض'],
            'cassation_case_status' => ['الاستعلام عن حالة القضية', 'Cassation Case Status', 'خدمة الاستعلام عن الحالة الحالية للقضايا المرفوعة'],
            'cassation_judgment_copy' => ['صورة طبق الأصل من الحكم', 'Cassation Judgment Copy', 'الحصول على صورة معتمدة من الأحكام الصادرة'],
            'cassation_hearing_certificate' => ['شهادة حضور جلسة', 'Cassation Hearing Certificate', 'شهادة بحضور جلسات المحاكمة'],
            'cassation_case_extract' => ['مستخرج قضية', 'Cassation Case Extract', 'مستخرج كامل لبيانات القضية'],
            'cassation_execution_order' => ['أمر تنفيذ الحكم', 'Cassation Execution Order', 'إصدار أمر تنفيذ الأحكام النهائية'],
            'cassation_legal_memo' => ['مذكرة قانونية', 'Legal Memorandum', 'إعداد المذكرات القانونية للقضايا'],
            'cassation_precedent_search' => ['بحث في السوابق القضائية', 'Precedent Search', 'البحث في السوابق القضائية ذات الصلة'],
        ];

        foreach ($serviceTypes as $key => $names) {
            ServiceType::firstOrCreate(
                ['cassation_service_type' => $key],
                [
                    'service_type_key' => strtoupper(str_replace('_', '', $key)) . rand(100, 999),
                    'service_name_ar' => $names[0],
                    'service_name_en' => $names[1],
                    'description_ar' => $names[2],
                    'description_en' => 'Service description in English',
                    'responsible_department_id' => CassationDepartment::factory()->create()->id,
                    'required_documents' => json_encode([
                        'صورة البطاقة الشخصية',
                        'توكيل المحامي',
                        'مستندات القضية'
                    ]),
                    'base_fee' => fake()->randomFloat(2, 100, 1000),
                    'urgent_fee_multiplier' => fake()->randomFloat(2, 1.5, 3.0),
                    'processing_days' => fake()->numberBetween(3, 30),
                    'urgent_processing_hours' => fake()->numberBetween(24, 72),
                    'allows_urgent' => fake()->boolean(),
                    'requires_case_reference' => fake()->boolean(),
                    'requires_lawyer_signature' => fake()->boolean(),
                    'requires_department_approval' => fake()->boolean(),
                    'is_active' => true,
                ]
            );
        }
    }
}
