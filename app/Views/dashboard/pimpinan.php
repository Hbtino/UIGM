<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>

<!-- Pimpinan Dashboard -->
<div class="pimpinan-header">
    <div class="pimpinan-info">
        <h2 class="pimpinan-title">
            <i class="fas fa-crown"></i>
            Dashboard Pimpinan
        </h2>
        <p class="pimpinan-subtitle">Monitoring & Overview UIGM 2025</p>
    </div>
    <div class="export-controls">
        <button class="btn btn-outline-light" onclick="exportReport('summary')">
            <i class="fas fa-file-pdf"></i> Laporan Ringkasan
        </button>
        <button class="btn btn-outline-light" onclick="exportReport('detailed')">
            <i class="fas fa-file-excel"></i> Laporan Lengkap
        </button>
    </div>
</div>

<!-- Key Performance Indicators -->
<div class="kpi-overview">
    <div class="kpi-card total-score">
        <div class="kpi-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        <div class="kpi-content">
            <h3><?= $current_score ?? 5410 ?></h3>
            <p>Total Skor UIGM 2025</p>
            <span class="kpi-trend up">
                <i class="fas fa-arrow-up"></i> +850 dari 2024
            </span>
        </div>
    </div>

    <div class="kpi-card world-rank">
        <div class="kpi-icon">
            <i class="fas fa-globe"></i>
        </div>
        <div class="kpi-content">
            <h3>#<?= $world_rank ?? 942 ?></h3>
            <p>Ranking Dunia</p>
            <span class="kpi-trend up">
                <i class="fas fa-arrow-up"></i> Naik 90 posisi
            </span>
        </div>
    </div>

    <div class="kpi-card indonesia-rank">
        <div class="kpi-icon">
            <i class="fas fa-flag"></i>
        </div>
        <div class="kpi-content">
            <h3>#<?= $indonesia_rank ?? 25 ?></h3>
            <p>Ranking Indonesia</p>
            <span class="kpi-trend target">
                <i class="fas fa-target"></i> Target #20
            </span>
        </div>
    </div>

    <div class="kpi-card completion">
        <div class="kpi-icon">
            <i class="fas fa-tasks"></i>
        </div>
        <div class="kpi-content">
            <h3><?= $completion_rate ?? 78 ?>%</h3>
            <p>Kelengkapan Data</p>
            <span class="kpi-trend normal">
                <i class="fas fa-clock"></i> On Track
            </span>
        </div>
    </div>
</div>

<!-- Grafik Skor UIGM -->
<div class="chart-section">
    <div class="chart-container main-chart">
        <div class="chart-header">
            <h3><i class="fas fa-chart-area"></i> Tren Skor UIGM (2023-2025)</h3>
            <div class="chart-controls">
                <button class="btn btn-sm btn-outline-primary active" data-view="total">Total Skor</button>
                <button class="btn btn-sm btn-outline-primary" data-view="category">Per Kategori</button>
                <button class="btn btn-sm btn-outline-primary" data-view="comparison">Perbandingan</button>
            </div>
        </div>
        <canvas id="mainChart"></canvas>
    </div>

    <div class="chart-container ranking-chart">
        <div class="chart-header">
            <h3><i class="fas fa-trophy"></i> Progress Ranking</h3>
        </div>
        <canvas id="rankingChart"></canvas>
    </div>
</div>

<!-- Perbandingan Tahun -->
<div class="comparison-section">
    <h3><i class="fas fa-balance-scale"></i> Perbandingan Antar Tahun</h3>

    <div class="comparison-grid">
        <div class="comparison-card">
            <div class="year-header">
                <h4>2023</h4>
                <span class="year-score">4345</span>
            </div>
            <div class="category-breakdown">
                <div class="category-item">
                    <span class="category-name">SI</span>
                    <span class="category-score">1085</span>
                </div>
                <div class="category-item">
                    <span class="category-name">EC</span>
                    <span class="category-score">1050</span>
                </div>
                <div class="category-item">
                    <span class="category-name">WS</span>
                    <span class="category-score">675</span>
                </div>
                <div class="category-item">
                    <span class="category-name">WR</span>
                    <span class="category-score">300</span>
                </div>
                <div class="category-item">
                    <span class="category-name">TR</span>
                    <span class="category-score">485</span>
                </div>
                <div class="category-item">
                    <span class="category-name">ED</span>
                    <span class="category-score">950</span>
                </div>
            </div>
        </div>

        <div class="comparison-card current">
            <div class="year-header">
                <h4>2024</h4>
                <span class="year-score">4560</span>
            </div>
            <div class="category-breakdown">
                <div class="category-item">
                    <span class="category-name">SI</span>
                    <span class="category-score">900</span>
                    <span class="change negative">-185</span>
                </div>
                <div class="category-item">
                    <span class="category-name">EC</span>
                    <span class="category-score">1300</span>
                    <span class="change positive">+250</span>
                </div>
                <div class="category-item">
                    <span class="category-name">WS</span>
                    <span class="category-score">600</span>
                    <span class="change negative">-75</span>
                </div>
                <div class="category-item">
                    <span class="category-name">WR</span>
                    <span class="category-score">300</span>
                    <span class="change neutral">0</span>
                </div>
                <div class="category-item">
                    <span class="category-name">TR</span>
                    <span class="category-score">535</span>
                    <span class="change positive">+50</span>
                </div>
                <div class="category-item">
                    <span class="category-name">ED</span>
                    <span class="category-score">925</span>
                    <span class="change negative">-25</span>
                </div>
            </div>
        </div>

        <div class="comparison-card highlight">
            <div class="year-header">
                <h4>2025</h4>
                <span class="year-score">5410</span>
            </div>
            <div class="category-breakdown">
                <div class="category-item">
                    <span class="category-name">SI</span>
                    <span class="category-score">1090</span>
                    <span class="change positive">+190</span>
                </div>
                <div class="category-item">
                    <span class="category-name">EC</span>
                    <span class="category-score">1260</span>
                    <span class="change negative">-40</span>
                </div>
                <div class="category-item">
                    <span class="category-name">WS</span>
                    <span class="category-score">725</span>
                    <span class="change positive">+125</span>
                </div>
                <div class="category-item">
                    <span class="category-name">WR</span>
                    <span class="category-score">288</span>
                    <span class="change negative">-12</span>
                </div>
                <div class="category-item">
                    <span class="category-name">TR</span>
                    <span class="category-score">875</span>
                    <span class="change positive">+340</span>
                </div>
                <div class="category-item">
                    <span class="category-name">ED</span>
                    <span class="category-score">1363</span>
                    <span class="change positive">+438</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ranking Nasional/Global -->
<div class="ranking-section">
    <div class="ranking-overview">
        <div class="ranking-card global">
            <h4><i class="fas fa-globe-americas"></i> Posisi Global</h4>
            <div class="ranking-progress">
                <div class="current-rank">
                    <span class="rank-number">#942</span>
                    <span class="rank-label">Saat Ini</span>
                </div>
                <div class="rank-arrow">
                    <i class="fas fa-arrow-up text-success"></i>
                </div>
                <div class="previous-rank">
                    <span class="rank-number">#1032</span>
                    <span class="rank-label">2024</span>
                </div>
            </div>
            <div class="rank-details">
                <span>Naik 90 posisi dari tahun lalu</span>
                <span>Target 2026: #800</span>
            </div>
        </div>

        <div class="ranking-card national">
            <h4><i class="fas fa-flag-usa"></i> Posisi Nasional</h4>
            <div class="national-stats">
                <div class="stat-item">
                    <span class="stat-value"><?= $national_stats['total_universities'] ?? 150 ?></span>
                    <span class="stat-label">Total Universitas</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value"><?= $national_stats['polban_rank'] ?? 25 ?></span>
                    <span class="stat-label">Posisi Polban</span>
                </div>
                <div class="stat-item">
                    <span class="stat-value"><?= $national_stats['top_percentage'] ?? 17 ?>%</span>
                    <span class="stat-label">Top Percentage</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Download Center -->
<div class="download-section">
    <h3><i class="fas fa-download"></i> Download Laporan</h3>
    <div class="download-grid">
        <div class="download-card">
            <div class="download-icon">
                <i class="fas fa-file-pdf text-danger"></i>
            </div>
            <div class="download-content">
                <h4>Executive Summary</h4>
                <p>Ringkasan eksekutif progress UIGM 2025</p>
                <button class="btn btn-outline-danger" onclick="downloadReport('executive')">
                    <i class="fas fa-download"></i> Download PDF
                </button>
            </div>
        </div>

        <div class="download-card">
            <div class="download-icon">
                <i class="fas fa-file-excel text-success"></i>
            </div>
            <div class="download-content">
                <h4>Data Lengkap</h4>
                <p>Data detail semua kategori dan indikator</p>
                <button class="btn btn-outline-success" onclick="downloadReport('detailed')">
                    <i class="fas fa-download"></i> Download Excel
                </button>
            </div>
        </div>

        <div class="download-card">
            <div class="download-icon">
                <i class="fas fa-chart-line text-primary"></i>
            </div>
            <div class="download-content">
                <h4>Analisis Tren</h4>
                <p>Analisis tren dan proyeksi ke depan</p>
                <button class="btn btn-outline-primary" onclick="downloadReport('analysis')">
                    <i class="fas fa-download"></i> Download Report
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<style>
    .pimpinan-header {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 25px;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pimpinan-title {
        font-size: 28px;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .pimpinan-title i {
        color: #ffd700;
    }

    .pimpinan-subtitle {
        margin: 5px 0 0;
        opacity: 0.9;
        font-size: 14px;
    }

    .export-controls {
        display: flex;
        gap: 10px;
    }

    .kpi-overview {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 25px;
    }

    .kpi-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .kpi-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        color: white;
    }

    .kpi-card.total-score .kpi-icon {
        background: linear-gradient(135deg, #667eea, #764ba2);
    }

    .kpi-card.world-rank .kpi-icon {
        background: linear-gradient(135deg, #11998e, #38ef7d);
    }

    .kpi-card.indonesia-rank .kpi-icon {
        background: linear-gradient(135deg, #f093fb, #f5576c);
    }

    .kpi-card.completion .kpi-icon {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
    }

    .kpi-content h3 {
        margin: 0;
        font-size: 32px;
        font-weight: 700;
        color: #1e3c72;
    }

    .kpi-content p {
        margin: 5px 0;
        color: #666;
        font-size: 14px;
    }

    .kpi-trend {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 12px;
    }

    .kpi-trend.up {
        background: rgba(76, 175, 80, 0.1);
        color: #4CAF50;
    }

    .kpi-trend.target {
        background: rgba(33, 150, 243, 0.1);
        color: #2196F3;
    }

    .kpi-trend.normal {
        background: rgba(255, 193, 7, 0.1);
        color: #FFC107;
    }

    .chart-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .chart-container {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .chart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .chart-header h3 {
        margin: 0;
        color: #1e3c72;
        font-size: 18px;
    }

    .chart-controls {
        display: flex;
        gap: 5px;
    }

    .chart-controls .btn.active {
        background: #1e3c72;
        color: white;
        border-color: #1e3c72;
    }

    .comparison-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        margin-bottom: 25px;
    }

    .comparison-section h3 {
        margin: 0 0 20px;
        color: #1e3c72;
    }

    .comparison-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .comparison-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        border: 2px solid transparent;
    }

    .comparison-card.highlight {
        border-color: #4CAF50;
        background: rgba(76, 175, 80, 0.05);
    }

    .year-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 10px;
        border-bottom: 1px solid #e0e0e0;
    }

    .year-header h4 {
        margin: 0;
        color: #1e3c72;
    }

    .year-score {
        font-size: 24px;
        font-weight: 700;
        color: #4CAF50;
    }

    .category-breakdown {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
    }

    .category-name {
        font-weight: 600;
        color: #666;
    }

    .category-score {
        font-weight: 700;
        color: #1e3c72;
    }

    .change {
        font-size: 12px;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 8px;
    }

    .change.positive {
        background: rgba(76, 175, 80, 0.1);
        color: #4CAF50;
    }

    .change.negative {
        background: rgba(244, 67, 54, 0.1);
        color: #f44336;
    }

    .change.neutral {
        background: rgba(158, 158, 158, 0.1);
        color: #9e9e9e;
    }

    .ranking-section {
        margin-bottom: 25px;
    }

    .ranking-overview {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }

    .ranking-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .ranking-card h4 {
        margin: 0 0 20px;
        color: #1e3c72;
        font-size: 18px;
    }

    .ranking-progress {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .current-rank,
    .previous-rank {
        text-align: center;
    }

    .rank-number {
        display: block;
        font-size: 32px;
        font-weight: 700;
        color: #1e3c72;
    }

    .rank-label {
        font-size: 12px;
        color: #666;
    }

    .rank-arrow {
        font-size: 24px;
    }

    .rank-details {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 14px;
        color: #666;
    }

    .national-stats {
        display: flex;
        justify-content: space-between;
    }

    .stat-item {
        text-align: center;
    }

    .stat-value {
        display: block;
        font-size: 28px;
        font-weight: 700;
        color: #1e3c72;
    }

    .stat-label {
        font-size: 12px;
        color: #666;
    }

    .download-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .download-section h3 {
        margin: 0 0 20px;
        color: #1e3c72;
    }

    .download-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .download-card {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
    }

    .download-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .download-content h4 {
        margin: 0 0 10px;
        color: #333;
        font-size: 16px;
    }

    .download-content p {
        margin: 0 0 15px;
        color: #666;
        font-size: 14px;
    }

    @media (max-width: 1200px) {
        .kpi-overview {
            grid-template-columns: repeat(2, 1fr);
        }

        .chart-section {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .pimpinan-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .kpi-overview {
            grid-template-columns: 1fr;
        }

        .comparison-grid {
            grid-template-columns: 1fr;
        }

        .ranking-overview {
            grid-template-columns: 1fr;
        }

        .download-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Pimpinan Dashboard Functions
    function exportReport(type) {
        window.open(`<?= base_url('pimpinan/export-report') ?>/${type}`, '_blank');
    }

    function downloadReport(type) {
        window.open(`<?= base_url('pimpinan/download-report') ?>/${type}`, '_blank');
    }

    // Chart Data
    const chartData = {
        labels: ['2023', '2024', '2025'],
        totalScore: [4345, 4560, 5410],
        worldRank: [null, 1032, 942],
        categories: {
            'SI': [1085, 900, 1090],
            'EC': [1050, 1300, 1260],
            'WS': [675, 600, 725],
            'WR': [300, 300, 288],
            'TR': [485, 535, 875],
            'ED': [950, 925, 1363]
        }
    };

    // Main Chart
    const ctx1 = document.getElementById('mainChart').getContext('2d');
    let mainChart = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: chartData.labels,
            datasets: [{
                label: 'Total Skor',
                data: chartData.totalScore,
                backgroundColor: 'rgba(30, 60, 114, 0.1)',
                borderColor: '#1e3c72',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#1e3c72',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            }
        }
    });

    // Ranking Chart
    const ctx2 = document.getElementById('rankingChart').getContext('2d');
    const rankingChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['2024', '2025'],
            datasets: [{
                label: 'World Rank',
                data: [1032, 942],
                backgroundColor: ['rgba(244, 67, 54, 0.8)', 'rgba(76, 175, 80, 0.8)'],
                borderColor: ['#f44336', '#4CAF50'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    reverse: true,
                    beginAtZero: false,
                    ticks: {
                        callback: function(value) {
                            return '#' + value;
                        }
                    }
                }
            }
        }
    });

    // Chart View Controls
    document.querySelectorAll('.chart-controls .btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.chart-controls .btn').forEach(b => b.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');

            const view = this.dataset.view;
            updateMainChart(view);
        });
    });

    function updateMainChart(view) {
        switch (view) {
            case 'total':
                mainChart.data.datasets = [{
                    label: 'Total Skor',
                    data: chartData.totalScore,
                    backgroundColor: 'rgba(30, 60, 114, 0.1)',
                    borderColor: '#1e3c72',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }];
                break;
            case 'category':
                mainChart.data.datasets = Object.keys(chartData.categories).map((category, index) => {
                    const colors = ['#2196F3', '#4CAF50', '#FF9800', '#00BCD4', '#E91E63', '#9C27B0'];
                    return {
                        label: category,
                        data: chartData.categories[category],
                        borderColor: colors[index],
                        backgroundColor: colors[index] + '20',
                        borderWidth: 2,
                        fill: false,
                        tension: 0.4
                    };
                });
                break;
            case 'comparison':
                // Show comparison with previous years
                mainChart.data.datasets = [{
                    label: 'Growth Rate (%)',
                    data: [null, ((chartData.totalScore[1] - chartData.totalScore[0]) / chartData.totalScore[0] * 100).toFixed(1),
                        ((chartData.totalScore[2] - chartData.totalScore[1]) / chartData.totalScore[1] * 100).toFixed(1)
                    ],
                    backgroundColor: 'rgba(76, 175, 80, 0.1)',
                    borderColor: '#4CAF50',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4
                }];
                break;
        }
        mainChart.update();
    }

    // Auto refresh every 5 minutes
    setInterval(() => {
        // Refresh data if needed
        console.log('Auto refresh data...');
    }, 300000);
</script>
<?= $this->endSection() ?>