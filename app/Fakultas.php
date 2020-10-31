<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Fakultas extends Model
{
    protected $fillable = [
        'nama_fakultas','warna'
    ];
    protected $primaryKey = 'id_fakultas';
    protected $table = 'fakultas';
    //
    //  public static function getData(){
    //      return DB::table('umum')->select('*')->get();
    // }
}
