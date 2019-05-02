<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Matches;
use App\User;

class MatchesController extends Controller
{
    public function index() {
    	$matches = Matches::all();
    	return $matches;
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

    public function store(Request $request)
    {
        //
    }

    public function show($day)
    {
        Mathces::find($day);
    }

    public function showByUser($id)
    {
        $match = Matches::where('user_id', $id)->get();
        return $match;
    }

    public function edit(Matches $mathces)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $match = Matches::where('id', $id)->first();
        $match->processed = $request->get('processed');
        $match->save();
        return $match;
    }

    public function destroy($id)
    {
        $match = Matches::where('id', $id)->delete();
        return response()->json('match deleted');;
    }
}
