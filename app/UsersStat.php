<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class UsersStat extends Model
{
	use Notifiable;

    protected $table = 'users_stat';

    protected $fillable = [
    	'user_id'
    ];
}
