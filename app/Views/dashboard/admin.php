<h2>Dashboard Admin</h2>
<p>Selamat datang, Admin!</p>
<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h2>Dashboard Admin</h2>
<p>Selamat datang, <?= session()->get('name') ?>!</p>
<?= $this->endSection() ?>
