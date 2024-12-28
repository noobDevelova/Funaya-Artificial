<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<?= $this->extend('admin/layout/main'); ?>

<?= $this->section('content'); ?>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tambah Karyawan
    </h2>

    <form method="POST" action="<?= site_url('admin/create-employee') ?>">
        <?= csrf_field() ?>

        <div class="px-4 py-3 bg-white rounded-lg shadow-md  dark:bg-gray-800">
            <div class="flex flex-col space-y-2 mb-8">
                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Username</span>

                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Jane Doe" type="text" name="username" value="<?= old('username') ?>" required />

                    <?php if (isset($validation) && $validation->getError('username')): ?>
                    <span class="text-xs text-red-600 dark:text-red-400">
                        <?= $validation->getError('username'); ?>
                    </span>
                    <?php endif; ?>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Email</span>

                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Jane Doe" type="email" name="email" value="<?= old('email') ?>" required />


                    <?php if (isset($validation) && $validation->getError('email')): ?>
                    <span class="text-xs text-red-600 dark:text-red-400">
                        <?= $validation->getError('email'); ?>
                    </span>
                    <?php endif; ?>
                </label>

                <label class="block text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Phone Number</span>

                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="Jane Doe" type="tel" name="phone_number" value="<?= old('phone_number') ?>"
                        required />


                    <?php if (isset($validation) && $validation->getError('phone_number')): ?>
                    <span class="text-xs text-red-600 dark:text-red-400">
                        <?= $validation->getError('phone_number'); ?>
                    </span>
                    <?php endif; ?>
                </label>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Password</span>

                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="***************" name="password" type="password" required />

                    <?php if (isset($validation) && $validation->getError('password')): ?>
                    <span class="text-xs text-red-600 dark:text-red-400">
                        <?= $validation->getError('password'); ?>
                    </span>
                    <?php endif; ?>
                </label>

                <label class="block mt-4 text-sm">
                    <span class="text-gray-700 dark:text-gray-400">Konfirmasi Password</span>

                    <input
                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                        placeholder="***************" name="confirm_password" type="password" required />

                    <?php if (isset($validation) && $validation->getError('confirm_password')): ?>
                    <span class="text-xs text-red-600 dark:text-red-400">
                        <?= $validation->getError('confirm_password'); ?>
                    </span>
                    <?php endif; ?>
                </label>
            </div>

            <button
                class="block w-full px-4 py-2 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                type="submit">
                Buat Akun
            </button>
        </div>
    </form>
</div>
<?= $this->endSection();  ?>