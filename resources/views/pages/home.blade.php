@extends('layouts/layout')
@section('title', 'Laramov')

@section('content')
    <div x-data="{
        activeTab: 'movies',
        activeClasses: 'active py-2 px-6',
        inactiveClasses: 'py-2.5 px-3'
    }">
        @include('layouts/navbar')
        <div x-show="activeTab === 'movies'">
            @include('components.jumbotron')
        </div>
        <div x-show="activeTab === 'genres'">Tab Genres Content</div>
        <div x-show="activeTab === 'series'">Tab TV-Series Content</div>
    </div>
@endsection
