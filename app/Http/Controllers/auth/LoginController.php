<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
// use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use App\Models\LogActivity;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginFrom(){
        return view('auth.login');
    }

    public function login(Request $request){
        $request->validate([
            'login' => 'required',
            'password' => 'required'
        ]);

        $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginType => $request->login,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            LogActivity::create([
                'username' => Auth::user()->username,
                'activity' => 'user Login ke Sistem'
            ]); 

            if(Auth::user()->role === 'administrator'){
                return redirect()->route('dashboard');
            }

            return redirect()->route('dashboard');
        }

        return back()->withErrors([
            'login' => 'Username / Emain atau Password salah.'
        ]);
    }

    public function logout(Request $request){
        if(Auth::check()){
            LogActivity::created([
                'username' => Auth::user()->usernamem,
                'activity' => 'User logout dari sistem'
            ]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
