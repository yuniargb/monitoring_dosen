<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    protected $fillable = [
        'foto_1_r',
        'foto_2_r',
        'foto_3_r',
        'foto_4_r',
        'foto_5_r',
        'foto_6_r',
        'foto_7_r',
        'foto_8_r',
        'foto_9_r',
        'foto_10_r',
        'id_pengajuan',
        'status',
        'id_prodi',
        'pesan_revisi',
        'tanggal_tolak',
        'tanggal_konfirmasi'
    ];
    protected $primaryKey = 'id_review';
    protected $table = 'review';
    //
    public static function getData($nidn = null,$fakultas = null){
         return DB::table('pengajuan')
            ->select('*',
                    DB::raw('case review.status 
                                        when 0 then "<p class=""text-warning"">menunggu</p>"
                                        when 2 then "<p class=""text-danger"">ditolak</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_prodi')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where(function($query) {
                $query->where('review.status', 0);
                $query->orWhere('review.status', 2);
            })
            ->get();
    }
     public static function getDataKonfirmasi($nidn = null,$fakultas = null){
         return DB::table('pengajuan')
            ->select('*',
                    DB::raw('case review.status 
                                        when 1 then "<p class=""text-success"">selesai</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_prodi')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where(function($query) {
                $query->where('review.status', 1);
            })
            ->get();
    }
     public static function getDataTolak($nidn = null,$fakultas = null){
         return DB::table('pengajuan')
            ->select('*',
                    DB::raw('case review.status 
                                        when 0 then "<p class=""text-warning"">menunggu</p>"
                                        when 2 then "<p class=""text-danger"">ditolak</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_prodi')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where(function($query) {
                $query->orWhere('review.status', 2);
            })
            ->get();
    }
}
