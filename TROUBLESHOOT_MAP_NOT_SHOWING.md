# 🔧 Troubleshooting: Map Tidak Muncul di Landing Page

## 🐛 **MASALAH:**

Map sudah disimpan di admin dan preview muncul, tapi tidak muncul di landing page.

---

## 🔍 **LANGKAH DEBUG:**

### **1. CEK DATABASE**

Jalankan SQL ini untuk cek data:

```sql
-- File: DEBUG_MAP_ISSUE.sql
SELECT
    section,
    title,
    LENGTH(map_embed) as map_length,
    LEFT(map_embed, 100) as map_preview
FROM landing_contents
WHERE section = 'informasi';
```

**Hasil yang Diharapkan:**

- `map_length` harus > 0 (tidak NULL atau empty)
- `map_preview` harus menunjukkan `<iframe src=...`

**Jika NULL atau EMPTY:**

```sql
-- Data tidak tersimpan, insert manual:
UPDATE landing_contents
SET map_embed = '<iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="300" style="border:0;"></iframe>',
    updated_at = NOW()
WHERE section = 'informasi';
```

---

### **2. CEK BROWSER CONSOLE**

1. Buka landing page
2. Tekan **F12** (Developer Tools)
3. Tab **Console**
4. Lihat apakah ada error JavaScript

**Error Umum:**

- `Refused to display in a frame` → Google Maps API issue
- `Mixed Content` → HTTP vs HTTPS issue

---

### **3. CEK HTML SOURCE**

1. Buka landing page
2. Klik kanan → **View Page Source** (Ctrl+U)
3. Cari `id="informasi"`
4. Lihat di dalam `<div class="col-md-4">`

**Yang Diharapkan:**

```html
<div class="col-md-4">
  <div style="background: white; padding: 15px; border-radius: 15px;">
    <iframe src="https://www.google.com/maps/embed?pb=..." ...></iframe>
  </div>
</div>
```

**Jika Tidak Ada `<iframe>`:**

- Data tidak ter-load dari database
- Cek controller Home.php
- Cek apakah `$contents['informasi']` ada

---

### **4. CEK CONTROLLER**

Buka file: `app/Controllers/Home.php`

Pastikan ada kode ini:

```php
$contents = $landingContentModel
    ->where('is_active', 1)
    ->orderBy('order', 'ASC')
    ->findAll();

// Convert to associative array by section
$contentsBySection = [];
foreach ($contents as $content) {
    $contentsBySection[$content['section']] = $content;
}

$data = [
    'news' => $news,
    'contents' => $contentsBySection  // ← PENTING!
];
```

---

### **5. CEK VIEW**

Buka file: `app/Views/home.php`

Cari bagian ini (sekitar line 650-720):

```php
<?php if ($informasiContent && !empty($informasiContent['map_embed'])): ?>
    <!-- Map from Database -->
    <div style="background: white; padding: 15px; border-radius: 15px;">
        <?= $informasiContent['map_embed'] ?>
    </div>
<?php else: ?>
    <!-- Default Logo -->
    ...
<?php endif; ?>
```

**Debug:**
Tambahkan ini sebelum `<?php if`:

```php
<!-- DEBUG -->
<?php
var_dump($informasiContent);
var_dump(!empty($informasiContent['map_embed']));
?>
```

---

### **6. CLEAR CACHE**

#### **Browser Cache:**

```
Ctrl + Shift + Delete
atau
Ctrl + F5 (Hard Refresh)
```

#### **CodeIgniter Cache:**

```bash
# Hapus folder cache
rm -rf writable/cache/*
```

#### **PHP OpCache:**

```php
// Tambahkan di controller atau jalankan sekali
opcache_reset();
```

---

## 🔧 **SOLUSI UMUM:**

### **Solusi 1: Insert Manual via SQL**

Jika data tidak tersimpan, insert manual:

```sql
UPDATE landing_contents
SET
    map_embed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0956!2d107.5740603!3d-6.8715374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adf177bf8d%3A0x437398556f9fa03!2sPoliteknik%20Negeri%20Bandung!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
    updated_at = NOW()
WHERE section = 'informasi';
```

### **Solusi 2: Cek Field Type**

Pastikan kolom `map_embed` adalah `TEXT` bukan `VARCHAR`:

```sql
ALTER TABLE landing_contents
MODIFY COLUMN map_embed TEXT NULL;
```

### **Solusi 3: Disable XSS Filtering**

Jika CodeIgniter filter HTML, tambahkan di controller:

```php
$data = [
    'map_embed' => $this->request->getPost('map_embed', FILTER_UNSAFE_RAW)
];
```

### **Solusi 4: Check Model**

Pastikan `map_embed` ada di `$allowedFields`:

```php
// app/Models/LandingContentModel.php
protected $allowedFields = [
    'section',
    'title',
    'subtitle',
    'content',
    'address',
    'phone',
    'email',
    'map_embed',  // ← HARUS ADA!
    'map_latitude',
    'map_longitude',
    'order',
    'is_active'
];
```

---

## 📊 **CHECKLIST DEBUG:**

- [ ] Data tersimpan di database (cek via SQL)
- [ ] `map_embed` tidak NULL atau empty
- [ ] Kolom `map_embed` type TEXT
- [ ] Controller load data dengan benar
- [ ] View render `$informasiContent['map_embed']`
- [ ] Tidak ada error di browser console
- [ ] Cache sudah di-clear
- [ ] Kode iframe lengkap (ada `<iframe>` dan `</iframe>`)

---

## 🎯 **QUICK FIX:**

Jika masih tidak muncul, coba ini:

### **1. Test Langsung di View**

Edit `app/Views/home.php`, ganti bagian map dengan hardcode:

```php
<div class="col-md-4">
    <div style="background: white; padding: 15px; border-radius: 15px;">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.0956!2d107.5740603!3d-6.8715374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e9adf177bf8d%3A0x437398556f9fa03!2sPoliteknik%20Negeri%20Bandung!5e0!3m2!1sid!2sid!4v1234567890!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</div>
```

**Jika muncul:** Masalah di database/controller  
**Jika tidak muncul:** Masalah di CSS/JavaScript

---

## 📞 **Jika Masih Error:**

Kirim screenshot:

1. Hasil query `DEBUG_MAP_ISSUE.sql`
2. Browser console (F12)
3. View page source bagian `id="informasi"`
4. Success message setelah save di admin

---

**File Bantuan:**

- `DEBUG_MAP_ISSUE.sql` - Query untuk cek database
- `CARA_BENAR_GANTI_MAP.md` - Panduan lengkap ganti map
