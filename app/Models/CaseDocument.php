<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseDocument extends Model
{
    use HasFactory;
    protected $fillable = ['case_id','document_name','document_type','file_path','uploaded_by'];

    public function case() {
        return $this->belongsTo(CourtCase::class);
    }
}

