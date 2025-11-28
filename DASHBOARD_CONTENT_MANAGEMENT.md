# Dashboard Content Management System

## Overview

Sistem untuk mengelola konten dashboard melalui database, memungkinkan admin untuk mengubah teks, nilai, icon, dan warna tanpa perlu edit code.

## Fitur

- ✅ Manage Info Box (judul, konten)
- ✅ Manage Stat Cards (4 cards dengan nilai, icon, warna, trend)
- ✅ Manage Chart Title & Description
- ✅ Manage Top Bar Title & Subtitle
- ✅ CRUD interface untuk admin
- ✅ Preview real-time di dashboard

## Instalasi

### 1. Buat Tabel Database

Jalankan SQL file: `CREATE_DASHBOARD_CONTENTS_TABLE.sql`

```bash
mysql -u username -p database_name < CREATE_DASHBOARD_CONTENTS_TABLE.sql
```

Atau via phpMyAdmin:

1. Buka phpMyAdmin
2. Pilih database
3. Klik tab "SQL"
4. Copy-paste isi file `CREATE_DASHBOARD_CONTENTS_TABLE.sql`
5. Klik "Go"

### 2. File yang Dibuat

**Model:**

- `app/Models/DashboardContentModel.php` - Model untuk manage dashboard content

**Controller:**

- `app/Controllers/CmsController.php` - Tambah 3 method:
  - `dashboardContents()` - List semua content
  - `editDashboardContent($section)` - Form edit content
  - `updateDashboardContent($section)` - Update content

**Views:**

- `app/Views/cms/dashboard/index.php` - List dashboard contents
- `app/Views/cms/dashboard/edit.php` - Form edit content

**Routes:**

- `/dashboard-contents` - List content
- `/dashboard-contents/edit/{section}` - Edit content
- `/dashboard-contents/update/{section}` - Update content (POST)

### 3. Update Dashboard View

Setelah instalasi, update file `app/Views/dashboard/index.php` untuk menggunakan data dari database:

```php
// Di controller Dashboard
public function index()
{
    $contentModel = new \App\Models\DashboardContentModel();
    $dashboardData = $contentModel->getDashboardData();

    $data = [
        'title' => 'Dashboard',
        'page' => 'dashboard',
        'user_name' => session()->get('name'),
        'user_role' => session()->get('role'),
        'dashboard_content' => $dashboardData,
        // ... data lainnya
    ];

    return view('dashboard/index', $data);
}
```

Kemudian di view, ganti hardcoded text dengan:

```php
<!-- Info Box -->
<div class="info-box">
    <h4><i class="fas <?= $dashboard_content['info_box']['icon'] ?? 'fa-info-circle' ?>"></i>
        <?= esc($dashboard_content['info_box']['title'] ?? 'Tentang Renstra TMKB Polban') ?>
    </h4>
    <p><?= $dashboard_content['info_box']['content'] ?? '' ?></p>
</div>

<!-- Stat Card 1 -->
<div class="stat-card <?= $dashboard_content['stat_card_1']['color'] ?? 'blue' ?>">
    <div class="stat-icon <?= $dashboard_content['stat_card_1']['color'] ?? 'blue' ?>">
        <i class="fas <?= $dashboard_content['stat_card_1']['icon'] ?? 'fa-chart-line' ?>"></i>
    </div>
    <div class="stat-info">
        <h3><?= esc($dashboard_content['stat_card_1']['value'] ?? '80') ?>%</h3>
        <p><?= esc($dashboard_content['stat_card_1']['title'] ?? 'Target Skor 2028') ?></p>
        <span class="trend <?= $dashboard_content['stat_card_1']['trend_type'] ?? 'target' ?>">
            <?= esc($dashboard_content['stat_card_1']['trend_text'] ?? 'Target: 80%') ?>
        </span>
    </div>
</div>
```

## Cara Menggunakan

### Akses Menu

1. Login sebagai **admin**
2. Di sidebar, klik **"Konten Dashboard"** (di bawah "Konten Landing Page")
3. Akan muncul list semua content yang bisa dikelola

### Edit Content

#### Info Box

- **Title**: Judul info box
- **Content**: Isi lengkap info box
- **Icon**: Icon Font Awesome (contoh: `fa-info-circle`)

#### Stat Cards (stat_card_1 sampai stat_card_4)

- **Title**: Label stat card (contoh: "Target Skor 2028")
- **Value**: Nilai yang ditampilkan (contoh: "80", "500", "#50")
- **Icon**: Icon Font Awesome (contoh: `fa-chart-line`, `fa-trophy`)
- **Color**: Pilih warna (blue, green, orange, purple)
- **Trend Type**: Pilih tipe trend (up, down, target)
- **Trend Text**: Teks trend (contoh: "Target: 80%", "dari #896")

#### Chart Title & Description

- **Title**: Judul chart
- **Subtitle**: Deskripsi chart

#### Top Bar

- **Title**: Judul top bar
- **Subtitle**: Subtitle top bar

### Tips

1. **Icon Font Awesome**: Cari icon di https://fontawesome.com/icons
2. **Value**: Bisa angka atau teks dengan simbol (#, %, dll)
3. **Color**: Pilih warna yang sesuai dengan tema
4. **Order**: Atur urutan tampilan (semakin kecil semakin atas)
5. **Status**: Nonaktifkan jika tidak ingin ditampilkan

## Struktur Database

### Tabel: dashboard_contents

| Field      | Type         | Description                           |
| ---------- | ------------ | ------------------------------------- |
| id         | int          | Primary key                           |
| section    | varchar(50)  | Identifier section (unique)           |
| title      | varchar(255) | Judul/label                           |
| subtitle   | varchar(255) | Subtitle (opsional)                   |
| content    | text         | Konten lengkap                        |
| value      | varchar(100) | Nilai numerik untuk stat card         |
| icon       | varchar(50)  | Class icon Font Awesome               |
| color      | varchar(20)  | Warna tema (blue/green/orange/purple) |
| trend_text | varchar(100) | Teks trend indicator                  |
| trend_type | varchar(20)  | Tipe trend (up/down/target)           |
| order      | int          | Urutan tampilan                       |
| is_active  | tinyint      | Status aktif/nonaktif                 |
| created_at | timestamp    | Waktu dibuat                          |
| updated_at | timestamp    | Waktu diupdate                        |

### Sections Available

- `info_box` - Info box di atas stat cards
- `stat_card_1` - Stat card pertama
- `stat_card_2` - Stat card kedua
- `stat_card_3` - Stat card ketiga
- `stat_card_4` - Stat card keempat
- `chart_title` - Judul chart
- `chart_description` - Deskripsi chart
- `top_bar_title` - Judul top bar
- `top_bar_subtitle` - Subtitle top bar

## Testing

1. Login sebagai admin
2. Buka menu "Konten Dashboard"
3. Edit salah satu content (misalnya stat_card_1)
4. Ubah value dari "80" menjadi "85"
5. Simpan
6. Kembali ke dashboard utama
7. Lihat perubahan di stat card pertama

## Troubleshooting

**Q: Menu "Konten Dashboard" tidak muncul**
A: Pastikan Anda login sebagai admin dan sudah jalankan SQL untuk create table

**Q: Error saat save**
A: Cek apakah tabel `dashboard_contents` sudah dibuat dan semua field ada

**Q: Content tidak berubah di dashboard**
A: Pastikan sudah update Dashboard controller untuk load data dari database

## Next Steps

Setelah sistem ini berjalan, Anda bisa:

1. Tambah section baru sesuai kebutuhan
2. Tambah field custom (misalnya: link, image, dll)
3. Buat preview real-time saat edit
4. Export/import content untuk backup
