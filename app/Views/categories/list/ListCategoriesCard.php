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
    <?php foreach ($categories as $category): ?>
        <div class="w-full p-4 flex flex-col space-y-2 bg-white rounded-lg shadow-xs dark:bg-gray-800 ">
            <div class="flex justify-between items-center w-full">
                <div>
                    <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                        <?= esc($category->name) ?>
                    </h4>

                    <p class="text-gray-600 dark:text-gray-400">
                        <?= esc($category->description ?? 'No description available.') ?>
                    </p>
                </div>

                <div class="flex flex-col items-end">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                        Total Produk
                    </p>

                    <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                        <?= esc($category->product_count ?? '0') ?>
                    </p>
                </div>
            </div>

            <div class="py-2 flex flex-row space-x-2">
                <button @click="openModal({
                                    title: 'Edit Kategori Ini?',
                                    description: 'Produk yang bersangkutan juga akan berubah',
                                    additionalData: { slug: '<?= $category->slug ?>' },
                                    loadAction: (data) => getCategories(data.slug) 
                                })"
                    class=" flex items-center justify-between px-2 py-2 border border-gray-400 text-sm font-medium
                    leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray">
                    <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                        </path>
                    </svg>
                </button>

                <button @click="openModalConfirm({
                                        title: 'Hapus Kategori Ini?',
                                        description: 'Kategori akan dihapus, Produk yang bersangkutan akan terdampak.',
                                        confirmAction: (data) => deleteCategories(data.id),
                                        additionalData: { id: <?= $category->id ?> }
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

<?= $this->include('categories/list/ModalFormEditCategories') ?>

<?= $this->include('categories/list/ModalFormEditCategoriesHandler') ?>

<?= $this->include('categories/list/ModalDeleteCategories') ?>

<?= $this->include('categories/list/ModalDeleteCategoriesHandler') ?>