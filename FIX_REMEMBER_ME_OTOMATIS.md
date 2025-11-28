# Fix Remember Me Issue - OTOMATIS

## Masalah

User yang login tanpa mencentang "Remember Me" tetap otomatis login ketika membuka website di tab baru, padahal seharusnya diarahkan ke halaman login.

## Penyebab

1. Cookie remember me tidak dihapus saat login tanpa remember me
2. Session cookie tidak expire saat browser ditutup
3. `BaseController::checkRememberMe()` selalu mengecek cookie dan auto-login jika valid
4. Token remember me tidak di-deactivate dengan benar

## Perbaikan

### 1. Auth.php - loginProcess()

- **OTOMATIS set session cookie lifetime = 0** jika tidak remember me
- Tambah `ini_set('session.cookie_lifetime', '0')` dan `session_set_cookie_params(0)`
- Hapus cookie dan deactivate token jika user TIDAK mencentang remember me
- Session akan otomatis expire saat browser ditutup

### 2. Auth.php - logout()

- Hapus token dari database (set ke null)
- Pastikan semua cookie dihapus dengan benar

### 3. BaseController.php - checkRememberMe()

- Tambah validasi `remember_token_active` harus = 1
- Tambah method `deactivateRememberToken()` untuk cleanup database
- Perbaiki validasi yang lebih ketat

### 4. Config/Session.php

- Set `expiration = 0` (session expire saat browser close)

## Cara Kerja Otomatis

1. **Login TANPA Remember Me:**

   - Session cookie lifetime = 0
   - Session expire otomatis saat browser ditutup
   - Tidak perlu manual clear session

2. **Login DENGAN Remember Me:**
   - Session cookie lifetime = 0 (tetap expire saat browser close)
   - Remember token cookie = 30 hari
   - Auto-login via remember token di BaseController

## Testing

1. Login tanpa centang "Remember Me"
2. Close browser (tutup semua tab)
3. Buka browser lagi dan akses website
4. Harus diarahkan ke halaman login (bukan dashboard)

## File Debug (Opsional)

- `public/debug-session.php` - untuk melihat status session dan cookie
- `public/clear-all-sessions.php` - untuk membersihkan semua session dan token (hanya untuk testing awal)

## Perubahan Kode

- ✅ `app/Controllers/Auth.php` - loginProcess() dengan auto session lifetime
- ✅ `app/Controllers/Auth.php` - logout()
- ✅ `app/Controllers/BaseController.php` - checkRememberMe() dan method baru
- ✅ `app/Config/Session.php` - expiration = 0
