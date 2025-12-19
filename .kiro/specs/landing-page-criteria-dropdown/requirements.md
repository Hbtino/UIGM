# Requirements Document

## Introduction

Menambahkan dropdown menu "Kriteria" di landing page yang berisi 6 kriteria UI GreenMetric dengan form terpisah untuk setiap kriteria. Dropdown ini akan ditempatkan di antara section "Program" dan "Berita" di landing page.

## Glossary

- **Landing Page**: Halaman utama website yang dapat diakses tanpa login
- **Kriteria Dropdown**: Menu dropdown yang menampilkan 6 kriteria UI GreenMetric
- **Form Kriteria**: Halaman form terpisah untuk setiap kriteria yang menampilkan informasi detail
- **UI GreenMetric**: Sistem penilaian universitas berkelanjutan dengan 6 kriteria utama
- **Navigation Bar**: Bar navigasi horizontal di landing page yang berisi menu utama

## Requirements

### Requirement 1

**User Story:** Sebagai pengunjung website, saya ingin melihat dropdown menu "Kriteria" di landing page, sehingga saya dapat mengakses informasi tentang kriteria UI GreenMetric.

#### Acceptance Criteria

1. WHEN pengunjung mengakses landing page THEN sistem SHALL menampilkan dropdown menu "Kriteria" di navigation bar
2. WHEN pengunjung mengklik dropdown "Kriteria" THEN sistem SHALL menampilkan 6 kriteria UI GreenMetric dalam bentuk dropdown list
3. WHEN dropdown ditampilkan THEN sistem SHALL menampilkan kriteria dengan urutan: Setting & Infrastructure, Energy & Climate Change, Waste, Water, Transportation, Education & Research
4. WHEN pengunjung mengklik di luar dropdown THEN sistem SHALL menutup dropdown menu secara otomatis
5. WHEN dropdown menu terbuka THEN sistem SHALL menampilkan visual feedback yang konsisten dengan desain landing page

### Requirement 2

**User Story:** Sebagai pengunjung website, saya ingin mengklik setiap kriteria di dropdown, sehingga saya dapat melihat informasi detail tentang kriteria tersebut.

#### Acceptance Criteria

1. WHEN pengunjung mengklik "Setting & Infrastructure" THEN sistem SHALL mengarahkan ke halaman form Setting & Infrastructure
2. WHEN pengunjung mengklik "Energy & Climate Change" THEN sistem SHALL mengarahkan ke halaman form Energy & Climate Change  
3. WHEN pengunjung mengklik "Waste" THEN sistem SHALL mengarahkan ke halaman form Waste Management
4. WHEN pengunjung mengklik "Water" THEN sistem SHALL mengarahkan ke halaman form Water Management
5. WHEN pengunjung mengklik "Transportation" THEN sistem SHALL mengarahkan ke halaman form Transportation
6. WHEN pengunjung mengklik "Education & Research" THEN sistem SHALL mengarahkan ke halaman form Education & Research

### Requirement 3

**User Story:** Sebagai pengunjung website, saya ingin melihat form yang informatif untuk setiap kriteria, sehingga saya dapat memahami detail dari setiap kriteria UI GreenMetric.

#### Acceptance Criteria

1. WHEN pengunjung mengakses form kriteria THEN sistem SHALL menampilkan judul kriteria yang sesuai
2. WHEN form kriteria ditampilkan THEN sistem SHALL menampilkan deskripsi lengkap tentang kriteria tersebut
3. WHEN form kriteria ditampilkan THEN sistem SHALL menampilkan data statistik yang sama dengan yang ada di dashboard
4. WHEN form kriteria ditampilkan THEN sistem SHALL menampilkan target dan capaian untuk kriteria tersebut
5. WHEN form kriteria ditampilkan THEN sistem SHALL menyediakan tombol "Kembali" untuk kembali ke landing page

### Requirement 4

**User Story:** Sebagai pengunjung website, saya ingin melihat posisi dropdown "Kriteria" yang tepat di navigation bar, sehingga navigasi terasa natural dan mudah ditemukan.

#### Acceptance Criteria

1. WHEN landing page dimuat THEN sistem SHALL menempatkan dropdown "Kriteria" di antara menu "Program" dan "Berita"
2. WHEN navigation bar ditampilkan THEN sistem SHALL menampilkan urutan menu: Deskripsi, Statistik, Program, Kriteria, Berita, Informasi, Login
3. WHEN dropdown "Kriteria" ditampilkan THEN sistem SHALL menggunakan styling yang konsisten dengan menu lainnya
4. WHEN halaman di-resize THEN sistem SHALL mempertahankan posisi dropdown "Kriteria" secara responsif
5. WHEN dropdown "Kriteria" di-hover THEN sistem SHALL menampilkan visual feedback yang sama dengan menu lainnya

### Requirement 5

**User Story:** Sebagai pengunjung website, saya ingin melihat data yang konsisten antara form kriteria dan dashboard, sehingga informasi yang saya terima akurat dan terpercaya.

#### Acceptance Criteria

1. WHEN form kriteria menampilkan data statistik THEN sistem SHALL menggunakan data yang sama dengan dashboard
2. WHEN form kriteria menampilkan target skor THEN sistem SHALL menampilkan target 2028 yang sama dengan dashboard
3. WHEN form kriteria menampilkan capaian saat ini THEN sistem SHALL menampilkan data terkini yang sama dengan dashboard
4. WHEN form kriteria menampilkan status progress THEN sistem SHALL menampilkan status yang konsisten dengan dashboard
5. WHEN data di dashboard berubah THEN sistem SHALL memperbarui data di form kriteria secara otomatis

### Requirement 6

**User Story:** Sebagai pengunjung website, saya ingin mengakses form kriteria dengan mudah dari berbagai perangkat, sehingga saya dapat melihat informasi kriteria kapan saja.

#### Acceptance Criteria

1. WHEN pengunjung mengakses dari desktop THEN sistem SHALL menampilkan dropdown dan form dengan layout yang optimal untuk desktop
2. WHEN pengunjung mengakses dari tablet THEN sistem SHALL menampilkan dropdown dan form dengan layout yang responsif untuk tablet
3. WHEN pengunjung mengakses dari mobile THEN sistem SHALL menampilkan dropdown dan form dengan layout yang optimal untuk mobile
4. WHEN form kriteria dimuat di mobile THEN sistem SHALL memastikan semua konten dapat di-scroll dengan mudah
5. WHEN dropdown dibuka di mobile THEN sistem SHALL menampilkan menu dengan ukuran yang mudah di-tap