# Flowchart Sistem Role Dashboard UIGM

## 1. Flowchart Utama - Role-Based Dashboard System

```mermaid
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

    F1 --> F2[Progress per Kategori UIGM<br/>Status Tahun<br/>Validasi Data<br/>Export Laporan]
    G1 --> G2[Progress Unit<br/>Kategori Tanggung Jawab<br/>Upload Bukti<br/>Submit Review]
    H1 --> H2[Status Dosen<br/>Approve/Reject<br/>Rekap ED per Prodi<br/>Export Data]
    I1 --> I2[Checklist ED<br/>Submit Review<br/>Auto-save<br/>Deadline Tracking]
    J1 --> J2[KPI Overview<br/>Grafik Skor UIGM<br/>Ranking Progress<br/>Download Laporan]
    K1 --> K2[View Only Dashboard<br/>Basic Information]
```

## 2. Flowchart Admin Pusat - Kontrol & Monitoring

```mermaid
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
```

## 3. Flowchart Admin Unit - Input & Update Data

```mermaid
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
```

## 4. Flowchart Kaprodi - Review Data Dosen

```mermaid
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

    E1 --> E4[Jurnal: 45<br/>Konferensi: 23<br/>Buku: 8]
    E2 --> E5[Internal: 12<br/>Eksternal: 8<br/>Kolaborasi: 5]
    E3 --> E6[Masyarakat: 15<br/>Industri: 7<br/>Pemerintah: 3]

    E4 --> F[Export Recap]
    E5 --> F
    E6 --> F

    F --> F1[PDF Report]
    F --> F2[Excel Data]

    D5 --> G[Notification System]
    D13 --> G
    G --> G1[Email Notification]
    G --> G2[Dashboard Alert]
```

## 5. Flowchart Dosen - Input Data Pribadi

```mermaid
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
```

## 6. Flowchart Pimpinan - Monitoring Read-only

```mermaid
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
```

## 7. Flowchart User/Staff - Read-only Dashboard

```mermaid
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
```

## 8. Flowchart Authentication & Authorization

```mermaid
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
```

---

## Keterangan Singkatan:

- **SI**: Setting & Infrastructure
- **EC**: Energy & Climate Change
- **WS**: Waste Management
- **WR**: Water Management
- **TR**: Transportation
- **ED**: Education & Research
- **UIGM**: UI GreenMetric World University Ranking
- **KPI**: Key Performance Indicators

## Cara Menggunakan Flowchart:

1. **Copy kode Mermaid** dari section yang dibutuhkan
2. **Paste ke Mermaid editor** online (mermaid.live) atau tools yang mendukung
3. **Export sebagai image** (PNG/SVG) untuk presentasi
4. **Embed di dokumentasi** atau wiki internal

Flowchart ini menggambarkan **alur kerja lengkap** untuk setiap role dalam sistem dashboard UIGM, mulai dari login hingga fungsi-fungsi spesifik yang dapat diakses oleh masing-masing role.
