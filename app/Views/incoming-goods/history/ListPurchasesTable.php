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
                    <th class="px-4 py-3">Produk</th>
                    <th class="px-4 py-3">Kuantitas Pembelian</th>
                    <th class="px-4 py-3">Total Pembelian</th>
                    <th class="px-4 py-3">Supplier</th>
                    <th class="px-4 py-3">Admin</th>
                    <th class="px-4 py-3">Waktu Pembelian</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                <?php foreach ($purchases as $purchase): ?>
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <div class="relative hidden w-14 h-16 mr-3 rounded-lg md:block">
                                    <img class="object-cover w-full h-full rounded-lg"
                                        src="<?= base_url('uploads/products/' . esc($purchase->product->image)) ?>"
                                        alt="Image of <?= esc($purchase->product->image) ?>" loading="lazy" />

                                    <div class="absolute inset-0 rounded-lg shadow-inner" aria-hidden="true"></div>
                                </div>

                                <div>
                                    <p class="font-semibold"><?= esc($purchase->product->name) ?></p>

                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        <?= esc($purchase->product->category) ?>
                                    </p>
                                </div>
                            </div>
                        </td>


                        <td class="px-4 py-3 text-sm">
                            <?= esc($purchase->purchaseDetail->quantity) ?>
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <?= esc($purchase->purchaseDetail->totalAmount) ?>
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <?= esc($purchase->supplier->name) ?>
                        </td>

                        <td class="px-4 py-3">
                            <?= esc($purchase->createdBy->name) ?>
                        </td>

                        <td class="px-4 py-3">
                            <?= esc(date('Y-m-d H:i:s', strtotime($purchase->purchaseDate))) ?>
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
                <ul class="inline-flex items-center">
                    <li>
                        <a href="?page=<?= max(1, $currentPage - 1) ?>"
                            class="px-3 py-1 rounded-md rounded-l-lg <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : 'focus:outline-none focus:shadow-outline-purple' ?>"
                            aria-label="Previous">
                            <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                <path
                                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </li>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li>
                            <a href="?page=<?= $i ?>"
                                class="px-3 py-1 rounded-md <?= $i == $currentPage ? 'text-white bg-purple-600 border border-r-0 border-purple-600' : 'focus:outline-none focus:shadow-outline-purple' ?>">
                                <?= $i ?>
                            </a>
                        </li>
                    <?php endfor; ?>

                    <li>
                        <a href="?page=<?= min($totalPages, $currentPage + 1) ?>"
                            class="px-3 py-1 rounded-md rounded-r-lg <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : 'focus:outline-none focus:shadow-outline-purple' ?>"
                            aria-label="Next">
                            <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                <path
                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4-4a1 1 0 01-1.414 0z"
                                    clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </span>
    </div>
</div>