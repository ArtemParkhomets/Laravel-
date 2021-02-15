<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function reg_v()
    {
        return view('auth/registration');
    }

    public function save(Request $request)
    {
        if (Auth::check()){
            return redirect(route('home'));
        }
            $validate=$request->validate([
                'name'=>'required',
                'email'=>'required|email|unique:users|exists:users,email',
                'password'=>'required',
                'confirm_password'=>'same:password'
            ]);

        /*if (User::where('email', $validate['email'])->exists()){

            return redirect(route('reg_v'))->withErrors([
            'email'=>'Пользователь с таким email уже существует'
            ]);
        }*/
        $user = User::create($validate);

        if ($user){
            Auth::login($user);

            return redirect(route('home'));
        }

        return redirect(route('reg_v'))->withErrors([
            'formError'=>'Шота не так'
        ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('home'));
    }
}
