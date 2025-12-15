# Cara Install Grafik Ranking di Landing Page

## Masalah

Grafik Ranking Dunia dan Ranking Indonesia belum muncul di landing page karena tabel `landing_charts` belum dibuat.

## Solusi - Jalankan SQL

### Langkah 1: Buka phpMyAdmin

1. Buka browser
2. Ketik: `localhost/phpmyadmin`
3. Login dengan username dan password database Anda

### Langkah 2: Pilih Database

1. Klik nama database Anda di sidebar kiri
2. Biasanya namanya seperti: `polban_db` atau `kampus_berkelanjutan`

### Langkah 3: Jalankan SQL

1. Klik tab **"SQL"** di bagian atas
2. Buka file: `CREATE_LANDING_CHARTS_TABLE.sql`
3. Copy SEMUA isi file tersebut
4. Paste ke kotak SQL di phpMyAdmin
5. Klik tombol **"Go"** atau **"Kirim"** di kanan bawah

### Langkah 4: Verifikasi

Setelah SQL berhasil dijalankan, Anda akan melihat pesan sukses. Untuk memastikan:

1. Klik tab **"SQL"** lagi
2. Ketik query ini:

```sql
SELECT * FROM landing_charts ORDER BY chart_type, order_position;
```

3. Klik **"Go"**
4. Harus muncul **12 baris data**:
   - 6 baris untuk `ranking_dunia` (tahun 2023-2028)
   - 6 baris untuk `ranking_indonesia` (tahun 2023-2028)

### Langkah 5: Refresh Landing Page

1. Buka landing page: `localhost:8080` atau `localhost/polban`
2. Klik menu **"Statistik"** di header
3. Scroll ke bawah
4. Grafik **"Progress Ranking Dunia"** dan **"Progress Ranking Indonesia"** akan muncul DI ATAS 4 stats card

## Posisi Grafik di Landing Page

```
┌─────────────────────────────────────────────────────────┐
│                    HEADER / NAVBAR                       │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│              SECTION STATISTIK                           │
│                                                          │
│  ┌──────────────────────┐  ┌──────────────────────┐   │
│  │ Progress Ranking     │  │ Progress Ranking     │   │
│  │ Dunia                │  │ Indonesia            │   │
│  │                      │  │                      │   │
│  │ 2023  #896           │  │ 2023  #87            │   │
│  │ 2024  #705  ↑ 191    │  │ 2024  #70   ↑ 17     │   │
│  │ 2025  #561  ↑ 144    │  │ 2025  #53   ↑ 17     │   │
│  │ 2026  #374  ↑ 187    │  │ 2026  #39   ↑ 14     │   │
│  │ 2027  #228  ↑ 146    │  │ 2027  #29   ↑ 10     │   │
│  │ 2028  #176  ↑ 52     │  │ 2028  #26   ↑ 3      │   │
│  └──────────────────────┘  └──────────────────────┘   │
│                                                          │
│  ┌────────┐ ┌────────┐ ┌────────┐ ┌────────┐          │
│  │  80%   │ │  #176  │ │  #26   │ │   6    │          │
│  │ Target │ │ Target │ │ Target │ │Kriteria│          │
│  │  Skor  │ │ Dunia  │ │  Indo  │ │  SDGs  │          │
│  └────────┘ └────────┘ └────────┘ └────────┘          │
│                                                          │
│  ┌──────────────────────┐  ┌──────────────────────┐   │
│  │ Profil Kampus        │  │ Fasilitas Kampus     │   │
│  └──────────────────────┘  └──────────────────────┘   │
└─────────────────────────────────────────────────────────┘
```

## Troubleshooting

### Grafik masih belum muncul setelah jalankan SQL

1. **Clear cache browser**: Tekan `Ctrl + Shift + R` (Windows) atau `Cmd + Shift + R` (Mac)
2. **Cek tabel**: Pastikan tabel `landing_charts` ada dan berisi 12 data
3. **Cek error**: Buka Console browser (F12) dan lihat apakah ada error

### Error saat jalankan SQL

**Error: Table 'landing_charts' already exists**

- Solusi: Tabel sudah ada, tidak perlu create lagi
- Cek apakah data sudah ada dengan query:
  ```sql
  SELECT COUNT(*) FROM landing_charts;
  ```
- Jika hasilnya 0, jalankan hanya bagian INSERT dari SQL file

**Error: Duplicate entry**

- Solusi: Data sudah ada
- Hapus data lama dulu:
  ```sql
  DELETE FROM landing_charts;
  ```
- Lalu jalankan lagi bagian INSERT

### Grafik muncul tapi kosong

1. Cek apakah `is_active = 1` di database
2. Jalankan query:
   ```sql
   UPDATE landing_charts SET is_active = 1;
   ```

## Edit Nilai Grafik

Setelah grafik muncul, Anda bisa edit nilainya:

1. **Login sebagai Admin**
2. **Buka**: `/landing-statistics`
3. **Klik tombol "Grafik"** (hijau)
4. **Edit nilai ranking**
5. **Klik "Simpan"**
6. **Refresh landing page** untuk melihat perubahan

## File SQL yang Digunakan

- `CREATE_LANDING_CHARTS_TABLE.sql` - File utama untuk create table dan insert data

## Kontak

Jika masih ada masalah, screenshot error dan tanyakan ke developer.
