<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Movies extends Model
{
    use HasFactory;

    protected $table;
    protected $fillable = ["id", "title", "overview", "release_date", "poster_path", "backdrop_path", "runtime", "language", 'number_of_seasons', 'number_of_episodes', 'media_type', "trailer_path", "logo_path"];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movies', 'movie_id', 'genre_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class, 'movie_id');
    }

    public function scopeLatestRelease($query)
    {
        return $query->whereMonth('release_date', Carbon::now()->month)
            ->whereYear('release_date', Carbon::now()->year);
    }
}
