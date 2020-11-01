<?php

namespace App\Http\Controllers;

use App\Pengajuan;
use App\Fakultas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use PDF;
use Response;

class LaporanController extends Controller
{
    public function pengajuan($laporan = null,$req = null)
    {
        $fakultas = Fakultas::all();
        return view('laporan.lapPengajuan', compact('fakultas','laporan','req'));
    }

    public function cetakPengajuan(Request $request)
    {
        
        $laporan = Pengajuan::lapPengajuan($request);
       
        if($request->submit == 'read'){
            
            return $this->pengajuan($laporan,$request);
        }
        if($request->submit == 'pdf'){
            $pdf = PDF::loadview('laporan.cetakPengajuan', compact('laporan'));
            return $pdf->download('laporan-pengajuan-'.date('dmyHis'));   
        }
    }

    
}
