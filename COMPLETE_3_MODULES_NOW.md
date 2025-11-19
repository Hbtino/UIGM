# Complete 3 Modules Implementation - Quick Guide

## 🎯 Goal
Implement Water Management, Waste Management, dan Education & Research dalam waktu singkat.

## ✅ Yang Sudah Disiapkan

1. ✅ Migration Water Management (main table)
2. ✅ Migration Water Management (revisions table)
3. ✅ Upload folders untuk 3 modul
4. ✅ Dokumentasi lengkap

## 🚀 CARA TERCEPAT - Copy & Replace

### WATER MANAGEMENT

#### 1. Copy Files (PowerShell/CMD)
```powershell
# Models
Copy-Item app/Models/EnergyClimateModel.php app/Models/WaterManagementModel.php
Copy-Item app/Models/EnergyClimateRevisionModel.php app/Models/WaterManagementRevisionModel.php

# Controller
Copy-Item app/Controllers/EnergyClimateController.php app/Controllers/WaterManagementController.php

# Views
Copy-Item -Recurse app/Views/kriteria/energy_climate app/Views/kriteria/water_management
```

#### 2. Find & Replace di Semua File
Buka VS Code, tekan `Ctrl+Shift+H` (Find & Replace in Files):

| Find (Case Sensitive) | Replace With |
|-----------------------|--------------|
| `energy_climate` | `water_management` |
| `EnergyClimate` | `WaterManagement` |
| `energy-climate` | `water-management` |
| `Energy & Climate Change` | `Water Management` |

#### 3. Update Specific Files

**app/Models/WaterManagementModel.php** - Update `$allowedFields`:
```php
protected $allowedFields = [
    'tahun', 'total_konsumsi_air', 'air_daur_ulang', 
    'persentase_air_daur_ulang', 'konsumsi_air_per_orang',
    'program_konservasi_air', 'sistem_daur_ulang_air',
    'teknologi_hemat_air', 'program_edukasi_air',
    'capaian_persen', 'keterangan', 'status_verifikasi',
    'catatan_verifikasi', 'bukti_pendukung', 'verified_by',
    'verified_at', 'created_by', 'updated_by',
];
```

**app/Config/Routes.php** - Add routes (copy energy-climate section, replace names)

---

### WASTE MANAGEMENT

#### 1. Copy Files
```powershell
# Models
Copy-Item app/Models/EnergyClimateModel.php app/Models/WasteManagementModel.php
Copy-Item app/Models/EnergyClimateRevisionModel.php app/Models/WasteManagementRevisionModel.php

# Controller
Copy-Item app/Controllers/EnergyClimateController.php app/Controllers/WasteManagementController.php

# Views
Copy-Item -Recurse app/Views/kriteria/energy_climate app/Views/kriteria/waste_management
```

#### 2. Find & Replace
| Find | Replace |
|------|---------|
| `energy_climate` | `waste_management` |
| `EnergyClimate` | `WasteManagement` |
| `energy-climate` | `waste-management` |
| `Energy & Climate Change` | `Waste Management` |

#### 3. Update Fields
```php
protected $allowedFields = [
    'tahun', 'total_sampah', 'sampah_didaur_ulang',
    'persentase_daur_ulang', 'volume_limbah_per_orang',
    'program_3r', 'pengurangan_kertas_plastik',
    'pengolahan_organik', 'pengolahan_anorganik',
    'pengolahan_beracun', 'sistem_pembuangan',
    'capaian_persen', 'keterangan', 'status_verifikasi',
    'catatan_verifikasi', 'bukti_pendukung', 'verified_by',
    'verified_at', 'created_by', 'updated_by',
];
```

---

### EDUCATION & RESEARCH

#### 1. Copy Files
```powershell
# Models
Copy-Item app/Models/EnergyClimateModel.php app/Models/EducationResearchModel.php
Copy-Item app/Models/EnergyClimateRevisionModel.php app/Models/EducationResearchRevisionModel.php

# Controller
Copy-Item app/Controllers/EnergyClimateController.php app/Controllers/EducationResearchController.php

# Views
Copy-Item -Recurse app/Views/kriteria/energy_climate app/Views/kriteria/education_research
```

#### 2. Find & Replace
| Find | Replace |
|------|---------|
| `energy_climate` | `education_research` |
| `EnergyClimate` | `EducationResearch` |
| `energy-climate` | `education-research` |
| `Energy & Climate Change` | `Education & Research` |

#### 3. Update Fields
```php
protected $allowedFields = [
    'tahun', 'jumlah_mk_keberlanjutan', 'total_mk',
    'rasio_mk_keberlanjutan', 'pendanaan_penelitian_berkelanjutan',
    'total_pendanaan_penelitian', 'rasio_pendanaan',
    'jumlah_publikasi', 'jumlah_kegiatan_berkelanjutan',
    'kegiatan_mahasiswa', 'website_berkelanjutan',
    'laporan_berkelanjutan', 'kegiatan_budaya',
    'kerjasama_internasional', 'pengabdian_masyarakat',
    'startup_berkelanjutan', 'capaian_persen',
    'keterangan', 'status_verifikasi', 'catatan_verifikasi',
    'bukti_pendukung', 'verified_by', 'verified_at',
    'created_by', 'updated_by',
];
```

---

## 📝 MIGRATIONS

Buat migration files untuk Waste Management dan Education & Research:

### Waste Management Migrations

**File:** `app/Database/Migrations/2025-11-13-400000_CreateWasteManagementTable.php`

Copy dari Water Management migration, ganti:
- Table name: `waste_management`
- Fields sesuai modul

**File:** `app/Database/Migrations/2025-11-13-400001_CreateWasteManagementRevisionsTable.php`

Copy dari Water Management revisions, ganti table name.

### Education & Research Migrations

**File:** `app/Database/Migrations/2025-11-13-500000_CreateEducationResearchTable.php`

Copy dari Water Management migration, ganti:
- Table name: `education_research`
- Fields sesuai modul

**File:** `app/Database/Migrations/2025-11-13-500001_CreateEducationResearchRevisionsTable.php`

Copy dari Water Management revisions, ganti table name.

---

## 🔧 ROUTES

Add to `app/Config/Routes.php`:

```php
// WATER MANAGEMENT
$routes->group('water-management', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'WaterManagementController::index');
    $routes->get('create', 'WaterManagementController::create');
    $routes->post('store', 'WaterManagementController::store');
    $routes->get('edit/(:num)', 'WaterManagementController::edit/$1');
    $routes->post('update/(:num)', 'WaterManagementController::update/$1');
    $routes->get('delete/(:num)', 'WaterManagementController::delete/$1');
    $routes->get('verify/(:num)', 'WaterManagementController::verify/$1');
    $routes->post('process-verification/(:num)', 'WaterManagementController::processVerification/$1');
    $routes->get('download/(:num)', 'WaterManagementController::download/$1');
    $routes->get('request-revision/(:num)', 'WaterManagementController::requestRevision/$1');
    $routes->post('submit-revision-request/(:num)', 'WaterManagementController::submitRevisionRequest/$1');
    $routes->get('revisions', 'WaterManagementController::revisionList');
    $routes->get('review-revision/(:num)', 'WaterManagementController::reviewRevision/$1');
    $routes->post('process-revision-review/(:num)', 'WaterManagementController::processRevisionReview/$1');
    $routes->get('my-revisions', 'WaterManagementController::myRevisions');
});

// WASTE MANAGEMENT
$routes->group('waste-management', ['filter' => 'auth'], function($routes) {
    // Same structure as above, replace WaterManagement with WasteManagement
});

// EDUCATION & RESEARCH
$routes->group('education-research', ['filter' => 'auth'], function($routes) {
    // Same structure as above, replace WaterManagement with EducationResearch
});
```

---

## 🎨 DASHBOARD LINKS

Update `app/Views/dashboard/index.php`:

```php
<li class="nav-item">
    <a href="<?= base_url('water-management') ?>" class="nav-link">
        <i class="fas fa-tint"></i>
        <span>Pengelolaan Air</span>
    </a>
</li>
<li class="nav-item">
    <a href="<?= base_url('waste-management') ?>" class="nav-link">
        <i class="fas fa-recycle"></i>
        <span>Pengelolaan Limbah</span>
    </a>
</li>
<li class="nav-item">
    <a href="<?= base_url('education-research') ?>" class="nav-link">
        <i class="fas fa-graduation-cap"></i>
        <span>Pendidikan & Penelitian</span>
    </a>
</li>
```

---

## ⚡ QUICK COMMANDS

```bash
# Run all migrations
php spark migrate

# Check if tables created
php spark db:table water_management
php spark db:table waste_management
php spark db:table education_research
```

---

## ✅ TESTING CHECKLIST

### Per Module:
- [ ] Access URL (e.g., `/water-management`)
- [ ] Create data
- [ ] Upload file
- [ ] Auto-calculation works
- [ ] Edit data
- [ ] Verify data
- [ ] Request revision
- [ ] Review revision
- [ ] Download file
- [ ] Delete data

---

## ⏱️ ESTIMASI WAKTU

| Task | Time |
|------|------|
| Copy files (3 modules) | 15 min |
| Find & Replace | 30 min |
| Update fields & calculations | 45 min |
| Create migrations | 30 min |
| Add routes | 15 min |
| Update dashboard | 10 min |
| Run migrations & test | 30 min |
| **TOTAL** | **~3 hours** |

---

## 🚨 COMMON ISSUES

### Issue 1: "Table already exists"
**Solution:** Drop table first or skip migration

### Issue 2: "Class not found"
**Solution:** Check namespace and class name match

### Issue 3: "There is no data to update"
**Solution:** Check $allowedFields includes all fields

### Issue 4: Views not found
**Solution:** Check folder name matches controller

---

## 📞 NEED HELP?

1. Check Energy Climate module as reference
2. Verify file names and paths
3. Check error logs: `writable/logs/`
4. Test one module at a time

---

**Status:** Ready to implement  
**Priority:** HIGH  
**Deadline:** Complete today

**LET'S DO THIS! 🚀**
