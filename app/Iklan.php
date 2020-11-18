<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Iklan extends Model
{
    protected $fillable = [
        'isi_iklan',
    ];
    protected $primaryKey = 'id_iklan';
    protected $table = 'iklan';

}
