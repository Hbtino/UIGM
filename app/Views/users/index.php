<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen User - UI Green Metric</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body{font-family:"Poppins",sans-serif;background:#f7fdf9;color:#333}
    .layout{display:flex;min-height:100vh}
    .sidebar{width:250px;background:linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);color:#fff;position:fixed;height:100vh;box-shadow:4px 0 15px rgba(0,0,0,0.2)}
    .sidebar-header{text-align:center;padding:20px 0;font-weight:bold;font-size:1.3rem;background:rgba(0,0,0,0.2);border-bottom:1px solid rgba(255,255,255,0.1)}
    .menu{list-style:none;margin:10px 0;padding:0}
    .menu li{padding:15px 25px;cursor:pointer;display:flex;align-items:center;gap:10px;transition:0.3s}
    .menu li.active,.menu li:hover{background:rgba(255,255,255,0.1);border-left:4px solid #4CAF50}
    .main-content{margin-left:250px;width:calc(100% - 250px)}
    .topbar{display:flex;justify-content:space-between;align-items:center;background:#fff;padding:15px 25px;box-shadow:0 2px 10px rgba(0,0,0,0.08)}
    .user-info{display:flex;align-items:center;gap:15px}
    .user-details{text-align:right}
    .user-details .name{font-weight:600;color:#333;font-size:14px}
    .user-details .role{font-size:12px;color:#999;text-transform:capitalize}
    .user-avatar{width:45px;height:45px;border-radius:50%;background:linear-gradient(135deg, #667eea 0%, #764ba2 100%);display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:18px;box-shadow:0 2px 10px rgba(102, 126, 234, 0.4)}
    .notification-bell .fa-bell{transition:all 0.3s ease}
    .n
    .content{padding:25px 30px}
    .card{background:#fff;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.08);padding:25px}
    table{width:100%;border-collapse:collapse;margin-top:15px}
    th,td{padding:10px;text-align:left;border-bottom:1px solid #e0e0e0}
    th{background:#009b4c;color:#fff}
    tr:hover{background:#f5fff8}
    .btn{padding:6px 12px;border:none;border-radius:5px;color:#fff;cursor:pointer}
    .btn-add{background:#009b4c;margin-bottom:10px}
    .btn-edit{background:#f1c40f}
    .btn-delete{background:#e74c3c}
  </style>
</head>
<body>
  <div class="layout">
    <div class="sidebar">
      <div class="sidebar-header">UI Green Metric</div>
      <ul class="menu">
        <li onclick="window.location.href='<?= base_url('dashboard') ?>'"><i class="fa fa-home"></i> Dashboard</li>
        <li class="active"><i class="fa fa-users"></i> Manajemen User</li>
      </ul>
    </div>

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
</body>
</html>
