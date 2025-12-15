# 🔧 SOLUSI: Map Tidak Berubah di Landing Page

## 🎯 **MASALAH:**

- Map sudah diganti di admin (`/informasi-contents`)
- Preview muncul di admin
- **TAPI** landing page masih menampilkan map lama

---

## ✅ **SOLUSI CEPAT (RECOMMENDED):**

### **LANGKAH 1: Jalankan SQL Force Update**

1. Buka **phpMyAdmin**
2. Pilih database kamu
3. Klik tab **SQL**
4. Copy paste SQL ini:

```sql
-- CEK DATA DULU
SELECT
    section,
    title,
    LENGTH(map_embed) as panjang_kode,
    LEFT(map_embed, 100) as preview_kode
FROM landing_contents
WHERE section = 'informasi';
```

5. Klik **Go** / **Jalankan**
6. **Screenshot hasilnya** dan lihat:
   - Jika `panjang_kode` = 0 atau NULL → Data tidak tersimpan
   - Jika `panjang_kode` > 0 → Data tersimpan tapi tidak ter-load

---

### **LANGKAH 2: Force Update Map**

Jalankan SQL ini (ganti dengan kode embed kamu):

```sql
UPDATE landing_contents
SET
    map_embed = 'PASTE_KODE_IFRAME_KAMU_DI_SINI',
    updated_at = NOW()
WHERE section = 'informasi';
```

**Contoh lengkap:**

```sql
UPDATE landing_contents
SET
    map_embed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.23..." width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
    updated_at = NOW()
WHERE section = 'informasi';
```

---

### **LANGKAH 3: Clear Cache & Refresh**

1. **Clear Browser Cache:**

   - Tekan `Ctrl + Shift + Delete`
   - Atau `Ctrl + F5` (Hard Refresh)

2. **Buka Landing Page:**
   - Buka `http://localhost/` atau URL landing page kamu
   - Map seharusnya sudah berubah

---

## 🔍 **JIKA MASIH BELUM BERUBAH:**

### **Cek 1: Apakah Data Tersimpan?**

Jalankan SQL ini:

```sql
SELECT map_embed FROM landing_contents WHERE section = 'informasi';
```

**Hasil yang diharapkan:**

- Harus ada kode `<iframe src="https://www.google.com/maps/embed...`
- Tidak boleh NULL atau empty

---

### **Cek 2: Apakah Ter-load di View?**

1. Buka landing page
2. Klik kanan → **View Page Source** (Ctrl+U)
3. Cari `id="informasi"`
4. Lihat di bagian `<div class="col-md-4">`

**Yang diharapkan:**

```html
<div class="col-md-4">
  <div style="background: white; padding: 15px; border-radius: 15px;">
    <iframe src="https://www.google.com/maps/embed?pb=..." ...></iframe>
  </div>
</div>
```

**Jika tidak ada `<iframe>`:**

- Data tidak ter-load dari database
- Masalah di controller atau view

---

### **Cek 3: Browser Console**

1. Buka landing page
2. Tekan **F12** (Developer Tools)
3. Tab **Console**
4. Lihat apakah ada error

**Error umum:**

- `Refused to display` → Google Maps API issue
- `Mixed Content` → HTTP vs HTTPS issue
- `404 Not Found` → File tidak ditemukan

---

## 🐛 **DEBUGGING LANJUTAN:**

### **Debug 1: Tambahkan Debug di View**

Edit file `app/Views/home.php`, cari bagian informasi (sekitar line 650), tambahkan ini:

```php
<!-- DEBUG INFO -->
<?php
echo "<!-- DEBUG: informasiContent exists: " . (isset($informasiContent) ? 'YES' : 'NO') . " -->";
if (isset($informasiContent)) {
    echo "<!-- DEBUG: map_embed length: " . strlen($informasiContent['map_embed'] ?? '') . " -->";
    echo "<!-- DEBUG: map_embed preview: " . substr($informasiContent['map_embed'] ?? '', 0, 100) . " -->";
}
?>
```

Lalu view page source dan cari `<!-- DEBUG:` untuk lihat hasilnya.

---

### **Debug 2: Cek Controller**

Edit `app/Controllers/Home.php`, tambahkan log:

```php
// Setelah load data
log_message('debug', 'Contents loaded: ' . count($contents));
log_message('debug', 'Informasi section exists: ' . (isset($contentsBySection['informasi']) ? 'YES' : 'NO'));
if (isset($contentsBySection['informasi'])) {
    log_message('debug', 'Map embed length: ' . strlen($contentsBySection['informasi']['map_embed'] ?? ''));
}
```

Lalu cek file log di `writable/logs/log-YYYY-MM-DD.php`

---

## 🎯 **SOLUSI ALTERNATIF:**

### **Solusi 1: Hardcode Sementara**

Jika urgent, edit `app/Views/home.php` dan hardcode map:

```php
<div class="col-md-4">
    <div style="background: white; padding: 15px; border-radius: 15px;">
        <!-- HARDCODE MAP -->
        <iframe src="https://www.google.com/maps/embed?pb=KODE_KAMU_DI_SINI"
                width="100%" height="300" style="border:0;"
                allowfullscreen="" loading="lazy">
        </iframe>
    </div>
</div>
```

---

### **Solusi 2: Cek Field Type**

Pastikan kolom `map_embed` adalah `TEXT`:

```sql
SHOW COLUMNS FROM landing_contents LIKE 'map_embed';
```

Jika bukan TEXT, ubah:

```sql
ALTER TABLE landing_contents
MODIFY COLUMN map_embed TEXT NULL;
```

---

### **Solusi 3: Disable XSS Filter**

Edit `app/Controllers/CmsController.php`, method `updateInformasiContent`:

```php
$data = [
    // ... field lain
    'map_embed' => $this->request->getRawInput()['map_embed'] ?? $this->request->getPost('map_embed'),
    // ... field lain
];
```

---

## 📋 **CHECKLIST:**

Sebelum menyerah, pastikan sudah cek semua ini:

- [ ] Data tersimpan di database (cek via SQL)
- [ ] Kolom `map_embed` type TEXT (bukan VARCHAR)
- [ ] Kode iframe lengkap (ada `<iframe>` dan `</iframe>`)
- [ ] Browser cache sudah di-clear (Ctrl + F5)
- [ ] Tidak ada error di browser console (F12)
- [ ] View page source ada `<iframe>` di section informasi
- [ ] Controller load data dengan benar
- [ ] Model `$allowedFields` include `map_embed`

---

## 🚀 **QUICK FIX (PALING CEPAT):**

Jika kamu mau cepat dan tidak mau ribet:

1. **Jalankan SQL ini:**

```sql
-- File: FORCE_UPDATE_MAP.sql
UPDATE landing_contents
SET map_embed = '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.23..." width="100%" height="300" style="border:0;"></iframe>',
    updated_at = NOW()
WHERE section = 'informasi';
```

2. **Refresh landing page** (Ctrl + F5)

3. **Done!** Map seharusnya sudah berubah.

---

## 📞 **Jika Masih Error:**

Kirim ke saya:

1. Screenshot hasil query `SELECT map_embed FROM landing_contents WHERE section = 'informasi'`
2. Screenshot view page source bagian `id="informasi"`
3. Screenshot browser console (F12)
4. Screenshot success message setelah save di admin

Dengan info itu saya bisa tahu persis masalahnya di mana!

---

**File Bantuan:**

- `FORCE_UPDATE_MAP.sql` - SQL untuk force update
- `DEBUG_MAP_ISSUE.sql` - SQL untuk debug
- `CARA_BENAR_GANTI_MAP.md` - Panduan ganti map
