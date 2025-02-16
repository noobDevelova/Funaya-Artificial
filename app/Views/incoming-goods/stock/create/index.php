<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<section class="container px-6 mx-auto grid mb-4">
    <?= $this->include('incoming-goods/stock/create/FormCreatePurchase');  ?>

    <?= $this->include('incoming-goods/stock/create/FormCreatePurchaseHandler');  ?>
</section>

<?= $this->endSection();  ?>