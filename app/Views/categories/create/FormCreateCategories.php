<form id="createCategoriesForm" method="POST">
    <?= csrf_field() ?>

    <div class="px-4 py-3 bg-white rounded-lg shadow-md  dark:bg-gray-800">
        <div class="flex flex-col space-y-2 mb-8">
            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Nama Kategori</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                            border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                            focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                            dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                            dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Peralatan..." type="text"
                    name="name" />

                <span id="name-error" class="error-message text-xs text-red-600 dark:text-red-400"></span>
            </label>

            <label class="block text-sm">
                <span class="text-gray-700 dark:text-gray-400">Deskripsi Kategori</span>

                <textarea class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                      border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                      focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                    dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                    dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Kategori ini untuk...."
                    name="description"></textarea>

                <span id="description-error" class="error-message text-xs text-red-600 dark:text-red-400"></span>
            </label>
        </div>

        <button
            class="submit-button block w-full px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            type="submit">
            Tambah
        </button>
    </div>
</form>