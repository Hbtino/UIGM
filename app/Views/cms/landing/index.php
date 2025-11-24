<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4">Konten Landing Page</h1>
    
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-info-circle"></i> Deskripsi
                </div>
                <div class="card-body">
                    <p class="small">Edit konten section Deskripsi di landing page</p>
                    <a href="<?= base_url('landing-contents/edit/deskripsi') ?>" class="btn btn-primary btn-sm btn-block">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-list-ul"></i> Program
                </div>
                <div class="card-body">
                    <p class="small">Edit konten section Program di landing page</p>
                    <a href="<?= base_url('landing-contents/edit/program') ?>" class="btn btn-success btn-sm btn-block">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <i class="fas fa-newspaper"></i> Berita
                </div>
                <div class="card-body">
                    <p class="small">Pilih berita yang ditampilkan di landing page</p>
                    <a href="<?= base_url('landing-contents/edit/berita') ?>" class="btn btn-warning btn-sm btn-block">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-3">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-envelope"></i> Kontak
                </div>
                <div class="card-body">
                    <p class="small">Edit konten section Kontak di landing page</p>
                    <a href="<?= base_url('landing-contents/edit/kontak') ?>" class="btn btn-info btn-sm btn-block">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
