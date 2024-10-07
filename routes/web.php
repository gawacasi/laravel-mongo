<?php

use App\Http\Controllers\ClashRoyaleController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);

Route::get('/player/{tag}', [ClashRoyaleController::class, 'getPlayer']);
