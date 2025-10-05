<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_type_key','service_name_ar','service_name_en',
        'description_ar','description_en','responsible_department_id',
        'cassation_service_type','required_documents','optional_documents',
        'base_fee','urgent_fee_multiplier','processing_days','urgent_processing_hours',
        'allows_urgent','allows_prepaid','validation_rules','workflow_steps',
        'required_secretary_actions','requires_case_reference','requires_lawyer_signature',
        'requires_department_approval','is_active'
    ];

    protected $casts = [
        'required_documents' => 'array',
        'optional_documents' => 'array',
        'validation_rules' => 'array',
        'workflow_steps' => 'array',
        'required_secretary_actions' => 'array',
        'allows_urgent' => 'boolean',
        'allows_prepaid' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function getBaseFeesAmountAttribute()
    {
        return $this->base_fee;
    }

    public function getUrgentFeesAmountAttribute()
    {
        return $this->base_fee * ($this->urgent_fee_multiplier - 1);
    }
}
