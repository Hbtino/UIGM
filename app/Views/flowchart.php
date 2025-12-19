<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flowchart Sistem Role Dashboard UIGM - Polban</title>
    <script src="https://cdn.jsdelivr.net/npm/mermaid@10.6.1/dist/mermaid.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px 0;
            margin-bottom: 30px;
        }

        .flowchart-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .flowchart-header {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 20px;
            border-bottom: 3px solid #0066cc;
        }

        .flowchart-content {
            padding: 30px;
            min-height: 400px;
        }

        .nav-pills .nav-link {
            border-radius: 25px;
            margin: 0 5px;
            transition: all 0.3s ease;
        }

        .nav-pills .nav-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .nav-pills .nav-link:hover:not(.active) {
            background: rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .mermaid {
            text-align: center;
            background: #fafafa;
            border-radius: 10px;
            padding: 20px;
            margin: 20px 0;
        }

        .legend {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .legend h5 {
            margin-bottom: 15px;
            font-weight: bold;
        }

        .legend-item {
            display: inline-block;
            margin: 5px 10px;
            padding: 5px 10px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            font-size: 0.9em;
        }

        .btn-download {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-download:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(17, 153, 142, 0.4);
            color: white;
        }

        .btn-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 10px 25px;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }

        .loading {
            text-align: center;
            padding: 50px;
            color: #666;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        @media (max-width: 768px) {
            .flowchart-content {
                padding: 15px;
            }

            .nav-pills {
                flex-wrap: wrap;
            }

            .nav-pills .nav-link {
                margin: 2px;
                font-size: 0.9em;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="mb-0">
                        <i class="fas fa-sitemap text-primary me-3"></i>
                        Flowchart Sistem Role Dashboard UIGM
                    </h1>
                    <p class="mb-0 text-muted">Politeknik Negeri Bandung - Kampus Berkelanjutan</p>
                </div>
                <div class="col-md-6 text-end">
                    <a href="<?= base_url('/dashboard') ?>" class="btn btn-back me-2">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Dashboard
                    </a>
                    <button class="btn btn-download" onclick="downloadCurrentChart()">
                        <i class="fas fa-download me-2"></i>Download PNG
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Navigation Tabs -->
        <ul class="nav nav-pills justify-content-center mb-4" id="flowchartTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="main-tab" data-bs-toggle="pill" data-bs-target="#main" type="button" role="tab">
                    <i class="fas fa-home me-2"></i>Sistem Utama
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="admin-pusat-tab" data-bs-toggle="pill" data-bs-target="#admin-pusat" type="button" role="tab">
                    <i class="fas fa-crown me-2"></i>Admin Pusat
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="admin-unit-tab" data-bs-toggle="pill" data-bs-target="#admin-unit" type="button" role="tab">
                    <i class="fas fa-building me-2"></i>Admin Unit
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kaprodi-tab" data-bs-toggle="pill" data-bs-target="#kaprodi" type="button" role="tab">
                    <i class="fas fa-user-tie me-2"></i>Kaprodi
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dosen-tab" data-bs-toggle="pill" data-bs-target="#dosen" type="button" role="tab">
                    <i class="fas fa-graduation-cap me-2"></i>Dosen
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pimpinan-tab" data-bs-toggle="pill" data-bs-target="#pimpinan" type="button" role="tab">
                    <i class="fas fa-chart-line me-2"></i>Pimpinan
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="user-tab" data-bs-toggle="pill" data-bs-target="#user" type="button" role="tab">
                    <i class="fas fa-users me-2"></i>User/Staff
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="auth-tab" data-bs-toggle="pill" data-bs-target="#auth" type="button" role="tab">
                    <i class="fas fa-shield-alt me-2"></i>Authentication
                </button>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="flowchartTabContent">
            <!-- Main System -->
            <div class="tab-pane fade show active" id="main" role="tabpanel">
                <div class="flowchart-container">
                    <div class="flowchart-header">
                        <h3><i class="fas fa-sitemap me-2"></i>Flowchart Utama - Role-Based Dashboard System</h3>
                        <p class="mb-0">Overview sistem dashboard berdasarkan role pengguna</p>
                    </div>
                    <div class="flowchart-content">
                        <div class="loading" id="loading-main">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-3">Memuat flowchart...</p>
                        </div>
                        <div class="mermaid" id="chart-main" style="display: none;">
                            flowchart TD
                            A[User Login] --> B{Authentication Success?}
                            B -->|No| C[Redirect to Login Page]
                            B -->|Yes| D[Get User Role]

                            D --> E{Role Check}

                            E -->|admin| F[Admin Pusat Dashboard]
                            E -->|admin_unit/sarpras/umum/lppm| G[Admin Unit Dashboard]
                            E -->|kaprodi| H[Kaprodi Dashboard]
                            E -->|dosen| I[Dosen Dashboard]
                            E -->|pimpinan/direktur/wakil_direktur| J[Pimpinan Dashboard]
                            E -->|user/staff/other| K[User Dashboard]

                            F --> F1[Kontrol & Monitoring]
                            G --> G1[Input & Update Data Unit]
                            H --> H1[Review Data Dosen]
                            I --> I1[Input Data Pribadi]
                            J --> J1[Monitoring Read-only]
                            K --> K1[Dashboard Read-only]

                            F1 --> F2[Progress per Kategori UIGM<br />Status Tahun<br />Validasi Data<br />Export Laporan]
                            G1 --> G2[Progress Unit<br />Kategori Tanggung Jawab<br />Upload Bukti<br />Submit Review]
                            H1 --> H2[Status Dosen<br />Approve/Reject<br />Rekap ED per Prodi<br />Export Data]
                            I1 --> I2[Checklist ED<br />Submit Review<br />Auto-save<br />Deadline Tracking]
                            J1 --> J2[KPI Overview<br />Grafik Skor UIGM<br />Ranking Progress<br />Download Laporan]
                            K1 --> K2[View Only Dashboard<br />Basic Information]
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Pusat -->
            <div class="tab-pane fade" id="admin-pusat" role="tabpanel">
                <div class="flowchart-container">
                    <div class="flowchart-header">
                        <h3><i class="fas fa-crown me-2"></i>Admin Pusat - Kontrol & Monitoring</h3>
                        <p class="mb-0">Workflow untuk admin pusat dengan kontrol penuh sistem</p>
                    </div>
                    <div class="flowchart-content">
                        <div class="loading" id="loading-admin-pusat">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-3">Memuat flowchart...</p>
                        </div>
                        <div class="mermaid" id="chart-admin-pusat" style="display: none;">
                            flowchart TD
                            A[Admin Pusat Login] --> B[Dashboard Admin Pusat]

                            B --> C[Progress Overview]
                            B --> D[Validation Center]
                            B --> E[Year Management]
                            B --> F[Reports & Export]
                            B --> G[Real-time Monitoring]

                            C --> C1[SI Progress: 75%]
                            C --> C2[EC Progress: 82%]
                            C --> C3[WS Progress: 68%]
                            C --> C4[WR Progress: 71%]
                            C --> C5[TR Progress: 85%]
                            C --> C6[ED Progress: 92%]

                            D --> D1[Pending Validation: 35]
                            D --> D2[Today's Validation: 12]
                            D --> D3[Bulk Validation]
                            D --> D4[Validation Queue]

                            E --> E1{Year Status}
                            E1 -->|Open| E2[Set to Review]
                            E1 -->|Review| E3[Lock Year]
                            E1 -->|Locked| E4[Finalize Year]

                            F --> F1[Summary Report PDF]
                            F --> F2[Detailed Data Excel]
                            F --> F3[Progress Report]

                            G --> G1[Active Users: 23]
                            G --> G2[Uploads Today: 8]
                            G --> G3[Open Issues: 3]

                            D3 --> D5[Mass Approve/Reject]
                            F1 --> F4[Download Executive Summary]
                            F2 --> F5[Download Full Dataset]
                            F3 --> F6[Download Analytics]
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Unit -->
            <div class="tab-pane fade" id="admin-unit" role="tabpanel">
                <div class="flowchart-container">
                    <div class="flowchart-header">
                        <h3><i class="fas fa-building me-2"></i>Admin Unit - Input & Update Data</h3>
                        <p class="mb-0">Workflow untuk admin unit (Sarpras, Umum, LPPM)</p>
                    </div>
                    <div class="flowchart-content">
                        <div class="loading" id="loading-admin-unit">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-3">Memuat flowchart...</p>
                        </div>
                        <div class="mermaid" id="chart-admin-unit" style="display: none;">
                            flowchart TD
                            A[Admin Unit Login] --> B{Unit Type}

                            B -->|Sarpras| C[Sarpras Dashboard]
                            B -->|Umum| D[Umum Dashboard]
                            B -->|LPPM| E[LPPM Dashboard]

                            C --> C1[SI: Setting & Infrastructure]
                            C --> C2[WS: Waste Management]
                            C --> C3[WR: Water Management]

                            D --> D1[SI: Setting & Infrastructure]
                            D --> D2[TR: Transportation]

                            E --> E1[ED: Education & Research]

                            C1 --> F[Unit Progress: 68%]
                            C2 --> F
                            C3 --> F
                            D1 --> F
                            D2 --> F
                            E1 --> F

                            F --> G[Data Management Actions]

                            G --> G1[Add New Data]
                            G --> G2[Upload Evidence]
                            G --> G3[Submit for Review]
                            G --> G4[Bulk Upload]

                            G1 --> H1[Form Input Data]
                            G2 --> H2[File Upload System]
                            G3 --> H3[Review Queue]
                            G4 --> H4[Excel/CSV Import]

                            H1 --> I[Save as Draft]
                            H2 --> I
                            H3 --> J[Pending Review Status]
                            H4 --> I

                            I --> K[Auto-save Every 30s]
                            J --> L[Admin Validation]

                            K --> M[Reminder System]
                            L --> N{Validation Result}

                            M --> M1[Deadline: 15 days]
                            M --> M2[Monthly Update: 25th]

                            N -->|Approved| O[Data Published]
                            N -->|Rejected| P[Revision Required]

                            P --> G1
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kaprodi -->
            <div class="tab-pane fade" id="kaprodi" role="tabpanel">
                <div class="flowchart-container">
                    <div class="flowchart-header">
                        <h3><i class="fas fa-user-tie me-2"></i>Kaprodi - Review Data Dosen</h3>
                        <p class="mb-0">Workflow untuk kepala program studi dalam review data dosen</p>
                    </div>
                    <div class="flowchart-content">
                        <div class="loading" id="loading-kaprodi">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-3">Memuat flowchart...</p>
                        </div>
                        <div class="mermaid" id="chart-kaprodi" style="display: none;">
                            flowchart TD
                            A[Kaprodi Login] --> B[Kaprodi Dashboard]

                            B --> C[Dosen Status Overview]
                            B --> D[Dosen Management]
                            B --> E[ED Recap per Prodi]

                            C --> C1[Belum Submit: 8]
                            C --> C2[Menunggu Review: 12]
                            C --> C3[Perlu Revisi: 3]
                            C --> C4[Selesai: 2]

                            D --> D1[Dosen List Table]
                            D1 --> D2{Dosen Status}

                            D2 -->|Menunggu Review| D3[Review Actions]
                            D2 -->|Perlu Revisi| D4[View Revision]
                            D2 -->|Belum Submit| D5[Send Reminder]
                            D2 -->|Selesai| D6[View Details]

                            D3 --> D7{Review Decision}
                            D7 -->|Approve| D8[Approve Data]
                            D7 -->|Reject| D9[Request Revision]

                            D8 --> D10[Data Approved]
                            D9 --> D11[Send Revision Request]

                            D11 --> D12[Input Revision Reason]
                            D12 --> D13[Notify Dosen]

                            E --> E1[Publikasi Recap]
                            E --> E2[Penelitian Recap]
                            E --> E3[Pengabdian Recap]

                            E1 --> E4[Jurnal: 45<br />Konferensi: 23<br />Buku: 8]
                            E2 --> E5[Internal: 12<br />Eksternal: 8<br />Kolaborasi: 5]
                            E3 --> E6[Masyarakat: 15<br />Industri: 7<br />Pemerintah: 3]

                            E4 --> F[Export Recap]
                            E5 --> F
                            E6 --> F

                            F --> F1[PDF Report]
                            F --> F2[Excel Data]

                            D5 --> G[Notification System]
                            D13 --> G
                            G --> G1[Email Notification]
                            G --> G2[Dashboard Alert]
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dosen -->
            <div class="tab-pane fade" id="dosen" role="tabpanel">
                <div class="flowchart-container">
                    <div class="flowchart-header">
                        <h3><i class="fas fa-graduation-cap me-2"></i>Dosen - Input Data Pribadi</h3>
                        <p class="mb-0">Workflow untuk dosen dalam input data Education & Research</p>
                    </div>
                    <div class="flowchart-content">
                        <div class="loading" id="loading-dosen">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-3">Memuat flowchart...</p>
                        </div>
                        <div class="mermaid" id="chart-dosen" style="display: none;">
                            flowchart TD
                            A[Dosen Login] --> B[Dosen Dashboard]

                            B --> C[Profile Status Check]
                            B --> D[ED Data Checklist]
                            B --> E[Deadline Tracking]

                            C --> C1{Profile Complete?}
                            C1 -->|< 90%| C2[Update Profile Required]
                                C1 -->|≥ 90%| C3[Profile Complete ✓]

                                C2 --> C4[Edit Profile Form]
                                C4 --> C5[Save Profile Data]

                                D --> D1[Publikasi Checklist]
                                D --> D2[Penelitian Checklist]
                                D --> D3[Pengabdian Checklist]

                                D1 --> D4{Publikasi Status}
                                D4 -->|Incomplete| D5[Add Publikasi]
                                D4 -->|Complete| D6[Publikasi ✓]

                                D2 --> D7{Penelitian Status}
                                D7 -->|Incomplete| D8[Add Penelitian]
                                D7 -->|Complete| D9[Penelitian ✓]

                                D3 --> D10{Pengabdian Status}
                                D10 -->|Incomplete| D11[Add Pengabdian]
                                D10 -->|Complete| D12[Pengabdian ✓]

                                D5 --> D13[Publikasi Form]
                                D8 --> D14[Penelitian Form]
                                D11 --> D15[Pengabdian Form]

                                D13 --> F[Auto-save System]
                                D14 --> F
                                D15 --> F
                                C5 --> F

                                F --> F1[Save Draft Every 30s]
                                F1 --> F2[Local Storage Backup]

                                E --> E1[Deadline Counter]
                                E1 --> E2{Days Left}
                                E2 -->|> 15| E3[Normal Status]
                                E2 -->|≤ 15| E4[Warning Alert]
                                E2 -->|≤ 7| E5[Urgent Alert]

                                E4 --> E6[Show Notification]
                                E5 --> E7[Show Critical Alert]

                                C3 --> G[Submit Readiness Check]
                                D6 --> G
                                D9 --> G
                                D12 --> G

                                G --> G1{Ready to Submit?}
                                G1 -->|Profile ≥ 90% AND ED ≥ 70%| G2[Enable Submit Button]
                                G1 -->|Requirements Not Met| G3[Disable Submit Button]

                                G2 --> G4[Submit for Review]
                                G4 --> G5[Confirmation Dialog]
                                G5 --> G6{Confirm Submit?}

                                G6 -->|Yes| G7[Submit to Kaprodi]
                                G6 -->|No| G8[Continue Editing]

                                G7 --> G9[Status: Under Review]
                                G8 --> F

                                G9 --> H[Kaprodi Review Process]
                                H --> H1{Review Result}

                                H1 -->|Approved| H2[Status: Approved]
                                H1 -->|Revision Required| H3[Status: Needs Revision]

                                H3 --> H4[View Revision Comments]
                                H4 --> H5[Make Corrections]
                                H5 --> F
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pimpinan -->
            <div class="tab-pane fade" id="pimpinan" role="tabpanel">
                <div class="flowchart-container">
                    <div class="flowchart-header">
                        <h3><i class="fas fa-chart-line me-2"></i>Pimpinan - Monitoring Read-only</h3>
                        <p class="mb-0">Executive dashboard untuk monitoring dan laporan</p>
                    </div>
                    <div class="flowchart-content">
                        <div class="loading" id="loading-pimpinan">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-3">Memuat flowchart...</p>
                        </div>
                        <div class="mermaid" id="chart-pimpinan" style="display: none;">
                            flowchart TD
                            A[Pimpinan Login] --> B[Executive Dashboard]

                            B --> C[KPI Overview]
                            B --> D[UIGM Score Trends]
                            B --> E[Ranking Progress]
                            B --> F[Download Center]

                            C --> C1[Current Score: 5410]
                            C --> C2[World Rank: #942]
                            C --> C3[Indonesia Rank: #25]
                            C --> C4[Completion: 78%]

                            C1 --> C5[+850 from 2024 ↑]
                            C2 --> C6[+90 positions ↑]
                            C3 --> C7[Target: #20]
                            C4 --> C8[On Track]

                            D --> D1[Chart View Options]
                            D1 --> D2[Total Score View]
                            D1 --> D3[Category View]
                            D1 --> D4[Comparison View]

                            D2 --> D5[Line Chart: 2023-2025]
                            D3 --> D6[Multi-line: SI,EC,WS,WR,TR,ED]
                            D4 --> D7[Growth Rate Comparison]

                            E --> E1[Global Ranking]
                            E --> E2[National Statistics]

                            E1 --> E3[2024: #1032 → 2025: #942]
                            E1 --> E4[Target 2026: #800]

                            E2 --> E5[Total Universities: 150]
                            E2 --> E6[Polban Position: #25]
                            E2 --> E7[Top 17% Nationally]

                            F --> F1[Executive Summary PDF]
                            F --> F2[Detailed Data Excel]
                            F --> F3[Trend Analysis Report]

                            F1 --> F4[High-level Overview]
                            F2 --> F5[Complete Dataset]
                            F3 --> F6[Predictive Analytics]

                            D5 --> G[Interactive Charts]
                            D6 --> G
                            D7 --> G

                            G --> G1[Zoom & Pan]
                            G --> G2[Data Point Details]
                            G --> G3[Export Chart Image]

                            F4 --> H[Stakeholder Reports]
                            F5 --> H
                            F6 --> H

                            H --> H1[Board Presentation]
                            H --> H2[Ministry Reports]
                            H --> H3[Public Disclosure]
                        </div>
                    </div>
                </div>
            </div>

            <!-- User/Staff -->
            <div class="tab-pane fade" id="user" role="tabpanel">
                <div class="flowchart-container">
                    <div class="flowchart-header">
                        <h3><i class="fas fa-users me-2"></i>User/Staff - Read-only Dashboard</h3>
                        <p class="mb-0">Dashboard untuk user umum dan staff dengan akses terbatas</p>
                    </div>
                    <div class="flowchart-content">
                        <div class="loading" id="loading-user">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-3">Memuat flowchart...</p>
                        </div>
                        <div class="mermaid" id="chart-user" style="display: none;">
                            flowchart TD
                            A[User/Staff Login] --> B[Basic Dashboard]

                            B --> C[Campus Profile View]
                            B --> D[Facilities Information]
                            B --> E[UIGM Progress View]

                            C --> C1[Students: 6,605]
                            C --> C2[Faculty: 482]
                            C --> C3[Departments: 10]
                            C --> C4[Programs: 39]
                            C --> C5[Accreditation: Unggul]

                            D --> D1[Campus Area: 246,269 m²]
                            D --> D2[Building Area: 93,435 m²]
                            D --> D3[Buildings: 86]
                            D --> D4[Classrooms: 105]
                            D --> D5[Labs: 119]

                            E --> E1[Current UIGM Score]
                            E --> E2[Ranking Information]
                            E --> E3[Progress Charts]

                            E1 --> E4[Score: 5410/10000]
                            E2 --> E5[World: #942]
                            E2 --> E6[Indonesia: #25]

                            E3 --> E7[Read-only Charts]
                            E7 --> E8[Category Progress]
                            E7 --> E9[Historical Trends]

                            C1 --> F[Information Display Only]
                            C2 --> F
                            C3 --> F
                            C4 --> F
                            C5 --> F
                            D1 --> F
                            D2 --> F
                            D3 --> F
                            D4 --> F
                            D5 --> F
                            E4 --> F
                            E5 --> F
                            E6 --> F
                            E8 --> F
                            E9 --> F

                            F --> G[No Edit Permissions]
                            G --> G1[View Only Access]
                            G --> G2[No Data Input]
                            G --> G3[No Administrative Functions]
                        </div>
                    </div>
                </div>
            </div>

            <!-- Authentication -->
            <div class="tab-pane fade" id="auth" role="tabpanel">
                <div class="flowchart-container">
                    <div class="flowchart-header">
                        <h3><i class="fas fa-shield-alt me-2"></i>Authentication & Authorization</h3>
                        <p class="mb-0">Sistem autentikasi dan otorisasi berdasarkan role</p>
                    </div>
                    <div class="flowchart-content">
                        <div class="loading" id="loading-auth">
                            <div class="spinner-border text-primary" role="status"></div>
                            <p class="mt-3">Memuat flowchart...</p>
                        </div>
                        <div class="mermaid" id="chart-auth" style="display: none;">
                            flowchart TD
                            A[User Access Request] --> B[Login Page]

                            B --> C[Enter Credentials]
                            C --> D[Submit Login Form]

                            D --> E{Credentials Valid?}
                            E -->|No| F[Show Error Message]
                            E -->|Yes| G[Create Session]

                            F --> B

                            G --> H[Store User Data in Session]
                            H --> I[Get User Role from Database]

                            I --> J{Role Authorization}

                            J -->|admin| K[Full System Access]
                            J -->|admin_unit| L[Unit-Specific Access]
                            J -->|kaprodi| M[Prodi-Specific Access]
                            J -->|dosen| N[Personal Data Access]
                            J -->|pimpinan| O[Executive View Access]
                            J -->|user/staff| P[Read-Only Access]
                            J -->|unauthorized| Q[Access Denied]

                            K --> K1[All Categories Management]
                            K --> K2[User Management]
                            K --> K3[System Configuration]
                            K --> K4[Reports & Analytics]

                            L --> L1{Unit Type Check}
                            L1 -->|Sarpras| L2[SI, WS, WR Categories]
                            L1 -->|Umum| L3[SI, TR Categories]
                            L1 -->|LPPM| L4[ED Category Only]

                            M --> M1[Dosen Management in Prodi]
                            M --> M2[ED Data Review]
                            M --> M3[Prodi Reports]

                            N --> N1[Personal Profile]
                            N --> N2[Personal ED Data]
                            N --> N3[Submission Status]

                            O --> O1[Executive Dashboard]
                            O --> O2[KPI Monitoring]
                            O --> O3[Download Reports]

                            P --> P1[Campus Information]
                            P --> P2[Public Statistics]
                            P --> P3[General Progress]

                            Q --> Q1[Redirect to Login]
                            Q --> Q2[Show Access Denied]

                            K1 --> R[Dashboard Redirect]
                            K2 --> R
                            K3 --> R
                            K4 --> R
                            L2 --> R
                            L3 --> R
                            L4 --> R
                            M1 --> R
                            M2 --> R
                            M3 --> R
                            N1 --> R
                            N2 --> R
                            N3 --> R
                            O1 --> R
                            O2 --> R
                            O3 --> R
                            P1 --> R
                            P2 --> R
                            P3 --> R

                            R --> S[Role-Specific Dashboard Loaded]
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Legend -->
        <div class="legend">
            <h5><i class="fas fa-info-circle me-2"></i>Keterangan Singkatan</h5>
            <div class="row">
                <div class="col-md-6">
                    <span class="legend-item"><strong>SI:</strong> Setting & Infrastructure</span>
                    <span class="legend-item"><strong>EC:</strong> Energy & Climate Change</span>
                    <span class="legend-item"><strong>WS:</strong> Waste Management</span>
                    <span class="legend-item"><strong>WR:</strong> Water Management</span>
                </div>
                <div class="col-md-6">
                    <span class="legend-item"><strong>TR:</strong> Transportation</span>
                    <span class="legend-item"><strong>ED:</strong> Education & Research</span>
                    <span class="legend-item"><strong>UIGM:</strong> UI GreenMetric</span>
                    <span class="legend-item"><strong>KPI:</strong> Key Performance Indicators</span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize Mermaid with better error handling
        mermaid.initialize({
            startOnLoad: true,
            theme: 'default',
            themeVariables: {
                primaryColor: '#667eea',
                primaryTextColor: '#333',
                primaryBorderColor: '#4facfe',
                lineColor: '#666',
                secondaryColor: '#f093fb',
                tertiaryColor: '#fff'
            },
            flowchart: {
                useMaxWidth: true,
                htmlLabels: true,
                curve: 'basis'
            },
            securityLevel: 'loose'
        });

        // Track current active chart
        let currentChart = 'main';

        // Function to render chart when tab is shown
        function renderChart(chartId) {
            const loadingElement = document.getElementById(`loading-${chartId}`);
            const chartElement = document.getElementById(`chart-${chartId}`);

            if (chartElement && loadingElement) {
                // Show loading
                loadingElement.style.display = 'block';
                chartElement.style.display = 'none';

                // Render mermaid chart with better error handling
                setTimeout(() => {
                    try {
                        // Clear any existing content
                        chartElement.innerHTML = chartElement.textContent;

                        mermaid.init(undefined, chartElement).then(() => {
                            loadingElement.style.display = 'none';
                            chartElement.style.display = 'block';
                            currentChart = chartId;
                        }).catch(error => {
                            console.error('Error rendering chart:', error);
                            loadingElement.innerHTML = '<div class="text-danger"><i class="fas fa-exclamation-triangle"></i> Error loading chart: ' + error.message + '</div>';
                        });
                    } catch (error) {
                        console.error('Error initializing chart:', error);
                        loadingElement.innerHTML = '<div class="text-danger"><i class="fas fa-exclamation-triangle"></i> Error initializing chart: ' + error.message + '</div>';
                    }
                }, 500);
            }
        }

        // Initialize first chart after page load
        document.addEventListener('DOMContentLoaded', function() {
            // Wait for mermaid to be ready
            setTimeout(() => {
                renderChart('main');
            }, 1000);
        });

        // Handle tab changes
        document.addEventListener('shown.bs.tab', function(event) {
            const targetId = event.target.getAttribute('data-bs-target').substring(1);
            renderChart(targetId);
        });

        // Download function
        function downloadCurrentChart() {
            const chartElement = document.getElementById(`chart-${currentChart}`);
            if (chartElement) {
                const svg = chartElement.querySelector('svg');
                if (svg) {
                    // Create canvas and convert SVG to PNG
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');
                    const data = new XMLSerializer().serializeToString(svg);
                    const img = new Image();

                    img.onload = function() {
                        canvas.width = img.width;
                        canvas.height = img.height;
                        ctx.fillStyle = 'white';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0);

                        // Download
                        const link = document.createElement('a');
                        link.download = `flowchart-${currentChart}-${new Date().getTime()}.png`;
                        link.href = canvas.toDataURL();
                        link.click();
                    };

                    img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(data)));
                } else {
                    alert('Chart belum selesai dimuat. Silakan tunggu sebentar.');
                }
            }
        }

        // Add some interactive features
        document.addEventListener('click', function(e) {
            if (e.target.closest('.mermaid')) {
                // Add click effects or interactions here if needed
            }
        });
    </script>
</body>

</html>