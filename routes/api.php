<?php
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/players', [PlayerController::class, 'index']);
Route::post('/players', [PlayerController::class, 'store']);
Route::get('/players/{id}', [PlayerController::class, 'show']);
Route::put('/players/{id}', [PlayerController::class, 'update']);
Route::delete('/players/{id}', [PlayerController::class, 'destroy']);
Route::post('/players/find', [PlayerController::class, 'findPlayer']);

?>
