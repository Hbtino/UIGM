<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-chart-bar"></i> Statistik Prodi
                    </h3>
                    <p class="text-muted mb-0">Statistik dan laporan prodi</p>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="fas fa-chart-bar text-primary" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Statistik Prodi</h4>
                        <p class="text-muted">Fitur statistik prodi untuk Kaprodi sedang dalam pengembangan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>