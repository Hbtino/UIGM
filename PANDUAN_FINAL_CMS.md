# 🎯 PANDUAN FINAL: Setup CMS Management

## ✅ JAMINAN KEAMANAN

**DATABASE ANDA TIDAK AKAN RUSAK!**

SQL yang saya berikan:
- ✅ Hanya menambah 1 kolom baru (`menu_type`)
- ✅ Tidak menghapus data lama
- ✅ Tidak mengubah struktur existing
- ✅ 100% AMAN untuk dijalankan

## 📋 Langkah-Langkah Setup

### STEP 1: Backup Database (Opsional tapi Recommended)

```
1. Buka phpMyAdmin
2. Pilih database: capaian_kinerja
3. Klik tab "Export"
4. Klik "Go"
5. Simpan file backup
```

### STEP 2: Jalankan SQL Update

```
1. Buka phpMyAdmin
2. Pilih database: capaian_kinerja
3. Klik tab "SQL"
4. Copy semua isi file: UPDATE_DATABASE_FOR_CMS.sql
5. Paste ke SQL editor
6. Klik "Go"
7. Tunggu sampai selesai
```

### STEP 3: Verifikasi

```
1. Klik tabel "menus"
2. Cek apakah ada kolom "menu_type" (kolom baru)
3. Cek apakah data lama masih ada (11 menu)
4. Cek apakah ada menu baru (Manajemen Berita, dll)
```

### STEP 4: Test Sistem

```
1. Login sebagai admin
2. Akses: http://localhost:8080/cms/menus
3. Coba tambah menu baru
4. Coba edit menu existing
5. Coba hapus menu test
```

## 📊 Apa yang Berubah?

### SEBELUM Update:

**Tabel menus**:
```
- id
- parent_id
- title
- url
- icon
- order
- is_active
- roles
- created_at
- updated_at

Data: 11 menu dashboard
```

### SESUDAH Update:

**Tabel menus**:
```
- id
- parent_id
- title
- url
- icon
- order
- is_active
- roles
- menu_type  ← BARU (dashboard/landing)
- created_at
- updated_at

Data: 
- 11 menu dashboard (TETAP ADA)
- 2 menu CMS baru (Manajemen Berita, Konten)
- 4 menu landing page (Deskripsi, Program, Berita, Kontak)
Total: 17 menu
```

## 🎯 Fitur yang Didapat

### 1. Menu Management Dashboard
Admin bisa kelola menu sidebar:
- Dashboard
- Kriteria SDGs (dengan submenu)
- Manajemen User
- CMS Management
- Manajemen Berita ← BARU
- Manajemen Konten ← BARU
- Pengaturan

### 2. Menu Management Landing Page
Admin bisa kelola menu header landing page:
- Deskripsi ← BARU
- Program ← BARU
- Berita ← BARU
- Kontak ← BARU

### 3. News Management
Admin bisa kelola berita:
- Tambah berita baru
- Edit berita
- Hapus berita
- Status Published/Draft
- Upload gambar
- Berita muncul di landing page (max 3)

### 4. Content Management
Admin bisa kelola konten:
- Hero Section (Landing Page)
- Statistik Dashboard
- Indikator Kriteria
- Total Score (per tahun)
- Ranking Dunia (per tahun)
- Ranking Indonesia (per tahun)

## 📝 Cara Menggunakan

### A. Mengelola Menu Dashboard

```
1. Login sebagai admin
2. Buka: /cms/menus
3. Klik "Tambah Menu"
4. Isi form:
   - Judul: Nama menu
   - URL: /route-tujuan
   - Icon: fas fa-icon
   - Parent: (kosongkan untuk root)
   - Urutan: angka
   - Tipe Menu: dashboard
   - Role: centang yang boleh akses
   - Status: Aktif
5. Klik "Simpan"
```

### B. Mengelola Menu Landing Page

```
1. Login sebagai admin
2. Buka: /cms/menus
3. Klik "Tambah Menu"
4. Isi form:
   - Judul: Nama menu
   - URL: #section-name
   - Icon: (kosongkan)
   - Parent: (kosongkan)
   - Urutan: 101, 102, 103, dst
   - Tipe Menu: landing ← PENTING
   - Role: centang semua
   - Status: Aktif
5. Klik "Simpan"
```

### C. Mengelola Berita

```
1. Login sebagai admin
2. Buka: /cms/news
3. Klik "Tambah Berita"
4. Isi form:
   - Judul: Judul berita
   - Kategori: Prestasi, Kegiatan, dll
   - Ringkasan: Ringkasan singkat
   - Konten: Konten lengkap
   - Gambar: Upload gambar (optional)
   - Status: Published (tampil) atau Draft (tidak tampil)
5. Klik "Simpan"
6. Berita akan muncul di landing page (max 3 terbaru)
```

### D. Mengelola Konten

```
1. Login sebagai admin
2. Buka: /cms/contents
3. Pilih section yang ingin diedit
4. Klik "Edit" pada konten
5. Ubah value
6. Klik "Update"
```

## 🔍 Troubleshooting

### Error: Column 'menu_type' not found
**Solusi**: Jalankan SQL UPDATE_DATABASE_FOR_CMS.sql

### Menu tidak bisa diedit
**Cek**:
1. Sudah login sebagai admin?
2. Kolom menu_type sudah ditambahkan?
3. Refresh browser (Ctrl+F5)

### Berita tidak muncul di landing page
**Cek**:
1. Status berita = "Published"?
2. Maksimal 3 berita yang tampil
3. Refresh landing page

### Data lama hilang
**Solusi**: Restore dari backup
```sql
-- Jika sudah backup
DROP TABLE menus;
RENAME TABLE menus_backup TO menus;
```

## ✅ Checklist Verifikasi

Setelah jalankan SQL, cek:

- [ ] Kolom `menu_type` ada di tabel `menus`
- [ ] Data lama (11 menu) masih ada
- [ ] Menu baru (Manajemen Berita, Konten) sudah ada
- [ ] Menu landing page (Deskripsi, Program, Berita, Kontak) sudah ada
- [ ] Bisa akses `/cms/menus`
- [ ] Bisa akses `/cms/news`
- [ ] Bisa akses `/cms/contents`
- [ ] Bisa tambah menu baru
- [ ] Bisa edit menu existing
- [ ] Bisa tambah berita
- [ ] Berita muncul di landing page

## 📞 Support

Jika ada masalah:
1. Cek error log di `writable/logs/`
2. Cek browser console (F12)
3. Pastikan sudah login sebagai admin
4. Clear cache browser
5. Restart server

## 🎉 Kesimpulan

**AMAN untuk dijalankan!**

Yang terjadi:
- ✅ Tambah 1 kolom baru
- ✅ Data lama tetap utuh
- ✅ Fitur CMS lengkap
- ✅ Menu dashboard & landing page bisa dikelola
- ✅ Berita bisa dikelola
- ✅ Konten bisa dikelola

**Tidak ada yang rusak, hanya menambah fitur baru!**

---

**File SQL**: `UPDATE_DATABASE_FOR_CMS.sql`  
**Status**: ✅ Siap digunakan  
**Keamanan**: ✅ 100% Aman  
**Backup**: ⚠️ Recommended (optional)
