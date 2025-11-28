# 📸 Panduan Visual: Cara Install SQL di phpMyAdmin

## 🎯 Lokasi File SQL

File SQL yang perlu dijalankan ada di **root folder project** Anda:

```
📁 project-root/
├── 📄 INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql  ← File 1 (Jalankan ini dulu)
├── 📄 CREATE_DASHBOARD_STATISTICS_TABLE.sql    ← File 2 (Jalankan ini kedua)
├── app/
├── public/
└── ...
```

---

## 📋 Langkah-langkah Detail

### Step 1: Buka phpMyAdmin

1. Buka browser
2. Ketik di address bar: `http://localhost/phpmyadmin`
3. Atau jika pakai XAMPP: Klik tombol "Admin" di MySQL

```
┌─────────────────────────────────────────┐
│  http://localhost/phpmyadmin            │
└─────────────────────────────────────────┘
```

---

### Step 2: Pilih Database

Di sidebar kiri, klik nama database Anda (contoh: `capaian_kinerja`)

```
┌─────────────────┐
│ 📁 Databases    │
│                 │
│ ▼ capaian_kinerja  ← KLIK INI
│   ├─ activities    │
│   ├─ users         │
│   ├─ ...          │
└─────────────────┘
```

---

### Step 3: Klik Tab "SQL"

Di bagian atas, ada beberapa tab. Klik tab **"SQL"**

```
┌──────────────────────────────────────────────┐
│ [Struktur] [SQL] [Cari] [Kueri] [Ekspor] ... │
│            ^^^^                               │
│            KLIK INI                           │
└──────────────────────────────────────────────┘
```

---

### Step 4: Copy-Paste SQL File 1

1. **Buka file** `INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql` dengan text editor (Notepad, VS Code, dll)
2. **Select All** (Ctrl+A)
3. **Copy** (Ctrl+C)
4. **Kembali ke phpMyAdmin**
5. **Paste** (Ctrl+V) di kotak SQL yang besar

```
┌────────────────────────────────────────────────┐
│ Jalankan kueri/kueri-kueri SQL pada database  │
│ capaian_kinerja:                               │
│                                                │
│ ┌────────────────────────────────────────────┐│
│ │ -- PASTE SQL DI SINI                       ││
│ │ CREATE TABLE IF NOT EXISTS ...             ││
│ │ INSERT INTO ...                            ││
│ │ ...                                        ││
│ │                                            ││
│ │                                            ││
│ └────────────────────────────────────────────┘│
│                                                │
│ [Kirim] ← KLIK INI SETELAH PASTE              │
└────────────────────────────────────────────────┘
```

6. **Klik tombol "Kirim"** atau **"Go"** di pojok kanan bawah

---

### Step 5: Lihat Hasil

Jika berhasil, akan muncul pesan:

```
✅ Query OK, 1 row affected (0.01 sec)
✅ Query OK, 9 rows affected (0.02 sec)

Showing rows 0 - 8 (9 total, Query took 0.0012 seconds.)
```

**Jika muncul pesan ini = BERHASIL!** ✅

---

### Step 6: Ulangi untuk File 2

1. **Klik tab "SQL" lagi** (di bagian atas)
2. **Hapus SQL yang lama** di kotak (Ctrl+A, Delete)
3. **Buka file** `CREATE_DASHBOARD_STATISTICS_TABLE.sql`
4. **Copy** seluruh isinya (Ctrl+A, Ctrl+C)
5. **Paste** di kotak SQL (Ctrl+V)
6. **Klik "Kirim"** atau **"Go"**

Jika berhasil, akan muncul:

```
✅ Query OK, 1 row affected (0.01 sec)
✅ Query OK, 14 rows affected (0.02 sec)

Showing rows 0 - 13 (14 total, Query took 0.0015 seconds.)
```

---

## 🔍 Verifikasi Instalasi

### Cek Tabel Sudah Dibuat

Di sidebar kiri, scroll ke bawah. Anda akan melihat tabel baru:

```
┌─────────────────────────┐
│ ▼ capaian_kinerja       │
│   ├─ activities         │
│   ├─ capaian_kinerja    │
│   ├─ dashboard_contents ← TABEL BARU 1
│   ├─ dashboard_statistics ← TABEL BARU 2
│   ├─ education_research │
│   ├─ energy_climate     │
│   └─ ...                │
└─────────────────────────┘
```

### Cek Jumlah Data

**Untuk dashboard_contents:**

1. Klik tabel `dashboard_contents` di sidebar
2. Klik tab "Browse" atau "Jelajahi"
3. Anda akan lihat **9 rows** (baris data)

**Untuk dashboard_statistics:**

1. Klik tabel `dashboard_statistics` di sidebar
2. Klik tab "Browse" atau "Jelajahi"
3. Anda akan lihat **14 rows** (baris data)

---

## ❌ Jika Ada Error

### Error: "Table already exists"

**Artinya:** Tabel sudah ada sebelumnya
**Solusi:** Tidak masalah, skip saja atau drop table dulu:

```sql
DROP TABLE IF EXISTS dashboard_contents;
DROP TABLE IF EXISTS dashboard_statistics;
```

Kemudian jalankan SQL lagi.

### Error: "Duplicate entry 'info_box'"

**Artinya:** Data sudah ada
**Solusi:** Gunakan file `UPDATE_DASHBOARD_CONTENTS_DATA.sql` sebagai gantinya

### Error: "Unknown database"

**Artinya:** Database belum dipilih
**Solusi:** Klik nama database di sidebar kiri dulu

---

## 📱 Alternatif: Via Command Line (Advanced)

Jika Anda lebih suka command line:

```bash
# Masuk ke folder project
cd C:\xampp\htdocs\nama-project

# Jalankan SQL file 1
mysql -u root -p capaian_kinerja < INSTALL_DASHBOARD_CONTENTS_COMPLETE.sql

# Jalankan SQL file 2
mysql -u root -p capaian_kinerja < CREATE_DASHBOARD_STATISTICS_TABLE.sql
```

Ganti:

- `root` dengan username MySQL Anda
- `capaian_kinerja` dengan nama database Anda

---

## ✅ Setelah Instalasi Berhasil

1. **Buka aplikasi** di browser: `http://localhost:8080`
2. **Login** sebagai admin
3. **Buka Dashboard**
4. **Lihat perubahan:**
   - Stat cards sekarang horizontal (4 cards dalam 1 baris)
   - Konten bisa diedit via menu "Konten Dashboard"
   - Statistik otomatis update

---

## 🎯 Lokasi Menu di Aplikasi

Setelah login sebagai admin, menu baru akan muncul di sidebar:

```
┌─────────────────────────────┐
│ 📊 Dashboard                │
│                             │
│ 🎯 Kriteria SDGs            │
│   ├─ Pengaturan & Infra     │
│   ├─ Energi & Iklim         │
│   └─ ...                    │
│                             │
│ ⚙️ Sistem                   │
│   ├─ Manajemen User         │
│   ├─ Manajemen Menu         │
│   ├─ Manajemen Berita       │
│   ├─ Konten Landing Page    │
│   ├─ Konten Dashboard  ← MENU BARU!
│   └─ ...                    │
└─────────────────────────────┘
```

Klik **"Konten Dashboard"** untuk edit content!

---

## 📞 Butuh Bantuan?

Jika masih bingung:

1. Screenshot error yang muncul
2. Cek file `CHECKLIST_INSTALASI.md` untuk troubleshooting
3. Pastikan XAMPP/MySQL sudah running

---

**Selamat mencoba! Jika ada pertanyaan, tanya saja! 😊**
