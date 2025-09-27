<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ServiceType;
use App\Models\CassationDepartment;
use App\Models\JudgeSecretary;
use App\Models\CourtCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceRequestFactory extends Factory
{
    public function definition(): array
    {
        $statuses = [
            'pending', 'under_department_review', 'assigned_to_secretary', 'in_progress',
            'pending_approval', 'approved', 'rejected', 'completed', 'cancelled', 'awaiting_payment'
        ];

        $arabicRequestTitles = [
            'طلب صورة طبق الأصل من الحكم',
            'طلب استعلام عن حالة القضية',
            'طلب تقديم طعن بالنقض',
            'طلب شهادة جلسة محاكمة',
            'طلب مستخرج قضية',
            'طلب تنفيذ حكم النقض'
        ];

        $arabicDescriptions = [
            'طلب الحصول على صورة معتمدة من الحكم الصادر في القضية',
            'استعلام عن الحالة الحالية للقضية المرفوعة أمام المحكمة',
            'تقديم طعن بالنقض ضد الحكم الصادر من المحكمة الأدنى',
            'طلب الحصول على شهادة بحضور جلسة المحاكمة'
        ];

        $baseFee = fake()->randomFloat(2, 50, 500);
        $isUrgent = fake()->boolean(30);
        $urgentFee = $isUrgent ? $baseFee * fake()->randomFloat(2, 0.5, 2.0) : 0;
        $totalFee = $baseFee + $urgentFee;

        return [
            'request_number' => 'طلب/' . fake()->year() . '/' . fake()->unique()->numberBetween(10000, 99999),
            'requester_id' => fn() => User::inRandomOrder()->first()->id,
            'service_type_id' => fn() => ServiceType::inRandomOrder()->first()->id,
            'department_id' => fn() => CassationDepartment::inRandomOrder()->first()->id,
            'assigned_secretary_id' => null,
            'approved_by_secretary_id' => null,
            'request_title' => fake()->randomElement($arabicRequestTitles),
            'request_description' => fake()->optional()->randomElement($arabicDescriptions),
            'related_case_id' => fake()->optional()->randomElement([null, CourtCase::factory()]),
            'status' => fake()->randomElement($statuses),
            'priority' => fake()->randomElement(['normal', 'urgent']),
            'is_urgent_service' => $isUrgent,
            'is_prepaid_service' => fake()->boolean(20),
            'base_fees_amount' => $baseFee,
            'urgent_fees_amount' => $urgentFee,
            'total_fees_amount' => $totalFee,
            'payment_status' => fake()->randomElement(['pending', 'partial_paid', 'paid', 'refunded']),
            'requested_date' => fake()->dateTimeBetween('-3 months', 'now'),
            'assigned_to_secretary_date' => fake()->optional()->dateTimeBetween('-2 months', 'now'),
            'department_review_date' => fake()->optional()->dateTimeBetween('-2 months', 'now'),
            'expected_completion_date' => fake()->optional()->dateTimeBetween('now', '+1 month'),
            'urgent_completion_deadline' => $isUrgent ? fake()->dateTimeBetween('now', '+1 week') : null,
            'approved_date' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'completed_date' => fake()->optional()->dateTimeBetween('-1 month', 'now'),
            'processing_time_hours' => fake()->optional()->numberBetween(1, 240),
            'urgent_processing_time_hours' => $isUrgent ? fake()->numberBetween(1, 72) : null,
            'department_notes' => fake()->optional()->randomElement([
                'تم مراجعة الطلب وهو مكتمل المستندات',
                'يحتاج الطلب إلى مستندات إضافية',
                'تم إحالة الطلب للقسم المختص'
            ]),
            'secretary_notes' => fake()->optional()->randomElement([
                'تم البدء في معالجة الطلب',
                'في انتظار موافقة الرئيس المباشر',
                'تم الانتهاء من معالجة الطلب'
            ]),
            'approval_notes' => fake()->optional()->randomElement([
                'تمت الموافقة على الطلب',
                'تم رفض الطلب لعدم استيفاء الشروط'
            ]),
            'rejection_reason' => fake()->optional()->randomElement([
                'عدم اكتمال المستندات المطلوبة',
                'عدم سداد الرسوم المقررة',
                'عدم توافق الطلب مع اللوائح'
            ]),
        ];
    }

    public function pending()
    {
        return $this->state(['status' => 'pending']);
    }

    public function completed()
    {
        return $this->state([
            'status' => 'completed',
            'completed_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'payment_status' => 'paid'
        ]);
    }
}
