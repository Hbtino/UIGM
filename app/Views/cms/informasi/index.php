<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('styles') ?>
<style>
    .content-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 25px;
    }

    .content-header {
        background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
        color: white;
        padding: 25px 30px;
    }

    .content-header h3 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
    }

    .content-header p {
        margin: 8px 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .content-body {
        padding: 30px;
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 10px 15px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #149823ff;
        box-shadow: 0 0 0 0.2rem rgba(20, 152, 35, 0.25);
    }

    .btn-primary {
        background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(20, 152, 35, 0.4);
    }

    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
    }

    .alert {
        border-radius: 10px;
        border: none;
    }

    .map-preview {
        border: 2px dashed #ddd;
        border-radius: 8px;
        padding: 20px;
        text-align: center;
        background: #f8f9fa;
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .map-preview iframe {
        width: 100%;
        height: 300px;
        border-radius: 8px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-card">
    <div class="content-header">
        <h3><i class="fas fa-info-circle"></i> Kelola Konten Informasi</h3>
        <p>Kelola informasi kontak dan lokasi yang ditampilkan di landing page</p>
    </div>

    <div class="content-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Sync Button -->
        <div class="mb-4">
            <button type="button" class="btn btn-success" onclick="syncFromDashboard()">
                <i class="fas fa-sync-alt"></i> Sinkronisasi dari Dashboard
            </button>
            <small class="text-muted d-block mt-2">
                Sinkronisasi konten informasi dari info box dashboard ke landing page
            </small>
        </div>

        <form action="<?= base_url('informasi-contents/update') ?>" method="POST">
            <?= csrf_field() ?>

            <div class="row">
                <!-- Basic Information -->
                <div class="col-md-6">
                    <h5 class="mb-3"><i class="fas fa-edit"></i> Informasi Dasar</h5>

                    <div class="mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" class="form-control" name="title"
                            value="<?= isset($content['title']) ? esc($content['title']) : 'Informasi Kontak' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Subjudul</label>
                        <input type="text" class="form-control" name="subtitle"
                            value="<?= isset($content['subtitle']) ? esc($content['subtitle']) : 'Hubungi Kami' ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="content" rows="4" required><?= isset($content['content']) ? esc($content['content']) : 'Untuk informasi lebih lanjut tentang program GreenMetric dan Kampus Berkelanjutan Polban, silakan hubungi kami melalui kontak di bawah ini.' ?></textarea>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-md-6">
                    <h5 class="mb-3"><i class="fas fa-address-book"></i> Kontak</h5>

                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="address" rows="3" required><?= isset($content['address']) ? esc($content['address']) : 'Jl. Gegerkalong Hilir, Ds. Ciwaruga, Parongpong, Kabupaten Bandung Barat, Jawa Barat 40559' ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="phone"
                            value="<?= isset($content['phone']) ? esc($content['phone']) : '(022) 2013789' ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email"
                            value="<?= isset($content['email']) ? esc($content['email']) : 'info@polban.ac.id' ?>" required>
                    </div>
                </div>
            </div>

            <!-- Map Section -->
            <div class="row mt-4">
                <div class="col-12">
                    <h5 class="mb-3"><i class="fas fa-map-marker-alt"></i> Peta Lokasi</h5>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Embed Code Google Maps</label>
                                <textarea class="form-control" name="map_embed" id="mapEmbedInput" rows="4"
                                    placeholder="Paste embed code dari Google Maps di sini..."><?= isset($content['map_embed']) ? htmlspecialchars($content['map_embed']) : '' ?></textarea>
                                <small class="text-muted">
                                    <strong>⚠️ PENTING - Cara yang Benar:</strong><br>
                                    1. Buka <a href="https://maps.google.com" target="_blank">Google Maps</a><br>
                                    2. Cari lokasi (contoh: "Politeknik Negeri Bandung")<br>
                                    3. <strong>JANGAN masuk Street View!</strong> Tetap di tampilan peta biasa<br>
                                    4. Klik tombol <strong>"Share"</strong> (ikon berbagi)<br>
                                    5. Pilih tab <strong>"Embed a map"</strong><br>
                                    6. Klik <strong>"COPY HTML"</strong><br>
                                    7. Paste kode di sini<br>
                                    <br>
                                    <strong style="color: red;">❌ JANGAN:</strong> Copy dari Street View (gambar jalan)<br>
                                    <strong style="color: green;">✅ HARUS:</strong> Copy dari tampilan peta biasa (tampilan atas)
                                </small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Latitude</label>
                                        <input type="number" step="any" class="form-control" name="map_latitude"
                                            value="<?= isset($content['map_latitude']) ? $content['map_latitude'] : '-6.871537' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Longitude</label>
                                        <input type="number" step="any" class="form-control" name="map_longitude"
                                            value="<?= isset($content['map_longitude']) ? $content['map_longitude'] : '107.574060' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Preview Peta</label>
                            <div class="map-preview" id="mapPreview">
                                <?php if (isset($content['map_embed']) && !empty($content['map_embed'])): ?>
                                    <!-- Map Preview - Raw HTML -->
                                    <?= $content['map_embed'] ?>
                                <?php else: ?>
                                    <div class="text-muted">
                                        <i class="fas fa-map fa-3x mb-3"></i>
                                        <p>Preview peta akan muncul di sini setelah Anda memasukkan embed code</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle"></i> Preview akan update otomatis saat Anda mengetik
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="<?= base_url('landing-contents') ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Preview map when embed code changes
    const mapEmbedInput = document.getElementById('mapEmbedInput');
    if (mapEmbedInput) {
        mapEmbedInput.addEventListener('input', function() {
            const embedCode = this.value.trim();
            const preview = document.getElementById('mapPreview');

            if (embedCode) {
                // Check if it's valid iframe code
                if (embedCode.includes('<iframe') && embedCode.includes('</iframe>')) {
                    preview.innerHTML = embedCode;
                } else {
                    preview.innerHTML = `
                        <div class="text-warning">
                            <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                            <p><strong>Kode embed tidak valid!</strong><br>
                            Pastikan Anda copy kode iframe lengkap dari Google Maps.</p>
                        </div>
                    `;
                }
            } else {
                preview.innerHTML = `
                    <div class="text-muted">
                        <i class="fas fa-map fa-3x mb-3"></i>
                        <p>Preview peta akan muncul di sini setelah Anda memasukkan embed code</p>
                    </div>
                `;
            }
        });
    }

    // Sync from dashboard
    function syncFromDashboard() {
        if (confirm('Apakah Anda yakin ingin menyinkronisasi konten dari dashboard? Ini akan menimpa judul dan deskripsi saat ini.')) {
            fetch('<?= base_url('cms/sync-dashboard-to-landing') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan saat sinkronisasi');
                    console.error(error);
                });
        }
    }
</script>
<?= $this->endSection() ?>