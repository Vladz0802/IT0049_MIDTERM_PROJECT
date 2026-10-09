<?php $product = $product ?? []; ?>
    <?= csrf_field() ?>

    <div class="form-field">
        <label for="name">Product Name</label>
        <input type="text" id="name" name="name" value="<?= old('name', $product['name'] ?? '') ?>">
        <?= validation_show_error('name') ?>
    </div>

    <div class="form-field">
        <label for="price">Price (₱)</label>
        <input type="number" id="price" name="price" min="0" step="0.01" value="<?= old('price', $product['price'] ?? '') ?>">
        <?= validation_show_error('price') ?>
    </div>

    <div class="form-field">
        <label for="stock_quantity">Stock Quantity</label>
        <input type="number" id="stock_quantity" name="stock_quantity" min="0" step="1" value="<?= old('stock_quantity', $product['stock_quantity'] ?? '0') ?>">
        <?= validation_show_error('stock_quantity') ?>
    </div>

    <div class="form-field">
        <label for="image">Product Image (optional)</label>
        <?php if (! empty($product)): ?>
            <img class="thumb thumb-lg" src="<?= esc(upload_url('products', $product['image'] ?? null), 'attr') ?>" width="96" height="96" alt="Current product image">
        <?php endif; ?>
        <input type="file" id="image" name="image" accept="image/jpeg,image/png">
        <?= validation_show_error('image') ?>
    </div>
