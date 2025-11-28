# Debug Session Issue - Step by Step

## 🐛 Problem
Session tetap aktif setelah close browser, meskipun:
- Sudah set `$expiration = 0` di `Session.php`
- Tidak centang "Remember Me"
- Sudah logout

## 🔍 Debugging Steps

### Step 1: Cek Session Config
Akses: `http://localhost:8080/debug-session`

Lihat output:
- **Expiration**: Harus `0` (bukan 7200)
- **Session Cookie Params**: Cek `lifetime` harus `0`
- **Cookies**: Lihat cookie apa saja yang ada

### Step 2: Test Scenario
1. **Login** dengan akun dosen (tanpa Remember Me)
2. **Akses** `/debug-session` - Screenshot hasilnya
3. **Close browser** (tutup semua tab)
4. **Buka browser baru**
5. **Akses** `/debug-session` lagi
6. **Cek**: Apakah masih ada session?

### Step 3: Clear Everything
Akses: `http://localhost:8080/debug-session/clear`

Ini akan:
- Hapus SEMUA cookies
- Destroy session
- Reset semuanya

### Step 4: Kemungkinan Masalah

#### A. Config Tidak Ter-Load
**Solusi**: Clear cache
```bash
php spark cache:clear
```

#### B. Browser Cache Session Cookie
**Solusi**: 
- Buka browser dalam **Incognito/Private mode**
- Atau clear browser cookies manual

#### C. Session Cookie Lifetime Tidak Berubah
**Cek di** `/debug-session`:
```
Session Cookie Params:
  lifetime => 0  // Harus 0, bukan 7200
```

Jika masih 7200, berarti config tidak ter-apply.

**Solusi**:
1. Restart PHP server: `php spark serve`
2. Clear cache: `php spark cache:clear`
3. Cek file `writable/cache/` - hapus semua file

#### D. Ada Session File yang Tersimpan
**Cek folder**: `writable/session/`

Jika ada file session lama, hapus semua:
```bash
# Windows
del /Q writable\session\*

# Linux/Mac
rm -rf writable/session/*
```

### Step 5: Force Session Config via .env

Edit file `.env`, tambahkan:
```env
# Session Configuration
session.driver = CodeIgniter\Session\Handlers\FileHandler
session.cookieName = ci_session
session.expiration = 0
session.savePath = writable/session
```

Restart server setelah edit `.env`.

### Step 6: Alternative - Set Cookie Params Manually

Edit `app/Controllers/Auth.php`, di method `loginProcess()`, setelah set session:

```php
// Force session cookie to expire on browser close
$params = session_get_cookie_params();
session_set_cookie_params(
    0,                    // lifetime = 0 (expire on close)
    $params['path'],
    $params['domain'],
    $params['secure'],
    $params['httponly']
);
```

## 🎯 Expected Results

### Setelah Login TANPA Remember Me:
```
Session Data:
  user_id => 5
  name => Habib
  logged_in => true

Cookies:
  ci_session => abc123...  // Session cookie

Session Cookie Params:
  lifetime => 0  // PENTING: Harus 0!
```

### Setelah Close Browser & Buka Lagi:
```
Session Data:
  (empty)

Cookies:
  (empty atau tidak ada ci_session)
```

## 📝 Tolong Kirim Info Ini:

1. **Screenshot** dari `/debug-session` setelah login
2. **Screenshot** dari `/debug-session` setelah close & buka browser lagi
3. **Nilai** `lifetime` di Session Cookie Params
4. **Apakah** ada file di `writable/session/` setelah close browser?

Dengan info ini saya bisa tahu persis masalahnya di mana!
