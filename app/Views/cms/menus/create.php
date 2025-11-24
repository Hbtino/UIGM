<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h2><i class="fas fa-plus"></i> Tambah Menu</h2>
    
    <div class="card mt-3">
        <div class="card-body">
            <form action="<?= base_url('menus/store') ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label>Judul Menu *</label>
                    <input type="text" name="title" class="form-control" required>
                </div>
                
                <div class="mb-3">
                    <label>URL *</label>
                    <input type="text" name="url" class="form-control" placeholder="/dashboard atau #section" required>
                </div>
                
                <div class="mb-3">
                    <label>Icon</label>
                    <input type="text" name="icon" class="form-control" placeholder="fas fa-home">
                </div>
                
                <div class="mb-3">
                    <label>Parent Menu</label>
                    <select name="parent_id" class="form-select">
                        <option value="">-- Root Menu --</option>
                        <?php foreach ($parent_menus as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= esc($p['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Urutan *</label>
                    <input type="number" name="order" class="form-control" value="0" required>
                </div>
                
                <div class="mb-3">
                    <label>Tipe Menu *</label>
                    <select name="menu_type" class="form-select" required>
                        <option value="dashboard">Dashboard (Sidebar)</option>
                        <option value="landing">Landing (Header)</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Role Akses</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="admin" id="r1" checked>
                        <label class="form-check-label" for="r1">Admin</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="reviewer" id="r2">
                        <label class="form-check-label" for="r2">Reviewer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="kaprodi" id="r3">
                        <label class="form-check-label" for="r3">Kaprodi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="dosen" id="r4">
                        <label class="form-check-label" for="r4">Dosen</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label>Status *</label>
                    <select name="is_active" class="form-select" required>
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                <a href="<?= base_url('menus') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
