@if ($people->count() === 0)
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
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Birthday</th>
                    <th class="px-6 py-3">Place of Birth</th>
                    <th class="px-6 py-3">Known For Departement</th>
                    <th class="px-6 py-3">Gender</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($people as $item)
                    <tr x-data="{ openModal: false }"
                        class="hover:bg-gray-50 dark:hover:bg-dark-surface transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input id="checked-checkbox" type="checkbox" value=""
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $item->profile_path }}" alt="{{ $item->name }}"
                                    class="w-20 h-20 object-cover rounded-full">
                                <div class="flex-col">
                                    <p class="font-semibold text-light-on-bg dark:text-dark-on-bg">{{ $item->name }}
                                    </p>
                                    <span class="text-gray-500 dark:text-gray-300">ID: {{ $item->id }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($item->birthday)->format('d F Y') }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $item->place_of_birth }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $item->known_for_department }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($item->gender == 1)
                                Female
                            @else
                                Male
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form x-data="{ showModal: false }" id="delete-form-{{ $item->id }}"
                                action="people/{{ $item->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button"
                                    class="flex items-center py-1 px-4 rounded-lg hover:bg-light-surface dark:hover:bg-dark-surface text-light-error dark:text-red-500 font-medium text-sm"
                                    @click="showModal = !showModal">
                                    <i class="ti ti-trash mr-2"></i>
                                    Delete
                                </button>

                                <x-popup-modal :formId="'delete-form-' . $item->id" title="Delete {{ $item->name }}"
                                    body="Are you sure you want to delete {{ $item->name }}?"
                                    confirmText="Yes, Delete" cancelText="Cancel" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="m-8">
        {{ $people->links('pagination.paginator') }}
    </div>

@endif
