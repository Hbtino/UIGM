# Quick Start Guide - Transportation CRUD System

## 🚀 Setup

### 1. Database Migration
```bash
php spark migrate
```

### 2. Create Test Users

```sql
-- Admin User
INSERT INTO users (name, email, password, role, created_at) 
VALUES ('Admin User', 'admin@polban.ac.id', '$2y$10$...', 'admin', NOW());

-- Reviewer User
INSERT INTO users (name, email, password, role, created_at) 
VALUES ('Reviewer User', 'reviewer@polban.ac.id', '$2y$10$...', 'reviewer', NOW());

-- Kaprodi User
INSERT INTO users (name, email, password, role, created_at) 
VALUES ('Kaprodi User', 'kaprodi@polban.ac.id', '$2y$10$...', 'kaprodi', NOW());
```

### 3. Verify Folder Permissions
```bash
# Windows
icacls writable\uploads\transportation /grant Users:F

# Linux/Mac
chmod -R 777 writable/uploads/transportation
```

## 📖 User Guide

### Untuk Kaprodi/Data Entry

#### 1. Menambah Data Baru
1. Login ke sistem
2. Buka menu **Transportation**
3. Klik tombol **"+ Tambah Data"**
4. Isi form:
   - **Tahun Periode:** 2025
   - **Total Perjalanan:** 1000
   - **Perjalanan Ramah Lingkungan:** 750
   - **Bukti Pendukung:** Upload file PDF/Excel
5. Klik **"Simpan Data"**
6. Data akan berstatus **Pending** dan menunggu verifikasi

#### 2. Mengedit Data Pending
1. Buka menu **Transportation**
2. Cari data dengan status **Pending**
3. Klik tombol **"Edit"**
4. Ubah data yang diperlukan
5. Klik **"Update Data"**

#### 3. Request Revisi Data Approved
1. Buka menu **Transportation**
2. Cari data dengan status **Approved**
3. Klik tombol **"Request Revisi"**
4. Isi alasan revisi (minimal 10 karakter)
5. Klik **"Ajukan Permintaan Revisi"**
6. Tunggu approval dari admin/reviewer

#### 4. Cek Status Permintaan Revisi
1. Buka menu **Transportation**
2. Klik tombol **"Revisi Saya"**
3. Lihat status permintaan:
   - **Menunggu Review:** Sedang ditinjau
   - **Disetujui:** Anda dapat mengedit data
   - **Ditolak:** Lihat catatan reviewer

### Untuk Reviewer

#### 1. Verifikasi Data Pending
1. Login sebagai reviewer
2. Buka menu **Transportation**
3. Cari data dengan status **Pending**
4. Klik tombol **"Verifikasi"**
5. Review data dan bukti pendukung
6. Pilih status:
   - **Setujui:** Data valid
   - **Tolak:** Data perlu perbaikan
7. Isi catatan verifikasi
8. Klik **"Proses Verifikasi"**

#### 2. Review Permintaan Revisi
1. Login sebagai reviewer
2. Buka menu **Transportation**
3. Klik tombol **"Permintaan Revisi"**
4. Klik **"Review"** pada permintaan pending
5. Baca alasan revisi dan lihat data
6. Pilih keputusan:
   - **Setujui:** Data dikembalikan ke pending, user dapat edit
   - **Tolak:** Data tetap approved
7. Isi catatan review
8. Klik **"Proses Review"**

### Untuk Admin

Admin memiliki semua akses reviewer plus:
- Mengedit data approved langsung (tanpa request revisi)
- Menghapus data
- Mengelola user

## 🎯 Common Workflows

### Workflow 1: Data Baru → Approved
```
1. Kaprodi create data → Status: Pending
2. Reviewer verify → Status: Approved
3. Data dapat digunakan untuk laporan
```

### Workflow 2: Revisi Data Approved
```
1. User request revisi → Status Request: Pending
2. Reviewer approve request → Data Status: Pending
3. User edit data → Data Status: Pending
4. Reviewer verify ulang → Data Status: Approved
```

### Workflow 3: Revisi Ditolak
```
1. User request revisi → Status Request: Pending
2. Reviewer reject request → Data Status: Tetap Approved
3. User lihat catatan reviewer
4. User perbaiki alasan/bukti
5. User request revisi lagi
```

## 🔍 Troubleshooting

### Problem: File Upload Gagal
**Solution:**
1. Cek ukuran file (max 2MB)
2. Cek format file (PDF, JPG, PNG, XLSX, XLS)
3. Cek permission folder `writable/uploads/transportation`

### Problem: Tidak Bisa Edit Data Approved
**Solution:**
1. Jika bukan admin, gunakan fitur "Request Revisi"
2. Tunggu approval dari admin/reviewer
3. Setelah approved, data akan kembali ke status pending

### Problem: Persentase Tidak Sesuai
**Solution:**
1. Persentase dihitung otomatis
2. Formula: (Perjalanan Ramah Lingkungan / Total Perjalanan) × 100
3. Pastikan Total Perjalanan > 0
4. Pastikan Perjalanan Ramah Lingkungan ≤ Total Perjalanan

### Problem: Tidak Bisa Akses Menu Verifikasi
**Solution:**
1. Cek role user (harus admin atau reviewer)
2. Jika perlu, minta admin untuk update role
3. Logout dan login ulang

## 📊 Dashboard Indicators

### Status Badge Colors
- 🟡 **Pending** (Warning) - Menunggu verifikasi
- 🟢 **Approved** (Success) - Data sudah disetujui
- 🔴 **Rejected** (Danger) - Data ditolak

### Revision Status Colors
- 🟡 **Menunggu Review** (Warning) - Permintaan sedang ditinjau
- 🟢 **Disetujui** (Success) - Permintaan disetujui
- 🔴 **Ditolak** (Danger) - Permintaan ditolak

## 💡 Tips & Best Practices

### Untuk Data Entry
1. **Lengkapi Bukti Pendukung**
   - Upload file yang jelas dan relevan
   - Gunakan format PDF untuk dokumen formal
   - Gunakan Excel untuk data tabulasi

2. **Isi Keterangan dengan Lengkap**
   - Jelaskan sumber data
   - Cantumkan metode pengumpulan data
   - Tambahkan catatan penting

3. **Request Revisi dengan Alasan Jelas**
   - Jelaskan apa yang perlu diubah
   - Sertakan referensi data baru
   - Minimal 10 karakter, ideal 50-200 karakter

### Untuk Reviewer
1. **Review Secepat Mungkin**
   - Target: 1-2 hari kerja
   - Prioritaskan data urgent

2. **Berikan Catatan yang Konstruktif**
   - Jika approve: Berikan apresiasi
   - Jika reject: Jelaskan alasan dan langkah perbaikan

3. **Cek Bukti Pendukung**
   - Download dan verifikasi file
   - Pastikan data sesuai dengan bukti

## 📞 Support

Jika mengalami masalah:
1. Cek dokumentasi di `TRANSPORTATION_FEATURES.md`
2. Cek dokumentasi reviewer di `REVIEWER_AND_REVISION_FEATURES.md`
3. Hubungi admin sistem
4. Laporkan bug ke tim developer

## 🔄 Update Log

### Version 1.0 (2025-11-13)
- ✅ Basic CRUD
- ✅ File Upload
- ✅ Auto-calculation
- ✅ Verification System
- ✅ Reviewer Role
- ✅ Revision Request System
