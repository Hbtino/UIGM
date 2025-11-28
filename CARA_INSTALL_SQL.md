# Cara Install SQL - Panduan Singkat

## Pilihan Terbaik: Gunakan File Lengkap

Gunakan file: **`INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql`**

### Keuntungan:

✅ Semua dalam 1 file
✅ Aman dijalankan berkali-kali
✅ Tidak akan error duplicate
✅ Otomatis create table jika belum ada
✅ Otomatis update data jika sudah ada

### Cara Install:

**Via phpMyAdmin:**

1. Buka phpMyAdmin
2. Pilih database Anda (contoh: `capaian_kinerja`)
3. Klik tab **"SQL"**
4. Copy-paste seluruh isi file `INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql`
5. Klik **"Go"**
6. Selesai! ✅

**Via MySQL Command Line:**

```bash
mysql -u username -p database_name < INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql
```

### Hasil yang Diharapkan:

Setelah berhasil, Anda akan melihat:

```
Query OK, 1 row affected (0.01 sec)
Query OK, 9 rows affected (0.02 sec)
```

Dan tabel hasil:

```
section              | title                        | value | icon          | color  | is_active
---------------------|------------------------------|-------|---------------|--------|----------
info_box             | Tentang Renstra TMKB Polban | NULL  | fa-info-circle| NULL   | 1
stat_card_1          | Target Skor 2028            | 80    | fa-chart-line | blue   | 1
stat_card_2          | Target Ranking Dunia        | 176   | fa-trophy     | green  | 1
stat_card_3          | Target Ranking Indonesia    | 26    | fa-flag       | orange | 1
stat_card_4          | Kriteria Keberlanjutan      | 6     | fa-leaf       | purple | 1
...
```

---

## Alternatif: Gunakan File Terpisah

Jika ingin menggunakan file terpisah:

### Opsi A: Fresh Install

```sql
-- Jalankan file ini jika tabel belum ada
CREATE_DASHBOARD_CONTENTS_TABLE.sql
```

### Opsi B: Update Data Saja

```sql
-- Jalankan file ini jika tabel sudah ada
UPDATE_DASHBOARD_CONTENTS_DATA.sql
```

### Opsi C: Jalankan Keduanya

```sql
-- 1. Jalankan ini dulu
CREATE_DASHBOARD_CONTENTS_TABLE.sql

-- 2. Kemudian jalankan ini
UPDATE_DASHBOARD_CONTENTS_DATA.sql
```

---

## Verifikasi Instalasi

Setelah install, cek apakah berhasil:

```sql
SELECT COUNT(*) as total FROM dashboard_contents;
```

**Hasil yang diharapkan:** `total = 9`

---

## Testing

1. Login ke aplikasi sebagai **admin**
2. Buka menu **"Konten Dashboard"** di sidebar
3. Anda akan melihat 9 content yang bisa diedit
4. Coba edit salah satu (misalnya `stat_card_1`)
5. Ubah value dari "80" menjadi "85"
6. Simpan
7. Refresh dashboard - nilai akan berubah menjadi 85%

---

## Troubleshooting

**Q: Error "Table already exists"**
A: Tidak masalah, file sudah pakai `CREATE TABLE IF NOT EXISTS`

**Q: Error "Duplicate entry"**
A: Tidak masalah, file sudah pakai `ON DUPLICATE KEY UPDATE`

**Q: Data tidak muncul di dashboard**
A:

1. Pastikan sudah refresh browser (Ctrl+F5)
2. Cek apakah `is_active = 1`
3. Cek apakah Dashboard controller sudah diupdate

**Q: Mau reset ke default**
A: Jalankan ulang file `INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql`

---

## Rekomendasi

🎯 **Gunakan:** `INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql`

Ini adalah cara paling mudah dan aman!
