<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestHistory extends Model
{
    public $timestamps = false; 
    protected $fillable = ['service_request_id','status','notes','updated_by','created_at'];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}

