<?php helper('ui'); ?>
<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Edit User</h1>
<p class="page-sub">Update the details below. A profile picture must be a JPG or PNG, up to 2MB. Leave the password blank to keep the current one.</p>

<form class="form-card" method="post" action="<?= site_url('users/' . $user['id']) ?>" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="form-field">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?= old('username', $user['username']) ?>" autocomplete="off">
        <?= validation_show_error('username') ?>
    </div>

    <div class="form-field">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name', $user['full_name']) ?>">
        <?= validation_show_error('full_name') ?>
    </div>

    <div class="form-field">
        <label for="password">New Password (optional)</label>
        <input type="password" id="password" name="password" autocomplete="new-password">
        <?= validation_show_error('password') ?>
    </div>

    <div class="form-field">
        <label for="avatar">Profile Picture</label>
        <img class="avatar avatar-lg" src="<?= esc(upload_url('avatars', $user['avatar']), 'attr') ?>" width="96" height="96" alt="Current avatar">
        <input type="file" id="avatar" name="avatar" accept="image/jpeg,image/png">
        <?= validation_show_error('avatar') ?>
    </div>

    <button type="submit" class="btn btn-primary">Update User</button>
    <a class="btn btn-secondary" href="<?= site_url('users') ?>">Cancel</a>
</form>

<?= $this->include('layouts/footer') ?>
