<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<!DOCTYPE html>
<html x-data="data()" x-init="applyTheme()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <link rel="stylesheet" href="<?= base_url() ?>assets/css/tailwind.output.css?v=1.0">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/form.css?v=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

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
                    <?= $this->include('auth/FormLogin.php') ?>

                    <?= $this->include('auth/FormLoginHandler') ?>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

</body>

</html>