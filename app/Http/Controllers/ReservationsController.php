<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Reservations;
use App\reservedHours;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;

class ReservationsController extends Controller
{
    public function index() {
    	$reservations = Reservations::all();
    	return $reservations;
    }

    public function createold(Request $data)
    {
        Log::info('This is some useful information.');

        $reservations = Reservations::create([
            'year' => $data['year'],
            'first_hour' => $data['first_hour'],
            'month' => $data['month'],
            'day' => $data['day'],
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

        foreach ($data['hours'] as $reserved['hour']){

            reservedHours::create([
                'reservation_id' => $reservations->id,
                'hour' => $reserved['hour'],
            ]);
        }

        return $reservations;
    }

    public function create(Request $data)
    {

        try {
        
        $success = true;

        DB::beginTransaction(); 

        $allreservation = Reservations::where([
            ['month', '=', $data['month']],
            ['day', '=', $data['day']],
        ])->sharedLock()->get();

        
        if($allreservation->count() != 0){
            foreach($allreservation as $reservation){
                $resHours = reservedHours::where([
                    ['reservation_id', '=', $reservation['id']]
                ])->sharedLock()->get();
            }

            $dataHours = $data['hours'];

            foreach($dataHours as $desired){
                foreach($resHours as $resHour){
                    if($desired == $resHour['hour']){
                        $success = false;
                    }
                }
            }
        }
        
        if($success){
            $reservations = Reservations::create([
                'year' => $data['year'],
                'first_hour' => $data['first_hour'],
                'month' => $data['month'],
                'day' => $data['day'],
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

            foreach ($data['hours'] as $reserved['hour']){

                reservedHours::create([
                    'reservation_id' => $reservations->id,
                    'hour' => $reserved['hour'],
                ]);
            }

        }else{
            DB::rollback();
            return response(null, 409);
        }


        DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }

        
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
