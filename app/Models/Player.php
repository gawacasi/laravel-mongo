<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model; 
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    protected $collection = 'players'; 

    protected $fillable = [
        'tag',
        'name',
        'trophies',
        'wins',
        'losses',
        'cards' 
    ];

    public function cards()
    {
        return $this->embedsMany(Card::class); 
    }
}
