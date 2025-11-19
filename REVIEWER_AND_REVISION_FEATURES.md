# Reviewer Role & Revision Request System

## 📋 Overview

Sistem ini menambahkan dua fitur penting:
1. **Reviewer Role** - Role khusus untuk verifikasi data
2. **Revision Request System** - Sistem permintaan revisi untuk data yang sudah approved

## 🎭 Reviewer Role

### Definisi
Reviewer adalah role khusus yang memiliki hak untuk:
- Memverifikasi data yang berstatus pending
- Mereview permintaan revisi
- Melihat semua data transportation

### Perbedaan dengan Role Lain

| Fitur | Admin | Reviewer | Kaprodi | User |
|-------|-------|----------|---------|------|
| Create Data | ✅ | ❌ | ✅ | ❌ |
| Edit Data Pending | ✅ | ❌ | ✅ | ❌ |
| Edit Data Approved | ✅ | ❌ | ❌ | ❌ |
| Verifikasi Data | ✅ | ✅ | ❌ | ❌ |
| Review Revisi | ✅ | ✅ | ❌ | ❌ |
| Delete Data | ✅ | ❌ | ❌ | ❌ |
| Request Revisi | ✅ | ✅ | ✅ | ✅ |

### Cara Menambahkan Reviewer

1. **Via Database:**
```sql
UPDATE users SET role = 'reviewer' WHERE id = [user_id];
```

2. **Via User Management (Admin):**
- Login sebagai admin
- Buka menu User Management
- Edit user yang ingin dijadikan reviewer
- Ubah role menjadi "reviewer"

## 🔄 Revision Request System

### Workflow Revision Request

```
┌─────────────────┐
│  Data Approved  │
└────────┬────────┘
         │
         ▼
┌─────────────────────┐
│ User Request Revisi │ ← User mengajukan permintaan
└────────┬────────────┘
         │
         ▼
┌──────────────────────┐
│ Admin/Reviewer Review│ ← Admin/Reviewer meninjau
└────────┬─────────────┘
         │
    ┌────┴────┐
    ▼         ▼
┌─────────┐ ┌──────────┐
│Approved │ │ Rejected │
└────┬────┘ └──────────┘
     │
     ▼
┌──────────────┐
│Status Pending│ ← Data dapat diedit
└──────────────┘
```

### Fitur Revision Request

#### 1. Request Revision (User)
**URL:** `/transportation/request-revision/:id`

**Syarat:**
- Data harus berstatus "approved"
- User harus login
- Alasan revisi minimal 10 karakter

**Proses:**
1. User membuka data yang approved
2. Klik tombol "Request Revisi"
3. Isi alasan revisi
4. Submit permintaan
5. Status permintaan: Pending

#### 2. Review Revision (Admin/Reviewer)
**URL:** `/transportation/revisions`

**Fitur:**
- Melihat semua permintaan revisi
- Filter berdasarkan status (pending/approved/rejected)
- Statistik permintaan revisi

**Proses Review:**
1. Admin/Reviewer buka daftar permintaan
2. Klik "Review" pada permintaan pending
3. Lihat detail data dan alasan revisi
4. Pilih keputusan:
   - **Approve:** Data dikembalikan ke status pending, user dapat edit
   - **Reject:** Data tetap approved, user tidak dapat edit
5. Isi catatan review (opsional)
6. Submit keputusan

#### 3. My Revisions (User)
**URL:** `/transportation/my-revisions`

**Fitur:**
- Melihat semua permintaan revisi yang diajukan
- Status permintaan (pending/approved/rejected)
- Catatan review dari admin/reviewer

## 🗄️ Database Structure

### Table: transportation_revisions

```sql
CREATE TABLE transportation_revisions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    transportation_id INT NOT NULL,
    revision_type ENUM('request', 'approved', 'rejected'),
    requested_by INT NOT NULL,
    alasan_revisi TEXT NOT NULL,
    data_revisi JSON,
    status ENUM('pending', 'approved', 'rejected'),
    reviewed_by INT,
    review_notes TEXT,
    reviewed_at DATETIME,
    created_at DATETIME,
    updated_at DATETIME
);
```

### Fields Explanation

| Field | Type | Description |
|-------|------|-------------|
| transportation_id | INT | ID data transportation yang diminta revisi |
| revision_type | ENUM | Tipe revisi (request/approved/rejected) |
| requested_by | INT | User ID yang mengajukan |
| alasan_revisi | TEXT | Alasan mengapa perlu revisi |
| data_revisi | JSON | Snapshot data saat request dibuat |
| status | ENUM | Status review (pending/approved/rejected) |
| reviewed_by | INT | User ID reviewer |
| review_notes | TEXT | Catatan dari reviewer |
| reviewed_at | DATETIME | Waktu review |

## 📁 Files Created

### Models
- `app/Models/TransportationRevisionModel.php`

### Controllers
- Updated: `app/Controllers/TransportationController.php`
  - `requestRevision($id)`
  - `submitRevisionRequest($id)`
  - `revisionList()`
  - `reviewRevision($revisionId)`
  - `processRevisionReview($revisionId)`
  - `myRevisions()`

### Views
- `app/Views/kriteria/transportation/request_revision.php`
- `app/Views/kriteria/transportation/revision_list.php`
- `app/Views/kriteria/transportation/review_revision.php`
- `app/Views/kriteria/transportation/my_revisions.php`
- Updated: `app/Views/kriteria/transportation/index.php`

### Filters
- `app/Filters/ReviewerFilter.php`

### Migrations
- `app/Database/Migrations/2025-11-13-000002_CreateTransportationRevisionsTable.php`

### Config
- Updated: `app/Config/Filters.php`
- Updated: `app/Config/Routes.php`

## 🚀 Routes

### Revision Routes
```php
GET  /transportation/request-revision/:id
POST /transportation/submit-revision-request/:id
GET  /transportation/revisions
GET  /transportation/review-revision/:id
POST /transportation/process-revision-review/:id
GET  /transportation/my-revisions
```

## 🎯 Use Cases

### Use Case 1: User Request Revisi
**Scenario:** Data tahun 2024 sudah approved, tapi ada data baru yang perlu ditambahkan

**Steps:**
1. User login
2. Buka `/transportation`
3. Klik "Request Revisi" pada data tahun 2024
4. Isi alasan: "Ada data survei terbaru yang menunjukkan peningkatan penggunaan sepeda kampus dari 100 menjadi 150 unit"
5. Submit
6. Tunggu review dari admin/reviewer

### Use Case 2: Reviewer Approve Revisi
**Scenario:** Reviewer menyetujui permintaan revisi

**Steps:**
1. Reviewer login
2. Buka `/transportation/revisions`
3. Klik "Review" pada permintaan pending
4. Lihat alasan dan data
5. Pilih "Setujui Permintaan Revisi"
6. Isi catatan: "Data survei valid, silakan update"
7. Submit
8. Data transportation berubah status ke "Pending"
9. User dapat edit data

### Use Case 3: Admin Reject Revisi
**Scenario:** Admin menolak permintaan revisi

**Steps:**
1. Admin login
2. Buka `/transportation/revisions`
3. Klik "Review" pada permintaan pending
4. Lihat alasan dan data
5. Pilih "Tolak Permintaan Revisi"
6. Isi catatan: "Data survei belum terverifikasi, mohon lengkapi bukti pendukung terlebih dahulu"
7. Submit
8. Data transportation tetap "Approved"
9. User tidak dapat edit

## 🔐 Security

### Access Control
- Revision request: Semua user yang login
- Review revision: Hanya admin dan reviewer
- Edit approved data: Hanya setelah revision request disetujui

### Data Validation
- Alasan revisi minimal 10 karakter
- Hanya data approved yang dapat diminta revisi
- Hanya permintaan pending yang dapat direview

### Audit Trail
- Semua permintaan revisi tercatat
- Timestamp request dan review
- User ID requester dan reviewer
- Snapshot data saat request dibuat (JSON)

## 📊 Monitoring

### Dashboard Metrics (Future Enhancement)
- Total permintaan revisi
- Pending revisions count
- Average review time
- Approval rate

### Notifications (Future Enhancement)
- Email notification saat permintaan direview
- Dashboard notification untuk pending revisions
- Reminder untuk reviewer

## 🧪 Testing

### Test Scenarios

1. **Test Request Revision**
   - Login sebagai user
   - Request revisi pada data approved
   - Cek status permintaan di "Revisi Saya"

2. **Test Review Revision - Approve**
   - Login sebagai reviewer
   - Approve permintaan revisi
   - Cek status data transportation berubah ke pending
   - Login sebagai requester
   - Edit data yang sudah di-approve revisinya

3. **Test Review Revision - Reject**
   - Login sebagai admin
   - Reject permintaan revisi
   - Cek status data transportation tetap approved
   - Login sebagai requester
   - Coba edit data (harus gagal)

4. **Test Access Control**
   - Login sebagai user biasa
   - Coba akses `/transportation/revisions` (harus ditolak)
   - Login sebagai reviewer
   - Akses `/transportation/revisions` (harus berhasil)

## 💡 Best Practices

1. **Alasan Revisi yang Jelas**
   - Jelaskan secara spesifik apa yang perlu diubah
   - Sertakan referensi data baru jika ada
   - Minimal 10 karakter, ideal 50-200 karakter

2. **Review yang Cepat**
   - Reviewer sebaiknya review dalam 1-2 hari kerja
   - Berikan catatan yang konstruktif
   - Jika reject, jelaskan alasan dan langkah perbaikan

3. **Dokumentasi**
   - Simpan bukti pendukung untuk revisi
   - Catat perubahan yang dilakukan setelah revisi disetujui

## 🔮 Future Enhancements

1. **Email Notifications**
2. **Revision History Comparison**
3. **Bulk Revision Approval**
4. **Revision Templates**
5. **Auto-approval Rules**
6. **Revision Analytics Dashboard**
