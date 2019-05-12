<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Reservations;
use App\reservedHours;
use App\User;
use Carbon\Carbon;

class ReservationsController extends Controller
{
    public function index() {
    	$reservations = Reservations::all();
    	return $reservations;
    }

    public function create(Request $data)
    {
        $reservations = Reservations::create([
            'year' => $data['year'],
            'first_hour' => $data['first_hour'],
            'month' => $data['month'],
            'day' => $data['day'],
            //'date' => $data['date'],
            'players' => $data['players'],
            'tel' => $data['tel'],
            'note' => $data['note'],
            'email' => $data['email'],
            'package_id' => $data['package_id'],
            'user_id' => $data['user_id'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'bonus_used' => $data['bonus_used'],
            'price' => $data['price'],
        ]);

        foreach ($data['hour'] as $reserved['hour']){

            reservedHours::create([
                'reservation_id' => $reservations->id,
                'hour' => $reserved['hour'],
            ]);
        }

        return $reservations;
    }

    public function store(Request $request)
    {
        //
    }

    public function show($day)
    {
        Reservations::find($day);
    }

    public function showByUser($id)
    {
        $reservation = Reservations::where('user_id', $id)->get();
        return $reservation;
    }

    public function reservationsToday()
    {
        $reservation = Reservations::whereDate('created_at', Carbon::today())->get();
        return $reservation;
    }

    public function edit(Reservations $reservations)
    {
        //
    }

    public function update(Request $request, Reservations $reservations)
    {
        //
    }

    public function destroy($id)
    {
        $reservation = Reservations::where('id', $id)->delete();
        return response()->json('reservation deleted');
    }
}
