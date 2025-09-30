<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    protected $guarded = [];

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
