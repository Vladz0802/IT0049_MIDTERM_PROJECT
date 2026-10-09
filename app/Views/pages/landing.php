<?= $this->include('layouts/header') ?>

<section class="hero">
    <div>
        <p class="hero-tag">Now serving Barangay San Isidro</p>
        <h1>The counter runs on paper. This is what comes next.</h1>
        <p class="hero-lede">
            Corner Shop POS is the digital ledger for our sari-sari store —
            products, customers, staff, and every sale in one place, with
            stock that updates itself at the register.
        </p>
        <div class="hero-actions">
            <?php if ($counts !== null): ?>
                <a class="btn btn-primary" href="<?= site_url('sales/new') ?>">Record a sale</a>
                <a class="btn btn-secondary" href="<?= site_url('sales') ?>">Sales history</a>
            <?php else: ?>
                <a class="btn btn-primary" href="<?= site_url('login') ?>">Staff log in</a>
                <a class="btn btn-secondary" href="<?= site_url('about') ?>">About this project</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="hero-counter">
        <?php if ($counts !== null): ?>
            <div class="row"><span class="label">Products in the catalog</span><span class="num"><?= esc($counts['products']) ?></span></div>
            <div class="row"><span class="label">Customer accounts on file</span><span class="num"><?= esc($counts['customers']) ?></span></div>
            <div class="row"><span class="label">Staff accounts on file</span><span class="num"><?= esc($counts['staff']) ?></span></div>
            <div class="row"><span class="label">Sales recorded</span><span class="num"><?= esc($counts['sales']) ?></span></div>
        <?php else: ?>
            <div class="row"><span class="label">Store figures</span><span class="num">Staff only</span></div>
            <div class="row"><span class="label">Log in to see them</span><span class="num">→</span></div>
        <?php endif; ?>
    </div>
</section>

<?php if ($counts !== null): ?>
<section>
    <h2>Get around the store</h2>
    <div class="quick-links">
        <a class="quick-link" href="<?= site_url('sales/new') ?>">
            <h3>Record Sale</h3>
            <p>Pick a product, enter a quantity, and the stock updates.</p>
        </a>
        <a class="quick-link" href="<?= site_url('products') ?>">
            <h3>Products</h3>
            <p>Prices, stock levels, and product photos.</p>
        </a>
        <a class="quick-link" href="<?= site_url('customers') ?>">
            <h3>Customer Accounts</h3>
            <p>Names, emails, and phone numbers on file for the store.</p>
        </a>
        <a class="quick-link" href="<?= site_url('users') ?>">
            <h3>Staff Accounts</h3>
            <p>Who's working the counter.</p>
        </a>
    </div>
</section>
<?php endif; ?>

<?= $this->include('layouts/footer') ?>
