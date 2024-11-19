<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authcontroller extends Controller
{
    public function index(){
        return view(
            'Auth.login'
        );
    }

    public function login_proses(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8'
        ], [
            'email.required' =>'Data wajib diisi!!!',
            'email.email' =>'format email tidak valid',
            'email.exists' =>'email tidak sesuai',

            'password.required' => 'password wajib diisi',
            'password.min' => 'password minimal 8 karakter'
        ]);

        $user=User::where('email', $request->email)->first();

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)) {
            return redirect('/dashboard');
        } else {
            return redirect()->back()->withErrors([
                'email' => 'email tidak sesuai',
                'password' => 'password salah'
            ]);
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }
}
