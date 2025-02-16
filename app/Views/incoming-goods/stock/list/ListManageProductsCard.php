<?php

/**
 * @var CodeIgniter\View\View $this
 */

$currentPage = $pagination['current_page'];

$totalPages = $pagination['total_pages'];

$totalCount = $pagination['total_count'];

$limit = $pagination['limit'];
?>

<div class="grid gap-3 md:grid-cols-2">
    <?php foreach ($products as $product): ?>
        <div class="w-full flex flex-row justify-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 ">
            <div class="relative hidden max-w-[120px] max-h-[120px] mr-3 rounded-lg md:block">
                <img class="object-cover w-full h-full rounded-lg"
                    src="<?= base_url('uploads/products/' . esc($product->coverImage)) ?>"
                    alt="Image of <?= esc($product->name) ?>" loading="lazy" />
                <div class="absolute inset-0 rounded-lg shadow-inner" aria-hidden="true"></div>
            </div>

            <div class="flex flex-col space-y-2 w-full">
                <div class="flex justify-between items-center w-full">
                    <div>
                        <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                            <?= esc($product->name) ?>
                        </h4>

                        <p class="text-gray-600 dark:text-gray-400">
                            <?= esc($product->category->name) ?>
                        </p>
                    </div>

                    <div class="flex flex-col items-end">
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            Stok Yang Tersedia
                        </p>

                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            <?= esc($product->stockInfo->currentStock ?? '0') ?>
                        </p>
                    </div>
                </div>

                <div class="py-2 flex flex-row space-x-2">
                    <a href="/incoming-goods/manage-stock/<?= $product->slug ?>/create"
                        class="flex items-center justify-between px-2 py-2 border border-gray-400 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    <?php endforeach; ?>
</div>

<div class="flex justify-between items-center p-2 my-4 bg-white rounded-lg dark:bg-gray-800">
    <a href="?page=<?= max($currentPage - 1, 1) ?>"
        class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-md  <?= $currentPage <= 1 ? 'opacity-50 cursor-not-allowed' : '' ?>"
        <?= $currentPage <= 1 ? 'disabled' : '' ?>>
        Previous
    </a>

    <span class="text-gray-600 dark:text-gray-400">
        Bagian <?= esc($currentPage) ?> dari <?= esc($totalPages) ?>
    </span>

    <a href="?page=<?= min($currentPage + 1, $totalPages) ?>"
        class="px-4 py-2  bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-md <?= $currentPage >= $totalPages ? 'opacity-50 cursor-not-allowed' : '' ?>"
        <?= $currentPage >= $totalPages ? 'disabled' : '' ?>>
        Next
    </a>
</div>