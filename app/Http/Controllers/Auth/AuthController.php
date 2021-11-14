<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $req){
        // dd($req->all());
        // $data = User::where('name',$req->username)->first();
        // if($data){
        //     if(Hash::check($req->password, $data->password)){
        //         session(['is_logon' => TRUE]);
        //         return redirect('/dashboard');
        //     }
        // }
        if(Auth::attempt(['username' => $req->username, 'password' => $req->password])){
            return redirect('/dashboard');
        }
        return redirect('/')->with('message','Username atau Password salah');
    }

    public function logout(Request $req){
        Auth::logout();
        return redirect('/');
    }
}
