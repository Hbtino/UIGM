# 📖 Penjelasan Lengkap: Informasi-Contents

## 🎯 **APA ITU INFORMASI-CONTENTS?**

`informasi-contents` adalah halaman admin untuk mengelola **KONTEN INFORMASI DI LANDING PAGE** (bukan dashboard).

### 📍 **Lokasi:**

- **URL Admin**: `/informasi-contents`
- **Menu**: Sidebar → Sistem → Kelola Informasi
- **Tampil di**: Landing Page (home.php) bagian "Informasi"

---

## 🔄 **HUBUNGAN DASHBOARD ↔ LANDING PAGE**

### **Sistem Kerja:**

```
┌─────────────────────┐
│   DASHBOARD         │
│   (Info Box)        │  ← Konten di dashboard
└──────────┬──────────┘
           │
           │ [Tombol Sync]
           ↓
┌─────────────────────┐
│   LANDING PAGE      │
│   (Informasi)       │  ← Konten di landing page
└─────────────────────┘
```

### **2 Tempat Berbeda:**

#### 1️⃣ **Dashboard Info Box** (di dashboard user)

- **Lokasi**: Dashboard → Info Box (kotak hijau di atas)
- **Isi**: Tentang Renstra TMKB Polban
- **Edit di**: `/dashboard-contents` → Edit Info Box

#### 2️⃣ **Landing Page Informasi** (di halaman depan)

- **Lokasi**: Landing Page → Section "Informasi" (paling bawah)
- **Isi**: Alamat, Telepon, Email, Map
- **Edit di**: `/informasi-contents` ← **INI YANG KAMU EDIT**

---

## ✅ **FITUR INFORMASI-CONTENTS**

### **Yang Bisa Diedit:**

1. **Informasi Dasar**

   - ✅ Judul (contoh: "Informasi Kontak")
   - ✅ Subjudul (contoh: "Hubungi Kami")
   - ✅ Deskripsi

2. **Kontak**

   - ✅ Alamat lengkap
   - ✅ Nomor telepon
   - ✅ Email

3. **Peta Lokasi**

   - ✅ Google Maps embed code
   - ✅ Latitude & Longitude
   - ✅ Preview real-time

4. **Sinkronisasi**
   - ✅ Tombol sync dari dashboard info box

---

## 🗺️ **CARA GANTI GOOGLE MAPS**

### **Langkah-langkah:**

#### 1. **Buka Google Maps**

```
https://maps.google.com
```

#### 2. **Cari Lokasi**

- Ketik "Politeknik Negeri Bandung"
- Atau lokasi lain yang diinginkan

#### 3. **Klik Share**

- Klik tombol **"Share"** di sebelah kiri
- Pilih tab **"Embed a map"**

#### 4. **Copy Kode HTML**

```html
<iframe
  src="https://www.google.com/maps/embed?pb=..."
  width="600"
  height="450"
  style="border:0;"
  allowfullscreen=""
  loading="lazy"
>
</iframe>
```

#### 5. **Paste di Form**

- Buka `/informasi-contents`
- Paste kode di field "Embed Code Google Maps"
- Preview akan muncul otomatis

#### 6. **Simpan**

- Klik tombol **"Simpan Perubahan"**
- Map akan update di landing page

---

## 🐛 **TROUBLESHOOTING**

### **Problem 1: Map tidak muncul setelah save**

**Penyebab:**

- Kode embed tidak lengkap
- Tidak ada tag `<iframe>` dan `</iframe>`

**Solusi:**

1. Pastikan copy **SELURUH** kode dari Google Maps
2. Kode harus dimulai dengan `<iframe` dan diakhiri `</iframe>`
3. Jangan edit kode manual

**Contoh Kode yang Benar:**

```html
<iframe
  src="https://www.google.com/maps/embed?pb=!1m18!1m12..."
  width="100%"
  height="300"
  style="border:0;"
  allowfullscreen=""
  loading="lazy"
>
</iframe>
```

### **Problem 2: Preview tidak update**

**Solusi:**

- Refresh halaman admin
- Clear cache browser (Ctrl + F5)
- Cek console browser untuk error

### **Problem 3: Map muncul di admin tapi tidak di landing page**

**Solusi:**

1. Cek database:

```sql
SELECT map_embed FROM landing_contents WHERE section = 'informasi';
```

2. Pastikan data tersimpan
3. Clear cache aplikasi
4. Refresh landing page

---

## 📊 **PERBEDAAN DASHBOARD vs LANDING PAGE**

| Aspek            | Dashboard Info Box    | Landing Page Informasi      |
| ---------------- | --------------------- | --------------------------- |
| **Lokasi**       | Dashboard user        | Landing page (home)         |
| **Konten**       | Tentang Renstra TMKB  | Alamat, Telepon, Email, Map |
| **Edit di**      | `/dashboard-contents` | `/informasi-contents`       |
| **Untuk**        | User yang sudah login | Pengunjung umum             |
| **Sinkronisasi** | Bisa sync → Landing   | Bisa sync ← Dashboard       |

---

## 🎯 **KESIMPULAN**

### **INFORMASI-CONTENTS itu untuk:**

✅ **LANDING PAGE** (halaman depan)  
✅ Edit alamat, telepon, email, map  
✅ Tampil untuk pengunjung umum  
✅ Bisa sync dari dashboard info box

### **BUKAN untuk:**

❌ Dashboard user  
❌ Info box di dashboard  
❌ Konten internal

---

## 📞 **Contoh Penggunaan**

### **Scenario 1: Ganti Alamat Kampus**

1. Login admin
2. Buka `/informasi-contents`
3. Edit field "Alamat"
4. Klik "Simpan Perubahan"
5. Cek landing page → Alamat sudah berubah

### **Scenario 2: Update Google Maps**

1. Buka Google Maps
2. Cari lokasi baru
3. Share → Embed a map → Copy HTML
4. Buka `/informasi-contents`
5. Paste di field "Embed Code"
6. Preview muncul otomatis
7. Klik "Simpan Perubahan"
8. Cek landing page → Map sudah berubah

### **Scenario 3: Sinkronisasi dari Dashboard**

1. Edit info box di dashboard
2. Buka `/informasi-contents`
3. Klik tombol "Sinkronisasi dari Dashboard"
4. Judul & deskripsi akan sama dengan dashboard
5. Alamat, telepon, email, map tetap sama (tidak berubah)

---

**Status**: ✅ **READY TO USE**  
**Version**: 1.0 (Fixed)  
**Last Updated**: December 2024
