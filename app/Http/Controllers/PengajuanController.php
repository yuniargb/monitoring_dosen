<?php

namespace App\Http\Controllers;
use File;
use URL;
use Mail;
use App\Pengajuan;
use App\DokumenPengajuan;
use App\DokumenReview;
use App\User;
use App\Prodi;
use App\Fakultas;
use App\Review;
use App\Http\Requests\PengajuanRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\TolakRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class PengajuanController extends Controller
{
    private $title;

    public function __construct()
    {
        $this->title = 'Data Pengajuan';
    }


    public function index()
    {
        
        if(auth()->user()->role == 1){
            $data = Pengajuan::getData();
            $cek = Pengajuan::where('status', 0);
            $cek->update(['status' => 1]);
        }else if(auth()->user()->role == 2){
            $data = Pengajuan::getData(null,auth()->user()->id_fakultas);
            $cek = Pengajuan::where('status', 0)->where('id_fakultas', auth()->user()->id_fakultas);
            $cek->update(['status' => 1]);
        }else{
            $data = Pengajuan::getDataFull(auth()->user()->username);
        }
        if(auth()->user()->role == 4){
            return view('pengajuan.pengajuanDashboardDosen', compact('data'))->with('title', $this->title);
        }else{
            return view('pengajuan.pengajuan', compact('data'))->with('title', $this->title);
        }   
    }

    public function dashboard()
    {
        if(auth()->user()->role == 1){
            $dosen = User::getDosenJumlah();
            $new = Pengajuan::pengajuanNew();
            $review = Pengajuan::pengajuanInReview();
            $konfirm = Pengajuan::pengajuanComplete();
            $revisi = Pengajuan::pengajuanRevisi();
            $ditagguhkan = Pengajuan::pengajuanDitagguhkan();
        }else if(auth()->user()->role == 2){
            $dosen = User::getDosenJumlah(auth()->user()->id_fakultas);
            $new = Pengajuan::pengajuanNew(auth()->user()->id_fakultas);
            $review = Pengajuan::pengajuanInReview(auth()->user()->id_fakultas);
            $konfirm = Pengajuan::pengajuanComplete(auth()->user()->id_fakultas);
            $revisi = Pengajuan::pengajuanRevisi(auth()->user()->id_fakultas);
            $ditagguhkan = Pengajuan::pengajuanDitagguhkan(auth()->user()->id_fakultas);
        }
        
              
        return view('pengajuan.pengajuanDashboard', compact('dosen','new','review','konfirm','revisi','ditagguhkan'))->with('title', $this->title);
    }

    public function konfirmasiView()
    {
        if(auth()->user()->role == 1){
            $data = Pengajuan::getDataKonfirmasi();
        }else if(auth()->user()->role == 2){
            $data = Pengajuan::getDataKonfirmasi(null,auth()->user()->id_fakultas);
        }else{
            $data = Pengajuan::getDataKonfirmasi(auth()->user()->username);
        }
        
        return view('pengajuan.pengajuanKonfirmasi', compact('data'))->with('title', $this->title);
    }
    public function tolakView()
    {
        if(auth()->user()->role == 1){
            $data = Pengajuan::getDataTolak();
        }else if(auth()->user()->role == 2){
            $data = Pengajuan::getDataTolak(null,auth()->user()->id_fakultas);
        }else{
            $data = Pengajuan::getDataTolak(auth()->user()->username);
        }
        
        return view('pengajuan.pengajuanTolak', compact('data'))->with('title', $this->title);
    }
    public function ditagguhkanView()
    {
        if(auth()->user()->role == 1){
            $data = Pengajuan::getDataDitagguhkan();
        }else if(auth()->user()->role == 2){
            $data = Pengajuan::getDataDitagguhkan(null,auth()->user()->id_fakultas);
        }else{
            $data = Pengajuan::getDataDitagguhkan(auth()->user()->username);
        }
        
        return view('pengajuan.pengajuanDitagguhkan', compact('data'))->with('title', $this->title);
    }

    public function create()
    {
        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $type = 1;
        return view('pengajuan.formPengajuan', compact('prodi','fakultas','type'))->with('title', $this->title);
    }

    function inputFile($fileNames,$request,$newId){
        $files = $request->file($fileNames);
        if($request->hasFile($fileNames)){
            foreach ($files as $file) {
                $resorce = $file;
                $name   = $resorce->getClientOriginalExtension();
                $newName = uniqid() . "." . $name;
                
                $resorce->move(\base_path() . "/public/file/", $newName);
                $arr2 = array(
                    'id_pengajuan' => $newId,
                    'dokumen' => $newName,
                    'jenis' => $fileNames,
                );
                DokumenPengajuan::create($arr2);
            }
        }
    }
    function inputFileReview($fileNames,$request,$newId){
        $files = $request->file($fileNames);
        if($request->hasFile($fileNames)){
            foreach ($files as $file) {
                $resorce = $file;
                $name   = $resorce->getClientOriginalExtension();
                $newName = uniqid() . "." . $name;
                
                $resorce->move(\base_path() . "/public/file/", $newName);
                $arr2 = array(
                    'id_review' => $newId,
                    'dokumen' => $newName
                );
                DokumenReview::create($arr2);
            }
        }
    }
    public function store(PengajuanRequest $request)
    {
        $newId = date('dmYhis');
        $i = 'a';
        while($i <= 'd'){
            $filenames = 'bidang_'. $i;
            $this->inputFile($filenames,$request,$newId);
            $i++;
        }
        $filenames = 'lainnya';
        $this->inputFile($filenames,$request,$newId);
        $arr =collect([]);
        $arr->put('status', 0);
        $arr->put('id_pengajuan', $newId);
        $request = new Request($request->all());
        $request->merge($arr->toArray());

   
        Pengajuan::create($request->all());
      
        Session::flash('success',  $this->title . ' berhasil ditambahkan');
        return Redirect::back();
    }

  
    public function detail($jenis,$id)
    {
        $cek = DokumenPengajuan::where('id_pengajuan', $id)->where('jenis',$jenis)->get();
        $data = [];
        foreach($cek as $c){
            $prt = array(
                'path' => public_path()."/file/".$c->dokumen,
                'filename' =>  $c->dokumen
            );
            array_push($data,$prt);
        }
        return $data;
    }

    public function downloadFile($filenames){
        return response()->download(public_path('/file/'.$filenames));
    }
    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        $bidang_a = DokumenPengajuan::where('id_pengajuan', $decrypt)
        ->where('jenis', 'bidang_a')->get();
        $bidang_b = DokumenPengajuan::where('id_pengajuan', $decrypt)
        ->where('jenis', 'bidang_b')->get();
        $bidang_c = DokumenPengajuan::where('id_pengajuan', $decrypt)
        ->where('jenis', 'bidang_c')->get();
        $bidang_d = DokumenPengajuan::where('id_pengajuan', $decrypt)
        ->where('jenis', 'bidang_d')->get();
        $lainnya = DokumenPengajuan::where('id_pengajuan', $decrypt)
        ->where('jenis', 'lainnya')->get();
        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $type = 0;
        return view('pengajuan.formPengajuan', compact('type','data','prodi','fakultas','bidang_a','bidang_b','bidang_c','bidang_d','lainnya'))->with('title', $this->title);
    }
    public function konfirmasiForm($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        
        $type = 1;
        return view('pengajuan.formTolKon', compact('type','data'))->with('title', $this->title);
    }
    public function tolakForm($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        
        $type = 0;
        return view('pengajuan.formTolKon', compact('type','data'))->with('title', $this->title);
    }

    public function update(PengajuanRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        
        $i = 'a';
        while($i <= 'd'){
            $filenames = 'bidang_'. $i;
            $this->inputFile($filenames,$request,$decrypt);
            $i++;
        }
        $filenames = 'lainnya';
        $this->inputFile($filenames,$request,$decrypt);
        
        $arr =collect([]);
        $arr->put('status', 4);
        $request = new Request($request->all());
        $request->merge($arr->toArray());

        $data->update($request->all());
        Session::flash('success', $this->title . ' berhasil direvisi');
        $links = session()->has('links') ? session('links') : [];
        $currentLink = request()->path(); // Getting current URI like 'category/books/'
        array_unshift($links, $currentLink); // Putting it in the beginning of links array
        session(['links' => $links]); // Saving links array to the session
        
        return redirect($request->prevUrl);
    }


    public function updateKonfirmasi(ReviewRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        $data->update(['status' => 2, 'tanggal_konfirmasi' => date('Y-m-d')]);
        
        $newId = date('dmYhis');
        
        $filenames = 'basenat';
        $this->inputFileReview($filenames,$request,$newId);
            
        $arr =collect([]);
        $arr->put('status', 0);
        $arr->put('id_review', $newId);
        $arr->put('id_pengajuan', $decrypt);
        $request = new Request($request->all());
        $request->merge($arr->toArray());

        Review::create($request->all());

        $user = User::where('username',$data->nidn)->first();
        $massg = 'Pengajuan anda telah dikonfirm oleh staf';
        Mail::send('email', ['nama' => $user->nama, 'pesan' => $massg], function ($message) use ($user)
        {
            $message->subject('Pengajuan');
            $message->from('donotreply@ashiup.com', 'UNIVERSITAS MUHAMADIYAH TANGERANG');
            $message->to($user->email);
        });
        Session::flash('success', $this->title . ' berhasil diconfirm');
        return redirect($request->prevUrl);
    }
    public function updateTolak(TolakRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        
        // $arr->put('status', 0);
        $request = new Request($request->all());
        $request->merge(['status' => 3, 'tanggal_tolak' => date('Y-m-d'),'tanggal_konfirmasi' => null]);

        $data->update($request->all());

        $user = User::where('username',$data->nidn)->first();
        $massg = 'Pengajuan anda telah ditolak oleh staf, silahkan lakukan revisi';
        Mail::send('email', ['nama' => $user->nama, 'pesan' => $massg], function ($message) use ($user)
        {
            $message->subject('Pengajuan');
            $message->from('donotreply@ashiup.com', 'UNIVERSITAS MUHAMADIYAH TANGERANG');
            $message->to($user->email);
        });
        Session::flash('success', $this->title . ' berhasil ditolak');
        return redirect($request->prevUrl);
    }

    public function destroy($id)
    {
        // dd($id);
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        

        $i = 1;
        while($i <= 4){
            $fto = 'foto_'.$i;
            $image_path = public_path()."/file/".$data->$fto;
            if(File::exists($image_path)) {
                unlink($image_path);
            }
            $i++;
        }
        $data->delete();

        Session::flash('success', $this->title . ' berhasil dihapus');
        return '/pengajuan';
    }
    public function destroyDokumen($id)
    {
        // dd($id);
        $decrypt = Crypt::decrypt($id);
        $data = DokumenPengajuan::find($decrypt);
        

        $dokumen = public_path()."/file/". $data->dokumen;
        if(File::exists($dokumen)) {
            unlink($dokumen);
        }
        $data->delete();

        Session::flash('success', $this->title . ' berhasil dihapus');
        return '/';
    }
}
