@extends('layouts/layout')
@include('layouts/sidebar')
@section('title', $movie->title)
@include('components.theme-toggle')

@section('content')
    <img src="{{ $movie->backdrop_path }}" alt="bg" class="fixed top-0 left-0 w-full h-full object-cover z-[-1]">
    <section>
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <div x-data="{ posterOpen: false }" class="flex flex-col items-center">
                <div class="relative group md:max-w-60 cursor-pointer">
                    <img src="{{ $movie->poster_path }}" alt="{{ $movie->title }}" class="glass w-full h-auto">
                    <div @click="posterOpen = !posterOpen"
                        class="absolute inset-0 bg-black bg-opacity-50 text-white flex justify-center items-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="text-xl font-semibold mr-2">Expand</span>
                        <i class="ti ti-arrows-maximize text-3xl"></i>
                    </div>
                </div>
                <span class="glass p-2 m-0 w-full text-center">
                    @if ($movie->media_type == 'movie')
                        {{ $movie->formatted_runtime }}
                    @else
                        {{ $movie->number_of_seasons . ' Season' . ($movie->number_of_seasons > 1 ? 's' : '') }}
                    @endif
                </span>
                <x-modal open="posterOpen" closeIcon="hidden">
                    <div class="flex flex-col md:flex-row bg-white dark:bg-dark-on-primary">
                        <img id="image-poster" src="{{ $movie->poster_path }}" alt="{{ $movie->title }}"
                            class="glass w-64 md:w-96" />
                        <div class="flex flex-col justify-center p-8 w-64 md:w-96">
                            <i class="ti ti-x cursor-pointer text-2xl absolute right-4 top-4"
                                @click="posterOpen = !posterOpen"></i>
                            <h1 class="font-semibold text-3xl">{{ $movie->title }}</h1>
                            <span class="font-light text-xs mt-8">Size:</span>
                            <span id="image-size"></span>
                        </div>
                    </div>
                </x-modal>
            </div>
            <div class="max-w-3xl">
                <div class="flex gap-4 py-8">
                    @foreach ($movie->genres as $genre)
                        <span class="glass py-2 px-5 rounded-full">{{ $genre->name }}</span>
                    @endforeach
                </div>
                <span class="text-5xl font-semibold">
                    {{ $movie->title }}
                    <span class="text-3xl">({{ \Carbon\Carbon::parse($movie->release_date)->format('Y') }})</span>
                </span>
                <p class="mt-4">{{ $movie->overview }}</p>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const image = document.getElementById('image-poster');
        const imageSize = document.getElementById('image-size');

        image.onload = function() {
            const width = image.naturalWidth;
            const height = image.naturalHeight;

            imageSize.innerHTML = `${width}x${height}`;
        };

        if (image.complete) {
            image.onload();
        }
    </script>
@endsection
