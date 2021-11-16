<?php

namespace App\Http\Controllers;

use App\Helpers\Mobile as HelpersMobile;
use App\Models\User;
use App\Rules\Mobile;
use App\Rules\Password;
use App\Services\Kavenegar;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;

class AuthController extends Controller
{
    public function loginForm(){
        return view('login');
    }

    public function registerForm(){
        return view('register');
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

    public function register(Request $request){
        $data = $request->validate([
            'mobile' => ['required', new Mobile],
            'name' => ['required', 'min:3']
        ]);
        $executed = RateLimiter::attempt(
            'register-try'.$request->ip(),
            2,
            function() {
            }
        );

        if (! $executed) {
            throw new Exception('Too many messages sent!', 419);
        }
        $data['mobile'] = HelpersMobile::getNumber($data['mobile']);
        if($exists = User::where('mobile', $data['mobile'])->first()){
            return back()->withErrors([
                'mobile' => 'این شماره موبایل قبلا ثبت‌شده است.',
            ]);
        }
        $password = rand(130171, 999999);
        DB::beginTransaction();
        User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($password)
        ]);
        Kavenegar::VerifyLookup(HelpersMobile::getNumber($data['mobile'], HelpersMobile::COUNTRYCODE), $password, null, null, 'hoda-register');
        DB::commit();
        return redirect()->route('loginForm');
    }
}
