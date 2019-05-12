<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoggedInUsers extends Model
{
    protected $table = 'logged_in_users';

    protected $fillable = [
        'user_id'
    ];
}
