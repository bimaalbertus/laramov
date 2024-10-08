<div x-show="showModal" class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div class="fixed inset-0 bg-gray-500 dark:bg-dark-bg dark:bg-opacity-75 bg-opacity-75 transition-opacity"
        @click="showModal = !showModal"></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white dark:bg-dark-bg text-left transition-all sm:my-8 sm:w-full sm:max-w-lg border border-light-primary dark:border-dark-surface shadow-md shadow-black/25 dark:shadow-emerald-500/50">
                <div class="bg-white dark:bg-dark-bg px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                            <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-dark-on-bg"
                                id="modal-title">
                                {{ Str::limit($title, 50) ?? 'Are you sure?' }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 dark:text-gray-300">
                                    {{ Str::limit($body, 50) ?? 'This action cannot be undone.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-dark-surface px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    <button type="button"
                        class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto"
                        @click="document.getElementById('{{ $formId }}').submit(); showModal = !showModal">
                        {{ $confirmText ?? 'Confirm' }}
                    </button>
                    <button type="button"
                        class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto"
                        @click="showModal = !showModal">
                        {{ $cancelText ?? 'Cancel' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
