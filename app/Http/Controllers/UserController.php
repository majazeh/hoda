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
    public function index(Request $request){
        $this->authorize('access', auth()->user());
        $data = [];
        $data['users'] = User::paginate();
        return view('users.index', $data);
    }

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
        return redirect()->route('users.create');
    }

    public function edit(User $user){
        $this->authorize('update', $user);
        return view('users.create', ['user' => $user]);
    }

    public function update(Request $request, User $user){
        $this->authorize('update', $user);
        $data = $request->validate(
            $user->id == 1 ? [
            'name' => 'required|min:3',
            'mobile' => ['required', new Mobile],
            'password' => ['nullable', 'min:6', 'max:30', new Password]
        ] :[
            'name' => 'required|min:3',
            'password' => ['nullable', 'min:6', 'max:30', new Password]
        ]);
        if(isset($data['mobile'])){
            $data['mobile'] = HelpersMobile::getNumber($data['mobile']);
            if(User::where('mobile', $data['mobile'])->where('id', '<>', $user->id)->first()){
                throw ValidationException::withMessages([
                    'mobile' => __('validation.unique', ['attribute' => $data['mobile']])
                ]);
            }
        }
        if(!$data['password']){
            unset($data['password']);
        }elseif(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }
        $user->update($data);
        return redirect()->route('users.edit', $user->id);
    }
}
