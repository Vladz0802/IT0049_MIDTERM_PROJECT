<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Add User</h1>
<p class="page-sub">Username (unique), full name, and a password of at least 8 characters are required. The profile picture is optional.</p>

<form class="form-card" method="post" action="<?= site_url('users') ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= old('username') ?>" autocomplete="off">
        <?= validation_show_error('username') ?>
    </div>

    <div class="form-field">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name') ?>">
        <?= validation_show_error('full_name') ?>
    </div>

    <div class="form-field">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" autocomplete="new-password">
        <?= validation_show_error('password') ?>
    </div>

    <div class="form-field">
        <label for="avatar">Profile Picture (optional)</label>
        <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png">
        <?= validation_show_error('avatar') ?>
    </div>

    <button type="submit" class="btn btn-primary">Save User</button>
    <a class="btn btn-secondary" href="<?= site_url('users') ?>">Cancel</a>
</form>

<?= $this->include('layouts/footer') ?>
