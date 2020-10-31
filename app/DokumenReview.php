<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DokumenReview extends Model
{
    protected $fillable = [
        'id_review',
        'dokumen'
    ];
    protected $primaryKey = 'id_dokumen_review';
    protected $table = 'DokumenReview';
    
}
