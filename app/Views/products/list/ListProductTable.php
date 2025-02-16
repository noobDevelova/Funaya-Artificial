<?php
$currentPage = $pagination['current_page'];

$totalPages = $pagination['total_pages'];

$totalCount = $pagination['total_count'];

$limit = $pagination['limit'];
?>

<div class="w-full overflow-hidden rounded-lg shadow">
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Nama Produk</th>
                    <th class="px-4 py-3">Stock</th>
                    <th class="px-4 py-3">Minimum Stok</th>
                    <th class="px-4 py-3">Status Produk</th>
                    <th class="px-4 py-3">Katalog</th>
                    <th class="px-4 py-3">Tampilkan</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($products as $product): ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div class="relative hidden w-14 h-16 mr-3 rounded-lg md:block">
                                    <img class="object-cover w-full h-full rounded-lg"
                                        src="<?= base_url('uploads/products/' . esc($product->coverImage)) ?>"
                                        alt="Image of <?= esc($product->name) ?>" loading="lazy" />
                                    <div class="absolute inset-0 rounded-lg shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold"><?= esc($product->name) ?></p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        <?= esc($product->category->name) ?>
                                    </p>
                                </div>
                            </div>
                        </td>


                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                            <?= $product->stockInfo->currentStock >= $product->stockInfo->minimumStock  ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100'
                                : 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700' ?>">

                                <?= esc($product->stockInfo->currentStock) ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <?= esc($product->stockInfo->minimumStock) ?>
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                <?= $product->status->isActive === 1 ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100'
                                    : 'text-gray-700 bg-gray-100 dark:text-gray-100 dark:bg-gray-700' ?>">
                                <?= $product->status->isActive === 1 ? 'Tersedia untuk Dijual' : 'Tidak Tersedia untuk Dijual' ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 font-semibold leading-tight rounded-full
                                <?= $product->status->showOnCatalog === 1 ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100'
                                    : 'text-gray-700 bg-gray-100 dark:text-gray-100 dark:bg-gray-700' ?>">
                                <?= $product->status->showOnCatalog === 1 ? 'Ditampilkan di Katalog' : 'Tidak Ditampilkan di Katalog' ?>
                            </span>
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" <?= (int)$product->status->showOnCatalog === 1 ? 'checked' : '' ?>
                                    <?= (int)$product->status->isActive === 0 ? 'disabled' : '' ?>
                                    class="toggle-switch sr-only peer" data-slug="<?= $product->slug ?>"
                                    data-show-on-catalog="<?= $product->status->showOnCatalog ?>">
                                <div
                                    class="relative w-11 h-6 
                                    <?= (int)$product->status->isActive === 0 ? 'bg-gray-300 cursor-not-allowed' : 'bg-gray-200' ?> 
                                    peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full 
                                    peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white 
                                    after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full 
                                    after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                </div>
                            </label>
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <a href="/products/edit/<?= $product->slug ?>"
                                    class=" flex items-center justify-between px-2 py-2 border border-gray-400 text-sm font-medium
                                            leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                        </path>
                                    </svg>
                                </a>

                                <button @click="openModalConfirm({
                                        title: 'Hapus produk Ini?',
                                        description: 'produk akan dihapus, Produk yang bersangkutan akan terdampak.',
                                        additionalData: { slug: '<?= $product->slug ?>' },
                                        confirmAction: (data) => deleteProduct(data.slug),
                                    })"
                                    class="flex items-center justify-between px-2 py-2 border border-gray-400 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                    aria-label="Delete">
                                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3">
            Showing <?= ($currentPage - 1) * $limit + 1 ?> -
            <?= min($currentPage * $limit, $totalCount) ?> of <?= $totalCount ?>
        </span>

        <span class="col-span-2"></span>

        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            <nav aria-label="Table navigation">
                <div class="inline-flex items-center space-x-2">

                    <?php $isPrevDisabled = $currentPage == 1; ?>
                    <a <?= !$isPrevDisabled ? 'href="?page=' . max(1, $currentPage - 1) . '"' : '' ?>
                        class="bg-purple-600 px-1 py-1 rounded-md rounded-l-lg <?= $isPrevDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : 'focus:outline-none focus:shadow-outline-purple' ?>"
                        aria-label="Previous" <?= $isPrevDisabled ? 'aria-disabled="true"' : '' ?>>
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </a>


                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>"
                            class="px-3 py-1 rounded-md <?= $i == $currentPage ? 'text-white bg-purple-600 border border-r-0 border-purple-600' : 'focus:outline-none focus:shadow-outline-purple' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php $isNextDisabled = $currentPage == $totalPages; ?>
                    <a <?= !$isNextDisabled ? 'href="?page=' . min($totalPages, $currentPage + 1) . '"' : '' ?>
                        class="bg-purple-600 px-1 py-1 rounded-md rounded-r-lg <?= $isNextDisabled ? 'opacity-50 cursor-not-allowed pointer-events-none' : 'focus:outline-none focus:shadow-outline-purple' ?>"
                        aria-label="Next" <?= $isNextDisabled ? 'aria-disabled="true"' : '' ?>>
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                            <path
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </nav>
        </span>
    </div>
</div>