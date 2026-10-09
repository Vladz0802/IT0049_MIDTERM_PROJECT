<?php helper('ui'); ?>
<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Sales History</h1>
<p class="page-sub">Every transaction, newest first.</p>

<p class="page-actions"><a class="btn btn-primary" href="<?= site_url('sales/new') ?>">+ Record Sale</a></p>

<div class="ledger">
    <table>
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Product</th>
                <th scope="col">Customer</th>
                <th scope="col">Sold by</th>
                <th scope="col" class="num-cell">Qty</th>
                <th scope="col" class="num-cell">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($sales)): ?>
                <tr><td colspan="6">No sales recorded yet.</td></tr>
            <?php endif; ?>
            <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= esc(date('M j, Y g:i A', strtotime($sale['created_at']))) ?></td>
                    <td><?= esc($sale['product_name']) ?></td>
                    <td><?= $sale['customer_name'] !== null ? esc($sale['customer_name']) : '<span class="muted">Walk-in</span>' ?></td>
                    <td><?= esc($sale['staff_name']) ?></td>
                    <td class="num-cell"><?= esc($sale['quantity']) ?></td>
                    <td class="num-cell"><?= esc(peso($sale['total_price'])) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <?php if (! empty($sales)): ?>
            <tfoot>
                <tr>
                    <th scope="row" colspan="5" class="num-cell">Total revenue</th>
                    <td class="num-cell"><strong><?= esc(peso($revenue)) ?></strong></td>
                </tr>
            </tfoot>
        <?php endif; ?>
    </table>
</div>

<?= $this->include('layouts/footer') ?>
