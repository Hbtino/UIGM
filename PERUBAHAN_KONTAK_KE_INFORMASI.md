# Perubahan Section "Kontak" menjadi "Informasi"

## Perubahan yang Dilakukan

### 1. File View - home.php

- ✅ Menu navigasi: "Kontak" → "Informasi"
- ✅ Section ID: `#kontak` → `#informasi`
- ✅ Section title: "Kontak" → "Informasi"
- ✅ Subtitle: "Kontak informasi" → "Informasi tentang Polban"

### 2. File Controller - CmsController.php

- ✅ Comment: "deskripsi, program, kontak" → "deskripsi, program, informasi"

### 3. File View - cms/landing/index.php

- ✅ Card header: "Kontak" → "Informasi"
- ✅ Card icon: `fa-envelope` → `fa-info-circle`
- ✅ Card description: "Edit konten section Kontak" → "Edit konten section Informasi"
- ✅ URL: `/landing-contents/edit/kontak` → `/landing-contents/edit/informasi`

### 4. Database Update

File SQL: `UPDATE_KONTAK_TO_INFORMASI.sql`

```sql
UPDATE landing_contents
SET section = 'informasi',
    title = 'Informasi',
    updated_at = NOW()
WHERE section = 'kontak';
```

## Cara Menjalankan Update Database

1. Buka phpMyAdmin atau MySQL client
2. Pilih database yang digunakan
3. Jalankan query dari file `UPDATE_KONTAK_TO_INFORMASI.sql`
4. Atau jalankan via command line:
   ```bash
   mysql -u username -p database_name < UPDATE_KONTAK_TO_INFORMASI.sql
   ```

## Testing

1. **Landing Page:**

   - Buka homepage
   - Cek menu navigasi sudah berubah menjadi "Informasi"
   - Klik menu "Informasi" untuk scroll ke section
   - Cek judul section sudah "Informasi"
   - Cek subtitle sudah "Informasi tentang Polban"

2. **CMS Admin:**
   - Login sebagai admin
   - Buka menu "Konten Landing Page"
   - Cek card terakhir sudah berubah menjadi "Informasi"
   - Klik "Edit" pada card Informasi
   - Pastikan bisa edit konten dengan normal

## Catatan

- Semua perubahan sudah dilakukan di code
- Hanya perlu jalankan SQL update untuk database
- Tidak ada breaking changes, semua backward compatible
