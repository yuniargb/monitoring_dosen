<?php

namespace App\Http\Controllers;
use File;
use App\Pengajuan;
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
        }else if(auth()->user()->role == 2){

            $data = Pengajuan::getData(null,auth()->user()->id_fakultas);
        }else{
            $data = Pengajuan::getData(auth()->user()->username);
        }
              
        return view('pengajuan.pengajuan', compact('data'))->with('title', $this->title);
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

    public function create()
    {
        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $type = 1;
        return view('pengajuan.formPengajuan', compact('prodi','fakultas','type'))->with('title', $this->title);
    }

    public function store(PengajuanRequest $request)
    {
        $i = 1; 
        
        $arr =collect([]);
        while($i <= 4){
            $fto = 'foto_'.$i;
            if($request->file($fto)){
                $resorce = $request->file($fto);
                $name   = $resorce->getClientOriginalExtension();
                $newName = uniqid() . "." . $name;
                \Image::make($resorce)->resize(300, 200);
                $resorce->move(\base_path() . "/public/images/", $newName);
            }
            $arr->put($fto, $newName);
            $i++;
        }
        $arr->put('status', 0);
        $request = new Request($request->all());
        $request->merge($arr->toArray());

   
        Pengajuan::create($request->all());
      
        Session::flash('success',  $this->title . ' berhasil ditambahkan');
        return Redirect::back();
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        
        $prodi = Prodi::all();
        $fakultas = Fakultas::all();
        $type = 0;
        return view('pengajuan.formPengajuan', compact('type','data','prodi','fakultas'))->with('title', $this->title);
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
        
        $i = 1;
        $arr =collect([]);
        while($i <= 4){
            $fto = 'foto_'.$i;
            if($request->file($fto)){
                $resorce = $request->file($fto);
                $name   = $resorce->getClientOriginalExtension();
                $newName = uniqid() . "." . $name;
                \Image::make($resorce)->resize(300, 200);
                $resorce->move(\base_path() . "/public/images/", $newName);
                $image_path = public_path()."/images/".$data->$fto;
                if(File::exists($image_path)) {
                    unlink($image_path);
                }
            }else{
                $newName = $data->$fto;
            }
            $arr->put($fto, $newName);
            $i++;
        }
        // $arr->put('status', 0);
        $request = new Request($request->all());
        $request->merge($arr->toArray());

        $data->update($request->all());
        Session::flash('success', $this->title . ' berhasil diubah');
        return Redirect::back();
    }


    public function updateKonfirmasi(ReviewRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        $data->update(['status' => 1, 'tanggal_konfirmasi' => date('Y-m-d'), 'tanggal_tolak' => null]);
        $i = 1;
        $arr =collect([]);
        while($i <= 10){
            $fto = 'foto_'.$i.'_r';
            if($request->file($fto)){
                $resorce = $request->file($fto);
                $name   = $resorce->getClientOriginalExtension();
                $newName = uniqid() . "." . $name;
                \Image::make($resorce)->resize(300, 200);
                $resorce->move(\base_path() . "/public/images/", $newName);
            }
            $arr->put($fto, $newName);
            $i++;
        }
        $arr->put('status', 0);
        $arr->put('id_pengajuan', $decrypt);
        $request = new Request($request->all());
        $request->merge($arr->toArray());

        Review::create($request->all());


        Session::flash('success', $this->title . ' berhasil diconfirm');
        return redirect('/pengajuan');
    }
    public function updateTolak(TolakRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        
        // $arr->put('status', 0);
        $request = new Request($request->all());
        $request->merge(['status' => 2, 'tanggal_tolak' => date('Y-m-d'),'tanggal_konfirmasi' => null]);

        $data->update($request->all());
        Session::flash('success', $this->title . ' berhasil ditolak');
        return redirect('/pengajuan');
    }

    public function destroy($id)
    {
        // dd($id);
        $decrypt = Crypt::decrypt($id);
        $data = Pengajuan::find($decrypt);
        

        $i = 1;
        while($i <= 4){
            $fto = 'foto_'.$i;
            $image_path = public_path()."/images/".$data->$fto;
            if(File::exists($image_path)) {
                unlink($image_path);
            }
            $i++;
        }
        $data->delete();

        Session::flash('success', $this->title . ' berhasil dihapus');
        return '/pengajuan';
    }
}
