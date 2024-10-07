<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player; // Modelo para interagir com a coleção "players"
use Illuminate\Support\Facades\Http; // Para fazer requisições HTTP

class PlayerController extends Controller
{
    public function findPlayer(Request $request)
    {
        $playerName = $request->input('name');

        $response = Http::get("https://api.clashroyale.com/v1/players?name={$playerName}", [
            'Authorization' => 'Bearer ' . env('CLASH_ROYALE_API_KEY'),
        ]);

        if ($response->successful()) {
            $playerData = $response->json();

            // Inserir jogador no banco de dados
            $player = Player::create([
                'id' => $playerData['id'], // Supondo que você tenha um campo 'id'
                'name' => $playerData['name'],
                'trophies' => $playerData['trophies'],
                'wins' => $playerData['wins'],
                'losses' => $playerData['losses'],
                // Adicione outros campos conforme necessário
            ]);

            return response()->json(['message' => 'Player added to database', 'player' => $player], 201);
        }

        return response()->json(['message' => 'Player not found'], 404);
    }
}
