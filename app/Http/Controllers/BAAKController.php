<?php

namespace App\Http\Controllers;
use File;
use App\User;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class BAAKController extends Controller
{
    private $title;

    public function __construct()
    {
        $this->title = 'Data BAAK';
    }


    public function index()
    {
        $data = User::getBAAK();
        return view('baak.baak', compact('data'))->with('title', $this->title);
    }

    public function create()
    {
        $type = 1;
        return view('baak.formBAAK', compact('type'))->with('title', $this->title);
    }

    public function store(UserRequest $request)
    {
        $request = new Request($request->all());
        $request->merge([
            'password' => Hash::make($request->password)
        ]);
        User::create($request->all());
      
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
        return view('baak.formBAAK', compact('type','data'))->with('title', $this->title);
    }

    public function update(UserRequest $request, $id)
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

        Session::flash('success', $this->title . ' BAAK berhasil dihapus');
        return '/admin/baak';
    }
}
