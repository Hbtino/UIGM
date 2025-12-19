<?= $this->extend('layouts/user_layout') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header" style="background: linear-gradient(135deg, #6f42c1 0%, #4c2a85 100%); color: white;">
                    <h3 class="card-title">
                        <i class="fas fa-cog mr-2"></i>
                        Pengaturan User
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Informasi Profil -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-user mr-2"></i>
                                        Informasi Profil User
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <img src="<?= $profile_photo ? base_url('uploads/profiles/' . $profile_photo) : base_url('assets/dist/img/user-default.png') ?>"
                                            class="img-circle elevation-2" alt="User Image" style="width: 100px; height: 100px;">
                                    </div>

                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td><?= $user_data['name'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td><?= $user_data['email'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Role:</strong></td>
                                            <td>
                                                <span class="badge badge-primary">User</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Bergabung:</strong></td>
                                            <td><?= date('d M Y', strtotime($user_data['created_at'] ?? '')) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Statistik User -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-bar mr-2"></i>
                                        Statistik Kontribusi Anda
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Total Input</span>
                                                <span class="info-box-number text-success"><?= $statistics['total_input'] ?? 0 ?></span>
                                            </div>
                                        </div>
                                        <div class="col-6 text-center">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Terverifikasi</span>
                                                <span class="info-box-number text-primary"><?= $statistics['approved'] ?? 0 ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-6 text-center">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Pending</span>
                                                <span class="info-box-number text-warning"><?= $statistics['pending'] ?? 0 ?></span>
                                            </div>
                                        </div>
                                        <div class="col-6 text-center">
                                            <div class="info-box-content">
                                                <span class="info-box-text">Ditolak</span>
                                                <span class="info-box-number text-danger"><?= $statistics['rejected'] ?? 0 ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Aksi Cepat -->
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-tools mr-2"></i>
                                        Aksi Cepat
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="<?= base_url('user-dashboard/waste-management') ?>" class="btn btn-success">
                                            <i class="fas fa-recycle"></i> Input Data Limbah
                                        </a>
                                        <a href="<?= base_url('user-dashboard') ?>" class="btn btn-primary">
                                            <i class="fas fa-home"></i> Kembali ke Dashboard
                                        </a>
                                        <button class="btn btn-warning" onclick="changePassword()">
                                            <i class="fas fa-key"></i> Ubah Password
                                        </button>
                                        <a href="<?= base_url('user-dashboard/logout') ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin logout?')">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Informasi Sistem untuk User -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle mr-2"></i>
                        Informasi Sistem User
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Tentang Dashboard User</h6>
                            <p class="text-muted">
                                Sistem dashboard untuk user dalam berkontribusi pada program UI Green Metric.
                                Setiap data yang Anda input membantu kampus mencapai target keberlanjutan lingkungan.
                            </p>
                        </div>
                        <div class="col-md-4">
                            <h6>Fitur Tersedia untuk User</h6>
                            <ul class="list-unstyled text-muted">
                                <li><i class="fas fa-check text-success"></i> Input Data Pengelolaan Limbah</li>
                                <li><i class="fas fa-clock text-warning"></i> Energi & Perubahan Iklim (Segera)</li>
                                <li><i class="fas fa-clock text-warning"></i> Transportasi (Segera)</li>
                                <li><i class="fas fa-clock text-warning"></i> Pengelolaan Air (Segera)</li>
                                <li><i class="fas fa-clock text-warning"></i> Infrastruktur (Segera)</li>
                                <li><i class="fas fa-clock text-warning"></i> Pendidikan (Segera)</li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6>Kontribusi User</h6>
                            <ul class="list-unstyled text-muted">
                                <li><i class="fas fa-check text-info"></i> Input data lingkungan kampus</li>
                                <li><i class="fas fa-check text-info"></i> Berkontribusi untuk keberlanjutan</li>
                                <li><i class="fas fa-check text-info"></i> Monitoring data yang diinput</li>
                                <li><i class="fas fa-check text-info"></i> Menjadi bagian dari kampus hijau</li>
                            </ul>
                            <button class="btn btn-outline-primary btn-sm" onclick="showHelp()">
                                <i class="fas fa-question-circle"></i> Bantuan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function changePassword() {
        Swal.fire({
            title: 'Ubah Password',
            text: 'Fitur ubah password akan segera tersedia untuk User',
            icon: 'info',
            confirmButtonText: 'OK'
        });
    }

    function showHelp() {
        Swal.fire({
            title: 'Bantuan User',
            html: `
            <div class="text-left">
                <h6>Cara Menggunakan Dashboard:</h6>
                <ol>
                    <li>Pilih menu "Pengelolaan Limbah" di sidebar</li>
                    <li>Isi form input data dengan akurat dan jujur</li>
                    <li>Pastikan data sesuai dengan kondisi sebenarnya</li>
                    <li>Submit data untuk verifikasi admin</li>
                    <li>Monitor status verifikasi di dashboard</li>
                </ol>
                <p class="text-muted mt-3">
                    <i class="fas fa-info-circle"></i> 
                    Kontribusi Anda sangat berarti untuk kampus berkelanjutan!
                </p>
            </div>
        `,
            icon: 'question',
            confirmButtonText: 'Mengerti'
        });
    }
</script>

<?= $this->endSection() ?>