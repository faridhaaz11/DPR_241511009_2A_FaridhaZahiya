<?= $this->extend('template/login') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
<?php endif; ?>
<form method="post" action="/auth/attemptLogin">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Login</button>
</form>
<?= $this->endSection() ?>