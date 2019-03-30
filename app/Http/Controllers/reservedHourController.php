<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\reservedHours;

class reservedHourController extends Controller
{
    public function index() {
    	$reservedhours = reservedHours::all();
    	return $reservedhours;
    }

    public function store(Request $request)
    {
        reservedHours::create([
            'hour' => $request['hours'],
        ]);

        return $request->hour;
    }

    public function create(Request $request)
    {
        /*$reservedhours = reservedHours::create([
            'hour' => $data['hour'],
        ]);

        Reservations::create([
        	'year' => $data['year'],
        	'month' => $data['month'],
            'day' => $data['day'],
            'reservations_id' => $reservations->id,
        ]);

        return $reservedhours;*/

        return reservedHours::create([
            'hour' => $request['hour'],
        ]);
    }
}
