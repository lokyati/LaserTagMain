<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reservedHours extends Model
{
	protected $table = 'reserved_hours';

    public function reservation() {
        return $this->hasOne('App\Reservations', 'foreign_key');
    }

    protected $fillable = [
        'hour'
    ];
}
