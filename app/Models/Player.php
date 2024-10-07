<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Player extends Model
{
    protected $connection = 'mongodb'; // Especificar a conexão
    protected $collection = 'players'; // Nome da coleção

    protected $fillable = [
        'tag',
        'name',
        'trophies',
        'wins',
        'losses',
        // Adicione outros campos conforme necessário
    ];
}

