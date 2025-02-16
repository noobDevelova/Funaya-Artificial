<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<section class="container px-6 mx-auto grid gap-3">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Buat Kategori
    </h2>

    <?= $this->include('categories/create/FormCreateCategories.php') ?>

    <?= $this->include('categories/create/FormCreateCategoriesHandler.php') ?>

    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        List Kategori
    </h2>

    <?= $this->include('categories/list/ListCategoriesCard.php') ?>

</section>
<?= $this->endSection();  ?>