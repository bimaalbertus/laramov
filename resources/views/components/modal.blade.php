<div x-show="{{ $open ?? 'isOpen' }}" class="fixed inset-0 z-[30] flex items-center justify-center">
    <div x-show="{{ $open ?? 'isOpen' }}"
        class="fixed inset-0 bg-gray-500 dark:bg-dark-bg dark:bg-opacity-75 bg-opacity-75"
        @click="{{ $open ?? 'isOpen' }} = !{{ $open ?? 'isOpen' }}"></div>

    <i class="ti ti-x cursor-pointer text-5xl absolute right-4 top-24 {{ $closeIcon }}"
        @click="{{ $open ?? 'isOpen' }} = !{{ $open ?? 'isOpen' }}"></i>

    <div x-show="{{ $open ?? 'isOpen' }}" x-transition:enter="transition duration-200 transform ease-out"
        x-transition:enter="transition duration-75 ease-linear transform" x-transition:enter-start="scale-90 opacity-0"
        x-transition:enter-end="scale-100 opacity-100" x-transition:leave="transition duration-50 ease-linear transform"
        x-transition:leave-start="scale-100 opacity-100" x-transition:leave-end="scale-90 opacity-0"
        class="relative z-[40]">
        {{ $slot }}
    </div>
</div>
