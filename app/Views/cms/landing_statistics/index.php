<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<style>
    .section-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 15px;
        padding-bottom: 12px;
        border-bottom: 2px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 15px;
    }

    .stat-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 15px;
    }

    .stat-label {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .stat-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        color: #1a202c;
        transition: all 0.3s;
    }

    .stat-input:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
    }

    .stat-meta {
        display: flex;
        gap: 10px;
        margin-top: 10px;
        font-size: 12px;
        color: #94a3b8;
    }

    .save-btn {
        background: #4CAF50;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.3s;
        margin-top: 10px;
    }

    .save-btn:hover {
        background: #45a049;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-chart-bar"></i> <?= $title ?>
        </h1>
        <div>
            <a href="<?= base_url('landing-charts') ?>" class="btn btn-success me-2">
                <i class="fas fa-chart-line"></i> Grafik
            </a>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle"></i>
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <?php foreach ($statistics as $section => $stats): ?>
        <div class="section-card">
            <h2 class="section-title">
                <i class="fas fa-folder"></i>
                <?= ucwords(str_replace('_', ' ', $section)) ?>
            </h2>

            <div class="stats-grid">
                <?php foreach ($stats as $stat): ?>
                    <div class="stat-item">
                        <div class="stat-label">
                            <?= esc($stat['label']) ?>
                            <?php if ($stat['icon']): ?>
                                <i class="<?= esc($stat['icon']) ?>" style="color: <?= esc($stat['color'] ?? '#4CAF50') ?>"></i>
                            <?php endif; ?>
                        </div>
                        <input
                            type="text"
                            class="stat-input"
                            value="<?= esc($stat['value']) ?>"
                            data-id="<?= $stat['id'] ?>"
                            data-section="<?= esc($stat['section']) ?>"
                            data-key="<?= esc($stat['key_name']) ?>">
                        <div class="stat-meta">
                            <span><i class="fas fa-key"></i> <?= esc($stat['key_name']) ?></span>
                            <span><i class="fas fa-sort"></i> Order: <?= $stat['order_position'] ?></span>
                        </div>
                        <button class="save-btn" onclick="saveStat(<?= $stat['id'] ?>, this)">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    function saveStat(id, button) {
        const input = button.previousElementSibling.previousElementSibling;
        const value = input.value;

        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

        fetch('<?= base_url('cms/update-landing-statistic') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}&value=${encodeURIComponent(value)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.innerHTML = '<i class="fas fa-check"></i> Tersimpan!';
                    button.style.background = '#10b981';
                    setTimeout(() => {
                        button.innerHTML = '<i class="fas fa-save"></i> Simpan';
                        button.style.background = '#4CAF50';
                        button.disabled = false;
                    }, 2000);
                } else {
                    alert('Gagal menyimpan: ' + data.message);
                    button.innerHTML = '<i class="fas fa-save"></i> Simpan';
                    button.disabled = false;
                }
            })
            .catch(error => {
                alert('Error: ' + error);
                button.innerHTML = '<i class="fas fa-save"></i> Simpan';
                button.disabled = false;
            });
    }
</script>
<?= $this->endSection() ?>