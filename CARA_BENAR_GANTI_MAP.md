# 🗺️ Cara Benar Ganti Google Maps

## ⚠️ **MASALAH UMUM:**

### ❌ **SALAH - Jangan Copy dari Street View!**

Gambar yang kamu tunjukkan (gambar 1) adalah **Street View** (tampilan jalan).  
Street View **TIDAK BISA** di-embed ke website!

### ✅ **BENAR - Copy dari Tampilan Peta Biasa**

Yang bisa di-embed adalah **tampilan peta biasa** (tampilan dari atas).

---

## 📖 **LANGKAH-LANGKAH YANG BENAR:**

### **1. Buka Google Maps**

```
https://maps.google.com
```

### **2. Cari Lokasi**

- Ketik nama lokasi (contoh: "Politeknik Negeri Bandung")
- Atau ketik alamat lengkap

### **3. PENTING: Pastikan di Tampilan Peta Biasa**

```
❌ JANGAN: Masuk ke Street View (tampilan jalan)
✅ HARUS: Tetap di tampilan peta (tampilan dari atas)
```

**Cara cek:**

- Jika kamu lihat **jalan/bangunan dari depan** = Street View ❌
- Jika kamu lihat **peta dari atas** = Tampilan Peta ✅

### **4. Klik Tombol "Share" (Berbagi)**

- Tombol ada di sebelah kiri layar
- Atau klik kanan pada pin lokasi → pilih "Share"

### **5. Pilih Tab "Embed a map"**

- Akan ada 2 tab: "Send a link" dan "Embed a map"
- **Pilih "Embed a map"**

### **6. Copy Kode HTML**

- Klik tombol **"COPY HTML"**
- Kode akan otomatis tercopy

**Contoh kode yang benar:**

```html
<iframe
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961..."
  width="600"
  height="450"
  style="border:0;"
  allowfullscreen=""
  loading="lazy"
  referrerpolicy="no-referrer-when-downgrade"
>
</iframe>
```

### **7. Paste di Form Admin**

- Login admin
- Buka `/informasi-contents`
- Paste kode di field "Embed Code Google Maps"
- Preview akan muncul otomatis

### **8. Simpan**

- Klik "Simpan Perubahan"
- Cek landing page → Map sudah berubah

---

## 🔍 **CARA MEMBEDAKAN:**

### **Street View (SALAH ❌)**

```
Ciri-ciri:
- Tampilan jalan dari depan
- Ada tombol navigasi panah
- Ada nama jalan di pojok kiri atas
- Terlihat seperti foto 360°
```

### **Tampilan Peta (BENAR ✅)**

```
Ciri-ciri:
- Tampilan dari atas (bird's eye view)
- Ada pin merah di lokasi
- Ada nama tempat
- Terlihat seperti peta biasa
```

---

## 🐛 **TROUBLESHOOTING:**

### **Problem: Preview tidak muncul**

**Penyebab:**

- Kode tidak lengkap
- Copy dari Street View
- Tidak ada tag `<iframe>` dan `</iframe>`

**Solusi:**

1. Pastikan kamu di tampilan peta biasa (BUKAN Street View)
2. Copy ulang kode dari Google Maps
3. Pastikan kode dimulai dengan `<iframe` dan diakhiri `</iframe>`

### **Problem: Map tersimpan tapi tidak muncul di landing page**

**Solusi:**

1. Clear cache browser (Ctrl + F5)
2. Cek database:

```sql
SELECT map_embed FROM landing_contents WHERE section = 'informasi';
```

3. Pastikan kode tersimpan dengan benar
4. Refresh landing page

### **Problem: Error "Invalid embed code"**

**Solusi:**

- Jangan edit kode manual
- Copy ulang dari Google Maps
- Pastikan tidak ada karakter tambahan

---

## ✅ **CHECKLIST:**

Sebelum save, pastikan:

- [ ] Kode dimulai dengan `<iframe`
- [ ] Kode diakhiri dengan `</iframe>`
- [ ] Ada `src="https://www.google.com/maps/embed..."`
- [ ] Preview muncul di admin panel
- [ ] Bukan dari Street View

---

## 📞 **Contoh Kasus:**

### **Kasus 1: Ganti ke Lokasi Polban**

```
1. Buka Google Maps
2. Cari "Politeknik Negeri Bandung"
3. Pastikan tampilan peta (BUKAN Street View)
4. Klik Share → Embed a map
5. Copy HTML
6. Paste di admin
7. Save
```

### **Kasus 2: Ganti ke Lokasi Lain**

```
1. Buka Google Maps
2. Cari lokasi baru
3. Pastikan tampilan peta (BUKAN Street View)
4. Klik Share → Embed a map
5. Copy HTML
6. Paste di admin
7. Save
```

---

## 🎯 **KESIMPULAN:**

### **YANG BENAR:**

✅ Tampilan peta dari atas  
✅ Ada pin merah  
✅ Klik Share → Embed a map  
✅ Copy HTML lengkap

### **YANG SALAH:**

❌ Street View (tampilan jalan)  
❌ Copy link biasa  
❌ Edit kode manual  
❌ Kode tidak lengkap

---

**Jika masih error, screenshot dan tunjukkan:**

1. Tampilan Google Maps yang kamu lihat
2. Kode yang kamu copy
3. Error message yang muncul
