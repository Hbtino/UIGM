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
    .sidebar{width:250px;background:#009b4c;color:#fff;position:fixed;height:100vh}
    .sidebar-header{text-align:center;padding:20px 0;font-weight:bold;font-size:1.3rem;background:#00813f}
    .menu{list-style:none;margin:10px 0;padding:0}
    .menu li{padding:15px 25px;cursor:pointer;display:flex;align-items:center;gap:10px;transition:0.3s}
    .menu li.active,.menu li:hover{background:#006e33;border-left:4px solid #00ff88}
    .main-content{margin-left:250px;width:calc(100% - 250px)}
    .topbar{display:flex;justify-content:space-between;align-items:center;background:#fff;padding:15px 25px;box-shadow:0 2px 10px rgba(0,0,0,0.08)}
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
        <li class="active"><i class="fa fa-users"></i> Manajemen User</li>
      </ul>
    </div>

    <div class="main-content">
      <div class="topbar">
        <h3>Manajemen User</h3>
      </div>
      <div class="content">
       <div class="card">
  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
    <a href="<?= base_url('dashboard') ?>" class="btn btn-cancel" style="background:#6c757d;">
      <i class="fa fa-home"></i> Dashboard
    </a>
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
                    <td>
                      <a href="<?= base_url('users/edit/'.$u['id']) ?>" class="btn btn-edit"><i class="fa fa-edit"></i></a>
                      <a href="<?= base_url('users/delete/'.$u['id']) ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin hapus user ini?')"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr><td colspan="5" style="text-align:center;">Belum ada data user</td></tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
