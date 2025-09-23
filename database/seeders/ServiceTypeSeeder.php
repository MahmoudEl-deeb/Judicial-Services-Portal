<?Php

namespace Database\Seeders;

use App\Models\ServiceType;
use App\Models\CassationDepartment;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'service_type_key' => 'APPEAL_FILING',
                'service_name_ar' => 'تقديم طعن بالنقض',
                'service_name_en' => 'Cassation Appeal Filing',
                'description_ar' => 'خدمة تقديم الطعون بالنقض أمام محكمة النقض ضد الأحكام الصادرة من المحاكم الأدنى',
                'description_en' => 'Service for filing cassation appeals against lower court judgments',
                'cassation_service_type' => 'cassation_appeal_filing',
                'required_documents' => json_encode([
                    'صورة البطاقة الشخصية',
                    'توكيل المحامي',
                    'صورة الحكم المطعون فيه',
                    'مذكرة الطعن'
                ]),
                'base_fee' => 500.00,
                'processing_days' => 7,
                'allows_urgent' => true,
                'requires_lawyer_signature' => true,
            ],
            [
                'service_type_key' => 'CASE_STATUS',
                'service_name_ar' => 'الاستعلام عن حالة القضية',
                'service_name_en' => 'Case Status Inquiry',
                'description_ar' => 'خدمة الاستعلام عن الحالة الحالية للقضايا المرفوعة أمام محكمة النقض',
                'description_en' => 'Service for inquiring about the current status of cassation cases',
                'cassation_service_type' => 'cassation_case_status',
                'required_documents' => json_encode([
                    'صورة البطاقة الشخصية',
                    'رقم القضية'
                ]),
                'base_fee' => 50.00,
                'processing_days' => 1,
                'allows_urgent' => true,
                'requires_case_reference' => true,
            ],
            [
                'service_type_key' => 'JUDGMENT_COPY',
                'service_name_ar' => 'صورة طبق الأصل من الحكم',
                'service_name_en' => 'Certified Judgment Copy',
                'description_ar' => 'الحصول على صورة معتمدة طبق الأصل من الأحكام الصادرة من محكمة النقض',
                'description_en' => 'Obtaining certified copies of cassation court judgments',
                'cassation_service_type' => 'cassation_judgment_copy',
                'required_documents' => json_encode([
                    'صورة البطاقة الشخصية',
                    'رقم الحكم',
                    'إيصال سداد الرسوم'
                ]),
                'base_fee' => 100.00,
                'processing_days' => 3,
                'allows_urgent' => true,
                'requires_case_reference' => true,
            ],
            [
                'service_type_key' => 'HEARING_CERTIFICATE',
                'service_name_ar' => 'شهادة حضور جلسة',
                'service_name_en' => 'Hearing Attendance Certificate',
                'description_ar' => 'إصدار شهادة بحضور جلسات المحاكمة أمام محكمة النقض',
                'description_en' => 'Issuing certificates of attendance at cassation court hearings',
                'cassation_service_type' => 'cassation_hearing_certificate',
                'required_documents' => json_encode([
                    'صورة البطاقة الشخصية',
                    'رقم القضية',
                    'تاريخ الجلسة'
                ]),
                'base_fee' => 75.00,
                'processing_days' => 2,
                'allows_urgent' => false,
                'requires_case_reference' => true,
            ],
        ];

        foreach ($services as $service) {
            ServiceType::create(array_merge($service, [
                'responsible_department_id' => CassationDepartment::inRandomOrder()->first()->id,
                'urgent_fee_multiplier' => 2.0,
                'urgent_processing_hours' => 24,
                'is_active' => true,
            ]));
        }

        // Create additional service types
        ServiceType::factory()->active()->count(15)->create();
    }
}