<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<style>
    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        padding: 25px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .form-control:focus {
        outline: none;
        border-color: #009b4c;
        box-shadow: 0 0 0 2px rgba(0, 155, 76, 0.2);
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
        margin-right: 10px;
    }

    .btn-primary {
        background: #009b4c;
        color: white;
    }

    .btn-primary:hover {
        background: #007a3d;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
    }

    .btn-secondary:hover {
        background: #5a6268;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .alert-danger {
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .text-danger {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }

    .password-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
        border-left: 4px solid #17a2b8;
    }

    .password-section h5 {
        color: #17a2b8;
        margin-bottom: 15px;
    }

    .password-section p {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 15px;
    }
</style>

<div class="card">
    <h3 style="margin-bottom: 20px; color: #333;">Edit User</h3>

    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <ul style="margin: 0; padding-left: 20px;">
                <?php foreach ($validation->getErrors() as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('users/update/' . $user['id']) ?>">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="name">Nama Lengkap *</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $user['name']) ?>" required>
            <?php if (isset($validation) && $validation->hasError('name')): ?>
                <div class="text-danger"><?= $validation->getError('name') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $user['email']) ?>" required>
            <?php if (isset($validation) && $validation->hasError('email')): ?>
                <div class="text-danger"><?= $validation->getError('email') ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="role">Role *</label>
            <select class="form-control" id="role" name="role" required onchange="toggleConditionalFields()">
                <option value="">-- Pilih Role --</option>
                <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : '' ?>>Admin Pusat</option>
                <option value="admin_unit" <?= old('role', $user['role']) == 'admin_unit' ? 'selected' : '' ?>>Admin Unit</option>
                <option value="kaprodi" <?= old('role', $user['role']) == 'kaprodi' ? 'selected' : '' ?>>Kaprodi</option>
                <option value="dosen" <?= old('role', $user['role']) == 'dosen' ? 'selected' : '' ?>>Dosen</option>
            </select>
            <?php if (isset($validation) && $validation->hasError('role')): ?>
                <div class="text-danger"><?= $validation->getError('role') ?></div>
            <?php endif; ?>
        </div>

        <!-- Unit field (for admin_unit) -->
        <div class="form-group" id="unit-field" style="display: none;">
            <label for="unit">Unit *</label>
            <select class="form-control" id="unit" name="unit">
                <option value="">-- Pilih Unit --</option>
                <option value="sarpras" <?= old('unit', $user['unit']) == 'sarpras' ? 'selected' : '' ?>>Sarpras</option>
                <option value="umum" <?= old('unit', $user['unit']) == 'umum' ? 'selected' : '' ?>>Umum</option>
                <option value="lppm" <?= old('unit', $user['unit']) == 'lppm' ? 'selected' : '' ?>>LPPM</option>
            </select>
            <?php if (isset($validation) && $validation->hasError('unit')): ?>
                <div class="text-danger"><?= $validation->getError('unit') ?></div>
            <?php endif; ?>
        </div>

        <!-- Prodi field (for kaprodi and dosen) -->
        <div class="form-group" id="prodi-field" style="display: none;">
            <label for="prodi_id">Program Studi *</label>
            <select class="form-control" id="prodi_id" name="prodi_id">
                <option value="">-- Pilih Program Studi --</option>
                <?php if (isset($prodi) && is_array($prodi)): ?>
                    <?php foreach ($prodi as $p): ?>
                        <option value="<?= $p['id'] ?>" <?= old('prodi_id', $user['prodi_id']) == $p['id'] ? 'selected' : '' ?>>
                            <?= esc($p['nama_prodi']) ?> (<?= esc($p['jenjang']) ?>)
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <?php if (isset($validation) && $validation->hasError('prodi_id')): ?>
                <div class="text-danger"><?= $validation->getError('prodi_id') ?></div>
            <?php endif; ?>
        </div>

        <!-- Password Section -->
        <div class="password-section">
            <h5><i class="fas fa-lock"></i> Ubah Password (Opsional)</h5>
            <p>Kosongkan jika tidak ingin mengubah password</p>

            <div class="form-group">
                <label for="new_password">Password Baru</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
                <?php if (isset($validation) && $validation->hasError('new_password')): ?>
                    <div class="text-danger"><?= $validation->getError('new_password') ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <?php if (isset($validation) && $validation->hasError('confirm_password')): ?>
                    <div class="text-danger"><?= $validation->getError('confirm_password') ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Update User
            </button>
            <a href="<?= base_url('users') ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </form>
</div>

<script>
    function toggleConditionalFields() {
        const role = document.getElementById('role').value;
        const unitField = document.getElementById('unit-field');
        const prodiField = document.getElementById('prodi-field');

        // Hide all conditional fields first
        unitField.style.display = 'none';
        prodiField.style.display = 'none';

        // Show relevant fields based on role
        if (role === 'admin_unit') {
            unitField.style.display = 'block';
        } else if (role === 'kaprodi' || role === 'dosen') {
            prodiField.style.display = 'block';
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        toggleConditionalFields();
    });
</script>
<?= $this->endSection() ?>