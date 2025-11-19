# 📖 User Guide - Sistem UI GreenMetric CRUD

## 🎯 Panduan Lengkap Penggunaan Sistem

---

## 📋 Daftar Isi

1. [Pengenalan Sistem](#pengenalan-sistem)
2. [Login & Akses](#login--akses)
3. [Dashboard](#dashboard)
4. [Mengelola Data](#mengelola-data)
5. [Verifikasi Data](#verifikasi-data)
6. [Request Revisi](#request-revisi)
7. [Tips & Troubleshooting](#tips--troubleshooting)

---

## 🌱 Pengenalan Sistem

### Apa itu UI GreenMetric CRUD?

Sistem ini adalah aplikasi web untuk mengelola data kriteria SDGs (Sustainable Development Goals) Politeknik Negeri Bandung dalam rangka penilaian UI GreenMetric World University Rankings.

### 6 Modul Kriteria

1. **Transportation** - Data transportasi ramah lingkungan
2. **Setting & Infrastructure** - Data setting dan infrastruktur kampus
3. **Energy & Climate Change** - Data energi dan perubahan iklim
4. **Water Management** - Data pengelolaan air
5. **Waste Management** - Data pengelolaan limbah
6. **Education & Research** - Data pendidikan dan penelitian

---

## 🔐 Login & Akses

### Cara Login

1. Buka browser dan akses URL sistem
2. Masukkan **Email** dan **Password**
3. Klik tombol **Login**

```
Email: user@polban.ac.id
Password: ********
```

### Lupa Password?

Hubungi administrator untuk reset password.

### Role Pengguna

| Role | Akses |
|------|-------|
| **Admin** | Full access - semua fitur |
| **Reviewer** | Verifikasi dan review revisi |
| **Kaprodi** | Input dan edit data sendiri |
| **User** | View data saja |

---

## 📊 Dashboard

Setelah login, Anda akan melihat dashboard dengan:

- **Sidebar Menu** - Navigasi ke modul
- **Header** - Info user dan logout
- **Content Area** - Konten utama

### Navigasi Menu

```
📁 Dashboard
📁 Kriteria
  ├─ 🚗 Transportation
  ├─ 🏢 Setting & Infrastructure
  ├─ ⚡ Energy & Climate Change
  ├─ 💧 Water Management
  ├─ ♻️ Waste Management
  └─ 🎓 Education & Research
```

---

## 📝 Mengelola Data

### A. Melihat Data (Semua Role)

1. Klik menu modul (contoh: **Transportation**)
2. Akan tampil list data dengan informasi:
   - Tahun
   - Data utama
   - Capaian (%)
   - Status verifikasi
   - Aksi

### B. Menambah Data (Admin & Kaprodi)

#### Langkah-langkah:

1. **Klik tombol "Tambah Data"**
   
2. **Isi Form:**
   - Tahun (wajib, unik)
   - Data-data sesuai modul
   - Keterangan (opsional)
   - Upload file bukti pendukung

3. **Preview Auto-calculation:**
   - Sistem akan otomatis menghitung persentase
   - Pastikan angka sudah benar

4. **Upload File:**
   - Format: PDF, JPG, PNG, XLSX, XLS
   - Ukuran maksimal: 2MB
   - Contoh: Laporan, foto, dokumen pendukung

5. **Klik "Simpan"**

#### Contoh: Menambah Data Transportation

```
Tahun: 2024
Total Perjalanan: 10000
Perjalanan Ramah Lingkungan: 7500
Keterangan: Data semester genap 2024
File: laporan_transportasi_2024.pdf

→ Capaian otomatis: 75%
```

### C. Mengedit Data (Admin & Kaprodi)

#### Siapa yang bisa edit?

- **Admin:** Semua data
- **Kaprodi:** Data sendiri dengan status **Pending**

#### Langkah-langkah:

1. Klik tombol **Edit** pada data
2. Ubah data yang diperlukan
3. Upload file baru (opsional)
4. Klik **Update**

**Catatan:** Data yang sudah **Approved** tidak bisa diedit langsung. Harus request revisi dulu.

### D. Menghapus Data (Admin Only)

1. Klik tombol **Hapus**
2. Konfirmasi penghapusan
3. Data akan dihapus permanen

---

## ✅ Verifikasi Data

### Untuk Admin & Reviewer

#### Langkah-langkah Verifikasi:

1. **Lihat Data Pending**
   - Buka modul
   - Cari data dengan status **Pending**

2. **Klik tombol "Verifikasi"**

3. **Review Data:**
   - Periksa semua field
   - Download dan cek file bukti
   - Validasi perhitungan

4. **Pilih Status:**
   - **Approve** - Data valid dan diterima
   - **Reject** - Data tidak valid atau perlu perbaikan

5. **Isi Catatan Verifikasi:**
   ```
   Contoh Approve:
   "Data valid dan sesuai dengan dokumen pendukung"
   
   Contoh Reject:
   "File bukti tidak lengkap, mohon upload dokumen yang lebih detail"
   ```

6. **Klik "Simpan Verifikasi"**

#### Status Verifikasi

| Status | Warna | Arti |
|--------|-------|------|
| **Pending** | 🟡 Kuning | Menunggu verifikasi |
| **Approved** | 🟢 Hijau | Data disetujui |
| **Rejected** | 🔴 Merah | Data ditolak |

---

## 🔄 Request Revisi

### Untuk Kaprodi (Data Owner)

Jika data sudah **Approved** tapi perlu direvisi:

#### Langkah-langkah:

1. **Klik tombol "Request Revisi"** pada data approved

2. **Isi Alasan Revisi:**
   ```
   Contoh:
   "Terdapat kesalahan input pada jumlah total perjalanan. 
   Seharusnya 10500 bukan 10000."
   ```

3. **Klik "Submit Request"**

4. **Tunggu Review:**
   - Admin/Reviewer akan review request
   - Cek status di menu **"Revisi Saya"**

#### Status Request Revisi

| Status | Arti |
|--------|------|
| **Pending** | Menunggu review |
| **Approved** | Request disetujui, data bisa diedit |
| **Rejected** | Request ditolak |

### Melihat Status Revisi

Menu: **"Revisi Saya"**

Informasi yang ditampilkan:
- Data yang direquest
- Alasan revisi
- Status request
- Catatan reviewer
- Tanggal request

---

## 🔍 Review Request Revisi

### Untuk Admin & Reviewer

#### Langkah-langkah:

1. **Buka "Daftar Request Revisi"**

2. **Klik "Review"** pada request

3. **Baca Alasan Revisi:**
   - Pahami kenapa user minta revisi
   - Cek data yang dimaksud

4. **Pilih Keputusan:**
   - **Approve** - Izinkan revisi (status data → Pending)
   - **Reject** - Tolak revisi (status data tetap Approved)

5. **Isi Catatan Review:**
   ```
   Contoh Approve:
   "Request revisi disetujui. Silakan edit data."
   
   Contoh Reject:
   "Data sudah benar, tidak perlu revisi."
   ```

6. **Klik "Submit Review"**

---

## 📥 Download File

### Cara Download Bukti Pendukung

1. Pada list data, klik tombol **Download**
2. File akan terdownload otomatis
3. Buka file untuk verifikasi

### Format File yang Didukung

- **PDF** - Dokumen, laporan
- **JPG/PNG** - Foto, screenshot
- **XLSX/XLS** - Data Excel

---

## 💡 Tips & Best Practices

### Tips Input Data

1. **Pastikan Data Akurat**
   - Double check angka sebelum submit
   - Gunakan data resmi dari sumber terpercaya

2. **File Bukti Berkualitas**
   - Upload file yang jelas dan lengkap
   - Ukuran file jangan terlalu besar (max 2MB)
   - Gunakan nama file yang deskriptif

3. **Keterangan yang Jelas**
   - Tambahkan keterangan untuk konteks
   - Jelaskan sumber data jika perlu

4. **Tahun Unik**
   - Satu tahun hanya satu data
   - Jika ada kesalahan, edit atau hapus dulu

### Tips Verifikasi

1. **Teliti dan Cermat**
   - Periksa semua field dengan detail
   - Bandingkan dengan file bukti

2. **Catatan yang Konstruktif**
   - Berikan feedback yang jelas
   - Jika reject, jelaskan apa yang perlu diperbaiki

3. **Konsisten**
   - Gunakan standar verifikasi yang sama
   - Dokumentasikan kriteria verifikasi

---

## ❓ Troubleshooting

### Masalah Umum & Solusi

#### 1. Tidak Bisa Login

**Penyebab:**
- Email/password salah
- Akun belum diapprove
- Akun direject

**Solusi:**
- Cek email dan password
- Hubungi admin untuk approval
- Minta admin untuk re-approve akun

---

#### 2. File Upload Gagal

**Penyebab:**
- File terlalu besar (>2MB)
- Format file tidak didukung
- Koneksi internet bermasalah

**Solusi:**
- Kompres file jika terlalu besar
- Gunakan format: PDF, JPG, PNG, XLSX, XLS
- Cek koneksi internet

---

#### 3. Data Tidak Bisa Diedit

**Penyebab:**
- Data sudah approved
- Bukan data milik sendiri (untuk Kaprodi)
- Tidak punya permission

**Solusi:**
- Request revisi jika data approved
- Hubungi admin jika perlu edit data orang lain
- Cek role akun Anda

---

#### 4. Perhitungan Otomatis Salah

**Penyebab:**
- Input data salah
- Bug sistem

**Solusi:**
- Cek ulang input data
- Refresh halaman
- Lapor ke admin jika masih salah

---

#### 5. Tombol Tidak Muncul

**Penyebab:**
- Role tidak sesuai
- Status data tidak memenuhi syarat

**Solusi:**
- Cek role akun Anda
- Cek status data (pending/approved/rejected)
- Hubungi admin jika perlu akses

---

## 📞 Bantuan & Support

### Kontak Support

**Email:** support@polban.ac.id  
**Phone:** +62-22-1234567  
**Jam Kerja:** Senin-Jumat, 08:00-16:00 WIB

### Informasi yang Perlu Disiapkan

Saat menghubungi support, siapkan:
1. Email akun Anda
2. Screenshot error (jika ada)
3. Deskripsi masalah yang detail
4. Langkah-langkah yang sudah dicoba

---

## 📚 Referensi

### Dokumen Terkait

- **COMPLETE_SYSTEM_DOCUMENTATION.md** - Dokumentasi sistem lengkap
- **MODULE_SPECIFICATIONS.md** - Spesifikasi setiap modul
- **API_ENDPOINTS_DOCUMENTATION.md** - Dokumentasi API

### Link Berguna

- **UI GreenMetric:** https://greenmetric.ui.ac.id
- **Polban:** https://polban.ac.id
- **SDGs:** https://sdgs.un.org

---

## 🎓 Training & Tutorial

### Video Tutorial (Coming Soon)

1. Cara Login dan Navigasi
2. Input Data Baru
3. Verifikasi Data
4. Request dan Review Revisi

### Workshop

Hubungi tim UI GreenMetric Polban untuk jadwal workshop.

---

## 📝 Changelog

### Version 1.0.0 (2025-11-14)
- Initial release
- 6 modul lengkap
- Fitur CRUD, verifikasi, dan revisi

---

## ✅ Checklist Pengguna Baru

Untuk pengguna baru, pastikan sudah:

- [ ] Menerima email dan password dari admin
- [ ] Berhasil login ke sistem
- [ ] Memahami role dan akses Anda
- [ ] Membaca user guide ini
- [ ] Mencoba input data test
- [ ] Mengetahui cara menghubungi support

---

**Selamat menggunakan Sistem UI GreenMetric CRUD!**

Jika ada pertanyaan, jangan ragu untuk menghubungi tim support kami.

---

**Last Updated:** 2025-11-14  
**Version:** 1.0.0  
**Author:** UI GreenMetric Team Polban
