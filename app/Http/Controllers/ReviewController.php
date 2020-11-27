<?php

namespace App\Http\Controllers;
use File;
use Mail;
use App\Pengajuan;
use App\Prodi;
use App\Fakultas;
use App\Review;
use App\User;
use App\DokumenReview;
use App\Http\Requests\PengajuanRequest;
use App\Http\Requests\ReviewRequest;
use App\Http\Requests\TolakRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class ReviewController extends Controller
{
    private $title;

    public function __construct()
    {
        $this->title = 'Data Review';
    }


    public function index()
    {   
        
        if(auth()->user()->role == 1){
            $data = Review::getData();
            $cek = Review::where('status', 0);
            $cek->update(['status' => 1]);
        }else if(auth()->user()->role == 3 || auth()->user()->role == 5 || auth()->user()->role == 6 || auth()->user()->role == 7){
            $data = Review::getData(null,null,auth()->user()->role);
            if(auth()->user()->role == 3){
                $cek = Review::where('status', 0);
                $cek->update(['status' => 1]);
            }else if(auth()->user()->role == 5){
                $cek = Review::where('status_dupak', 0);
                $cek->update(['status_dupak' => 1]);
            }else if(auth()->user()->role == 6){
                $cek = Review::where('status_pak', 0);
                $cek->update(['status_pak' => 1]);
            }else if(auth()->user()->role == 7){
                $cek = Review::where('status_sk', 0);
                $cek->update(['status_sk' => 1]);
            }
        }else{
            $data = Review::getData(null,auth()->user()->id_fakultas);
        }
        return view('review.review', compact('data'))->with('title', $this->title);
    }
    public function konfirmasiView()
    {
        if(auth()->user()->role == 1){
            $data = Review::getDataKonfirmasi();
        }else if(auth()->user()->role == 3 || auth()->user()->role == 5 || auth()->user()->role == 6 || auth()->user()->role == 7){
            $data = Review::getDataKonfirmasi(null,auth()->user()->id_fakultas,auth()->user()->role);
        }else{
            $data = Review::getDataKonfirmasi(null,auth()->user()->id_fakultas);
        }
        
        return view('review.reviewKonfirmasi', compact('data'))->with('title', $this->title);
    }
    public function tolakView()
    {
        if(auth()->user()->role == 1){
            $data = Review::getDataTolak();
        }else if(auth()->user()->role == 3 || auth()->user()->role == 5 || auth()->user()->role == 6 || auth()->user()->role == 7){
            $data = Review::getDataTolak(null,auth()->user()->id_fakultas,auth()->user()->role);
        }else{
            $data = Review::getDataTolak(null,auth()->user()->id_fakultas);
        }
        
        return view('review.reviewTolak', compact('data'))->with('title', $this->title);
    }

    public function ditagguhkanView()
    {
        if(auth()->user()->role == 1){
            $data = Review::getDataDitagguhkan();
        }else if(auth()->user()->role == 2){
            $data = Review::getDataDitagguhkan(null,auth()->user()->id_fakultas);
        }else{
            $data = Review::getDataDitagguhkan(auth()->user()->username);
        }
        
        return view('review.reviewDitagguhkan', compact('data'))->with('title', $this->title);
    }

    public function detail($id)
    {
        $cek = DokumenReview::where('id_review', $id)->get();
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

    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        $basnat = DokumenReview::where('id_review', $decrypt)->get();
        $type = 1;
        return view('review.formReview', compact('type','data','basnat'))->with('title', $this->title);    
    }
    
    public function tolakForm($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        
        $type = 0;
        return view('review.formReview', compact('type','data'))->with('title', $this->title);
    }


    public function konfirmasiForm($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        
        $type = 2;
        return view('review.formReview', compact('type','data'))->with('title', $this->title);
    }

    public function update(Request $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);


        $filenames = 'basenat';
        $this->inputFileReview($filenames,$request,$decrypt);

        $arr =collect([]);
        $arr->put('status', 4);
        $request = new Request($request->all());
        $request->merge($arr->toArray());

        $data->update($request->all());


        Session::flash('success', $this->title . ' berhasil diubah');
        return redirect($request->prevUrl);
    }

     public function dashboard()
    {

        
        if(auth()->user()->role == 1){
            $dosen = User::getDosenJumlah();
            $new = Review::reviewNew();
            $review = Review::reviewInReview();
            $konfirm = Review::reviewComplete();
            $revisi = Review::reviewRevisi();
            $ditagguhkan = Review::reviewDitagguhkan();
        }else {
            $dosen = User::getDosenJumlah(auth()->user()->id_fakultas,auth()->user()->role);
            $new = Review::reviewNew(auth()->user()->id_fakultas,auth()->user()->role);
            $review = Review::reviewInReview(auth()->user()->id_fakultas,auth()->user()->role);
            $konfirm = Review::reviewComplete(auth()->user()->id_fakultas,auth()->user()->role);
            $revisi = Review::reviewRevisi(auth()->user()->id_fakultas,auth()->user()->role);
            $ditagguhkan = Review::reviewDitagguhkan(auth()->user()->id_fakultas,auth()->user()->role);
        }
        return view('review.reviewDashboard', compact('dosen','new','review','konfirm','revisi','ditagguhkan'))->with('title', $this->title);
    }
    
    public function updateTolak(TolakRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        
        // $arr->put('status', 0);
        
        if(auth()->user()->role == 5){
            $data->status_dupak = 3;
            $data->pesan_revisi_dupak = $request->pesan_revisi;
            $data->tanggal_tolak_dupak = date('Y-m-d');
            $bagian = 'DUPAK';
            
        }else if(auth()->user()->role == 6){
            $data->status_pak = 3;
            $data->pesan_revisi_pak = $request->pesan_revisi;
            $data->tanggal_tolak_pak = date('Y-m-d');
            $bagian = 'PAK';
        }else if(auth()->user()->role == 7){
            $data->status_sk = 3;
            $data->pesan_revisi_sk = $request->pesan_revisi;
            $data->tanggal_tolak_sk = date('Y-m-d');
            $bagian = 'SK';
        }else{
            $data->status = 3;
            $data->pesan_revisi = $request->pesan_revisi;
            $data->tanggal_tolak = date('Y-m-d');
            $bagian = 'BAAK';
        }
        $data->update();

        $data2 = Pengajuan::find($data->id_pengajuan);
        $user = User::where('username',$data2->nidn)->first();
        $massg = 'Review ditolak oleh staff '. $bagian .', staff fakultas sedang memperbaiki';
        Mail::send('email', ['nama' => $user->nama, 'pesan' => $massg], function ($message) use ($user)
        {
            $message->subject('Review');
            $message->from('donotreply@ashiup.com', 'UNIVERSITAS MUHAMADIYAH TANGERANG');
            $message->to($user->email);
        });
        Session::flash('success', $this->title . ' berhasil ditolak');
        return redirect($request->prevUrl);
    }

    function inputFileSK($field,$request,$newId){
        $files = $request->file(strtolower($field));
        $resorce = $files;
        $name   = $resorce->getClientOriginalExtension();
        $newName = uniqid() . "." . $name;
        
        $resorce->move(\base_path() . "/public/file/", $newName);
        $arr2 = array(
            strtolower($field) => $newName
        );

        $datass = Review::find($newId);
        $datass->update($arr2);
    }


    public function updateKonfirmasi(Request $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        
        if($request->hasFile('dupak')){ 
            $bagian = 'DUPAK';
            $this->inputFileSK($bagian,$request,$decrypt);
        }else if($request->hasFile('pak')){
            $bagian = 'PAK';
            $this->inputFileSK($bagian,$request,$decrypt);
        }else if($request->hasFile('sk')){
            $bagian = 'SK';
            $this->inputFileSK($bagian,$request,$decrypt);
            $data->tanggal_konfirmasi = date('Y-m-d');
            $data->status = 2;
           
        }
        $data->update();
        $data2 = Pengajuan::find($data->id_pengajuan);
        $user = User::where('username',$data2->nidn)->first();
        if($bagian == 'SK'){
            $user->jabatan_fungsional = $data2->jabatan_fungsional;
            $user->update();
        }
        $massg = 'Data '. $bagian .' telah ditambahkan';
        Mail::send('email', ['nama' => $user->nama, 'pesan' => $massg], function ($message) use ($user)
        {
            $message->subject('Review');
            $message->from('donotreply@ashiup.com', 'UNIVERSITAS MUHAMADIYAH TANGERANG');
            $message->to($user->email);
        });


        Session::flash('success', $this->title . ' berhasil ditambahkan');
        return redirect($request->prevUrl);
    }

    public function destroy($id)
    {
        // dd($id);
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        

        $data2 = DokumenReview::where('id_review',$decrypt);

        foreach ($data2->get() as $d) {
             $dokumen = public_path()."/file/". $d->dokumen;
            if(File::exists($dokumen)) {
                unlink($dokumen);
            }
        }
        $data->delete();
        $data2->delete();

        Session::flash('success', $this->title . ' berhasil dihapus');
        return '/review';
    }

    public function destroyDokumen($id)
    {
        // dd($id);
        $decrypt = Crypt::decrypt($id);
        $data = DokumenReview::find($decrypt);
        

        $dokumen = public_path()."/file/". $data->dokumen;
        if(File::exists($dokumen)) {
            unlink($dokumen);
        }
        $data->delete();

        Session::flash('success', $this->title . ' berhasil dihapus');
        return '/';
    }
}
