<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen User - UI Green Metric</title>
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
    
    /* Sidebar Styles */
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
      box-shadow: 4px 0 15px rgba(0,0,0,0.2);
      transition: all 0.3s ease;
    }
    
    .sidebar::-webkit-scrollbar {
      width: 6px;
    }
    
    .sidebar::-webkit-scrollbar-track {
      background: rgba(255,255,255,0.1);
    }
    
    .sidebar::-webkit-scrollbar-thumb {
      background: rgba(255,255,255,0.3);
      border-radius: 3px;
    }
    
    .sidebar-header {
      padding: 25px 20px;
      background: rgba(0,0,0,0.2);
      border-bottom: 1px solid rgba(255,255,255,0.1);
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
      color: rgba(255,255,255,0.7);
      font-size: 13px;
      margin: 5px 0 0;
    }
    
    .nav-section {
      margin-bottom: 5px;
    }
    
    .nav-section-title {
      padding: 15px 20px 8px;
      color: rgba(255,255,255,0.5);
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
      color: rgba(255,255,255,0.8);
      text-decoration: none;
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
      position: relative;
    }
    
    .nav-link:hover {
      background-color: rgba(255,255,255,0.1);
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
      color: rgba(255,255,255,0.7);
    }
    
    .collapse .nav-link:hover {
      color: white;
      background-color: rgba(255,255,255,0.08);
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
      color: rgba(255,255,255,0.8) !important;
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
      border-top: 1px solid rgba(255,255,255,0.1);
      background: rgba(0,0,0,0.2);
    }
    
    .sidebar-footer p {
      color: rgba(255,255,255,0.5);
      font-size: 11px;
      margin: 0;
      text-align: center;
    }
    
    /* Main Content Styles */
    .main-content {
      margin-left: 280px;
      padding: 20px;
      min-height: 100vh;
      transition: all 0.3s ease;
    }
    
    /* Top Bar */
    .topbar {
      background: white;
      padding: 20px 30px;
      border-radius: 15px;
      margin-bottom: 25px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
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
    
    .user-info {
      display: flex;
      align-items: center;
      gap: 15px;
    }
    
    .user-details {
      text-align: right;
    }
    
    .user-details .name {
      font-weight: 600;
      color: #333;
      font-size: 14px;
    }
    
    .user-details .role {
      font-size: 12px;
      color: #999;
      text-transform: capitalize;
    }
    
    .user-avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-weight: 700;
      font-size: 18px;
      box-shadow: 0 2px 10px rgba(102, 126, 234, 0.4);
    }
    
    /* Bell Notification */
    .notification-bell {
      position: relative;
      cursor: pointer;
    }
    
    .notification-bell .fa-bell {
      transition: all 0.3s ease;
    }
    
    .notification-bell .fa-bell:hover {
      color: #667eea !important;
      transform: scale(1.1);
    }
    
    .notification-bell .badge {
      font-size: 0.65rem;
      padding: 0.25em 0.5em;
      animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
      0%, 100% {
        transform: scale(1);
      }
      50% {
        transform: scale(1.1);
      }
    }
    
    .content {
      padding: 0;
    }
    
    .card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      padding: 25px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    
    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #e0e0e0;
    }
    
    th {
      background: #009b4c;
      color: #fff;
    }
    
    tr:hover {
      background: #f5fff8;
    }
    
    .btn {
      padding: 6px 12px;
      border: none;
      border-radius: 5px;
      color: #fff;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }
    
    .btn-add {
      background: #009b4c;
      margin-bottom: 10px;
    }
    
    .btn-edit {
      background: #f1c40f;
    }
    
    .btn-delete {
      background: #e74c3c;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
      }
      
      .sidebar-header h4,
      .sidebar-header p,
      .nav-link span,
      .nav-section-title {
        display: none;
      }
      
      .sidebar-logo {
        justify-content: center;
      }
      
      .sidebar-header {
        padding: 20px 10px;
      }
      
      .nav-link {
        justify-content: center;
        padding: 14px 10px;
      }
      
      .nav-link i {
        margin-right: 0;
      }
      
      .main-content {
        margin-left: 70px;
      }
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
          $user_role = isset($user_role) ? $user_role : session()->get('role');
          if($user_role == 'admin'): 
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
      <p>&copy; 2024 Politeknik Negeri Bandung<br>Renstra TMKB 2024-2028</p>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-content">
      <div class="topbar">
        <h3>Manajemen User</h3>
        <div class="user-info">
          <div class="notification-bell" style="position: relative; margin-right: 20px;">
            <a href="#" style="color: #333; text-decoration: none; position: relative;">
              <i class="fas fa-bell" style="font-size: 1.5rem;"></i>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none; font-size: 0.7rem;">
                0
              </span>
            </a>
          </div>
          <div class="user-details">
            <div class="name"><?= isset($user_name) ? esc($user_name) : session()->get('name') ?></div>
            <div class="role"><?= isset($user_role) ? esc($user_role) : session()->get('role') ?></div>
          </div>
          <div class="user-avatar" style="overflow: hidden;">
            <?php if(!empty($profile_photo) && file_exists(FCPATH . 'uploads/profiles/' . $profile_photo)): ?>
              <img src="<?= base_url('uploads/profiles/' . $profile_photo) ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
            <?php else: ?>
              <?= isset($user_name) ? strtoupper(substr($user_name, 0, 1)) : strtoupper(substr(session()->get('name'), 0, 1)) ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="content">
       <div class="card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <div>
      <input type="text" id="searchInput" placeholder="Cari nama atau email..." style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 5px; width: 300px;">
    </div>
    <a href="<?= base_url('users/create') ?>" class="btn btn-add" style="background:#009b4c;color:#fff;">
      <i class="fa fa-plus"></i> Tambah User
    </a>
  </div>

          <?php if(session()->getFlashdata('success')): ?>
            <div style="color:green;"><?= session()->getFlashdata('success') ?></div>
          <?php elseif(session()->getFlashdata('error')): ?>
            <div style="color:red;"><?= session()->getFlashdata('error') ?></div>
          <?php endif; ?>

          <table>
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Jurusan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($users)): ?>
                <?php foreach ($users as $u): ?>
                  <tr>
                    <td><?= esc($u['id']) ?></td>
                    <td><?= esc($u['name']) ?></td>
                    <td><?= esc($u['email']) ?></td>
                    <td><?= esc($u['role']) ?></td>
                    <td><?= isset($u['jurusan']) && $u['jurusan'] ? esc($u['jurusan']) : '-' ?></td>
                    <td>
                      <a href="<?= base_url('users/edit/'.$u['id']) ?>" class="btn btn-edit"><i class="fa fa-edit"></i></a>
                      <a href="<?= base_url('users/delete/'.$u['id']) ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin hapus user ini?')"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="6" style="text-align:center;">Belum ada data user</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Simple search functionality
    const searchInput = document.getElementById('searchInput');
    const tableRows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('keyup', function() {
      const searchTerm = this.value.toLowerCase();
      let visibleCount = 0;

      tableRows.forEach(row => {
        // Skip "no data" row
        if (row.cells.length === 1) return;

        const name = row.cells[1].textContent.toLowerCase();
        const email = row.cells[2].textContent.toLowerCase();

        // Check search term
        if (searchTerm === '' || name.includes(searchTerm) || email.includes(searchTerm)) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      });

      // Show "no results" message if needed
      updateNoResultsMessage(visibleCount);
    });

    // Update no results message
    function updateNoResultsMessage(visibleCount) {
      const tbody = document.querySelector('tbody');
      let noResultsRow = document.getElementById('no-results-row');

      if (visibleCount === 0) {
        if (!noResultsRow) {
          noResultsRow = document.createElement('tr');
          noResultsRow.id = 'no-results-row';
          noResultsRow.innerHTML = '<td colspan="6" style="text-align:center; padding: 20px; color: #999;">Tidak ada data yang sesuai dengan pencarian</td>';
          tbody.appendChild(noResultsRow);
        }
        noResultsRow.style.display = '';
      } else {
        if (noResultsRow) {
          noResultsRow.style.display = 'none';
        }
      }
    }
  </script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
