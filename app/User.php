<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'username', 'role', 'password','email','no_telp','id_fakultas',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function getAdmin(){
         return DB::table('users')
            ->select('*')
            ->where('role', 1)
            ->get();
    }
    public static function getStaf(){
         return DB::table('users')
            ->select('*')
            ->join('fakultas', 'users.id_fakultas', '=', 'fakultas.id_fakultas')
            ->where('role', 2)
            ->get();
    }
    public static function getBAAK(){
         return DB::table('users')
            ->select('*',
            DB::raw('case role 
                                        when 3 then "BAAK"
                                        when 5 then "DUPAK"
                                        when 6 then "PAK"
                                        when 7 then "SK"
                                    end as role')
                                    )
            ->where(function($querys) {
                    $querys->where('role', 3)
                        ->orWhere('role', 5)
                        ->orWhere('role', 6)
                        ->orWhere('role', 7);
                })
            ->get();
    }
    public static function getDosen(){
         return DB::table('users')
            ->select('*')
            ->where('role', 4)
            ->get();
    }
    public static function getDosenJumlah(){
         return DB::table('users')
            ->select(DB::raw('count(username) as jumlah'))
            ->where('role', 4)
            ->first();
    }
    
    
}
