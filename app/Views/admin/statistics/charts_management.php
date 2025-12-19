<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-chart-line mr-2 text-info"></i>
                        Charts & Indicators Management
                    </h3>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info" onclick="addNewChart()">
                            <i class="fas fa-plus"></i> Tambah Chart
                        </button>
                        <button type="button" class="btn btn-success" onclick="syncCharts()">
                            <i class="fas fa-sync"></i> Sync Charts
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Info Alert -->
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Charts & Indicators</h5>
                        <p>Kelola chart interaktif untuk dashboard dan landing page. Mendukung line, bar, pie charts dengan auto-sync database dan multi-location display.</p>
                    </div>

                    <!-- Charts Grid -->
                    <div class="row" id="chartsContainer">
                        <!-- Will be populated by JavaScript -->
                    </div>

                    <!-- Chart Types Info -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-info-circle"></i> Supported Chart Types
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="text-center">
                                                <i class="fas fa-chart-line fa-3x text-primary mb-2"></i>
                                                <h6>Line Charts</h6>
                                                <small class="text-muted">Untuk trend data</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-center">
                                                <i class="fas fa-chart-bar fa-3x text-success mb-2"></i>
                                                <h6>Bar Charts</h6>
                                                <small class="text-muted">Untuk perbandingan</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-center">
                                                <i class="fas fa-chart-pie fa-3x text-warning mb-2"></i>
                                                <h6>Pie Charts</h6>
                                                <small class="text-muted">Untuk proporsi</small>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-center">
                                                <i class="fas fa-chart-area fa-3x text-info mb-2"></i>
                                                <h6>Area Charts</h6>
                                                <small class="text-muted">Untuk volume data</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Display Locations -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-map-marker-alt"></i> Display Locations
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <i class="fas fa-tachometer-alt fa-2x text-success mb-2"></i>
                                                <h6>Dashboard Only</h6>
                                                <small class="text-muted">Hanya tampil di dashboard admin</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <i class="fas fa-home fa-2x text-primary mb-2"></i>
                                                <h6>Landing Only</h6>
                                                <small class="text-muted">Hanya tampil di landing page</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <i class="fas fa-globe fa-2x text-info mb-2"></i>
                                                <h6>Both Locations</h6>
                                                <small class="text-muted">Tampil di dashboard dan landing</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart Edit Modal -->
<div class="modal fade" id="editChartModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Chart</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editChartForm">
                    <input type="hidden" id="editChartId">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editChartTitle">Title</label>
                                <input type="text" class="form-control" id="editChartTitle" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editChartType">Chart Type</label>
                                <select class="form-control" id="editChartType" required>
                                    <option value="line">Line Chart</option>
                                    <option value="bar">Bar Chart</option>
                                    <option value="pie">Pie Chart</option>
                                    <option value="doughnut">Doughnut Chart</option>
                                    <option value="area">Area Chart</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editChartLocation">Display Location</label>
                                <select class="form-control" id="editChartLocation" required>
                                    <option value="dashboard">Dashboard Only</option>
                                    <option value="landing">Landing Only</option>
                                    <option value="both">Both Locations</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="editChartSection">Section</label>
                                <input type="text" class="form-control" id="editChartSection" placeholder="main, sidebar, etc">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editChartDescription">Description</label>
                        <textarea class="form-control" id="editChartDescription" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editChartData">Chart Data (JSON)</label>
                        <textarea class="form-control" id="editChartData" rows="8" placeholder='{"labels": ["2023", "2024"], "datasets": [...]}'></textarea>
                        <small class="text-muted">Format JSON untuk data chart. Lihat dokumentasi Chart.js untuk format yang tepat.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveChart()">Simpan</button>
                <button type="button" class="btn btn-success" onclick="previewChart()">Preview</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Global variables
    let charts = [];

    // Load data on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadCharts();
    });

    // Load charts
    function loadCharts() {
        fetch('<?= base_url("ajax/charts-indicators") ?>')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    charts = data.data;
                    renderCharts();
                } else {
                    console.error('Error loading charts:', data.message);
                }
            })
            .catch(error => {
                console.error('Network error:', error);
            });
    }

    // Render charts
    function renderCharts() {
        const container = document.getElementById('chartsContainer');

        let html = '';
        charts.forEach(chart => {
            const typeIcon = getChartTypeIcon(chart.chart_type);
            const locationBadge = getLocationBadge(chart.display_location);
            const statusBadge = chart.is_active ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-secondary">Inactive</span>';

            html += `
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 ${chart.is_active ? 'border-success' : 'border-secondary'}">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <i class="fas ${typeIcon} mr-2"></i>
                            <small class="text-muted">${chart.chart_type.toUpperCase()}</small>
                        </div>
                        ${statusBadge}
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">${chart.title}</h6>
                        <p class="card-text small text-muted">${chart.description || 'No description'}</p>
                        ${locationBadge}
                        <div class="mt-2">
                            <small class="text-muted">Section: ${chart.section || 'main'}</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group btn-group-sm w-100">
                            <button class="btn btn-outline-primary" onclick="editChart(${chart.id})">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button class="btn btn-outline-success" onclick="previewChartById(${chart.id})">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                            <button class="btn btn-outline-danger" onclick="deleteChart(${chart.id})">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        });

        if (html === '') {
            html = `
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-chart-line fa-4x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada chart</h5>
                    <p class="text-muted">Klik "Tambah Chart" untuk membuat chart baru</p>
                </div>
            </div>
        `;
        }

        container.innerHTML = html;
    }

    // Helper functions
    function getChartTypeIcon(type) {
        const icons = {
            'line': 'fa-chart-line',
            'bar': 'fa-chart-bar',
            'pie': 'fa-chart-pie',
            'doughnut': 'fa-chart-pie',
            'area': 'fa-chart-area'
        };
        return icons[type] || 'fa-chart-bar';
    }

    function getLocationBadge(location) {
        const badges = {
            'dashboard': '<span class="badge badge-success">Dashboard</span>',
            'landing': '<span class="badge badge-primary">Landing</span>',
            'both': '<span class="badge badge-info">Both</span>'
        };
        return badges[location] || '<span class="badge badge-secondary">Unknown</span>';
    }

    // Edit chart
    function editChart(id) {
        const chart = charts.find(c => c.id == id);

        if (chart) {
            document.getElementById('editChartId').value = chart.id;
            document.getElementById('editChartTitle').value = chart.title;
            document.getElementById('editChartType').value = chart.chart_type;
            document.getElementById('editChartLocation').value = chart.display_location;
            document.getElementById('editChartSection').value = chart.section || '';
            document.getElementById('editChartDescription').value = chart.description || '';
            document.getElementById('editChartData').value = chart.chart_data || '';

            $('#editChartModal').modal('show');
        }
    }

    // Save chart
    function saveChart() {
        const id = document.getElementById('editChartId').value;
        const title = document.getElementById('editChartTitle').value;
        const type = document.getElementById('editChartType').value;
        const location = document.getElementById('editChartLocation').value;
        const section = document.getElementById('editChartSection').value;
        const description = document.getElementById('editChartDescription').value;
        const chartData = document.getElementById('editChartData').value;

        // Validate JSON
        try {
            if (chartData) {
                JSON.parse(chartData);
            }
        } catch (e) {
            alert('Format JSON tidak valid!');
            return;
        }

        const data = {
            id: id,
            title: title,
            chart_type: type,
            display_location: location,
            section: section,
            description: description,
            chart_data: chartData
        };

        fetch('<?= base_url("ajax/update-chart") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#editChartModal').modal('hide');
                    loadCharts();
                    alert('Chart berhasil diperbarui!');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan jaringan');
            });
    }

    // Delete chart
    function deleteChart(id) {
        if (confirm('Apakah Anda yakin ingin menghapus chart ini?')) {
            fetch('<?= base_url("ajax/delete-chart") ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        id: id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        loadCharts();
                        alert('Chart berhasil dihapus!');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan jaringan');
                });
        }
    }

    // Preview chart
    function previewChart() {
        alert('Fitur preview chart akan segera tersedia!');
    }

    function previewChartById(id) {
        alert(`Preview chart ID ${id} akan segera tersedia!`);
    }

    // Add new chart
    function addNewChart() {
        // Clear form
        document.getElementById('editChartId').value = '';
        document.getElementById('editChartTitle').value = '';
        document.getElementById('editChartType').value = 'line';
        document.getElementById('editChartLocation').value = 'dashboard';
        document.getElementById('editChartSection').value = '';
        document.getElementById('editChartDescription').value = '';
        document.getElementById('editChartData').value = '';

        $('#editChartModal').modal('show');
    }

    // Sync charts
    function syncCharts() {
        fetch('<?= base_url("ajax/sync-charts") ?>', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadCharts();
                    alert('Charts berhasil disinkronkan!');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan jaringan');
            });
    }
</script>

<?= $this->endSection() ?>