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
        $admin = User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'password' => Hash::make('admin'),
                'first_name' => 'System',
                'last_name' => 'Administrator',
                'national_id' => '12345678901234',
                'phone' => '+201234567890',
                'status' => 'active',
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Create test users for each role
        $judgeUser = User::updateOrCreate(
            ['email' => 'judge@court.gov.eg'],
            array_merge(
                User::factory()->active()->make()->toArray(),
                ['first_name' => 'أحمد', 'last_name' => 'حسن', 'password' => Hash::make('password')]
            )
        );
        $judgeUser->assignRole('judge');

        $secretaryUser = User::updateOrCreate(
            ['email' => 'secretary@court.gov.eg'],
            array_merge(
                User::factory()->active()->make()->toArray(),
                ['first_name' => 'فاطمة', 'last_name' => 'علي', 'password' => Hash::make('password')]
            )
        );
        $secretaryUser->assignRole('judge_secretary');

        $lawyerUser = User::updateOrCreate(
            ['email' => 'lawyer@court.gov.eg'],
            array_merge(
                User::factory()->active()->make()->toArray(),
                ['first_name' => 'محمد', 'last_name' => 'عمر', 'password' => Hash::make('password')]
            )
        );
        $lawyerUser->assignRole('lawyer');

        $litigantUser = User::updateOrCreate(
            ['email' => 'litigant@court.gov.eg'],
            array_merge(
                User::factory()->active()->make()->toArray(),
                ['first_name' => 'سارة', 'last_name' => 'إبراهيم', 'password' => Hash::make('password')]
            )
        );
        $litigantUser->assignRole('litigant');

        // Create additional random users
        User::factory()->count(50)->create()->each(function ($user) {
            $role = Role::inRandomOrder()->first();
            $user->assignRole($role);
        });
    }
}
