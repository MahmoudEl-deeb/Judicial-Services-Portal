<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appellant extends Model
{
    protected $fillable = [
        'full_name','national_id','phone','email','address','type','representative_name'
    ];

    public function cases()
    {
        return $this->hasMany(CourtCase::class, 'appellant_id');
    }
}
