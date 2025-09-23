<?php


namespace Database\Seeders;

use App\Models\ServiceRequest;
use App\Models\User;
use App\Models\ServiceType;
use App\Models\CassationDepartment;
use App\Models\JudgeSercretory;
use App\Models\CourtCase;
use Illuminate\Database\Seeder;

class ServiceRequestSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $serviceTypes = ServiceType::where('is_active', true)->get();
        $departments = CassationDepartment::all();
        $secretaries = JudgeSercretory::all();
        $cases = CourtCase::all();

        ServiceRequest::factory()->count(200)->create()->each(function ($request) use ($users, $serviceTypes, $departments, $secretaries, $cases) {
            $request->update([
                'requester_id' => $users->random()->id,
                'service_type_id' => $serviceTypes->random()->id,
                'department_id' => $departments->random()->id,
                'assigned_secretary_id' => fake()->optional(0.7)->randomElement($secretaries->pluck('id')->toArray()),
                'approved_by_secretary_id' => fake()->optional(0.3)->randomElement($secretaries->pluck('id')->toArray()),
                'related_case_id' => fake()->optional(0.6)->randomElement($cases->pluck('id')->toArray()),
            ]);
        });
    }
}
