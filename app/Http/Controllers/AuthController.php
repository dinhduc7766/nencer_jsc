<?php

namespace App\Http\Controllers;

use App\Jobs\AccessLog;
use App\Jobs\DatabaseLog;
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
            // Login thanh cong
            // Ghi log
            // Yeu cau worker lam viec
            dispatch(new AccessLog(Auth::user()->id));
            dispatch(new DatabaseLog());
            return redirect('/board');
        }
        return redirect('/login');
    }
}

