<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-clock"></i> Status Pengajuan
                    </h3>
                    <p class="text-muted mb-0">Status pengajuan data Anda</p>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="fas fa-clock text-warning" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Status Pengajuan</h4>
                        <p class="text-muted">Fitur status pengajuan untuk Dosen sedang dalam pengembangan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>