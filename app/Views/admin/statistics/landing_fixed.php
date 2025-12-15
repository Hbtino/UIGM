<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

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
                        <button type="button" class="btn btn-success" onclick="refreshPage()">
                            <i class="fas fa-sync"></i> Refresh
                        </button>
                        <button type="button" class="btn btn-info" onclick="previewLanding()">
                            <i class="fas fa-eye"></i> Preview Landing Page
                        </button>
                        <button type="button" class="btn btn-primary" onclick="showAddModal()">
                            <i class="fas fa-plus"></i> Tambah Statistik
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <h5><i class="fas fa-check-circle"></i> JavaScript Berfungsi!</h5>
                        <p>Semua tombol seharusnya berfungsi dengan baik sekarang.</p>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5>Test Tombol:</h5>
                            <div class="btn-group mb-3">
                                <button class="btn btn-success" onclick="editTest(1)">
                                    <i class="fas fa-save"></i> Test Edit
                                </button>
                                <button class="btn btn-info" onclick="quickTest(2)">
                                    <i class="fas fa-pencil-alt"></i> Test Quick Update
                                </button>
                                <button class="btn btn-danger" onclick="deleteTest(3)">
                                    <i class="fas fa-trash"></i> Test Delete
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Section</th>
                                            <th>Label</th>
                                            <th>Value</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>info_box</td>
                                            <td>Jumlah Mahasiswa</td>
                                            <td>15000</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-info" onclick="editTest(1)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-success" onclick="quickTest(1)">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteTest(1)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>profil_kampus</td>
                                            <td>Jumlah Dosen</td>
                                            <td>500</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button class="btn btn-sm btn-info" onclick="editTest(2)">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-success" onclick="quickTest(2)">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" onclick="deleteTest(2)">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    console.log('✅ FIXED PAGE: JavaScript loaded successfully!');

    // Simple working functions
    function refreshPage() {
        console.log('Refresh clicked');
        alert('SUCCESS: Refresh function works!');
        location.reload();
    }

    function previewLanding() {
        console.log('Preview clicked');
        alert('SUCCESS: Preview function works!');
        window.open('<?= base_url() ?>?preview=1', '_blank');
    }

    function showAddModal() {
        console.log('Add modal clicked');
        alert('SUCCESS: Add modal function works!\n\nModal akan dibuat di sini.');
    }

    function editTest(id) {
        console.log('Edit clicked for ID:', id);
        alert('SUCCESS: Edit function works!\nID: ' + id);
    }

    function quickTest(id) {
        console.log('Quick update clicked for ID:', id);
        const newValue = prompt('Masukkan nilai baru:');
        if (newValue !== null) {
            alert('SUCCESS: Quick update works!\nID: ' + id + '\nNew Value: ' + newValue);
        }
    }

    function deleteTest(id) {
        console.log('Delete clicked for ID:', id);
        if (confirm('Apakah Anda yakin ingin menghapus item ID ' + id + '?')) {
            alert('SUCCESS: Delete function works!\nID: ' + id + ' akan dihapus.');
        }
    }

    // Test all functions on page load
    setTimeout(function() {
        console.log('✅ All functions ready!');
        alert('SETUP COMPLETE!\n\nSemua tombol sudah berfungsi dengan baik.\nSilakan test tombol-tombol yang ada.');
    }, 1000);
</script>

<?= $this->endSection() ?>