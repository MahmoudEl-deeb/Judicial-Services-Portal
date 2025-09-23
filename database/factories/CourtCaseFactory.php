<?php

namespace Database\Factories;

use App\Models\Lawyer;
use App\Models\CassationDepartment;
use App\Models\Judge;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourtCaseFactory extends Factory
{
    public function definition(): array
    {
        $caseTypes = [
            'civil_cassation',
            'commercial_cassation',
            'criminal_cassation',
            'administrative_cassation',
            'constitutional_cassation',
            'disciplinary_cassation'
        ];

        $statuses = [
            'filed',
            'under_department_review',
            'accepted',
            'rejected',
            'scheduled_hearing',
            'under_deliberation',
            'judgment_issued',
            'closed'
        ];

        $judgmentResults = [
            'appeal_accepted',
            'appeal_rejected',
            'case_remanded',
            'judgment_amended'
        ];

        $arabicCaseTitles = [
            'نزاع حول ملكية عقار',
            'قضية تعويضات أضرار',
            'دعوى مطالبة مالية',
            'نزاع عمالي وتعويضات',
            'قضية احتيال مالي',
            'نزاع تجاري بين شركتين',
            'دعوى إلغاء قرار إداري',
            'قضية مخالفة قانونية',
            'نزاع حول عقد إيجار',
            'دعوى طلاق وحضانة أطفال'
        ];

        $arabicDescriptions = [
            'تتعلق القضية بنزاع حول الملكية العقارية بين الأطراف المتنازعة',
            'دعوى مطالبة بتعويضات عن أضرار مادية ومعنوية لحقت بالمدعي',
            'نزاع تجاري حول عدم تنفيذ بنود العقد المبرم بين الطرفين',
            'قضية عمالية تتعلق بالمطالبة بمستحقات مالية وتعويضات',
            'دعوى جنائية تتعلق بجرائم الاحتيال والنصب المالي'
        ];

        $lowerCourts = [
            'محكمة القاهرة الابتدائية',
            'محكمة الإسكندرية الاستئنافية',
            'محكمة الجيزة التجارية',
            'محكمة الأقصر الجنائية',
            'محكمة أسوان الإدارية',
            'محكمة بني سويف الابتدائية',
            'محكمة المنيا الجزئية',
            'محكمة أسيوط الكلية',
            'محكمة سوهاج الابتدائية',
            'محكمة قنا العامة'
        ];

        return [
            'case_number' => fake()->year() . '/' . fake()->unique()->numberBetween(1000, 999999) . '/نقض',
            'cassation_appeal_number' => 'ط.ن/' . fake()->year() . '/' . fake()->unique()->numberBetween(1000, 999999),
            'case_title' => fake()->randomElement($arabicCaseTitles),
            'case_description' => fake()->optional()->randomElement($arabicDescriptions),
            'cassation_case_type' => fake()->randomElement($caseTypes),
            'status' => fake()->randomElement($statuses),
            'lawyer_id' => Lawyer::factory(),
            'department_id' => CassationDepartment::factory(),
            'assigned_judge_id' => null, // Will be set in seeder
            'lower_court_name' => fake()->randomElement($lowerCourts),
            'lower_court_judgment_number' => fake()->numerify('####/####'),
            'lower_court_judgment_date' => fake()->dateTimeBetween('-2 years', '-6 months'),
            'cassation_filing_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'hearing_date' => fake()->optional()->dateTimeBetween('now', '+3 months'),
            'case_summary' => fake()->optional()->randomElement($arabicDescriptions),
            'legal_grounds' => fake()->optional()->sentence(),
            'judgment_result' => fake()->optional()->randomElement($judgmentResults),
        ];
    }

    public function active()
    {
        return $this->state([
            'status' => fake()->randomElement(['filed', 'under_department_review', 'accepted', 'scheduled_hearing'])
        ]);
    }
}
