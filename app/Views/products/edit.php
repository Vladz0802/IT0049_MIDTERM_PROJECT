<?php helper('ui'); ?>
<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Edit Product</h1>
<p class="page-sub">Update the details below. Choose a new photo only if you want to replace the current one.</p>

<form class="form-card" method="post" action="<?= site_url('products/' . $product['id']) ?>" enctype="multipart/form-data">
    <?= $this->include('products/_form') ?>

    <button type="submit" class="btn btn-primary">Update Product</button>
    <a class="btn btn-secondary" href="<?= site_url('products') ?>">Cancel</a>
</form>

<?= $this->include('layouts/footer') ?>
