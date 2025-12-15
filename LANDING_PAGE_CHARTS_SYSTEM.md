# Sistem Grafik Landing Page - Ranking Dunia & Indonesia

## Overview

Sistem ini menambahkan 2 indikator grafik ranking (Ranking Dunia dan Ranking Indonesia) dari dashboard ke landing page, dengan kemampuan admin untuk mengelola data melalui database.

## Fitur

✅ 2 Grafik Ranking: Dunia & Indonesia
✅ Data disimpan di database (tabel `landing_charts`)
✅ Admin dapat edit nilai ranking melalui halaman `/landing-charts`
✅ Tombol navigasi di halaman Statistik Landing Page
✅ Otomatis hitung improvement (peningkatan ranking)
✅ Tampilan responsive dan modern

## Database

### Tabel: `landing_charts`

```sql
CREATE TABLE `landing_charts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `chart_type` varchar(50) NOT NULL COMMENT 'ranking_dunia, ranking_indonesia',
  `year` varchar(10) NOT NULL COMMENT 'Tahun data',
  `rank_value` int(11) NOT NULL COMMENT 'Nilai ranking',
  `order_position` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_chart_year` (`chart_type`, `year`)
);
```

### Data Default

- **Ranking Dunia**: 2023 (#896) → 2028 (#176)
- **Ranking Indonesia**: 2023 (#87) → 2028 (#26)

## Instalasi

### 1. Jalankan SQL

```bash
# Buka phpMyAdmin
# Pilih database Anda
# Klik tab "SQL"
# Copy-paste isi file: CREATE_LANDING_CHARTS_TABLE.sql
# Klik "Go"
```

### 2. Verifikasi

```sql
SELECT * FROM landing_charts ORDER BY chart_type, order_position;
```

Harus ada 12 records (6 untuk ranking_dunia, 6 untuk ranking_indonesia).

## Cara Menggunakan

### Admin - Kelola Grafik

1. **Login sebagai Admin**
2. **Buka halaman Statistik Landing Page**

   - URL: `/landing-statistics`
   - Atau dari Dashboard → Statistik Landing Page

3. **Klik tombol "Grafik"**

   - Tombol hijau di kanan atas
   - Akan redirect ke `/landing-charts`

4. **Edit Nilai Ranking**

   - Ubah nilai di input field
   - Klik tombol "Simpan"
   - Data otomatis tersimpan via AJAX

5. **Lihat Hasil di Landing Page**
   - Buka landing page (home)
   - Scroll ke bagian "Statistik"
   - Lihat grafik Ranking Dunia & Indonesia

### Navigasi Tombol

Di halaman `/landing-statistics`:

- **Tombol "Grafik"** (hijau) → Ke halaman kelola grafik
- **Tombol "Kembali"** (biru) → Ke dashboard

Di halaman `/landing-charts`:

- **Tombol "Statistik"** (abu-abu) → Ke halaman statistik
- **Tombol "Kembali"** (biru) → Ke dashboard

## File yang Dibuat/Diubah

### File Baru

1. `CREATE_LANDING_CHARTS_TABLE.sql` - SQL untuk create table
2. `app/Models/LandingChartModel.php` - Model untuk manage data grafik
3. `app/Views/cms/landing_charts/index.php` - Halaman admin kelola grafik
4. `LANDING_PAGE_CHARTS_SYSTEM.md` - Dokumentasi ini

### File Diubah

1. `app/Controllers/CmsController.php`

   - Added: `landingCharts()` method
   - Added: `updateLandingChart()` method

2. `app/Controllers/Home.php`

   - Added: Load `LandingChartModel`
   - Added: `$charts` data ke view

3. `app/Config/Routes.php`

   - Added: Route `/landing-charts`
   - Added: Route `/cms/update-landing-chart`

4. `app/Views/cms/landing_statistics/index.php`

   - Added: Tombol "Grafik" di header

5. `app/Views/home.php`
   - Changed: Bagian "Progress Ranking" menggunakan data dari `$charts`
   - Removed: Dependency ke `$statistics['ranking_dunia']` dan `$statistics['ranking_indonesia']`

## Struktur Data

### Controller → View

```php
$charts = [
    'ranking_dunia' => [
        ['id' => 1, 'year' => '2023', 'rank_value' => 896, ...],
        ['id' => 2, 'year' => '2024', 'rank_value' => 705, ...],
        ...
    ],
    'ranking_indonesia' => [
        ['id' => 7, 'year' => '2023', 'rank_value' => 87, ...],
        ['id' => 8, 'year' => '2024', 'rank_value' => 70, ...],
        ...
    ]
];
```

### Tampilan Landing Page

```
Progress Ranking Dunia          Progress Ranking Indonesia
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
2023    #896                    2023    #87
2024    #705  ↑ 191             2024    #70   ↑ 17
2025    #561  ↑ 144             2025    #53   ↑ 17
2026    #374  ↑ 187             2026    #39   ↑ 14
2027    #228  ↑ 146             2027    #29   ↑ 10
2028    #176  ↑ 52              2028    #26   ↑ 3
```

## API Endpoints

### GET /landing-charts

- **Auth**: Required (Admin only)
- **Response**: Halaman kelola grafik
- **Access**: Via tombol "Grafik" di `/landing-statistics`

### POST /cms/update-landing-chart

- **Auth**: Required (Admin only)
- **Parameters**:
  - `id` (required): ID chart
  - `rank_value` (required): Nilai ranking baru
- **Response**: JSON
  ```json
  {
    "success": true,
    "message": "Data grafik berhasil diupdate"
  }
  ```

## Troubleshooting

### Grafik tidak muncul di landing page

1. Cek apakah tabel `landing_charts` sudah dibuat
2. Cek apakah ada data di tabel (harus ada 12 records)
3. Cek apakah `is_active = 1`
4. Clear cache browser

### Tombol "Grafik" tidak muncul

1. Pastikan login sebagai admin
2. Cek file `app/Views/cms/landing_statistics/index.php`
3. Pastikan route `/landing-charts` sudah ditambahkan

### Error saat save

1. Cek permission database
2. Cek apakah `rank_value` adalah angka
3. Cek console browser untuk error JavaScript

## Tips

- Nilai ranking yang lebih kecil = lebih baik (contoh: #176 lebih baik dari #896)
- Improvement otomatis dihitung: `prevRank - currentRank`
- Data tahun diurutkan berdasarkan `order_position`
- Gunakan angka bulat untuk `rank_value`

## Future Enhancement

- [ ] Tambah grafik visual (line chart)
- [ ] Export data ke Excel
- [ ] Import data dari CSV
- [ ] History perubahan data
- [ ] Grafik perbandingan dengan universitas lain
