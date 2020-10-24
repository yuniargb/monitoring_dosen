<?php

namespace App\Http\Controllers;
use File;
use App\Prodi;
use App\Fakultas;
use App\Http\Requests\ProdiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class ProdiController extends Controller
{
    private $title;

    public function __construct()
    {
        $this->title = 'Data Prodi';
    }


    public function index()
    {
        $data = Prodi::getData();
        return view('prodi.prodi', compact('data'))->with('title', $this->title);
    }

    public function create()
    {
        $fakultas = Fakultas::all();
        $type = 1;
        return view('prodi.formProdi', compact('fakultas','type'))->with('title', $this->title);
    }

    public function store(ProdiRequest $request)
    {
        Prodi::create($request->all());
      
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
        $data = Prodi::find($decrypt);
        $type = 0;
        $fakultas = Fakultas::all();
        return view('prodi.formProdi', compact('type','data','fakultas'))->with('title', $this->title);
    }

    public function update(ProdiRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Prodi::find($decrypt);
        $data->update($request->all());
        Session::flash('success', $this->title . ' berhasil diubah');
        return Redirect::back();
    }

    public function destroy($id)
    {
        // dd($id);
        $decrypt = Crypt::decrypt($id);
        $data = Prodi::find($decrypt);
        $data->delete();

        Session::flash('success', $this->title . ' Prodi berhasil dihapus');
        return '/dosen/prodi';
    }
}
