<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrgentServiceQueue extends Model
{
    use HasFactory;
    protected $table = 'urgent_service_queue';

    protected $fillable = [
        'service_request_id','queue_position','estimated_completion',
        'actual_start_time','actual_completion_time','status',
        'assigned_processor','processing_notes'
    ];

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'assigned_processor');
    }
}
