# Dashboard Real-time Statistics System

## Overview

Sistem statistik dashboard yang otomatis update berdasarkan data yang diinput ke sistem.

## Fitur Utama

### 1. Real-time Calculated Statistics

Statistik yang dihitung otomatis dari database:

- ✅ **Total Data Entries** - Jumlah total data dari semua kriteria
- ✅ **Approved Data** - Jumlah data yang sudah diapprove
- ✅ **Pending Data** - Jumlah data yang menunggu approval
- ✅ **Rejected Data** - Jumlah data yang ditolak
- ✅ **Score Percentage** - Persentase skor berdasarkan data approved
- ✅ **Criteria Breakdown** - Jumlah data per kriteria:
  - Setting & Infrastructure
  - Energy & Climate
  - Water Management
  - Waste Management
  - Transportation
  - Education & Research
- ✅ **User Statistics**:
  - Total Users
  - Approved Users
  - Pending Users

### 2. Configurable Static Statistics

Statistik yang bisa diedit admin melalui database:

- Target Skor 2028
- Target Ranking Dunia
- Target Ranking Indonesia
- Ranking Dunia Saat Ini
- Ranking Indonesia Saat Ini
- Jumlah Mahasiswa
- Jumlah Dosen
- Jumlah Jurusan
- Jumlah Program Studi
- Luas Kampus
- Luas Bangunan
- Jumlah Bangunan
- Jumlah Kelas
- Jumlah Laboratorium

## Instalasi

### Step 1: Create Statistics Table

Jalankan SQL file:

```bash
mysql -u username -p database_name < CREATE_DASHBOARD_STATISTICS_TABLE.sql
```

Atau via phpMyAdmin:

1. Buka phpMyAdmin
2. Pilih database
3. Klik tab "SQL"
4. Copy-paste isi `CREATE_DASHBOARD_STATISTICS_TABLE.sql`
5. Klik "Go"

### Step 2: Verify Installation

```sql
SELECT COUNT(*) as total FROM dashboard_statistics;
```

**Expected result:** `total = 14`

## Cara Kerja

### Real-time Calculation

Setiap kali dashboard dibuka, sistem akan:

1. **Count data dari setiap tabel kriteria**

   ```php
   $settingInfraCount = $db->table('setting_infrastructure')->countAllResults();
   $energyClimateCount = $db->table('energy_climate')->countAllResults();
   // ... dst
   ```

2. **Count data berdasarkan status**

   ```php
   $approvedData = $db->table('setting_infrastructure')
                      ->where('status_verifikasi', 'approved')
                      ->countAllResults();
   ```

3. **Hitung persentase skor**

   ```php
   $scorePercentage = ($approvedData / ($totalDataEntries * 6)) * 100;
   ```

4. **Count user statistics**
   ```php
   $totalUsers = $db->table('users')->countAllResults();
   $approvedUsers = $db->table('users')
                       ->where('approval_status', 'approved')
                       ->countAllResults();
   ```

### Static Values from Database

```php
$statisticModel = new DashboardStatisticModel();
$staticStats = $statisticModel->getAsArray();

// Use in dashboard
$targetSkor = $staticStats['target_skor_2028'] ?? 80;
```

## Update Static Statistics

### Via Database (phpMyAdmin)

```sql
UPDATE dashboard_statistics
SET value = '85'
WHERE `key` = 'target_skor_2028';
```

### Via PHP (Future: Admin Panel)

```php
$statisticModel = new DashboardStatisticModel();
$statisticModel->updateByKey('target_skor_2028', [
    'value' => '85'
]);
```

## Testing

### Test 1: Add New Data

1. Login sebagai dosen/kaprodi
2. Tambah data di salah satu kriteria (misalnya Water Management)
3. Refresh dashboard
4. **Expected:** `totalDataEntries` bertambah 1

### Test 2: Approve Data

1. Login sebagai admin/reviewer
2. Approve data yang pending
3. Refresh dashboard
4. **Expected:**
   - `approvedData` bertambah 1
   - `pendingData` berkurang 1
   - `scorePercentage` meningkat

### Test 3: Update Static Value

1. Buka phpMyAdmin
2. Update value di tabel `dashboard_statistics`
3. Refresh dashboard
4. **Expected:** Nilai berubah sesuai update

## Statistik yang Tersedia

### Calculated (Real-time)

| Key                      | Description       | Source                                   |
| ------------------------ | ----------------- | ---------------------------------------- |
| `skorSekarang`           | Skor saat ini (%) | Calculated from approved data            |
| `totalDataEntries`       | Total data        | Count from all criteria tables           |
| `approvedData`           | Data approved     | Count where status = 'approved'          |
| `pendingData`            | Data pending      | Count where status = 'pending'           |
| `rejectedData`           | Data rejected     | Calculated                               |
| `settingInfraCount`      | Data SI           | Count from setting_infrastructure        |
| `energyClimateCount`     | Data EC           | Count from energy_climate                |
| `waterManagementCount`   | Data WR           | Count from water_management              |
| `wasteManagementCount`   | Data WS           | Count from waste_management              |
| `transportationCount`    | Data TR           | Count from transportation                |
| `educationResearchCount` | Data ED           | Count from education_research            |
| `totalUsers`             | Total users       | Count from users                         |
| `approvedUsers`          | Approved users    | Count where approval_status = 'approved' |
| `pendingUsers`           | Pending users     | Count where approval_status = 'pending'  |

### Static (From Database)

| Key                          | Description                | Editable |
| ---------------------------- | -------------------------- | -------- |
| `target_skor_2028`           | Target skor 2028           | ✅ Yes   |
| `target_ranking_dunia`       | Target ranking dunia       | ✅ Yes   |
| `target_ranking_indonesia`   | Target ranking Indonesia   | ✅ Yes   |
| `ranking_dunia_sekarang`     | Ranking dunia saat ini     | ✅ Yes   |
| `ranking_indonesia_sekarang` | Ranking Indonesia saat ini | ✅ Yes   |
| `jumlah_mahasiswa`           | Jumlah mahasiswa           | ✅ Yes   |
| `jumlah_dosen`               | Jumlah dosen               | ✅ Yes   |
| `jumlah_jurusan`             | Jumlah jurusan             | ✅ Yes   |
| `jumlah_prodi`               | Jumlah prodi               | ✅ Yes   |
| `luas_kampus`                | Luas kampus (m²)           | ✅ Yes   |
| `luas_bangunan`              | Luas bangunan (m²)         | ✅ Yes   |
| `jumlah_bangunan`            | Jumlah bangunan            | ✅ Yes   |
| `jumlah_kelas`               | Jumlah kelas               | ✅ Yes   |
| `jumlah_laboratorium`        | Jumlah laboratorium        | ✅ Yes   |

## Benefits

✅ **Auto Update** - Statistik otomatis update saat ada data baru
✅ **Real-time** - Data selalu up-to-date
✅ **Accurate** - Tidak perlu manual update
✅ **Flexible** - Static values bisa diedit via database
✅ **Transparent** - Admin bisa lihat breakdown per kriteria

## Future Enhancements

1. **Admin Panel untuk Edit Statistics**

   - CRUD interface untuk edit static values
   - Tidak perlu akses database langsung

2. **Advanced Score Calculation**

   - Formula scoring yang lebih kompleks
   - Weighted scoring per kriteria

3. **Historical Data**

   - Track perubahan statistik over time
   - Chart historical trends

4. **Export Statistics**

   - Export ke Excel/PDF
   - Generate reports

5. **Notifications**
   - Alert saat target tercapai
   - Reminder untuk input data

## Troubleshooting

**Q: Statistik tidak update**
A:

1. Clear browser cache (Ctrl+F5)
2. Cek apakah tabel criteria ada data
3. Cek apakah Dashboard controller sudah diupdate

**Q: Score percentage selalu 0**
A: Pastikan ada data dengan status 'approved' di tabel criteria

**Q: Static values tidak berubah**
A:

1. Cek apakah tabel `dashboard_statistics` sudah dibuat
2. Cek apakah value sudah diupdate di database
3. Pastikan `is_active = 1`

**Q: Error "Table doesn't exist"**
A: Jalankan `CREATE_DASHBOARD_STATISTICS_TABLE.sql`

## Files Created

1. `CREATE_DASHBOARD_STATISTICS_TABLE.sql` - SQL untuk create table
2. `app/Models/DashboardStatisticModel.php` - Model untuk statistics
3. `app/Controllers/Dashboard.php` - Updated dengan real-time calculation
4. `DASHBOARD_REALTIME_STATISTICS.md` - Dokumentasi ini

## Summary

Sekarang dashboard Anda memiliki:

- ✅ Statistik yang otomatis update dari data input
- ✅ Static values yang bisa diedit via database
- ✅ Real-time calculation untuk score dan counts
- ✅ Breakdown per kriteria dan status
- ✅ User statistics

Setiap kali ada data baru diinput atau diapprove, statistik di dashboard akan otomatis update!
