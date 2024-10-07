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

    public function getComboLosses($combo, $startTimestamp, $endTimestamp)
    {
        $result = Player::raw(function ($collection) use ($combo, $startTimestamp, $endTimestamp) {
            return $collection->aggregate([
                ['$unwind' => '$cards'],
                ['$match' => [
                    'timestamp' => [
                        '$gte' => new \MongoDB\BSON\UTCDateTime(strtotime($startTimestamp) * 1000),
                        '$lte' => new \MongoDB\BSON\UTCDateTime(strtotime($endTimestamp) * 1000)
                    ],
                    'cards.name' => ['$in' => $combo],
                    'result' => 'loss'
                ]],
                ['$group' => [
                    '_id' => null,
                    'total_losses' => ['$sum' => 1]
                ]]
            ]);
        });

        return response()->json($result);
    }

    public function getTopWinningDecks($winPercentage, $startTimestamp, $endTimestamp)
    {
        $result = Player::raw(function ($collection) use ($winPercentage, $startTimestamp, $endTimestamp) {
            return $collection->aggregate([
                ['$unwind' => '$cards'],
                ['$match' => [
                    'timestamp' => [
                        '$gte' => new \MongoDB\BSON\UTCDateTime(strtotime($startTimestamp) * 1000),
                        '$lte' => new \MongoDB\BSON\UTCDateTime(strtotime($endTimestamp) * 1000)
                    ]
                ]],
                ['$group' => [
                    '_id' => '$deck', // Agrupa pelo deck completo
                    'total_matches' => ['$sum' => 1],
                    'wins' => ['$sum' => ['$cond' => ['$eq' => ['$result', 'win'], 1, 0]]],
                ]],
                ['$project' => [
                    'win_percentage' => ['$multiply' => [['$divide' => ['$wins', '$total_matches']], 100]],
                    'deck' => '$_id'
                ]],
                ['$match' => [
                    'win_percentage' => ['$gte' => (int)$winPercentage]
                ]],
                ['$sort' => ['win_percentage' => -1]]
            ]);
        });

        return response()->json($result);
    }

    public function getCardWinLossPercentage($cardName, $startTimestamp, $endTimestamp)
    {
        $result = Player::raw(function ($collection) use ($cardName, $startTimestamp, $endTimestamp) {
            return $collection->aggregate([
                ['$unwind' => '$cards'],
                ['$match' => [
                    'cards.name' => $cardName,
                    'timestamp' => [
                        '$gte' => new \MongoDB\BSON\UTCDateTime(strtotime($startTimestamp) * 1000),
                        '$lte' => new \MongoDB\BSON\UTCDateTime(strtotime($endTimestamp) * 1000)
                    ]
                ]],
                ['$group' => [
                    '_id' => null,
                    'total_matches' => ['$sum' => 1],
                    'wins' => ['$sum' => ['$cond' => ['$eq' => ['$result', 'win'], 1, 0]]],
                    'losses' => ['$sum' => ['$cond' => ['$eq' => ['$result', 'loss'], 1, 0]]]
                ]],
                ['$project' => [
                    'win_percentage' => ['$multiply' => [['$divide' => ['$wins', '$total_matches']], 100]],
                    'loss_percentage' => ['$multiply' => [['$divide' => ['$losses', '$total_matches']], 100]],
                ]]
            ]);
        });

        return response()->json($result);
    }

    public function getSpecificVictories($cardName, $trophyDifference, $startTimestamp, $endTimestamp)
    {
        $result = Player::raw(function ($collection) use ($cardName, $trophyDifference, $startTimestamp, $endTimestamp) {
            return $collection->aggregate([
                ['$unwind' => '$cards'],
                ['$match' => [
                    'cards.name' => $cardName,
                    'timestamp' => [
                        '$gte' => new \MongoDB\BSON\UTCDateTime(strtotime($startTimestamp) * 1000),
                        '$lte' => new \MongoDB\BSON\UTCDateTime(strtotime($endTimestamp) * 1000)
                    ],
                    'result' => 'win',
                    'match_duration' => ['$lt' => 120], // Partidas com menos de 2 minutos
                    'trophies' => ['$lt' => ['$subtract' => ['$opponent_trophies', $trophyDifference]]],
                    'opponent_towers_destroyed' => ['$gte' => 2] // Perdedor destruiu 2 torres
                ]],
                ['$group' => [
                    '_id' => null,
                    'total_victories' => ['$sum' => 1]
                ]]
            ]);
        });

        return response()->json($result);
    }

    public function getTopWinningCombos($comboSize, $winPercentage, $startTimestamp, $endTimestamp)
    {
        $result = Player::raw(function ($collection) use ($comboSize, $winPercentage, $startTimestamp, $endTimestamp) {
            return $collection->aggregate([
                ['$unwind' => '$cards'],
                ['$match' => [
                    'timestamp' => [
                        '$gte' => new \MongoDB\BSON\UTCDateTime(strtotime($startTimestamp) * 1000),
                        '$lte' => new \MongoDB\BSON\UTCDateTime(strtotime($endTimestamp) * 1000)
                    ]
                ]],
                ['$group' => [
                    '_id' => '$deck', // Agrupa pelo deck
                    'total_matches' => ['$sum' => 1],
                    'wins' => ['$sum' => ['$cond' => ['$eq' => ['$result', 'win'], 1, 0]]],
                    'combo' => ['$push' => '$cards.name'] // Combina as cartas
                ]],
                ['$match' => [
                    'win_percentage' => ['$gte' => (int)$winPercentage],
                    '$expr' => ['$eq' => ['$size' => '$combo', (int)$comboSize]] // Verifica o tamanho do combo
                ]],
                ['$sort' => ['win_percentage' => -1]]
            ]);
        });
    
        return response()->json($result);
    }
    
    public function getPlayer($tag)
    {
        $playerData = $this->clashRoyaleService->getPlayer($tag);

        if (isset($playerData['error'])) {
            return response()->json($playerData, 500);
        }

        $player = Player::updateOrCreate(
            ['tag' => $tag],
            [
                'name' => $playerData['name'],
                'trophies' => $playerData['trophies'],
                'wins' => $playerData['wins'],
                'losses' => $playerData['losses']
            ]
        );

        if (isset($playerData['cards'])) {
            $cards = [];
            foreach ($playerData['cards'] as $cardData) {
                $cards[] = [
                    'name' => $cardData['name'],
                    'level' => $cardData['level'],
                    'used' => $cardData['count'] ?? 0,
                    'wins' => $cardData['wins'] ?? 0,
                    'losses' => $cardData['losses'] ?? 0
                ];
            }

            $player->cards = $cards;
            $player->save();
        }

        return response()->json($player);
    }
}
