# Fix Masalah Encoding Statistik Landing Page

## Masalah

Pada halaman `/landing-statistics`, muncul karakter kotak (□) di beberapa label seperti:

- "Unit Luas Kampus □"
- "Luas Bangunan □"
- "Jumlah Bangunan □"
- "Laboratorium □"

## Penyebab

1. **Karakter khusus m²** di database tidak ter-render dengan baik
2. **Entry duplikat** untuk unit (contoh: `luas_kampus` dan `luas_kampus_unit`)
3. **Logika kompleks** di `home.php` yang mencari entry `_unit` terpisah

## Solusi

### 1. Jalankan SQL Fix

Jalankan file SQL berikut untuk membersihkan data:

```sql
-- File: FIX_LANDING_STATISTICS_ENCODING.sql
```

**Cara menjalankan:**

1. Buka phpMyAdmin
2. Pilih database Anda
3. Klik tab "SQL"
4. Copy-paste isi file `FIX_LANDING_STATISTICS_ENCODING.sql`
5. Klik "Go" atau "Kirim"

### 2. Perubahan yang Dilakukan

#### A. Database (`landing_statistics` table)

**SEBELUM:**

```
luas_kampus | Luas Kampus | 246269
luas_kampus_unit | Unit Luas Kampus | m²  ← Karakter ini bermasalah
luas_bangunan | Luas Bangunan | 93435
luas_bangunan_unit | Unit Luas Bangunan | m²  ← Karakter ini bermasalah
```

**SESUDAH:**

```
luas_kampus | Luas Kampus (m2) | 246269  ← Unit langsung di label
luas_bangunan | Luas Bangunan (m2) | 93435  ← Unit langsung di label
jumlah_bangunan | Jumlah Bangunan | 86
laboratorium | Laboratorium | 119
```

#### B. File `app/Views/home.php`

**SEBELUM:** Logika kompleks mencari entry `_unit` terpisah

```php
$fasilitasData = [];
foreach ($statistics['fasilitas'] as $stat) {
    if (!str_contains($stat['key_name'], 'unit')) {
        $fasilitasData[$stat['key_name']] = $stat;
    }
}
foreach ($fasilitasData as $key => $stat):
    $unit = '';
    foreach ($statistics['fasilitas'] as $s) {
        if ($s['key_name'] == $key . '_unit') {
            $unit = $s['value'];
            break;
        }
    }
?>
```

**SESUDAH:** Logika sederhana langsung loop

```php
<?php foreach ($statistics['fasilitas'] as $stat): ?>
    <div style="display: flex; justify-content: space-between; padding: 15px 0; border-bottom: 1px solid #e2e8f0;">
        <span style="color: #64748b;"><?= esc($stat['label']) ?></span>
        <strong style="color: #1e3a8a; font-size: 18px;">
            <?= number_format($stat['value']) ?>
        </strong>
    </div>
<?php endforeach; ?>
```

#### C. File `CREATE_LANDING_STATISTICS_FIXED.sql`

Diupdate untuk menghindari masalah encoding di masa depan.

## Hasil

✅ Tidak ada lagi karakter kotak (□)
✅ Label tampil dengan benar: "Luas Kampus (m2)", "Luas Bangunan (m2)"
✅ Kode lebih sederhana dan mudah dipelihara
✅ Tidak ada entry duplikat di database

## Testing

Setelah menjalankan SQL fix:

1. Buka `/landing-statistics` - pastikan tidak ada karakter kotak
2. Buka landing page (home) - pastikan statistik fasilitas tampil dengan benar
3. Edit nilai di `/landing-statistics` - pastikan bisa disimpan
4. Refresh landing page - pastikan perubahan muncul

## Catatan Penting

- Gunakan `m2` bukan `m²` untuk menghindari masalah encoding
- Jangan buat entry terpisah untuk unit, langsung masukkan ke label
- Pastikan charset database adalah `utf8mb4` untuk support karakter khusus di masa depan
