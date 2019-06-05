<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guard = 'user';

    protected $fillable = [
        'name', 'firstname', 'lastname', 'email', 'password', 'battle_points', 'updated', 'rank_id', 
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

    public function userMatches() {
        return $this->hasMany('App\Matches', 'foreign_key');
    }

    public function userLoggedIn() {
        return $this->hasOne('App\LoggedInUsers', 'foreign_key');
    }
}
