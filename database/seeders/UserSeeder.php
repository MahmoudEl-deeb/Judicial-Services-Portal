<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'first_name' => 'System',
            'last_name' => 'Administrator',
            'national_id' => '12345678901234',
            'phone' => '+201234567890',
            'status' => 'active',
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Create test users for each role
        $judgeUser = User::factory()->active()->verified()->create([
            'email' => 'judge@court.gov.eg',
            'first_name' => 'أحمد',
            'last_name' => 'حسن'
        ]);
        $judgeUser->assignRole('judge');

        $secretaryUser = User::factory()->active()->verified()->create([
            'email' => 'secretary@court.gov.eg',
            'first_name' => 'فاطمة',
            'last_name' => 'علي'
        ]);
        $secretaryUser->assignRole('judge_secretary');

        $lawyerUser = User::factory()->active()->verified()->create([
            'email' => 'lawyer@court.gov.eg',
            'first_name' => 'محمد',
            'last_name' => 'عمر'
        ]);
        $lawyerUser->assignRole('lawyer');

        $litigantUser = User::factory()->active()->verified()->create([
            'email' => 'litigant@court.gov.eg',
            'first_name' => 'سارة',
            'last_name' => 'إبراهيم'
        ]);
        $litigantUser->assignRole('litigant');

        // Create additional random users
        User::factory()->count(50)->create()->each(function ($user) {
            $role = Role::inRandomOrder()->first();
            $user->assignRole($role);
        });
    }
}