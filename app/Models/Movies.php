<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    use HasFactory;

    protected $table;
    protected $fillable = ["id", "title", "overview", "release_date", "poster_path", "backdrop_path", "runtime", "language", 'number_of_seasons', 'number_of_episodes', 'mediaType', "trailer_path"];

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_movies', 'movie_id', 'genre_id');
    }
}
