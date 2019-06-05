<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Simulatorcontroller extends Controller
{
    public function index()
    {
        return view('simulator');
    }
}
