<?php

namespace App\Http\Controllers;

use App\Jobs\AccessLog;
use App\Jobs\DatabaseLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login() {
        if (Auth::check()) {
            return redirect('/board');
        }
        return view("auth.login");
    }

    public function postLogin(Request $request) {
        $param = $request->all();
        $credentials = [
            "email"    => $param["email"],
            "password" => $param["password"]
        ];
        if (Auth::attempt($credentials)) {
            // Login thanh cong
            
            return redirect('/board');
        }
        // Login that bai
        return redirect('/login');
    }

    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
}

