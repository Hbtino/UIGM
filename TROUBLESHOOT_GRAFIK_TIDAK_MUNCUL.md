# Troubleshoot: Grafik Ranking Tidak Muncul

## Langkah 1: Verifikasi Data di Database

### Buka phpMyAdmin

1. Buka browser → `localhost/phpmyadmin`
2. Pilih database Anda (klik di sidebar kiri)

### Jalankan Query Test

1. Klik tab "SQL"
2. Copy-paste query ini:

```sql
SELECT * FROM landing_charts ORDER BY chart_type, order_position;
```

3. Klik "Go"

### Hasil yang Diharapkan

Harus muncul **12 baris data** seperti ini:

| id  | chart_type        | year | rank_value | order_position | is_active |
| --- | ----------------- | ---- | ---------- | -------------- | --------- |
| 1   | ranking_dunia     | 2023 | 896        | 1              | 1         |
| 2   | ranking_dunia     | 2024 | 705        | 2              | 1         |
| 3   | ranking_dunia     | 2025 | 561        | 3              | 1         |
| 4   | ranking_dunia     | 2026 | 374        | 4              | 1         |
| 5   | ranking_dunia     | 2027 | 228        | 5              | 1         |
| 6   | ranking_dunia     | 2028 | 176        | 6              | 1         |
| 7   | ranking_indonesia | 2023 | 87         | 1              | 1         |
| 8   | ranking_indonesia | 2024 | 70         | 2              | 1         |
| 9   | ranking_indonesia | 2025 | 53         | 3              | 1         |
| 10  | ranking_indonesia | 2026 | 39         | 4              | 1         |
| 11  | ranking_indonesia | 2027 | 29         | 5              | 1         |
| 12  | ranking_indonesia | 2028 | 26         | 6              | 1         |

### Jika Data TIDAK ADA atau KURANG dari 12 baris:

1. Hapus tabel lama (jika ada):

```sql
DROP TABLE IF EXISTS landing_charts;
```

2. Jalankan ulang file `CREATE_LANDING_CHARTS_TABLE.sql`:

   - Buka file `CREATE_LANDING_CHARTS_TABLE.sql`
   - Copy SEMUA isinya
   - Paste di tab SQL phpMyAdmin
   - Klik "Go"

3. Verifikasi lagi dengan query di atas

## Langkah 2: Cek HTML Source Landing Page

### Buka Landing Page

1. Buka browser → `localhost:8080` (atau port Anda)
2. Klik menu "Statistik" di header
3. Klik kanan di halaman → "View Page Source" (atau tekan Ctrl+U)

### Cari Komentar DEBUG

Cari teks ini di HTML source:

```html
<!-- Progress Ranking (2 Grafik) -->
```

### Jika TIDAK ADA komentar ini:

- Berarti section statistik tidak di-render
- Cek apakah variabel `$statistics` ada di controller

### Jika ADA komentar tapi grafik tidak muncul:

- Berarti kondisi `isset($charts)` bernilai FALSE
- Lanjut ke Langkah 3

## Langkah 3: Clear Cache

### Clear Browser Cache

1. Tekan `Ctrl + Shift + Delete` (Windows) atau `Cmd + Shift + Delete` (Mac)
2. Pilih "Cached images and files"
3. Klik "Clear data"

### Hard Refresh

1. Buka landing page
2. Tekan `Ctrl + Shift + R` (Windows) atau `Cmd + Shift + R` (Mac)

## Langkah 4: Cek Console Browser

### Buka Developer Tools

1. Tekan F12
2. Klik tab "Console"
3. Refresh halaman (F5)

### Cari Error

Jika ada error merah, screenshot dan kirim ke developer.

## Langkah 5: Test Manual di Browser

### Buka URL Test

Buka di browser: `localhost:8080/landing-charts`

### Hasil yang Diharapkan

- Jika muncul halaman "Kelola Grafik Landing Page" → Data charts berhasil di-load
- Jika error 404 → Route belum ditambahkan
- Jika error 500 → Ada masalah di controller/model

## Langkah 6: Cek File Model

### Pastikan File Ada

Cek apakah file ini ada:

```
app/Models/LandingChartModel.php
```

### Jika File TIDAK ADA:

File model belum dibuat. Hubungi developer.

## Langkah 7: Restart Server

### Stop Server

1. Buka terminal/command prompt tempat server berjalan
2. Tekan `Ctrl + C`

### Start Server Lagi

```bash
php spark serve
```

### Refresh Landing Page

Buka lagi `localhost:8080`

## Masalah Stats Card di Tengah

### Penyebab

Grid CSS menggunakan `repeat(4, 1fr)` yang membuat 4 kolom sama lebar.

### Sudah Diperbaiki

File `app/Views/home.php` sudah diupdate dengan:

- Grid tetap 4 kolom di layar besar
- Grid jadi 2 kolom di layar sedang (< 1200px)
- Grid jadi 1 kolom di layar kecil (< 768px)

### Jika Masih di Tengah

Clear cache browser (Ctrl + Shift + R)

## Kontak Developer

Jika semua langkah di atas sudah dicoba tapi masih belum berhasil:

1. Screenshot hasil query SQL (Langkah 1)
2. Screenshot HTML source (Langkah 2)
3. Screenshot console browser (Langkah 4)
4. Kirim ke developer

## Checklist

- [ ] Data ada di database (12 rows)
- [ ] File `LandingChartModel.php` ada
- [ ] Route `/landing-charts` bisa diakses
- [ ] HTML source ada komentar "Progress Ranking"
- [ ] Browser cache sudah di-clear
- [ ] Server sudah di-restart
- [ ] Stats card tidak di tengah lagi
