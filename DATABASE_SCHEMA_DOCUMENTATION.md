# 🗄️ Database Schema Documentation

## 📊 Database Overview

**Database Name:** `capaian_kinerja`  
**Engine:** InnoDB  
**Charset:** utf8mb4  
**Collation:** utf8mb4_general_ci  
**Total Tables:** 15 tables

---

## 📋 Table Categories

### 1. System Tables (3 tables)
- `users` - User management
- `activities` - Activity logging
- `performance` - Performance metrics

### 2. Main Data Tables (6 tables)
- `transportation` - Transportation data
- `setting_infrastructure` - Setting & Infrastructure data
- `energy_climate` - Energy & Climate Change data
- `water_management` - Water Management data
- `waste_management` - Waste Management data
- `education_research` - Education & Research data

### 3. Revision Tables (6 tables)
- `transportation_revisions`
- `setting_infrastructure_revisions`
- `energy_climate_revisions`
- `water_management_revisions`
- `waste_management_revisions`
- `education_research_revisions`

---

## 👥 System Tables

### users
```sql
CREATE TABLE `users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','reviewer','kaprodi','user') NOT NULL DEFAULT 'user',
  `approval_status` ENUM('pending','approved','rejected') DEFAULT 'pending',
  `approved_by` INT(11) UNSIGNED NULL,
  `approved_at` DATETIME NULL,
  `rejection_reason` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `role` (`role`),
  KEY `approval_status` (`approval_status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

**Purpose:** User management dengan approval system  
**Key Features:**
- Role-based access control
- User approval workflow
- Password hashing
- Audit trail

---

## 🚗 Main Data Tables

### transportation
```sql
CREATE TABLE `transportation` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tahun` INT(4) NOT NULL UNIQUE,
  `total_perjalanan` DECIMAL(15,2) NOT NULL,
  `perjalanan_ramah_lingkungan` DECIMAL(15,2) NOT NULL,
  `capaian_persen` DECIMAL(5,2) NOT NULL,
  `keterangan` TEXT NULL,
  `status_verifikasi` ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_verifikasi` TEXT NULL,
  `bukti_pendukung` VARCHAR(255) NULL,
  `verified_by` INT(11) UNSIGNED NULL,
  `verified_at` DATETIME NULL,
  `created_by` INT(11) UNSIGNED NOT NULL,
  `updated_by` INT(11) UNSIGNED NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tahun` (`tahun`),
  KEY `status_verifikasi` (`status_verifikasi`),
  KEY `created_by` (`created_by`),
  KEY `verified_by` (`verified_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### setting_infrastructure
```sql
CREATE TABLE `setting_infrastructure` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tahun` INT(4) NOT NULL UNIQUE,
  `luas_ruang_terbuka` DECIMAL(15,2) NOT NULL,
  `luas_total` DECIMAL(15,2) NOT NULL,
  `persentase_area_hijau` DECIMAL(5,2) NOT NULL,
  `vegetasi_hutan` DECIMAL(15,2) NOT NULL,
  `area_tanaman` DECIMAL(15,2) NOT NULL,
  `area_resapan` DECIMAL(15,2) NOT NULL,
  `persentase_anggaran` DECIMAL(5,2) NOT NULL,
  `persentase_pemeliharaan` DECIMAL(5,2) NOT NULL,
  `fasilitas_disabilitas` TINYINT(1) NOT NULL DEFAULT 0,
  `fasilitas_energi_terbarukan` TINYINT(1) NOT NULL DEFAULT 0,
  `capaian_persen` DECIMAL(5,2) NOT NULL,
  `keterangan` TEXT NULL,
  `status_verifikasi` ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `catatan_verifikasi` TEXT NULL,
  `bukti_pendukung` VARCHAR(255) NULL,
  `verified_by` INT(11) UNSIGNED NULL,
  `verified_at` DATETIME NULL,
  `created_by` INT(11) UNSIGNED NOT NULL,
  `updated_by` INT(11) UNSIGNED NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tahun` (`tahun`),
  KEY `status_verifikasi` (`status_verifikasi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 🔄 Revision Tables Pattern

All revision tables follow this pattern:

```sql
CREATE TABLE `{module}_revisions` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_id` INT(11) UNSIGNED NOT NULL,
  `requested_by` INT(11) UNSIGNED NOT NULL,
  `reason` TEXT NOT NULL,
  `status` ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `reviewed_by` INT(11) UNSIGNED NULL,
  `review_notes` TEXT NULL,
  `reviewed_at` DATETIME NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`),
  KEY `data_id` (`data_id`),
  KEY `requested_by` (`requested_by`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 📊 Database Relationships

### User Relationships
- `users.id` → `{module}.created_by`
- `users.id` → `{module}.updated_by`
- `users.id` → `{module}.verified_by`
- `users.id` → `{module}_revisions.requested_by`
- `users.id` → `{module}_revisions.reviewed_by`

### Data-Revision Relationships
- `{module}.id` → `{module}_revisions.data_id`

---

## 🔍 Common Queries

### Get all pending data
```sql
SELECT * FROM {module} 
WHERE status_verifikasi = 'pending' 
ORDER BY created_at DESC;
```

### Get user's data
```sql
SELECT * FROM {module} 
WHERE created_by = ? 
ORDER BY tahun DESC;
```

### Get approved data with verifier info
```sql
SELECT m.*, u.name as verifier_name 
FROM {module} m
LEFT JOIN users u ON m.verified_by = u.id
WHERE m.status_verifikasi = 'approved'
ORDER BY m.tahun DESC;
```

### Get pending revision requests
```sql
SELECT r.*, m.tahun, u.name as requester_name
FROM {module}_revisions r
JOIN {module} m ON r.data_id = m.id
JOIN users u ON r.requested_by = u.id
WHERE r.status = 'pending'
ORDER BY r.created_at DESC;
```

---

## 🔐 Indexes

### Performance Indexes
- `tahun` - UNIQUE for data integrity
- `status_verifikasi` - Fast filtering
- `created_by` - User data queries
- `verified_by` - Verifier queries
- `created_at` - Chronological sorting

### Composite Indexes (if needed)
```sql
CREATE INDEX idx_status_year ON {module} (status_verifikasi, tahun);
CREATE INDEX idx_user_status ON {module} (created_by, status_verifikasi);
```

---

## 💾 Storage Estimates

### Per Module (1000 records)
- Main table: ~500KB
- Revision table: ~200KB
- Files (avg 500KB): ~500MB

### Total System (6 modules, 1000 records each)
- Database: ~5MB
- Files: ~3GB
- Total: ~3.005GB

---

## 🔧 Maintenance

### Regular Tasks
```sql
-- Optimize tables
OPTIMIZE TABLE transportation, setting_infrastructure, 
  energy_climate, water_management, waste_management, education_research;

-- Check table status
SHOW TABLE STATUS WHERE Name LIKE '%transportation%';

-- Analyze tables
ANALYZE TABLE transportation, setting_infrastructure;
```

### Backup Strategy
```bash
# Daily backup
mysqldump -u root -p capaian_kinerja > backup_$(date +%Y%m%d).sql

# Backup with compression
mysqldump -u root -p capaian_kinerja | gzip > backup_$(date +%Y%m%d).sql.gz
```

---

**Last Updated:** 2025-11-14  
**Version:** 1.0.0
