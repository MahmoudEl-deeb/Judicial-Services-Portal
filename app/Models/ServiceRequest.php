<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;
       protected $fillable = [
        'request_number',
        'requester_id',
        'service_type_id',
        'department_id',
        'assigned_secretary_id',
        'approved_by_secretary_id',
        'request_title',
        'request_description',
        'related_case_id',
        'status',
        'priority',
        'is_urgent_service',
        'is_prepaid_service',
        'client_national_id',
        'payment_method',
        'submitted_at',
        'power_of_attorney_path',
        'rest_days',
        'total_fees_amount',
        'payment_status',
        'department_notes',
        'secretary_notes',
        'approval_notes',
        'rejection_reason',
    ];
    

    protected $guarded = [];

    protected $casts = [
        'under_review_date' => 'datetime',
        'approved_date' => 'datetime',
        'completed_date' => 'datetime',
        'rejected_date' => 'datetime',
        'submitted_at' => 'datetime',
    ];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function courtCase()
    {
        return $this->belongsTo(CourtCase::class, 'related_case_id');
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function department()
    {
        return $this->belongsTo(CassationDepartment::class, 'cassation_department_id');
    }

    public function documents()
    {
        return $this->hasMany(ServiceRequestDocument::class);
    }
    public function assignedSecretary()
    {
        return $this->belongsTo(User::class, 'assigned_secretary_id');
    }
     public function approvedBySecretary()
    {
        return $this->belongsTo(User::class, 'assigned_secretary_id');
    }

    public function relatedCase()
    {
        return $this->belongsTo(CourtCase::class, 'related_case_id');
    }


    public function getStatusArAttribute()
    {
        return match ($this->status) {
            'pending' => 'قيد الانتظار',
            'under_department_review' => 'قيد مراجعة الدائرة',
            'assigned_to_secretary' => 'معينة للسكرتير',
            'in_progress' => 'قيد التنفيذ',
            'pending_approval' => 'في انتظار الموافقة',
            'approved' => 'تمت الموافقة',
            'rejected' => 'مرفوض',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغى',
            'awaiting_payment' => 'في انتظار الدفع',
            default => $this->status,
        };
    }
}
