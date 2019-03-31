<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservedHours extends Model
{
	protected $table = 'reserved_hours';    

    protected $fillable = [
         'reservation_id', 'hour'
    ];

    public function reservations() {
        return $this->hasMany('App\Reservations', 'foreign_key');
    }
}
