<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class ClashRoyaleService
{
    protected $client;
    protected $apiUrl;
    protected $token;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = 'https://api.clashroyale.com/v1/';
        $this->token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiIsImtpZCI6IjI4YTMxOGY3LTAwMDAtYTFlYi03ZmExLTJjNzQzM2M2Y2NhNSJ9.eyJpc3MiOiJzdXBlcmNlbGwiLCJhdWQiOiJzdXBlcmNlbGw6Z2FtZWFwaSIsImp0aSI6Ijc0YWFhNjk5LTc5ZmYtNDJkZC04MzU2LWE0MDAzYWViY2RhNSIsImlhdCI6MTcyODAxNTE1Nywic3ViIjoiZGV2ZWxvcGVyLzJmMmMzMGNmLTk4ZDYtY2Q1YS00ZjMzLTk3MGI2OGZkOGIzMCIsInNjb3BlcyI6WyJyb3lhbGUiXSwibGltaXRzIjpbeyJ0aWVyIjoiZGV2ZWxvcGVyL3NpbHZlciIsInR5cGUiOiJ0aHJvdHRsaW5nIn0seyJjaWRycyI6WyIxNzAuNzkuMTY5LjE2NiJdLCJ0eXBlIjoiY2xpZW50In1dfQ.OqZRLjXMwWMxyORQPw734uYhw07-DpKuirkpVfGDeF-oYHbnP2TiLw_gzOT8k49zIZfr6A166Ia0iPMQo86u6g";

        // Log token for debugging (be careful not to expose it in production)
        Log::debug('Clash Royale API Token: ' . $this->token);
    }

    public function getPlayerInfo($playerTag)
    {
        try {
            // Codifica o caractere # como %23 e constrói a URL
            $encodedTag = urlencode($playerTag); // Se passar '#U2LYQJQVY', ele se torna '%23U2LYQJQVY'
            $url = $this->apiUrl . "players/%23" . $encodedTag; // Adiciona o %23 no início

            // Log da URL que está sendo chamada
            Log::debug('Requesting URL: ' . $url);

            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->token,
                ],
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            // Log dos detalhes do erro da requisição
            Log::error('Error fetching player info: ' . $e->getMessage());
            if ($e->hasResponse()) {
                Log::error('Response: ' . $e->getResponse()->getBody());
            }
            return ['error' => 'Erro ao buscar informações do jogador: ' . $e->getMessage()];
        } catch (Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return ['error' => 'Erro ao buscar informações do jogador: ' . $e->getMessage()];
        }
    }
}
