<?php

namespace App\Http\Controllers;

use App\User;
use App\Iklan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        $data = Iklan::find(1);
        return view('auth.login', compact('data'));
    }

    public function loginpost(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);
        // var_dump(Hash::check($request->password, $user->password));
        if (Auth::attempt(array('username' => $request->username, 'password' => $request->password))) {
            if (auth()->user()->role == 1) {
                return redirect('/admin/prodi');
            } else if (auth()->user()->role == 4 ) {
                return redirect('/pengajuan');
            } else if (auth()->user()->role == 2) {
                return redirect('/pengajuan/dashboard');
            } else {
                return redirect('/review/dashboard');
            }
        }else{
            Session::flash('failed', 'password salah');
            return redirect('/login')->withInput($request->only(['username','password']));
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
