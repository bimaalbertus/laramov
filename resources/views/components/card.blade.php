@section('style')
    <style>
        #prev-btn.swiper-button-disabled,
        #next-btn.swiper-button-disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        #prev-btn.swiper-button-disabled,
        #next-btn.swiper-button-disabled:hover {
            background: rgba(0, 0, 0, 0.3);
        }
    </style>
@endsection

<div class="container py-16">
    <div id="swiperCard" class="swiper">
        <div class="flex pb-8">
            <h1 class="font-semibold text-3xl">{{ $title }}</h1>
            <div class="ml-auto text-white text-4xl">
                <button id="prev-btn"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full transition-background duration-200 bg-black/30 hover:bg-black/20"
                    aria-label="previous slide" x-on:click="previous()">
                    <i class="ti ti-chevron-left"></i>
                </button>
                <button id="next-btn"
                    class="inline-flex items-center justify-center w-10 h-10 rounded-full transition-background duration-200 bg-black/30 hover:bg-black/20"
                    aria-label="next slide" x-on:click="next()">
                    <i class="ti ti-chevron-right"></i>
                </button>
            </div>
        </div>
        <div class="swiper-wrapper">
            @foreach ($datas as $data)
                <div class="swiper-slide">
                    <div class="relative group hover:scale-110 transition-transform duration-300">
                        <img src="{{ $data->poster_path }}" alt="{{ $data->title }}"
                            class="w-36 md:w-56 h-auto object-cover rounded-xl">
                        <div
                            class="absolute inset-0 bg-light-bg dark:bg-dark-bg opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col items-center justify-center w-36 md:w-56">
                            <img src="{{ $data->backdrop_path }}" alt="{{ $data->title }}"
                                class="w-96 h-auto object-cover z-10">
                            <div class="gradient-bg absolute bottom-14 text-white text-left p-4 z-20">
                                @if ($data->logo_path)
                                    <img src="{{ $data->logo_path }}" alt="{{ $data->title }}" class="w-20 md:w-24">
                                @else
                                    <span class="font-subjectivity">
                                        {{ Str::limit($data->title, 20) }}
                                    </span>
                                @endif
                                <p class="mt-2">{{ Str::limit($data->overview, 50) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@section('script')
    <script>
        var swiper = new Swiper("#swiperCard", {
            slidesPerView: 5,
            spaceBetween: 30,
            navigation: {
                nextEl: "#next-btn",
                prevEl: "#prev-btn"
            }
        });
    </script>
@endsection
