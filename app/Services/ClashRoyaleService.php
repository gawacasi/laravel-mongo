<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ClashRoyaleService
{
    protected $apiUrl;
    protected $apiToken;

    public function __construct()
    {
        $this->apiUrl = 'https://api.clashroyale.com/v1/';
        $this->apiToken = env('CLASH_ROYALE_API_TOKEN');
    }

    public function getPlayer($tag)
    {
        $response = Http::withToken($this->apiToken) // Usando o token Bearer aqui
            ->get($this->apiUrl . "players/{$tag}");

        return $response->json();
    }
}
