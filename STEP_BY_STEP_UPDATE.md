# 🎯 UPDATE DATABASE STEP BY STEP

## ⚠️ PENTING: Jalankan Satu Per Satu!

Karena ada error dengan query kompleks, jalankan SQL ini **SATU PER SATU**.

---

## STEP 1: Tambah Kolom menu_type

**Jalankan SQL ini:**
```sql
ALTER TABLE `menus` 
ADD COLUMN `menu_type` VARCHAR(50) DEFAULT 'dashboard' 
COMMENT 'dashboard atau landing' 
AFTER `roles`;
```

**Jika error "Duplicate column"**: Skip ke STEP 2 (kolom sudah ada)

---

## STEP 2: Update Menu Existing

**Jalankan SQL ini:**
```sql
UPDATE `menus` 
SET `menu_type` = 'dashboard' 
WHERE `menu_type` IS NULL OR `menu_type` = '';
```

**Hasil**: Semua menu existing jadi type 'dashboard'

---

## STEP 3: Update Menu "Manajemen Menu"

**Jalankan SQL ini:**
```sql
UPDATE `menus` 
SET `title` = 'CMS Management', `url` = '/cms/menus'
WHERE `id` = 10;
```

**Hasil**: Menu "Manajemen Menu" jadi "CMS Management"

---

## STEP 4: Tambah Menu "Manajemen Berita"

**Jalankan SQL ini:**
```sql
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Manajemen Berita', '/cms/news', 'fas fa-newspaper', 11, 1, '["admin"]', 'dashboard', NOW());
```

**Jika error "Duplicate entry"**: Menu sudah ada, skip

---

## STEP 5: Tambah Menu "Manajemen Konten"

**Jalankan SQL ini:**
```sql
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Manajemen Konten', '/cms/contents', 'fas fa-file-alt', 12, 1, '["admin"]', 'dashboard', NOW());
```

**Jika error "Duplicate entry"**: Menu sudah ada, skip

---

## STEP 6: Tambah Menu Landing "Deskripsi"

**Jalankan SQL ini:**
```sql
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Deskripsi', '#deskripsi', NULL, 101, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());
```

---

## STEP 7: Tambah Menu Landing "Program"

**Jalankan SQL ini:**
```sql
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Program', '#program', NULL, 102, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());
```

---

## STEP 8: Tambah Menu Landing "Berita"

**Jalankan SQL ini:**
```sql
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Berita', '#berita', NULL, 103, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());
```

---

## STEP 9: Tambah Menu Landing "Kontak"

**Jalankan SQL ini:**
```sql
INSERT INTO `menus` (`parent_id`, `title`, `url`, `icon`, `order`, `is_active`, `roles`, `menu_type`, `created_at`) 
VALUES (NULL, 'Kontak', '#kontak', NULL, 104, 1, '["admin","reviewer","kaprodi","dosen"]', 'landing', NOW());
```

---

## STEP 10: Verifikasi

**Jalankan SQL ini untuk cek hasil:**
```sql
SELECT `id`, `title`, `url`, `menu_type`, `order` 
FROM `menus` 
ORDER BY `menu_type`, `order`;
```

**Hasil yang diharapkan:**
- Menu dashboard: 13 menu
- Menu landing: 4 menu
- Total: 17 menu

---

## ✅ Selesai!

Sekarang sistem CMS sudah siap:
- Akses: http://localhost:8080/cms/menus
- Login sebagai admin
- Kelola semua menu (dashboard & landing page)

---

## 🔧 Troubleshooting

### Error "Duplicate column 'menu_type'"
**Solusi**: Kolom sudah ada, skip STEP 1

### Error "Duplicate entry"
**Solusi**: Menu sudah ada, skip step tersebut

### Error "Access denied"
**Solusi**: Gunakan user dengan privilege yang cukup

### Tidak bisa akses /cms/menus
**Solusi**: 
1. Pastikan sudah login sebagai admin
2. Clear cache browser
3. Restart server
