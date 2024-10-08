<div x-data="{
    currentSlideIndex: 1,
    totalSlides: {{ count($datas) }},
    interval: null,
    previous() {
        if (this.currentSlideIndex > 1) {
            this.currentSlideIndex = this.currentSlideIndex - 1;
        } else {
            this.currentSlideIndex = this.totalSlides;
        }
    },
    next() {
        if (this.currentSlideIndex < this.totalSlides) {
            this.currentSlideIndex = this.currentSlideIndex + 1;
        } else {
            this.currentSlideIndex = 1;
        }
    },
    autoplay() {
        this.interval = setInterval(() => {
            this.next();
        }, 4000);
    },
    stopAutoplay() {
        clearInterval(this.interval);
    },
    startAutoplay() {
        this.autoplay();
    }
}" x-init="autoplay()" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()"
    class="relative w-full min-h-[540px]">

    @foreach ($datas as $index => $data)
        <div x-show="currentSlideIndex == {{ $index + 1 }}"
            x-transition:enter="transition-opacity ease-out duration-500" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-500"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="absolute inset-0 w-full h-full flex items-center justify-center bg-cover bg-center bg-no-repeat rounded-2xl"
            style='background-image: linear-gradient(transparent 0%, rgba(0, 0, 0) 100%), url("{{ $data->backdrop_path ?? 'https://placehold.co/1280x720?text=No+Image+Available' }}");'
            x-cloak>

            <div class="flex flex-col gap-2 absolute left-0 bottom-8 px-8 text-white"
                x-transition:enter="transition-opacity ease-out duration-500" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-500"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

                @if ($data->logo_path)
                    <img src="{{ $data->logo_path }}" alt="{{ $data->title }}" class="w-40 md:w-64 mb-8">
                @else
                    <h1 class="text-2xl md:text-6xl font-bold uppercase font-subjectivity">
                        {{ Str::limit($data->title, 100) }}
                    </h1>
                @endif

                <div class="flex flex-wrap gap-2 font-euclid-circular-b text-sm items-center">
                    <span>{{ \Carbon\Carbon::parse($data->release_date)->format('Y') }}</span>
                    @if ($data->release_date)
                        <span>•</span>
                    @endif
                    <span>{{ $data->genres->pluck('name')->join('/') }}</span>
                    @if (count($data->genres) > 1)
                        <span>•</span>
                    @endif
                    <span>
                        @if ($data->media_type == 'movie')
                            {{ floor($data->runtime / 60) }}h {{ $data->runtime % 60 }}m
                        @else
                            {{ $data->number_of_seasons . ' Season' . ($data->number_of_seasons > 1 ? 's' : '') }}
                        @endif
                    </span>
                    @if (\Carbon\Carbon::parse($data->release_date)->isSameMonth(\Carbon\Carbon::now()))
                        <span>•</span>
                        <div
                            class="flex space-x-2 items-center bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            <span class="flex size-3 items-center justify-center rounded-full bg-white"
                                aria-label="notification">
                                <span class="size-3 animate-ping rounded-full motion-reduce:animate-none bg-white">
                                </span>
                            </span>
                            <span>Now Playing</span>
                        </div>
                    @endif
                </div>

                <x-show-more :text="$data->overview" :limit="200" />

                <div class="flex space-x-4">
                    <a href="{{ $data->media_type }}/{{ $data->id }}/watch">
                        <button type="button"
                            class="cursor-pointer whitespace-nowrap rounded-xl bg-light-primary px-4 py-2 font-figtree text-md font-semibold tracking-wide mt-4 w-32 text-black transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-dark-primary dark:text-black dark:focus-visible:outline-white">Watch
                            Now</button>
                    </a>
                    <a href="{{ $data->media_type }}/{{ $data->id }}">
                        <button type="button"
                            class="cursor-pointer whitespace-nowrap rounded-xl bg-light-primary px-4 py-2 font-figtree text-md font-semibold tracking-wide mt-4 w-32 text-black transition hover:opacity-75 text-center focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 disabled:opacity-75 disabled:cursor-not-allowed dark:bg-dark-primary dark:text-black dark:focus-visible:outline-white">More
                            Details</button>
                    </a>
                </div>
            </div>

        </div>
    @endforeach

    <div class="absolute top-8 md:top-auto md:bottom-8 right-8 text-white text-4xl">
        <button
            class="inline-flex items-center justify-center w-10 h-10 rounded-full transition-background duration-200 bg-black/30 hover:bg-black/20"
            aria-label="previous slide" x-on:click="previous()">
            <i class="ti ti-chevron-left"></i>
        </button>
        <button
            class="inline-flex items-center justify-center w-10 h-10 rounded-full transition-background duration-200 bg-black/30 hover:bg-black/20"
            aria-label="next slide" x-on:click="next()">
            <i class="ti ti-chevron-right"></i>
        </button>
    </div>
</div>
