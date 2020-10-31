<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pengajuan;

class DashboardController extends Controller
{
    public function dashboard()
    {
        
         return view('dashboard');
    }
    public function grafik()
    {
        $jabatan = Pengajuan::diagramJabatan();
        $fakultas = Pengajuan::diagramFakultas();
        $x = [];
        $y = [];
        foreach ($jabatan as $d) {
            array_push($x, $d->jabatan_fungsional);
            array_push($y,$d->jumlah);
        }
        $x2 = [];
        $y2 = [];
        foreach ($fakultas as $d) {
            array_push($x2, $d->nama_fakultas);
            array_push($y2,$d->jumlah);
        }
         return view('grafik', compact('x','y','x2','y2'));
    }

}
