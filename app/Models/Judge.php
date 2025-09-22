<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Judge extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judge_code',
        'department_id',
        'rank',
        'appointment_date',
        'specializations',
    ];

    protected $casts = [
        'specializations' => 'array',
        'appointment_date' => 'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function department() {
        return $this->belongsTo(CassationDepartment::class, 'department_id');
    }

    public function secretaries() {
        return $this->hasMany(JudgeSercretory::class);
    }
}
