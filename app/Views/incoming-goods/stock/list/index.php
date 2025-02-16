<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<?= $this->extend('incoming-goods/index'); ?>

<?= $this->section('nested_content'); ?>

<h1 class="mt-6 mb-3 text-xl font-semibold text-gray-700 dark:text-gray-200">
    Kelola Stok Produk
</h1>

<?= $this->include('incoming-goods/stock/list/ListManageProductsCard') ?>

<?= $this->endSection(); ?>