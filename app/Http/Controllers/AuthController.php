<?php

namespace App\Http\Controllers;

use App\Helpers\Mobile as HelpersMobile;
use App\Rules\Mobile;
use App\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(){
        return view('login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'mobile' => ['required', new Mobile],
            'password' => ['required', 'min:6', 'max:30', new Password]
        ]);
        $credentials['mobile'] = HelpersMobile::getNumber($credentials['mobile']);
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'mobile' => 'کلمه عبور یا نام کاربری اشتباه است.',
        ]);
    }
}
