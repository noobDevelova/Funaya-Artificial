<div x-show="isModalConfirmOpen" x-transition:enter="transition ease-out duration-150"
    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
    <div x-show="isModalConfirmOpen" x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform translate-y-1/2" @click.away="closeModalConfirm"
        @keydown.escape="closeModalConfirm"
        class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
        role="dialog" id="modal-confirm">

        <div class="mt-4 mb-6">
            <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300" x-text="modalConfirmData.title">
            </p>

            <p class="text-sm text-gray-700 dark:text-gray-400" x-text="modalConfirmData.description">
            </p>
        </div>

        <footer
            class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">

            <button @click="closeModalConfirm"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                Kembali
            </button>

            <button @click="executeModalConfirmAction" :disabled="isModalConfirmLoading"
                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                :class="{ 'opacity-50 cursor-not-allowed': isModalConfirmLoading }">

                <span x-show="!isModalConfirmLoading">Konfirmasi</span>

                <span x-show="isModalConfirmLoading" class="flex items-center">
                    <svg class="w-4 h-4 animate-spin mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                    </svg>
                    Memproses...
                </span>
            </button>
        </footer>
    </div>
</div>