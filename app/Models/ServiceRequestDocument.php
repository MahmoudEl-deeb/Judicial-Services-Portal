<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequestDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_request_id','document_type','document_name','file_path',
        'is_required','is_verified','verified_by','verified_at','verification_notes'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_verified' => 'boolean',
        'verified_at' => 'datetime',
    ];
}

