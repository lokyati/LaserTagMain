<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'package';

    protected $fillable = [
        'package_name', 'price', 'time', 'popularity', 'description',
    ];
}
