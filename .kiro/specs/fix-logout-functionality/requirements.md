# Requirements Document

## Introduction

Sistem logout saat ini mengalami masalah dimana pengguna tidak dapat keluar dari sistem dengan benar. Setelah mengklik tombol logout, pengguna langsung auto-login kembali karena BaseController mengecek cookie remember me pada setiap request, termasuk saat redirect ke halaman login setelah logout. Masalah ini terjadi karena:
1. Proses logout menghapus session dan cookie
2. User di-redirect ke halaman login
3. BaseController::initController() dipanggil dan mengecek cookie remember me
4. Jika cookie belum terhapus sempurna atau masih valid, user langsung auto-login lagi

Fitur ini perlu diperbaiki dengan menambahkan mekanisme untuk menonaktifkan token remember me tanpa menghapusnya dari database. Solusinya adalah menambah kolom `remember_token_active` yang akan di-set ke 0 saat logout, sehingga token tidak bisa digunakan untuk auto-login. Ini memungkinkan user untuk logout dari satu device tanpa mempengaruhi device lain, dan token bisa diaktifkan kembali saat user login lagi.

## Glossary

- **System**: Aplikasi web Kampus Berkelanjutan berbasis CodeIgniter 4
- **User**: Pengguna yang telah login ke dalam sistem (admin, reviewer, staff, dosen, kaprodi)
- **Session**: Data sesi pengguna yang disimpan di server
- **Remember Token**: Token unik yang disimpan di database dan cookie untuk fitur "Remember Me"
- **Token Active Flag**: Flag boolean di database yang menandakan apakah token masih aktif dan bisa digunakan untuk auto-login
- **Cookie**: Data yang disimpan di browser pengguna untuk autentikasi persisten
- **Auth Controller**: Controller yang menangani proses autentikasi termasuk login dan logout
- **Database**: Sistem penyimpanan data MySQL yang menyimpan informasi pengguna dan token

## Requirements

### Requirement 1

**User Story:** As a logged-in user, I want to logout from the system, so that my session is terminated and I can safely leave the application.

#### Acceptance Criteria

1. WHEN a user clicks the logout button THEN the System SHALL set the Token Active Flag to 0 in the Database before clearing cookies
2. WHEN a user logs out THEN the System SHALL clear all remember me cookies from the browser with proper parameters
3. WHEN a user logs out THEN the System SHALL destroy the user's session data completely
4. WHEN a user logs out THEN the System SHALL prevent auto-login from occurring during the logout redirect
5. WHEN a user logs out THEN the System SHALL redirect the user to the login page with a success message

### Requirement 2

**User Story:** As a logged-out user, I want to ensure I cannot access protected pages and cannot be auto-logged-in, so that my account remains secure after logout.

#### Acceptance Criteria

1. WHEN a user has logged out THEN the System SHALL check the Token Active Flag and prevent auto-login if the flag is 0
2. WHEN a user has logged out THEN the System SHALL ensure cookies are completely cleared before any redirect occurs
3. WHEN a logged-out user attempts to access a protected page THEN the System SHALL redirect them to the login page without auto-login
4. WHEN a user logs out and immediately accesses the login page THEN the System SHALL not trigger auto-login from remember me cookies
5. WHEN a user logs out and closes the browser THEN the System SHALL not auto-login the user on next visit

### Requirement 3

**User Story:** As a user with multiple devices, I want to be able to logout from one device without affecting my login status on other devices, so that I can maintain convenience while ensuring security.

#### Acceptance Criteria

1. WHEN a user logs out from one device THEN the System SHALL only deactivate the token without deleting it from the Database
2. WHEN a user logs in again with Remember Me THEN the System SHALL reactivate the existing token by setting Token Active Flag to 1
3. WHEN a user has an active session on another device THEN the System SHALL allow that device to continue using the valid token
4. WHEN a user logs in from a new device with Remember Me THEN the System SHALL generate a new token if none exists

### Requirement 4

**User Story:** As a system administrator, I want the logout functionality to be consistent across all controllers, so that there is no confusion or duplicate code.

#### Acceptance Criteria

1. WHEN the logout route is accessed THEN the System SHALL use a single logout method from one controller
2. WHEN logout is triggered THEN the System SHALL execute the same cleanup process regardless of user role
3. WHEN logout code is maintained THEN the System SHALL have no duplicate logout implementations across controllers
