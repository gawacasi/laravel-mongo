<?php

use App\Http\Controllers\ClashRoyaleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PlayerController;

Route::get('/clashroyale/players', [ClashRoyaleController::class, 'getAllPlayers'])->name('all.players');
Route::get('/clashroyale/combo-losses', [ClashRoyaleController::class, 'getComboLosses'])->name('combo.losses');
Route::get('/clashroyale/top-winning-decks', [ClashRoyaleController::class, 'getTopWinningDecks'])->name('top.winning.decks');
Route::get('/clashroyale/card-win-loss-percentage', [ClashRoyaleController::class, 'getCardWinLossPercentage'])->name('card.win.loss.percentage');
Route::get('/clashroyale/specific-victories', [ClashRoyaleController::class, 'getSpecificVictories'])->name('specific.victories');
Route::get('/clashroyale/top-winning-combos', [ClashRoyaleController::class, 'getTopWinningCombos'])->name('top.winning.combos');
Route::get('/clashroyale/player', [ClashRoyaleController::class, 'getPlayer'])->name('get.player');
