<?php

namespace App\Http\Controllers;

use App\Models\Movies;
use App\Models\Season;
use App\Models\Episode;
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

    public function insert()
    {
        $movie = [
            'title' => request('title'),
            'overview' => request('overview'),
            'release_date' => request('release_date'),
            'poster_path' => request('poster_path'),
            'backdrop_path' => request('backdrop_path'),
            'logo_path' => request('logo_path'),
            'trailer_path' => request('trailer_path'),
            'runtime' => request('runtime'),
            'language' => request('language'),
            'number_of_seasons' => request('number_of_seasons'),
            'number_of_episodes' => request('number_of_episodes'),
            'media_type' => request('media_type'),
        ];

        if (request('id')) {
            $movie['id'] = request('id');
        }

        Movies::create($movie);

        return redirect()->back()->with('success', 'Media added successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tmdb_id' => 'required|integer',
            'media_type' => 'required|in:movie,tv'
        ]);

        $tmdbData = $this->tmdbService->getMediaById($request->tmdb_id, $request->media_type);
        if (!$tmdbData || !isset($tmdbData['id'])) {
            return redirect('/admin/media')->with('error', 'Failed to fetch data from TMDB or no valid ID returned!');
        }

        $existingMovie = Movies::where('id', $request->tmdb_id)->where('media_type', $request->media_type)->first();
        $images = $this->tmdbService->getImages($request->tmdb_id, $request->media_type);
        $logoPath = isset($images['logos'][0]['file_path']) ? 'https://image.tmdb.org/t/p/original' . $images['logos'][0]['file_path'] : null;

        if (!$tmdbData) {
            return redirect('/admin/media')->with('error', 'Failed to fetch data from TMDB!');
        } elseif ($existingMovie) {
            return redirect('/admin/media')->with('error', 'Media already in database!');
        }

        $movie = Movies::create([
            'id' => $tmdbData['id'],
            'title' => $tmdbData['original_title'] ?? $tmdbData['original_name'],
            'overview' => $tmdbData['overview'] ?? null,
            'release_date' => $tmdbData['release_date'] ?? $tmdbData['first_air_date'],
            'logo_path' => $logoPath,
            'poster_path' => "https://image.tmdb.org/t/p/original" . $tmdbData['poster_path'],
            'backdrop_path' => "https://image.tmdb.org/t/p/original" . $tmdbData['backdrop_path'],
            'runtime' => $request->media_type === 'movie' ? $tmdbData['runtime'] : null,
            'language' => $tmdbData['original_language'],
            'number_of_seasons' => $request->media_type === 'tv' ? $tmdbData['number_of_seasons'] : null,
            'number_of_episodes' => $request->media_type === 'tv' ? $tmdbData['number_of_episodes'] : null,
            'media_type' => $request->media_type
        ]);

        if (isset($tmdbData['genres'])) {
            foreach ($tmdbData['genres'] as $genreData) {
                $genre = Genre::firstOrCreate(['name' => $genreData['name']]);

                $movie->genres()->attach($genre->id);
            }
        }

        if ($request->media_type === 'tv' && isset($tmdbData['seasons'])) {
            foreach ($tmdbData['seasons'] as $seasonData) {
                $season = Season::create([
                    'movie_id' => $movie->id,
                    'id' => $seasonData['id'],
                    'season_number' => $seasonData['season_number'],
                    'name' => $seasonData['name'] ?? null,
                    'overview' => $seasonData['overview'] ?? null,
                    'air_date' => $seasonData['air_date'] ?? null,
                    'episode_count' => $seasonData['episode_count'] ?? null,
                    'poster_path' => isset($seasonData['poster_path']) ? "https://image.tmdb.org/t/p/original" . $seasonData['poster_path'] : null,
                ]);

                if (isset($seasonData['episodes'])) {
                    foreach ($seasonData['episodes'] as $episodeData) {
                        Episode::create([
                            'season_id' => $season->id,
                            'id' => $episodeData['id'],
                            'episode_number' => $episodeData['episode_number'],
                            'name' => $episodeData['name'] ?? null,
                            'overview' => $episodeData['overview'] ?? null,
                            'air_date' => $episodeData['air_date'] ?? null,
                            'runtime' => $episodeData['runtime'] ?? null,
                            'still_path' => isset($episodeData['still_path']) ? "https://image.tmdb.org/t/p/original" . $episodeData['still_path'] : null,
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('success', 'Success to fetch data from TMDB.');
    }

    public function index()
    {
        $media = Movies::with('seasons.episodes')->paginate(10);

        return view('admin.media.index', compact('media'));
    }

    public function tv($media_type, $id)
    {
        $series = Movies::where('media_type', $media_type)->where('id', $id)->firstOrFail();

        return view('admin.media.season', compact('series'));
    }

    public function deleteAll()
    {
        $count = DB::table('movies')->count();

        if ($count > 0) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

            DB::table('genre_movies')->truncate();
            DB::table('movies')->truncate();

            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            return redirect()->back()->with('success', 'All media have been deleted.');
        } else {
            return redirect()->back()->with('error', 'There is nothing to delete!');
        }
    }

    public function deleteById($id)
    {
        $movie = Movies::findOrFail($id);

        $movie->delete();

        return redirect()->back()->with('success', 'Media deleted.');
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'nullable|string|max:255',
            'overview' => 'nullable|string',
            'release_date' => 'nullable|date',
            'poster_path' => 'nullable|string',
            'backdrop_path' => 'nullable|string',
            'logo_path' => 'nullable|string',
            'trailer_path' => 'nullable|string',
            'runtime' => 'nullable|integer',
            'language' => 'nullable|string',
            'number_of_seasons' => 'nullable|integer',
            'number_of_episodes' => 'nullable|integer',
            'media_type' => 'nullable|string',
        ]);

        $movie = Movies::findOrFail($id);

        $movie->update($validatedData);

        return redirect('/admin/media')->with('success', 'Media updated successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        $media = Movies::where('title', 'LIKE', '%' . $query . '%')
            ->orWhere('overview', 'LIKE', '%' . $query . '%')
            ->orWhere('id', 'LIKE', '%' . $query . '%')
            ->paginate(10);

        return view('admin.media.media-list', compact('media'))->render();
    }
}
