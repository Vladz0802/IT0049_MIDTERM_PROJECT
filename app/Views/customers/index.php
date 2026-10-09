<?php helper('ui'); ?>
<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Customer Accounts</h1>
<p class="page-sub">Everyone with a running tab or a standing order at the counter.</p>

<p class="page-actions"><a class="btn btn-primary" href="<?= site_url('customers/new') ?>">+ Add Customer</a></p>

<div class="ledger">
    <table>
        <thead>
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($customers)): ?>
                <tr><td colspan="4">No customers yet.</td></tr>
            <?php endif; ?>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                    <td class="action-cell">
                        <a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">Edit</a>
                        <?= delete_button(site_url('customers/' . $customer['id'] . '/delete'), 'Delete ' . $customer['full_name'] . '? Their past sales will stay in the history as walk-in sales.') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->include('layouts/footer') ?>
