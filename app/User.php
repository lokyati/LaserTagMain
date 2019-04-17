<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard = 'user';

    protected $fillable = [
        'name', 'email', 'password', 'lvl', 'battle_point_balance', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userStats() {
        return $this->hasOne('App\UsersStat', 'foreign_key');
    }

    public function userReservations() {
        return $this->hasMany('App\Reservations', 'foreign_key');
    }
}
