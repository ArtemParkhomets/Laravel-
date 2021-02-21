<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function registerView()
    {
        return view('auth/registration');
    }

    public function save(RegistrationRequest $req)
    {
        if (Auth::check()){
            return redirect(route('home'));
        }
        $user           = new User();
        $user->name     = $req->input('name');
        $user->email    = $req->input('name');
        $user->password = $req->input('name');
        $user->save();

        if ($user){
            Auth::login($user);

            return redirect(route('home'));
        }

        return redirect(route('reg_v'))->withErrors([
            'formError'=>'Что-то пошло не так'
            ]);
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('home'));
    }
}
