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
            'cassation_appeal_filing' => [
                'تقديم طعن بالنقض',
                'Cassation Appeal Filing',
                'خدمة تقديم الطعون بالنقض أمام محكمة النقض',
                'civil',
                [
                    'صحيفة الطعن الأصلية موقعة من المحامي',
                    'صورة رسمية من الحكم المطعون فيه',
                    'صورة البطاقة الشخصية للمحامي أو التوكيل',
                ],
            ],
            'cassation_case_status' => [
                'الاستعلام عن حالة القضية',
                'Cassation Case Status',
                'خدمة الاستعلام عن الحالة الحالية للقضايا المرفوعة',
                'administrative',
                [
                    'رقم القضية أو رقم الطعن',
                    'صورة بطاقة مقدم الطلب',
                ],
            ],
            'cassation_judgment_copy' => [
                'صورة طبق الأصل من الحكم',
                'Cassation Judgment Copy',
                'الحصول على صورة معتمدة من الأحكام الصادرة',
                'civil',
                [
                    'طلب رسمي موقع من المحامي أو صاحب الشأن',
                    'صورة من الحكم',
                ],
            ],
            'cassation_hearing_certificate' => [
                'شهادة حضور جلسة',
                'Cassation Hearing Certificate',
                'شهادة بحضور جلسات المحاكمة',
                'criminal',
                [
                    'طلب كتابي باسم المحكمة',
                    'بطاقة هوية أو توكيل رسمي',
                ],
            ],
            'cassation_case_extract' => [
                'مستخرج قضية',
                'Cassation Case Extract',
                'مستخرج كامل لبيانات القضية',
                'administrative',
                [
                    'طلب استخراج موقع من المحامي',
                    'بيانات القضية (رقم، سنة، نوع)',
                ],
            ],
            'cassation_execution_order' => [
                'أمر تنفيذ الحكم',
                'Cassation Execution Order',
                'إصدار أمر تنفيذ الأحكام النهائية',
                'commercial',
                [
                    'نسخة تنفيذية من الحكم',
                    'محضر إعلان الحكم',
                    'توكيل المحامي',
                ],
            ],
            'cassation_legal_memo' => [
                'مذكرة قانونية',
                'Legal Memorandum',
                'إعداد المذكرات القانونية للقضايا',
                'civil',
                [
                    'توكيل المحامي',
                    'مستندات القضية كاملة',
                    'ملخص بالطلبات القانونية',
                ],
            ],
            'cassation_precedent_search' => [
                'بحث في السوابق القضائية',
                'Precedent Search',
                'البحث في السوابق القضائية ذات الصلة',
                'constitutional',
                [
                    'موضوع البحث القانوني',
                    'مذكرة بطلب البحث',
                ],
            ],
        ];

        foreach ($serviceTypes as $key => $data) {
            [$nameAr, $nameEn, $descAr, $deptType, $docs] = $data;

            $department = CassationDepartment::where('department_type', $deptType)->first();

            ServiceType::updateOrCreate(
                ['cassation_service_type' => $key],
                [
                    'service_type_key' => strtoupper(str_replace('_', '', $key)) . '001',
                    'service_name_ar' => $nameAr,
                    'service_name_en' => $nameEn,
                    'description_ar' => $descAr,
                    'description_en' => 'Service description in English',
                    'responsible_department_id' => $department?->id,
                    'required_documents' => $docs, // مختلف لكل خدمة
                    'base_fee' => 500.00,
                    'urgent_fee_multiplier' => 2.0,
                    'processing_days' => 14,
                    'urgent_processing_days' => 3,
                    'allows_urgent' => true,
                    'requires_case_reference' => true,
                    'requires_lawyer_signature' => in_array($key, ['cassation_appeal_filing', 'cassation_legal_memo']),
                    'requires_department_approval' => in_array($key, ['cassation_execution_order', 'cassation_precedent_search']),
                    'is_prepaid_service' => in_array($key, ['cassation_case_status', 'cassation_hearing_certificate']),
                    'is_active' => true,
                ]
            );
        }
    }
}
