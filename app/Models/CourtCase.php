<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourtCase extends Model
{
    protected $table = 'cases';
    protected $fillable = [
        'case_number','cassation_appeal_number','case_title','case_description',
        'cassation_case_type','status','lawyer_id',
        'department_id','assigned_judge_id','lower_court_name','lower_court_judgment_number',
        'lower_court_judgment_date','cassation_filing_date','hearing_date',
        'appeal_value','case_summary','legal_grounds','judgment_result'
    ];

    public function documents() {
        return $this->hasMany(CaseDocument::class);
    }
}
