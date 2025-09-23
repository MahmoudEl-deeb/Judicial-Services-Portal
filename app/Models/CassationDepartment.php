<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CassationDepartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_code',
        'department_name_ar',
        'department_name_en',
        'department_type',
        'head_judge_id',
    ];

    // Relationships
    public function headJudge()
    {
        return $this->belongsTo(User::class, 'head_judge_id');
    }

    public function judges()
    {
        return $this->hasMany(Judge::class, 'department_id');
    }

    public function judgeSecretaries()
    {
        return $this->hasMany(JudgeSercretory::class, 'department_id');
    }

    public function courtCases()
    {
        return $this->hasMany(CourtCase::class, 'department_id');
    }

    public function serviceTypes()
    {
        return $this->hasMany(ServiceType::class, 'responsible_department_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'department_id');
    }
}