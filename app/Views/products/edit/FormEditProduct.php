<form id="editProductForm" method="POST" enctype="multipart/form-data">
    <?= csrf_field(); ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Edit Produk
    </h2>

    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Identitas Produk
    </h4>

    <div class="px-4 py-3 mb-8 flex flex-col space-y-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex flex-row w-full space-x-3">
            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">Nama Produk</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Nama Produk" name="name"
                    value="<?= $product->name ?>" />

                <span class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>

            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">
                    Kategori Produk
                </span>

                <select class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" name="category_id">
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->id; ?>"
                            <?= $product->category->id == $category->id ? 'selected' : ''; ?>>
                            <?= $category->name; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>


        </div>


        <div class="flex flex-row w-full space-x-3">
            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">Minimum Stok</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Stok minimum" type="number"
                    name="minimum_stock" value="<?= $product->stockInfo->minimumStock ?>" />

                <span class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>

            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">Harga Produk</span>

                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Harga Produk" type="number"
                    name="price" value="<?= $product->price ?>" />

                <span class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>

            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">
                    Unit
                </span>

                <select class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" name="unit">
                    <option value="pcs" <?= $product->unit === "pcs" ? 'selected' : ''; ?>>
                        pcs
                    </option>
                    <option value="box" <?= $product->unit === "box" ? 'selected' : ''; ?>>
                        box
                    </option>
                    <option value="set" <?= $product->unit === "set" ? 'selected' : ''; ?>>
                        set
                    </option>
                    <option value="bundle" <?= $product->unit === "bundle" ? 'selected' : ''; ?>>
                        bundle
                    </option>
                </select>
            </label>
        </div>

        <div id="product-images"
            class="dropzone px-4 py-3 mb-8 hover:outline-dashed outline-2 outline-offset-2 bg-white rounded-lg shadow-md dark:bg-gray-800">
            <div
                class="dz-default dz-message flex items-center justify-center p-6 bg-gray-100 border-dashed border-2 border-gray-400 rounded-md text-center text-gray-600 dark:bg-gray-700 dark:border-gray-500 dark:text-gray-300">
                <span class="text-sm font-medium">Drag atau drop gambar produk disini.</span>
            </div>
        </div>
    </div>

    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Detail Produk
    </h4>

    <div class="px-4 py-3 mb-8 flex flex-col space-y-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="flex flex-row w-full space-x-3">
            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">Warna Produk</span>
                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Warna Produk" name="color"
                    value="<?= $product->detail->color ?>" />

                <span class="text-xs text-red-600 dark:text-red-400">

                </span>
            </label>

            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">Ukuran Produk</span>
                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Ukuran Produk" name="size"
                    value="<?= $product->detail->size ?>" />

                <span class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>

            <label class="block text-sm w-full">
                <span class="text-gray-700 dark:text-gray-400">Bahan Produk</span>
                <input class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Bahan Produk" name="material"
                    value="<?= $product->detail->material ?>" />

                <span class="text-xs text-red-600 dark:text-red-400">
                </span>
            </label>
        </div>

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Deskripsi</span>
            <textarea class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                        border bg-white text-gray-700 placeholder-gray-400 
                        focus:outline-none dark:bg-gray-700 dark:text-gray-300 dark:placeholder-gray-500
                        dark:border-gray-600 dark:focus:ring-gray-500 dark:focus:border-gray-500
                        border-gray-300 focus:border-blue-400 focus:ring-blue-400' 
                       
                    rows=" 3" placeholder="Deskripsi produk"
                name="description"><?= esc($product->detail->description) ?></textarea>

            <span class="text-xs text-red-600 dark:text-red-400">
            </span>
        </label>

        <label class="block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Informasi Tambahan</span>
            <textarea class="block w-full mt-1 rounded-[0.25rem] text-base leading-[1rem] py-[0.5rem] px-[0.75rem]
                border border-gray-300 bg-white text-gray-700 placeholder-gray-400 
                focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400
                dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300 dark:placeholder-gray-500 
                dark:focus:ring-gray-500 dark:focus:border-gray-500" rows="3" placeholder="Informasi Tambahan Produk"
                name="additional_info"><?= esc($product->detail->additionalInfo) ?></textarea>

            <span class="text-xs text-red-600 dark:text-red-400">
            </span>
        </label>
    </div>

    <button
        class="submit-button block w-full px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
        type="submit">
        Ubah Produk
    </button>
</form>