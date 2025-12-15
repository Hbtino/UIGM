# Use Case Setiap Role - Sistem GreenMetric Polban

## Daftar Role dalam Sistem

Berdasarkan database dan sistem yang ada, terdapat **4 role utama**:

1. **Admin** - Pengelola sistem penuh
2. **Dosen** - Pengisi data kriteria SDGs
3. **Kaprodi** - Kepala Program Studi
4. **User** - Pengguna umum (ex-mahasiswa)

---

## 1. ADMIN - Use Cases

### **Akses Penuh Sistem**

- **Actor**: Admin
- **Goal**: Mengelola seluruh sistem GreenMetric Polban
- **Precondition**: Login sebagai admin
- **Main Flow**:
  1. Login ke sistem dengan role admin
  2. Akses dashboard admin dengan menu lengkap
  3. Dapat mengakses semua fitur sistem
  4. Mengelola data dan konfigurasi sistem

### **UC-A01: Manajemen User**

- **Actor**: Admin
- **Goal**: Mengelola akun pengguna sistem
- **Main Flow**:
  1. Masuk ke menu "Manajemen User"
  2. Melihat daftar semua user
  3. Dapat melakukan:
     - **Create**: Tambah user baru
     - **Read**: Lihat detail user
     - **Update**: Edit data user, ubah role, approve/reject
     - **Delete**: Hapus user
  4. Approve/reject pendaftaran user baru
  5. Mengubah role user (admin, dosen, kaprodi, user)

### **UC-A02: Manajemen Konten CMS**

- **Actor**: Admin
- **Goal**: Mengelola konten website
- **Main Flow**:
  1. Akses menu CMS (Landing Page, Dashboard Contents)
  2. Edit konten landing page (deskripsi, program, berita, informasi)
  3. Kelola konten dashboard (info box, chart titles)
  4. Upload gambar dan media
  5. Publish/unpublish konten

### **UC-A03: Manajemen Statistik & Chart**

- **Actor**: Admin
- **Goal**: Mengelola data statistik dan grafik
- **Main Flow**:
  1. Akses "Manajemen Statistik & Chart"
  2. Kelola statistik landing page:
     - Info boxes (target skor, ranking)
     - Profil kampus (mahasiswa, dosen, fasilitas)
     - Progress ranking
  3. Kelola data chart dashboard
  4. Sinkronisasi data antar sistem
  5. CRUD lengkap untuk semua statistik

### **UC-A04: Manajemen Berita**

- **Actor**: Admin
- **Goal**: Mengelola berita website
- **Main Flow**:
  1. Masuk ke "Manajemen Berita"
  2. Create: Tulis berita baru
  3. Edit: Ubah berita existing
  4. Publish/unpublish berita
  5. Upload gambar berita
  6. Atur kategori dan tags

### **UC-A05: Verifikasi Data Kriteria**

- **Actor**: Admin
- **Goal**: Memverifikasi data yang disubmit dosen/kaprodi
- **Main Flow**:
  1. Akses menu kriteria SDGs
  2. Lihat data dengan status "pending"
  3. Review dokumen dan evidence
  4. Approve/reject dengan komentar
  5. Minta revisi jika diperlukan

### **UC-A06: Laporan Komprehensif**

- **Actor**: Admin
- **Goal**: Melihat laporan lengkap semua data
- **Main Flow**:
  1. Akses menu "Laporan"
  2. Lihat laporan dosen (semua dosen)
  3. Lihat laporan kaprodi (semua kaprodi)
  4. Export laporan ke PDF/Excel
  5. Filter berdasarkan periode, status, jurusan

---

## 2. DOSEN - Use Cases

### **UC-D01: Input Data Kriteria SDGs**

- **Actor**: Dosen
- **Goal**: Mengisi data untuk 6 kriteria keberlanjutan
- **Precondition**: Login sebagai dosen, sudah diapprove admin
- **Main Flow**:
  1. Login ke sistem
  2. Akses menu kriteria SDGs:
     - Setting & Infrastructure
     - Energy & Climate Change
     - Water Management
     - Waste Management
     - Transportation
     - Education & Research
  3. Pilih kriteria yang akan diisi
  4. Input data sesuai form yang tersedia
  5. Upload dokumen pendukung
  6. Submit untuk review

### **UC-D02: Edit Data Pending**

- **Actor**: Dosen
- **Goal**: Mengedit data yang masih pending review
- **Main Flow**:
  1. Akses menu kriteria
  2. Lihat data dengan status "pending"
  3. Edit data yang belum diverifikasi
  4. Update dokumen jika diperlukan
  5. Re-submit untuk review

### **UC-D03: Request Revisi**

- **Actor**: Dosen
- **Goal**: Meminta revisi data yang sudah diverifikasi
- **Main Flow**:
  1. Akses data yang sudah verified
  2. Klik "Request Revision"
  3. Isi alasan revisi
  4. Submit request ke admin
  5. Tunggu approval untuk edit

### **UC-D04: Lihat Laporan Dosen**

- **Actor**: Dosen
- **Goal**: Melihat laporan data yang sudah diinput
- **Main Flow**:
  1. Akses menu "Laporan" > "Laporan Dosen"
  2. Lihat summary data yang sudah diinput
  3. Lihat status verifikasi
  4. Download laporan personal
  5. Lihat riwayat perubahan data

### **UC-D05: Upload Dokumen Pendukung**

- **Actor**: Dosen
- **Goal**: Mengupload evidence untuk data
- **Main Flow**:
  1. Saat input/edit data kriteria
  2. Pilih file dokumen (PDF, gambar, Excel)
  3. Upload dengan deskripsi
  4. Validasi format dan ukuran file
  5. Simpan sebagai evidence

---

## 3. KAPRODI - Use Cases

### **UC-K01: Input Data Program Studi**

- **Actor**: Kaprodi
- **Goal**: Mengisi data khusus program studi
- **Precondition**: Login sebagai kaprodi, assigned ke jurusan tertentu
- **Main Flow**:
  1. Login ke sistem
  2. Akses menu kriteria SDGs
  3. Input data yang berkaitan dengan program studi:
     - Jumlah mahasiswa per prodi
     - Program penelitian
     - Kurikulum berkelanjutan
     - Fasilitas prodi
  4. Upload dokumen pendukung
  5. Submit untuk review

### **UC-K02: Lihat Data Jurusan**

- **Actor**: Kaprodi
- **Goal**: Melihat data semua prodi dalam jurusan
- **Main Flow**:
  1. Akses dashboard kaprodi
  2. Lihat ringkasan data jurusan
  3. Monitor progress input data
  4. Lihat status verifikasi per prodi
  5. Koordinasi dengan dosen di jurusan

### **UC-K03: Laporan Kaprodi**

- **Actor**: Kaprodi
- **Goal**: Melihat laporan khusus kaprodi
- **Main Flow**:
  1. Akses menu "Laporan" > "Laporan Kaprodi"
  2. Lihat data aggregat jurusan
  3. Lihat kontribusi per program studi
  4. Export laporan jurusan
  5. Analisis pencapaian target

### **UC-K04: Koordinasi Tim**

- **Actor**: Kaprodi
- **Goal**: Mengkoordinasi input data dengan tim
- **Main Flow**:
  1. Lihat progress input data tim
  2. Identifikasi data yang belum lengkap
  3. Follow up dengan dosen terkait
  4. Ensure kualitas data sebelum submit
  5. Review data sebelum verifikasi admin

### **UC-K05: Validasi Data Prodi**

- **Actor**: Kaprodi
- **Goal**: Memvalidasi data dari program studi
- **Main Flow**:
  1. Review data yang diinput dosen
  2. Cek kesesuaian dengan kondisi real prodi
  3. Approve/request correction
  4. Pastikan data akurat sebelum ke admin
  5. Koordinasi perbaikan jika diperlukan

---

## 4. USER - Use Cases

### **UC-U01: Registrasi Akun**

- **Actor**: User (calon pengguna)
- **Goal**: Mendaftar akun baru
- **Main Flow**:
  1. Akses halaman registrasi
  2. Isi form pendaftaran:
     - Nama lengkap
     - Email
     - Password
     - Role yang diinginkan
     - Jurusan (jika dosen/kaprodi)
  3. Submit pendaftaran
  4. Tunggu approval dari admin
  5. Terima notifikasi approval/rejection

### **UC-U02: Login ke Sistem**

- **Actor**: User
- **Goal**: Masuk ke sistem
- **Main Flow**:
  1. Akses halaman login
  2. Input email dan password
  3. Pilih "Remember Me" jika diperlukan
  4. Submit login
  5. Redirect ke dashboard sesuai role

### **UC-U03: Lihat Landing Page**

- **Actor**: User (publik)
- **Goal**: Melihat informasi GreenMetric Polban
- **Main Flow**:
  1. Akses website tanpa login
  2. Lihat informasi umum:
     - Deskripsi program
     - Statistik kampus
     - Progress ranking
     - Berita terbaru
     - Chart pencapaian
  3. Navigasi antar section
  4. Akses detail berita

### **UC-U04: Akses Dashboard Terbatas**

- **Actor**: User (logged in)
- **Goal**: Melihat dashboard dengan akses terbatas
- **Main Flow**:
  1. Login sebagai user
  2. Akses dashboard basic
  3. Lihat informasi umum saja
  4. Tidak bisa edit/input data
  5. Lihat progress umum kampus

### **UC-U05: Update Profil**

- **Actor**: User
- **Goal**: Mengupdate informasi profil
- **Main Flow**:
  1. Akses menu "Settings"
  2. Edit profil:
     - Nama
     - Email
     - Password
     - Foto profil
  3. Save perubahan
  4. Logout/login ulang jika perlu

---

## Flow Diagram Utama

```
┌─────────────┐    ┌─────────────┐    ┌─────────────┐    ┌─────────────┐
│    ADMIN    │    │    DOSEN    │    │   KAPRODI   │    │    USER     │
│             │    │             │    │             │    │             │
│ • Full CRUD │    │ • Input Data│    │ • Data Prodi│    │ • View Only │
│ • Verify    │    │ • Upload    │    │ • Koordinasi│    │ • Register  │
│ • Manage    │    │ • Request   │    │ • Laporan   │    │ • Profile   │
│ • Reports   │    │ • Reports   │    │ • Validasi  │    │ • Landing   │
└─────────────┘    └─────────────┘    └─────────────┘    └─────────────┘
       │                   │                   │                   │
       └───────────────────┼───────────────────┼───────────────────┘
                           │                   │
                    ┌─────────────────────────────────┐
                    │        DATABASE SISTEM         │
                    │                                 │
                    │ • Users & Roles                 │
                    │ • Kriteria SDGs Data            │
                    │ • Landing Statistics            │
                    │ • Dashboard Statistics          │
                    │ • CMS Contents                  │
                    │ • Reports & Logs                │
                    └─────────────────────────────────┘
```

---

## Kesimpulan

Sistem GreenMetric Polban memiliki **4 role utama** dengan use case yang berbeda:

1. **Admin** - Pengelola penuh dengan 6+ use case utama
2. **Dosen** - Input data kriteria dengan 5 use case
3. **Kaprodi** - Koordinasi program studi dengan 5 use case
4. **User** - Akses terbatas dengan 5 use case

Setiap role memiliki **tanggung jawab dan akses yang berbeda** sesuai dengan kebutuhan sistem pelaporan GreenMetric.
