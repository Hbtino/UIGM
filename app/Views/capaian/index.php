<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Data Capaian Kinerja</h2>
<a href="/capaian/create" class="btn btn-success mb-3">+ Tambah Capaian</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach($capaian as $c): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $c['judul'] ?></td>
            <td><?= $c['deskripsi'] ?></td>
            <td><?= $c['tanggal'] ?></td>
            <td><?= $c['status'] ?></td>
            <td>
                <a href="/capaian/edit/<?= $c['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="/capaian/delete/<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</a>
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?= $this->endSection() ?>
