<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Player; // Supondo que você tenha um modelo Player

class ClashRoyaleController extends Controller
{
    public function getPlayer($tag)
    {
        // Substitua a chave pela sua variável de ambiente
        $apiToken = env('CLASH_ROYALE_API_TOKEN');
        $url = "https://api.clashroyale.com/v1/players/{$tag}";

        $response = Http::withToken($apiToken)->get($url);

        if ($response->successful()) {
            $playerData = $response->json();

            // Armazenar o jogador no banco de dados
            Player::updateOrCreate(
                ['tag' => $playerData['tag']], // Usando o 'tag' como identificador único
                [
                    'name' => $playerData['name'],
                    'trophies' => $playerData['trophies'],
                    'wins' => $playerData['wins'],
                    'losses' => $playerData['losses'],
                    // Adicione outros campos conforme necessário
                ]
            );

            return response()->json($playerData);
        } else {
            return response()->json(['error' => 'Player not found'], 404);
        }
    }
}
