<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen User - UI Green Metric</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background-color: #f7fdf9;
    }

    /* Layout */
    .layout {
      display: flex;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      height: 100vh;
      background-color: #009b4c;
      color: #fff;
      display: flex;
      flex-direction: column;
    }

    .sidebar-header {
      text-align: center;
      padding: 20px 0;
      font-weight: bold;
      font-size: 1.3rem;
      background-color: #00813f;
    }

    .menu {
      list-style: none;
      padding: 0;
      margin-top: 10px;
    }

    .menu li {
      padding: 15px 25px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .menu li:hover,
    .menu li.active {
      background-color: #006e33;
    }

    /* Topbar */
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 15px 25px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .topbar h3 {
      color: #009b4c;
      margin: 0;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .user-info img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
    }

    /* Content */
    .content {
      flex: 1;
      padding: 20px 30px;
    }

    .card {
      background-color: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      padding: 20px;
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .btn-primary {
      background-color: #009b4c;
      color: white;
      border: none;
      padding: 10px 16px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
    }

    .btn-primary:hover {
      background-color: #007a3c;
    }

    /* Table */
    .table {
      width: 100%;
      border-collapse: collapse;
    }

    .table th, .table td {
      padding: 12px 16px;
      text-align: left;
    }

    .table thead {
      background-color: #e7f8ee;
    }

    .table tr:nth-child(even) {
      background-color: #f5fdf8;
    }

    .btn-edit {
      background-color: #ffc107;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      color: white;
      cursor: pointer;
    }

    .btn-delete {
      background-color: #dc3545;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      color: white;
      cursor: pointer;
    }

    /* Switch */
    .switch {
      position: relative;
      display: inline-block;
      width: 44px;
      height: 24px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0; left: 0;
      right: 0; bottom: 0;
      background-color: #ccc;
      transition: 0.4s;
      border-radius: 24px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: 0.4s;
      border-radius: 50%;
    }

    input:checked + .slider {
      background-color: #009b4c;
    }

    input:checked + .slider:before {
      transform: translateX(20px);
    }
  </style>
</head>
<body>
  <div class="layout">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <h2>UI Green Metric</h2>
      </div>
      <ul class="menu">
        <li><i class="fa fa-chart-line"></i> Dashboard</li>
        <li class="active"><i class="fa fa-users"></i> Manajemen User</li>
        <li><i class="fa fa-file-alt"></i> Laporan</li>
        <li><i class="fa fa-cog"></i> Pengaturan</li>
      </ul>
    </aside>

    <!-- Main content -->
    <main class="content">
      <header class="topbar">
        <h3>Manajemen User</h3>
        <div class="user-info">
          <span>Admin</span>
          <img src="https://ui-avatars.com/api/?name=Admin&background=009B4C&color=fff" alt="Admin">
        </div>
      </header>

      <div class="card">
        <div class="card-header">
          <h4>Daftar User</h4>
          <button class="btn-primary"><i class="fa fa-plus"></i> Tambah User</button>
        </div>

        <table class="table">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Nabil Muhammad</td>
              <td>sayang@gmail.com</td>
              <td>Admin</td>
              <td><label class="switch"><input type="checkbox" checked><span class="slider"></span></label></td>
              <td>
                <button class="btn-edit"><i class="fa fa-pen"></i></button>
                <button class="btn-delete"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
            <tr>
              <td>Habib</td>
              <td>habibtino83@gmail.com</td>
              <td>Dosen</td>
              <td><label class="switch"><input type="checkbox"><span class="slider"></span></label></td>
              <td>
                <button class="btn-edit"><i class="fa fa-pen"></i></button>
                <button class="btn-delete"><i class="fa fa-trash"></i></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>
</body>
</html>
