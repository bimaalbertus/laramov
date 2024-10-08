@extends('layouts.layout')
@section('title', 'Watch ' . $movie->title)

@section('content')
    <div class="group fixed left-0 top-0 w-full h-screen">
        <div class="absolute left-0 top-0 opacity-0 group-hover:opacity-100 transition-opacity duration-300 ease-in-out space-x-4 flex items-center text-white w-full p-4"
            style="background-image: linear-gradient(#000 0%, rgba(0,0,0,0.5) 50%, transparent 100%)">
            <button onclick="window.history.back()" class="font-bold text-4xl">
                <i class="ti ti-arrow-left"></i>
            </button>
            <h1 class="font-medium text-3xl font-figtree">{{ $movie->title }}
                ({{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }})</h1>
        </div>
        <iframe src="{{ $embed }}" frameborder="0" width="100%" height="100%" scrolling="auto"
            class="block w-full h-full">
        </iframe>
    </div>
@endsection
