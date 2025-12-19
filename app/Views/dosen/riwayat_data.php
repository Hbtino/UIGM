<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-history"></i> Riwayat Data
                    </h3>
                    <p class="text-muted mb-0">Riwayat data yang pernah Anda input</p>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="fas fa-history text-info" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Riwayat Data</h4>
                        <p class="text-muted">Fitur riwayat data untuk Dosen sedang dalam pengembangan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>