# Fix: Statistik Dashboard Value Tidak Muncul

## Masalah

Saat edit value di menu "Statistik Dashboard", perubahan tidak muncul di dashboard.

## Penyebab

Dashboard menggunakan value dari 2 sumber:

1. **dashboard_contents** - untuk tampilan stat card
2. **dashboard_statistics** - untuk nilai statistik

Sebelumnya, stat card hanya membaca dari `dashboard_contents`, tidak dari `dashboard_statistics`.

## Solusi

Merge data dari `dashboard_statistics` ke `dashboard_contents` di Dashboard controller.

### Perubahan di Dashboard.php

```php
// Get statistics from database
$statisticModel = new \App\Models\DashboardStatisticModel();
$statistics = $statisticModel->getAsArray();

// Merge statistics values into dashboard content for stat cards
if (isset($dashboardContent['stat_card_1']) && isset($statistics['target_skor_2028'])) {
    $dashboardContent['stat_card_1']['value'] = $statistics['target_skor_2028'];
}
if (isset($dashboardContent['stat_card_2']) && isset($statistics['target_ranking_dunia'])) {
    $dashboardContent['stat_card_2']['value'] = $statistics['target_ranking_dunia'];
}
if (isset($dashboardContent['stat_card_3']) && isset($statistics['target_ranking_indonesia'])) {
    $dashboardContent['stat_card_3']['value'] = $statistics['target_ranking_indonesia'];
}
```

### Perubahan di dashboard/index.php

Update stat cards untuk menggunakan value yang sudah di-merge:

```php
<?php
$card1Value = isset($dashboard_content['stat_card_1']['value']) ? $dashboard_content['stat_card_1']['value'] : $stats['targetSkor2028'];
?>
<h3><?= esc($card1Value) ?>%</h3>
```

## Cara Kerja Sekarang

### Edit via Statistik Dashboard

1. Login sebagai admin
2. Buka **Statistik Dashboard**
3. Edit "Target Skor 2028" dari 80 menjadi 85
4. Simpan
5. Refresh dashboard
6. ✅ Nilai berubah menjadi 85%!

### Mapping Data

| Statistik Dashboard        | Dashboard Content   | Stat Card |
| -------------------------- | ------------------- | --------- |
| `target_skor_2028`         | `stat_card_1.value` | Card 1    |
| `target_ranking_dunia`     | `stat_card_2.value` | Card 2    |
| `target_ranking_indonesia` | `stat_card_3.value` | Card 3    |

## Testing

### Test 1: Edit Target Skor

1. Statistik Dashboard → Edit "Target Skor 2028"
2. Ubah value dari 80 menjadi 85
3. Simpan
4. Refresh dashboard
5. **Expected:** Stat card 1 menunjukkan 85%

### Test 2: Edit Target Ranking Dunia

1. Statistik Dashboard → Edit "Target Ranking Dunia"
2. Ubah value dari 176 menjadi 150
3. Simpan
4. Refresh dashboard
5. **Expected:** Stat card 2 menunjukkan #150

### Test 3: Edit Target Ranking Indonesia

1. Statistik Dashboard → Edit "Target Ranking Indonesia"
2. Ubah value dari 26 menjadi 20
3. Simpan
4. Refresh dashboard
5. **Expected:** Stat card 3 menunjukkan #20

## Catatan Penting

### 2 Cara Edit Stat Cards

**Cara 1: Via Statistik Dashboard (RECOMMENDED)**

- Edit **nilai/angka** saja
- Lebih mudah dan cepat
- Untuk: Target skor, ranking, dll

**Cara 2: Via Konten Dashboard**

- Edit **tampilan lengkap** (text, icon, warna, trend)
- Untuk: Ubah label, icon, warna, trend text

### Prioritas Data

```
dashboard_statistics → dashboard_contents → fallback value
```

Jika ada value di `dashboard_statistics`, akan digunakan.
Jika tidak ada, gunakan value dari `dashboard_contents`.
Jika tidak ada keduanya, gunakan fallback value dari `$stats`.

## Summary

✅ **Sekarang sudah fixed!**

Edit di **Statistik Dashboard** akan langsung terlihat di dashboard setelah refresh.

**File yang diupdate:**

- `app/Controllers/Dashboard.php` - Merge statistics ke content
- `app/Views/dashboard/index.php` - Update stat cards display

**Tidak perlu edit code lagi!** Semua bisa dikelola via admin panel.
