<?php helper('ui'); ?>
<?= $this->include('layouts/header') ?>

<h1 class="page-heading">Staff Accounts</h1>
<p class="page-sub">Who's clocked in on the system.</p>

<p class="page-actions"><a class="btn btn-primary" href="<?= site_url('users/new') ?>">+ Add User</a></p>

<div class="ledger">
    <table>
        <thead>
            <tr>
                <th scope="col">Avatar</th>
                <th scope="col">Username</th>
                <th scope="col">Full Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><img class="avatar" src="<?= esc(upload_url('avatars', $user['avatar']), 'attr') ?>" width="44" height="44" alt="Avatar of <?= esc($user['username'], 'attr') ?>"></td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td class="action-cell">
                        <a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a>
                        <?php if ((int) $user['id'] !== (int) session()->get('userId')): ?>
                            <?= delete_button(site_url('users/' . $user['id'] . '/delete'), 'Delete ' . $user['full_name'] . '? This cannot be undone.') ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?= $this->include('layouts/footer') ?>
