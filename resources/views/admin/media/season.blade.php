@extends('layouts.admin')
@section('title', 'Media CRUD')
@section('header-title', 'All products')

@section('content')
    <div class="relative max-w-7xl p-20 overflow-auto">
        <h1 class="text-3xl font-semibold">{{ $series->title }}</h1>
        @if ($series->media_type == 'tv' && $series->seasons->count())
            <table border="1" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead
                    class="text-xs border-b-2 border-light-surface dark:border-dark-surface text-gray-700 uppercase dark:text-gray-300">
                    <tr>
                        <td class="px-6 py-4">Season Name</td>
                        <td class="px-6 py-4">Season Number</td>
                        <td class="px-6 py-4">Season Air Date</td>
                        <td class="px-6 py-4">Description</td>
                        <td class="px-6 py-4">Poster</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($series->seasons as $season)
                        <tr x-data="{ posterOpen: false }"
                            class="hover:bg-light-surface dark:hover:bg-dark-surface dark:text-white border-b text-gray-700">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $season->name }}
                            </td>
                            <td class="px-6 py-4">{{ $season->season_number }}</td>
                            <td class="px-6 py-4">{{ $season->air_date }}</td>
                            <td class="px-6 py-4">{{ Str::limit($season->overview, 100) }}</td>
                            <td class="px-6 py-4">
                                <p @click="posterOpen = !posterOpen" class="underline decoration-solid cursor-pointer">
                                    {{ $season->poster_path }}</p>
                                <x-modal open="posterOpen">
                                    <img class="z-40 w-72 md:w-96 max-w-screen rounded-xl box-shadow-purple"
                                        src="{{ $season->poster_path }}" alt="{{ $season->name }} poster">
                                </x-modal>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>There is nothing to show</p>
        @endif
    </div>
@endsection
