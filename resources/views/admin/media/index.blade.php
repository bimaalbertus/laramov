@extends('layouts.admin')
@section('content')
    <div class="relative overflow-x-auto">

        <x-alert type="error" :message="session('error')" id="error-alert" />
        <x-alert type="success" :message="session('success')" id="success-alert" />

        <div class="flex p-10">
            <div x-data="{
                isOpen: false,
                toggleModal() {
                    this.isOpen = !this.isOpen;
                    if (this.isOpen) {
                        document.body.classList.add('overflow-y-hidden');
                    } else {
                        document.body.classList.remove('overflow-y-hidden');
                    }
                }
            }" class="relative">
                <div x-show="isOpen" x-transition.opacity.duration.100ms class="fixed inset-0 bg-black bg-opacity-50 z-40"
                    @click="toggleModal()">
                </div>
                <button @click="toggleModal()"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    <i class="ti ti-plus mr-2"></i>Add New Movie
                </button>
                <div x-show="isOpen" x-transition:enter="transition ease-out duration-50"
                    x-transition:enter-start="opacity-0 transform translate-x-full"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-50"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-full"
                    class="z-50 fixed inset-y-0 right-0 w-96 bg-white dark:bg-slate-800 shadow-lg p-6 overflow-y-auto">
                    @include('admin.media.create')
                </div>
            </div>
            <form action="media" method="POST" onsubmit="return confirm('Are you sure you want to delete all movies?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"><i
                        class="ti ti-trash mr-2"></i>Delete All Movies</button>
            </form>
        </div>

        <table border="1" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-light-on-bg uppercase bg-slate-200 dark:bg-slate-500 dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Actions</th>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Media Type</th>
                    <th class="px-6 py-3">Description</th>
                    <th class="px-6 py-3">Release Date</th>
                    <th class="px-6 py-3">Poster</th>
                    <th class="px-6 py-3">Backdrop</th>
                    <th class="px-6 py-3">Runtime</th>
                    <th class="px-6 py-3">Language</th>
                    <th class="px-6 py-3">Genres</th>
                    <th class="px-6 py-3">Trailer</th>
                    <th class="px-6 py-3">Number of Seasons</th>
                    <th class="px-6 py-3">Number of Episodes</th>
                    <th class="px-6 py-3">created_at</th>
                    <th class="px-6 py-3">updated_at</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($media as $item)
                    <tr
                        class="bg-white hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 dark:text-white border-b text-light-on-bg">
                        <td class="px-6 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 flex flex-row items-center justify-center">
                            <div x-data="{
                                isOpen: false,
                                toggleModal() {
                                    this.isOpen = !this.isOpen;
                                    document.body.classList.toggle('overflow-y-hidden', this.isOpen);
                                }
                            }" class="relative">
                                <div x-show="isOpen" x-transition.opacity.duration.100ms
                                    class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="toggleModal()">
                                </div>
                                <button type="button" @click="toggleModal()"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><i
                                        class="ti ti-edit mr-2"></i>Update</button>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-50"
                                    x-transition:enter-start="opacity-0 transform translate-x-full"
                                    x-transition:enter-end="opacity-100 transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-50"
                                    x-transition:leave-start="opacity-100 transform translate-x-0"
                                    x-transition:leave-end="opacity-0 transform translate-x-full"
                                    class="z-50 fixed inset-y-0 right-0 w-96 bg-white dark:bg-slate-800 shadow-lg p-6 overflow-y-auto">
                                    @include('admin.media.update', ['media' => $item])
                                </div>
                            </div>
                            <form action="media/{{ $item->id }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete {{ $item['title'] }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800"><i
                                        class="ti ti-trash mr-2"></i>Delete</button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            {{ $item->id }}</td>
                        <td class="px-6 py-4">
                            {{ $item->title }}</td>
                        <td class="px-6 py-4">{{ $item->mediaType }}</td>
                        <td class="px-6 py-4">{{ Str::limit($item->overview, 100) }}</td>
                        <td class="px-6 py-4">{{ $item->release_date }}</td>
                        <td class="px-6 py-4">{{ $item->poster_path }}</td>
                        <td class="px-6 py-4">{{ $item->backdrop_path }}</td>
                        <td class="px-6 py-4">{{ $item->runtime }}</td>
                        <td class="px-6 py-4">{{ $item->language }}</td>
                        <td class="px-6 py-4">
                            @foreach ($item->genres as $genre)
                                {{ $genre->name }}
                            @endforeach
                        </td>
                        <td class="px-6 py-4">{{ $item->trailer }}</td>
                        <td class="px-6 py-4">{{ $item->number_of_seasons }}</td>
                        <td class="px-6 py-4">{{ $item->number_of_episodes }}</td>
                        <td class="px-6 py-4">{{ $item->created_at }}</td>
                        <td class="px-6 py-4">{{ $item->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
