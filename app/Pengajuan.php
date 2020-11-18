<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengajuan extends Model
{
    protected $fillable = [
        'id_pengajuan',
        'nama',
        'alamat',
        'id_fakultas',
        'jabatan_fungsional',
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
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where(function($querys) {
                    $querys->where('pengajuan.status', 1)
                        ->orWhere('pengajuan.status', 0);
                })
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->get();
        
        return $x;
    }
    public static function getDataFull($nidn = null){
         $x =  DB::table('pengajuan')
            ->select('*','pengajuan.id_pengajuan',
                    'pengajuan.pesan_revisi',
                    'pengajuan.created_at','pengajuan.status as status','review.status as status_review',
                    'pengajuan.tanggal_konfirmasi as tanggal_konfirmasi',
                    'pengajuan.tanggal_tolak as tanggal_tolak',
                    'review.tanggal_konfirmasi as tanggal_konfirmasi_review',
                    'review.tanggal_tolak as tanggal_tolak_review',
                    'review.pesan_revisi as pesan_revisi_review',
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->leftJoin('review', 'pengajuan.id_pengajuan', '=', 'review.id_pengajuan')
            ->where('pengajuan.nidn', $nidn)
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->get();
        
        return $x;
    }

    public static function getDataDitagguhkan($nidn = null,$fakultas = null){
         $x =  DB::table('pengajuan')
            ->select('*',
                    DB::raw('case pengajuan.status 
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
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('pengajuan.status','!=', 2)
            ->where('pengajuan.status','!=', 4)
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '>', 5)
            ->get();
        
        return $x;
    }

     public static function getDataKonfirmasi($nidn = null,$fakultas = null){
         return DB::table('pengajuan')
            ->select('*', 'pengajuan.tanggal_konfirmasi',
                    DB::raw('case pengajuan.status 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Konfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->leftJoin('review', 'pengajuan.id_pengajuan', '=', 'review.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('pengajuan.status', 2)
            ->get();
    }
     public static function getDataTolak($nidn = null,$fakultas = null){
        
        return DB::table('pengajuan')
            ->select('*', 'pengajuan.tanggal_tolak','pengajuan.created_at','pengajuan.pesan_revisi','pengajuan.id_pengajuan',
                    DB::raw('case pengajuan.status 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Konfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                        else "ditolak"
                                    end as status'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->leftJoin('review', 'pengajuan.id_pengajuan', '=', 'review.id_pengajuan')
            ->when( $nidn != null , function ($query)  use ($nidn){
                return $query->where('pengajuan.nidn', $nidn);
            })
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
             ->where(function($querys) {
                    $querys->where('pengajuan.status', 3)
                        ->orWhere('pengajuan.status', 4);
                })
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->get();
    }


    public static function pengajuanNew($fakultas = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(pengajuan.id_pengajuan) as jumlah'))
            
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('pengajuan.status', 0)
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->first();
    }

    public static function pengajuanInReview($fakultas = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(pengajuan.id_pengajuan) as jumlah'))
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('pengajuan.status', 1)
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->first();
    }

    public static function pengajuanComplete($fakultas = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(pengajuan.id_pengajuan) as jumlah'))
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('pengajuan.status', 2)
            ->first();
    }
    public static function pengajuanRevisi($fakultas = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(pengajuan.id_pengajuan) as jumlah'))
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where(function($querys) {
                    $querys->where('pengajuan.status', 3)
                        ->orWhere('pengajuan.status', 4);
                })
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '<=', 5)
            ->first();
    }
    public static function pengajuanDitagguhkan($fakultas = null){
         return DB::table('pengajuan')
            ->select(DB::raw('count(pengajuan.id_pengajuan) as jumlah'))
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->when( $fakultas != null , function ($query)  use ($fakultas){
                return $query->where('pengajuan.id_fakultas', $fakultas);
            })
            ->where('pengajuan.status','!=', 2)
            ->where('pengajuan.status','!=', 4)
            ->where(DB::raw('DATEDIFF(NOW(),pengajuan.created_at)'), '>', 5)
            ->first();
    }
    public static function diagramFakultas(){
        return DB::table('users')
            ->select(DB::raw('count(pengajuan.id_fakultas) as jumlah'), 'fakultas.nama_fakultas','fakultas.warna')
            ->join(DB::raw('(select nidn,id_fakultas from pengajuan group by nidn,id_fakultas) as pengajuan'), 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->groupBy('pengajuan.id_fakultas','fakultas.nama_fakultas','fakultas.warna')
            ->get();
    }
    public static function diagramJabatan(){
        return DB::table('pengajuan')
            ->select(DB::raw('count(pengajuan.jabatan_fungsional) as jumlah'), 'pengajuan.jabatan_fungsional')
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
    
            ->groupBy('pengajuan.jabatan_fungsional')
            ->get();
    }


    public static function lapPengajuan($request){
         $x =  DB::table('pengajuan')
            ->select('*','pengajuan.created_at','pengajuan.id_pengajuan',
                    DB::raw('case pengajuan.status 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                    end as status_staf'),
                    DB::raw('case review.status 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                    end as status_baak'),
                    DB::raw('case review.status_dupak 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                    end as status_dupak'),
                    DB::raw('case review.status_pak 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                    end as status_pak'),
                    DB::raw('case review.status_sk 
                                        when 0 then "<p class=""text-warning"">New</p>"
                                        when 1 then "<p class=""text-success"">In Review</p>"
                                        when 2 then "<p class=""text-success"">Dikonfirmasi</p>"
                                        when 3 then "<p class=""text-danger"">Ditolak</p>"
                                        when 4 then "<p class=""text-warning"">Revisi</p>"
                                    end as status_sk'),
                    DB::raw('DATEDIFF(NOW(), pengajuan.created_at) AS umur')
                    )
            ->join('users', 'users.username', '=', 'pengajuan.nidn')
            ->join('fakultas', 'fakultas.id_fakultas', '=', 'pengajuan.id_fakultas')
            ->join('prodi', 'prodi.id_prodi', '=', 'pengajuan.id_prodi')
            ->leftJoin('review', 'pengajuan.id_pengajuan', '=', 'review.id_pengajuan')
            ->when( $request->from != null  && $request->to != null, function ($query)  use ($request){
                return $query->whereBetween(DB::raw('DATE(pengajuan.created_at)'), [$request->from,$request->to]);
            })
            ->when( $request->fakultas != null , function ($query)  use ($request){
                return $query->where('pengajuan.id_fakultas', $request->fakultas);
            })
            ->when( $request->status_staf != null , function ($query)  use ($request){
                return $query->where('pengajuan.status', $request->status_staf);
            })
            ->when( $request->status_baak != null , function ($query)  use ($request){
                return $query->where('review.status', $request->status_baak);
            })
            ->when( $request->status_dupak != null , function ($query)  use ($request){
                return $query->where('review.status_dupak', $request->status_dupak);
            })
            ->when( $request->status_pak != null , function ($query)  use ($request){
                return $query->where('review.status_pak', $request->status_pak);
            })
            ->when( $request->status_sk != null , function ($query)  use ($request){
                return $query->where('review.status_sk', $request->status_sk);
            })
            ->get();
        
        return $x;
    }
}
