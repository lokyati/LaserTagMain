<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UsersStat extends Model
{
	use Notifiable;

    protected $table = 'users_stat';

    protected $fillable = [
    	'user_id', 'all_shot', 'all_hit', 'matches', 'wins', 'loses', 'avg_shot', 'avg_acc', 'avg_hit', 'lvl', 'experience', 'all_out', 'bestplace'
    ];
}
