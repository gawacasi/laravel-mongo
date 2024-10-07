<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PlayerController extends Controller
{
        public function show($tag)
    {

        $client = new Client();
        $apiKey = env('CLASH_ROYALE_API_TOKEN');
        $url = "https://api.clashroyale.com/v1/players/%23" . urlencode($tag);

        try {
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Bearer {$apiKey}",
                ],
            ]);

            $playerData = json_decode($response->getBody());
            
            dd($playerData);

            return view('player.show', compact('playerData'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Player not found or API error'], 404);
        }
    }
}