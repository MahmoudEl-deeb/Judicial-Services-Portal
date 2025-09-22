<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'payer_id',
        'service_request_id',
        'prepaid_account_id',
        'amount',
        'payment_method',
        'payment_type',
        'transaction_id',
        'status',
        'payment_date',
        'payment_details'
    ];

    protected $casts = [
        'payment_details' => 'array',
        'payment_date' => 'date',
    ];

    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function serviceRequest()
    {
        return $this->belongsTo(ServiceRequest::class, 'service_request_id');
    }

}
