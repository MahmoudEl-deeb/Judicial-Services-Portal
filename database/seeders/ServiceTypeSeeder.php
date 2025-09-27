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
            'cassation_appeal_filing'       => ['تقديم طعن بالنقض', 'Cassation Appeal Filing', 'خدمة تقديم الطعون بالنقض أمام محكمة النقض', 'civil'],
            'cassation_case_status'         => ['الاستعلام عن حالة القضية', 'Cassation Case Status', 'خدمة الاستعلام عن الحالة الحالية للقضايا المرفوعة', 'administrative'],
            'cassation_judgment_copy'       => ['صورة طبق الأصل من الحكم', 'Cassation Judgment Copy', 'الحصول على صورة معتمدة من الأحكام الصادرة', 'civil'],
            'cassation_hearing_certificate' => ['شهادة حضور جلسة', 'Cassation Hearing Certificate', 'شهادة بحضور جلسات المحاكمة', 'criminal'],
            'cassation_case_extract'        => ['مستخرج قضية', 'Cassation Case Extract', 'مستخرج كامل لبيانات القضية', 'administrative'],
            'cassation_execution_order'     => ['أمر تنفيذ الحكم', 'Cassation Execution Order', 'إصدار أمر تنفيذ الأحكام النهائية', 'commercial'],
            'cassation_legal_memo'          => ['مذكرة قانونية', 'Legal Memorandum', 'إعداد المذكرات القانونية للقضايا', 'civil'],
            'cassation_precedent_search'    => ['بحث في السوابق القضائية', 'Precedent Search', 'البحث في السوابق القضائية ذات الصلة', 'constitutional'],
        ];

        foreach ($serviceTypes as $key => $names) {
            $department = CassationDepartment::where('department_type', $names[3])->first();

            ServiceType::updateOrCreate(
                ['cassation_service_type' => $key],
                [
                    'service_type_key' => strtoupper(str_replace('_', '', $key)) . '001', // ثابت
                    'service_name_ar' => $names[0],
                    'service_name_en' => $names[1],
                    'description_ar' => $names[2],
                    'description_en' => 'Service description in English',
                    'responsible_department_id' => $department?->id,
                    'required_documents' => json_encode([
                        'صورة البطاقة الشخصية',
                        'توكيل المحامي',
                        'مستندات القضية'
                    ]),
                    'base_fee' => 500.00,
                    'urgent_fee_multiplier' => 2.0,
                    'processing_days' => 14,
                    'urgent_processing_hours' => 48,
                    'allows_urgent' => true,
                    'requires_case_reference' => true,
                    'requires_lawyer_signature' => in_array($key, ['cassation_appeal_filing','cassation_legal_memo']),
                    'requires_department_approval' => in_array($key, ['cassation_execution_order','cassation_precedent_search']),
                    'is_active' => true,
                ]
            );
        }
    }
}
