<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="fas fa-tachometer-alt mr-2 text-success"></i>
                        Dashboard Statistics Management
                    </h3>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success" onclick="addNewStat()">
                            <i class="fas fa-plus"></i> Tambah Statistik
                        </button>
                        <button type="button" class="btn btn-info" onclick="refreshData()">
                            <i class="fas fa-sync"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Info Alert -->
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle"></i> Dashboard Statistics</h5>
                        <p>Kelola statistik yang ditampilkan di dashboard admin. Data ini mencakup target values, current values, campus information, dan calculated stats.</p>
                    </div>

                    <!-- Statistics by Category -->
                    <div class="row">
                        <!-- Target Values -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card border-primary">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-bullseye"></i> Target Values
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="targetValuesContainer">
                                        <!-- Will be populated by JavaScript -->
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary" onclick="addStatToCategory('target_values')">
                                        <i class="fas fa-plus"></i> Tambah Target
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Current Values -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card border-success">
                                <div class="card-header bg-success text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-chart-line"></i> Current Values
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="currentValuesContainer">
                                        <!-- Will be populated by JavaScript -->
                                    </div>
                                    <button class="btn btn-sm btn-outline-success" onclick="addStatToCategory('current_values')">
                                        <i class="fas fa-plus"></i> Tambah Current
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Campus Information -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card border-info">
                                <div class="card-header bg-info text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-university"></i> Campus Information
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="campusInfoContainer">
                                        <!-- Will be populated by JavaScript -->
                                    </div>
                                    <button class="btn btn-sm btn-outline-info" onclick="addStatToCategory('campus_info')">
                                        <i class="fas fa-plus"></i> Tambah Info
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Calculated Stats -->
                        <div class="col-lg-6 col-md-12 mb-4">
                            <div class="card border-warning">
                                <div class="card-header bg-warning text-white">
                                    <h5 class="mb-0">
                                        <i class="fas fa-calculator"></i> Calculated Stats
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div id="calculatedStatsContainer">
                                        <!-- Will be populated by JavaScript -->
                                    </div>
                                    <button class="btn btn-sm btn-outline-warning" onclick="addStatToCategory('calculated_stats')">
                                        <i class="fas fa-plus"></i> Tambah Calculated
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        <i class="fas fa-bolt"></i> Quick Actions
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group mr-2 mb-2">
                                        <button class="btn btn-outline-primary" onclick="previewDashboard()">
                                            <i class="fas fa-eye"></i> Preview Dashboard
                                        </button>
                                    </div>
                                    <div class="btn-group mr-2 mb-2">
                                        <button class="btn btn-outline-success" onclick="exportData()">
                                            <i class="fas fa-download"></i> Export Data
                                        </button>
                                    </div>
                                    <div class="btn-group mr-2 mb-2">
                                        <button class="btn btn-outline-info" onclick="importData()">
                                            <i class="fas fa-upload"></i> Import Data
                                        </button>
                                    </div>
                                    <div class="btn-group mr-2 mb-2">
                                        <button class="btn btn-outline-warning" onclick="resetToDefault()">
                                            <i class="fas fa-undo"></i> Reset to Default
                                        </button>
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

<!-- Edit Modal -->
<div class="modal fade" id="editStatModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Statistik</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editStatForm">
                    <input type="hidden" id="editStatId">
                    <div class="form-group">
                        <label for="editStatLabel">Label</label>
                        <input type="text" class="form-control" id="editStatLabel" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatValue">Value</label>
                        <input type="text" class="form-control" id="editStatValue" required>
                    </div>
                    <div class="form-group">
                        <label for="editStatIcon">Icon (Font Awesome class)</label>
                        <input type="text" class="form-control" id="editStatIcon" placeholder="fa-chart-line">
                    </div>
                    <div class="form-group">
                        <label for="editStatColor">Color</label>
                        <input type="color" class="form-control" id="editStatColor">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="saveStatistic()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Global variables
    let dashboardStats = {};

    // Load data on page load
    document.addEventListener('DOMContentLoaded', function() {
        loadDashboardStats();
    });

    // Load dashboard statistics
    function loadDashboardStats() {
        fetch('<?= base_url("ajax/dashboard-statistics") ?>')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    dashboardStats = data.data;
                    renderStatistics();
                } else {
                    console.error('Error loading dashboard stats:', data.message);
                }
            })
            .catch(error => {
                console.error('Network error:', error);
            });
    }

    // Render statistics by category
    function renderStatistics() {
        const categories = {
            'target_values': 'targetValuesContainer',
            'current_values': 'currentValuesContainer',
            'campus_info': 'campusInfoContainer',
            'calculated_stats': 'calculatedStatsContainer'
        };

        Object.keys(categories).forEach(category => {
            const container = document.getElementById(categories[category]);
            const stats = dashboardStats[category] || [];

            let html = '';
            stats.forEach(stat => {
                html += `
                <div class="d-flex justify-content-between align-items-center mb-2 p-2 border rounded">
                    <div class="d-flex align-items-center">
                        <i class="fas ${stat.icon || 'fa-chart-bar'} mr-2" style="color: ${stat.color || '#666'}"></i>
                        <div>
                            <strong>${stat.label}</strong><br>
                            <small class="text-muted">${stat.value}</small>
                        </div>
                    </div>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-primary" onclick="editStatistic(${stat.id})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-outline-danger" onclick="deleteStatistic(${stat.id})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            });

            if (html === '') {
                html = '<p class="text-muted text-center">Belum ada data</p>';
            }

            container.innerHTML = html;
        });
    }

    // Edit statistic
    function editStatistic(id) {
        // Find the statistic
        let stat = null;
        Object.values(dashboardStats).forEach(categoryStats => {
            const found = categoryStats.find(s => s.id == id);
            if (found) stat = found;
        });

        if (stat) {
            document.getElementById('editStatId').value = stat.id;
            document.getElementById('editStatLabel').value = stat.label;
            document.getElementById('editStatValue').value = stat.value;
            document.getElementById('editStatIcon').value = stat.icon || '';
            document.getElementById('editStatColor').value = stat.color || '#666666';

            $('#editStatModal').modal('show');
        }
    }

    // Save statistic
    function saveStatistic() {
        const id = document.getElementById('editStatId').value;
        const label = document.getElementById('editStatLabel').value;
        const value = document.getElementById('editStatValue').value;
        const icon = document.getElementById('editStatIcon').value;
        const color = document.getElementById('editStatColor').value;

        const data = {
            id: id,
            label: label,
            value: value,
            icon: icon,
            color: color
        };

        fetch('<?= base_url("ajax/update-dashboard-stat") ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    $('#editStatModal').modal('hide');
                    loadDashboardStats();
                    alert('Statistik berhasil diperbarui!');
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan jaringan');
            });
    }

    // Delete statistic
    function deleteStatistic(id) {
        if (confirm('Apakah Anda yakin ingin menghapus statistik ini?')) {
            fetch('<?= base_url("ajax/delete-dashboard-stat") ?>', {
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
                        loadDashboardStats();
                        alert('Statistik berhasil dihapus!');
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

    // Add new statistic
    function addNewStat() {
        alert('Fitur tambah statistik baru akan segera tersedia!');
    }

    function addStatToCategory(category) {
        alert(`Fitur tambah statistik untuk kategori ${category} akan segera tersedia!`);
    }

    // Refresh data
    function refreshData() {
        loadDashboardStats();
        alert('Data berhasil direfresh!');
    }

    // Quick actions
    function previewDashboard() {
        window.open('<?= base_url("dashboard") ?>', '_blank');
    }

    function exportData() {
        alert('Fitur export akan segera tersedia!');
    }

    function importData() {
        alert('Fitur import akan segera tersedia!');
    }

    function resetToDefault() {
        if (confirm('Apakah Anda yakin ingin mereset semua data ke default?')) {
            alert('Fitur reset akan segera tersedia!');
        }
    }
</script>

<?= $this->endSection() ?>