<?php

use App\Http\Controllers\ClashRoyaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;


Route::get('/clashroyale', [ClashRoyaleController::class, 'index']);
