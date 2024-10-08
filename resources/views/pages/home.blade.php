@extends('layouts/layout', ['sidebar' => true])
@include('layouts/sidebar')
@section('title', 'Laramov')

@section('content')
    <div x-data="{
        activeTab: 'movies',
        activeClasses: 'active py-2 px-6',
        inactiveClasses: 'py-2.5 px-3'
    }">
        @include('layouts/navbar')
        <div x-show="activeTab === 'movies'">
            <x-jumbotron title="Featured Movies" :datas="$movies" />
            <x-card title="Featured Movies" :datas="$movies" />
        </div>
        <div x-show="activeTab === 'genres'">Tab Genres Content</div>
        <div x-show="activeTab === 'series'">
            <x-jumbotron title="Featured Series" :datas="$tvs" />
            <x-card title="Featured Series" :datas="$tvs" />
        </div>
    </div>
@endsection
