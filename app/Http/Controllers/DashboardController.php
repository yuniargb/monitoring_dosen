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
        $x = ['Tenaga Pengajar', 'Asisten Ahli', 'Lektor', 'Lektor Kepala','Guru Besar'];
        $y = [0,0,0,0,0];
        foreach ($jabatan as $d) {
            $y[array_search($d->jabatan_fungsional, $x)] = $d->jumlah;
        
        }
        $x2 = [];
        $y2 = [];
        $l2 = [];
        foreach ($fakultas as $d) {
            array_push($x2, $d->nama_fakultas);
            array_push($y2,$d->jumlah);
            array_push($l2,$d->warna);
        }
         return view('grafik', compact('x','y','x2','y2','l2'));
    }

}
