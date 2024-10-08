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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->integer('season_number');
            $table->string('name')->nullable();
            $table->text('overview')->nullable();
            $table->date('air_date')->nullable();
            $table->integer('episode_count')->nullable();
            $table->string('poster_path')->nullable();
            $table->timestamps();

            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seasons');
    }
};
