# 🎯 Panduan Akses Flowchart Sistem Role Dashboard UIGM

## 📋 Cara Mengakses Flowchart

### 1. Melalui Dashboard (Untuk Admin)

- Login ke sistem sebagai **Admin**
- Di sidebar kiri, cari menu **"Flowchart Sistem Role"**
- Klik menu tersebut untuk membuka flowchart di tab baru

### 2. Akses Langsung via URL

```
https://your-domain.com/flowchart
```

### 3. Akses File HTML Statis

```
https://your-domain.com/public/flowchart.html
```

## 🎨 Fitur Flowchart

### ✅ 8 Flowchart Interaktif:

1. **Sistem Utama** - Overview role-based dashboard system
2. **Admin Pusat** - Workflow kontrol & monitoring
3. **Admin Unit** - Workflow input & update data (Sarpras/Umum/LPPM)
4. **Kaprodi** - Workflow review data dosen
5. **Dosen** - Workflow input data pribadi ED
6. **Pimpinan** - Workflow monitoring read-only
7. **User/Staff** - Workflow dashboard read-only
8. **Authentication** - Sistem autentikasi & otorisasi

### ✅ Fitur Interaktif:

- **Tab Navigation** - Beralih antar flowchart dengan mudah
- **Loading Animation** - Smooth loading untuk setiap chart
- **Download PNG** - Export flowchart sebagai gambar
- **Responsive Design** - Bekerja di desktop dan mobile
- **Mermaid.js Integration** - Rendering flowchart yang smooth
- **Bootstrap UI** - Interface yang modern dan user-friendly

### ✅ Keterangan Lengkap:

- **Legend** dengan penjelasan singkatan (SI, EC, WS, WR, TR, ED, UIGM, KPI)
- **Color-coded** berdasarkan role dan fungsi
- **Interactive elements** dengan hover effects
- **Professional styling** sesuai branding Polban

## 🔧 Technical Details

### File Structure:

```
public/flowchart.html          # File HTML statis (akses langsung)
app/Views/flowchart.php        # View file CodeIgniter
app/Config/Routes.php          # Route configuration
app/Views/layouts/sidebar_layout.php  # Menu link integration
```

### Dependencies:

- **Mermaid.js v10.6.1** - Flowchart rendering
- **Bootstrap 5.3.0** - UI framework
- **Font Awesome 6.4.0** - Icons
- **Custom CSS** - Styling dan animations

### Browser Support:

- ✅ Chrome/Edge (Recommended)
- ✅ Firefox
- ✅ Safari
- ✅ Mobile browsers

## 📱 Mobile Responsive

Flowchart telah dioptimalkan untuk:

- **Desktop** - Full experience dengan semua fitur
- **Tablet** - Responsive layout dengan navigation yang mudah
- **Mobile** - Compact view dengan touch-friendly controls

## 🎯 Use Cases

### 1. **Presentasi Stakeholder**

- Download PNG untuk slide presentasi
- Tampilkan workflow sistem kepada pimpinan
- Dokumentasi untuk audit atau review

### 2. **Training & Onboarding**

- Panduan untuk user baru
- Penjelasan alur kerja per role
- Reference guide untuk tim development

### 3. **Documentation**

- Technical documentation
- System architecture overview
- Process flow documentation

### 4. **Development Reference**

- Guide untuk developer baru
- Understanding system flow
- Role-based access control reference

## 🚀 Quick Start

1. **Buka browser** dan akses URL flowchart
2. **Pilih tab** sesuai role yang ingin dipelajari
3. **Tunggu loading** chart selesai (beberapa detik)
4. **Explore** flowchart dengan scroll dan zoom
5. **Download** jika diperlukan untuk presentasi

## 💡 Tips Penggunaan

### Untuk Presentasi:

- Gunakan **fullscreen mode** (F11) untuk tampilan maksimal
- **Download PNG** untuk slide yang lebih profesional
- Mulai dari **"Sistem Utama"** untuk overview

### Untuk Training:

- Ikuti urutan: **Authentication → Sistem Utama → Role Specific**
- Gunakan **legend** untuk menjelaskan singkatan
- **Interactive navigation** memudahkan switching antar role

### Untuk Development:

- Fokus pada **Authentication flow** untuk understanding security
- **Role-specific workflows** untuk feature development
- **Cross-reference** dengan actual code implementation

## 🎉 Kesimpulan

Flowchart sistem role dashboard UIGM telah berhasil dibuat dengan:

✅ **8 flowchart lengkap** untuk semua role
✅ **Interactive web interface** yang user-friendly  
✅ **Professional styling** sesuai branding
✅ **Multiple access methods** (dashboard menu, direct URL, static file)
✅ **Mobile responsive** untuk akses di mana saja
✅ **Download functionality** untuk presentasi
✅ **Comprehensive documentation** untuk semua use cases

**Flowchart ini siap digunakan untuk presentasi, training, documentation, dan development reference!** 🚀

---

**Akses Sekarang**: [/flowchart](./flowchart) | **File Statis**: [/public/flowchart.html](./public/flowchart.html)
