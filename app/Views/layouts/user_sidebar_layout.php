<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Dashboard Admin Unit - UIGM' ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome-free/css/all.min.css') ?>">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="<?= base_url('assets/dist/css/adminlte.min.css') ?>">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.css') ?>">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .user-sidebar {
            background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
        }

        .user-sidebar .nav-link {
            color: rgba(255, 255, 255, 0.9);
        }

        .user-sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .user-sidebar .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }

        .brand-text {
            color: white !important;
            font-weight: bold;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user"></i>
                        <span class="ml-1"><?= $user_name ?? 'User' ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="<?= base_url('admin-unit-dashboard/settings') ?>" class="dropdown-item">
                            <i class="fas fa-cog mr-2"></i> Pengaturan
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('admin-unit-dashboard/logout') ?>" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 user-sidebar">
            <!-- Brand Logo -->
            <a href="<?= base_url('admin-unit-dashboard') ?>" class="brand-link">
                <img src="<?= base_url('assets/dist/img/uigm-logo.png') ?>" alt="UIGM Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Admin Unit - <?= $user_unit ?? 'UIGM' ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= $profile_photo ? base_url('uploads/profiles/' . $profile_photo) : base_url('assets/dist/img/user-default.png') ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block text-white"><?= $user_name ?? 'User' ?></a>
                        <small class="text-light"><?= $user_role ?? 'User' ?></small>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="<?= base_url('admin-unit-dashboard') ?>" class="nav-link <?= ($page ?? '') == 'dashboard-admin-unit' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Header Kriteria UIGM -->
                        <li class="nav-header text-white">KRITERIA UIGM</li>

                        <!-- 1. Pengelolaan Limbah -->
                        <li class="nav-item">
                            <a href="<?= base_url('admin-unit-dashboard/waste-management') ?>" class="nav-link <?= ($page ?? '') == 'waste-management-input' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-recycle"></i>
                                <p>Pengelolaan Limbah</p>
                            </a>
                        </li>

                        <!-- 2. Energi & Perubahan Iklim (Kosong) -->
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled" style="opacity: 0.5;">
                                <i class="nav-icon fas fa-bolt"></i>
                                <p>Energi & Perubahan Iklim</p>
                                <span class="badge badge-secondary">Segera</span>
                            </a>
                        </li>

                        <!-- 3. Transportasi (Kosong) -->
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled" style="opacity: 0.5;">
                                <i class="nav-icon fas fa-car"></i>
                                <p>Transportasi</p>
                                <span class="badge badge-secondary">Segera</span>
                            </a>
                        </li>

                        <!-- 4. Pengelolaan Air (Kosong) -->
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled" style="opacity: 0.5;">
                                <i class="nav-icon fas fa-tint"></i>
                                <p>Pengelolaan Air</p>
                                <span class="badge badge-secondary">Segera</span>
                            </a>
                        </li>

                        <!-- 5. Infrastruktur (Kosong) -->
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled" style="opacity: 0.5;">
                                <i class="nav-icon fas fa-building"></i>
                                <p>Infrastruktur</p>
                                <span class="badge badge-secondary">Segera</span>
                            </a>
                        </li>

                        <!-- 6. Pendidikan (Kosong) -->
                        <li class="nav-item">
                            <a href="#" class="nav-link disabled" style="opacity: 0.5;">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>Pendidikan</p>
                                <span class="badge badge-secondary">Segera</span>
                            </a>
                        </li>

                        <!-- Header Sistem -->
                        <li class="nav-header text-white">SISTEM</li>

                        <!-- Pengaturan -->
                        <li class="nav-item">
                            <a href="<?= base_url('admin-unit-dashboard/settings') ?>" class="nav-link <?= ($page ?? '') == 'settings' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li>

                        <!-- Logout -->
                        <li class="nav-item">
                            <a href="<?= base_url('admin-unit-dashboard/logout') ?>" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>

                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?? 'Dashboard User' ?></h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <?php if (isset($breadcrumb)): ?>
                                    <?php $breadcrumbs = explode(' / ', $breadcrumb); ?>
                                    <?php foreach ($breadcrumbs as $index => $crumb): ?>
                                        <?php if ($index == count($breadcrumbs) - 1): ?>
                                            <li class="breadcrumb-item active"><?= $crumb ?></li>
                                        <?php else: ?>
                                            <li class="breadcrumb-item"><?= $crumb ?></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main content -->
            <section class="content">
                <?= $this->renderSection('content') ?>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?> <a href="#">UIGM Dashboard</a>.</strong>
            Semua hak dilindungi.
            <div class="float-right d-none d-sm-inline-block">
                <b>Versi</b> 1.0.0
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="<?= base_url('assets/plugins/jquery/jquery.min.js') ?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/dist/js/adminlte.min.js') ?>"></script>
    <!-- SweetAlert2 -->
    <script src="<?= base_url('assets/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

    <!-- Show alerts -->
    <?php if (session()->getFlashdata('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session()->getFlashdata('success') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '<?= session()->getFlashdata('error') ?>',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    <?php endif; ?>

</body>

</html>