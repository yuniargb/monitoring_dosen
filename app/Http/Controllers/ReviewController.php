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
        }else if(auth()->user()->role == 2){
            $data = Review::getData(null,auth()->user()->id_fakultas);
        }else{
            $data = Review::getData();
        }
        
        return view('review.review', compact('data'))->with('title', $this->title);
    }
    public function konfirmasiView()
    {
        if(auth()->user()->role == 1){
            $data = Review::getDataKonfirmasi();
        }else if(auth()->user()->role == 2){
            $data = Review::getDataKonfirmasi(null,auth()->user()->id_fakultas);
        }else{
            $data = Review::getDataKonfirmasi();
        }
        
        return view('review.reviewKonfirmasi', compact('data'))->with('title', $this->title);
    }
    public function tolakView()
    {
        if(auth()->user()->role == 1){
            $data = Review::getDataTolak();
        }else if(auth()->user()->role == 2){
            $data = Review::getDataTolak(null,auth()->user()->id_fakultas);
        }else{
            $data = Review::getDataTolak();
        }
        
        return view('review.reviewTolak', compact('data'))->with('title', $this->title);
    }

    

   
    public function edit($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        
        $type = 1;
        return view('review.formReview', compact('type','data'))->with('title', $this->title);    
    }
    
    public function tolakForm($id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        
        $type = 0;
        return view('review.formReview', compact('type','data'))->with('title', $this->title);
    }

    public function update(Request $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
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
                $image_path = public_path()."/images/".$data->$fto;
                if(File::exists($image_path)) {
                    unlink($image_path);
                }
                $arr->put($fto, $newName);
            }
            $i++;
        }

        $request = new Request($request->all());
        $request->merge($arr->toArray());

        $data->update($request->all());


        Session::flash('success', $this->title . ' berhasil diubah');
        return Redirect::back();
    }


    
    public function updateTolak(TolakRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        
        // $arr->put('status', 0);
        $request = new Request($request->all());
        $request->merge(['status' => 2, 'tanggal_tolak' => date('Y-m-d'),'tanggal_konfirmasi' => null]);

        $data->update($request->all());
        Session::flash('success', $this->title . ' berhasil ditolak');
        return redirect('/review');
    }
    public function updateKonfirmasi(Request $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Review::find($decrypt);
        
        // $arr->put('status', 0);
        $request = new Request($request->all());
        $request->merge(['status' => 1, 'tanggal_tolak' => null,'tanggal_konfirmasi' => date('Y-m-d')]);

        $data->update($request->all());
        Session::flash('success', $this->title . ' berhasil ditolak');
        return '/review';
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
        return '/review';
    }
}
