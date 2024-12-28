<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<?= $this->extend('admin/layout/main'); ?>

<?= $this->section('content'); ?>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        List Karyawan
    </h2>

    <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
        href="/admin/create-employee">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                </path>
            </svg>
            <span>Tambah Akun Karyawan</span>
        </div>
        <span>Buat &RightArrow;</span>
    </a>

    <div class="w-full overflow-hidden rounded-lg shadow-xs">
        <div class="w-full overflow-x-auto">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Terakhir Login</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    <?php foreach ($employees as $employee): ?>
                        <tr class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3">
                                <div class="flex items-center text-sm">
                                    <!-- Avatar with inset shadow -->
                                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                        <img class="object-cover w-full h-full rounded-full"
                                            src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                                            alt="" loading="lazy" />
                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                    </div>
                                    <div>
                                        <p class="font-semibold"><?= $employee->username ?></p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            <?= $employee->email ?>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <span
                                    class="px-2 py-1 font-semibold leading-tight text-gray-700 bg-gray-100 rounded-full dark:text-gray-100 dark:bg-gray-700">
                                    Karyawan
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <?php if (!empty($employee->last_login)): ?>
                                    <?= date('m/d/Y', strtotime($employee->last_login)) ?>
                                <?php else: ?>
                                    <span
                                        class="px-2 py-1 font-semibold leading-tight text-orange-700 bg-orange-100 rounded-full dark:text-white dark:bg-orange-600">
                                        Belum Login
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center space-x-4 text-sm">
                                    <!-- HAPUS AKUN ADMIN -->
                                    <button @click="openModal({
                                            title: 'Hapus Akun?',
                                            description: 'Setelah akun dihapus, karyawan tidak dapat login dengan akun ini.',
                                            confirmAction: (data) => deleteEmployee(data.id),
                                            additionalData: { id: <?= $employee->id ?> }
                                        })"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
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
                Showing <?= ($currentPage - 1) * $limit + 1 ?> - <?= min($currentPage * $limit, $totalCount) ?> of
                <?= $totalCount ?>
            </span>
            <span class="col-span-2"></span>

            <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                    <ul class="inline-flex items-center">

                        <li>
                            <button
                                class="px-3 py-1 rounded-md rounded-l-lg <?= $currentPage == 1 ? 'opacity-50 cursor-not-allowed' : 'focus:outline-none focus:shadow-outline-purple' ?>"
                                aria-label="Previous">
                                <a href="?page=<?= max(1, $currentPage - 1) ?>">

                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </button>
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
                            <button
                                class="px-3 py-1 rounded-md rounded-r-lg <?= $currentPage == $totalPages ? 'opacity-50 cursor-not-allowed' : 'focus:outline-none focus:shadow-outline-purple' ?>"
                                aria-label="Next">
                                <a href="?page=<?= min($totalPages, $currentPage + 1) ?>">
                                    <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                                        <path
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </button>
                        </li>
                    </ul>
                </nav>
            </span>
        </div>
    </div>

    <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0 transform translate-y-1/2" @click.away="closeModal"
            @keydown.escape="closeModal"
            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
            role="dialog" id="modal">
            <!-- Modal body -->
            <div class="mt-4 mb-6">
                <!-- Modal title -->
                <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300" x-text="modalData.title">
                </p>
                <!-- Modal description -->
                <p class="text-sm text-gray-700 dark:text-gray-400" x-text="modalData.description">
                </p>
            </div>
            <footer
                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                <button @click="closeModal"
                    class="w-full px-5 py-3 text-sm font-medium leading-5  text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </button>
                <button @click="executeModalAction"
                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Konfirmasi
                </button>
            </footer>
        </div>
    </div>
</div>

<script>
    function deleteEmployee(id) {
        fetch(`/admin/list-employee/delete`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    id
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    Toastify({
                        text: "Karyawan Berhasil Dihapus",
                        style: {
                            background: "rgb(126 58 242 / var(--tw-bg-opacity, 1))",
                            borderRadius: '10px'
                        }
                    }).showToast();
                    setTimeout(() => {
                        location.reload();
                    }, 1000)
                } else if (data.error) {
                    Toastify({
                        text: `Karyawan Gagal Dihapus ${data.error}`,
                        style: {
                            background: "rgb(224 36 36 / var(--tw-text-opacity, 1))",
                            borderRadius: '10px'
                        }
                    }).showToast();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>
<?= $this->endSection();  ?>