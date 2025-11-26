# Implementation Plan - Fixed Sidebar Layout

- [x] 1. Update sidebar_layout.php template dengan struktur yang konsisten


  - Pastikan sidebar memiliki CSS properties yang benar (position: fixed, width: 280px, background: #149823)
  - Pastikan main content area memiliki margin-left yang responsive
  - Pastikan topbar memiliki styling yang benar (sticky, white background, shadow)
  - Pastikan mobile toggle button dan responsive behavior berfungsi
  - _Requirements: 1.1, 1.2, 1.3, 1.4, 1.5, 4.1, 4.2, 4.3, 4.4, 4.5, 5.5_

- [ ] 2. Update Dashboard controller dan view untuk menggunakan sidebar layout
  - Modifikasi Dashboard controller untuk mengirim data yang diperlukan (title, page, breadcrumb, user info)
  - Update dashboard/index.php view untuk extend dari sidebar_layout.php
  - Pastikan page identifier 'dashboard' digunakan untuk active menu
  - _Requirements: 2.1, 2.2, 2.3, 2.4, 2.5, 8.1, 8.2, 8.5_



- [ ] 3. Update semua SDGs criteria controllers dan views untuk menggunakan sidebar layout
  - **PENTING**: Semua halaman kriteria SDGs saat ini menggunakan `layouts/main` (navbar horizontal)
  - **TUJUAN**: Ubah semua halaman kriteria SDGs untuk menggunakan `layouts/sidebar_layout` (sidebar fixed di kiri)
  - **HASIL**: Sidebar dengan menu "Menu Utama", "Kriteria SDGs", dan "Sistem" akan muncul di semua halaman kriteria SDGs


  - **KONTEN**: Konten halaman tetap sama, hanya wrapper layout yang berubah
- [ ] 3.1 Update SettingInfrastructureController dan view
  - Update SettingInfrastructureController method index() untuk mengirim data lengkap (title, page: 'setting-infrastructure', breadcrumb, user_name, user_role, profile_photo)
  - Ubah view kriteria/setting_infrastructure/index.php dari extend 'layouts/main' menjadi extend 'layouts/sidebar_layout'
  - Pastikan konten tetap sama, hanya layout wrapper yang berubah


  - Verifikasi sidebar muncul dengan menu "Pengaturan & Infrastruktur" ditandai aktif
  - _Requirements: 9.1_

- [ ] 3.2 Update EnergyClimateController dan view
  - Update EnergyClimateController method index() untuk mengirim data lengkap (title, page: 'energy-climate', breadcrumb, user_name, user_role, profile_photo)


  - Ubah view kriteria/energy_climate/index.php dari extend 'layouts/main' menjadi extend 'layouts/sidebar_layout'
  - Pastikan konten tetap sama, hanya layout wrapper yang berubah
  - Verifikasi sidebar muncul dengan menu "Energi & Perubahan Iklim" ditandai aktif
  - _Requirements: 9.2_



- [ ] 3.3 Update WaterManagementController dan view
  - Update WaterManagementController method index() untuk mengirim data lengkap (title, page: 'water-management', breadcrumb, user_name, user_role, profile_photo)
  - Ubah view kriteria/water_management/index.php dari extend 'layouts/main' menjadi extend 'layouts/sidebar_layout'
  - Pastikan konten tetap sama, hanya layout wrapper yang berubah
  - Verifikasi sidebar muncul dengan menu "Pengelolaan Air" ditandai aktif


  - _Requirements: 9.3_

- [ ] 3.4 Update WasteManagementController dan view
  - Update WasteManagementController method index() untuk mengirim data lengkap (title, page: 'waste-management', breadcrumb, user_name, user_role, profile_photo)
  - Ubah view kriteria/waste_management/index.php dari extend 'layouts/main' menjadi extend 'layouts/sidebar_layout'


  - Pastikan konten tetap sama, hanya layout wrapper yang berubah
  - Verifikasi sidebar muncul dengan menu "Pengelolaan Limbah" ditandai aktif
  - _Requirements: 9.4_

- [ ] 3.5 Update TransportationController dan view
  - Update TransportationController method index() untuk mengirim data lengkap (title, page: 'transportation', breadcrumb, user_name, user_role, profile_photo)
  - Ubah view kriteria/transportation/index.php dari extend 'layouts/main' menjadi extend 'layouts/sidebar_layout'
  - Pastikan konten tetap sama, hanya layout wrapper yang berubah
  - Verifikasi sidebar muncul dengan menu "Transportasi" ditandai aktif
  - _Requirements: 9.5_

- [ ] 3.6 Update EducationResearchController dan view
  - Update EducationResearchController method index() untuk mengirim data lengkap (title, page: 'education-research', breadcrumb, user_name, user_role, profile_photo)
  - Ubah view kriteria/education_research/index.php dari extend 'layouts/main' menjadi extend 'layouts/sidebar_layout'
  - Pastikan konten tetap sama, hanya layout wrapper yang berubah
  - Verifikasi sidebar muncul dengan menu "Pendidikan & Penelitian" ditandai aktif
  - _Requirements: 9.6_

- [ ] 4. Implementasi role-based menu visibility di sidebar
  - Update sidebar_layout.php untuk menampilkan menu berdasarkan user_role
  - Admin: tampilkan semua menu termasuk "Manajemen User" dengan badge
  - Dosen: tampilkan submenu "Laporan Dosen" dan "Riwayat Laporan Dosen"
  - Kaprodi: tampilkan submenu "Laporan Kaprodi" dan "Riwayat Laporan Kaprodi"
  - _Requirements: 7.1, 7.2, 7.3, 7.4, 7.5_

- [ ] 5. Implementasi submenu toggle functionality
  - Pastikan menu item dengan submenu menampilkan icon chevron-down
  - Implementasi JavaScript toggleSubmenu() untuk toggle visibility
  - Pastikan icon berputar 180 derajat saat submenu dibuka
  - Pastikan submenu memiliki styling yang benar (background gelap, indentasi)
  - _Requirements: 3.1, 3.2, 3.3, 3.4, 3.5_

- [ ] 6. Implementasi user avatar display logic di topbar
  - Jika profile_photo ada, tampilkan foto profil
  - Jika profile_photo null, tampilkan inisial nama dengan background hijau POLBAN
  - Pastikan topbar menampilkan user_name dan user_role
  - _Requirements: 5.1, 5.2, 5.3, 5.4_

- [ ] 7. Test semua halaman SDGs untuk memastikan konsistensi sidebar
  - Akses setiap halaman SDGs (Pengaturan & Infrastruktur, Energi & Perubahan Iklim, Pengelolaan Air, Pengelolaan Limbah, Transportasi, Pendidikan & Penelitian)
  - Verifikasi sidebar tetap sama seperti di dashboard (tidak berubah struktur, warna, atau menu)
  - Verifikasi hanya menu yang sesuai ditandai sebagai aktif (highlight dengan border kiri putih)
  - Verifikasi topbar menampilkan title dan breadcrumb yang benar untuk setiap halaman
  - Verifikasi konten area menampilkan konten yang sesuai dengan halaman yang dipilih
  - Verifikasi responsive behavior di mobile (sidebar dapat di-toggle)
  - Verifikasi transisi antar halaman smooth tanpa perubahan layout sidebar
  - _Requirements: 9.7, 9.8_

- [ ] 8. Checkpoint - Pastikan semua halaman menggunakan sidebar layout dengan benar
  - Ensure all tests pass, ask the user if questions arise.

- [ ] 9. Setup property-based testing dengan PHPUnit dan Eris
  - Install Eris library via composer
  - Buat base test class untuk property-based tests
  - Setup test configuration untuk minimum 100 iterations
  - _Requirements: All_

- [ ] 9.1 Write property test untuk sidebar styling
  - **Property 1: Sidebar fixed positioning and styling**
  - **Validates: Requirements 1.1, 1.2, 1.3, 1.4**

- [ ] 9.2 Write property test untuk responsive margin
  - **Property 2: Main content responsive margin**
  - **Validates: Requirements 1.5, 4.5**

- [ ] 9.3 Write property test untuk menu navigation
  - **Property 3: Menu navigation functionality**
  - **Validates: Requirements 2.1**

- [ ] 9.4 Write property test untuk content display
  - **Property 4: Content display matches route**
  - **Validates: Requirements 2.2**

- [ ] 9.5 Write property test untuk active menu highlighting
  - **Property 5: Active menu highlighting**
  - **Validates: Requirements 2.3, 8.5**

- [ ] 9.6 Write property test untuk topbar title dan breadcrumb
  - **Property 6: Topbar title and breadcrumb accuracy**
  - **Validates: Requirements 2.4, 2.5**

- [ ] 9.7 Write property test untuk submenu structure
  - **Property 7: Submenu structure and toggle behavior**
  - **Validates: Requirements 3.1, 3.2, 3.3**

- [ ] 9.8 Write property test untuk submenu styling
  - **Property 8: Submenu styling**
  - **Validates: Requirements 3.4**

- [ ] 9.9 Write property test untuk submenu navigation
  - **Property 9: Submenu navigation and active state**
  - **Validates: Requirements 3.5**

- [ ] 9.10 Write property test untuk mobile sidebar visibility
  - **Property 10: Mobile sidebar visibility**
  - **Validates: Requirements 4.1, 4.2**

- [ ] 9.11 Write property test untuk mobile sidebar toggle
  - **Property 11: Mobile sidebar toggle**
  - **Validates: Requirements 4.3**

- [ ] 9.12 Write property test untuk user avatar display
  - **Property 12: User avatar display logic**
  - **Validates: Requirements 5.2, 5.3**

- [ ] 9.13 Write property test untuk topbar user information
  - **Property 13: Topbar user information display**
  - **Validates: Requirements 5.1, 5.4**

- [ ] 9.14 Write property test untuk topbar styling
  - **Property 14: Topbar styling**
  - **Validates: Requirements 5.5**

- [ ] 9.15 Write property test untuk role-based menu visibility
  - **Property 15: Role-based menu visibility**
  - **Validates: Requirements 7.1, 7.2, 7.3, 7.4, 7.5**

- [ ] 9.16 Write property test untuk SDGs pages consistency
  - **Property 16: SDGs pages use sidebar layout consistently**
  - **Validates: Requirements 9.1, 9.2, 9.3, 9.4, 9.5, 9.6, 9.7**

- [ ] 10. Write unit tests untuk edge cases
  - Test template rendering dengan minimal data
  - Test template rendering dengan missing optional data
  - Test active menu logic dengan invalid page identifier
  - Test role-based menu dengan unknown role
  - Test avatar display dengan empty user name
  - _Requirements: All_

- [ ] 11. Final Checkpoint - Pastikan semua tests passing
  - Ensure all tests pass, ask the user if questions arise.
