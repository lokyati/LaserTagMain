<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Reservations;

class ReservationsController extends Controller
{
    public function index() {
    	$reservations = Reservations::all();
    	return $reservations;
    }

    public function create()
    {
        $reservations = Reservations::create([
            'year' => $data['year'],
            'month' => $data['month'],
            'day' => $data['day'],
        ]);

        reservedHours::create([
            'reservations_id' => $reservations->id,
        ]);

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
