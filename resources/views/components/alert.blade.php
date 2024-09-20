@props(['type' => 'info', 'message'])

@php
    $colors = [
        'success' => [
            'text' => 'text-green-800',
            'bg' => 'bg-green-50',
            'border' => 'border-green-500',
            'icon' => 'text-green-500',
            'button-bg' => 'bg-green-50',
            'button-text' => 'text-green-500',
            'hover-bg' => 'hover:bg-green-200',
        ],
        'error' => [
            'text' => 'text-red-800',
            'bg' => 'bg-red-50',
            'border' => 'border-red-500',
            'icon' => 'text-red-500',
            'button-bg' => 'bg-red-50',
            'button-text' => 'text-red-500',
            'hover-bg' => 'hover:bg-red-200',
        ],
        'info' => [
            'text' => 'text-blue-800',
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-500',
            'icon' => 'text-blue-500',
            'button-bg' => 'bg-blue-50',
            'button-text' => 'text-blue-500',
            'hover-bg' => 'hover:bg-blue-200',
        ],
        'warning' => [
            'text' => 'text-yellow-800',
            'bg' => 'bg-yellow-50',
            'border' => 'border-yellow-500',
            'icon' => 'text-yellow-500',
            'button-bg' => 'bg-yellow-50',
            'button-text' => 'text-yellow-500',
            'hover-bg' => 'hover:bg-yellow-200',
        ],
        'default' => [
            'text' => 'text-gray-800',
            'bg' => 'bg-gray-50',
            'border' => 'border-gray-500',
            'icon' => 'text-gray-500',
            'button-bg' => 'bg-gray-50',
            'button-text' => 'text-gray-500',
            'hover-bg' => 'hover:bg-gray-200',
        ],
    ];
    $colorClass = $colors[$type] ?? $colors['default'];
@endphp

@if ($message)
    <div x-data="{ isOpen: true }" x-show="isOpen"
        class="fixed right-4 top-24 z-50 flex items-center p-4 {{ $colorClass['text'] }} rounded-lg {{ $colorClass['bg'] }} border {{ $colorClass['border'] }}"
        role="alert">
        <svg class="flex-shrink-0 w-4 h-4 {{ $colorClass['icon'] }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
        </svg>
        <span class="sr-only">{{ ucfirst($type) }}</span>
        <div class="ms-3 text-sm font-medium">
            {{ $message }}
        </div>
        <button type="button" @click="isOpen = false"
            class="ms-auto -mx-1.5 -my-1.5 {{ $colorClass['button-bg'] }} {{ $colorClass['button-text'] }} rounded-lg focus:ring-2 focus:ring-{{ str_replace('bg-', '', $colorClass['bg']) }} p-1.5 {{ $colorClass['hover-bg'] }} inline-flex items-center justify-center h-8 w-8"
            data-dismiss-target="#alert-{{ $type }}" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif
