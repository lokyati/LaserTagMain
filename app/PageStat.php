<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageStat extends Model
{
    protected $table = 'page_stat';

    protected $fillable = [
        'login_today', 'login_all', 'logged_in', 'reservations_today', 'reservations_all',
    ];
}
