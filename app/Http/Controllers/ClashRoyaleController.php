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

        $apiKey = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6Ijc0YWFhNjk5LTc5ZmYtNDJkZC04MzU2LWE0MDAzYWViY2RhNSIsImlhdCI6MTcyODAxNTE1Nywic3ViIjoiZGV2ZWxvcGVyLzJmMmMzMGNmLTk4ZDYtY2Q1YS00ZjMzLTk3MGI2OGZkOGIzMCIsInNjb3BlcyI6WyJyb3lhbGUiXSwibGltaXRzIjpbeyJ0aWVyIjoiZGV2ZWxvcGVyL3NpbHZlciIsInR5cGUiOiJ0aHJvdHRsaW5nIn0seyJjaWRycyI6WyIxNzAuNzkuMTY5LjE2NiJdLCJ0eXBlIjoiY2xpZW50In1dfQ.OqZRLjXMwWMxyORQPw734uYhw07-DpKuirkpVfGDeF-oYHbnP2TiLw_gzOT8k49zIZfr6A166Ia0iPMQo86u6g";
        
        $playerInfo = $service->getPlayerInfo($tag, $apiKey);

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
