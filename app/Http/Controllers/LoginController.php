<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //jika metode get
    public function login(){
        return view('Login');
    }

    public function loginproses(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
        }
        return \redirect('login');
    }

    public function logout(){
        Auth::logout();
        return \redirect('login');
    }


    public function register(){
        return view('register');
    }

    //jika metode post
    public function registeruser(Request $request){
        user::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'remember_token' => Str::random(60),    
        ]);

        return redirect('/login');
    }
}
