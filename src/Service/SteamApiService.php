<?php

namespace App\Service;

use Symfony\Component\HttpClient\HttpClient;

class SteamApiService
{
    private $apiKey;
    private $httpClient;

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = HttpClient::create();
    }

    /**
     * Fetch all informations from Steam API
     */
    public function getPlayerSummary(string $steamId)
    {
        $response = $this->httpClient->request(
            'GET',
            "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key={$this->apiKey}&steamids={$steamId}"
        );
        
        return $response->toArray();
    }
}
