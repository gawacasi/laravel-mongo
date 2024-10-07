<?php

use App\Http\Controllers\ClashRoyaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PlayerController;

Route::get('/clashroyale/player/{tag}', [ClashRoyaleController::class, 'getPlayer']);
Route::get('/player/{tag}', [PlayerController::class, 'show']);