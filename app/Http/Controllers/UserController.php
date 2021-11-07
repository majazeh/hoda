<?php

namespace App\Http\Controllers;

use App\Helpers\Mobile as HelpersMobile;
use App\Models\User;
use App\Rules\Mobile;
use App\Rules\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function create(){
        $this->authorize('access', auth()->user());
        return view('users.create');
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|min:3',
            'mobile' => ['required', new Mobile],
            'password' => ['required', 'min:6', 'max:30', new Password]
        ]);
        $data['mobile'] = HelpersMobile::getNumber($data['mobile']);
        if(User::where('mobile', $data['mobile'])->first()){
            throw ValidationException::withMessages([
                'mobile' => __('validation.unique', ['attribute' => $data['mobile']])
            ]);
        }
        User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password'])
        ]);
        redirect()->route('users.create');
    }
}
