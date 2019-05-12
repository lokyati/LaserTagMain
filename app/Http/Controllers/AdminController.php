<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth/admin-dashboard');
        //return view('layouts/admin_layout');
        //return view('test');
    }

    public function allUser() {
        $user = User::all();
        return $user;
    }

    public function users()
    {
        return view('auth/admin-users');
    }
    public function reservations()
    {
        return view('auth/admin-reservations');
    }
    public function packages()
    {
        return view('auth/admin-packages');
    }
}