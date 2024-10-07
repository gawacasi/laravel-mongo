<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ClashRoyaleController extends Controller
{
    public function index()
    {
        $apiUrl = 'https://api.clashroyale.com/v1/players/YOUR_PLAYER_TAG';
        $apiKey = env('CR_API_KEY');

        $client = new Client();

        try {

            $response = $client->request('GET', $apiUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $apiKey,
                ],
            ]);

            // Retorne os dados da API
            $data = json_decode($response->getBody(), true);
            return view('clashroyale.index', compact('data'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }
    }
}
