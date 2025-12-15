<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<style>
    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .chart-title {
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

    .chart-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 15px;
    }

    .chart-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 15px;
    }

    .chart-label {
        font-size: 14px;
        color: #64748b;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .chart-input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e0;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        color: #1a202c;
        transition: all 0.3s;
    }

    .chart-input:focus {
        outline: none;
        border-color: #4CAF50;
        box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
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
        width: 100%;
    }

    .save-btn:hover {
        background: #45a049;
    }
</style>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-chart-line"></i> <?= $title ?>
        </h1>
        <div>
            <a href="<?= base_url('statistics/landing') ?>" class="btn btn-secondary me-2">
                <i class="fas fa-chart-bar"></i> Statistik
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

    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <strong>Info:</strong> Grafik ini akan ditampilkan di landing page. Edit nilai ranking untuk mengupdate tampilan.
    </div>

    <?php foreach ($charts as $chartType => $chartData): ?>
        <div class="chart-card">
            <h2 class="chart-title">
                <i class="fas <?= $chartType === 'ranking_dunia' ? 'fa-globe' : 'fa-map-marker-alt' ?>"></i>
                <?= $chartType === 'ranking_dunia' ? 'Progress Ranking Dunia' : 'Progress Ranking Indonesia' ?>
            </h2>

            <div class="chart-grid">
                <?php foreach ($chartData as $data): ?>
                    <div class="chart-item">
                        <div class="chart-label">
                            Tahun <?= esc($data['year']) ?>
                        </div>
                        <input
                            type="number"
                            class="chart-input"
                            value="<?= esc($data['rank_value']) ?>"
                            data-id="<?= $data['id'] ?>"
                            data-type="<?= esc($data['chart_type']) ?>"
                            data-year="<?= esc($data['year']) ?>"
                            placeholder="Ranking #">
                        <button class="save-btn" onclick="saveChart(<?= $data['id'] ?>, this)">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
    function saveChart(id, button) {
        const input = button.previousElementSibling;
        const rankValue = input.value;

        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';

        fetch('<?= base_url('cms/update-landing-chart') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}&rank_value=${encodeURIComponent(rankValue)}`
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