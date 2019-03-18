<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('userProfil');
    }

    public function home()
    {
        return view('home');
    }

    public function profile(){
         //$user = User::all();
         $user = Auth::user();
         return $user;
    } 
    
}
