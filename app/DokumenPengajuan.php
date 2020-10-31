<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DokumenPengajuan extends Model
{
    protected $fillable = [
        'id_pengajuan',
        'dokumen',
        'jenis'
    ];
    protected $primaryKey = 'id_dokumen_pengajuan';
    protected $table = 'DokumenPengajuan';
    
}
