<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\TMDbService;
use App\Models\People;

class PeopleController extends Controller
{

    protected $tmdbService;

    public function __construct(TMDbService $tmdbService)
    {
        $this->tmdbService = $tmdbService;
    }

    public function index()
    {
        $people = People::paginate(10);
        return view('admin.people.index', compact('people'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        $people = People::where('name', 'LIKE', '%' . $query . '%')
            ->orWhere('biography', 'LIKE', '%' . $query . '%')
            ->orWhere('id', 'LIKE', '%' . $query . '%')
            ->paginate(10);

        return view('admin.people.people-list', compact('people'))->render();
    }

    public function store(Request $request)
    {
        $request->validate([
            'tmdb_id' => 'required|integer',
        ]);

        $tmdbData = $this->tmdbService->getPersonById($request->tmdb_id);
        if (!$tmdbData || !isset($tmdbData['id'])) {
            return redirect('/admin/people')->with('error', 'Failed to fetch data from TMDB or no valid ID returned!');
        }

        $existingMovie = People::where('id', $request->tmdb_id)->first();

        if (!$tmdbData) {
            return redirect('/admin/people')->with('error', 'Failed to fetch data from TMDB!');
        } elseif ($existingMovie) {
            return redirect('/admin/people')->with('error', 'Person already in database!');
        }

        $movie = People::create([
            'id' => $request->tmdb_id,
            'name' => $tmdbData['name'] ?? null,
            'biography' => $tmdbData['biography'] ?? null,
            'birthday' => $tmdbData['birthday'] ?? null,
            'place_of_birth' => $tmdbData['place_of_birth'] ?? null,
            'deathday' => $tmdbData['deathday'] ?? null,
            'gender' => $tmdbData['gender'] ?? null,
            'profile_path' => "https://image.tmdb.org/t/p/original" . $tmdbData['profile_path'],
            'known_for_department' => $tmdbData['known_for_department'] ?? null
        ]);

        return redirect()->back()->with('success', 'Person added succesfully');
    }

    public function deleteById($id)
    {
        $person = People::findOrFail($id);

        $person->delete();

        return redirect()->back()->with('success', 'Person deleted.');
    }

    public function deleteAll()
    {
        $count = DB::table('people')->count();

        if ($count > 0) {
            DB::table('people')->truncate();
            return redirect()->back()->with('success', 'All person have been deleted.');
        } else {
            return redirect()->back()->with('error', 'There is nothing to delete!');
        }
    }
}
