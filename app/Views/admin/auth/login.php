<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/tailwind.output.css?v=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/form.css?v=1.0">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="<?= base_url() ?>assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img aria-hidden="true" class="object-cover w-full h-full dark:hidden"
                        src="<?= base_url() ?>/assets/img/login-office.jpeg" alt="Office" />

                    <img aria-hidden="true" class="hidden object-cover w-full h-full dark:block"
                        src="<?= base_url() ?>/assets/img/login-office-dark.jpeg" alt="Office" />
                </div>

                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <form class="w-full" action="<?= site_url('admin/auth/login') ?>" method="POST">
                        <?= csrf_field() ?>

                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Welcome Admin!
                        </h1>

                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Email</span>

                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                placeholder="Jane Doe" name="email" type="email" value="<?= old('email') ?>" required />

                            <?php if (isset($validation) && $validation->getError('email')): ?>
                            <span class="text-xs text-red-600 dark:text-red-400">
                                <?= $validation->getError('email'); ?>
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

                        <button type="submit"
                            class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            Log in
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>