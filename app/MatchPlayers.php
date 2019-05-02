<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class MatchPlayers extends Model
{
    protected $table = 'match_players';

    protected $fillable = [
        'match_date', 'user_id', 'score', 'all_shot', 'all_hit', 'all_acc', 'bonus'
    ];

    public function matchUser() {
        return $this->hasOne('App\Matches', 'foreign_key');
    }
}
