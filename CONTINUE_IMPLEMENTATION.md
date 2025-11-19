# Lanjutan Implementasi Modul SDGs

## ✅ Yang Sudah Selesai

### Modul Complete (3/6):
1. ✅ **Transportation (TR)** - 100% Complete
2. ✅ **Setting & Infrastructure (SI)** - 100% Complete  
3. ✅ **Energy & Climate Change (EC)** - 100% Complete

### Perbaikan Sistem:
- ✅ Bell notification untuk pending approvals
- ✅ Admin bypass approval check
- ✅ Fix "There is no data to update" error
- ✅ Tombol "Kembali ke Dashboard" ditambahkan

---

## 🎯 Yang Perlu Dikerjakan

### Modul Belum Selesai (3/6):
4. 📋 **Water Management (WR)** - 0% (Migration created)
5. 📋 **Waste Management (WS)** - 0%
6. 📋 **Education & Research (ED)** - 0%

---

## 🚀 Cara Melanjutkan Implementasi

### Opsi 1: Copy dari Energy Climate (RECOMMENDED)

Karena struktur semua modul sama, cara tercepat adalah copy dari Energy Climate:

#### Step 1: Copy Migration
```bash
# Water Management
cp app/Database/Migrations/*EnergyClimate*.php app/Database/Migrations/2025-11-13-300001_CreateWaterManagementRevisionsTable.php

# Edit file, ganti:
# - energy_climate → water_management
# - EnergyClimate → WaterManagement
```

#### Step 2: Copy Models
```bash
# Copy dan rename
cp app/Models/EnergyClimateModel.php app/Models/WaterManagementModel.php
cp app/Models/EnergyClimateRevisionModel.php app/Models/WaterManagementRevisionModel.php

# Edit file, ganti:
# - EnergyClimate → WaterManagement
# - energy_climate → water_management
# - Update $allowedFields sesuai field modul
```

#### Step 3: Copy Controller
```bash
cp app/Controllers/EnergyClimateController.php app/Controllers/WaterManagementController.php

# Edit file, ganti:
# - EnergyClimate → WaterManagement
# - energy-climate → water-management
# - Update auto-calculation logic
```

#### Step 4: Copy Views
```bash
# Copy folder
cp -r app/Views/kriteria/energy_climate app/Views/kriteria/water_management

# Edit semua file, ganti:
# - Energy & Climate Change → Water Management
# - energy-climate → water-management
# - Field names sesuai modul
```

#### Step 5: Add Routes
Edit `app/Config/Routes.php`, copy section energy-climate dan ganti ke water-management.

#### Step 6: Create Upload Folder
```bash
mkdir writable/uploads/water_management
```

#### Step 7: Update Dashboard Link
Edit `app/Views/dashboard/index.php`, update link menu "Pengelolaan Air" ke `/water-management`.

---

### Opsi 2: Generate Otomatis (Jika Ada Tool)

Jika Anda punya script generator, bisa generate dengan template:

```bash
php spark make:module WaterManagement --template=energy_climate
```

---

## 📋 Checklist Per Modul

### Water Management (WR)
- [x] Migration main table created
- [ ] Migration revisions table
- [ ] Model main
- [ ] Model revisions
- [ ] Controller (16 methods)
- [ ] Views (8 files)
- [ ] Routes (16 routes)
- [ ] Upload folder
- [ ] Dashboard link
- [ ] Testing

### Waste Management (WS)
- [ ] Migration main table
- [ ] Migration revisions table
- [ ] Model main
- [ ] Model revisions
- [ ] Controller (16 methods)
- [ ] Views (8 files)
- [ ] Routes (16 routes)
- [ ] Upload folder
- [ ] Dashboard link
- [ ] Testing

### Education & Research (ED)
- [ ] Migration main table
- [ ] Migration revisions table
- [ ] Model main
- [ ] Model revisions
- [ ] Controller (16 methods)
- [ ] Views (8 files)
- [ ] Routes (16 routes)
- [ ] Upload folder
- [ ] Dashboard link
- [ ] Testing

---

## 🔢 Data Fields Per Modul

### Water Management (WR)
```php
- tahun (UNIQUE)
- total_konsumsi_air (m³)
- air_daur_ulang (m³)
- persentase_air_daur_ulang (auto-calc)
- konsumsi_air_per_orang (auto-calc)
- program_konservasi_air (boolean)
- sistem_daur_ulang_air (boolean)
- teknologi_hemat_air (boolean)
- program_edukasi_air (boolean)
- capaian_persen (auto-calc)
```

**Auto-calculation:**
```javascript
persentase_air_daur_ulang = (air_daur_ulang / total_konsumsi_air) * 100
konsumsi_air_per_orang = total_konsumsi_air / jumlah_populasi
capaian_persen = (persentase * 0.4) + (konservasi ? 20 : 0) + 
                 (daur_ulang ? 20 : 0) + (teknologi ? 10 : 0) + 
                 (edukasi ? 10 : 0)
```

### Waste Management (WS)
```php
- tahun (UNIQUE)
- total_sampah (kg)
- sampah_didaur_ulang (kg)
- persentase_daur_ulang (auto-calc)
- volume_limbah_per_orang (auto-calc)
- program_3r (boolean)
- pengurangan_kertas_plastik (boolean)
- pengolahan_organik (boolean)
- pengolahan_anorganik (boolean)
- pengolahan_beracun (boolean)
- sistem_pembuangan (boolean)
- capaian_persen (auto-calc)
```

**Auto-calculation:**
```javascript
persentase_daur_ulang = (sampah_didaur_ulang / total_sampah) * 100
volume_limbah_per_orang = total_sampah / jumlah_populasi
capaian_persen = (persentase * 0.4) + (3r ? 20 : 0) + 
                 (pengurangan ? 15 : 0) + (organik ? 10 : 0) + 
                 (anorganik ? 10 : 0) + (pembuangan ? 5 : 0)
```

### Education & Research (ED)
```php
- tahun (UNIQUE)
- jumlah_mk_keberlanjutan
- total_mk
- rasio_mk_keberlanjutan (auto-calc)
- pendanaan_penelitian_berkelanjutan
- total_pendanaan_penelitian
- rasio_pendanaan (auto-calc)
- jumlah_publikasi
- jumlah_kegiatan_berkelanjutan
- kegiatan_mahasiswa (boolean)
- website_berkelanjutan (boolean)
- laporan_berkelanjutan (boolean)
- kegiatan_budaya (boolean)
- kerjasama_internasional (boolean)
- pengabdian_masyarakat (boolean)
- startup_berkelanjutan (boolean)
- capaian_persen (auto-calc)
```

**Auto-calculation:**
```javascript
rasio_mk = (mk_berkelanjutan / total_mk) * 100
rasio_pendanaan = (pendanaan_berkelanjutan / total_pendanaan) * 100
capaian_persen = (rasio_mk * 0.3) + (rasio_pendanaan * 0.3) + 
                 (publikasi * 0.1) + (website ? 10 : 0) + 
                 (laporan ? 10 : 0) + (kerjasama ? 10 : 0)
```

---

## ⏱️ Estimasi Waktu

| Modul | Waktu | Kompleksitas |
|-------|-------|--------------|
| Water Management | 2 hari | Low-Medium |
| Waste Management | 2 hari | Low-Medium |
| Education & Research | 3 hari | Medium |
| **Total** | **7 hari** | **~1.5 minggu** |

---

## 💡 Tips Implementasi Cepat

### 1. Gunakan Find & Replace
Buka semua file Energy Climate di editor, lalu:
- Find: `energy_climate` → Replace: `water_management`
- Find: `EnergyClimate` → Replace: `WaterManagement`
- Find: `Energy & Climate Change` → Replace: `Water Management`

### 2. Update Field Names
Setelah copy, update field names di:
- Migration
- Model ($allowedFields)
- Controller (store, update methods)
- Views (form fields)

### 3. Update Auto-calculation
Edit method `calculatePercentages()` di Model sesuai formula modul.

### 4. Test Incremental
Setelah selesai 1 modul, test dulu sebelum lanjut ke modul berikutnya:
- Run migration
- Test CRUD
- Test verification
- Test revision

---

## 🎯 Priority Order

Saran urutan implementasi:

1. **Water Management** (Paling simple)
   - Field paling sedikit
   - Logic paling sederhana
   - Good for practice

2. **Waste Management** (Medium)
   - Mirip dengan Water
   - Sedikit lebih kompleks

3. **Education & Research** (Paling kompleks)
   - Field paling banyak
   - Logic paling rumit
   - Terakhir karena paling challenging

---

## 📞 Need Help?

Jika butuh bantuan implementasi:
1. Lihat dokumentasi modul yang sudah selesai
2. Copy struktur dari Energy Climate
3. Sesuaikan field dan logic
4. Test setiap step

---

**Status:** 🟡 In Progress (50% Complete)  
**Next:** Water Management Implementation  
**Target:** Complete all 6 modules

