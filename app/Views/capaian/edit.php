<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Edit Capaian</h2>
<form action="/capaian/update/<?= $capaian['id'] ?>" method="post">
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" value="<?= $capaian['judul'] ?>" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Deskripsi</label>
        <textarea name="deskripsi" class="form-control" rows="3"><?= $capaian['deskripsi'] ?></textarea>
    </div>
    <div class="mb-3">
        <label>Tanggal</label>
        <input type="date" name="tanggal" value="<?= $capaian['tanggal'] ?>" class="form-control" required>
    </div>
    <button class="btn btn-success">Update</button>
    <a href="/capaian" class="btn btn-secondary">Kembali</a>
</form>

<?= $this->endSection() ?>
