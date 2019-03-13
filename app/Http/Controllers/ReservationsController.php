<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservations;

class ReservationsController extends Controller
{
    public function index() {
    	$reservations = Reservations::all();
    	return $reservations;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Reservations $reservations)
    {
        //
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
