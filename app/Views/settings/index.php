<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        
        .sidebar-footer {
            padding: 20px;
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-footer .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 20px;
            min-height: 100vh;
        }
        
        /* Top Bar */
        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .top-bar-left h2 {
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
        
        /* Settings Container */
        .settings-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .settings-header {
            background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
            color: white;
            padding: 25px 30px;
        }
        
        .settings-header h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        
        .settings-header p {
            margin: 8px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }
        
        .settings-body {
            padding: 30px;
        }
        
        .settings-section {
            margin-bottom: 30px;
            padding-bottom: 30px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .settings-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .settings-section h4 {
            color: #1e3c72;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .settings-section h4 i {
            color: #149823ff;
        }
        
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        
        .form-control {
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 10px 15px;
        }
        
        .form-control:focus {
            border-color: #149823ff;
            box-shadow: 0 0 0 0.2rem rgba(20, 152, 35, 0.25);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(20, 152, 35, 0.4);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .request-history {
            margin-top: 20px;
        }
        
        .request-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            border-left: 4px solid #ddd;
        }
        
        .request-item.pending {
            border-left-color: #ffc107;
            background: #fff8e1;
        }
        
        .request-item.approved {
            border-left-color: #28a745;
            background: #d4edda;
        }
        
        .request-item.rejected {
            border-left-color: #dc3545;
            background: #f8d7da;
        }
        
        .request-status {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        
        .request-status.pending {
            background: #ffc107;
            color: #000;
        }
        
        .request-status.approved {
            background: #28a745;
            color: white;
        }
        
        .request-status.rejected {
            background: #dc3545;
            color: white;
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
                <div class="nav-section-title">MENU</div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?= base_url('settings') ?>" class="nav-link active">
                            <i class="fas fa-cog"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        
        <div class="sidebar-footer">
            <a href="<?= base_url('dashboard') ?>" class="nav-link" style="display: flex; align-items: center; padding: 12px 20px; color: rgba(255,255,255,0.8); text-decoration: none; transition: all 0.3s ease; border-radius: 8px;">
                <i class="fas fa-arrow-left" style="margin-right: 10px;"></i>
                <span>Kembali ke Dashboard</span>
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="top-bar-left">
                <h2>Pengaturan</h2>
            </div>
            <div class="user-info">
                <div class="user-details">
                    <div class="name"><?= isset($user['name']) ? esc($user['name']) : (isset($user_name) ? esc($user_name) : 'User') ?></div>
                    <div class="role"><?= isset($user['role']) ? ucfirst(esc($user['role'])) : (isset($user_role) ? ucfirst(esc($user_role)) : 'User') ?></div>
                </div>
                <div class="user-avatar" style="overflow: hidden;">
                    <?php if(!empty($user['profile_photo']) && file_exists(FCPATH . 'uploads/profiles/' . $user['profile_photo'])): ?>
                        <img src="<?= base_url('uploads/profiles/' . $user['profile_photo']) ?>" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <?php 
                        $displayName = isset($user['name']) ? $user['name'] : (isset($user_name) ? $user_name : 'U');
                        echo strtoupper(substr($displayName, 0, 1));
                        ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <!-- Settings Container -->
        <div class="settings-container">
            <div class="settings-header">
                <h3><i class="fas fa-cog"></i> Pengaturan Akun</h3>
                <p>Kelola informasi dan keamanan akun Anda</p>
            </div>
            
            <div class="settings-body">
                <!-- Profile Photo -->
                <div class="settings-section">
                    <h4><i class="fas fa-camera"></i> Foto Profil</h4>
                    <p class="text-muted mb-3">Upload foto profil Anda (Max 10MB, Format: JPG, PNG)</p>
                    
                    <div id="photoAlertContainer"></div>
                    
                    <div class="row align-items-center">
                        <div class="col-md-3 text-center mb-3">
                            <div style="width: 150px; height: 150px; margin: 0 auto; border-radius: 50%; overflow: hidden; border: 4px solid #149823ff; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                                <?php if(!empty($user['profile_photo']) && file_exists(FCPATH . 'uploads/profiles/' . $user['profile_photo'])): ?>
                                    <img src="<?= base_url('uploads/profiles/' . $user['profile_photo']) ?>" alt="Profile" id="profilePhotoPreview" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <div id="profilePhotoPreview" style="width: 100%; height: 100%; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 60px; font-weight: 700;">
                                        <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <form id="photoUploadForm" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <input type="file" class="form-control" id="profile_photo" name="profile_photo" accept="image/jpeg,image/png,image/jpg" required>
                                    <small class="text-muted">Pilih foto profil baru (JPG, PNG, max 10MB)</small>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload Foto
                                </button>
                                <?php if(!empty($user['profile_photo'])): ?>
                                <button type="button" class="btn btn-danger" onclick="deleteProfilePhoto()">
                                    <i class="fas fa-trash"></i> Hapus Foto
                                </button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Profile Information -->
                <div class="settings-section">
                    <h4><i class="fas fa-user"></i> Informasi Profil</h4>
                    <p class="text-muted mb-3">Update nama lengkap dan username Anda</p>
                    
                    <div id="profileAlertContainer"></div>
                    
                    <form id="profileUpdateForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= esc($user['name']) ?>" required>
                                <small class="text-muted">Nama lengkap Anda</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email (Username)</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                                <small class="text-muted">Email digunakan sebagai username untuk login</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Role</label>
                                <input type="text" class="form-control" value="<?= esc($user['role']) ?>" readonly style="text-transform: capitalize;">
                            </div>
                            <?php if(!empty($user['jurusan'])): ?>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jurusan</label>
                                <input type="text" class="form-control" value="<?= esc($user['jurusan']) ?>" readonly>
                            </div>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </form>
                </div>
                
                <?php if($user_role !== 'admin'): ?>
                <!-- Password Change Request -->
                <div class="settings-section">
                    <h4><i class="fas fa-key"></i> Ganti Password</h4>
                    <p class="text-muted mb-3">Request untuk mengganti password Anda. Admin akan menyetujui permintaan Anda.</p>
                    
                    <div id="alertContainer"></div>
                    
                    <form id="passwordChangeForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password" required minlength="6">
                                <small class="text-muted">Minimal 6 karakter</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Kirim Request
                        </button>
                    </form>
                    
                    <!-- Request History -->
                    <?php if(!empty($requests)): ?>
                    <div class="request-history">
                        <h5 class="mb-3">Riwayat Request</h5>
                        <?php foreach($requests as $req): ?>
                        <div class="request-item <?= $req['status'] ?>">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="request-status <?= $req['status'] ?>">
                                        <?php
                                        if($req['status'] == 'pending') echo 'Menunggu';
                                        elseif($req['status'] == 'approved') echo 'Disetujui';
                                        else echo 'Ditolak';
                                        ?>
                                    </span>
                                    <small class="text-muted ms-2">
                                        Request: <?= date('d M Y H:i', strtotime($req['requested_at'])) ?>
                                    </small>
                                </div>
                                <?php if($req['processed_at']): ?>
                                <small class="text-muted">
                                    Diproses: <?= date('d M Y H:i', strtotime($req['processed_at'])) ?>
                                </small>
                                <?php endif; ?>
                            </div>
                            <?php if($req['notes']): ?>
                            <div class="mt-2">
                                <small><strong>Catatan:</strong> <?= esc($req['notes']) ?></small>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Photo Upload Form
        document.getElementById('photoUploadForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const alertContainer = document.getElementById('photoAlertContainer');
            const fileInput = document.getElementById('profile_photo');
            const file = fileInput.files[0];
            
            // Validate file size (max 10MB)
            if (file && file.size > 10 * 1024 * 1024) {
                alertContainer.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> Ukuran file terlalu besar. Maksimal 10MB.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
                return;
            }
            
            fetch('<?= base_url('settings/upload-photo') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alertContainer.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                    setTimeout(() => location.reload(), 1500);
                } else {
                    alertContainer.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alertContainer.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> Terjadi kesalahan sistem
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
            });
        });
        
        // Delete Profile Photo
        function deleteProfilePhoto() {
            if(!confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
                return;
            }
            
            const alertContainer = document.getElementById('photoAlertContainer');
            
            fetch('<?= base_url('settings/delete-photo') ?>', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alertContainer.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                    setTimeout(() => location.reload(), 1500);
                } else {
                    alertContainer.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                }
            });
        }
        
        // Profile Update Form
        document.getElementById('profileUpdateForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const alertContainer = document.getElementById('profileAlertContainer');
            
            fetch('<?= base_url('settings/update-profile') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alertContainer.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                    setTimeout(() => location.reload(), 1500);
                } else {
                    let errorMsg = data.message;
                    if(data.errors) {
                        errorMsg += '<ul class="mb-0 mt-2">';
                        for(let field in data.errors) {
                            errorMsg += `<li>${data.errors[field]}</li>`;
                        }
                        errorMsg += '</ul>';
                    }
                    alertContainer.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> ${errorMsg}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alertContainer.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> Terjadi kesalahan sistem
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
            });
        });
        
        // Password Change Request Form
        document.getElementById('passwordChangeForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const alertContainer = document.getElementById('alertContainer');
            
            fetch('<?= base_url('settings/request-password-change') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alertContainer.innerHTML = `
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle"></i> ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                    this.reset();
                    setTimeout(() => location.reload(), 2000);
                } else {
                    let errorMsg = data.message;
                    if(data.errors) {
                        errorMsg += '<ul class="mb-0 mt-2">';
                        for(let field in data.errors) {
                            errorMsg += `<li>${data.errors[field]}</li>`;
                        }
                        errorMsg += '</ul>';
                    }
                    alertContainer.innerHTML = `
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle"></i> ${errorMsg}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alertContainer.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> Terjadi kesalahan sistem
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;
            });
        });
    </script>
</body>
</html>
