@extends('layouts/layout')
@section('title', $movie->title)
@include('components.theme-toggle')

@section('content')
    <img src="{{ $movie->backdrop_path }}" alt="bg" class="fixed top-0 left-0 w-full h-full object-cover z-[-1]">
    <section>
        <div class="flex gap-8">
            <div class="flex flex-col items-center">
                <a href="{{ $movie->poster_path }}">
                    <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="glass w-60" />
                </a>
                <span class="glass p-2 m-0 w-full text-center">{{ $movie->formatted_runtime }}</span>
            </div>
            <div class="max-w-3xl">
                <div class="flex gap-4 py-8">
                    @foreach ($movie->genres as $genre)
                        <span class="glass py-2 px-5 rounded-full">{{ $genre->name }}</span>
                    @endforeach
                </div>
                <span class="text-5xl font-semibold">
                    {{ $movie->title }}
                    <span class="text-3xl">({{ date('Y', strtotime($movie->release_date)) }})</span>
                </span>
                <p class="mt-4">{{ $movie->overview }}</p>
            </div>
        </div>
    </section>
@endsection
