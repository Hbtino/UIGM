<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User - UI Green Metric</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
    }

    /* Sidebar Styles - Same as dashboard */
    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      width: 280px;
      background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
      padding: 0;
      overflow-y: auto;
      z-index: 1000;
      box-shadow: 4px 0 15px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .sidebar::-webkit-scrollbar {
      width: 6px;
    }

    .sidebar::-webkit-scrollbar-track {
      background: rgba(255, 255, 255, 0.1);
    }

    .sidebar::-webkit-scrollbar-thumb {
      background: rgba(255, 255, 255, 0.3);
      border-radius: 3px;
    }

    .sidebar-header {
      padding: 25px 20px;
      background: rgba(0, 0, 0, 0.2);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      margin-bottom: 10px;
    }

    .sidebar-logo {
      display: flex;
      align-items: center;
      gap: 15px;
      margin-bottom: 10px;
    }

    .sidebar-logo i {
      font-size: 32px;
      color: #4CAF50;
    }

    .sidebar-header h4 {
      color: white;
      font-size: 20px;
      font-weight: 700;
      margin: 0;
      letter-spacing: 0.5px;
    }

    .sidebar-header p {
      color: rgba(255, 255, 255, 0.7);
      font-size: 13px;
      margin: 5px 0 0;
    }

    .nav-section {
      margin-bottom: 5px;
    }

    .nav-section-title {
      padding: 15px 20px 8px;
      color: rgba(255, 255, 255, 0.5);
      font-size: 11px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .nav-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .nav-item {
      margin: 0;
    }

    .nav-link {
      display: flex;
      align-items: center;
      padding: 14px 20px;
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
      position: relative;
    }

    .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      color: white;
      border-left-color: #4CAF50;
      padding-left: 25px;
    }

    .nav-link.active {
      background-color: rgba(76, 175, 80, 0.2);
      color: white;
      border-left-color: #4CAF50;
      font-weight: 600;
    }

    .nav-link.active::before {
      content: '';
      position: absolute;
      right: 0;
      top: 0;
      bottom: 0;
      width: 4px;
      background: #4CAF50;
    }

    .nav-link i {
      width: 24px;
      margin-right: 12px;
      font-size: 18px;
      text-align: center;
    }

    .nav-link span {
      font-size: 14px;
    }

    /* Submenu Collapse Styling */
    .collapse .nav-link {
      padding: 12px 20px 12px 15px;
      font-size: 13px;
      color: rgba(255, 255, 255, 0.7);
    }

    .collapse .nav-link:hover {
      color: white;
      background-color: rgba(255, 255, 255, 0.08);
      padding-left: 20px;
    }

    .collapse .nav-link.active {
      color: white;
      background-color: rgba(76, 175, 80, 0.15);
    }

    .collapse .nav-link i {
      font-size: 14px;
      width: 20px;
    }

    /* Chevron icon animation */
    .nav-link[data-bs-toggle="collapse"] .fa-chevron-down {
      transition: transform 0.3s ease;
    }

    .nav-link[data-bs-toggle="collapse"][aria-expanded="true"] .fa-chevron-down {
      transform: rotate(180deg);
    }

    /* Force white color for collapse toggle links */
    .nav-link[data-bs-toggle="collapse"],
    .nav-link[data-bs-toggle="collapse"]:focus,
    .nav-link[data-bs-toggle="collapse"]:active,
    .nav-link[data-bs-toggle="collapse"][aria-expanded="true"],
    .nav-link[data-bs-toggle="collapse"][aria-expanded="false"] {
      color: rgba(255, 255, 255, 0.8) !important;
    }

    .nav-link[data-bs-toggle="collapse"]:hover {
      color: white !important;
    }

    .nav-link[data-bs-toggle="collapse"] span,
    .nav-link[data-bs-toggle="collapse"] i {
      color: inherit;
    }

    .sidebar-footer {
      padding: 20px;
      margin-top: auto;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      background: rgba(0, 0, 0, 0.2);
    }

    .sidebar-footer p {
      color: rgba(255, 255, 255, 0.5);
      font-size: 11px;
      margin: 0;
      text-align: center;
    }

    /* Main content */
    .main-content {
      margin-left: 280px;
      padding: 20px;
      min-height: 100vh;
      transition: all 0.3s ease;
    }

    .topbar {
      background: white;
      padding: 20px 30px;
      border-radius: 15px;
      margin-bottom: 25px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .topbar h3 {
      margin: 0;
      color: #1e3c72;
      font-size: 26px;
      font-weight: 700;
    }

    .content {
      padding: 0
    }

    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      padding: 25px;
      max-width: 600px;
      margin: auto
    }

    label {
      display: block;
      margin-top: 10px;
      font-weight: 600;
      color: #009b4c
    }

    input,
    select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px
    }

    .btn {
      padding: 8px 14px;
      border: none;
      border-radius: 6px;
      color: #fff;
      cursor: pointer;
      margin-top: 15px
    }

    .btn-save {
      background: #009b4c
    }

    .btn-back {
      background: #bdc3c7;
      text-decoration: none;
      display: inline-block;
      text-align: center
    }

    .error {
      color: #e74c3c;
      font-size: 0.9rem;
      margin-top: 5px
    }

    .topbar h3 {
      color: #009b4c;
      font-weight: 600
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <div class="sidebar-logo">
        <i class="fas fa-leaf"></i>
        <div>
          <h4>POLBAN</h4>
          <p>Kampus Berkelanjutan</p>
        </div>
      </div>
    </div>

    <nav>
      <div class="nav-section">
        <div class="nav-section-title">Menu Utama</div>
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="<?= base_url('dashboard') ?>" class="nav-link">
              <i class="fas fa-home"></i>
              <span>Dashboard</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="nav-section">
        <div class="nav-section-title">Kriteria SDGs</div>
        <ul class="nav-menu">
          <li class="nav-item">
            <a href="<?= base_url('setting-infrastructure') ?>" class="nav-link">
              <i class="fas fa-building"></i>
              <span>Pengaturan & Infrastruktur</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('energy-climate') ?>" class="nav-link">
              <i class="fas fa-bolt"></i>
              <span>Energi & Perubahan Iklim</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('water-management') ?>" class="nav-link">
              <i class="fas fa-tint"></i>
              <span>Pengelolaan Air</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('waste-management') ?>" class="nav-link">
              <i class="fas fa-recycle"></i>
              <span>Pengelolaan Limbah</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('dashboard/transportasi') ?>" class="nav-link">
              <i class="fas fa-bus"></i>
              <span>Transportasi</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('education-research') ?>" class="nav-link">
              <i class="fas fa-graduation-cap"></i>
              <span>Pendidikan & Penelitian</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="nav-section">
        <div class="nav-section-title">Sistem</div>
        <ul class="nav-menu">
          <?php
          $user_role = session()->get('role');
          if ($user_role == 'admin'):
          ?>
            <li class="nav-item">
              <a href="<?= base_url('users') ?>" class="nav-link active">
                <i class="fas fa-users"></i>
                <span>Manajemen User</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('menus') ?>" class="nav-link">
                <i class="fas fa-bars"></i>
                <span>Manajemen Menu</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('news-admin') ?>" class="nav-link">
                <i class="fas fa-newspaper"></i>
                <span>Manajemen Berita</span>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('landing-contents') ?>" class="nav-link">
                <i class="fas fa-file-alt"></i>
                <span>Konten Landing Page</span>
              </a>
            </li>
          <?php endif; ?>

          <!-- Laporan Menu with Submenu -->
          <?php if (in_array($user_role, ['admin', 'dosen', 'kaprodi'])): ?>
            <li class="nav-item">
              <a href="#" class="nav-link" data-bs-toggle="collapse" data-bs-target="#laporanSubmenu" aria-expanded="false">
                <i class="fas fa-file-alt"></i>
                <span>Laporan</span>
                <i class="fas fa-chevron-down ms-auto" style="font-size: 12px;"></i>
              </a>
              <div class="collapse" id="laporanSubmenu">
                <ul class="nav flex-column ms-3">
                  <?php if (in_array($user_role, ['admin', 'dosen'])): ?>
                    <li class="nav-item">
                      <a href="<?= base_url('dashboard/laporan') ?>" class="nav-link">
                        <i class="fas fa-user-tie"></i>
                        <span>Laporan Dosen</span>
                      </a>
                    </li>
                  <?php endif; ?>
                  <?php if (in_array($user_role, ['admin', 'kaprodi'])): ?>
                    <li class="nav-item">
                      <a href="<?= base_url('laporan/kaprodi') ?>" class="nav-link">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Laporan Kaprodi</span>
                      </a>
                    </li>
                  <?php endif; ?>
                </ul>
              </div>
            </li>
          <?php endif; ?>

          <li class="nav-item">
            <a href="<?= base_url('settings') ?>" class="nav-link">
              <i class="fas fa-cog"></i>
              <span>Pengaturan</span>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?= base_url('logout') ?>" class="nav-link">
              <i class="fas fa-sign-out-alt"></i>
              <span>Keluar</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="sidebar-footer">
      <p>&copy; 2024 Politeknik Negeri Bandung<br>Kampus Berkelanjutan</p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="topbar">
      <h3>Edit User</h3>
    </div>

    <div class="content">
      <div class="card">
        <form action="<?= base_url('users/update/' . $user['id']) ?>" method="post">
          <?= csrf_field() ?>

          <label for="name">Nama</label>
          <input type="text" id="name" name="name" value="<?= old('name', $user['name']) ?>">
          <?php if (isset($validation) && $validation->hasError('name')): ?>
            <div class="error"><?= $validation->getError('name') ?></div>
          <?php endif; ?>

          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?= old('email', $user['email']) ?>">
          <?php if (isset($validation) && $validation->hasError('email')): ?>
            <div class="error"><?= $validation->getError('email') ?></div>
          <?php endif; ?>

          <label for="role">Role</label>
          <select name="role" id="role">
            <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin Pusat</option>
            <option value="admin_unit" <?= $user['role'] === 'admin_unit' ? 'selected' : '' ?>>Admin Unit</option>
            <option value="kaprodi" <?= $user['role'] === 'kaprodi' ? 'selected' : '' ?>>Kaprodi</option>
            <option value="dosen" <?= $user['role'] === 'dosen' ? 'selected' : '' ?>>Dosen</option>
          </select>
          <?php if (isset($validation) && $validation->hasError('role')): ?>
            <div class="error"><?= $validation->getError('role') ?></div>
          <?php endif; ?>

          <!-- Field Unit - Conditional untuk Admin Unit -->
          <div id="unit-field" style="<?= $user['role'] === 'admin_unit' ? '' : 'display:none;' ?>">
            <label for="unit">Unit</label>
            <select name="unit" id="unit">
              <option value="">-- Pilih Unit --</option>
              <option value="sarpras" <?= isset($user['unit']) && $user['unit'] === 'sarpras' ? 'selected' : '' ?>>Sarpras</option>
              <option value="lppm" <?= isset($user['unit']) && $user['unit'] === 'lppm' ? 'selected' : '' ?>>LPPM</option>
              <option value="umum" <?= isset($user['unit']) && $user['unit'] === 'umum' ? 'selected' : '' ?>>Umum</option>
            </select>
            <?php if (isset($validation) && $validation->hasError('unit')): ?>
              <div class="error"><?= $validation->getError('unit') ?></div>
            <?php endif; ?>
          </div>

          <!-- Field Program Studi - Conditional untuk Kaprodi dan Dosen -->
          <div id="prodi-field" style="<?= in_array($user['role'], ['kaprodi', 'dosen']) ? '' : 'display:none;' ?>">
            <label for="prodi_id">Program Studi</label>
            <select name="prodi_id" id="prodi_id">
              <option value="">-- Pilih Program Studi --</option>
              <?php if (isset($prodi) && is_array($prodi)): ?>
                <?php
                $currentJenjang = '';
                foreach ($prodi as $p):
                  if ($currentJenjang !== $p['jenjang']):
                    if ($currentJenjang !== '') echo '</optgroup>';
                    echo '<optgroup label="' . $p['jenjang'] . '">';
                    $currentJenjang = $p['jenjang'];
                  endif;
                ?>
                  <option value="<?= $p['id'] ?>" <?= isset($user['prodi_id']) && $user['prodi_id'] == $p['id'] ? 'selected' : '' ?>>
                    <?= esc($p['nama_prodi']) ?>
                  </option>
                <?php endforeach; ?>
                <?php if ($currentJenjang !== '') echo '</optgroup>'; ?>
              <?php endif; ?>
            </select>
            <?php if (isset($validation) && $validation->hasError('prodi_id')): ?>
              <div class="error"><?= $validation->getError('prodi_id') ?></div>
            <?php endif; ?>
          </div>

          <div style="margin-top:20px;padding:15px;background:#f8f9fa;border-radius:8px;border-left:4px solid #f1c40f;max-width:500px;margin-left:auto;margin-right:auto;">
            <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
              <input type="checkbox" id="change-password-checkbox" style="width:auto;cursor:pointer;transform:scale(1.2);">
              <span style="font-weight:600;color:#f39c12;font-size:15px;">
                <i class="fa fa-key"></i> Ganti Password
              </span>
            </label>
            <small style="color:#666;display:block;margin-top:8px;margin-left:30px;">
              <i class="fa fa-info-circle"></i> Centang jika ingin mengubah password user
            </small>
          </div>

          <div id="password-fields" style="display:none;margin-top:15px;padding:20px;background:#fff3cd;border-radius:8px;max-width:500px;margin-left:auto;margin-right:auto;">
            <div style="margin-bottom:15px;">
              <label for="new_password" style="display:block;margin-bottom:8px;color:#856404;font-weight:600;">
                <i class="fa fa-lock"></i> Password Baru
              </label>
              <input type="password" id="new_password" name="new_password" placeholder="Masukkan password baru" style="width:100%;padding:10px;border:2px solid #ffc107;border-radius:6px;font-size:14px;">
            </div>

            <div style="margin-bottom:15px;">
              <label for="confirm_password" style="display:block;margin-bottom:8px;color:#856404;font-weight:600;">
                <i class="fa fa-lock"></i> Konfirmasi Password
              </label>
              <input type="password" id="confirm_password" name="confirm_password" placeholder="Konfirmasi password baru" style="width:100%;padding:10px;border:2px solid #ffc107;border-radius:6px;font-size:14px;">
            </div>

            <div style="background:#fff;padding:10px;border-radius:6px;border-left:4px solid #ffc107;">
              <small style="color:#856404;display:block;">
                <i class="fa fa-info-circle"></i> <strong>Catatan:</strong> Password minimal 6 karakter
              </small>
            </div>
          </div>

          <div style="display:flex;gap:10px;margin-top:20px;">
            <button type="submit" class="btn btn-save"><i class="fa fa-save"></i> Simpan Perubahan</button>
            <a href="<?= base_url('users') ?>" class="btn btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
          </div>
        </form>

        <script>
          // Toggle conditional fields based on role
          document.getElementById('role').addEventListener('change', function() {
            const unitField = document.getElementById('unit-field');
            const unitSelect = document.getElementById('unit');
            const prodiField = document.getElementById('prodi-field');
            const prodiSelect = document.getElementById('prodi_id');

            // Reset all fields
            unitField.style.display = 'none';
            prodiField.style.display = 'none';
            unitSelect.required = false;
            prodiSelect.required = false;

            // Show appropriate fields based on role
            if (this.value === 'admin_unit') {
              unitField.style.display = 'block';
              unitSelect.required = true;
            } else if (this.value === 'kaprodi' || this.value === 'dosen') {
              prodiField.style.display = 'block';
              prodiSelect.required = true;
            } else {
              // Reset values when hiding fields
              unitSelect.value = '';
              prodiSelect.value = '';
            }
          });

          // Toggle password fields
          document.getElementById('change-password-checkbox').addEventListener('change', function() {
            const passwordFields = document.getElementById('password-fields');
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('confirm_password');

            if (this.checked) {
              passwordFields.style.display = 'block';
              newPassword.required = true;
              confirmPassword.required = true;
            } else {
              passwordFields.style.display = 'none';
              newPassword.required = false;
              confirmPassword.required = false;
              newPassword.value = '';
              confirmPassword.value = '';
            }
          });
        </script>
      </div>
    </div>
  </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>