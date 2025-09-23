<?php


namespace Database\Seeders;

use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Database\Seeder;

class LawyerSeeder extends Seeder
{
    public function run(): void
    {
        // Get users with lawyer role
        $lawyerUsers = User::role('lawyer')->get();
        
        foreach ($lawyerUsers as $user) {
            Lawyer::create([
                'user_id' => $user->id,
                'bar_registration_number' => 'BAR' . str_pad(Lawyer::count() + 1, 5, '0', STR_PAD_LEFT),
                'bar_registration_image' => 'bar_registrations/sample_' . $user->id . '.pdf',
                'specialization' => fake()->randomElement([
                    'القانون المدني', 'القانون الجنائي', 'القانون التجاري', 'القانون الإداري',
                    'القانون الدستوري', 'قانون العمل', 'قانون الأحوال الشخصية', 'القانون الضريبي'
                ]),
                'registration_date' => fake()->dateTimeBetween('-15 years', '-1 year'),
                'license_status' => 'active',
            ]);
        }

        // Create additional lawyers if needed
        $neededLawyers = 40 - $lawyerUsers->count();
        if ($neededLawyers > 0) {
            Lawyer::factory()->active()->count($neededLawyers)->create();
        }
    }
}