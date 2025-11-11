<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen User - UI Green Metric</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    /* Reset dan Base Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "Poppins", Arial, sans-serif;
      background-color: #f7fdf9;
      color: #333;
      line-height: 1.6;
    }

    /* Layout */
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
      left: 0;
      top: 0;
      z-index: 1000;
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
      flex: 1;
    }

    .menu li {
      padding: 15px 25px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.3s ease;
      border-left: 4px solid transparent;
    }

    .menu li:hover {
      background-color: #006e33;
      border-left-color: #00ff88;
    }

    .menu li.active {
      background-color: #006e33;
      border-left-color: #00ff88;
      font-weight: 600;
    }

    /* Main Content Area */
    .main-content {
      flex: 1;
      margin-left: 250px;
      width: calc(100% - 250px);
    }

    /* Topbar */
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #fff;
      padding: 15px 25px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.08);
      position: sticky;
      top: 0;
      z-index: 999;
      border-bottom: 1px solid #eaeaea;
    }

    .topbar h3 {
      color: #009b4c;
      margin: 0;
      font-size: 1.5rem;
      font-weight: 600;
    }

    .user-info {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 5px 12px;
      border-radius: 20px;
      background-color: #f0f9f4;
    }

    .user-info span {
      font-weight: 500;
      color: #009b4c;
    }

    .user-info img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      border: 2px solid #009b4c;
    }

    /* Content */
    .content {
      padding: 25px 30px;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      padding: 25px;
      margin-bottom: 25px;
      border: 1px solid #eaeaea;
    }

    .card-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 2px solid #f0f9f4;
    }

    .card-header h4 {
      color: #009b4c;
      font-size: 1.3rem;
      font-weight: 600;
      margin: 0;
    }

    .btn-primary {
      background: linear-gradient(135deg, #009b4c, #00c853);
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0,155,76,0.3);
    }

    .btn-primary:hover {
      background: linear-gradient(135deg, #007a3c, #009b4c);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,155,76,0.4);
    }

    /* Table */
    .table-container {
      overflow-x: auto;
      border-radius: 8px;
      border: 1px solid #eaeaea;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }

    .table th {
      background: linear-gradient(135deg, #e7f8ee, #d0f0e0);
      color: #009b4c;
      font-weight: 600;
      padding: 16px 20px;
      text-align: left;
      border-bottom: 2px solid #009b4c;
    }

    .table td {
      padding: 14px 20px;
      text-align: left;
      border-bottom: 1px solid #f0f0f0;
    }

    .table tr {
      transition: background-color 0.2s ease;
    }

    .table tr:hover {
      background-color: #f8fdf9;
    }

    .table tr:nth-child(even) {
      background-color: #fafefa;
    }

    .table tr:nth-child(even):hover {
      background-color: #f0f9f4;
    }

    /* Action Buttons */
    .btn-edit {
      background: linear-gradient(135deg, #ffc107, #ffb300);
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      color: white;
      cursor: pointer;
      margin-right: 5px;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(255,193,7,0.3);
    }

    .btn-edit:hover {
      background: linear-gradient(135deg, #e0a800, #ffc107);
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(255,193,7,0.4);
    }

    .btn-delete {
      background: linear-gradient(135deg, #dc3545, #c82333);
      border: none;
      padding: 8px 12px;
      border-radius: 6px;
      color: white;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 2px 5px rgba(220,53,69,0.3);
    }

    .btn-delete:hover {
      background: linear-gradient(135deg, #c82333, #dc3545);
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(220,53,69,0.4);
    }

    /* Role Badge */
    .role-badge {
      display: inline-block;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 500;
      text-transform: capitalize;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .role-admin {
      background: linear-gradient(135deg, #e7f8ee, #c8f0d8);
      color: #009b4c;
      border: 1px solid #b8e8c8;
    }

    .role-kaprodi {
      background: linear-gradient(135deg, #e7f1ff, #d0e3ff);
      color: #0066cc;
      border: 1px solid #b8d4ff;
    }

    .role-dosen {
      background: linear-gradient(135deg, #fff3cd, #ffeaa7);
      color: #856404;
      border: 1px solid #ffe082;
    }

    .role-mahasiswa {
      background: linear-gradient(135deg, #f8f9fa, #e9ecef);
      color: #6c757d;
      border: 1px solid #dee2e6;
    }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      z-index: 2000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.6);
      backdrop-filter: blur(5px);
    }

    .modal-content {
      background-color: white;
      margin: 5% auto;
      padding: 0;
      border-radius: 12px;
      width: 450px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      animation: modalSlideIn 0.3s ease-out;
    }

    @keyframes modalSlideIn {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .modal-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 20px 25px;
      background: linear-gradient(135deg, #009b4c, #00c853);
      border-radius: 12px 12px 0 0;
      color: white;
    }

    .modal-header h4 {
      margin: 0;
      font-size: 1.3rem;
      font-weight: 600;
    }

    .close {
      color: white;
      font-size: 28px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
    }

    .close:hover {
      background-color: rgba(255,255,255,0.2);
      transform: rotate(90deg);
    }

    .modal-body {
      padding: 25px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
      color: #555;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 15px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 1rem;
      transition: all 0.3s ease;
      background-color: #fafafa;
    }

    .form-group input:focus,
    .form-group select:focus {
      outline: none;
      border-color: #009b4c;
      background-color: white;
      box-shadow: 0 0 0 3px rgba(0,155,76,0.1);
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 12px;
      margin-top: 25px;
      padding-top: 20px;
      border-top: 1px solid #eaeaea;
    }

    .btn-cancel {
      background-color: #6c757d;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-cancel:hover {
      background-color: #5a6268;
      transform: translateY(-1px);
    }

    .btn-save {
      background: linear-gradient(135deg, #009b4c, #00c853);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-save:hover {
      background: linear-gradient(135deg, #007a3c, #009b4c);
      transform: translateY(-1px);
    }

    /* Toast Notification */
    .toast {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      border-radius: 8px;
      color: white;
      font-weight: 500;
      z-index: 3000;
      opacity: 0;
      transition: all 0.3s ease;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      max-width: 350px;
    }

    .toast.success {
      background: linear-gradient(135deg, #28a745, #20c997);
    }

    .toast.error {
      background: linear-gradient(135deg, #dc3545, #e83e8c);
    }

    .toast.show {
      opacity: 1;
      transform: translateX(0);
    }

    /* Loading Animation */
    .loading {
      display: inline-block;
      width: 20px;
      height: 20px;
      border: 3px solid rgba(255,255,255,0.3);
      border-top: 3px solid #ffffff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
        overflow: hidden;
      }
      
      .sidebar-header h2,
      .menu li span {
        display: none;
      }
      
      .main-content {
        margin-left: 70px;
        width: calc(100% - 70px);
      }
      
      .content {
        padding: 15px;
      }
      
      .modal-content {
        width: 95%;
        margin: 10% auto;
      }
      
      .card-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
      }
    }

    /* Date Column */
    .date-cell {
      font-size: 0.9rem;
      color: #666;
      white-space: nowrap;
    }

    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 40px 20px;
      color: #666;
    }

    .empty-state i {
      font-size: 3rem;
      color: #ccc;
      margin-bottom: 15px;
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
        <li><i class="fa fa-chart-line"></i> <span>Dashboard</span></li>
        <li class="active"><i class="fa fa-users"></i> <span>Manajemen User</span></li>
        <li><i class="fa fa-file-alt"></i> <span>Laporan</span></li>
        <li><i class="fa fa-cog"></i> <span>Pengaturan</span></li>
      </ul>
    </aside>

    <!-- Main content -->
    <div class="main-content">
      <header class="topbar">
        <h3>Manajemen User</h3>
        <div class="user-info">
          <span>Admin</span>
          <img src="https://ui-avatars.com/api/?name=Admin&background=009B4C&color=fff" alt="Admin">
        </div>
      </header>

      <div class="content">
        <div class="card">
          <div class="card-header">
            <h4>Daftar User</h4>
            <button class="btn-primary" id="btnTambahUser">
              <i class="fa fa-plus"></i> Tambah User
            </button>
          </div>

          <div class="table-container">
            <table class="table" id="userTable">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Tanggal Dibuat</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="userTableBody">
                <?php
                // Koneksi ke database
                $host = '127.0.0.1';
                $dbname = 'capaian_kinerja';
                $username = 'root';
                $password = '';

                try {
                    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $pdo->query("SELECT id, name, email, role, created_at FROM users ORDER BY created_at DESC");
                    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if (count($users) > 0) {
                        foreach ($users as $user) {
                            $roleClass = 'role-' . $user['role'];
                            $createdDate = date('d M Y', strtotime($user['created_at']));
                            
                            echo "
                            <tr>
                              <td>{$user['name']}</td>
                              <td>{$user['email']}</td>
                              <td><span class='role-badge $roleClass'>{$user['role']}</span></td>
                              <td class='date-cell'>{$createdDate}</td>
                              <td>
                                <button class='btn-edit' data-id='{$user['id']}'><i class='fa fa-pen'></i></button>
                                <button class='btn-delete' data-id='{$user['id']}'><i class='fa fa-trash'></i></button>
                              </td>
                            </tr>
                            ";
                        }
                    } else {
                        echo "
                        <tr>
                          <td colspan='5' class='empty-state'>
                            <i class='fa fa-users'></i>
                            <p>Tidak ada data user</p>
                          </td>
                        </tr>
                        ";
                    }
                } catch(PDOException $e) {
                    echo "
                    <tr>
                      <td colspan='5' style='text-align: center; color: red; padding: 20px;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        <p>Error database: " . htmlspecialchars($e->getMessage()) . "</p>
                      </td>
                    </tr>
                    ";
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah/Edit User -->
  <div id="userModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h4 id="modalTitle">Tambah User</h4>
        <span class="close">&times;</span>
      </div>
      <div class="modal-body">
        <form id="userForm">
          <input type="hidden" id="userId" name="userId">
          <input type="hidden" name="action" id="action" value="add">
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name" required placeholder="Masukkan nama lengkap">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="Masukkan alamat email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Masukkan password">
            <small style="color: #666; font-size: 12px; display: block; margin-top: 5px;">
              Minimal 6 karakter (wajib untuk user baru)
            </small>
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
              <option value="">Pilih Role</option>
              <option value="admin">Admin</option>
              <option value="kaprodi">Kaprodi</option>
              <option value="dosen">Dosen</option>
              <option value="mahasiswa">Mahasiswa</option>
            </select>
          </div>
          <div class="form-actions">
            <button type="button" class="btn-cancel" id="btnCancel">Batal</button>
            <button type="submit" class="btn-save" id="btnSave">
              <span id="saveText">Simpan</span>
              <span id="saveLoading" class="loading" style="display: none;"></span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Toast Notification -->
  <div id="toast" class="toast"></div>

  <script>
    // Data sementara untuk testing
    const sampleUsers = {
      2: { id: 2, name: "nabil muhammad", email: "sayang@gmail.com", role: "admin" },
      5: { id: 5, name: "Habib", email: "habibtino83@gmail.com", role: "admin" },
      15: { id: 15, name: "Dosen", email: "dosen@gmail.com", role: "dosen" },
      16: { id: 16, name: "Kaprodi", email: "kaprodi@gmail.com", role: "kaprodi" },
      17: { id: 17, name: "lutung", email: "agus@gmail.com", role: "admin" },
      18: { id: 18, name: "Ahmad", email: "uncektayo2@gmail.com", role: "admin" }
    };

    // DOM Elements
    const userModal = document.getElementById('userModal');
    const userForm = document.getElementById('userForm');
    const modalTitle = document.getElementById('modalTitle');
    const btnTambahUser = document.getElementById('btnTambahUser');
    const btnCancel = document.getElementById('btnCancel');
    const closeBtn = document.querySelector('.close');
    const toast = document.getElementById('toast');
    const actionInput = document.getElementById('action');
    const btnSave = document.getElementById('btnSave');
    const saveText = document.getElementById('saveText');
    const saveLoading = document.getElementById('saveLoading');

    // Event Listeners
    document.addEventListener('DOMContentLoaded', function() {
      // Event delegation untuk tombol edit dan delete
      document.getElementById('userTableBody').addEventListener('click', function(e) {
        if (e.target.closest('.btn-edit')) {
          const userId = e.target.closest('.btn-edit').getAttribute('data-id');
          editUser(userId);
        }
        if (e.target.closest('.btn-delete')) {
          const userId = e.target.closest('.btn-delete').getAttribute('data-id');
          deleteUser(userId);
        }
      });
    });

    btnTambahUser.addEventListener('click', openAddModal);
    btnCancel.addEventListener('click', closeModal);
    closeBtn.addEventListener('click', closeModal);
    userForm.addEventListener('submit', function(e) {
      e.preventDefault();
      saveUser();
    });

    // Fungsi untuk membuka modal tambah user
    function openAddModal() {
      modalTitle.textContent = 'Tambah User';
      userForm.reset();
      document.getElementById('userId').value = '';
      document.getElementById('password').required = true;
      document.getElementById('password').placeholder = 'Masukkan password';
      actionInput.value = 'add';
      userModal.style.display = 'block';
    }

    // Fungsi untuk menutup modal
    function closeModal() {
      userModal.style.display = 'none';
    }

    // Fungsi untuk mengedit user
    async function editUser(userId) {
      const editButton = document.querySelector(`.btn-edit[data-id="${userId}"]`);
      const originalHTML = editButton.innerHTML;
      
      // Tampilkan loading
      editButton.innerHTML = '<div class="loading"></div>';
      editButton.disabled = true;

      try {
        let userData;
        
        // Coba ambil data dari backend
        try {
          const response = await fetch(`get_user.php?id=${userId}`);
          if (!response.ok) throw new Error('Network error');
          userData = await response.json();
        } catch (error) {
          console.warn('Backend error, using sample data:', error);
          // Fallback ke data sample jika backend error
          userData = sampleUsers[userId] || null;
        }

        if (userData && userData.id) {
          // Isi form dengan data user
          document.getElementById('userId').value = userData.id;
          document.getElementById('name').value = userData.name || '';
          document.getElementById('email').value = userData.email || '';
          document.getElementById('role').value = userData.role || '';
          document.getElementById('password').required = false;
          document.getElementById('password').placeholder = 'Kosongkan jika tidak ingin mengubah';
          actionInput.value = 'edit';
          modalTitle.textContent = 'Edit User';
          userModal.style.display = 'block';
        } else {
          throw new Error('Data user tidak ditemukan');
        }
      } catch (error) {
        console.error('Error:', error);
        showToast('Gagal memuat data user: ' + error.message, 'error');
      } finally {
        // Kembalikan tombol ke state semula
        editButton.innerHTML = originalHTML;
        editButton.disabled = false;
      }
    }

    // Fungsi untuk menyimpan user
    async function saveUser() {
      const formData = new FormData(userForm);
      const action = actionInput.value;

      // Validasi
      if (!validateForm()) {
        return;
      }

      // Tampilkan loading
      saveText.style.display = 'none';
      saveLoading.style.display = 'inline-block';
      btnSave.disabled = true;

      try {
        const response = await fetch('process_user.php', {
          method: 'POST',
          body: formData
        });

        let result;
        try {
          result = await response.json();
        } catch (e) {
          throw new Error('Invalid JSON response from server');
        }

        if (result.success) {
          showToast(result.message, 'success');
          setTimeout(() => location.reload(), 1500);
        } else {
          showToast(result.message, 'error');
        }
      } catch (error) {
        console.error('Error:', error);
        showToast('Terjadi kesalahan: ' + error.message, 'error');
      } finally {
        // Kembalikan tombol
        saveText.style.display = 'inline-block';
        saveLoading.style.display = 'none';
        btnSave.disabled = false;
      }
    }

    // Fungsi validasi form
    function validateForm() {
      const name = document.getElementById('name').value.trim();
      const email = document.getElementById('email').value.trim();
      const password = document.getElementById('password').value;
      const role = document.getElementById('role').value;
      const action = actionInput.value;

      if (!name) {
        showToast('Nama harus diisi', 'error');
        return false;
      }

      if (!email) {
        showToast('Email harus diisi', 'error');
        return false;
      }

      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
        showToast('Format email tidak valid', 'error');
        return false;
      }

      if (!role) {
        showToast('Role harus dipilih', 'error');
        return false;
      }

      if (action === 'add' && (!password || password.length < 6)) {
        showToast('Password minimal 6 karakter untuk user baru', 'error');
        return false;
      }

      if (action === 'edit' && password && password.length < 6) {
        showToast('Password minimal 6 karakter', 'error');
        return false;
      }

      return true;
    }

    // Fungsi untuk menghapus user
    async function deleteUser(userId) {
      if (!confirm('Apakah Anda yakin ingin menghapus user ini?')) {
        return;
      }

      const deleteButton = document.querySelector(`.btn-delete[data-id="${userId}"]`);
      const originalHTML = deleteButton.innerHTML;
      deleteButton.innerHTML = '<div class="loading"></div>';
      deleteButton.disabled = true;

      try {
        const formData = new FormData();
        formData.append('action', 'delete');
        formData.append('userId', userId);

        const response = await fetch('process_user.php', {
          method: 'POST',
          body: formData
        });

        const result = await response.json();

        if (result.success) {
          showToast(result.message, 'success');
          setTimeout(() => location.reload(), 1500);
        } else {
          showToast(result.message, 'error');
        }
      } catch (error) {
        console.error('Error:', error);
        showToast('Gagal menghapus user', 'error');
      } finally {
        deleteButton.innerHTML = originalHTML;
        deleteButton.disabled = false;
      }
    }

    // Fungsi untuk menampilkan notifikasi
    function showToast(message, type) {
      toast.textContent = message;
      toast.className = `toast ${type} show`;
      setTimeout(() => {
        toast.className = toast.className.replace('show', '');
      }, 3000);
    }

    // Menutup modal jika klik di luar modal
    window.addEventListener('click', (e) => {
      if (e.target === userModal) {
        closeModal();
      }
    });
  </script>
</body>
</html>