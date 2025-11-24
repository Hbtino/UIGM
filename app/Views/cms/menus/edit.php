<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h2><i class="fas fa-edit"></i> Edit Menu</h2>
    
    <div class="card mt-3">
        <div class="card-body">
            <form action="<?= base_url('menus/update/'.$menu['id']) ?>" method="POST">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label>Judul Menu *</label>
                    <input type="text" name="title" class="form-control" value="<?= esc($menu['title']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label>URL *</label>
                    <input type="text" name="url" class="form-control" value="<?= esc($menu['url']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label>Icon</label>
                    <input type="text" name="icon" class="form-control" value="<?= esc($menu['icon']) ?>">
                </div>
                
                <div class="mb-3">
                    <label>Parent Menu</label>
                    <select name="parent_id" class="form-select">
                        <option value="">-- Root Menu --</option>
                        <?php foreach ($parent_menus as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= $menu['parent_id']==$p['id']?'selected':'' ?>><?= esc($p['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Urutan *</label>
                    <input type="number" name="order" class="form-control" value="<?= $menu['order'] ?>" required>
                </div>
                
                <div class="mb-3">
                    <label>Tipe Menu *</label>
                    <select name="menu_type" class="form-select" required>
                        <option value="dashboard" <?= ($menu['menu_type']??'dashboard')=='dashboard'?'selected':'' ?>>Dashboard</option>
                        <option value="landing" <?= ($menu['menu_type']??'')=='landing'?'selected':'' ?>>Landing</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label>Role Akses</label>
                    <?php $roles = json_decode($menu['roles']??'[]', true); ?>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="admin" id="r1" <?= in_array('admin',$roles)?'checked':'' ?>>
                        <label class="form-check-label" for="r1">Admin</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="reviewer" id="r2" <?= in_array('reviewer',$roles)?'checked':'' ?>>
                        <label class="form-check-label" for="r2">Reviewer</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="kaprodi" id="r3" <?= in_array('kaprodi',$roles)?'checked':'' ?>>
                        <label class="form-check-label" for="r3">Kaprodi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="roles[]" value="dosen" id="r4" <?= in_array('dosen',$roles)?'checked':'' ?>>
                        <label class="form-check-label" for="r4">Dosen</label>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label>Status *</label>
                    <select name="is_active" class="form-select" required>
                        <option value="1" <?= $menu['is_active']==1?'selected':'' ?>>Aktif</option>
                        <option value="0" <?= $menu['is_active']==0?'selected':'' ?>>Nonaktif</option>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
                <a href="<?= base_url('menus') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>