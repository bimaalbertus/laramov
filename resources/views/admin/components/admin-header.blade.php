<div class="flex flex-col gap-4 md:w-full">

    <h1 class="text-3xl font-medium">{{ $title }}</h1>

    <div class="flex flex-col md:flex-row items-center md:justify-between gap-4">

        <div class="flex items-center gap-4 w-full">
            <div class="relative w-full md:w-1/2 {{ $search }}">

                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 rounded-lg bg-gray-50 dark:bg-dark-surface dark:placeholder-gray-400 dark:text-white focus:outline-none"
                    placeholder="{{ $placeholder ?? 'search' }}" required />
                <span class="text-gray-500 dark:text-white absolute end-2.5 bottom-2.5 px-4 py-2 text-xs">CTRL+K</span>

            </div>

            <form data-tippy-content="{{ $formTitle }}" x-data="{ showModal: false }" id="{{ $formId }}"
                action="{{ $name }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="button"
                    class="flex items-center p-1.5 rounded-lg hover:bg-light-surface dark:hover:bg-dark-surface text-light-error dark:text-red-500 font-medium text-2xl"
                    @click="showModal = !showModal">
                    <i class="ti ti-trash"></i>
                </button>

                <x-popup-modal formId="{{ $formId }}" title="{{ $formTitle }}" body="{{ $formMessage }}"
                    confirmText="Yes, Delete" cancelText="Cancel" />

            </form>
        </div>

        <div
            class="flex flex-col justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
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
                <div x-show="isOpen" x-transition.opacity.duration.100ms
                    class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="toggleModal()">
                </div>
                <button @click="toggleModal()"
                    class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 capitalize">
                    <i class="ti ti-plus mr-2"></i>Add New {{ $name }}
                </button>
                <div x-show="isOpen" x-transition:enter="transition ease-out duration-50"
                    x-transition:enter-start="opacity-0 transform translate-x-full"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-50"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-full"
                    class="z-50 fixed inset-y-0 right-0 w-80 md:w-96 bg-light-bg dark:bg-dark-bg shadow-lg p-6 overflow-y-auto">
                    @include('admin.' . $name . '.crud.create')
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('keydown', function(event) {
        if (event.ctrlKey && event.key === 'k') {
            event.preventDefault();
            document.getElementById('default-search').focus();
        }
    });
</script>
