@section('style')
    <style>
        input[type="date"]::-webkit-inner-spin-button,
        input[type="date"]::-webkit-calendar-picker-indicator {
            display: none;
            -webkit-appearance: none;
        }
    </style>
@endsection

<div class="relative z-40 overflow-auto">
    <div
        class="relative bg-light-on-primary dark:bg-dark-on-primary rounded-lg max-w-5xl w-full overflow-x-hidden overflow-y-scroll max-h-[40rem] h-screen shadow-xl scrollbar-hide">
        {{-- Modal Title --}}
        <div class="relative">
            <img class="w-full"
                src="{{ $item->backdrop_path ?? 'https://placehold.co/1280x720?text=No+Image+Available' }}"
                alt="{{ $item->title }}">
            <div
                class="absolute inset-0 bg-gradient-to-t from-light-on-primary dark:from-dark-on-primary to-transparent">
            </div>
            <div x-data="{ showModal: false }" class="absolute bottom-20 left-0 flex items-center gap-8 py-8 px-16">
                @if ($item->logo_path)
                    <img src="{{ 'https://image.tmdb.org/t/p/original' . $item->logo_path }}" alt="{{ $item->title }}"
                        class="w-64">
                @else
                    <h1
                        class="{{ strlen($item->title) > 50 ? 'text-xl md:text-4xl' : 'text-2xl md:text-4xl' }} font-bold uppercase font-subjectivity md:mb-8">
                        {{ $item->title }}
                    </h1>
                @endif

                <form id="delete-form-{{ $item->id }}" action="media/{{ $item->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="text-white border border-gray-600 rounded-full bg-black/30 w-12 h-12"
                        @click="showModal = !showModal">
                        <i class="ti ti-trash"></i>
                    </button>

                    <x-popup-modal :formId="'delete-form-' . $item->id" title="Delete {{ $item->title }}"
                        body="Are you sure you want to delete {{ $item->title }}?" confirmText="Yes, Delete"
                        cancelText="Cancel" />
                </form>
            </div>
        </div>

        {{-- Modal Body --}}
        <form method="POST" action="media/{{ $item->id }}" class="relative -top-32 py-8 px-16 flex gap-8">
            @csrf
            @method('PUT')
            <div x-data>
                <button type="submit"
                    class="bg-black/30 dark:bg-white text-white dark:text-black font-bold py-2 px-4 rounded flex items-center mb-4"><i
                        class="ti ti-device-floppy"></i> Save Changes</button>
                <div class="flex items-center space-x-2 mb-4">
                    <span class="text-green-500 font-bold">
                        @if ($item->media_type == 'movie')
                            <div class="flex items-center">
                                <input type="number" name="runtime" value="{{ $item->runtime }}"
                                    class="bg-transparent text-green-500 font-bold"
                                    style="width: {{ strlen($item->runtime) + 1 }}ch;" x-ref="runtime" />
                                <span class="mr-3">minutes</span>
                                <label @click="$refs.runtime.focus()">
                                    <i
                                        class="ti ti-pencil text-light-on-bg dark:text-white text-2xl cursor-pointer mr-3"></i>
                                </label>
                            </div>
                        @else
                            <div class="flex items-center">
                                <input type="number" name="number_of_seasons" value="{{ $item->number_of_seasons }}"
                                    class="bg-transparent text-green-500 font-bold"
                                    style="width: {{ strlen($item->number_of_seasons) + 3 }}ch;" x-ref="seasons" />
                                <span class="mr-3">{{ ' Season' . ($item->number_of_seasons > 1 ? 's' : '') }}</span>
                                <label @click="$refs.seasons.focus()">
                                    <i
                                        class="ti ti-pencil text-light-on-bg dark:text-white text-2xl cursor-pointer mr-3"></i>
                                </label>
                            </div>
                        @endif
                    </span>

                    <div x-data="{
                        formattedDate: '{{ \Carbon\Carbon::parse($item->release_date)->format('Y-m-d') }}',
                        updateDate(event) {
                            const date = new Date(event.target.value);
                            this.formattedDate = date.toISOString().split('T')[0];
                        }
                    }">
                        <input type="date" name="release_date" x-model="formattedDate" @input="updateDate($event)"
                            class="bg-transparent font-semibold" x-ref="date" :value="formattedDate" />
                        <label @click="$refs.date.focus()">
                            <i class="ti ti-pencil text-light-on-bg dark:text-white text-2xl cursor-pointer mr-3"></i>
                        </label>
                    </div>

                    <div class="flex items-center gap-4">
                        <input type="text" name="language" value="{{ $item->language }}"
                            class="bg-transparent text-center border uppercase border-gray-600 text-xs px-1"
                            size="{{ strlen($item->language) }}" x-ref="language" />
                        <label @click="$refs.language.focus()">
                            <i class="ti ti-pencil text-light-on-bg dark:text-white text-2xl cursor-pointer mr-3"></i>
                        </label>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <textarea name="overview" class="bg-transparent w-full max-w-4xl box-border" cols="{{ strlen($item->overview) }}"
                        rows="5" x-ref="overview">{{ $item->overview }}</textarea>
                    <label @click="$refs.overview.focus()">
                        <i class="ti ti-pencil text-light-on-bg dark:text-white text-2xl cursor-pointer mr-3"></i>
                    </label>

                    <div>
                        <div class="mb-2 text-end">
                            <span class="text-gray-400">Cast:</span>
                            <span class="underline">Vanja Rukavina, Denise Rebergen, Rogier Schippers, Derek de Lint,
                                Sergio
                                Hasselbaink,
                                more</span>
                        </div>
                        <div class="mb-2 text-end">
                            <span class="text-gray-400">Genres:</span>
                            <span class="underline">
                                {{ $item->genres->pluck('name')->join(', ') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>
