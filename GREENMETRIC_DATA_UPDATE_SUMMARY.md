# Update Data GreenMetric - Grafik Landing Page

## Ringkasan Perubahan

Data grafik "Capaian Kriteria Kampus Berkelanjutan" telah diupdate dengan **data aktual GreenMetric** dari tahun 2023-2025, menggantikan data dummy sebelumnya.

## Data Aktual GreenMetric (2023-2025)

### Tabel Perbandingan Data

| Tahun | Global Rank | Indonesia Rank | Total Score | SI   | EC   | WS  | WR  | TR  | ED   |
| ----- | ----------- | -------------- | ----------- | ---- | ---- | --- | --- | --- | ---- |
| 2023  | -           | 87             | 4345        | 1085 | 1050 | 675 | 300 | 485 | 950  |
| 2024  | 1032        | -              | 4560        | 900  | 1300 | 600 | 300 | 535 | 925  |
| 2025  | 942         | -              | 5410        | 1090 | 1260 | 725 | 288 | 875 | 1363 |

### Keterangan Kategori:

- **SI**: Setting & Infrastructure
- **EC**: Energy & Climate Change
- **WS**: Waste
- **WR**: Water
- **TR**: Transportation
- **ED**: Education & Research

## Analisis Tren (2023-2025)

### Peningkatan Signifikan:

1. **Total Score**: 4345 → 4560 → 5410 (+24.5% dalam 2 tahun)
2. **Global Rank**: Peningkatan dari 1032 (2024) ke 942 (2025)
3. **Transportation**: 485 → 535 → 875 (+80.4%)
4. **Education & Research**: 950 → 925 → 1363 (+43.5%)

### Area yang Perlu Perhatian:

1. **Water**: Skor menurun dari 300 → 288 (-4%)
2. **Setting & Infrastructure**: Fluktuatif 1085 → 900 → 1090

## File yang Diupdate

### 1. StatisticsController.php

- Method `getDefaultChartData()` diupdate dengan data aktual
- Data proyeksi 2026-2028 tetap dipertahankan untuk perencanaan

### 2. Database Update

- File SQL: `UPDATE_GREENMETRIC_CHART_DATA.sql`
- Script PHP: `update_greenmetric_data.php`

## Cara Menjalankan Update

### Opsi 1: Manual SQL

```sql
-- Jalankan file UPDATE_GREENMETRIC_CHART_DATA.sql
mysql -u username -p database_name < UPDATE_GREENMETRIC_CHART_DATA.sql
```

### Opsi 2: Script PHP

```bash
# Jalankan script update
php update_greenmetric_data.php
```

### Opsi 3: Melalui Admin Panel

1. Login ke admin panel
2. Buka `/statistics/charts`
3. Klik "Sync Charts" untuk mengupdate data

## Proyeksi Data (2026-2028)

Data tahun 2026-2028 adalah **proyeksi target** berdasarkan tren peningkatan:

| Tahun | Target Total Score | Target Global Rank |
| ----- | ------------------ | ------------------ |
| 2026  | 5800               | 800                |
| 2027  | 6200               | 700                |
| 2028  | 6500               | 600                |

## Sumber Data

- **GreenMetric Official Rankings**: Data 2023-2025
- **Detail Rankings 2025**: Global Rank 942, Total Score 5410
- **Detail Rankings 2024**: Global Rank 1032, Total Score 4560
- **Ranking by Country 2023**: Indonesia Rank 87, Total Score 4345

## Dampak pada Landing Page

Setelah update ini, grafik di landing page akan menampilkan:

1. ✅ Data aktual yang akurat dari GreenMetric
2. ✅ Tren peningkatan yang nyata (bukan dummy)
3. ✅ Proyeksi realistis untuk masa depan
4. ✅ Kredibilitas data yang dapat diverifikasi

## Verifikasi Update

Untuk memverifikasi update berhasil:

1. Buka landing page website
2. Scroll ke bagian "Total Skor Capaian Per Tahun"
3. Pastikan data 2023-2025 sesuai dengan tabel di atas
4. Grafik harus menunjukkan tren peningkatan yang konsisten

---

**Catatan**: Update ini meningkatkan akurasi dan kredibilitas data yang ditampilkan di website, menggantikan data dummy dengan data resmi GreenMetric.
