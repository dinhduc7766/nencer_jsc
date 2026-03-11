<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login() {
        return view('login');
    }

    public function postLogin(Request $request) {
        $param = $request->all();
        $credentials = [
            "email"    => $param["email"],
            "password" => $param["password"]
        ];
        if (Auth::attempt($credentials)) {
            return redirect('/board');
        }
        return redirect('/login');
    }
}

