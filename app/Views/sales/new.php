<?php helper('ui'); ?>
<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Record Sale</h1>
<p class="page-sub">Pick a product, optionally a customer, and the quantity. Stock goes down as soon as you submit.</p>

<form class="form-card" method="post" action="<?= site_url('sales') ?>">
    <?= csrf_field() ?>

    <div class="form-field">
        <label for="product_id">Product</label>
        <select id="product_id" name="product_id">
            <option value="">— Choose a product —</option>
            <?php foreach ($products as $product): ?>
                <option value="<?= esc($product['id'], 'attr') ?>"
                    <?= (string) old('product_id') === (string) $product['id'] ? 'selected' : '' ?>
                    <?= (int) $product['stock_quantity'] === 0 ? 'disabled' : '' ?>>
                    <?= esc($product['name']) ?> — <?= esc(peso($product['price'])) ?>
                    (<?= (int) $product['stock_quantity'] === 0 ? 'out of stock' : esc($product['stock_quantity']) . ' in stock' ?>)
                </option>
            <?php endforeach; ?>
        </select>
        <?= validation_show_error('product_id') ?>
    </div>

    <div class="form-field">
        <label for="customer_id">Customer (optional)</label>
        <select id="customer_id" name="customer_id">
            <option value="">Walk-in customer</option>
            <?php foreach ($customers as $customer): ?>
                <option value="<?= esc($customer['id'], 'attr') ?>" <?= (string) old('customer_id') === (string) $customer['id'] ? 'selected' : '' ?>>
                    <?= esc($customer['full_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?= validation_show_error('customer_id') ?>
    </div>

    <div class="form-field">
        <label for="quantity">Quantity</label>
        <input type="number" id="quantity" name="quantity" min="1" step="1" value="<?= old('quantity', '1') ?>">
        <?= validation_show_error('quantity') ?>
    </div>

    <button type="submit" class="btn btn-primary">Record Sale</button>
    <a class="btn btn-secondary" href="<?= site_url('sales') ?>">Sales History</a>
</form>

<?= $this->include('layouts/footer') ?>
