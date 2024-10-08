<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $table;
    protected $fillable = [
        "id",
        'name',
        'biography',
        'birthday',
        'deathday',
        'gender',
        'place_of_birth',
        'profile_path',
        'known_for_department'
    ];
}
