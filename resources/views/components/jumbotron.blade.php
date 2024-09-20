<div class="glass px-4 rounded-full border border-purple-30 flex gap-4 absolute top-24 right-8 text-5xl z-10">
    <i id="prevSlide" class="ti ti-arrow-left cursor-pointer"></i>
    <i id="nextSlide" class="ti ti-arrow-right cursor-pointer"></i>
</div>

<div id="jumbotronSlider" class="relative overflow-hidden h-screen">
    @foreach ($movies as $index => $movie)
        <div
            class="slider-item {{ $index === 0 ? 'opacity-100' : 'opacity-0' }} transition-opacity duration-700 ease-in-out absolute inset-0">
            <img src="{{ $movie['backdrop_path'] }}" alt="bg"
                class="fixed top-0 left-0 w-full h-full object-cover z-[-1]">
            <div class="flex flex-col items-start pt-40 gap-4">
                <span
                    class="uppercase py-2 px-8 border border-custom-blue-100 rounded-full glass">{{ $movie['mediaType'] }}</span>
                <div class="flex flex-col gap-8 max-w-lg">
                    <span class="text-5xl">{{ $movie['title'] }}</span>
                    <p class="text-custom-white-70">
                        {{ $movie['overview'] }}
                    </p>
                    <div class="flex gap-4">
                        <button
                            class="py-2 px-8 font-euclid-circular-b border-2 border-light-primary rounded-full text-md cursor-pointer glass">
                            <a href="/movie/{{ $movie['id'] }}/watch">Watch
                                Now</a></button>
                        <a href="{{ $movie['mediaType'] }}/{{ $movie['id'] }}"
                            class="flex items-center more py-2 pr-6 px-8 font-euclid-circular-b border-2 border-custom-white-30 rounded-full">
                            <span>More Info</span>
                            <svg width="2rem" height="2rem" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="#e5e5e5" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('jumbotronSlider');
        const slides = slider.querySelectorAll('.slider-item');
        const prevButton = document.getElementById('prevSlide');
        const nextButton = document.getElementById('nextSlide');
        let currentSlide = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                if (i === index) {
                    slide.classList.remove('opacity-0');
                    slide.classList.add('opacity-100');
                } else {
                    slide.classList.remove('opacity-100');
                    slide.classList.add('opacity-0');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function prevSlide() {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        }

        nextButton.addEventListener('click', nextSlide);
        prevButton.addEventListener('click', prevSlide);

        setInterval(nextSlide, 7000);
    });
</script>
