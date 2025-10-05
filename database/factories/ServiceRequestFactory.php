<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\ServiceType;
use App\Models\CassationDepartment;
use App\Models\CourtCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceRequestFactory extends Factory
{
    public function definition(): array
    {
        $statuses = ['pending_approval','approved','rejected','completed'];
        $priorities = ['normal','urgent'];
        $paymentMethods = ['online', 'bank_transfer'];
        $paymentStatuses = ['pending','paid'];

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

        return [
            'request_number' => 'طلب/' . fake()->year() . '/' . fake()->unique()->numberBetween(10000, 99999),
            'requester_id' => fn() => User::inRandomOrder()->first()->id,
            'service_type_id' => fn() => ServiceType::inRandomOrder()->first()->id,
            'department_id' => fn() => CassationDepartment::inRandomOrder()->first()->id,
            'assigned_secretary_id' => null,
            'approved_by_secretary_id' => null,
            'request_title' => fake()->randomElement($arabicRequestTitles),
            'request_description' => fake()->optional()->randomElement($arabicDescriptions),
            'related_case_id' => fn() => CourtCase::factory(),
            'status' => fake()->randomElement($statuses),
            'priority' => fake()->randomElement($priorities),
            'is_urgent_service' => fake()->boolean(30),
            'is_prepaid_service' => fake()->boolean(20),
            'client_national_id' => fake()->numerify('##############'),
            'payment_method' => fake()->optional()->randomElement($paymentMethods),
            'submitted_at' => fake()->optional()->dateTimeBetween('-2 months', 'now'),
            'power_of_attorney_path' => 'power_of_attorney/' . fake()->uuid() . '.pdf',
            'rest_days' => fake()->optional()->numberBetween(1, 30),
            'total_fees_amount' => fake()->randomFloat(2, 100, 1000),
            'payment_status' => fake()->randomElement($paymentStatuses),
            'department_notes' => fake()->optional()->sentence(),
            'secretary_notes' => fake()->optional()->sentence(),
            'approval_notes' => fake()->optional()->sentence(),
            'rejection_reason' => fake()->optional()->sentence(),
        ];
    }

    public function pendingApproval()
    {
        return $this->state(['status' => 'pending_approval']);
    }

    public function completed()
    {
        return $this->state([
            'status' => 'completed',
            'submitted_at' => now()->subDays(rand(5, 30)),
        ]);
    }
}
