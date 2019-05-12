<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\reservedHours;
use App\Reservations;

class reservedHourController extends Controller
{
    public function index() {
    	$reservedhours = reservedHours::all();
    	return $reservedhours;
    }

    public function store(Request $request)
    {
        reservedHours::create([
            'year' => $request['year'],
            'month' => $request['month'],
            'day' => $request['day'],
            'hour' => $request['hour'],
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

    public function destroy($id)
    {
        $reservedhours = reservedHours::where('reservation_id', $id)->delete();

        $reservation = Reservations::where('id', $id)->delete();
        return response()->json('reservations deleted');
    }
}
