# Update Dashboard View untuk Sistem Statistik Baru

## Instruksi Update Dashboard

Untuk mengintegrasikan sistem statistik baru ke dashboard, tambahkan kode berikut ke file `app/Views/dashboard/index.php`:

### 1. Tambahkan di bagian statistik cards (setelah cards yang sudah ada):

```php
<!-- New Statistics System -->
<div class="row mb-4">
    <div class="col-12">
        <h5 class="mb-3">
            <i class="fas fa-chart-bar mr-2"></i>
            Statistik Real-time
        </h5>
    </div>
</div>

<?php if (!empty($realTimeStats)): ?>
    <!-- Real-time Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Data Entries
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= number_format($realTimeStats['summary']['total_data']) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-database fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Data Approved
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= number_format($realTimeStats['summary']['approved_data']) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Data Pending
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= number_format($realTimeStats['summary']['pending_data']) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Score Percentage
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= number_format($realTimeStats['summary']['score_percentage'], 1) ?>%
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-percentage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
```

### 2. Tambahkan section untuk charts baru (setelah charts yang sudah ada):

```php
<!-- New Charts System -->
<?php if (!empty($dashboardCharts)): ?>
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-3">
                <i class="fas fa-chart-line mr-2"></i>
                Charts & Indikator
                <a href="<?= base_url('statistics') ?>" class="btn btn-sm btn-outline-primary float-right">
                    <i class="fas fa-cog"></i> Kelola
                </a>
            </h5>
        </div>
    </div>

    <div class="row">
        <?php
        $chartsBySection = [];
        foreach ($dashboardCharts as $chart) {
            $section = $chart['section'] ?? 'default';
            $chartsBySection[$section][] = $chart;
        }
        ?>

        <?php foreach ($chartsBySection as $section => $charts): ?>
            <?php foreach ($charts as $chart): ?>
                <div class="col-lg-6 col-md-12 mb-4">
                    <?= view('components/chart_display', ['chart' => $chart]) ?>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
```

### 3. Tambahkan JavaScript untuk inisialisasi charts:

```javascript
<script>
// Initialize new charts system
document.addEventListener('DOMContentLoaded', function() {
    // Configure Chart.js defaults
    Chart.defaults.font.family = "'Segoe UI', Tahoma, Geneva, Verdana, sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.color = '#858796';

    // Auto-refresh charts every 5 minutes
    setInterval(function() {
        refreshDashboardCharts();
    }, 300000); // 5 minutes
});

function refreshDashboardCharts() {
    fetch('<?= base_url('statistics/api/chart-data/dashboard') ?>')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update chart data
                data.data.forEach(chart => {
                    const canvas = document.getElementById('chart-' + chart.id);
                    if (canvas && canvas.chart) {
                        const chartData = JSON.parse(chart.chart_data);
                        canvas.chart.data = chartData;
                        canvas.chart.update();
                    }
                });
            }
        })
        .catch(error => console.error('Error refreshing charts:', error));
}
</script>
```

## Update Home View untuk Landing Page

Untuk mengintegrasikan sistem statistik baru ke landing page, tambahkan kode berikut ke file `app/Views/home.php`:

### 1. Tambahkan section statistik baru:

```php
<!-- Statistics Section -->
<?php if (!empty($landingStats)): ?>
    <section id="statistik" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-4 font-weight-bold text-primary">Statistik Kampus</h2>
                    <p class="lead text-muted">Data dan pencapaian Politeknik Negeri Bandung</p>
                </div>
            </div>

            <!-- Info Boxes -->
            <?php if (isset($landingStats['info_box'])): ?>
                <div class="row mb-5">
                    <?php
                    $infoBoxes = array_chunk($landingStats['info_box'], 2);
                    foreach ($infoBoxes as $boxPair):
                    ?>
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body text-center p-4">
                                    <div class="row">
                                        <?php foreach ($boxPair as $box): ?>
                                            <div class="col-6">
                                                <?php if (!empty($box['icon'])): ?>
                                                    <i class="<?= $box['icon'] ?> fa-3x mb-3" style="color: <?= $box['color'] ?? '#6c757d' ?>"></i>
                                                <?php endif; ?>
                                                <h3 class="font-weight-bold" style="color: <?= $box['color'] ?? '#6c757d' ?>">
                                                    <?= $box['value'] ?>
                                                </h3>
                                                <p class="text-muted mb-0"><?= $box['label'] ?></p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <!-- Profil & Fasilitas -->
            <div class="row">
                <!-- Profil Kampus -->
                <?php if (isset($landingStats['profil_kampus'])): ?>
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-university mr-2"></i>
                                    Profil Kampus
                                </h5>
                            </div>
                            <div class="card-body">
                                <?= render_statistics($landingStats['profil_kampus'], 'landing', 'profil_kampus') ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Fasilitas Kampus -->
                <?php if (isset($landingStats['fasilitas'])): ?>
                    <div class="col-lg-6 mb-4">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-building mr-2"></i>
                                    Fasilitas Kampus
                                </h5>
                            </div>
                            <div class="card-body">
                                <?= render_statistics($landingStats['fasilitas'], 'landing', 'fasilitas') ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- Charts Section -->
<?php if (!empty($landingCharts)): ?>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-5">
                    <h2 class="display-4 font-weight-bold text-primary">Progress & Pencapaian</h2>
                    <p class="lead text-muted">Grafik perkembangan ranking dan pencapaian</p>
                </div>
            </div>

            <?= render_charts($landingCharts, 2) ?>
        </div>
    </section>
<?php endif; ?>
```

### 2. Tambahkan CSS untuk styling:

```css
<style>
.statistics-section .card {
    transition: transform 0.2s ease-in-out;
}

.statistics-section .card:hover {
    transform: translateY(-5px);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

@media (max-width: 768px) {
    .stat-number {
        font-size: 2rem;
    }
}
</style>
```

## Verifikasi Update

Setelah melakukan update:

1. **Test Dashboard:**

   - Login sebagai admin
   - Akses `/dashboard`
   - Verifikasi statistik real-time muncul
   - Verifikasi charts baru muncul

2. **Test Landing Page:**

   - Akses homepage
   - Scroll ke section statistik
   - Verifikasi data muncul dengan benar

3. **Test Admin Panel:**

   - Akses `/statistics`
   - Test edit statistik
   - Verifikasi perubahan muncul di dashboard/landing

4. **Test Sync:**
   - Klik "Sync Semua Data"
   - Verifikasi charts terupdate

Sistem statistik baru sekarang terintegrasi dengan dashboard dan landing page!
