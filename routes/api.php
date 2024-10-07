<?php
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClashRoyaleController;

Route::get('/top-winner', [ClashRoyaleController::class, 'getTopWinner']);
Route::get('/top-loser', [ClashRoyaleController::class, 'getTopLoser']);
Route::get('/most-used-card', [ClashRoyaleController::class, 'getMostUsedCard']);
Route::get('/least-used-card', [ClashRoyaleController::class, 'getLeastUsedCard']);
Route::get('/card-wins/{card}/{start}/{end}', [ClashRoyaleController::class, 'getCardWinLossPercentage']);
Route::get('/top-decks/{winPercentage}/{start}/{end}', [ClashRoyaleController::class, 'getTopWinningDecks']);
Route::get('/combo-losses/{combo}/{start}/{end}', [ClashRoyaleController::class, 'getComboLosses']);
Route::get('/specific-victories/{card}/{trophyDiff}/{start}/{end}', [ClashRoyaleController::class, 'getSpecificVictories']);
Route::get('/top-combos/{comboSize}/{winPercentage}/{start}/{end}', [ClashRoyaleController::class, 'getTopWinningCombos']);

?>
