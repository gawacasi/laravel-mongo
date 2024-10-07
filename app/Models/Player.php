<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Player extends Eloquent
{
    protected $connection = 'mongodb';
    protected $fillable = ['tag', 'name', 'trophies', 'wins', 'losses'];
}
