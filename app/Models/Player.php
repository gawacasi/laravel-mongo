<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $connection = 'mongodb'; 
    protected $collection = 'players';

    protected $fillable = [
        'tag', 'name', 'trophies', 'wins', 'losses',
    ];
}
