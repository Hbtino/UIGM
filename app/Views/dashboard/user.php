<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard User - Kampus Berkelanjutan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }
        
        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, #149823ff 0%, #0b5804ff 100%);
            padding: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
        }
        
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }
        
        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }
        
        .sidebar nav {
            flex: 1;
        }
        
        .sidebar-header {
            padding: 25px 20px;
            background: rgba(0,0,0,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .sidebar-logo i {
            font-size: 32px;
            color: #4CAF50;
        }
        
        .sidebar-header h4 {
            color: white;
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }
        
        .sidebar-header p {
            color: rgba(255,255,255,0.7);
            font-size: 13px;
            margin: 5px 0 0;
        }
        
        .nav-section-title {
            padding: 15px 20px 8px;
            color: rgba(255,255,255,0.5);
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }
        
        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left-color: #4CAF50;
        }
        
        .nav-link.active {
            background-color: rgba(76, 175, 80, 0.2);
            color: white;
            border-left-color: #4CAF50;
            font-weight: 600;
        }
        
        .nav-link i {
            width: 24px;
            margin-right: 12px;
            font-size: 18px;
        }
        
        .sidebar-footer {
            padding: 20px;
            margin-top: auto;
            border-top: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.2);
        }
        
        .sidebar-footer p {
            color: rgba(255,255,255,0.5);
            font-size: 11px;
            margin: 0;
            text-align: center;
        }
        
        /* Main Content */
        .main-content {
            margin-left: 280px;
            padding: 30px;
            min-height: 100vh;
        }
        
        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        .welcome-card h2 {
            color: #149823ff;
            margin-bottom: 10px;
        }
        
        .info-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
        }
        
        .info-card i {
            font-size: 40px;
            margin-bottom: 15px;
        }
        
        .info-card h4 {
            margin-bottom: 10px;
            color: #333;
        }
        
        .info-card p {
            color: #666;
            margin: 0;
        }
        
        .card-green { color: #149823ff; }
        .card-blue { color: #0d6efd; }
        .card-orange { color: #fd7e14; }
        .card-purple { color: #6f42c1; }
        
        .content-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .content-section h3 {
            color: #149823ff;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #149823ff;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <i class="fas fa-leaf"></i>
                <div>
                    <h4>POLBAN</h4>
                    <p>Kampus Berkelanjutan</p>
                </div>
            </div>
        </div>
        
        <nav>
            <div class="nav-section-title">Menu Utama</div>
            <ul class="nav-menu">
                <li><a href="<?= base_url('dashboard') ?>" class="nav-link active"><i class="fas fa-home"></i> Dashboard</a></li>
            </ul>
            
            <div class="nav-section-title">Informasi</div>
            <ul class="nav-menu">
                <li><a href="<?= base_url('dashboard/user/info-sdgs') ?>" class="nav-link"><i class="fas fa-info-circle"></i> Tentang SDGs</a></li>
                <li><a href="<?= base_url('dashboard/user/kriteria') ?>" class="nav-link"><i class="fas fa-list-check"></i> Kriteria UI GreenMetric</a></li>
            </ul>
            
            <div class="nav-section-title">Akun</div>
            <ul class="nav-menu">
                <li><a href="<?= base_url('settings') ?>" class="nav-link"><i class="fas fa-user-edit"></i> Edit Profil</a></li>
                <li><a href="<?= base_url('logout') ?>" class="nav-link"><i class="fas fa-sign-out-alt"></i> Keluar</a></li>
            </ul>
        </nav>
        
        <div class="sidebar-footer">
            <p>&copy; 2024 Politeknik Negeri Bandung<br>Kampus Berkelanjutan</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Welcome Card -->
        <div class="welcome-card">
            <h2><i class="fas fa-hand-wave"></i> Selamat Datang, <?= esc($user_name) ?>!</h2>
            <p>Anda login sebagai <strong>User</strong>. Anda dapat melihat informasi tentang program Kampus Berkelanjutan POLBAN.</p>
        </div>

        <!-- Statistics Cards -->
        <div class="info-cards">
            <div class="info-card">
                <i class="fas fa-trophy card-green"></i>
                <h4>Target Skor 2028</h4>
                <p style="font-size: 32px; font-weight: 700; color: #149823ff; margin: 10px 0;">80</p>
                <p style="font-size: 14px; margin: 0;">Skor UI GreenMetric</p>
            </div>
            
            <div class="info-card">
                <i class="fas fa-globe card-blue"></i>
                <h4>Target Ranking Dunia</h4>
                <p style="font-size: 32px; font-weight: 700; color: #0d6efd; margin: 10px 0;">500</p>
                <p style="font-size: 14px; margin: 0;">Peringkat Global</p>
            </div>
            
            <div class="info-card">
                <i class="fas fa-flag card-orange"></i>
                <h4>Target Ranking Indonesia</h4>
                <p style="font-size: 32px; font-weight: 700; color: #fd7e14; margin: 10px 0;">50</p>
                <p style="font-size: 14px; margin: 0;">Peringkat Nasional</p>
            </div>
            
            <div class="info-card">
                <i class="fas fa-list-check card-purple"></i>
                <h4>Kriteria Penilaian</h4>
                <p style="font-size: 32px; font-weight: 700; color: #6f42c1; margin: 10px 0;">6</p>
                <p style="font-size: 14px; margin: 0;">Kriteria SDGs</p>
            </div>
        </div>

        <!-- Campus Statistics -->
        <div class="content-section">
            <h3><i class="fas fa-chart-bar"></i> Statistik Kampus POLBAN</h3>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                        <i class="fas fa-users" style="font-size: 40px; color: #149823ff; margin-bottom: 10px;"></i>
                        <h4 style="font-size: 28px; font-weight: 700; color: #149823ff; margin: 10px 0;">12,000</h4>
                        <p style="margin: 0; color: #666;">Mahasiswa</p>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                        <i class="fas fa-chalkboard-teacher" style="font-size: 40px; color: #0d6efd; margin-bottom: 10px;"></i>
                        <h4 style="font-size: 28px; font-weight: 700; color: #0d6efd; margin: 10px 0;">500</h4>
                        <p style="margin: 0; color: #666;">Dosen</p>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                        <i class="fas fa-building" style="font-size: 40px; color: #fd7e14; margin-bottom: 10px;"></i>
                        <h4 style="font-size: 28px; font-weight: 700; color: #fd7e14; margin: 10px 0;">7</h4>
                        <p style="margin: 0; color: #666;">Jurusan</p>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div style="text-align: center; padding: 20px; background: #f8f9fa; border-radius: 10px;">
                        <i class="fas fa-graduation-cap" style="font-size: 40px; color: #6f42c1; margin-bottom: 10px;"></i>
                        <h4 style="font-size: 28px; font-weight: 700; color: #6f42c1; margin: 10px 0;">30</h4>
                        <p style="margin: 0; color: #666;">Program Studi</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Infrastructure Data -->
        <div class="content-section">
            <h3><i class="fas fa-building"></i> Data Infrastruktur Kampus</h3>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div style="padding: 20px; background: #e8f5e9; border-left: 4px solid #4CAF50; border-radius: 5px;">
                        <h5 style="color: #2E7D32; margin-bottom: 10px;"><i class="fas fa-map"></i> Luas Kampus</h5>
                        <p style="font-size: 24px; font-weight: 700; color: #2E7D32; margin: 5px 0;">200,000 m²</p>
                        <p style="margin: 0; color: #666; font-size: 14px;">Total area kampus</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div style="padding: 20px; background: #e3f2fd; border-left: 4px solid #2196F3; border-radius: 5px;">
                        <h5 style="color: #1565C0; margin-bottom: 10px;"><i class="fas fa-home"></i> Luas Bangunan</h5>
                        <p style="font-size: 24px; font-weight: 700; color: #1565C0; margin: 5px 0;">50,000 m²</p>
                        <p style="margin: 0; color: #666; font-size: 14px;">Total area bangunan</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div style="padding: 20px; background: #fff3e0; border-left: 4px solid #FF9800; border-radius: 5px;">
                        <h5 style="color: #E65100; margin-bottom: 10px;"><i class="fas fa-door-open"></i> Jumlah Bangunan</h5>
                        <p style="font-size: 24px; font-weight: 700; color: #E65100; margin: 5px 0;">50</p>
                        <p style="margin: 0; color: #666; font-size: 14px;">Gedung & fasilitas</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Target SDGs -->
        <div class="content-section">
            <h3><i class="fas fa-chart-bar"></i> Target Skor UI GreenMetric 2028</h3>
            <p style="color: #666; margin-bottom: 20px;">Berikut adalah target pencapaian skor untuk setiap kriteria berdasarkan UI GreenMetric:</p>
            
            <div style="position: relative; height: 400px;">
                <canvas id="targetChart"></canvas>
            </div>
        </div>

        <!-- About Section -->
        <div class="content-section">
            <h3><i class="fas fa-info-circle"></i> Tentang Program Kampus Berkelanjutan</h3>
            <p style="line-height: 1.8; color: #666;">
                Program Kampus Berkelanjutan POLBAN merupakan inisiatif strategis yang bertujuan untuk mengintegrasikan prinsip-prinsip pembangunan berkelanjutan dalam seluruh aspek kehidupan kampus. Program ini sejalan dengan Sustainable Development Goals (SDGs) dan UI GreenMetric World University Ranking.
            </p>
            <br>
            <p style="line-height: 1.8; color: #666;">
                Melalui program ini, POLBAN berkomitmen untuk mengurangi jejak karbon, meningkatkan efisiensi energi, mengelola limbah dengan baik, menyediakan transportasi ramah lingkungan, dan mengintegrasikan pendidikan keberlanjutan dalam kurikulum.
            </p>
        </div>

        <!-- SDGs Criteria Section -->
        <div class="content-section">
            <h3><i class="fas fa-list-check"></i> 6 Kriteria UI GreenMetric</h3>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div style="padding: 20px; background: #f8f9fa; border-left: 4px solid #149823ff; border-radius: 5px;">
                        <h5><i class="fas fa-building"></i> Setting & Infrastructure (SI)</h5>
                        <p style="margin: 0; color: #666;">Pengaturan dan infrastruktur kampus yang mendukung keberlanjutan</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div style="padding: 20px; background: #f8f9fa; border-left: 4px solid #0d6efd; border-radius: 5px;">
                        <h5><i class="fas fa-bolt"></i> Energy & Climate Change (EC)</h5>
                        <p style="margin: 0; color: #666;">Penggunaan energi dan upaya mitigasi perubahan iklim</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div style="padding: 20px; background: #f8f9fa; border-left: 4px solid #0dcaf0; border-radius: 5px;">
                        <h5><i class="fas fa-tint"></i> Water (WR)</h5>
                        <p style="margin: 0; color: #666;">Pengelolaan dan konservasi sumber daya air</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div style="padding: 20px; background: #f8f9fa; border-left: 4px solid #fd7e14; border-radius: 5px;">
                        <h5><i class="fas fa-recycle"></i> Waste (WS)</h5>
                        <p style="margin: 0; color: #666;">Pengelolaan limbah dan program daur ulang</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div style="padding: 20px; background: #f8f9fa; border-left: 4px solid #6f42c1; border-radius: 5px;">
                        <h5><i class="fas fa-bus"></i> Transportation (TR)</h5>
                        <p style="margin: 0; color: #666;">Sistem transportasi ramah lingkungan</p>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div style="padding: 20px; background: #f8f9fa; border-left: 4px solid #198754; border-radius: 5px;">
                        <h5><i class="fas fa-graduation-cap"></i> Education & Research (ED)</h5>
                        <p style="margin: 0; color: #666;">Pendidikan dan penelitian tentang keberlanjutan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div style="background: linear-gradient(135deg, #0a2540 0%, #1e3a5f 100%); border-radius: 15px; padding: 40px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); margin-bottom: 30px;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 30px;">
                <div style="flex: 1; min-width: 300px;">
                    <h3 style="color: #4CAF50; margin-bottom: 25px; font-size: 24px;">
                        <i class="fas fa-info-circle"></i> Further Information
                    </h3>
                    
                    <div style="margin-bottom: 20px;">
                        <p style="color: #fff; margin: 0; line-height: 1.8;">
                            <i class="fas fa-map-marker-alt" style="color: #4CAF50; margin-right: 10px;"></i>
                            Jl. Gegerkalong Hilir, Ciwaruga, Kec. Parongpong,<br>
                            <span style="margin-left: 30px;">Kabupaten Bandung Barat, Jawa Barat</span><br>
                            <span style="margin-left: 30px;">Kode Pos 40559 | Kotak Pos Bandung 1234</span>
                        </p>
                    </div>
                    
                    <div style="margin-bottom: 20px;">
                        <p style="color: #fff; margin: 0;">
                            <i class="fas fa-phone" style="color: #4CAF50; margin-right: 10px;"></i>
                            022 - 2013789 | 022 - 2015721
                        </p>
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <p style="color: #fff; margin: 0;">
                            <i class="fas fa-envelope" style="color: #4CAF50; margin-right: 10px;"></i>
                            polban@polban.ac.id
                        </p>
                    </div>
                    
                    <div style="display: flex; gap: 15px;">
                        <a href="https://www.facebook.com/polbanofficial" target="_blank" style="width: 40px; height: 40px; background: #3b5998; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.3s;">
                            <i class="fab fa-facebook-f" style="color: white; font-size: 18px;"></i>
                        </a>
                        <a href="https://www.instagram.com/polbanofficial" target="_blank" style="width: 40px; height: 40px; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.3s;">
                            <i class="fab fa-instagram" style="color: white; font-size: 18px;"></i>
                        </a>
                        <a href="https://www.youtube.com/@polbanofficial" target="_blank" style="width: 40px; height: 40px; background: #FF0000; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: transform 0.3s;">
                            <i class="fab fa-youtube" style="color: white; font-size: 18px;"></i>
                        </a>
                    </div>
                </div>
                
                <div style="display: flex; align-items: center; justify-content: center;">
                    <div style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                        <img src="<?= base_url('assets/images/polban-logo.png') ?>" alt="POLBAN Logo" style="width: 150px; height: auto; display: block;" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                        <div style="display: none; text-align: center;">
                            <i class="fas fa-university" style="font-size: 80px; color: #149823ff;"></i>
                            <h4 style="color: #0a2540; margin-top: 15px; font-weight: 700;">POLBAN</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Chart for Target Skor UI GreenMetric 2028
        const ctx = document.getElementById('targetChart').getContext('2d');
        const targetChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    'Setting & Infrastructure (SI)',
                    'Energy & Climate Change (EC)',
                    'Waste (WS)',
                    'Water (WR)',
                    'Transportation (TR)',
                    'Education & Research (ED)'
                ],
                datasets: [{
                    label: 'Target Skor 2028',
                    data: [90, 82, 88, 95, 39, 80],
                    backgroundColor: [
                        'rgba(33, 150, 243, 0.8)',
                        'rgba(255, 152, 0, 0.8)',
                        'rgba(76, 175, 80, 0.8)',
                        'rgba(0, 188, 212, 0.8)',
                        'rgba(156, 39, 176, 0.8)',
                        'rgba(244, 67, 54, 0.8)'
                    ],
                    borderColor: [
                        'rgba(33, 150, 243, 1)',
                        'rgba(255, 152, 0, 1)',
                        'rgba(76, 175, 80, 1)',
                        'rgba(0, 188, 212, 1)',
                        'rgba(156, 39, 176, 1)',
                        'rgba(244, 67, 54, 1)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' poin';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            stepSize: 10,
                            font: {
                                size: 12
                            }
                        },
                        title: {
                            display: true,
                            text: 'Skor Target',
                            font: {
                                size: 14,
                                weight: 'bold'
                            }
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                size: 11
                            },
                            maxRotation: 45,
                            minRotation: 45
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
