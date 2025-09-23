<?php

namespace Database\Seeders;

use App\Models\Appellant;
use App\Models\Respondent;
use App\Models\CourtCase;
use Illuminate\Database\Seeder;

class AppellantRespondentSeeder extends Seeder
{
    public function run(): void
    {
        $cases = CourtCase::all();

        foreach ($cases as $case) {
            // Create 1-3 appellants per case
            Appellant::factory()->count(fake()->numberBetween(1, 3))->create([
                'case_id' => $case->id
            ]);

            // Create 1-3 respondents per case
            Respondent::factory()->count(fake()->numberBetween(1, 3))->create([
                'case_id' => $case->id
            ]);
        }
    }
}