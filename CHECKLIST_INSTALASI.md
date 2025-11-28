# ✅ Checklist Instalasi Dashboard System

## 📋 Ringkasan

Anda perlu menjalankan 2 file SQL untuk mengaktifkan semua fitur dashboard yang baru.

---

## 🎯 Langkah-langkah Instalasi

### Step 1: Install Dashboard Contents (Konten Dashboard)

File ini untuk manage konten dashboard (info box, stat cards, chart title, dll)

**File:** `INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql`

**Cara Install:**

1. Buka **phpMyAdmin**
2. Pilih database Anda (contoh: `capaian_kinerja`)
3. Klik tab **"SQL"**
4. Copy-paste seluruh isi file `INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql`
5. Klik **"Go"**
6. ✅ Selesai!

**Hasil yang Diharapkan:**

```
Query OK, 1 row affected (0.01 sec)
Query OK, 9 rows affected (0.02 sec)
```

---

### Step 2: Install Dashboard Statistics (Statistik Dashboard)

File ini untuk manage statistik yang bisa diedit admin

**File:** `CREATE_DASHBOARD_STATISTICS_TABLE.sql`

**Cara Install:**

1. Masih di **phpMyAdmin**
2. Masih di database yang sama
3. Klik tab **"SQL"** lagi
4. Copy-paste seluruh isi file `CREATE_DASHBOARD_STATISTICS_TABLE.sql`
5. Klik **"Go"**
6. ✅ Selesai!

**Hasil yang Diharapkan:**

```
Query OK, 1 row affected (0.01 sec)
Query OK, 14 rows affected (0.02 sec)
```

---

### Step 3: Verifikasi Instalasi

**Cek Tabel Dashboard Contents:**

```sql
SELECT COUNT(*) as total FROM dashboard_contents;
```

**Expected:** `total = 9`

**Cek Tabel Dashboard Statistics:**

```sql
SELECT COUNT(*) as total FROM dashboard_statistics;
```

**Expected:** `total = 14`

---

### Step 4: Test Dashboard

1. **Login ke aplikasi** sebagai admin
2. **Buka Dashboard** - Anda akan melihat:
   - ✅ Info box dengan konten dari database
   - ✅ 4 Stat cards horizontal dengan data dari database
   - ✅ Statistik yang otomatis update
3. **Buka menu "Konten Dashboard"** di sidebar
4. **Coba edit** salah satu content (misalnya `stat_card_1`)
5. **Ubah value** dari "80" menjadi "85"
6. **Simpan**
7. **Refresh dashboard** - nilai akan berubah menjadi 85%

---

### Step 5: Test Real-time Statistics

1. **Login sebagai dosen/kaprodi**
2. **Tambah data baru** di salah satu kriteria (misalnya Water Management)
3. **Kembali ke dashboard**
4. **Refresh** - Anda akan lihat:

   - ✅ Total data bertambah
   - ✅ Pending data bertambah

5. **Login sebagai admin/reviewer**
6. **Approve data** yang baru ditambahkan
7. **Kembali ke dashboard**
8. **Refresh** - Anda akan lihat:
   - ✅ Approved data bertambah
   - ✅ Pending data berkurang
   - ✅ Score percentage meningkat

---

## 📊 Fitur yang Akan Aktif

### 1. Dashboard Content Management

- ✅ Edit info box (judul & konten)
- ✅ Edit 4 stat cards (nilai, icon, warna, trend)
- ✅ Edit chart title & description
- ✅ Edit top bar title & subtitle
- ✅ Semua via menu "Konten Dashboard"

### 2. Real-time Statistics

- ✅ Total data otomatis update
- ✅ Approved/pending/rejected data otomatis hitung
- ✅ Score percentage otomatis hitung
- ✅ Breakdown per kriteria
- ✅ User statistics

### 3. Configurable Static Values

- ✅ Target skor, ranking bisa diedit
- ✅ Jumlah mahasiswa, dosen, dll bisa diedit
- ✅ Edit via database (future: via admin panel)

---

## 🔧 Troubleshooting

### Error: "Table already exists"

**Solusi:** Tidak masalah, file sudah pakai `CREATE TABLE IF NOT EXISTS`

### Error: "Duplicate entry"

**Solusi:** Tidak masalah, file sudah pakai `ON DUPLICATE KEY UPDATE`

### Dashboard tidak berubah

**Solusi:**

1. Clear browser cache (Ctrl+F5)
2. Pastikan sudah login sebagai admin
3. Cek apakah SQL sudah dijalankan dengan benar

### Menu "Konten Dashboard" tidak muncul

**Solusi:**

1. Pastikan login sebagai **admin**
2. Refresh halaman
3. Cek di sidebar bagian "Sistem"

### Statistik tidak update

**Solusi:**

1. Pastikan tabel `dashboard_statistics` sudah dibuat
2. Refresh dashboard (Ctrl+F5)
3. Cek apakah ada data di tabel criteria

---

## 📁 File SQL yang Tersedia

| File                                      | Fungsi                                                                | Wajib?         |
| ----------------------------------------- | --------------------------------------------------------------------- | -------------- |
| `INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql` | Install konten dashboard                                              | ✅ **YA**      |
| `CREATE_DASHBOARD_STATISTICS_TABLE.sql`   | Install statistik dashboard                                           | ✅ **YA**      |
| `UPDATE_KONTAK_TO_INFORMASI.sql`          | Update landing page                                                   | ⚠️ Opsional    |
| `CREATE_DASHBOARD_CONTENTS_TABLE.sql`     | Alternatif (sudah include di INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql) | ❌ Tidak perlu |
| `UPDATE_DASHBOARD_CONTENTS_DATA.sql`      | Alternatif (sudah include di INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql) | ❌ Tidak perlu |

---

## ✅ Quick Checklist

- [ ] Jalankan `INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql`
- [ ] Jalankan `CREATE_DASHBOARD_STATISTICS_TABLE.sql`
- [ ] Verifikasi: `SELECT COUNT(*) FROM dashboard_contents` = 9
- [ ] Verifikasi: `SELECT COUNT(*) FROM dashboard_statistics` = 14
- [ ] Login sebagai admin
- [ ] Buka dashboard - lihat perubahan
- [ ] Buka menu "Konten Dashboard"
- [ ] Test edit content
- [ ] Test tambah data baru
- [ ] Test approve data
- [ ] Lihat statistik otomatis update

---

## 🎉 Setelah Instalasi

Setelah semua langkah di atas selesai, Anda akan memiliki:

✅ Dashboard dengan konten yang bisa diedit via CRUD
✅ Statistik yang otomatis update saat ada data baru
✅ Layout horizontal untuk stat cards
✅ Static values yang bisa diedit via database
✅ Real-time calculation untuk score dan counts

**Tidak perlu edit code lagi!** Semua bisa dikelola via admin panel dan database.

---

## 📞 Bantuan

Jika ada masalah, cek file dokumentasi:

- `DASHBOARD_CONTENT_MANAGEMENT.md` - Panduan konten dashboard
- `DASHBOARD_REALTIME_STATISTICS.md` - Panduan statistik real-time
- `SQL_INSTALLATION_GUIDE.md` - Panduan instalasi SQL
- `CARA_INSTALL_SQL.md` - Cara install SQL singkat

---

## 🚀 Next Steps (Opsional)

Setelah sistem berjalan, Anda bisa:

1. Tambah admin panel untuk edit statistics (tidak perlu akses database)
2. Tambah export/import untuk backup content
3. Tambah preview real-time saat edit
4. Tambah validation untuk input
5. Tambah history perubahan

---

**Selamat mencoba! 🎊**
