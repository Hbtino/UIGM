# 📊 Cara Edit Statistik Dashboard

## 📍 Lokasi Menu

### Login sebagai Admin

Pastikan Anda login dengan role **admin**

### Buka Menu di Sidebar

```
⚙️ Sistem
  ├─ Manajemen User
  ├─ Manajemen Menu
  ├─ Manajemen Berita
  ├─ Konten Landing Page
  ├─ Konten Dashboard
  ├─ 📊 Statistik Dashboard  ← KLIK INI!
  └─ Pengaturan
```

### URL Langsung

```
http://localhost:8080/dashboard-statistics
```

---

## 📋 Statistik yang Bisa Diedit

Setelah klik menu, Anda akan melihat **14 statistik**:

| No  | Label                      | Value  | Category    | Aksi   |
| --- | -------------------------- | ------ | ----------- | ------ |
| 1   | Target Skor 2028           | 80     | target      | [Edit] |
| 2   | Target Ranking Dunia       | 176    | target      | [Edit] |
| 3   | Target Ranking Indonesia   | 26     | target      | [Edit] |
| 4   | Ranking Dunia Saat Ini     | 896    | current     | [Edit] |
| 5   | Ranking Indonesia Saat Ini | 87     | current     | [Edit] |
| 6   | Jumlah Mahasiswa           | 6605   | campus_info | [Edit] |
| 7   | Jumlah Dosen               | 482    | campus_info | [Edit] |
| 8   | Jumlah Jurusan             | 10     | campus_info | [Edit] |
| 9   | Jumlah Program Studi       | 39     | campus_info | [Edit] |
| 10  | Luas Kampus (m²)           | 246269 | campus_info | [Edit] |
| 11  | Luas Bangunan (m²)         | 93435  | campus_info | [Edit] |
| 12  | Jumlah Bangunan            | 86     | campus_info | [Edit] |
| 13  | Jumlah Kelas               | 105    | campus_info | [Edit] |
| 14  | Jumlah Laboratorium        | 119    | campus_info | [Edit] |

---

## ✏️ Cara Edit Statistik

### Step 1: Klik Tombol Edit

Klik tombol **[Edit]** di baris statistik yang ingin diubah

### Step 2: Form Edit Muncul

Anda akan melihat form dengan field:

- **Label** - Nama statistik
- **Value** - Nilai (angka yang ditampilkan)
- **Description** - Deskripsi statistik
- **Type** - Tipe (static/calculated/target)
- **Category** - Kategori (target/current/campus_info)
- **Order** - Urutan
- **Status** - Aktif/Nonaktif

### Step 3: Ubah Value

Ubah field **Value** dengan angka baru

### Step 4: Simpan

Klik tombol **"Simpan Perubahan"**

### Step 5: Lihat Hasil

- Kembali ke Dashboard
- Refresh (Ctrl+F5)
- Nilai akan berubah!

---

## 🎯 Contoh: Edit Target Skor 2028

**Skenario:** Ubah target skor dari 80% menjadi 85%

**Langkah:**

1. Login sebagai admin
2. Sidebar → Sistem → **Statistik Dashboard**
3. Cari baris "Target Skor 2028"
4. Klik **[Edit]**
5. Ubah **Value** dari "80" menjadi "85"
6. Klik **Simpan Perubahan**
7. Buka Dashboard
8. Refresh - stat card pertama akan menunjukkan 85%!

---

## 🎯 Contoh: Edit Jumlah Mahasiswa

**Skenario:** Update jumlah mahasiswa dari 6605 menjadi 7000

**Langkah:**

1. Login sebagai admin
2. Sidebar → Sistem → **Statistik Dashboard**
3. Cari baris "Jumlah Mahasiswa"
4. Klik **[Edit]**
5. Ubah **Value** dari "6605" menjadi "7000"
6. Klik **Simpan Perubahan**
7. Selesai!

---

## 📊 Perbedaan dengan Konten Dashboard

### Konten Dashboard

- Edit **tampilan** dashboard (info box, stat cards, chart title)
- Edit **text, icon, warna**
- 9 content

### Statistik Dashboard

- Edit **nilai/angka** yang ditampilkan
- Edit **target, ranking, jumlah mahasiswa, dll**
- 14 statistik

---

## 🔄 Statistik Real-time vs Static

### Real-time (Otomatis Hitung)

Tidak perlu edit, otomatis update:

- ✅ Total data entries
- ✅ Approved data
- ✅ Pending data
- ✅ Score percentage
- ✅ Breakdown per kriteria
- ✅ User statistics

### Static (Perlu Edit Manual)

Harus edit via menu ini:

- ✏️ Target skor 2028
- ✏️ Target ranking dunia
- ✏️ Target ranking Indonesia
- ✏️ Ranking saat ini
- ✏️ Jumlah mahasiswa
- ✏️ Jumlah dosen
- ✏️ Luas kampus
- ✏️ dll

---

## ⚠️ Catatan Penting

**Menu ini hanya muncul jika:**

- ✅ Login sebagai **admin**
- ✅ SQL `CREATE_DASHBOARD_STATISTICS_TABLE.sql` sudah dijalankan
- ✅ Tabel `dashboard_statistics` sudah ada

**Jika menu tidak muncul:**

1. Pastikan login sebagai admin
2. Cek apakah SQL sudah dijalankan
3. Refresh halaman (Ctrl+F5)

---

## 🎉 Summary

**2 Menu untuk Manage Dashboard:**

1. **Konten Dashboard** (`/dashboard-contents`)

   - Edit tampilan (text, icon, warna)
   - 9 content

2. **Statistik Dashboard** (`/dashboard-statistics`)
   - Edit nilai/angka
   - 14 statistik

**Keduanya bisa diakses via:**
Sidebar → Sistem → Pilih menu yang sesuai

---

**Sekarang Anda bisa edit semua aspek dashboard tanpa perlu edit code!** 🚀
