<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Reservations;
use App\reservedHours;
use App\User;

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
            'month' => $data['month'],
            'day' => $data['day'],
            'players' => $data['players'],
            'tel' => $data['tel'],
            'note' => $data['note'],
            'package_id' => $data['package_id'],
            'user_id' => $data['user_id'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
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

    public function edit(Reservations $reservations)
    {
        //
    }

    public function update(Request $request, Reservations $reservations)
    {
        //
    }

    public function destroy(Reservations $reservations)
    {
        //
    }
}
