# Requirements Document

## Introduction

Sistem memerlukan struktur layout dashboard dengan sidebar yang tetap berada di sisi kiri (fixed sidebar) dan area konten yang dinamis berubah sesuai dengan menu yang diklik oleh pengguna. Layout ini harus mempertahankan skema warna hijau POLBAN yang sudah ada (#149823) dan memberikan pengalaman navigasi yang smooth dan responsif. Semua halaman kriteria SDGs harus menggunakan sidebar layout yang sama seperti dashboard untuk konsistensi navigasi.

## Glossary

- **Fixed Sidebar**: Sidebar yang posisinya tetap (fixed) di sisi kiri layar dan tidak bergerak saat konten di-scroll
- **Main Content Area**: Area konten utama di sebelah kanan sidebar yang menampilkan konten dinamis sesuai menu yang dipilih
- **Topbar**: Bar navigasi horizontal di bagian atas main content yang menampilkan judul halaman dan informasi user
- **Menu Item**: Item navigasi dalam sidebar yang dapat diklik untuk berpindah halaman
- **Submenu**: Menu turunan yang muncul di bawah menu item tertentu
- **Active State**: Status visual yang menunjukkan menu mana yang sedang aktif/dipilih
- **Responsive Layout**: Layout yang menyesuaikan tampilan untuk berbagai ukuran layar (desktop, tablet, mobile)
- **POLBAN Green**: Warna hijau khas POLBAN (#149823)
- **Kriteria SDGs**: Halaman-halaman yang menampilkan kriteria Sustainable Development Goals (Pengaturan & Infrastruktur, Energi & Perubahan Iklim, Pengelolaan Air, Pengelolaan Limbah, Transportasi, Pendidikan & Penelitian)

## Requirements

### Requirement 1

**User Story:** Sebagai pengguna sistem, saya ingin sidebar tetap berada di sisi kiri layar saat saya scroll konten, sehingga saya dapat dengan mudah mengakses menu navigasi kapan saja.

#### Acceptance Criteria

1. WHEN halaman dashboard dimuat THEN sidebar SHALL ditampilkan dengan posisi fixed di sisi kiri layar dengan lebar 280px
2. WHEN pengguna melakukan scroll pada konten utama THEN sidebar SHALL tetap berada di posisi yang sama tanpa bergerak
3. WHEN sidebar ditampilkan THEN sidebar SHALL menggunakan warna hijau POLBAN (#149823) sebagai background color
4. WHEN sidebar memiliki konten yang panjang THEN sidebar SHALL memiliki scrollbar internal untuk navigasi menu
5. WHEN pengguna mengakses dari desktop THEN main content area SHALL memiliki margin-left 280px untuk memberikan ruang bagi sidebar

### Requirement 2

**User Story:** Sebagai pengguna sistem, saya ingin konten dashboard berubah sesuai dengan menu yang saya klik, sehingga saya dapat melihat informasi yang relevan tanpa reload halaman penuh.

#### Acceptance Criteria

1. WHEN pengguna mengklik menu item di sidebar THEN sistem SHALL menavigasi ke halaman yang sesuai dengan menu tersebut
2. WHEN halaman baru dimuat THEN main content area SHALL menampilkan konten yang sesuai dengan menu yang dipilih
3. WHEN navigasi terjadi THEN menu item yang aktif SHALL ditandai dengan visual indicator (background lebih terang dan border kiri putih)
4. WHEN konten berubah THEN topbar SHALL menampilkan judul halaman yang sesuai dengan konten yang ditampilkan
5. WHEN konten berubah THEN breadcrumb di topbar SHALL diperbarui sesuai dengan lokasi halaman saat ini

### Requirement 3

**User Story:** Sebagai pengguna sistem, saya ingin menu dengan submenu dapat dibuka dan ditutup, sehingga saya dapat mengakses menu turunan dengan mudah tanpa membuat sidebar terlalu panjang.

#### Acceptance Criteria

1. WHEN menu item memiliki submenu THEN menu item SHALL menampilkan icon dropdown (chevron-down) di sebelah kanan
2. WHEN pengguna mengklik menu item dengan submenu THEN submenu SHALL ditampilkan atau disembunyikan (toggle)
3. WHEN submenu dibuka THEN icon dropdown SHALL berputar 180 derajat untuk menunjukkan status terbuka
4. WHEN submenu ditampilkan THEN submenu items SHALL memiliki background lebih gelap (rgba(0,0,0,0.2)) dan indentasi lebih dalam
5. WHEN submenu item diklik THEN sistem SHALL menavigasi ke halaman yang sesuai dan menandai submenu item sebagai aktif

### Requirement 4

**User Story:** Sebagai pengguna mobile, saya ingin sidebar dapat disembunyikan dan ditampilkan dengan tombol toggle, sehingga saya memiliki lebih banyak ruang layar untuk melihat konten.

#### Acceptance Criteria

1. WHEN layar memiliki lebar kurang dari atau sama dengan 768px THEN sidebar SHALL disembunyikan ke kiri layar (left: -280px)
2. WHEN sidebar disembunyikan pada mobile THEN tombol toggle floating SHALL ditampilkan di pojok kanan bawah layar
3. WHEN pengguna mengklik tombol toggle pada mobile THEN sidebar SHALL muncul dari kiri dengan animasi smooth
4. WHEN sidebar terbuka pada mobile dan pengguna mengklik area di luar sidebar THEN sidebar SHALL tertutup kembali
5. WHEN layar mobile digunakan THEN main content area SHALL memiliki margin-left 0px untuk menggunakan lebar penuh layar

### Requirement 5

**User Story:** Sebagai pengguna sistem, saya ingin melihat informasi profil saya di topbar, sehingga saya tahu akun mana yang sedang aktif dan dapat mengakses pengaturan profil dengan mudah.

#### Acceptance Criteria

1. WHEN topbar ditampilkan THEN topbar SHALL menampilkan avatar pengguna di sebelah kanan
2. WHEN pengguna memiliki foto profil THEN avatar SHALL menampilkan foto profil pengguna
3. WHEN pengguna tidak memiliki foto profil THEN avatar SHALL menampilkan inisial nama pengguna dengan background hijau POLBAN
4. WHEN topbar ditampilkan THEN topbar SHALL menampilkan nama lengkap pengguna dan role pengguna
5. WHEN topbar ditampilkan THEN topbar SHALL memiliki background putih dengan shadow untuk membedakan dari konten

### Requirement 6

**User Story:** Sebagai pengguna sistem, saya ingin transisi antar halaman dan interaksi menu terasa smooth, sehingga pengalaman menggunakan sistem lebih nyaman dan profesional.

#### Acceptance Criteria

1. WHEN pengguna hover pada menu item THEN menu item SHALL menampilkan efek hover dengan background lebih terang dan padding-left bertambah
2. WHEN submenu dibuka atau ditutup THEN animasi SHALL berjalan dengan durasi 0.3 detik
3. WHEN sidebar dibuka atau ditutup pada mobile THEN transisi SHALL berjalan smooth dengan durasi 0.3 detik
4. WHEN icon dropdown berputar THEN rotasi SHALL menggunakan transition dengan durasi 0.3 detik
5. WHEN user info di topbar di-hover THEN background SHALL berubah dengan transition smooth

### Requirement 7

**User Story:** Sebagai administrator sistem, saya ingin menu yang ditampilkan di sidebar disesuaikan dengan role pengguna, sehingga setiap pengguna hanya melihat menu yang relevan dengan hak aksesnya.

#### Acceptance Criteria

1. WHEN pengguna dengan role admin login THEN sidebar SHALL menampilkan menu "Manajemen User" dengan badge notifikasi jika ada pending users
2. WHEN pengguna dengan role dosen login THEN sidebar SHALL menampilkan submenu "Laporan Dosen" dan "Riwayat Laporan Dosen"
3. WHEN pengguna dengan role kaprodi login THEN sidebar SHALL menampilkan submenu "Laporan Kaprodi" dan "Riwayat Laporan Kaprodi"
4. WHEN pengguna dengan role admin login THEN sidebar SHALL menampilkan semua submenu laporan (dosen dan kaprodi)
5. WHEN menu item tidak sesuai dengan role pengguna THEN menu item tersebut SHALL tidak ditampilkan di sidebar

### Requirement 8

**User Story:** Sebagai pengguna sistem, saya ingin layout tetap konsisten di semua halaman dashboard, sehingga saya tidak bingung saat berpindah antar halaman.

#### Acceptance Criteria

1. WHEN halaman dashboard menggunakan sidebar layout THEN halaman SHALL extend dari template "layouts/sidebar_layout.php"
2. WHEN konten halaman didefinisikan THEN konten SHALL ditempatkan dalam section "content"
3. WHEN halaman memerlukan CSS tambahan THEN CSS SHALL ditempatkan dalam section "styles"
4. WHEN halaman memerlukan JavaScript tambahan THEN JavaScript SHALL ditempatkan dalam section "scripts"
5. WHEN variabel $page dikirim ke view THEN sistem SHALL menggunakan variabel tersebut untuk menentukan menu item yang aktif

### Requirement 9

**User Story:** Sebagai pengguna sistem, saya ingin semua halaman kriteria SDGs menggunakan sidebar layout yang sama seperti dashboard, sehingga navigasi konsisten di seluruh aplikasi.

#### Acceptance Criteria

1. WHEN pengguna mengakses halaman "Pengaturan & Infrastruktur" THEN halaman SHALL menggunakan sidebar layout dengan menu "setting-infrastructure" ditandai sebagai aktif
2. WHEN pengguna mengakses halaman "Energi & Perubahan Iklim" THEN halaman SHALL menggunakan sidebar layout dengan menu "energy-climate" ditandai sebagai aktif
3. WHEN pengguna mengakses halaman "Pengelolaan Air" THEN halaman SHALL menggunakan sidebar layout dengan menu "water-management" ditandai sebagai aktif
4. WHEN pengguna mengakses halaman "Pengelolaan Limbah" THEN halaman SHALL menggunakan sidebar layout dengan menu "waste-management" ditandai sebagai aktif
5. WHEN pengguna mengakses halaman "Transportasi" THEN halaman SHALL menggunakan sidebar layout dengan menu "transportation" ditandai sebagai aktif
6. WHEN pengguna mengakses halaman "Pendidikan & Penelitian" THEN halaman SHALL menggunakan sidebar layout dengan menu "education-research" ditandai sebagai aktif
7. WHEN halaman kriteria SDGs ditampilkan THEN sidebar SHALL tetap menampilkan semua menu navigasi dengan warna dan style yang sama
8. WHEN pengguna berpindah dari dashboard ke halaman kriteria SDGs THEN transisi SHALL smooth tanpa perubahan layout sidebar
