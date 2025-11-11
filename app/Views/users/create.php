<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah User - UI Green Metric</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      font-family: "Poppins", sans-serif;
      background: #f7fdf9;
      color: #333;
      margin: 0;
    }
    .layout {
      display: flex;
      min-height: 100vh;
    }
    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #009b4c;
      color: #fff;
      display: flex;
      flex-direction: column;
      position: fixed;
      height: 100vh;
    }
    .sidebar-header {
      text-align: center;
      padding: 20px 0;
      font-weight: bold;
      font-size: 1.3rem;
      background-color: #00813f;
      border-bottom: 1px solid #007a3c;
    }
    .menu {
      list-style: none;
      padding: 0;
      margin-top: 10px;
    }
    .menu li {
      padding: 15px 25px;
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      transition: all 0.3s ease;
      border-left: 4px solid transparent;
    }
    .menu li:hover,
    .menu li.active {
      background-color: #006e33;
      border-left-color: #00ff88;
    }

    /* Main content */
    .main-content {
      flex: 1;
      margin-left: 250px;
      width: calc(100% - 250px);
    }
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 15px 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
      border-bottom: 1px solid #eaeaea;
    }
    .topbar h3 {
      color: #009b4c;
      margin: 0;
      font-size: 1.5rem;
      font-weight: 600;
    }

    /* Form container */
    .content {
      padding: 30px;
    }
    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      padding: 30px;
      max-width: 600px;
      margin: 0 auto;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: 500;
    }
    input, select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 8px;
      outline: none;
      font-size: 0.95rem;
    }
    input:focus, select:focus {
      border-color: #009b4c;
      box-shadow: 0 0 5px rgba(0,155,76,0.3);
    }
    .actions {
      display: flex;
      justify-content: space-between;
      margin-top: 25px;
    }
    .btn {
      border: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      font-size: 0.95rem;
      transition: 0.3s;
    }
    .btn-save {
      background: #009b4c;
      color: #fff;
    }
    .btn-save:hover { background: #007d3d; }
    .btn-cancel {
      background: #bdc3c7;
      color: #fff;
    }
    .btn-cancel:hover { background: #9ea4a7; }
    .error {
      color: #e74c3c;
      font-size: 0.9rem;
      margin-top: 5px;
    }
  </style>
</head>
<body>
  <div class="layout">
    <!-- Sidebar -->
    <div class="sidebar">
      <div class="sidebar-header">UI Green Metric</div>
      <ul class="menu">
        <li><a href="<?= base_url('dashboard') ?>" style="color:white;text-decoration:none;"><i class="fa fa-home"></i> Dashboard</a></li>
        <li class="active"><a href="<?= base_url('users') ?>" style="color:white;text-decoration:none;"><i class="fa fa-users"></i> Manajemen User</a></li>
      </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
      <div class="topbar">
        <h3>Tambah User</h3>
      </div>
      <div class="content">
        <div class="card">
          <?php if (isset($validation)): ?>
            <div class="error"><?= $validation->listErrors() ?></div>
          <?php endif; ?>

          <form action="<?= base_url('users/store') ?>" method="post">
            <?= csrf_field() ?>

            <label>Nama</label>
            <input type="text" name="name" value="<?= old('name') ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= old('email') ?>" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <label>Role</label>
            <select name="role" required>
              <option value="">-- Pilih Role --</option>
              <option value="admin">Admin</option>
              <option value="dosen">Dosen</option>
              <option
