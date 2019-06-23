<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matches;

class Simulatorcontroller extends Controller
{
    public function index()
    {
        return view('simulator');
    }

    public function create(Request $data)
    {
        $matches = Matches::create([
            'user_id' => $data['user_id'],
            'score' => $data['score'],
            'all_shot' => $data['all_shot'],
            'all_hit' => $data['all_hit'],
            'acc' => $data['acc'],
            'all_out' => $data['all_out'],
            'bonus' => $data['bonus'],
            'match_date' => $data['match_date'],
            'placed' => $data['placed'],
            'result' => $data['result'],
            'processed' => $data['processed'],
        ]);

        return $matches;
    }
}
