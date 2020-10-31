<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Review extends Model
{
    protected $fillable = [
        'id_review',
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
    public static function getData($nidn = null,$fakultas = null,$role = null){
  
         return DB::table('pengajuan')
            ->when( $role == 3 || $role == null , function ($query)  use ($nidn){
                return $query->select('*',
                    DB::raw('case review.status 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 5, function ($query)  use ($nidn){
                return $query->select('*',
                    DB::raw('case review.status_dupak 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 6, function ($query)  use ($nidn){
                return $query->select('*',
                    DB::raw('case review.status_pak
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 7 , function ($query)  use ($nidn){
                return $query->select('*',
                    DB::raw('case review.status_sk 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->when( $role == 3 || $role == null , function ($query)  use ($fakultas){
                return $query->where('review.status', 0)
                    ->orWhere('review.status', 1);
            })
            ->when( $role == 5 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_dupak', 0)
                    ->orWhere('review.status_dupak', 1);
                })->where('review.status', 2);
            })
            ->when( $role == 6 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_pak', 0)
                    ->orWhere('review.status_pak', 1);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2);
            })
            ->when( $role == 7 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_sk', 0)
                    ->orWhere('review.status_sk', 1);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2)
                ->where('review.status_pak', 2);
            })
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->get();
    }
     public static function getDataKonfirmasi($nidn = null,$fakultas = null,$role = null){
      
         return DB::table('pengajuan')
            ->when( $role == 3 || $role == null , function ($query)  use ($nidn){
                return $query->select('*',
                    DB::raw('case review.status 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 5, function ($query)  use ($nidn){
                return $query->select('*','review.tanggal_konfirmasi_dupak as tanggal_konfirmasi',
                    DB::raw('case review.status_dupak 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 6, function ($query)  use ($nidn){
                return $query->select('*','review.tanggal_konfirmasi_pak as tanggal_konfirmasi',
                    DB::raw('case review.status_pak
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 7 , function ($query)  use ($nidn){
                return $query->select('*','review.tanggal_konfirmasi_sk as tanggal_konfirmasi',
                    DB::raw('case review.status_sk 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->when( $role == 3 || $role == null , function ($query)  use ($fakultas){
                return $query->where('review.status', 2);
            })
            ->when( $role == 5 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_dupak', 2);
                })->where('review.status', 2);
            })
            ->when( $role == 6 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_pak', 2);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2);
            })
            ->when( $role == 7 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_sk', 2);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2)
                ->where('review.status_pak', 2);
            })
            ->get();
    }
     public static function getDataTolak($nidn = null,$fakultas = null,$role = null){
         return DB::table('pengajuan')
            ->when( $role == 3 || $role == null , function ($query)  use ($nidn){
                return $query->select('*',
                    DB::raw('case review.status 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 5, function ($query)  use ($nidn){
                return $query->select('*','review.pesan_revisi_dupak as pesan_revisi','review.tanggal_tolak_dupak as tanggal_tolak',
                    DB::raw('case review.status_dupak 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 6, function ($query)  use ($nidn){
                return $query->select('*','review.pesan_revisi_pak as pesan_revisi','review.tanggal_tolak_pak as tanggal_tolak',
                    DB::raw('case review.status_pak
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->when( $role == 7 , function ($query)  use ($nidn){
                return $query->select('*','review.pesan_revisi_sk as pesan_revisi','review.tanggal_tolak_sk as tanggal_tolak',
                    DB::raw('case review.status_sk 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                );
            })
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })

            ->when( $role == 3 || $role == null , function ($query)  use ($fakultas){
                return $query->where('review.status', 4)
                    ->orWhere('review.status', 3);
            })
            ->when( $role == 5 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_dupak', 4)
                    ->orWhere('review.status_dupak', 3);
                })->where('review.status', 2);
            })
            ->when( $role == 6 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_pak', 4)
                    ->orWhere('review.status_pak', 3);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2);
            })
            ->when( $role == 7 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_sk', 4)
                    ->orWhere('review.status_sk', 3);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2)
                ->where('review.status_pak', 2);
            })
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->get();
    }

    public static function getDataDitagguhkan($nidn = null,$fakultas = null){
         $x =  DB::table('pengajuan')
            ->select('*','pengajuan.created_at',
                    DB::raw('case review.status 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status_text'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('review.status','!=', 2)
            ->where('review.status','!=', 4)
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '>', 5)
            ->get();
        
        return $x;
    }

    public static function reviewNew($fakultas = null,$role = null){
    
        return DB::table('pengajuan')
            ->select(DB::raw('count(review.id_review) as jumlah'))
            
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->when( $role == 3 || $role == null , function ($query)  use ($fakultas){
                return $query->where('review.status', 0);
            })
            ->when( $role == 5 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_dupak', 0);
                })->where('review.status', 2);
            })
            ->when( $role == 6 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_pak', 0);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2);
            })
            ->when( $role == 7 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_sk', 0);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2)
                ->where('review.status_pak', 2);
            })
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->first();
    }

    public static function reviewInReview($fakultas = null,$role = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(review.id_review) as jumlah'))
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->when( $role == 3 || $role == null , function ($query)  use ($fakultas){
                return $query->where('review.status', 1);
            })
            ->when( $role == 5 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_dupak', 1);
                })->where('review.status', 2);
            })
            ->when( $role == 6 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_pak', 1);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2);
            })
            ->when( $role == 7 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_sk', 1);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2)
                ->where('review.status_pak', 2);
            })
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->first();
    }

    public static function reviewComplete($fakultas = null,$role = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(review.id_review) as jumlah'))
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->when( $role == 3 || $role == null , function ($query)  use ($fakultas){
                return $query->where('review.status', 2);
            })
            ->when( $role == 5 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_dupak', 2);
                })->where('review.status', 2);
            })
            ->when( $role == 6 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_pak', 2);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2);
            })
            ->when( $role == 7 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_sk', 2);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2)
                ->where('review.status_pak', 2);
            })
            ->first();
    }
    public static function reviewRevisi($fakultas = null,$role = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(review.id_review) as jumlah'))
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->when( $role == 3 || $role == null , function ($query)  use ($fakultas){
                return $query->where('review.status', 4)
                    ->orWhere('review.status', 3);
            })
            ->when( $role == 5 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_dupak', 4)
                    ->orWhere('review.status_dupak', 3);
                })->where('review.status', 2);
            })
            ->when( $role == 6 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_pak', 4)
                    ->orWhere('review.status_pak', 3);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2);
            })
            ->when( $role == 7 , function ($query)  use ($fakultas){
                return $query->where(function($querys) {
                    $querys->where('review.status_sk', 4)
                    ->orWhere('review.status_sk', 3);
                })
                ->where('review.status', 2)
                ->where('review.status_dupak', 2)
                ->where('review.status_pak', 2);
            })
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->first();
    }
    public static function reviewDitagguhkan($fakultas = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(review.id_review) as jumlah'))
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('review', 'review.id_pengajuan', '=', 'pengajuan.id_pengajuan')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('review.status','!=', 2)
            ->where('review.status','!=', 4)
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '>', 5)
            ->first();
    }
}
