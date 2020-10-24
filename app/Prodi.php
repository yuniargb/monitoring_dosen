<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Prodi extends Model
{
    protected $fillable = [
        'nama_prodi',
        'id_fakultas'
    ];
    protected $primaryKey = 'id_prodi';
    protected $table = 'prodi';
    //
     public static function getData(){
         return DB::table('prodi')
            ->select('*')
            ->join('fakultas', 'prodi.id_fakultas', '=', 'fakultas.id_fakultas')
            ->get();
    }
}
