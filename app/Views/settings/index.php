<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('styles') ?>
<style>
    .settings-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
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
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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
                        <?php if (!empty($user['profile_photo']) && file_exists(FCPATH . 'uploads/profiles/' . $user['profile_photo'])): ?>
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
                        <?php if (!empty($user['profile_photo'])): ?>
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
                    <?php if (!empty($user['jurusan'])): ?>
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

        <?php if ($user_role !== 'admin'): ?>
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
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required minlength="6">
                            <small class="text-muted">Ulangi password baru</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alasan Perubahan</label>
                        <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Jelaskan alasan Anda ingin mengganti password..."></textarea>
                        <small class="text-muted">Opsional - berikan alasan untuk mempercepat persetujuan</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Kirim Permintaan
                    </button>
                </form>

                <!-- Request History -->
                <?php if (!empty($requests)): ?>
                    <div class="request-history">
                        <h5><i class="fas fa-history"></i> Riwayat Permintaan</h5>
                        <?php foreach ($requests as $request): ?>
                            <div class="request-item <?= $request['status'] ?>">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <strong>Permintaan #<?= $request['id'] ?></strong>
                                        <span class="request-status <?= $request['status'] ?>"><?= ucfirst($request['status']) ?></span>
                                        <p class="mb-1 mt-2"><?= esc($request['reason']) ?></p>
                                        <small class="text-muted">Dibuat: <?= date('d/m/Y H:i', strtotime($request['created_at'])) ?></small>
                                    </div>
                                </div>
                                <?php if ($request['status'] == 'approved'): ?>
                                    <div class="mt-2">
                                        <small class="text-success">✓ Disetujui pada <?= date('d/m/Y H:i', strtotime($request['updated_at'])) ?></small>
                                    </div>
                                <?php elseif ($request['status'] == 'rejected'): ?>
                                    <div class="mt-2">
                                        <small class="text-danger">✗ Ditolak pada <?= date('d/m/Y H:i', strtotime($request['updated_at'])) ?></small>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if ($user_role === 'admin'): ?>
            <!-- Admin Password Change -->
            <div class="settings-section">
                <h4><i class="fas fa-key"></i> Ganti Password</h4>
                <p class="text-muted mb-3">Sebagai admin, Anda dapat langsung mengganti password tanpa persetujuan.</p>

                <div id="adminPasswordAlertContainer"></div>

                <form id="adminPasswordChangeForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password Lama</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                            <small class="text-muted">Masukkan password saat ini</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="admin_new_password" name="new_password" required minlength="6">
                            <small class="text-muted">Minimal 6 karakter</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="admin_confirm_password" name="confirm_password" required minlength="6">
                            <small class="text-muted">Ulangi password baru</small>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Ganti Password
                    </button>
                </form>
            </div>

            <!-- Admin: Pending Password Requests -->
            <div class="settings-section">
                <h4><i class="fas fa-clock"></i> Permintaan Ganti Password</h4>
                <p class="text-muted mb-3">Kelola permintaan ganti password dari user lain.</p>

                <div id="pendingRequestsContainer">
                    <div class="text-center">
                        <i class="fas fa-spinner fa-spin"></i> Memuat permintaan...
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Profile Photo Upload
    document.getElementById('photoUploadForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const alertContainer = document.getElementById('photoAlertContainer');

        fetch('<?= base_url('settings/upload-photo') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alertContainer.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                    if (data.photo_url) {
                        document.getElementById('profilePhotoPreview').innerHTML =
                            '<img src="' + data.photo_url + '" alt="Profile" style="width: 100%; height: 100%; object-fit: cover;">';
                    }
                    setTimeout(() => location.reload(), 1500);
                } else {
                    alertContainer.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                }
            })
            .catch(error => {
                alertContainer.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan saat upload foto</div>';
            });
    });

    // Delete Profile Photo
    function deleteProfilePhoto() {
        if (confirm('Apakah Anda yakin ingin menghapus foto profil?')) {
            fetch('<?= base_url('settings/delete-photo') ?>', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    const alertContainer = document.getElementById('photoAlertContainer');
                    if (data.success) {
                        alertContainer.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        alertContainer.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                    }
                });
        }
    }

    // Profile Update
    document.getElementById('profileUpdateForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        const alertContainer = document.getElementById('profileAlertContainer');

        fetch('<?= base_url('settings/update-profile') ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alertContainer.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                    setTimeout(() => location.reload(), 1500);
                } else {
                    alertContainer.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                }
            })
            .catch(error => {
                alertContainer.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan saat update profil</div>';
            });
    });

    <?php if ($user_role !== 'admin'): ?>
        // Password Change Request
        document.getElementById('passwordChangeForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            const alertContainer = document.getElementById('alertContainer');

            if (newPassword !== confirmPassword) {
                alertContainer.innerHTML = '<div class="alert alert-danger">Password dan konfirmasi password tidak sama!</div>';
                return;
            }

            const formData = new FormData(this);

            fetch('<?= base_url('settings/request-password-change') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alertContainer.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                        this.reset();
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        alertContainer.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                    }
                })
                .catch(error => {
                    alertContainer.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan saat mengirim permintaan</div>';
                });
        });
    <?php endif; ?>

    <?php if ($user_role === 'admin'): ?>
        // Admin Password Change
        document.getElementById('adminPasswordChangeForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const newPassword = document.getElementById('admin_new_password').value;
            const confirmPassword = document.getElementById('admin_confirm_password').value;
            const alertContainer = document.getElementById('adminPasswordAlertContainer');

            if (newPassword !== confirmPassword) {
                alertContainer.innerHTML = '<div class="alert alert-danger">Password baru dan konfirmasi password tidak sama!</div>';
                return;
            }

            const formData = new FormData(this);

            fetch('<?= base_url('settings/change-password') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alertContainer.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                        this.reset();
                    } else {
                        alertContainer.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                    }
                })
                .catch(error => {
                    alertContainer.innerHTML = '<div class="alert alert-danger">Terjadi kesalahan saat mengganti password</div>';
                });
        });

        // Load Pending Password Requests
        function loadPendingRequests() {
            fetch('<?= base_url('settings/get-pending-requests') ?>')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('pendingRequestsContainer');

                    if (data.success && data.requests.length > 0) {
                        let html = '';
                        data.requests.forEach(request => {
                            html += `
                    <div class="request-item pending" id="request-${request.id}">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <strong>${request.user_name}</strong>
                                <span class="request-status pending">Pending</span>
                                <p class="mb-1 mt-2">${request.reason || 'Tidak ada alasan'}</p>
                                <small class="text-muted">Dibuat: ${new Date(request.created_at).toLocaleDateString('id-ID')}</small>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-success me-2" onclick="processRequest(${request.id}, 'approved')">
                                    <i class="fas fa-check"></i> Setujui
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="processRequest(${request.id}, 'rejected')">
                                    <i class="fas fa-times"></i> Tolak
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                        });
                        container.innerHTML = html;
                    } else {
                        container.innerHTML = '<div class="text-muted text-center">Tidak ada permintaan pending</div>';
                    }
                })
                .catch(error => {
                    document.getElementById('pendingRequestsContainer').innerHTML =
                        '<div class="text-danger text-center">Gagal memuat permintaan</div>';
                });
        }

        // Process Password Request
        function processRequest(requestId, action) {
            fetch(`<?= base_url('settings/process-password-request') ?>/${requestId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        action: action
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`request-${requestId}`).remove();
                        // Reload if no more requests
                        if (document.querySelectorAll('.request-item').length === 0) {
                            loadPendingRequests();
                        }
                    } else {
                        alert('Gagal memproses permintaan: ' + data.message);
                    }
                });
        }

        // Load pending requests on page load
        loadPendingRequests();
    <?php endif; ?>
</script>
<?= $this->endSection() ?>