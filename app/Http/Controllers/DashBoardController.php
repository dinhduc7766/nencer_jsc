<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    /**
     *  Controller method render view dashboard page.
     * 
     * @return mixed \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function board() {
        return view("pages.dashboard");
    }
}
