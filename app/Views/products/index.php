<?php helper('ui'); ?>
<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Products</h1>
<p class="page-sub">Everything on the shelf, with what's left of it.</p>

<p class="page-actions"><a class="btn btn-primary" href="<?= site_url('products/new') ?>">+ Add Product</a></p>

<div class="ledger">
    <table>
        <thead>
            <tr>
                <th scope="col">Image</th>
                <th scope="col">Name</th>
                <th scope="col" class="num-cell">Price</th>
                <th scope="col" class="num-cell">Stock</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($products)): ?>
                <tr><td colspan="5">No products yet. Add the first one above.</td></tr>
            <?php endif; ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><img class="thumb" src="<?= esc(upload_url('products', $product['image']), 'attr') ?>" width="44" height="44" alt="<?= esc($product['name'], 'attr') ?>"></td>
                    <td><?= esc($product['name']) ?></td>
                    <td class="num-cell"><?= esc(peso($product['price'])) ?></td>
                    <td class="num-cell">
                        <?= esc($product['stock_quantity']) ?>
                        <?php if ((int) $product['stock_quantity'] === 0): ?>
                            <span class="stock-tag stock-out">Out</span>
                        <?php elseif ((int) $product['stock_quantity'] <= 5): ?>
                            <span class="stock-tag stock-low">Low</span>
                        <?php endif; ?>
                    </td>
                    <td class="action-cell">
                        <a href="<?= site_url('products/' . $product['id'] . '/edit') ?>">Edit</a>
                        <?= delete_button(site_url('products/' . $product['id'] . '/delete'), 'Delete ' . $product['name'] . '? This cannot be undone.') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->include('layouts/footer') ?>
