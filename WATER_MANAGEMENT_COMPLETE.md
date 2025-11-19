# Water Management Module - Complete Implementation Guide

## 📋 Quick Implementation

Karena struktur sama dengan Energy Climate, cara tercepat adalah copy dan replace.

### Step 1: Copy Files

```bash
# Models
cp app/Models/EnergyClimateModel.php app/Models/WaterManagementModel.php
cp app/Models/EnergyClimateRevisionModel.php app/Models/WaterManagementRevisionModel.php

# Controller
cp app/Controllers/EnergyClimateController.php app/Controllers/WaterManagementController.php

# Views
cp -r app/Views/kriteria/energy_climate app/Views/kriteria/water_management

# Upload folder
mkdir writable/uploads/water_management
```

### Step 2: Find & Replace

Di semua file yang baru dicopy, lakukan Find & Replace:

| Find | Replace |
|------|---------|
| `energy_climate` | `water_management` |
| `EnergyClimate` | `WaterManagement` |
| `energy-climate` | `water-management` |
| `Energy & Climate Change` | `Water Management` |
| `Energi & Perubahan Iklim` | `Pengelolaan Air` |

### Step 3: Update Model Fields

**File:** `app/Models/WaterManagementModel.php`

Update `$allowedFields`:
```php
protected $allowedFields = [
    'tahun',
    'total_konsumsi_air',
    'air_daur_ulang',
    'persentase_air_daur_ulang',
    'konsumsi_air_per_orang',
    'program_konservasi_air',
    'sistem_daur_ulang_air',
    'teknologi_hemat_air',
    'program_edukasi_air',
    'capaian_persen',
    'keterangan',
    'status_verifikasi',
    'catatan_verifikasi',
    'bukti_pendukung',
    'verified_by',
    'verified_at',
    'created_by',
    'updated_by',
];
```

Update `calculatePercentages()`:
```php
protected function calculatePercentages(array $data)
{
    if (isset($data['data'])) {
        // Calculate persentase_air_daur_ulang
        if (isset($data['data']['total_konsumsi_air']) && isset($data['data']['air_daur_ulang'])) {
            $total = floatval($data['data']['total_konsumsi_air']);
            $daur_ulang = floatval($data['data']['air_daur_ulang']);
            
            if ($total > 0) {
                $data['data']['persentase_air_daur_ulang'] = round(($daur_ulang / $total) * 100, 2);
            } else {
                $data['data']['persentase_air_daur_ulang'] = 0;
            }
        }

        // Calculate capaian_persen
        $persentase = isset($data['data']['persentase_air_daur_ulang']) ? floatval($data['data']['persentase_air_daur_ulang']) : 0;
        $konservasi = isset($data['data']['program_konservasi_air']) ? intval($data['data']['program_konservasi_air']) : 0;
        $daur_ulang = isset($data['data']['sistem_daur_ulang_air']) ? intval($data['data']['sistem_daur_ulang_air']) : 0;
        $teknologi = isset($data['data']['teknologi_hemat_air']) ? intval($data['data']['teknologi_hemat_air']) : 0;
        $edukasi = isset($data['data']['program_edukasi_air']) ? intval($data['data']['program_edukasi_air']) : 0;

        $capaian = ($persentase * 0.4) + 
                   ($konservasi ? 20 : 0) + 
                   ($daur_ulang ? 20 : 0) + 
                   ($teknologi ? 10 : 0) + 
                   ($edukasi ? 10 : 0);

        $data['data']['capaian_persen'] = round($capaian, 2);
    }

    return $data;
}
```

### Step 4: Update Routes

**File:** `app/Config/Routes.php`

Add after energy-climate routes:
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
    
    // Revision Request Routes
    $routes->get('request-revision/(:num)', 'WaterManagementController::requestRevision/$1');
    $routes->post('submit-revision-request/(:num)', 'WaterManagementController::submitRevisionRequest/$1');
    $routes->get('revisions', 'WaterManagementController::revisionList');
    $routes->get('review-revision/(:num)', 'WaterManagementController::reviewRevision/$1');
    $routes->post('process-revision-review/(:num)', 'WaterManagementController::processRevisionReview/$1');
    $routes->get('my-revisions', 'WaterManagementController::myRevisions');
});
```

### Step 5: Update Dashboard Link

**File:** `app/Views/dashboard/index.php`

Find the menu item for "Pengelolaan Air" and update:
```php
<li class="nav-item">
    <a href="<?= base_url('water-management') ?>" class="nav-link">
        <i class="fas fa-tint"></i>
        <span>Pengelolaan Air</span>
    </a>
</li>
```

### Step 6: Run Migration

```bash
php spark migrate
```

### Step 7: Test

1. Buka `/water-management`
2. Test create data
3. Test verification
4. Test revision request

---

## ✅ Checklist

- [ ] Copy files
- [ ] Find & Replace
- [ ] Update Model fields
- [ ] Update calculation logic
- [ ] Add routes
- [ ] Update dashboard link
- [ ] Run migration
- [ ] Test CRUD
- [ ] Test verification
- [ ] Test revision

---

**Estimasi Waktu:** 1-2 jam  
**Kompleksitas:** Low-Medium  
**Status:** Ready to implement
