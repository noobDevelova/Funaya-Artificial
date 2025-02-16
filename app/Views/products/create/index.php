<?php

/**
 * @var CodeIgniter\View\View $this
 */
?>

<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<section class="container px-6 mx-auto grid mb-4">
    <?= $this->include('products/create/FormCreateProduct');  ?>

    <?= $this->include('products/create/FormCreateProductHandler');  ?>
</section>


<?= $this->endSection();  ?>