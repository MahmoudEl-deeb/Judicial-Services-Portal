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
        ServiceRequest::factory()->count(200)->create();
    }
}
