<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JudgeSercretory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'employee_id',
        'judge_id',
        'department_id',
        'access_level',
        'assigned_services',
        'permissions',
    ];

    protected $casts = [
        'assigned_services' => 'array',
        'permissions' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function judge() {
        return $this->belongsTo(Judge::class);
    }

    public function department() {
        return $this->belongsTo(CassationDepartment::class, 'department_id');
    }
}
