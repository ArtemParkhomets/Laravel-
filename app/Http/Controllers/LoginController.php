<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $req)
    {
        $fields = $req->only('email', 'password');

        if (Auth::attempt($fields)) {
            $isadmin = Auth::user()->is_admin;

            if ($isadmin == 1) {
                return redirect(route('admin.products'));
            }

            return redirect(route('cart'));
        }

        return redirect(route('login'))->withErrors([
            'formError' => 'Неправильный пароль или Email'
        ]);
    }
}
