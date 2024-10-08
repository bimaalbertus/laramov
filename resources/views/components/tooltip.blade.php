@php
    $tooltipPositionClasses = [
        'top' => 'bottom-full mb-2',
        'bottom' => 'top-full mt-2',
        'left' => 'right-full mr-2',
        'right' => 'left-full ml-2',
    ];
@endphp

<div class="relative group {{ $class }}" x-data="{ tooltip: false }" @mouseover="tooltip = true"
    @mouseleave="tooltip = false">
    <button class="{{ $buttonClass }}">
        {{ $slot }}
    </button>

    <!-- Tooltip Content -->
    <div class="absolute {{ $tooltipPositionClasses[$position] }} w-32 px-2 py-1 bg-gray-800 text-white text-center rounded-md"
        x-show="tooltip" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2" style="display: none;">
        {{ $text }}
    </div>
</div>
