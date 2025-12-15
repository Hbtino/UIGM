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
                    <?php if (session()->get('role') == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="/users">Manajemen User</a></li>
                    <?php endif; ?>

                    <?php if (session()->get('role') == 'kaprodi'): ?>
                        <li class="nav-item"><a class="nav-link" href="#">Program Studi</a></li>
                    <?php endif; ?>

                    <?php if (session()->get('role') == 'dosen'): ?>
                        <li class="nav-item"><a class="nav-link" href="#">Capaian Kinerja</a></li>
                    <?php endif; ?>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <!-- Sistem notifikasi dihapus - tidak perlu approval registrasi -->
                    <li class="nav-item"><span class="nav-link text-light"><?= session()->get('name') ?></span></li>
                    <li class="nav-item"><a class="nav-link" href="/dashboard"><i class="fas fa-home"></i> Kembali ke Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link" href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Flash Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <?= $this->renderSection('content') ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Sistem approval registrasi dihapus sepenuhnya -->
</body>

</html>