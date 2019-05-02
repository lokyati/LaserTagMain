<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Ranks;

class RankController extends Controller
{
	public function index() {
    	$rank = Ranks::all();
    	return $rank;
    }
	
    public function show($id)
    {
        $rank = Ranks::findOrFail($id);
        return $rank;
    }
}
