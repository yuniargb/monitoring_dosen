<?php

namespace App\Http\Controllers;
use File;
use App\User;
use App\Fakultas;
use App\Http\Requests\StafRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class StafController extends Controller
{
    private $title;

    public function __construct()
    {
        $this->title = 'Data Staf';
    }


    public function index()
    {
        $data = User::getStaf();
        return view('staf.staf', compact('data',))->with('title', $this->title);
    }

    public function create()
    {
        $type = 1;
        $fakultas = Fakultas::all();
        return view('staf.formStaf', compact('type','fakultas'))->with('title', $this->title);
    }

    public function store(StafRequest $request)
    {
        $request = new Request($request->all());
        $request->merge([
            'password' => Hash::make($request->password)
        ]);
        User::create($request->all());
        // dd($request->all());
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
        $data = User::find($decrypt);
        $type = 0;
        $fakultas = Fakultas::all();
        return view('staf.formStaf', compact('type','data','fakultas'))->with('title', $this->title);
    }

    public function update(StafRequest $request, $id)
    {
        $decrypt = Crypt::decrypt($id);
        $data = User::find($decrypt);
        $request = new Request($request->all());
        if(!empty($request->password)){
            $request->merge([
                'password' => Hash::make($request->password)
            ]);
        }else{
            unset($request['password']);
        }
        $data->update($request->all());
        Session::flash('success', $this->title . ' berhasil diubah');
        return Redirect::back();
    }

    public function destroy($id)
    {
        // dd($id);
        $decrypt = Crypt::decrypt($id);
        $data = User::find($decrypt);
        $data->delete();

        Session::flash('success', $this->title . ' Staf berhasil dihapus');
        return '/admin/dosen';
    }
}
