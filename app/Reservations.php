<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    protected $table = 'reservations';

    protected $fillable = [
        'year', 'month', 'day', 'reservedHour_id'
    ];

    
}
