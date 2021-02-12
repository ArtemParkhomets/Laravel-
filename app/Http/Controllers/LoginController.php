<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        //dd($req->email);
        if($req->email=='admin@admin' && $req->password=='1'){
            return redirect(route('admin.home'));
        }
        if (Auth::check()){
            return redirect('private');
        }
        $fields=$req->only('email', 'password');


        if(Auth::attempt($fields)){
            $isadmin=Auth::user()->is_admin;
            if ($isadmin==1){
                return redirect('admin/home');
            }
            return redirect('private');
        }
        return redirect(route('login'))->withErrors([
            'formError'=>'Чё сска пароль забыл?)'
        ]);
    }
}
