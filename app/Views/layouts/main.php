<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Dashboard' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);">
  <div class="container">
    <a class="navbar-brand" href="/dashboard">Sistem Kinerja</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <?php if(session()->get('role') == 'admin'): ?>
            <li class="nav-item"><a class="nav-link" href="/users">Manajemen User</a></li>
        <?php endif; ?>

        <?php if(session()->get('role') == 'kaprodi'): ?>
            <li class="nav-item"><a class="nav-link" href="#">Program Studi</a></li>
        <?php endif; ?>

        <?php if(session()->get('role') == 'dosen'): ?>
            <li class="nav-item"><a class="nav-link" href="#">Capaian Kinerja</a></li>
        <?php endif; ?>
      </ul>

      <ul class="navbar-nav ms-auto">
        <?php if(session()->get('role') == 'admin'): ?>
            <li class="nav-item dropdown">
                <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell" style="font-size: 1.2rem;"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-badge" style="display: none;">
                        0
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="min-width: 300px;">
                    <li><h6 class="dropdown-header">Notifikasi Pending Approval</h6></li>
                    <li><hr class="dropdown-divider"></li>
                    <li id="notification-content">
                        <a class="dropdown-item text-center text-muted" href="#">Tidak ada notifikasi</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <li class="nav-item"><span class="nav-link text-light"><?= session()->get('name') ?></span></li>
        <li class="nav-item"><a class="nav-link" href="/dashboard"><i class="fas fa-home"></i> Kembali ke Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <!-- Flash Message -->
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>
    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

    <?= $this->renderSection('content') ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<?php if(session()->get('role') == 'admin'): ?>
<script>
// Check for pending approvals every 30 seconds
function checkPendingApprovals() {
    fetch('/users/pending-count')
        .then(response => response.json())
        .then(data => {
            const badge = document.getElementById('notification-badge');
            const content = document.getElementById('notification-content');
            
            if (data.count > 0) {
                badge.textContent = data.count;
                badge.style.display = 'inline-block';
                content.innerHTML = `
                    <a class="dropdown-item" href="/users/pending-approvals">
                        <i class="fas fa-user-clock text-warning"></i> 
                        ${data.count} user menunggu persetujuan
                    </a>
                `;
            } else {
                badge.style.display = 'none';
                content.innerHTML = '<a class="dropdown-item text-center text-muted" href="#">Tidak ada notifikasi</a>';
            }
        })
        .catch(error => console.error('Error:', error));
}

// Check immediately on page load
checkPendingApprovals();

// Check every 30 seconds
setInterval(checkPendingApprovals, 30000);
</script>
<?php endif; ?>
</body>
</html>
