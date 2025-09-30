<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lawyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bar_registration_number',
        'bar_registration_image',
        'law_firm_name',
        'specialization',
        'registration_date',
        'license_status',
        'documents',
    ];

    protected $casts = [
        'registration_date' => 'date',
        'documents' => 'array',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
