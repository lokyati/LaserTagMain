<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'year', 'month', 'day', 'players', 'tel', 'note', 'user_id', 'package_id', 'created_at', 'updated_at', 'firstname', 'lastname',
    ];

    
}
