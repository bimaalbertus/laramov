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
        $movies = Movies::get();

        return view('pages/home', compact('movies'));
    }

    public function detail($mediaType, $id)
    {
        $movie = Movies::where('mediaType', $mediaType)->where('id', $id)->firstOrFail();
        $movie->formatted_runtime = $this->formatRuntime($movie->runtime);

        return view('pages/detail', compact('movie'));
    }
}
