<div>
    <div class="flex justify-between items-center mb-4">
        <h5 class="text-lg font-semibold">New Person</h5>
        <button @click="isOpen = false"
            class="font-2xl flex items-center p-2 hover:bg-slate-400/25 dark:text-white dark:hover:bg-slate-100/25 rounded-md">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form method="POST" action="people/tmdb">
        @csrf
        <div class="mb-8">
            <div class="mb-5">
                <label for="tmdb_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TMDB
                    ID</label>
                <input type="text" name="tmdb_id" id="tmdb_id"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-dark-surface dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                    placeholder="ex: 111" required />
            </div>

            <button type="submit"
                class="mt-4 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Fetch
                Data</button>
        </div>
    </form>
</div>
