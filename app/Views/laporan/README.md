# Sistem Laporan UI GreenMetric

## Overview
Sistem ini menyediakan dua jenis laporan untuk UI GreenMetric:

### 1. Laporan Dosen (`index.php`)
**Akses:** Admin & Dosen

**Konten:**
- Informasi Dosen (Nama, Jurusan, Program Studi)
- Kursus/Mata Kuliah tentang Keberlanjutan
- Acara Ilmiah (Seminar/Workshop/Pengabdian)
- Praktik Ramah Lingkungan di Area Kerja/Lab
- Kontribusi Kebijakan atau Infrastruktur

**Fitur:**
- Admin dapat memilih dosen dari dropdown
- Dosen hanya bisa melihat/edit laporan sendiri (readonly)
- File upload untuk bukti dukung (PDF, Word, Images)

### 2. Laporan Kaprodi (`kaprodi.php`)
**Akses:** Admin & Kaprodi

**Konten:**
- Informasi Program Studi
- Kontribusi berdasarkan 6 kriteria UI GreenMetric:
  - **SI** (Setting and Infrastructure)
  - **EC** (Energy and Climate Change)
  - **WS** (Waste)
  - **WR** (Water)
  - **TR** (Transportation)
  - **ER** (Education and Research)

**Fitur:**
- Admin dapat memilih program studi dari dropdown
- Kaprodi hanya bisa melihat/edit laporan prodi sendiri (readonly)
- File upload untuk bukti dukung
- Textarea untuk deskripsi detail kegiatan

## Routes

```php
// Laporan Dosen
GET /laporan
GET /dashboard/laporan

// Laporan Kaprodi
GET /laporan/kaprodi
GET /dashboard/laporan/kaprodi
```

## Controller Methods

**LaporanController.php**
- `index()` - Laporan Dosen
- `kaprodi()` - Laporan Kaprodi

## Access Control

| Role    | Laporan Dosen | Laporan Kaprodi |
|---------|---------------|-----------------|
| Admin   | ✅ Full Access | ✅ Full Access  |
| Dosen   | ✅ Own Only    | ❌ No Access    |
| Kaprodi | ❌ No Access   | ✅ Own Only     |

## Menu Navigation

Menu "Laporan" di sidebar memiliki submenu:
- **Laporan Dosen** (untuk Admin & Dosen)
- **Laporan Kaprodi** (untuk Admin & Kaprodi)

## File Upload Support

Kedua laporan mendukung upload file dengan format:
- PDF (.pdf)
- Word (.doc, .docx)
- Images (.jpg, .jpeg, .png)

## Template Reference

Laporan Kaprodi dibuat berdasarkan template yang disediakan dengan struktur:
1. Pendahuluan
2. Kontribusi Berdasarkan Kriteria UI GreenMetric
3. Penutup

Setiap kriteria memiliki tabel dengan kolom:
- No
- Kegiatan/Inisiatif Program Studi
- Data Kuantitatif/Kualitatif (Bukti)
- Lampiran (File Upload)
