<?php

namespace App\Services;

use GuzzleHttp\Client;

class TMDbService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function getMediaById($tmdbId, $category)
    {
        $endpoint = $category === 'movie' ? 'movie' : 'tv';
        $url = "https://api.themoviedb.org/3/{$endpoint}/{$tmdbId}?api_key={$this->apiKey}&language=en-US";

        try {
            $response = $this->client->get($url);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return null;
        }
    }
}
