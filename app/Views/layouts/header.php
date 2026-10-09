<?php $active = $active ?? ''; $loggedIn = (bool) session()->get('isLoggedIn'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Corner Shop POS') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/style.css') ?>">
</head>
<body>
    <header class="site-header">
        <nav class="navigation" aria-label="Main navigation">
            <a class="brand" href="<?= site_url('/') ?>">Corner <span>Shop</span> POS</a>
            <div class="navigation-links">
                <a href="<?= site_url('/') ?>" <?= $active === 'home' ? 'aria-current="page"' : '' ?>>Home</a>
                <a href="<?= site_url('about') ?>" <?= $active === 'about' ? 'aria-current="page"' : '' ?>>About</a>
                <?php if ($loggedIn): ?>
                    <a href="<?= site_url('sales/new') ?>" <?= $active === 'sale' ? 'aria-current="page"' : '' ?>>Record Sale</a>
                    <a href="<?= site_url('sales') ?>" <?= $active === 'history' ? 'aria-current="page"' : '' ?>>Sales History</a>
                    <a href="<?= site_url('products') ?>" <?= $active === 'products' ? 'aria-current="page"' : '' ?>>Products</a>
                    <a href="<?= site_url('customers') ?>" <?= $active === 'customers' ? 'aria-current="page"' : '' ?>>Customers</a>
                    <a href="<?= site_url('users') ?>" <?= $active === 'users' ? 'aria-current="page"' : '' ?>>Staff</a>
                    <form class="inline-form" method="post" action="<?= site_url('logout') ?>">
                        <?= csrf_field() ?>
                        <button type="submit" class="logout-btn">Log out (<?= esc(session()->get('username')) ?>)</button>
                    </form>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>" <?= $active === 'login' ? 'aria-current="page"' : '' ?>>Log in</a>
                <?php endif; ?>
            </div>
        </nav>
    </header>
    <main class="content">
    <?php if (session()->getFlashdata('success')): ?>
        <p class="flash-success"><?= esc(session()->getFlashdata('success')) ?></p>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <p class="flash-error"><?= esc(session()->getFlashdata('error')) ?></p>
    <?php endif; ?>
