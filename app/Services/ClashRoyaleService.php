<?php

namespace App\Services;

use GuzzleHttp\Client;
use Exception;

class ClashRoyaleService
{
    protected $client;
    protected $apiUrl;
    protected $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = 'https://api.clashroyale.com/v1/';
        $this->token = env('CLASH_ROYALE_API_TOKEN');
    }

    public function getPlayerInfo($playerTag)
    {
        try {
            $response = $this->client->request('GET', $this->apiUrl . "players/%23" . urlencode($playerTag), [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            return json_decode($response->getBody(), true);

        } catch (Exception $e) {
            return ['error' => 'Erro ao buscar informações do jogador: ' . $e->getMessage()];
        }
    }
}
