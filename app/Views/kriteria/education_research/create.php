<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
        <a href="<?= base_url('education-research') ?>" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('education-research/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun">Tahun <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="tahun" name="tahun" 
                                   value="<?= old('tahun') ?>" required min="2000" max="2100">
                        </div>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Data Konsumsi Energi</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_konsumsi_listrik">Total Konsumsi Listrik (kWh) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="total_konsumsi_listrik" 
                                   name="total_konsumsi_listrik" value="<?= old('total_konsumsi_listrik') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="konsumsi_energi_terbarukan">Konsumsi Energi Terbarukan (kWh) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="konsumsi_energi_terbarukan" 
                                   name="konsumsi_energi_terbarukan" value="<?= old('konsumsi_energi_terbarukan') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Persentase Energi Terbarukan (Auto-calculated)</label>
                            <input type="text" class="form-control bg-light" id="preview_persentase" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_listrik_per_orang">Total Listrik per Orang (kWh) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="total_listrik_per_orang" 
                                   name="total_listrik_per_orang" value="<?= old('total_listrik_per_orang') ?>" required>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Infrastruktur & Fasilitas</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="peralatan_hemat_energi">Jumlah Peralatan Hemat Energi <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="peralatan_hemat_energi" 
                                   name="peralatan_hemat_energi" value="<?= old('peralatan_hemat_energi') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bangunan_cerdas">Jumlah Bangunan Cerdas <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="bangunan_cerdas" 
                                   name="bangunan_cerdas" value="<?= old('bangunan_cerdas') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jumlah_energi_terbarukan">Jumlah Sumber Energi Terbarukan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="jumlah_energi_terbarukan" 
                                   name="jumlah_energi_terbarukan" value="<?= old('jumlah_energi_terbarukan') ?>" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bangunan_ramah_lingkungan">Jumlah Bangunan Ramah Lingkungan <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="bangunan_ramah_lingkungan" 
                                   name="bangunan_ramah_lingkungan" value="<?= old('bangunan_ramah_lingkungan') ?>" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jejak_karbon_per_orang">Jejak Karbon per Orang (ton CO2) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" class="form-control" id="jejak_karbon_per_orang" 
                                   name="jejak_karbon_per_orang" value="<?= old('jejak_karbon_per_orang') ?>" required>
                        </div>
                    </div>
                </div>

                <h5 class="mt-4 mb-3">Program & Inisiatif</h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="program_pengurangan_emisi" 
                                       name="program_pengurangan_emisi" value="1" <?= old('program_pengurangan_emisi') ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="program_pengurangan_emisi">
                                    Program Pengurangan Emisi
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="program_inovatif_energi" 
                                       name="program_inovatif_energi" value="1" <?= old('program_inovatif_energi') ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="program_inovatif_energi">
                                    Program Inovatif Energi
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="program_dampak_iklim" 
                                       name="program_dampak_iklim" value="1" <?= old('program_dampak_iklim') ? 'checked' : '' ?>>
                                <label class="custom-control-label" for="program_dampak_iklim">
                                    Program Dampak Iklim
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Capaian Persen (Auto-calculated)</label>
                            <input type="text" class="form-control bg-light" id="preview_capaian" readonly>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan') ?></textarea>
                </div>

                <div class="form-group">
                    <label for="bukti_pendukung">Bukti Pendukung <span class="text-danger">*</span></label>
                    <input type="file" class="form-control-file" id="bukti_pendukung" name="bukti_pendukung" required>
                    <small class="form-text text-muted">Format: PDF, JPG, PNG, XLSX, XLS. Max: 2MB</small>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="<?= base_url('education-research') ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function calculatePercentages() {
    const total = parseFloat(document.getElementById('total_konsumsi_listrik').value) || 0;
    const terbarukan = parseFloat(document.getElementById('konsumsi_energi_terbarukan').value) || 0;
    
    let persentase = 0;
    if (total > 0) {
        persentase = (terbarukan / total) * 100;
    }
    
    document.getElementById('preview_persentase').value = persentase.toFixed(2) + '%';
    
    // Calculate capaian
    const programEmisi = document.getElementById('program_pengurangan_emisi').checked ? 20 : 0;
    const programInovatif = document.getElementById('program_inovatif_energi').checked ? 15 : 0;
    const programIklim = document.getElementById('program_dampak_iklim').checked ? 15 : 0;
    
    const capaian = (persentase * 0.5) + programEmisi + programInovatif + programIklim;
    document.getElementById('preview_capaian').value = capaian.toFixed(2) + '%';
}

document.getElementById('total_konsumsi_listrik').addEventListener('input', calculatePercentages);
document.getElementById('konsumsi_energi_terbarukan').addEventListener('input', calculatePercentages);
document.getElementById('program_pengurangan_emisi').addEventListener('change', calculatePercentages);
document.getElementById('program_inovatif_energi').addEventListener('change', calculatePercentages);
document.getElementById('program_dampak_iklim').addEventListener('change', calculatePercentages);

// Initial calculation
calculatePercentages();
</script>
<?= $this->endSection() ?>

