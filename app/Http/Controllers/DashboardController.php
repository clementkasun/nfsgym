<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function load_dash_board()
    {
        return view('dashboard');
    }
}
