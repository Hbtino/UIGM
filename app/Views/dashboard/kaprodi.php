<h2>Dashboard Kaprodi</h2>
<p>Selamat datang, Kaprodi!</p>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h2>Dashboard Admin</h2>
<p>Selamat datang, <?= session()->get('name') ?>!</p>
<?= $this->endSection() ?>
<p>Kamu login sebagai: <?= session()->get('role') ?></p>
