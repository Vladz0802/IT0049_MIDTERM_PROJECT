<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Add Customer</h1>
<p class="page-sub">Name and email are required.</p>

<form class="form-card" method="post" action="<?= site_url('customers') ?>">
    <?= csrf_field() ?>

    <div class="form-field">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" value="<?= old('full_name') ?>">
        <?= validation_show_error('full_name') ?>
    </div>

    <div class="form-field">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?= old('email') ?>">
        <?= validation_show_error('email') ?>
    </div>

    <div class="form-field">
        <label for="phone">Phone (optional)</label>
        <input type="text" id="phone" name="phone" value="<?= old('phone') ?>">
        <?= validation_show_error('phone') ?>
    </div>

    <button type="submit" class="btn btn-primary">Save Customer</button>
    <a class="btn btn-secondary" href="<?= site_url('customers') ?>">Cancel</a>
</form>

<?= $this->include('layouts/footer') ?>
