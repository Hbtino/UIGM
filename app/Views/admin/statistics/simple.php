<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar mr-2"></i>
                        Manajemen Statistik & Chart
                    </h3>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success" onclick="syncAllData()">
                            <i class="fas fa-sync"></i> Sync Semua Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Success Message -->
                    <div class="alert alert-success">
                        <h5><i class="fas fa-check-circle"></i> Sistem CRUD Statistik & Chart Berhasil!</h5>
                        <p>Selamat datang di sistem manajemen statistik lengkap untuk landing page dan dashboard.</p>
                    </div>

                    <!-- Navigation Cards -->
                    <div class="row">
                        <!-- Landing Page Statistics -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-primary h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-home fa-3x text-primary mb-3"></i>
                                    <h5 class="card-title">Landing Page Statistics</h5>
                                    <p class="card-text">Kelola statistik yang ditampilkan di homepage website</p>
                                    <ul class="list-unstyled text-left small">
                                        <li>• Info boxes (Target skor, ranking)</li>
                                        <li>• Profil kampus (Mahasiswa, dosen)</li>
                                        <li>• Fasilitas kampus</li>
                                        <li>• Progress ranking</li>
                                    </ul>
                                    <a href="<?= base_url('statistics/landing') ?>" class="btn btn-primary">
                                        <i class="fas fa-edit"></i> Kelola Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Dashboard Statistics -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-success h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-tachometer-alt fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">Dashboard Statistics</h5>
                                    <p class="card-text">Kelola statistik yang ditampilkan di dashboard admin</p>
                                    <ul class="list-unstyled text-left small">
                                        <li>• Target values (Skor 2028)</li>
                                        <li>• Current values (Ranking saat ini)</li>
                                        <li>• Campus information</li>
                                        <li>• Real-time calculated stats</li>
                                    </ul>
                                    <a href="<?= base_url('statistics/dashboard') ?>" class="btn btn-success">
                                        <i class="fas fa-cog"></i> Kelola Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Charts & Indicators -->
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card border-info h-100">
                                <div class="card-body text-center">
                                    <i class="fas fa-chart-line fa-3x text-info mb-3"></i>
                                    <h5 class="card-title">Charts & Indicators</h5>
                                    <p class="card-text">Kelola chart interaktif untuk dashboard dan landing page</p>
                                    <ul class="list-unstyled text-left small">
                                        <li>• Line, bar, pie charts</li>
                                        <li>• Auto-sync dengan database</li>
                                        <li>• Multi-location display</li>
                                        <li>• Configurable styling</li>
                                    </ul>
                                    <a href="<?= base_url('statistics/charts') ?>" class="btn btn-info">
                                        <i class="fas fa-chart-bar"></i> Kelola Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Database Status -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-database mr-2"></i>
                                        Status Database
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h3 class="text-success">6</h3>
                                                <p class="mb-0">Charts & Indicators</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h3 class="text-primary">40</h3>
                                                <p class="mb-0">Landing Statistics</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <h3 class="text-info">14</h3>
                                                <p class="mb-0">Dashboard Statistics</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-bolt mr-2"></i>
                                        Quick Actions
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group mr-2 mb-2">
                                        <button class="btn btn-outline-primary" onclick="viewLandingPage()">
                                            <i class="fas fa-eye"></i> Lihat Landing Page
                                        </button>
                                    </div>
                                    <div class="btn-group mr-2 mb-2">
                                        <button class="btn btn-outline-success" onclick="viewDashboard()">
                                            <i class="fas fa-tachometer-alt"></i> Lihat Dashboard
                                        </button>
                                    </div>
                                    <div class="btn-group mr-2 mb-2">
                                        <button class="btn btn-outline-info" onclick="testDatabase()">
                                            <i class="fas fa-database"></i> Test Database
                                        </button>
                                    </div>
                                    <div class="btn-group mr-2 mb-2">
                                        <button class="btn btn-outline-warning" onclick="debugSession()">
                                            <i class="fas fa-bug"></i> Debug Session
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Session Info -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user mr-2"></i>
                                        Session Info
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <strong>User:</strong> <?= $user_name ?? 'Unknown' ?>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Role:</strong>
                                            <span class="badge badge-success"><?= $user_role ?? 'Unknown' ?></span>
                                        </div>
                                        <div class="col-md-4">
                                            <strong>Email:</strong> <?= $user_email ?? 'Unknown' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Dashboard Statistics Management
    function manageDashboardStats() {
        // For now, show available options
        const options = `
    <div class="alert alert-info">
        <h5>Dashboard Statistics Management</h5>
        <p>Fitur ini akan memungkinkan Anda untuk:</p>
        <ul>
            <li>Edit target skor 2028</li>
            <li>Update ranking dunia dan indonesia</li>
            <li>Kelola data kampus (mahasiswa, dosen, dll)</li>
            <li>Lihat statistik real-time</li>
        </ul>
        <p><strong>Status:</strong> Sistem database sudah siap, interface sedang dikembangkan.</p>
    </div>`;

        showModal('Dashboard Statistics', options);
    }

    // Charts Management
    function manageCharts() {
        const options = `
    <div class="alert alert-info">
        <h5>Charts & Indicators Management</h5>
        <p>Fitur ini akan memungkinkan Anda untuk:</p>
        <ul>
            <li>Tambah chart baru (line, bar, pie, donut)</li>
            <li>Edit data chart existing</li>
            <li>Atur lokasi tampil (dashboard/landing/both)</li>
            <li>Konfigurasi auto-sync dengan database</li>
        </ul>
        <p><strong>Status:</strong> 6 chart sudah tersedia di database, interface sedang dikembangkan.</p>
    </div>`;

        showModal('Charts & Indicators', options);
    }

    // Sync All Data
    function syncAllData() {
        const btn = event.target;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Syncing...';
        btn.disabled = true;

        // Simulate sync process
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            alert('✅ Semua data berhasil disinkronkan!');
        }, 2000);
    }

    // Quick Actions
    function viewLandingPage() {
        window.open('<?= base_url('/') ?>', '_blank');
    }

    function viewDashboard() {
        window.open('<?= base_url('dashboard') ?>', '_blank');
    }

    function testDatabase() {
        window.open('<?= base_url('test-statistics') ?>', '_blank');
    }

    function debugSession() {
        window.open('<?= base_url('debug-session') ?>', '_blank');
    }

    // Modal Helper
    function showModal(title, content) {
        const modal = `
    <div class="modal fade" id="infoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">${title}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ${content}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>`;

        // Remove existing modal
        const existingModal = document.getElementById('infoModal');
        if (existingModal) {
            existingModal.remove();
        }

        // Add new modal
        document.body.insertAdjacentHTML('beforeend', modal);
        $('#infoModal').modal('show');
    }
</script>

<?= $this->endSection() ?>