<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ClashRoyaleService;

class ClashRoyaleController extends Controller
{
    protected $clashRoyaleService;

    public function __construct(ClashRoyaleService $clashRoyaleService)
    {
        $this->clashRoyaleService = $clashRoyaleService;
    }

    public function getPlayer($tag)
    {
        $playerData = $this->clashRoyaleService->getPlayer($tag);

        if (isset($playerData['error'])) {
            return response()->json($playerData, 500);
        }

        // Player::updateOrCreate(['tag' => $tag], $playerData);

        return response()->json($playerData);
    }
}
