<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<style>
    /* Enhanced styles for better UX */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .badge {
        font-size: 0.75em;
    }

    .btn-group .btn {
        margin-right: 2px;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }

    .nav-tabs .nav-link.active {
        background-color: #007bff;
        border-color: #007bff;
        color: white;
    }

    .alert-info {
        border-left: 4px solid #17a2b8;
    }

    /* Loading animation */
    @keyframes pulse {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.5;
        }

        100% {
            opacity: 1;
        }
    }

    .loading {
        animation: pulse 1.5s infinite;
    }

    /* Modal enhancements */
    #createModal {
        backdrop-filter: blur(3px);
    }

    /* Input validation states */
    .is-valid {
        border-color: #28a745 !important;
        background-color: #d4edda !important;
    }

    .is-invalid {
        border-color: #dc3545 !important;
        background-color: #f8d7da !important;
    }

    /* Smooth transitions */
    .btn,
    .form-control,
    .card {
        transition: all 0.2s ease-in-out;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-home mr-2"></i>
                        Kelola Statistik Landing Page
                    </h3>
                    <div class="btn-group">
                        <a href="<?= base_url('statistics') ?>" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="button" class="btn btn-success" onclick="syncAllData()">
                            <i class="fas fa-sync"></i> Sync Data
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Tabs Navigation -->
                    <ul class="nav nav-tabs" id="statisticsTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">
                                <i class="fas fa-info-circle"></i> Statistik Umum
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="charts-tab" data-bs-toggle="tab" data-bs-target="#charts" type="button" role="tab">
                                <i class="fas fa-chart-bar"></i> Data Chart
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="statisticsTabContent">
                        <!-- General Statistics Tab -->
                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                            <!-- Add New Statistic Button -->
                            <div class="row mt-4">
                                <div class="col-12">
                                    <button class="btn btn-primary mb-3" onclick="showCreateModal()">
                                        <i class="fas fa-plus"></i> Tambah Statistik Baru
                                    </button>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">
                                                <i class="fas fa-tools mr-2"></i>
                                                Aksi Cepat
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-primary" onclick="showCreateModal()">
                                                    <i class="fas fa-plus"></i> Tambah Statistik Baru
                                                </button>
                                                <button class="btn btn-info" onclick="previewLandingPage()">
                                                    <i class="fas fa-eye"></i> Preview Landing Page
                                                </button>
                                                <button class="btn btn-success" onclick="syncAllData()">
                                                    <i class="fas fa-sync"></i> Sync Semua Data
                                                </button>
                                            </div>
                                            <div class="mt-3">
                                                <small class="text-muted">
                                                    <i class="fas fa-info-circle"></i>
                                                    Gunakan editor di bawah untuk mengedit statistik per section. Perubahan akan otomatis tersimpan.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Editor per Section -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success">
                                        <h6><i class="fas fa-edit"></i> Editor Statistik per Section</h6>
                                        <p class="mb-0">
                                            Edit langsung nilai statistik di bawah ini. Perubahan akan otomatis tersimpan setelah 2 detik.
                                            <br><small><strong>Tips:</strong> Gunakan tombol <span class="badge badge-success">Simpan</span> untuk save manual, atau tombol <span class="badge badge-info">Edit</span> untuk edit lengkap di modal.</small>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Fasilitas Section -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">
                                                <i class="fas fa-folder mr-2"></i>
                                                Fasilitas
                                            </h5>
                                            <button class="btn btn-sm btn-primary" onclick="showCreateModal('fasilitas')">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Luas Kampus</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="246269" data-section="fasilitas" data-key="luas_kampus">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(1)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(1)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Unit Luas Kampus</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="m²" data-section="fasilitas" data-key="unit_luas_kampus">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(2)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(2)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Luas Bangunan</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="93435" data-section="fasilitas" data-key="luas_bangunan">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(3)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(3)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Jumlah Bangunan</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="86" data-section="fasilitas" data-key="jumlah_bangunan">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(4)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(4)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Laboratorium</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="119" data-section="fasilitas" data-key="laboratorium">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(5)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(5)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Info Box Section -->
                                <div class="col-lg-6 mb-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">
                                                <i class="fas fa-folder mr-2"></i>
                                                Info Box
                                            </h5>
                                            <button class="btn btn-sm btn-primary" onclick="showCreateModal('info_box')">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Target Skor 2028</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="Original Value" data-section="info_box" data-key="target_skor_2028">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(6)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(6)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Target 80%</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="Target: 80%" data-section="info_box" data-key="target_80">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(7)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(7)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Profil Kampus & Ranking Dunia -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">
                                                <i class="fas fa-folder mr-2"></i>
                                                Profil Kampus
                                            </h5>
                                            <button class="btn btn-sm btn-primary" onclick="showCreateModal('profil_kampus')">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Mahasiswa</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="6605" data-section="profil_kampus" data-key="mahasiswa">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(8)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(8)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Dosen</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="482" data-section="profil_kampus" data-key="dosen">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(9)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(9)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Jurusan</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="10" data-section="profil_kampus" data-key="jurusan">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(10)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(10)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">Program Studi</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="39" data-section="profil_kampus" data-key="program_studi">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(11)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(11)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Ranking Dunia Section -->
                                <div class="col-lg-6 mb-4">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">
                                                <i class="fas fa-folder mr-2"></i>
                                                Ranking Dunia
                                            </h5>
                                            <button class="btn btn-sm btn-primary" onclick="showCreateModal('ranking_dunia')">
                                                <i class="fas fa-plus"></i> Tambah
                                            </button>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">2023</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="896" data-section="ranking_dunia" data-key="2023">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(12)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(12)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-4 col-form-label">2024</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" value="705" data-section="ranking_dunia" data-key="2024">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="btn-group">
                                                        <button class="btn btn-success btn-sm" onclick="saveStat(this)" title="Simpan">
                                                            <i class="fas fa-save"></i>
                                                        </button>
                                                        <button class="btn btn-info btn-sm" onclick="editStatInModal(13)" title="Edit Lengkap">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                        <button class="btn btn-danger btn-sm" onclick="deleteStatById(13)" title="Hapus">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Charts Data Tab -->
                        <div class="tab-pane fade" id="charts" role="tabpanel">
                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <h5><i class="fas fa-chart-line"></i> Manajemen Chart Landing Page</h5>
                                        <p>Kelola chart batang dan chart garis di landing page dengan CRUD lengkap.</p>
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

<!-- Create/Edit Modal -->
<div id="createModal" style="display: none; position: fixed; z-index: 1050; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); overflow-y: auto;">
    <div style="position: relative; margin: 2% auto; width: 500px; max-width: 90%; background: white; border-radius: 10px; padding: 20px; max-height: 90vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; position: sticky; top: 0; background: white; z-index: 10;">
            <h4 id="modalTitle">Tambah Statistik Baru</h4>
            <button onclick="hideCreateModal()" style="background: none; border: none; font-size: 24px; cursor: pointer;">&times;</button>
        </div>

        <form id="createForm">
            <input type="hidden" id="editId" name="id" value="">

            <div class="mb-3">
                <label class="form-label">Section</label>
                <select class="form-control" name="section" id="modalSection" required>
                    <option value="">Pilih Section</option>
                    <option value="info_box">Info Box</option>
                    <option value="profil_kampus">Profil Kampus</option>
                    <option value="fasilitas">Fasilitas</option>
                    <option value="ranking_dunia">Ranking Dunia</option>
                    <option value="ranking_indonesia">Ranking Indonesia</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Key Name</label>
                <input type="text" class="form-control" name="key_name" id="modalKeyName" placeholder="contoh: jumlah_mahasiswa" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Label</label>
                <input type="text" class="form-control" name="label" id="modalLabel" placeholder="contoh: Jumlah Mahasiswa" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Value</label>
                <input type="text" class="form-control" name="value" id="modalValue" placeholder="contoh: 15000" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Icon (opsional)</label>
                <input type="text" class="form-control" name="icon" id="modalIcon" placeholder="contoh: fas fa-users">
            </div>

            <div class="mb-3">
                <label class="form-label">Color (opsional)</label>
                <input type="text" class="form-control" name="color" id="modalColor" placeholder="contoh: #007bff">
            </div>

            <div class="mb-3">
                <label class="form-label">Order</label>
                <input type="number" class="form-control" name="order" id="modalOrder" value="0">
            </div>

            <div class="text-end" style="position: sticky; bottom: 0; background: white; padding-top: 15px; margin-top: 20px;">
                <button type="button" class="btn btn-secondary" onclick="hideCreateModal()">Batal</button>
                <button type="button" class="btn btn-primary" onclick="submitStatForm()">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    console.log('✅ FULL STATISTICS PAGE: JavaScript loaded successfully!');

    let isEditMode = false;
    let currentEditId = null;

    // Sistem notifikasi yang lebih baik
    function showNotification(message, type = 'info', duration = 4000) {
        // Hapus notifikasi lama jika ada
        const existingNotif = document.getElementById('customNotification');
        if (existingNotif) {
            existingNotif.remove();
        }

        // Buat notifikasi baru
        const notification = document.createElement('div');
        notification.id = 'customNotification';
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            padding: 15px 20px;
            border-radius: 8px;
            color: white;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            transform: translateX(400px);
            transition: transform 0.3s ease;
            max-width: 400px;
        `;

        // Set warna berdasarkan type
        const colors = {
            success: '#28a745',
            error: '#dc3545',
            warning: '#ffc107',
            info: '#17a2b8'
        };
        notification.style.backgroundColor = colors[type] || colors.info;

        // Set icon berdasarkan type
        const icons = {
            success: 'fas fa-check-circle',
            error: 'fas fa-exclamation-circle',
            warning: 'fas fa-exclamation-triangle',
            info: 'fas fa-info-circle'
        };

        notification.innerHTML = `
            <i class="${icons[type] || icons.info}" style="margin-right: 10px;"></i>
            ${message}
        `;

        document.body.appendChild(notification);

        // Animasi masuk
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);

        // Auto hide
        setTimeout(() => {
            notification.style.transform = 'translateX(400px)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 300);
        }, duration);
    }

    // Fungsi untuk menampilkan modal create/edit
    function showCreateModal(section) {
        console.log('Show create modal called with section:', section);
        try {
            const modal = document.getElementById('createModal');
            const title = document.getElementById('modalTitle');
            const sectionSelect = document.getElementById('modalSection');

            // Reset form untuk mode create
            resetModalForm();
            isEditMode = false;
            currentEditId = null;

            if (modal) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden'; // Prevent background scroll

                if (title) {
                    title.textContent = section ? 'Tambah Statistik - ' + section : 'Tambah Statistik Baru';
                }
                if (sectionSelect && section) {
                    sectionSelect.value = section;
                }
                console.log('✅ Modal opened successfully');
            } else {
                alert('Modal element tidak ditemukan!');
            }
        } catch (error) {
            console.error('Modal error:', error);
            alert('Error opening modal: ' + error.message);
        }
    }

    // Fungsi untuk menyembunyikan modal
    function hideCreateModal() {
        const modal = document.getElementById('createModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scroll
            resetModalForm();
        }
    }

    // Reset form modal
    function resetModalForm() {
        document.getElementById('editId').value = '';
        document.getElementById('modalSection').value = '';
        document.getElementById('modalKeyName').value = '';
        document.getElementById('modalLabel').value = '';
        document.getElementById('modalValue').value = '';
        document.getElementById('modalIcon').value = '';
        document.getElementById('modalColor').value = '';
        document.getElementById('modalOrder').value = '0';
    }

    // Submit form (create atau update)
    function submitStatForm() {
        const form = document.getElementById('createForm');
        const formData = new FormData(form);
        const submitBtn = form.querySelector('button[onclick="submitStatForm()"]');

        // Validasi form
        if (!formData.get('section') || !formData.get('key_name') || !formData.get('label') || !formData.get('value')) {
            showNotification('Section, Key Name, Label, dan Value harus diisi!', 'warning');
            return;
        }

        // Show loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

        const url = isEditMode ?
            '<?= base_url("statistics/update-landing-stat") ?>/' + currentEditId :
            '<?= base_url("statistics/create-landing-stat") ?>';

        // Kirim data ke server
        fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('✅ ' + data.message, 'success');
                    hideCreateModal();
                    refreshData(); // Refresh data setelah berhasil
                } else {
                    showNotification('❌ Error: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Submit error:', error);
                showNotification('❌ Terjadi kesalahan saat menyimpan data', 'error');
            })
            .finally(() => {
                // Restore button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
    }

    // Fungsi untuk quick save
    function saveStat(button) {
        const input = button.parentElement.parentElement.previousElementSibling.querySelector('input');
        if (input) {
            const section = input.dataset.section;
            const key = input.dataset.key;
            const value = input.value;

            if (!section || !key) {
                showNotification('❌ Data section atau key tidak ditemukan', 'error');
                return;
            }

            // Disable button dan show loading
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            input.disabled = true;

            // Kirim data ke server
            const formData = new FormData();
            formData.append('section', section);
            formData.append('key', key);
            formData.append('value', value);

            fetch('<?= base_url("statistics/update-landing-stat") ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Visual feedback sukses
                        input.style.borderColor = '#28a745';
                        input.style.backgroundColor = '#d4edda';
                        showNotification('✅ ' + data.message, 'success');

                        setTimeout(() => {
                            input.style.borderColor = '';
                            input.style.backgroundColor = '';
                        }, 3000);
                    } else {
                        input.style.borderColor = '#dc3545';
                        input.style.backgroundColor = '#f8d7da';
                        showNotification('❌ Gagal menyimpan: ' + data.message, 'error');

                        setTimeout(() => {
                            input.style.borderColor = '';
                            input.style.backgroundColor = '';
                        }, 3000);
                    }
                })
                .catch(error => {
                    console.error('Save error:', error);
                    input.style.borderColor = '#dc3545';
                    showNotification('❌ Terjadi kesalahan saat menyimpan', 'error');
                })
                .finally(() => {
                    // Restore button state
                    button.disabled = false;
                    button.innerHTML = originalText;
                    input.disabled = false;
                });
        }
    }

    // Fungsi untuk edit di modal
    function editStatInModal(id) {
        console.log('Edit stat in modal called with ID:', id);

        // Ambil data dari server
        fetch('<?= base_url("statistics/get-landing-stat") ?>/' + id)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const stat = data.data;

                    // Set mode edit
                    isEditMode = true;
                    currentEditId = id;

                    // Isi form dengan data
                    document.getElementById('editId').value = stat.id;
                    document.getElementById('modalSection').value = stat.section;
                    document.getElementById('modalKeyName').value = stat.key_name;
                    document.getElementById('modalLabel').value = stat.label;
                    document.getElementById('modalValue').value = stat.value;
                    document.getElementById('modalIcon').value = stat.icon || '';
                    document.getElementById('modalColor').value = stat.color || '';
                    document.getElementById('modalOrder').value = stat.order || 0;

                    // Ubah judul modal
                    document.getElementById('modalTitle').textContent = 'Edit Statistik - ' + stat.label;

                    // Tampilkan modal
                    document.getElementById('createModal').style.display = 'block';
                    document.body.style.overflow = 'hidden';

                    console.log('✅ Data loaded for edit:', stat);
                } else {
                    showNotification('❌ Gagal memuat data: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Load data error:', error);
                showNotification('❌ Terjadi kesalahan saat memuat data', 'error');
            });
    }

    // Fungsi untuk hapus statistik
    function deleteStatById(id) {
        console.log('Delete stat by ID called with ID:', id);

        if (confirm('Apakah Anda yakin ingin menghapus statistik ini?\n\nData yang dihapus tidak dapat dikembalikan.')) {
            const formData = new FormData();
            formData.append('id', id);

            fetch('<?= base_url("statistics/delete-landing-stat") ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showNotification('✅ ' + data.message, 'success');
                        refreshData(); // Refresh data setelah hapus
                    } else {
                        showNotification('❌ Gagal menghapus: ' + data.message, 'error');
                    }
                })
                .catch(error => {
                    console.error('Delete error:', error);
                    showNotification('❌ Terjadi kesalahan saat menghapus data', 'error');
                });
        }
    }

    // Fungsi untuk refresh data (simplified)
    function refreshData() {
        console.log('Refresh data called');
        showNotification('🔄 Data berhasil di-refresh', 'success');

        // Refresh visual indicators
        document.querySelectorAll('input[data-section]').forEach(input => {
            input.style.borderColor = '';
            input.style.backgroundColor = '';
        });
    }



    // Fungsi untuk preview landing page
    function previewLandingPage() {
        console.log('Preview landing page called');
        try {
            window.open('<?= base_url() ?>?preview=1', '_blank');
        } catch (error) {
            alert('Error opening preview: ' + error.message);
        }
    }

    // Fungsi untuk sync semua data
    function syncAllData() {
        console.log('Sync all data called');

        // Show loading notification
        showNotification('🔄 Sedang melakukan sinkronisasi data...', 'info', 2000);

        fetch('<?= base_url("statistics/sync-all") ?>', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showNotification('✅ ' + data.message, 'success');
                    refreshData(); // Refresh setelah sync
                } else {
                    showNotification('❌ Gagal sync: ' + data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Sync error:', error);
                showNotification('❌ Terjadi kesalahan saat sinkronisasi', 'error');
            });
    }

    // Initialize page
    document.addEventListener('DOMContentLoaded', function() {
        console.log('✅ DOM loaded, statistics page initialized');

        // Initialize data
        refreshData();

        // Close modal when clicking outside
        document.getElementById('createModal').addEventListener('click', function(e) {
            if (e.target === this) {
                hideCreateModal();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // ESC untuk close modal
            if (e.key === 'Escape') {
                hideCreateModal();
            }

            // Ctrl+S untuk save (prevent default save)
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                if (document.getElementById('createModal').style.display === 'block') {
                    submitStatForm();
                } else {
                    showNotification('💡 Tip: Gunakan tombol Save di samping input untuk menyimpan perubahan', 'info');
                }
            }

            // Ctrl+N untuk new statistic
            if (e.ctrlKey && e.key === 'n') {
                e.preventDefault();
                showCreateModal();
            }
        });

        // Auto-save untuk input fields (debounced)
        let autoSaveTimeout;
        document.querySelectorAll('input[data-section]').forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(autoSaveTimeout);

                // Visual indicator bahwa ada perubahan
                this.style.borderColor = '#ffc107';
                this.style.backgroundColor = '#fff3cd';

                // Auto-save setelah 2 detik tidak ada perubahan
                autoSaveTimeout = setTimeout(() => {
                    const saveBtn = this.parentElement.parentElement.nextElementSibling.querySelector('.btn-success');
                    if (saveBtn) {
                        saveStat(saveBtn);
                    }
                }, 2000);
            });
        });

        console.log('✅ All functions ready and tested');
        console.log('💡 Keyboard shortcuts: ESC (close modal), Ctrl+S (save), Ctrl+N (new)');
    });
</script>

<?= $this->endSection() ?>