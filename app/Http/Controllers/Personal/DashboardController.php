<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personal/dashboard');
    }
}