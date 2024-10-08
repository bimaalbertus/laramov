@if ($media->count() === 0)
    <div class="flex flex-col items-center justify-center pt-24">
        <div class="text-center">
            <div class="flex justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-database">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 6m-8 0a8 3 0 1 0 16 0a8 3 0 1 0 -16 0" />
                    <path d="M4 6v6a8 3 0 0 0 16 0v-6" />
                    <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-search w-16 h-16 -ml-8 mt-12">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                    <path d="M21 21l-6 -6" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-200 mb-4">No Data Found</h1>
            <p class="text-xl text-gray-600 dark:text-gray-500 mb-8">We couldn't find any data.</p>
        </div>
    </div>
@else
    <div class="py-8">
        <table border="1" class="min-w-full divide-y divide-gray-200">
            <thead class="text-xs bg-light-surface dark:bg-dark-surface text-gray-700 uppercase dark:text-gray-300">
                <tr>
                    <th class="px-6 py-3">
                        <input id="checked-checkbox" type="checkbox" value=""
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    </th>
                    <th class="px-6 py-3">Title</th>
                    <th class="px-6 py-3">Media Type</th>
                    <th class="px-6 py-3">Release Date</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($media as $item)
                    <tr x-data="{ openModal: false }"
                        class="hover:bg-gray-50 dark:hover:bg-dark-surface transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input id="checked-checkbox" type="checkbox" value=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </td>
                        <td class="px-6 py-4">
                            <div @click="openModal = !openModal" class="flex items-center gap-4">
                                <img src="{{ $item->poster_path }}" alt="{{ $item->title }}" class="w-40">
                                <div class="flex-col">
                                    <p class="font-semibold text-light-on-bg dark:text-dark-on-bg">{{ $item->title }}
                                    </p>
                                    <span class="text-gray-500 dark:text-gray-300">ID: {{ $item->id }}</span>
                                </div>
                            </div>

                            <x-modal open="openModal">
                                @include('admin.media.detail-modal', ['item' => $item])
                            </x-modal>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap uppercase">
                            @if ($item->media_type == 'movie')
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $item->media_type }}
                                </span>
                            @else
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $item->media_type }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->release_date)->format('d F Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div x-data="{
                                isOpen: false,
                                toggleModal() {
                                    this.isOpen = !this.isOpen;
                                    document.body.classList.toggle('overflow-y-hidden', this.isOpen);
                                }
                            }" class="relative flex gap-1">
                                <div x-show="isOpen" x-transition.opacity.duration.100ms
                                    class="fixed inset-0 bg-black bg-opacity-50 z-40" @click="toggleModal()">
                                </div>
                                <button type="button" @click="toggleModal()"
                                    class="py-1 px-4 hover:bg-light-surface dark:hover:bg-dark-surface text-gray-700 dark:text-dark-on-bg font-medium rounded-lg text-sm"><i
                                        class="ti ti-edit mr-2"></i>Edit</button>
                                <div x-show="isOpen" x-transition:enter="transition ease-out duration-50"
                                    x-transition:enter-start="opacity-0 transform translate-x-full"
                                    x-transition:enter-end="opacity-100 transform translate-x-0"
                                    x-transition:leave="transition ease-in duration-50"
                                    x-transition:leave-start="opacity-100 transform translate-x-0"
                                    x-transition:leave-end="opacity-0 transform translate-x-full"
                                    class="z-50 fixed inset-y-0 right-0 w-96 bg-light-bg dark:bg-dark-bg shadow-lg p-6 overflow-y-auto">
                                    @include('admin.media.crud.update', ['media' => $item])
                                </div>
                                <form x-data="{ showModal: false }" id="delete-form-{{ $item->id }}"
                                    action="media/{{ $item->id }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="flex items-center py-1 px-4 rounded-lg hover:bg-light-surface dark:hover:bg-dark-surface text-light-error dark:text-red-500 font-medium text-sm"
                                        @click="showModal = !showModal">
                                        <i class="ti ti-trash mr-2"></i>
                                        Delete
                                    </button>

                                    <x-popup-modal :formId="'delete-form-' . $item->id" title="Delete {{ $item->title }}"
                                        body="Are you sure you want to delete {{ $item->title }}?"
                                        confirmText="Yes, Delete" cancelText="Cancel" />
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-8">
        {{ $media->links('pagination.paginator') }}
    </div>

@endif
