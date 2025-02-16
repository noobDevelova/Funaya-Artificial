<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<section class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Tambah Supplier
    </h2>

    <?= $this->include('supplier/create/FormCreateSupplier') ?>

    <?= $this->include('supplier/create/FormCreateSupplierHandler') ?>
</section>

<?= $this->endSection();  ?>