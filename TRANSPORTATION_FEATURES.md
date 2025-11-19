# Transportation CRUD - Fitur yang Telah Diimplementasikan

## 1. Verification Status Fields (Status Verifikasi)

### Database Fields
- `status_verifikasi` - ENUM('pending', 'approved', 'rejected')
- `catatan_verifikasi` - TEXT untuk catatan reviewer
- `verified_by` - ID user yang melakukan verifikasi
- `verified_at` - Timestamp verifikasi

### Workflow
1. Data baru otomatis berstatus **pending**
2. Admin/Reviewer dapat memverifikasi data
3. Status dapat berubah menjadi **approved** atau **rejected**
4. Data approved tidak bisa diedit kecuali oleh admin
5. Edit data approved akan mengubah status kembali ke pending

## 2. File Upload (Bukti Pendukung)

### Fitur
- Upload file saat create/update data
- Format: PDF, JPG, PNG, XLSX, XLS
- Maksimal ukuran: 2MB
- File disimpan di: `writable/uploads/transportation/`
- Download file melalui link di index dan verify page
- Auto-delete file lama saat update atau delete data

### Validasi
- File wajib diupload saat create
- File optional saat update (jika tidak diubah)
- Validasi format dan ukuran file

## 3. Automatic Calculation (Perhitungan Otomatis)

### Perhitungan Persentase
```
Persentase = (Perjalanan Ramah Lingkungan / Total Perjalanan) × 100
```

### Fitur
- Input: `total_perjalanan` dan `perjalanan_ramah_lingkungan`
- Output: `capaian_persen` (dihitung otomatis)
- Preview real-time di form create/edit menggunakan JavaScript
- Validasi: perjalanan ramah lingkungan tidak boleh > total perjalanan

### Implementasi
- Backend: Perhitungan di controller sebelum insert/update
- Frontend: Live preview dengan JavaScript
- Pembulatan: 2 desimal

## Cara Menggunakan

### 1. Jalankan Migration
```bash
php spark migrate
```

### 2. Akses Fitur
- **Admin/Kaprodi**: Dapat create dan edit data
- **Admin/Reviewer**: Dapat verifikasi data
- **Admin**: Dapat delete data
- **Semua user**: Dapat view data

### 3. Workflow Penggunaan
1. Login sebagai admin/kaprodi
2. Buka menu Transportation
3. Klik "Tambah Data"
4. Isi form (total perjalanan, perjalanan ramah lingkungan, dll)
5. Upload bukti pendukung
6. Submit → Status: Pending
7. Admin/Reviewer verifikasi data
8. Status berubah: Approved/Rejected

## Routes yang Ditambahkan
```
GET  /transportation/verify/:id
POST /transportation/process-verification/:id
GET  /transportation/download/:id
```

## File yang Dibuat/Dimodifikasi

### Migration
- `2025-11-13-000001_AddVerificationFieldsToTransportation.php`

### Model
- `TransportationModel.php` (updated)

### Controller
- `TransportationController.php` (updated)
  - Method baru: `verify()`, `processVerification()`, `download()`
  - Update: `store()`, `update()`, `delete()`

### Views
- `app/Views/kriteria/transportation/create.php`
- `app/Views/kriteria/transportation/edit.php`
- `app/Views/kriteria/transportation/index.php`
- `app/Views/kriteria/transportation/verify.php`

### Config
- `app/Config/Routes.php` (updated)

## Testing

### Test Create Data
1. Login sebagai admin
2. Buka /transportation/create
3. Isi form dengan data valid
4. Upload file PDF
5. Submit
6. Cek status = pending

### Test Verification
1. Login sebagai admin
2. Buka /transportation
3. Klik "Verifikasi" pada data pending
4. Pilih status (Approved/Rejected)
5. Isi catatan
6. Submit
7. Cek status berubah

### Test Auto-calculation
1. Buka form create/edit
2. Isi Total Perjalanan: 1000
3. Isi Perjalanan Ramah Lingkungan: 750
4. Lihat preview: 75%
5. Submit dan cek di database

## Catatan Penting
- Pastikan folder `writable/uploads/transportation/` memiliki permission write
- File upload menggunakan random name untuk keamanan
- Soft delete belum diimplementasi (masih hard delete)
- Untuk implementasi soft delete, tambahkan field `deleted_at` di migration
