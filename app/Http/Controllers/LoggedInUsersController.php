<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\LoggedInUsers;
use Carbon\Carbon;

class LoggedInUsersController extends Controller
{

	public function index() {
    	$alluser = LoggedInUsers::all();
    	return $alluser;
    }

     public function create(Request $data, $id)
    {
        $loggedinuser = LoggedInUsers::create([
            'user_id' => $id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $updaetuser = LoggedInUsers::where('user_id', $id)->first();
        $updaetuser->updated_at = Carbon::now();
        $updaetuser->save();
        return $updaetuser;
    }
    
}
