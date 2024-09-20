<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\Genre;
use App\Services\TMDbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MediaController extends Controller
{
    protected $tmdbService;

    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function create()
    {
        return view('admin.media.create');
    }

    public function insert()
    {
        Movies::create([
            'id' => request('id'),
            'title' => request('title'),
            'overview' => request('overview'),
            'release_date' => request('release_date'),
            'poster_path' => request('poster_path'),
            'backdrop_path' => request('backdrop_path'),
            'runtime' => request('runtime'),
            'language' => request('language'),
            'number_of_seasons' => request('number_of_seasons'),
            'number_of_episodes' => request('number_of_episodes'),
            'mediaType' => request('mediaType'),
        ]);

        return redirect('/admin/media')->with('success', 'Media added successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tmdb_id' => 'required|integer',
            'mediaType' => 'required|in:movie,tv'
        ]);

        $tmdbData = $this->tmdbService->getMediaById($request->tmdb_id, $request->mediaType);
        $existingMovie = Movies::where('id', $request->tmdb_id)->first();

        if (!$tmdbData) {
            return redirect('/admin/media')->with('error', 'Failed to fetch data from TMDB!');
        } elseif ($existingMovie) {
            return redirect('/admin/media')->with('error', 'Media already in database!');
        }

        $movie = Movies::create([
            'id' => $tmdbData['id'],
            'title' => $tmdbData['title'] ?? $tmdbData['name'],
            'overview' => $tmdbData['overview'] ?? null,
            'release_date' => $tmdbData['release_date'] ?? $tmdbData['first_air_date'],
            'poster_path' => "https://image.tmdb.org/t/p/original" . $tmdbData['poster_path'],
            'backdrop_path' => "https://image.tmdb.org/t/p/original" . $tmdbData['backdrop_path'],
            'runtime' => $request->mediaType === 'movie' ? $tmdbData['runtime'] : null,
            'language' => $tmdbData['original_language'],
            'number_of_seasons' => $request->mediaType === 'tv' ? $tmdbData['number_of_seasons'] : null,
            'number_of_episodes' => $request->mediaType === 'tv' ? $tmdbData['number_of_episodes'] : null,
            'mediaType' => $request->mediaType
        ]);

        if (isset($tmdbData['genres'])) {
            foreach ($tmdbData['genres'] as $genreData) {
                $genre = Genre::firstOrCreate(['name' => $genreData['name']]);

                $movie->genres()->attach($genre->id);
            }
        }

        return redirect('/admin/media')->with('success', 'Success to fetch data from TMDB.');
    }

    public function index()
    {
        $media = Movies::all();
        return view('admin.media.index', compact('media'));
    }

    public function deleteAll()
    {
        DB::table('movies')->delete();

        return redirect()->back()->with('success', 'All media have been deleted.');
    }

    public function deleteById($id)
    {
        $movie = Movies::findOrFail($id);

        $movie->delete();

        return redirect('/admin/media')->with('success', 'Media deleted.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id' => 'required|integer',
            'title' => 'required|string|max:255',
            'overview' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster_path' => 'nullable|string',
            'backdrop_path' => 'nullable|string',
            'runtime' => 'nullable|integer',
            'language' => 'nullable|string',
            'number_of_seasons' => 'nullable|integer',
            'number_of_episodes' => 'nullable|integer',
            'mediaType' => 'nullable|string',
        ]);

        $movie = Movies::findOrFail($id);

        $movie->update([
            'id' => $request->id,
            'title' => $request->title,
            'overview' => $request->overview,
            'release_date' => $request->release_date,
            'poster_path' => $request->poster_path,
            'backdrop_path' => $request->backdrop_path,
            'runtime' => $request->runtime,
            'language' => $request->language,
            'number_of_seasons' => $request->number_of_seasons,
            'number_of_episodes' => $request->number_of_episodes,
            'mediaType' => $request->mediaType,
        ]);

        return redirect('/admin/media')->with('success', 'Media updated successfully.');
    }
}
