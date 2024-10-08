<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('overview')->nullable();
            $table->date('release_date')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->string('logo_path')->nullable();
            $table->integer('runtime')->nullable();
            $table->string('language')->nullable();
            $table->string('trailer_path')->nullable();
            $table->string('media_type')->default("movie");
            $table->integer('number_of_seasons')->nullable();
            $table->integer('number_of_episodes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
