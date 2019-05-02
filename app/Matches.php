<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $table = 'matches';

    protected $fillable = [
        'match_date', 'user_id', 'score', 'all_shot', 'all_hit', 'acc', 'bonus', 'placed', 'result', 'processed', 'all_out'
    ];

    public function matchUser() {
        return $this->hasOne('App\Matches', 'foreign_key');
    }}
