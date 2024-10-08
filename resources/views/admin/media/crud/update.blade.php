<div>
    <div class="flex justify-between items-center mb-4">
        <h5 class="text-lg font-semibold">Update Movie</h5>
        <button @click="isOpen = false"
            class="font-2xl flex items-center p-2 hover:bg-slate-400/25 dark:text-whitedark:hover:bg-slate-100/25 rounded-md">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form method="POST" action="media/{{ $media->id }}">
        @csrf
        @method('PUT')
        <div>
            <div class="mb-5">
                <label for="id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movie
                    ID</label>
                <input type="text" name="id" id="id"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="ex: 111"readonly value="{{ $media->id }}" />
            </div>
            <div class="mb-5">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movie
                    Title</label>
                <input type="text" name="title" id="title"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="ex: Back to the Future"value="{{ $media->title }}" />
            </div>
            <div class="mb-5">
                <label for="overview" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Movie
                    Description</label>
                <textarea id="overview" name="overview" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Once upon a time..." required>{{ $media->overview }}</textarea>
            </div>
            <div class="relative max-w-sm mb-5" x-data="{ date: '{{ $media->release_date }}' }" x-init="flatpickr($refs.input, {
                dateFormat: 'Y-m-d',
                defaultDate: '{{ $media->release_date }}'
            })">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                    </svg>
                </div>
                <input x-ref="input" type="text" x-model="date" id="release_date" name="release_date"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    value="{{ $media->release_date }}" placeholder="{{ $media->release_date }}">
            </div>
            <div class="mb-5">
                <label for="poster_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Poster
                    Path</label>
                <input type="text" name="poster_path" id="poster_path"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="ex: https://url.com/poster.jpg" value="{{ $media->poster_path }}" />
            </div>
            <div class="mb-5">
                <label for="backdrop_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Backdrop
                    Path</label>
                <input type="text" name="backdrop_path" id="backdrop_path"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="ex: https://url.com/backdrop.jpg" value="{{ $media->backdrop_path }}" />
            </div>
            <div class="mb-5">
                <label for="logo_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Logo
                    Path</label>
                <input type="text" name="logo_path" id="logo_path"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="ex: https://url.com/logo.jpg" value="{{ $media->logo_path }}" />
            </div>
            <div class="mb-5">
                <label for="trailer_path" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Trailer
                    Path</label>
                <input type="text" name="trailer_path" id="trailer_path"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="ex: https://url.com/embed/trailer" value="{{ $media->trailer_path }}" />
            </div>

            <div class="flex gap-4">
                <div class="mb-5">
                    <label for="runtime"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration</label>
                    <input type="number" name="runtime" id="runtime"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="ex: 56"value="{{ $media->runtime }}" />
                </div>
                <div class="mb-5">
                    <label for="language"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Language</label>
                    <input type="text" name="language" id="language"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="ex: en" value="{{ $media->language }}" />
                </div>
            </div>

            @if ($media->media_type === 'tv')
                <div class="flex gap-4">
                    <div class="mb-5">
                        <label for="number_of_seasons"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seasons
                            (optional)</label>
                        <input type="number" name="number_of_seasons" id="number_of_seasons"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="ex: 56" value="{{ $media->number_of_seasons }}" />
                    </div>
                    <div class="mb-5">
                        <label for="number_of_episodes"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Episodes
                            (optional)</label>
                        <input type="number" name="number_of_episodes" id="number_of_episodes"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                            placeholder="ex: en" value="{{ $media->number_of_episodes }}" />
                    </div>
                </div>
            @endif

            <label for="media_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Media
                Type</label>
            <select name="media_type" id="media_type" required
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option value="movie" {{ $media->media_type == 'movie' ? 'selected' : '' }}>Movie</option>
                <option value="tv" {{ $media->media_type == 'tv' ? 'selected' : '' }}>TV Show</option>
            </select>

            <div class="flex">
                <button type="submit"
                    class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update
                    Movie</button>
                <button type="submit" @click="isOpen = false"
                    class="mt-4 text-white bg-dark-surface hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-600 dark:hover:bg-dark-surface focus:outline-none dark:focus:ring-gray-800"><i
                        class="ti ti-x"></i> Cancel</button>
            </div>
        </div>
    </form>
</div>
