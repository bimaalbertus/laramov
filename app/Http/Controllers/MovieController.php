<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Movies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    private function formatRuntime($runtime)
    {
        $hours = floor($runtime / 60);
        $minutes = $runtime % 60;
        return "{$hours}h {$minutes}m";
    }

    public function index()
    {
        $all = Movies::get();
        $movies = Movies::where('media_type', 'movie')->get();
        $tvs = Movies::where('media_type', 'tv')->get();
        $latest_release = Movies::latestRelease()->get();

        return view('pages/home', compact('all', 'movies', 'tvs', 'latest_release'));
    }

    public function detail($media_type, $id)
    {
        $movie = Movies::where('media_type', $media_type)->where('id', $id)->firstOrFail();
        $movie->formatted_runtime = $this->formatRuntime($movie->runtime);

        return view('pages/detail', compact('movie'));
    }

    public function watch($media_type, $id)
    {
        $movie = Movies::where('media_type', $media_type)->where('id', $id)->firstOrFail();
        $movie->formatted_runtime = $this->formatRuntime($movie->runtime);
        $embed = "https://multiembed.mov/directstream.php?video_id=$id&tmdb=1";

        return view('pages/watch', compact('movie', 'embed'));
    }
}
