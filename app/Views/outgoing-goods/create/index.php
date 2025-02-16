<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>
<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
        Buat Laporan Penjualan
    </h2>

    <?= $this->include('outgoing-goods/create/CreateSalesReportForm');  ?>

    <?= $this->include('outgoing-goods/create/CreateSalesReportFormHandler');  ?>
</div>
<?= $this->endSection();  ?>