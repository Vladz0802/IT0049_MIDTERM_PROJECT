<?php helper('ui'); ?>
<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Add Product</h1>
<p class="page-sub">Name, price, and starting stock are required. The photo must be a JPG or PNG up to 2MB.</p>

<form class="form-card" method="post" action="<?= site_url('products') ?>" enctype="multipart/form-data">
    <?= $this->include('products/_form') ?>

    <button type="submit" class="btn btn-primary">Save Product</button>
    <a class="btn btn-secondary" href="<?= site_url('products') ?>">Cancel</a>
</form>

<?= $this->include('layouts/footer') ?>
