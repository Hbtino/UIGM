<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle"></i> Status Data
                    </h3>
                    <p class="text-muted mb-0">Status data untuk unit <?= strtoupper($user_unit ?? 'N/A') ?></p>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="fas fa-chart-line text-info" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Status Data Unit</h4>
                        <p class="text-muted">Fitur status data untuk Admin Unit sedang dalam pengembangan.</p>
                        <p class="text-muted">Unit Anda: <strong><?= strtoupper($user_unit ?? 'N/A') ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>