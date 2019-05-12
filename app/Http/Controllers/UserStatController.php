<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\UsersStat;

class UserStatController extends Controller
{
    public function show($id)
    {
        $stat = UsersStat::findOrFail($id)->first();
        return $stat;
    }

    public function showByUser($id){
        $stat = UsersStat::where('user_id', $id)->get();
        return $stat;
    }

    public function update(Request $request, $id)
    {
        $userstat = UsersStat::where('user_id', $id)->first();
        $userstat->all_shot = $request->get('all_shot');
        $userstat->all_hit = $request->get('all_hit');
        $userstat->all_out = $request->get('all_out');
        $userstat->matches = $request->get('matches');
        $userstat->wins = $request->get('wins');
        $userstat->loses = $request->get('loses');
        $userstat->bestplace = $request->get('bestplace');
        $userstat->avg_shot = $request->get('avg_shot');
        $userstat->avg_hit = $request->get('avg_hit');
        $userstat->avg_acc = $request->get('avg_acc');
        $userstat->experience = $request->get('experience');
        $userstat->lvl = $request->get('lvl');
        $userstat->save();
        return $userstat;
    }
}
