<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengajuan extends Model
{
    protected $fillable = [
        'foto_1',
        'foto_2',
        'foto_3',
        'foto_4',
        'nama',
        'alamat',
        'id_fakultas',
        'id_prodi',
        'nidn',
        'status',
        'id_prodi',
        'pesan_revisi',
        'tanggal_tolak',
        'tanggal_konfirmasi'
    ];
    protected $primaryKey = 'id_pengajuan';
    protected $table = 'pengajuan';
    //
    public static function getData($nidn = null,$fakultas = null){
         $x =  DB::table('pengajuan')
            ->select('*',
                    DB::raw('case pengajuan.status 
                                        when 0 then "<p class=""text-warning"">menunggu</p>"
                                        when 2 then "<p class=""text-danger"">ditolak</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where(function($querys) {
                    $querys->where('pengajuan.status', 0)
                        ->orWhere('pengajuan.status', 2);
                })
            ->get();
        
        return $x;
    }
     public static function getDataKonfirmasi($nidn = null,$fakultas = null){
         return DB::table('pengajuan')
            ->select('*', 
                    DB::raw('case pengajuan.status 
                                        when 0 then "review"
                                        when 1 then "konfirmasi" 
                                        else "ditolak"
                                    end as status'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_prodi')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->leftJoin('review', 'pengajuan.id_pengajuan', '=', 'review.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('pengajuan.status', 1)
            ->get();
    }
     public static function getDataTolak($nidn = null,$fakultas = null){
         return DB::table('pengajuan')
            ->select('*',DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur'))
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_prodi')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('pengajuan.status', 2)
            ->get();
    }
}
