<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ClashRoyaleService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('CLASH_ROYALE_API_TOKEN'); 
    }

    public function getPlayer($tag)
    {
        $url = "https://api.clashroyale.com/v1/players/%23" . urlencode($tag);

        try {
            $response = $this->client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Accept' => 'application/json',
                ]
            ]);

            return json_decode($response->getBody(), true);
        } catch (RequestException $e) {
            return [
                'error' => 'Failed to fetch data',
                'message' => $e->getMessage(),
            ];
        }
    }
}
