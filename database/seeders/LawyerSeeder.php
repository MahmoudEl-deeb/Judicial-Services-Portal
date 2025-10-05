<?php


namespace Database\Seeders;

use App\Models\Lawyer;
use App\Models\User;
use Illuminate\Database\Seeder;

class LawyerSeeder extends Seeder
{
    public function run(): void
    {
        Lawyer::factory()->count(40)->create();
    }
}
