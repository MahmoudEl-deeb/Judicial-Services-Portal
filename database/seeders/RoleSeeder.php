<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::updateOrCreate(['name' => 'admin']);
        Role::updateOrCreate(['name' => 'judge']);
        Role::updateOrCreate(['name' => 'judge_secretary']);
        Role::updateOrCreate(['name' => 'lawyer']);
        Role::updateOrCreate(['name' => 'litigant']);
    }
}
