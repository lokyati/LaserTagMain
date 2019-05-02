<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ranks extends Model
{
    protected $table = 'ranks';

    protected $fillable = [
        'rank_name', 'required_lvl',
    ];
}
