<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'request_number','requester_id','service_type_key','department_id',
        'assigned_secretary_id','approved_by_secretary_id','request_title',
        'request_description','related_case_id','status','priority','service_category',
        'is_urgent_service','is_prepaid_service','urgent_service_multiplier',
        'submitted_documents_meta','base_fees_amount','urgent_fees_amount','total_fees_amount',
        'payment_status','requested_date','assigned_to_secretary_date','department_review_date',
        'expected_completion_date','urgent_completion_deadline','approved_date','completed_date',
        'processing_time_hours','urgent_processing_time_hours','department_notes',
        'secretary_notes','approval_notes','rejection_reason'
    ];

    protected $casts = [
        'submitted_documents_meta' => 'array',
        'is_urgent_service' => 'boolean',
        'is_prepaid_service' => 'boolean',
    ];

    public function documents() {
        return $this->hasMany(ServiceRequestDocument::class);
    }

    public function history() {
        return $this->hasMany(ServiceRequestHistory::class);
    }
}

