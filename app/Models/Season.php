<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $table = 'seasons';
    protected $fillable = [
        'movie_id',
        'season_number',
        'name',
        'overview',
        'air_date',
        'episode_count',
        'poster_path',
    ];

    public function movie()
    {
        return $this->belongsTo(Movies::class, 'movie_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'season_id');
    }
}
