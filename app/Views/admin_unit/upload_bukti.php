<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-upload"></i> Upload Bukti
                    </h3>
                    <p class="text-muted mb-0">Upload bukti pendukung untuk unit <?= strtoupper($user_unit ?? 'N/A') ?></p>
                </div>
                <div class="card-body">
                    <div class="text-center py-5">
                        <i class="fas fa-upload text-primary" style="font-size: 4rem;"></i>
                        <h4 class="mt-3">Upload Bukti</h4>
                        <p class="text-muted">Fitur upload bukti untuk Admin Unit sedang dalam pengembangan.</p>
                        <p class="text-muted">Unit Anda: <strong><?= strtoupper($user_unit ?? 'N/A') ?></strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>