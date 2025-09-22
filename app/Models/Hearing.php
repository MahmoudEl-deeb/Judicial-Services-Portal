<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Hearing extends Model
{
    protected $table = 'hearings';

    protected $fillable = [
        'case_id',
        'judge_id',
        'hearing_date',
        'hearing_time',
        'courtroom',
        'status',
        'hearing_notes',
        'postponement_reason',
        'next_hearing_date'
    ];

    public function case()
    {
        return $this->belongsTo(CourtCase::class, 'case_id');
    }

    public function judge()
    {
        return $this->belongsTo(Judge::class, 'judge_id');
    }
}

