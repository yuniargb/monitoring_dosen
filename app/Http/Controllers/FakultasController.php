<?php

namespace App\Http\Controllers;
use File;
use App\Fakultas;
use App\Http\Requests\FakultasRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class FakultasController extends Controller
{
    private $title;

    public function __construct()
    {
        $this->title = 'Data Fakultas';
    }


    public function index()
    {
        $data = Fakultas::all();
        return view('fakultas.fakultas', compact('data'))->with('title', $this->title);
    }

    public function create()
    {
        $type = 1;
        return view('fakultas.formFakultas', compact('type'))->with('title', $this->title);
    }

    public function store(FakultasRequest $request)
    {
        Fakultas::create($request->all());
      
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
        $data = Fakultas::find($decrypt);
        $type = 0;
        return view('fakultas.formFakultas', compact('type','data'))->with('title', $this->title);
    }

    public function update(FakultasRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = Fakultas::find($decrypt);
        $data->update($request->all());
        Session::flash('success', $this->title . ' berhasil diubah');
        return Redirect::back();
    }

    public function destroy($id)
    {
        // dd($id);
        $decrypt = Crypt::decrypt($id);
        $data = Fakultas::find($decrypt);
        $data->delete();

        Session::flash('success', $this->title . ' Fakultas berhasil dihapus');
        return '/admin/fakultas';
    }
}
