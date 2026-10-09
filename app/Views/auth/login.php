<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Staff Login</h1>
<p class="page-sub">Log in to record sales and manage the store.</p>

<form class="form-card" method="post" action="<?= site_url('login') ?>">
    <?= csrf_field() ?>

    <div class="form-field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= old('username') ?>" autocomplete="username" autofocus>
        <?= validation_show_error('username') ?>
    </div>

    <div class="form-field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="current-password">
        <?= validation_show_error('password') ?>
    </div>

    <button type="submit" class="btn btn-primary">Log In</button>
</form>

<?= $this->include('layouts/footer') ?>
