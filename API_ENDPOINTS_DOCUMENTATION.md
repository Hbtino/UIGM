# 🌐 API Endpoints Documentation

## 📋 Overview

Dokumentasi lengkap untuk semua endpoints dalam sistem UI GreenMetric CRUD.

**Base URL:** `http://yourdomain.com/`  
**Authentication:** Session-based  
**Response Format:** HTML views atau JSON (untuk AJAX)

---

## 🔐 Authentication Endpoints

### Login
```
POST /login
```

**Parameters:**
- `email` (string, required) - User email
- `password` (string, required) - User password

**Response:**
- Success: Redirect to dashboard
- Error: Redirect back with error message

---

### Logout
```
GET /logout
```

**Response:**
- Redirect to login page

---

## 🚗 Transportation Module

### List Data
```
GET /transportation
```

**Query Parameters:**
- `page` (int, optional) - Page number
- `search` (string, optional) - Search keyword

**Response:** HTML view with data list

---

### Create Form
```
GET /transportation/create
```

**Response:** HTML form

---

### Store Data
```
POST /transportation/store
```

**Parameters:**
- `tahun` (int, required) - Year
- `total_perjalanan` (decimal, required) - Total trips
- `perjalanan_ramah_lingkungan` (decimal, required) - Eco-friendly trips
- `keterangan` (text, optional) - Notes
- `bukti_pendukung` (file, required) - Supporting document

**Validation:**
- `tahun`: unique, 4 digits
- `total_perjalanan`: > 0
- `perjalanan_ramah_lingkungan`: ≤ total_perjalanan
- File: PDF/JPG/PNG/XLSX/XLS, max 2MB

**Response:**
- Success: Redirect to list with success message
- Error: Redirect back with validation errors

---

### Edit Form
```
GET /transportation/edit/{id}
```

**Parameters:**
- `id` (int, required) - Data ID

**Authorization:**
- Admin: Can edit all
- Kaprodi: Can edit own data with status pending
- Others: Forbidden

**Response:** HTML form with data

---

### Update Data
```
POST /transportation/update/{id}
```

**Parameters:** Same as store
- `bukti_pendukung` (file, optional) - New file if updating

**Response:**
- Success: Redirect to list
- Error: Redirect back with errors

---

### Delete Data
```
POST /transportation/delete/{id}
```

**Authorization:** Admin only

**Response:**
- Success: Redirect with success message
- Error: Redirect with error message

---

### Verify Form
```
GET /transportation/verify/{id}
```

**Authorization:** Admin or Reviewer

**Response:** HTML verification form

---

### Process Verification
```
POST /transportation/processVerification/{id}
```

**Parameters:**
- `status_verifikasi` (enum, required) - approved/rejected
- `catatan_verifikasi` (text, optional) - Verification notes

**Authorization:** Admin or Reviewer

**Response:**
- Success: Redirect to list
- Error: Redirect back with error

---

### Download File
```
GET /transportation/download/{id}
```

**Authorization:** Authenticated users

**Response:** File download

---

### Request Revision Form
```
GET /transportation/requestRevision/{id}
```

**Authorization:** Data owner

**Response:** HTML revision request form

---

### Submit Revision Request
```
POST /transportation/submitRevisionRequest/{id}
```

**Parameters:**
- `reason` (text, required) - Revision reason

**Response:**
- Success: Redirect with success message
- Error: Redirect back with error

---

### Revision List
```
GET /transportation/revisionList
```

**Authorization:** Admin or Reviewer

**Response:** HTML list of revision requests

---

### Review Revision Form
```
GET /transportation/reviewRevision/{revisionId}
```

**Authorization:** Admin or Reviewer

**Response:** HTML review form

---

### Process Revision Review
```
POST /transportation/processRevisionReview/{revisionId}
```

**Parameters:**
- `status` (enum, required) - approved/rejected
- `review_notes` (text, optional) - Review notes

**Response:**
- Success: Redirect to revision list
- Error: Redirect back with error

---

### My Revisions
```
GET /transportation/myRevisions
```

**Authorization:** Authenticated users

**Response:** HTML list of user's revision requests

---

## 🏢 Setting & Infrastructure Module

All endpoints follow the same pattern as Transportation:

```
GET  /setting-infrastructure
GET  /setting-infrastructure/create
POST /setting-infrastructure/store
GET  /setting-infrastructure/edit/{id}
POST /setting-infrastructure/update/{id}
POST /setting-infrastructure/delete/{id}
GET  /setting-infrastructure/verify/{id}
POST /setting-infrastructure/processVerification/{id}
GET  /setting-infrastructure/download/{id}
GET  /setting-infrastructure/requestRevision/{id}
POST /setting-infrastructure/submitRevisionRequest/{id}
GET  /setting-infrastructure/revisionList
GET  /setting-infrastructure/reviewRevision/{revisionId}
POST /setting-infrastructure/processRevisionReview/{revisionId}
GET  /setting-infrastructure/myRevisions
```

**Additional Parameters for Store/Update:**
- `luas_ruang_terbuka` (decimal, required)
- `luas_total` (decimal, required)
- `vegetasi_hutan` (decimal, required)
- `area_tanaman` (decimal, required)
- `area_resapan` (decimal, required)
- `persentase_anggaran` (decimal, required)
- `persentase_pemeliharaan` (decimal, required)
- `fasilitas_disabilitas` (boolean, optional)
- `fasilitas_energi_terbarukan` (boolean, optional)

---

## ⚡ Energy & Climate Change Module

```
GET  /energy-climate
GET  /energy-climate/create
POST /energy-climate/store
GET  /energy-climate/edit/{id}
POST /energy-climate/update/{id}
POST /energy-climate/delete/{id}
GET  /energy-climate/verify/{id}
POST /energy-climate/processVerification/{id}
GET  /energy-climate/download/{id}
GET  /energy-climate/requestRevision/{id}
POST /energy-climate/submitRevisionRequest/{id}
GET  /energy-climate/revisionList
GET  /energy-climate/reviewRevision/{revisionId}
POST /energy-climate/processRevisionReview/{revisionId}
GET  /energy-climate/myRevisions
```

**Additional Parameters:**
- `total_konsumsi_listrik` (decimal, required)
- `konsumsi_energi_terbarukan` (decimal, required)
- `peralatan_hemat_energi` (int, required)
- `bangunan_cerdas` (int, required)
- `jumlah_energi_terbarukan` (int, required)
- `total_listrik_per_orang` (decimal, required)
- `bangunan_ramah_lingkungan` (int, required)
- `program_pengurangan_emisi` (boolean, optional)
- `jejak_karbon_per_orang` (decimal, required)
- `program_inovatif_energi` (boolean, optional)
- `program_dampak_iklim` (boolean, optional)

---

## 💧 Water Management Module

```
GET  /water-management
GET  /water-management/create
POST /water-management/store
GET  /water-management/edit/{id}
POST /water-management/update/{id}
POST /water-management/delete/{id}
GET  /water-management/verify/{id}
POST /water-management/processVerification/{id}
GET  /water-management/download/{id}
GET  /water-management/requestRevision/{id}
POST /water-management/submitRevisionRequest/{id}
GET  /water-management/revisionList
GET  /water-management/reviewRevision/{revisionId}
POST /water-management/processRevisionReview/{revisionId}
GET  /water-management/myRevisions
```

**Additional Parameters:**
- `total_konsumsi_air` (decimal, required)
- `air_daur_ulang` (decimal, required)
- `program_konservasi_air` (boolean, optional)
- `sistem_daur_ulang_air` (boolean, optional)
- `teknologi_hemat_air` (boolean, optional)
- `program_edukasi_air` (boolean, optional)

---

## ♻️ Waste Management Module

```
GET  /waste-management
GET  /waste-management/create
POST /waste-management/store
GET  /waste-management/edit/{id}
POST /waste-management/update/{id}
POST /waste-management/delete/{id}
GET  /waste-management/verify/{id}
POST /waste-management/processVerification/{id}
GET  /waste-management/download/{id}
GET  /waste-management/requestRevision/{id}
POST /waste-management/submitRevisionRequest/{id}
GET  /waste-management/revisionList
GET  /waste-management/reviewRevision/{revisionId}
POST /waste-management/processRevisionReview/{revisionId}
GET  /waste-management/myRevisions
```

**Additional Parameters:**
- `total_sampah` (decimal, required)
- `sampah_didaur_ulang` (decimal, required)
- `program_3r` (boolean, optional)
- `pengurangan_kertas_plastik` (boolean, optional)
- `pengolahan_organik` (boolean, optional)
- `pengolahan_anorganik` (boolean, optional)
- `pengolahan_beracun` (boolean, optional)
- `sistem_pembuangan` (boolean, optional)

---

## 🎓 Education & Research Module

```
GET  /education-research
GET  /education-research/create
POST /education-research/store
GET  /education-research/edit/{id}
POST /education-research/update/{id}
POST /education-research/delete/{id}
GET  /education-research/verify/{id}
POST /education-research/processVerification/{id}
GET  /education-research/download/{id}
GET  /education-research/requestRevision/{id}
POST /education-research/submitRevisionRequest/{id}
GET  /education-research/revisionList
GET  /education-research/reviewRevision/{revisionId}
POST /education-research/processRevisionReview/{revisionId}
GET  /education-research/myRevisions
```

**Additional Parameters:**
- `jumlah_mk_keberlanjutan` (int, required)
- `total_mk` (int, required)
- `pendanaan_penelitian_berkelanjutan` (decimal, required)
- `total_pendanaan_penelitian` (decimal, required)
- `jumlah_publikasi` (int, required)
- `jumlah_kegiatan_berkelanjutan` (int, required)
- `kegiatan_mahasiswa` (boolean, optional)
- `website_berkelanjutan` (boolean, optional)
- `laporan_berkelanjutan` (boolean, optional)
- `kegiatan_budaya` (boolean, optional)
- `kerjasama_internasional` (boolean, optional)
- `pengabdian_masyarakat` (boolean, optional)
- `startup_berkelanjutan` (boolean, optional)

---

## 🔒 Authorization Matrix

| Endpoint | Admin | Reviewer | Kaprodi | User |
|----------|-------|----------|---------|------|
| List | ✅ | ✅ | ✅ | ✅ |
| Create | ✅ | ❌ | ✅ | ❌ |
| Edit Own | ✅ | ❌ | ✅ (pending) | ❌ |
| Edit All | ✅ | ❌ | ❌ | ❌ |
| Delete | ✅ | ❌ | ❌ | ❌ |
| Verify | ✅ | ✅ | ❌ | ❌ |
| Download | ✅ | ✅ | ✅ | ✅ |
| Request Revision | ✅ | ❌ | ✅ (own) | ❌ |
| Review Revision | ✅ | ✅ | ❌ | ❌ |

---

## 📝 Response Codes

### Success Responses
- `200 OK` - Request successful
- `302 Found` - Redirect after successful operation

### Error Responses
- `400 Bad Request` - Validation error
- `401 Unauthorized` - Not authenticated
- `403 Forbidden` - Not authorized
- `404 Not Found` - Resource not found
- `500 Internal Server Error` - Server error

---

## 🔄 Common Response Patterns

### Success Message
```php
session()->setFlashdata('success', 'Data berhasil disimpan');
return redirect()->to('/module');
```

### Error Message
```php
session()->setFlashdata('error', 'Terjadi kesalahan');
return redirect()->back()->withInput();
```

### Validation Errors
```php
return redirect()->back()
    ->withInput()
    ->with('errors', $this->validator->getErrors());
```

---

## 🧪 Testing Examples

### cURL Examples

**Login:**
```bash
curl -X POST http://localhost/login \
  -d "email=admin@polban.ac.id" \
  -d "password=admin123" \
  -c cookies.txt
```

**Create Data:**
```bash
curl -X POST http://localhost/transportation/store \
  -b cookies.txt \
  -F "tahun=2024" \
  -F "total_perjalanan=1000" \
  -F "perjalanan_ramah_lingkungan=750" \
  -F "bukti_pendukung=@document.pdf"
```

**Verify Data:**
```bash
curl -X POST http://localhost/transportation/processVerification/1 \
  -b cookies.txt \
  -d "status_verifikasi=approved" \
  -d "catatan_verifikasi=Data valid"
```

---

## 📊 Rate Limiting

Currently no rate limiting implemented. Consider adding for production:

```php
// In Filter
if ($requests > 100) {
    return Services::response()
        ->setStatusCode(429)
        ->setBody('Too many requests');
}
```

---

## 🔐 Security Headers

Recommended security headers:

```php
// In BaseController
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');
```

---

**Last Updated:** 2025-11-14  
**Version:** 1.0.0
