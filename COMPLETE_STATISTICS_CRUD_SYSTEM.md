# Sistem CRUD Lengkap untuk Statistik & Chart

## 🎯 Overview

Sistem manajemen statistik dan chart yang lengkap dengan fitur CRUD untuk:

- **Landing Page Statistics** - Statistik yang ditampilkan di halaman utama
- **Dashboard Statistics** - Statistik yang ditampilkan di dashboard admin
- **Charts & Indicators** - Chart interaktif untuk dashboard dan landing page
- **Sinkronisasi Database** - Auto-sync data antar tabel

## ✨ Fitur Utama

### 1. CRUD Landing Page Statistics

- ✅ Info boxes (Target skor, ranking dunia, ranking indonesia, kriteria SDGs)
- ✅ Profil kampus (Mahasiswa, dosen, jurusan, program studi)
- ✅ Fasilitas kampus (Luas kampus, luas bangunan, jumlah bangunan, lab)
- ✅ Progress ranking (Data historis 2023-2028)

### 2. CRUD Dashboard Statistics

- ✅ Target values (Target skor 2028, target ranking)
- ✅ Current values (Ranking dunia & indonesia saat ini)
- ✅ Campus information (Data kampus lengkap)
- ✅ Real-time calculated stats (Data dari tabel kriteria)

### 3. CRUD Charts & Indicators

- ✅ Dashboard charts (Line, bar, donut charts)
- ✅ Landing page charts (Area, pie charts)
- ✅ Multi-location charts (Tampil di dashboard & landing)
- ✅ Auto-sync dengan database statistics
- ✅ Configurable chart types dan styling

### 4. Sinkronisasi Database

- ✅ Real-time data dari tabel kriteria SDGs
- ✅ Auto-update chart data saat ada perubahan
- ✅ Sync landing page dengan dashboard statistics
- ✅ Bulk sync semua data

## 🗂️ Struktur Database

### Tabel `charts_indicators`

```sql
- id (Primary Key)
- chart_type (line, bar, pie, donut, area)
- title (Judul chart)
- description (Deskripsi chart)
- data_source (manual, database_table, api)
- chart_data (JSON data untuk chart)
- chart_config (JSON config Chart.js)
- display_location (dashboard, landing, both)
- section (Section placement)
- order_position (Urutan tampilan)
- is_active (Status aktif/nonaktif)
- sync_with_statistics (Auto-sync enabled)
- created_at, updated_at
```

### Tabel `landing_statistics`

```sql
- id (Primary Key)
- section (info_box, profil_kampus, fasilitas, ranking_dunia, ranking_indonesia)
- key_name (Key identifier)
- label (Label yang ditampilkan)
- value (Nilai statistik)
- icon (Icon class)
- color (Warna styling)
- order_position (Urutan tampilan)
- is_active (Status aktif/nonaktif)
- created_at, updated_at
```

### Tabel `dashboard_statistics`

```sql
- id (Primary Key)
- key (Key identifier)
- label (Label yang ditampilkan)
- value (Nilai statistik)
- type (static, calculated, target)
- category (target, current, campus_info)
- description (Deskripsi)
- is_active (Status aktif/nonaktif)
- order (Urutan tampilan)
- created_at, updated_at
```

## 🚀 Instalasi

### Step 1: Import Database

```bash
mysql -u username -p database_name < INSTALL_COMPLETE_STATISTICS_SYSTEM.sql
```

Atau via phpMyAdmin:

1. Buka phpMyAdmin
2. Pilih database
3. Klik tab "SQL"
4. Copy-paste isi file `INSTALL_COMPLETE_STATISTICS_SYSTEM.sql`
5. Klik "Go"

### Step 2: Verifikasi Instalasi

```sql
-- Check tabel sudah dibuat
SHOW TABLES LIKE '%statistics%';
SHOW TABLES LIKE '%charts%';

-- Check data sudah terinsert
SELECT COUNT(*) FROM charts_indicators;
SELECT COUNT(*) FROM landing_statistics;
SELECT COUNT(*) FROM dashboard_statistics;
```

### Step 3: Update Autoload (jika diperlukan)

```bash
composer dump-autoload
```

## 🎮 Cara Penggunaan

### Admin Panel

1. **Login sebagai admin**
2. **Akses menu "Manajemen Statistik & Chart"** (URL: `/statistics`)
3. **Pilih tab yang ingin diedit:**
   - Landing Page - Edit statistik landing page
   - Dashboard - Edit statistik dashboard
   - Charts & Indikator - Kelola chart

### Edit Statistik Landing Page

1. Klik tab "Landing Page"
2. Edit nilai di form input
3. Nilai otomatis tersimpan saat input berubah
4. Lihat perubahan langsung di landing page

### Edit Statistik Dashboard

1. Klik tab "Dashboard"
2. Edit nilai berdasarkan kategori:
   - Target (Target skor, ranking)
   - Current (Ranking saat ini)
   - Campus Info (Data kampus)
3. Nilai otomatis tersimpan

### Kelola Charts & Indikator

1. Klik tab "Charts & Indikator"
2. **Tambah chart baru:**
   - Klik "Tambah Chart"
   - Isi form (judul, tipe, lokasi tampil, data JSON)
   - Simpan
3. **Edit chart:**
   - Klik tombol edit pada chart
   - Update data atau konfigurasi
4. **Hapus chart:**
   - Klik tombol hapus
   - Konfirmasi penghapusan

### Sinkronisasi Data

1. **Auto-sync:** Chart dengan flag `sync_with_statistics=1` otomatis update
2. **Manual sync:** Klik tombol "Sync Semua Data"
3. **API sync:** POST ke `/statistics/bulk-sync`

## 📊 Jenis Chart yang Didukung

### Line Chart

- Progress ranking dunia/indonesia
- Target vs pencapaian skor
- Trend data over time

### Bar Chart

- Data per kriteria SDGs
- Perbandingan antar kategori
- Jumlah data per periode

### Pie/Donut Chart

- Status verifikasi data
- Distribusi fasilitas kampus
- Persentase kategori

### Area Chart

- Progress ranking dengan fill area
- Trend data dengan highlight area

## 🔧 Konfigurasi Chart

### Format Chart Data (JSON)

```json
{
  "labels": ["2023", "2024", "2025"],
  "datasets": [
    {
      "label": "Ranking Dunia",
      "data": [896, 705, 561],
      "borderColor": "#10b981",
      "backgroundColor": "rgba(16,185,129,0.1)"
    }
  ]
}
```

### Format Chart Config (JSON)

```json
{
  "responsive": true,
  "plugins": {
    "legend": { "position": "top" },
    "title": { "display": true, "text": "Chart Title" }
  },
  "scales": {
    "y": { "beginAtZero": true }
  }
}
```

## 🔄 Sinkronisasi Data

### Auto-Sync Charts

Chart dengan `sync_with_statistics=1` akan otomatis update data dari:

- Tabel kriteria SDGs (setting_infrastructure, energy_climate, dll)
- Tabel users (untuk statistik user)
- Tabel landing_statistics & dashboard_statistics

### Manual Sync

```php
// Via Helper
$result = sync_statistics_data();

// Via Model
$chartModel = new ChartIndicatorModel();
$chartModel->syncWithStatistics();
```

### API Endpoints

```bash
# Get chart data
GET /statistics/api/chart-data/dashboard
GET /statistics/api/chart-data/landing

# Bulk sync
POST /statistics/bulk-sync

# Update individual stats
POST /statistics/update-landing-stat
POST /statistics/update-dashboard-stat
```

## 🎨 Komponen View

### Statistics Display Component

```php
<?= view('components/statistics_display', [
    'statistics' => $stats,
    'location' => 'dashboard',
    'section' => 'main'
]) ?>
```

### Chart Display Component

```php
<?= view('components/chart_display', [
    'chart' => $chartData
]) ?>
```

### Helper Functions

```php
// Load statistics
$stats = load_statistics('landing', 'info_box');

// Load charts
$charts = load_charts('dashboard', 'main_charts');

// Render components
echo render_statistics($stats, 'landing');
echo render_chart($chart);
echo render_charts($charts, 2); // 2 columns
```

## 🔐 Permission & Security

### Admin Only Access

- Semua CRUD operations hanya untuk role `admin`
- Session validation di setiap controller method
- CSRF protection untuk form submissions

### Data Validation

- Input sanitization untuk semua form data
- JSON validation untuk chart data
- XSS protection untuk output

## 📱 Responsive Design

### Mobile-First Approach

- Grid system yang responsive
- Touch-friendly interface
- Optimized chart rendering untuk mobile

### Cross-Browser Support

- Chart.js untuk kompatibilitas maksimal
- CSS fallbacks untuk browser lama
- Progressive enhancement

## 🚨 Troubleshooting

### Chart Tidak Muncul

1. **Check Chart.js loaded:**

   ```html
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   ```

2. **Check JSON format:**

   ```javascript
   // Valid JSON
   {"labels":["A","B"],"datasets":[{"data":[1,2]}]}

   // Invalid JSON (akan error)
   {labels:["A","B"],datasets:[{data:[1,2]}]}
   ```

3. **Check canvas element:**
   ```html
   <canvas id="chart-1" data-chart-data="..."></canvas>
   ```

### Statistik Tidak Update

1. **Check database connection**
2. **Verify table exists:**
   ```sql
   SHOW TABLES LIKE '%statistics%';
   ```
3. **Check permissions (admin role)**
4. **Clear browser cache**

### Sync Tidak Berfungsi

1. **Check sync flag:**
   ```sql
   SELECT * FROM charts_indicators WHERE sync_with_statistics = 1;
   ```
2. **Check source tables exist:**
   ```sql
   SHOW TABLES LIKE 'setting_infrastructure';
   ```
3. **Manual sync via admin panel**

## 📈 Performance Optimization

### Database Indexing

```sql
-- Add indexes untuk performance
ALTER TABLE charts_indicators ADD INDEX idx_location_section (display_location, section);
ALTER TABLE landing_statistics ADD INDEX idx_section_active (section, is_active);
ALTER TABLE dashboard_statistics ADD INDEX idx_category_active (category, is_active);
```

### Caching Strategy

```php
// Cache chart data
$cache = \Config\Services::cache();
$cacheKey = 'dashboard_charts_' . date('Y-m-d-H');
$charts = $cache->remember($cacheKey, 3600, function() {
    return $chartModel->getByLocation('dashboard');
});
```

### Lazy Loading

```javascript
// Load charts on scroll
const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      loadChart(entry.target);
    }
  });
});
```

## 🔮 Future Enhancements

### Planned Features

1. **Export Statistics**

   - Export ke Excel/PDF
   - Scheduled reports
   - Email notifications

2. **Advanced Charts**

   - Mixed chart types
   - Real-time updates via WebSocket
   - Interactive drill-down

3. **Dashboard Builder**

   - Drag & drop interface
   - Custom layouts
   - Widget system

4. **API Integration**
   - External data sources
   - Webhook support
   - Third-party integrations

### Roadmap

- **v2.0:** Advanced chart types & real-time updates
- **v2.1:** Export & reporting system
- **v2.2:** Dashboard builder interface
- **v3.0:** API integration & webhooks

## 📞 Support

### Documentation

- File ini: `COMPLETE_STATISTICS_CRUD_SYSTEM.md`
- Installation guide: `INSTALL_COMPLETE_STATISTICS_SYSTEM.sql`
- API documentation: Coming soon

### Contact

- Developer: [Your Name]
- Email: [Your Email]
- Project Repository: [GitHub URL]

---

## 🎉 Summary

Sistem CRUD Statistik & Chart telah berhasil dibuat dengan fitur lengkap:

✅ **CRUD Landing Page Statistics** - Edit semua statistik landing page
✅ **CRUD Dashboard Statistics** - Edit semua statistik dashboard  
✅ **CRUD Charts & Indicators** - Kelola chart interaktif
✅ **Sinkronisasi Database** - Auto-sync data real-time
✅ **Admin Panel** - Interface user-friendly untuk admin
✅ **API Endpoints** - Akses programmatic ke data
✅ **Responsive Design** - Optimal di semua device
✅ **Security** - Admin-only access dengan validation

Semua statistik sekarang bisa di-CRUD lengkap dan tersinkronisasi dengan database! 🚀
