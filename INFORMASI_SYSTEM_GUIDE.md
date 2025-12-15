# 📋 Panduan Sistem Informasi Landing Page

## 🎯 Overview

Sistem ini menyamakan informasi antara landing page dan dashboard, dengan fitur manajemen konten informasi yang lengkap termasuk alamat, telepon, email, dan peta Google Maps yang dapat diedit secara dinamis.

## 🚀 Fitur Utama

### ✅ Yang Sudah Diimplementasi:

1. **Manajemen Konten Informasi**

   - Edit judul dan deskripsi informasi
   - Kelola alamat, telepon, email
   - Upload dan edit Google Maps embed
   - Preview peta real-time

2. **Sinkronisasi Dashboard ↔ Landing Page**

   - Tombol sinkronisasi otomatis
   - Konten dashboard info_box → landing page informasi
   - Data tersimpan di database

3. **Menu Navigation Update**

   - "Kontak" → "Informasi"
   - URL: `#kontak` → `#informasi`

4. **Admin Panel Integration**
   - Menu baru: "Kelola Informasi"
   - Akses: Sistem → Kelola Informasi
   - URL: `/informasi-contents`

## 📁 File yang Dibuat/Dimodifikasi

### 🆕 File Baru:

```
app/Views/cms/informasi/index.php          # Interface admin kelola informasi
app/Controllers/CmsController.php          # Method baru: informasiContents, updateInformasiContent, syncDashboardToLanding
UPDATE_LANDING_CONTENTS_FOR_INFO.sql      # Update struktur tabel
INSERT_INFORMASI_CONTENT.sql              # Data awal informasi
INSTALL_INFORMASI_SYSTEM_COMPLETE.sql     # Instalasi lengkap
INFORMASI_SYSTEM_GUIDE.md                 # Dokumentasi ini
```

### 🔄 File yang Dimodifikasi:

```
app/Models/LandingContentModel.php         # Tambah field: address, phone, email, map_embed, map_latitude, map_longitude
app/Views/home.php                         # Update section informasi menggunakan data database
app/Views/layouts/sidebar_layout.php       # Tambah menu "Kelola Informasi"
app/Config/Routes.php                      # Tambah routes informasi
app/Controllers/Dashboard.php              # Tambah dashboard_content ke data
```

## 🛠️ Instalasi

### 1. Jalankan SQL Installation

```sql
-- Jalankan file ini di database:
INSTALL_INFORMASI_SYSTEM_COMPLETE.sql
```

### 2. Verifikasi Instalasi

- Login sebagai admin
- Cek menu "Kelola Informasi" di sidebar
- Akses: `/informasi-contents`

## 📖 Cara Penggunaan

### 🔧 Admin - Kelola Informasi

1. **Login sebagai Admin**
2. **Navigasi**: Sidebar → Sistem → Kelola Informasi
3. **Edit Konten**:
   - Judul & Deskripsi
   - Alamat lengkap
   - Nomor telepon
   - Email kontak
   - Google Maps embed code

### 🗺️ Cara Upload Google Maps

1. Buka [Google Maps](https://maps.google.com)
2. Cari lokasi Polban
3. Klik **Share** → **Embed a map**
4. Copy kode HTML
5. Paste di field "Embed Code Google Maps"
6. Preview akan muncul otomatis

### 🔄 Sinkronisasi Dashboard → Landing Page

1. Di halaman "Kelola Informasi"
2. Klik tombol **"Sinkronisasi dari Dashboard"**
3. Konten info_box dashboard akan disalin ke landing page
4. Konfirmasi perubahan

## 🎨 Tampilan

### Landing Page (Before vs After)

**Before**: Konten statis, tidak bisa diedit
**After**: Konten dinamis dari database, bisa diedit admin

### Dashboard Integration

- Info box dashboard tersinkronisasi dengan landing page
- Konten konsisten di kedua tempat

## 🔧 Technical Details

### Database Schema

```sql
-- Tabel: landing_contents (updated)
ALTER TABLE landing_contents ADD COLUMN:
- address TEXT NULL
- phone VARCHAR(50) NULL
- email VARCHAR(100) NULL
- map_embed TEXT NULL
- map_latitude DECIMAL(10, 8) NULL
- map_longitude DECIMAL(11, 8) NULL
```

### API Endpoints

```php
GET  /informasi-contents              # Halaman admin kelola informasi
POST /informasi-contents/update       # Update konten informasi
POST /cms/sync-dashboard-to-landing   # Sinkronisasi dashboard → landing
```

### Controller Methods

```php
CmsController::informasiContents()           # Tampilkan halaman admin
CmsController::updateInformasiContent()      # Update konten
CmsController::syncDashboardToLanding()     # Sinkronisasi konten
```

## 🎯 Benefits

### ✅ Untuk Admin:

- **Mudah dikelola**: Interface admin yang user-friendly
- **Real-time preview**: Lihat perubahan peta langsung
- **Sinkronisasi otomatis**: Konten konsisten dashboard ↔ landing page
- **Fleksibel**: Edit semua informasi kontak dan lokasi

### ✅ Untuk User:

- **Informasi akurat**: Data selalu up-to-date
- **Peta interaktif**: Google Maps terintegrasi
- **Konten konsisten**: Informasi sama di dashboard dan landing page

## 🚨 Troubleshooting

### Problem: Menu "Kelola Informasi" tidak muncul

**Solution**:

- Pastikan login sebagai admin
- Cek variabel `$user_role` di controller
- Jalankan SQL update menu

### Problem: Peta tidak muncul

**Solution**:

- Pastikan embed code Google Maps valid
- Cek format iframe HTML
- Verifikasi field `map_embed` di database

### Problem: Sinkronisasi gagal

**Solution**:

- Cek konten `info_box` di tabel `dashboard_contents`
- Pastikan user memiliki role admin
- Cek log error di browser console

## 📞 Support

Jika ada masalah atau pertanyaan, silakan hubungi developer atau cek dokumentasi teknis di kode.

---

**Status**: ✅ **READY TO USE**  
**Version**: 1.0  
**Last Updated**: December 2024
