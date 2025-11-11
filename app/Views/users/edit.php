<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit User - UI Green Metric</title>
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
    .card{background:#fff;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.08);padding:25px;max-width:600px;margin:auto}
    label{display:block;margin-top:10px;font-weight:600;color:#009b4c}
    input,select{width:100%;padding:8px;margin-top:5px;border:1px solid #ccc;border-radius:6px}
    .btn{padding:8px 14px;border:none;border-radius:6px;color:#fff;cursor:pointer;margin-top:15px}
    .btn-save{background:#009b4c}
    .btn-back{background:#bdc3c7;text-decoration:none;display:inline-block;text-align:center}
    .error{color:#e74c3c;font-size:0.9rem;margin-top:5px}
    .topbar h3{color:#009b4c;font-weight:600}
  </style>
</head>
<body>
  <div class="layout">
    <div class="sidebar">
      <div class="sidebar-header">UI Green Metric</div>
      <ul class="menu">
        <li><i class="fa fa-users"></i> <a href="<?= base_url('users') ?>" style="color:white;text-decoration:none;">Manajemen User</a></li>
      </ul>
    </div>

    <div class="main-content">
      <div class="topbar">
        <h3>Edit User</h3>
      </div>

      <div class="content">
        <div class="card">
          <form action="<?= base_url('users/update/'.$user['id']) ?>" method="post">
            <?= csrf_field() ?>
            
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" value="<?= old('name', $user['name']) ?>">
            <?php if(isset($validation) && $validation->hasError('name')): ?>
              <div class="error"><?= $validation->getError('name') ?></div>
            <?php endif; ?>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= old('email', $user['email']) ?>">
            <?php if(isset($validation) && $validation->hasError('email')): ?>
              <div class="error"><?= $validation->getError('email') ?></div>
            <?php endif; ?>

            <label for="role">Role</label>
            <select name="role" id="role">
              <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
              <option value="dosen" <?= $user['role'] === 'dosen' ? 'selected' : '' ?>>Dosen</option>
              <option value="kaprodi" <?= $user['role'] === 'kaprodi' ? 'selected' : '' ?>>Kaprodi</option>
              <option value="mahasiswa" <?= $user['role'] === 'mahasiswa' ? 'selected' : '' ?>>Mahasiswa</option>
            </select>
            <?php if(isset($validation) && $validation->hasError('role')): ?>
              <div class="error"><?= $validation->getError('role') ?></div>
            <?php endif; ?>

            <div style="display:flex;gap:10px;margin-top:20px;">
              <button type="submit" class="btn btn-save"><i class="fa fa-save"></i> Simpan Perubahan</button>
              <a href="<?= base_url('users') ?>" class="btn btn-back"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
