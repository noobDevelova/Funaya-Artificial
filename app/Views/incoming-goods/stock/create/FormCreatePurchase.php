<form id="createPurchaseForm" method="POST">
    <?= csrf_field(); ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Pembelian Stok Produk <span class="font-bold"><?= $product->name ?></span>
    </h2>

    <div class="w-full  flex flex-row space-x-3">
        <div class="w-full max-w-[500px] flex flex-row p-3 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div class="relative hidden max-w-[200px] h-full mr-3 rounded-lg md:block">
                <img class="object-cover w-full h-full rounded-lg"
                    src="<?= base_url('uploads/products/' . esc($product->coverImage)) ?>"
                    alt="Image of <?= esc($product->name) ?>" loading="lazy" />
                <div class="absolute inset-0 rounded-lg shadow-inner" aria-hidden="true"></div>
            </div>

            <div class="flex flex-col flex-1 space-y-3">
                <div class="flex flex-row justify-between">
                    <span class="text-gray-700 dark:text-gray-400">Kategori</span>

                    <span
                        class="text-gray-700 font-semibold dark:text-gray-400"><?= esc($product->category->name) ?></span>
                </div>

                <div class="flex flex-row justify-between">
                    <span class="text-gray-700 dark:text-gray-400">Stok Saat Ini</span>

                    <span
                        class="text-gray-700 font-semibold dark:text-gray-400"><?= esc($product->stockInfo->currentStock) ?></span>
                </div>

                <div class="flex flex-row justify-between">
                    <span class="text-gray-700 dark:text-gray-400">Minimum Stok</span>

                    <span
                        class="text-gray-700 font-semibold dark:text-gray-400"><?= esc($product->stockInfo->minimumStock) ?></span>
                </div>

                <div class="flex flex-row justify-between">
                    <span class="text-gray-700 dark:text-gray-400">Harga Jual</span>

                    <span class="text-gray-700 font-semibold dark:text-gray-400"><?= esc($product->price) ?></span>
                </div>
            </div>
        </div>

        <div class="px-4 py-3 h-fit flex flex-col space-y-4 bg-white rounded-lg shadow-md dark:bg-gray-800 w-full">
            <div class="flex flex-row w-full space-x-3">
                <label class="block text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Harga Satuan</span>

                    <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Harga Produk" type="number"
                        name="price" />

                    <span class="text-xs text-red-600 dark:text-red-400">
                    </span>
                </label>

                <label class="block text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Kuantitas</span>

                    <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Kuantitas Pembelian" type="number"
                        name="quantity" />

                    <span class="text-xs text-red-600 dark:text-red-400">
                    </span>
                </label>
            </div>

            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">Pembelian pada supplier</span>

                <select class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" name="supplier_id">
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?= $supplier->id; ?>">
                            <?= $supplier->name; ?> - <?= $supplier->contactPerson; ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <span class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>

            <button
                class="submit-button block w-full px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                type="submit">
                Buat Produk
            </button>
        </div>
    </div>
</form>