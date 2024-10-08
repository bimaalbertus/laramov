@if ($paginator->hasPages())
    <div aria-label="Page navigation" class="flex items-center justify-between mt-4">
        <span class="text-md text-dark-on-primary dark:text-gray-400">
            Showing
            <span class="font-semibold text-light-on-bg dark:text-white">{{ $paginator->firstItem() }}</span>
            -
            <span class="font-semibold text-light-on-bg dark:text-white">{{ $paginator->lastItem() }}</span>
            of
            <span class="font-semibold text-light-on-bg dark:text-white">{{ $paginator->total() }}</span>
            Entries
        </span>
        <ul class="inline-flex -space-x-px text-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg dark:bg-dark-surface dark:border-dark-on-primary dark:text-gray-400 cursor-not-allowed">
                        Previous
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-dark-on-primary dark:bg-dark-surface dark:border-dark-on-primary dark:text-gray-400 dark:hover:bg-dark-on-primary dark:hover:text-white">
                        Previous
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span
                            class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-dark-surface dark:border-dark-on-primary dark:text-gray-400">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page"
                                    class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-dark-on-primary dark:bg-dark-on-primary dark:text-white">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-dark-on-primary dark:bg-dark-surface dark:border-dark-on-primary dark:text-gray-400 dark:hover:bg-dark-on-primary dark:hover:text-white">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}"
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-dark-on-primary dark:bg-dark-surface dark:border-dark-on-primary dark:text-gray-400 dark:hover:bg-dark-on-primary dark:hover:text-white">
                        Next
                    </a>
                </li>
            @else
                <li>
                    <span
                        class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg dark:bg-dark-surface dark:border-dark-on-primary dark:text-gray-400 cursor-not-allowed">
                        Next
                    </span>
                </li>
            @endif
        </ul>
    </div>
@endif
