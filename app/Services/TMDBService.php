<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TMDbService
{
    protected $apiKey;

    protected function buildUrl($endpoint, $tmdbId, $extraPath = '', $language = '')
    {
        return "https://api.themoviedb.org/3/{$endpoint}/{$tmdbId}{$extraPath}?api_key={$this->apiKey}{$language}";
    }

    public function __construct()
    {
        $this->apiKey = env('TMDB_API_KEY');
    }

    public function getMediaById($tmdbId, $category)
    {
        $endpoint = $category === 'movie' ? 'movie' : 'tv';
        $url = $this->buildUrl($endpoint, $tmdbId, '&language=en');

        try {
            $response = Http::get($url);
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Failed to fetch media from TMDB: ' . $e->getMessage());
            return null;
        }
    }

    public function getCreditsById($tmdbId, $category)
    {
        $endpoint = $category === 'movie' ? 'movie' : 'tv';
        $url = $this->buildUrl($endpoint, $tmdbId, '/credits', '&language=en');

        try {
            $response = Http::get($url);
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Failed to fetch media from TMDB: ' . $e->getMessage());
            return null;
        }
    }

    public function getImages($tmdbId, $category)
    {
        $endpoint = $category === 'movie' ? 'movie' : 'tv';
        $url = $this->buildUrl($endpoint, $tmdbId, '/images', '&language=en');

        try {
            $response = Http::get($url);
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Failed to fetch media from TMDB: ' . $e->getMessage());
            return null;
        }
    }

    public function getPersonById($tmdbId)
    {
        $url = "https://api.themoviedb.org/3/person/{$tmdbId}?api_key={$this->apiKey}";

        try {
            $response = Http::get($url);
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Failed to fetch people from TMDB: ' . $e->getMessage());
            return null;
        }
    }
}
