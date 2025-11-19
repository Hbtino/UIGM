# Implementation Roadmap - UI GreenMetric CRUD Modules

## 📋 Overview

Berdasarkan kesuksesan implementasi **Transportation CRUD System**, dokumen ini merencanakan implementasi 5 modul lainnya dengan fitur yang sama.

### ✅ Completed Modules
1. **Transportation (TR)** - ✅ 100% Complete
2. **Setting & Infrastructure (SI)** - ✅ 100% Complete
3. **Energy & Climate Change (EC)** - ✅ 100% Complete

### 🎯 Remaining Modules
4. **Water Management (WR)** - 📋 Planned
5. **Waste Management (WS)** - 📋 Planned
6. **Education & Research (ED)** - 📋 Planned

---

## 🏗️ Template Architecture (Based on Transportation)

Setiap modul akan mengikuti struktur yang sama:

### Core Features (6 Features)
1. ✅ **Basic CRUD** - Create, Read, Update, Delete
2. ✅ **File Upload** - Upload & download bukti pendukung
3. ✅ **Auto-calculation** - Perhitungan otomatis
4. ✅ **Verification System** - Workflow verifikasi
5. ✅ **Reviewer Role** - Role-based verification
6. ✅ **Revision Request** - Sistem permintaan revisi

### Files Structure (Per Module)
```
Migrations: 2 files
Models: 2 files (Main + Revision)
Controllers: 1 file (10+ methods)
Filters: Reuse existing (Auth, Admin, Reviewer)
Views: 8 files (index, create, edit, verify, request_revision, etc.)
Documentation: Reuse template
```

---

## 🏫 Module 1: Setting & Infrastructure (SI)

### Priority: 🟩 HIGH
**Alasan:** Data dasar kampus, diperlukan untuk modul lain

### Specific Features

#### 1. Data Fields
```php
- tahun (UNIQUE)
- luas_ruang_terbuka
- luas_total
- persentase_area_hijau (auto-calculated)
- vegetasi_hutan
- area_tanaman
- area_resapan
- persentase_anggaran
- persentase_pemeliharaan
- fasilitas_disabilitas
- fasilitas_energi_terbarukan
- capaian_persen (auto-calculated)
```

#### 2. Auto-calculation Logic
```javascript
// Persentase Area Hijau
persentase_area_hijau = (luas_ruang_terbuka / luas_total) * 100

// Capaian Persen (weighted average)
capaian_persen = (
    persentase_area_hijau * 0.4 +
    persentase_anggaran * 0.3 +
    persentase_pemeliharaan * 0.3
)
```

#### 3. File Upload Types
- Peta kampus (PDF, JPG, PNG)
- Foto fasilitas (JPG, PNG)
- Sertifikat bangunan hijau (PDF)
- Laporan audit infrastruktur (PDF, XLSX)

#### 4. Validation Rules
- `luas_ruang_terbuka` ≤ `luas_total`
- `vegetasi_hutan` + `area_tanaman` + `area_resapan` ≤ `luas_ruang_terbuka`
- Persentase 0-100

#### 5. Implementation Estimate
- **Time:** 2-3 days
- **Complexity:** Medium
- **Dependencies:** None

---

## ⚡ Module 2: Energy & Climate Change (EC)

### Priority: 🟩 HIGH
**Alasan:** Data energi penting untuk sustainability metrics

### Specific Features

#### 1. Data Fields
```php
- tahun (UNIQUE)
- total_konsumsi_listrik (kWh)
- konsumsi_energi_terbarukan (kWh)
- persentase_energi_terbarukan (auto-calculated)
- peralatan_hemat_energi
- bangunan_cerdas
- jumlah_energi_terbarukan
- total_listrik_per_orang
- rasio_energi_terbarukan (auto-calculated)
- bangunan_ramah_lingkungan
- program_pengurangan_emisi
- jejak_karbon_per_orang
- program_inovatif_energi
- program_dampak_iklim
- capaian_persen (auto-calculated)
```

#### 2. Auto-calculation Logic
```javascript
// Persentase Energi Terbarukan
persentase_energi_terbarukan = (konsumsi_energi_terbarukan / total_konsumsi_listrik) * 100

// Rasio Energi Terbarukan per Orang
rasio_energi_terbarukan = konsumsi_energi_terbarukan / jumlah_populasi

// Capaian Persen
capaian_persen = (
    persentase_energi_terbarukan * 0.5 +
    (program_pengurangan_emisi ? 20 : 0) +
    (program_inovatif_energi ? 15 : 0) +
    (program_dampak_iklim ? 15 : 0)
)
```

#### 3. File Upload Types
- Bukti audit energi (PDF)
- Foto panel surya (JPG, PNG)
- Laporan konsumsi listrik (PDF, XLSX)
- Sertifikat bangunan hijau (PDF)

#### 4. Validation Rules
- `konsumsi_energi_terbarukan` ≤ `total_konsumsi_listrik`
- `total_konsumsi_listrik` > 0
- Persentase 0-100

#### 5. Implementation Estimate
- **Time:** 2-3 days
- **Complexity:** Medium
- **Dependencies:** None

---

## 💧 Module 3: Water Management (WR)

### Priority: 🟨 MEDIUM
**Alasan:** Data air penting tapi tidak blocking modul lain

### Specific Features

#### 1. Data Fields
```php
- tahun (UNIQUE)
- total_konsumsi_air (m³)
- air_daur_ulang (m³)
- persentase_air_daur_ulang (auto-calculated)
- konsumsi_air_per_orang (auto-calculated)
- program_konservasi_air
- sistem_daur_ulang_air
- teknologi_hemat_air
- program_edukasi_air
- capaian_persen (auto-calculated)
```

#### 2. Auto-calculation Logic
```javascript
// Persentase Air Daur Ulang
persentase_air_daur_ulang = (air_daur_ulang / total_konsumsi_air) * 100

// Konsumsi Air per Orang
konsumsi_air_per_orang = total_konsumsi_air / jumlah_populasi

// Capaian Persen
capaian_persen = (
    persentase_air_daur_ulang * 0.4 +
    (program_konservasi_air ? 20 : 0) +
    (sistem_daur_ulang_air ? 20 : 0) +
    (teknologi_hemat_air ? 10 : 0) +
    (program_edukasi_air ? 10 : 0)
)
```

#### 3. File Upload Types
- Bukti sistem daur ulang air (PDF, JPG)
- Laporan pemakaian air (PDF, XLSX)
- Foto instalasi air (JPG, PNG)

#### 4. Validation Rules
- `air_daur_ulang` ≤ `total_konsumsi_air`
- `total_konsumsi_air` > 0
- Persentase 0-100

#### 5. Implementation Estimate
- **Time:** 2 days
- **Complexity:** Low-Medium
- **Dependencies:** None

---

## 🔁 Module 4: Waste Management (WS)

### Priority: 🟨 MEDIUM
**Alasan:** Data limbah penting untuk sustainability

### Specific Features

#### 1. Data Fields
```php
- tahun (UNIQUE)
- total_sampah (kg)
- sampah_didaur_ulang (kg)
- persentase_daur_ulang (auto-calculated)
- volume_limbah_per_orang (auto-calculated)
- program_3r
- pengurangan_kertas_plastik
- pengolahan_organik
- pengolahan_anorganik
- pengolahan_beracun
- sistem_pembuangan
- capaian_persen (auto-calculated)
```

#### 2. Auto-calculation Logic
```javascript
// Persentase Daur Ulang
persentase_daur_ulang = (sampah_didaur_ulang / total_sampah) * 100

// Volume Limbah per Orang
volume_limbah_per_orang = total_sampah / jumlah_populasi

// Capaian Persen
capaian_persen = (
    persentase_daur_ulang * 0.4 +
    (program_3r ? 20 : 0) +
    (pengurangan_kertas_plastik ? 15 : 0) +
    (pengolahan_organik ? 10 : 0) +
    (pengolahan_anorganik ? 10 : 0) +
    (sistem_pembuangan ? 5 : 0)
)
```

#### 3. File Upload Types
- Foto fasilitas pengelolaan sampah (JPG, PNG)
- Laporan daur ulang (PDF, XLSX)
- Bukti program 3R (PDF)

#### 4. Validation Rules
- `sampah_didaur_ulang` ≤ `total_sampah`
- `total_sampah` > 0
- Persentase 0-100

#### 5. Implementation Estimate
- **Time:** 2 days
- **Complexity:** Low-Medium
- **Dependencies:** None

---

## 📚 Module 5: Education & Research (ED)

### Priority: 🟨 MEDIUM
**Alasan:** Data akademik, tidak blocking modul lain

### Specific Features

#### 1. Data Fields
```php
- tahun (UNIQUE)
- jumlah_mk_keberlanjutan
- total_mk
- rasio_mk_keberlanjutan (auto-calculated)
- pendanaan_penelitian_berkelanjutan
- total_pendanaan_penelitian
- rasio_pendanaan (auto-calculated)
- jumlah_publikasi
- jumlah_kegiatan_berkelanjutan
- kegiatan_mahasiswa
- website_berkelanjutan
- laporan_berkelanjutan
- kegiatan_budaya
- kerjasama_internasional
- pengabdian_masyarakat
- startup_berkelanjutan
- capaian_persen (auto-calculated)
```

#### 2. Auto-calculation Logic
```javascript
// Rasio MK Keberlanjutan
rasio_mk_keberlanjutan = (jumlah_mk_keberlanjutan / total_mk) * 100

// Rasio Pendanaan
rasio_pendanaan = (pendanaan_penelitian_berkelanjutan / total_pendanaan_penelitian) * 100

// Capaian Persen
capaian_persen = (
    rasio_mk_keberlanjutan * 0.3 +
    rasio_pendanaan * 0.3 +
    (jumlah_publikasi * 0.1) +
    (website_berkelanjutan ? 10 : 0) +
    (laporan_berkelanjutan ? 10 : 0) +
    (kerjasama_internasional ? 10 : 0)
)
```

#### 3. File Upload Types
- Bukti kurikulum (PDF)
- Publikasi penelitian (PDF)
- Laporan kegiatan mahasiswa (PDF, XLSX)
- Foto kegiatan (JPG, PNG)

#### 4. Validation Rules
- `jumlah_mk_keberlanjutan` ≤ `total_mk`
- `pendanaan_penelitian_berkelanjutan` ≤ `total_pendanaan_penelitian`
- Persentase 0-100

#### 5. Implementation Estimate
- **Time:** 2-3 days
- **Complexity:** Medium
- **Dependencies:** None

---

## 📅 Implementation Timeline

### Phase 1: Foundation (Week 1)
- ✅ Transportation Module - COMPLETE
- ✅ Documentation Template - COMPLETE
- ✅ Filters & Auth - COMPLETE

### Phase 2: High Priority (Week 2-3)
- ✅ Setting & Infrastructure (SI) - 3 days - COMPLETE
- ✅ Energy & Climate Change (EC) - 3 days - COMPLETE

### Phase 3: Medium Priority (Week 4-5)
- 🎯 Water Management (WR) - 2 days
- 🎯 Waste Management (WS) - 2 days
- 🎯 Education & Research (ED) - 3 days

### Phase 4: Integration & Testing (Week 6)
- Integration testing
- User acceptance testing
- Bug fixes
- Documentation updates

### Phase 5: Deployment (Week 7)
- Production deployment
- User training
- Go-live support

---

## 🔧 Reusable Components

### Already Created (Can be Reused)
1. ✅ **AuthFilter** - Authentication check
2. ✅ **AdminFilter** - Admin-only access
3. ✅ **ReviewerFilter** - Reviewer access
4. ✅ **View Templates** - Layout structure
5. ✅ **Documentation Templates** - All docs
6. ✅ **Migration Templates** - Table structure
7. ✅ **Model Templates** - Base model with validation
8. ✅ **Controller Templates** - CRUD + Verification + Revision

### Need to Create (Per Module)
1. 📝 Specific migration file
2. 📝 Specific model file
3. 📝 Specific controller file
4. 📝 Specific views (8 files)
5. 📝 Module-specific documentation

---

## 📊 Effort Estimation

### Per Module Breakdown

| Task | Time | Complexity |
|------|------|------------|
| Database Migration | 1 hour | Low |
| Model Creation | 2 hours | Low |
| Controller Implementation | 4 hours | Medium |
| Views Creation | 4 hours | Medium |
| Testing | 2 hours | Medium |
| Documentation | 1 hour | Low |
| **Total per Module** | **14 hours** | **~2 days** |

### Total Project Estimation

| Module | Days | Status |
|--------|------|--------|
| Transportation | 3 | ✅ Complete |
| Setting & Infrastructure | 3 | 📋 Planned |
| Energy & Climate | 3 | 📋 Planned |
| Water Management | 2 | 📋 Planned |
| Waste Management | 2 | 📋 Planned |
| Education & Research | 3 | 📋 Planned |
| Integration & Testing | 5 | 📋 Planned |
| **Total** | **21 days** | **~4 weeks** |

---

## 🎯 Success Criteria

### Per Module
- ✅ All CRUD operations working
- ✅ File upload/download functional
- ✅ Auto-calculation accurate
- ✅ Verification workflow complete
- ✅ Revision request working
- ✅ Role-based access enforced
- ✅ Documentation complete
- ✅ No critical bugs

### Overall Project
- ✅ All 6 modules implemented
- ✅ Consistent user experience
- ✅ Integrated dashboard
- ✅ Complete documentation
- ✅ User training completed
- ✅ Production deployment successful

---

## 🚀 Quick Start for Next Module

### Step-by-Step Guide

1. **Copy Transportation Files**
```bash
# Copy and rename files
cp TransportationController.php SettingInfrastructureController.php
cp TransportationModel.php SettingInfrastructureModel.php
# etc.
```

2. **Update Database Migration**
```php
// Change table name and fields
$this->forge->createTable('setting_infrastructure');
```

3. **Update Model**
```php
// Change table name and allowed fields
protected $table = 'setting_infrastructure';
protected $allowedFields = [...];
```

4. **Update Controller**
```php
// Change model reference
$this->model = new SettingInfrastructureModel();
```

5. **Update Views**
```php
// Change titles and field names
<h4>Setting & Infrastructure</h4>
```

6. **Add Routes**
```php
$routes->group('setting-infrastructure', ['filter' => 'auth'], function($routes) {
    // ... routes
});
```

7. **Test Everything**
```bash
php spark migrate
# Test CRUD, upload, verification, revision
```

---

## 📝 Checklist Template (Per Module)

### Development
- [ ] Migration created
- [ ] Model created with validation
- [ ] Controller created with all methods
- [ ] Views created (8 files)
- [ ] Routes added
- [ ] Auto-calculation implemented
- [ ] File upload configured

### Testing
- [ ] Create data tested
- [ ] Edit data tested
- [ ] Verify data tested
- [ ] Request revision tested
- [ ] Review revision tested
- [ ] File upload/download tested
- [ ] Role-based access tested
- [ ] Auto-calculation tested

### Documentation
- [ ] Module documentation created
- [ ] SQL helpers added
- [ ] User guide updated
- [ ] API documentation updated (if any)

### Deployment
- [ ] Migration run on production
- [ ] Files uploaded
- [ ] Permissions set
- [ ] Tested on production
- [ ] Users trained

---

## 🔗 Dependencies

### Module Dependencies
```
Transportation (TR) ──┐
                      ├──> Dashboard Integration
Setting & Infra (SI) ─┤
Energy & Climate (EC) ┤
Water (WR) ───────────┤
Waste (WS) ───────────┤
Education & Research (ED)
```

### Technical Dependencies
- PHP 8.1+
- CodeIgniter 4.x
- MySQL/MariaDB
- Composer
- Web server (Apache/Nginx)

---

## 📞 Support & Resources

### Documentation
- [Transportation Implementation](TRANSPORTATION_FEATURES.md) - Reference
- [System Architecture](SYSTEM_ARCHITECTURE.md) - Architecture guide
- [Deployment Checklist](DEPLOYMENT_CHECKLIST.md) - Deployment guide

### Code Templates
- `app/Controllers/TransportationController.php` - Controller template
- `app/Models/TransportationModel.php` - Model template
- `app/Views/kriteria/transportation/` - View templates

### Contact
- Development Team
- Project Manager
- System Administrator

---

**Status:** 📋 Planning Complete  
**Next Action:** Start Phase 2 - Setting & Infrastructure  
**Last Updated:** 2025-11-13

---

**🌱 UI GreenMetric CRUD System**  
**Politeknik Negeri Bandung**
