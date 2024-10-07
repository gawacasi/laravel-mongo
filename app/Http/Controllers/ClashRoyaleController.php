<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClashRoyaleService;
use App\Models\Player;

class ClashRoyaleController extends Controller
{
    protected $clashRoyaleService;

    public function __construct(ClashRoyaleService $clashRoyaleService)
    {
        $this->clashRoyaleService = $clashRoyaleService;
    }


    public function getPlayer($tag)
    {
        $service = new ClashRoyaleService();
        $playerInfo = $service->getPlayerInfo($tag);

        if (isset($playerInfo['error'])) {
            return view('player.error', ['error' => $playerInfo['error']]);
        }

        Player::updateOrCreate(
            ['tag' => $playerInfo['tag']],
            [
                'name' => $playerInfo['name'],
                'trophies' => $playerInfo['trophies'],
                'wins' => $playerInfo['wins'],
                'losses' => $playerInfo['losses'],

            ]
        );

        return view('player.show', ['player' => $playerInfo]);
    }
}
