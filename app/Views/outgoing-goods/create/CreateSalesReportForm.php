<form id="createSalesForm" method="POST">
    <?= csrf_field(); ?>

    <div class="w-full flex flex-col space-y-3" id="salesItemsContainer">
        <div class="w-full flex flex-col p-3 bg-white rounded-lg shadow-md dark:bg-gray-800 productRow">
            <div class="flex flex-col flex-1 space-y-3">

                <!-- Pilih Produk -->
                <label class="block text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Produk</span>
                    <select class="product-select block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" name="product_id[]" required>
                        <option value="">Pilih Produk</option>
                        <?php foreach ($products as $product): ?>
                            <option value="<?= $product->id ?>" data-price="<?= $product->price ?>"
                                data-stock="<?= $product->stock ?>">
                                <?= $product->name ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <!-- Harga per Item -->
                <label class="block text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Harga Per Item</span>
                    <input
                        class="price block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500 disabled:opacity-50 disabled:text-gray-500 disabled:cursor-not-allowed"
                        type="number" name="price[]" readonly required disabled />
                </label>

                <label class="block text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Stok Produk Saat Ini</span>
                    <input
                        class="stock block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500 disabled:opacity-50 disabled:text-gray-500 disabled:cursor-not-allowed"
                        type="number" name="stock[]" readonly required disabled />
                </label>

                <!-- Kuantitas Penjualan -->
                <label class="block text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Kuantitas Penjualan</span>

                    <input class="quantity block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" type="number" name="quantity[]" min="1"
                        required />
                </label>

                <!-- Total Harga -->
                <label class="block text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Total Harga</span>
                    <input
                        class="total block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500 disabled:opacity-50 disabled:text-gray-500 disabled:cursor-not-allowed"
                        type="number" name="total[]" readonly required disabled />
                </label>

                <!-- Tombol Hapus -->
                <button type="button" class="remove-product bg-red-600 text-white px-3 py-1 rounded">
                    Hapus Produk
                </button>

            </div>
        </div>
    </div>

    <div class="px-4 py-3 h-fit flex flex-row space-x-2 bg-white rounded-lg shadow-md dark:bg-gray-800 w-full mt-3">
        <button type="button" id="addProductButton"
            class="block w-full px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
            Masukkan Produk Lain
        </button>

        <button type="submit"
            class="submit-button block w-full px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700">
            Buat Laporan
        </button>
    </div>
</form>