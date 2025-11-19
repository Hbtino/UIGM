# Fix Admin Login - Bypass Approval Check

## 🐛 Masalah

**Error:** Admin tidak bisa login, selalu muncul pesan "Menunggu persetujuan admin"

**Penyebab:** 
- Logika login mengecek `approval_status` untuk **semua user** termasuk admin
- Admin di database memiliki `approval_status = 'pending'` atau `NULL`
- Sistem memblokir admin karena dianggap pending

---

## ✅ Solusi yang Diterapkan

### Logika Baru: Admin & Reviewer Bypass Approval Check

**Perubahan di `Auth.php`:**

```php
// Admin and Reviewer can ALWAYS login (bypass approval check)
$bypassRoles = ['admin', 'reviewer'];

// Check approval status ONLY for non-admin/reviewer users
if (!in_array($user['role'], $bypassRoles)) {
    // Cek approval status
}
```

**Penjelasan:**
1. **Admin** → Langsung bisa login (tidak dicek approval)
2. **Reviewer** → Langsung bisa login (tidak dicek approval)
3. **User lain** (kaprodi, dosen, dll) → Dicek approval status

---

## 🔄 Workflow Login Baru

### Admin/Reviewer Login:
```
Login → Check password → ✅ Login berhasil
(TIDAK CEK approval_status)
```

### User Biasa Login:
```
Login → Check password → Check approval_status
    ↓
[Status?]
├─ approved → ✅ Login berhasil
├─ pending  → ❌ "Menunggu persetujuan admin"
└─ rejected → ❌ "Akun ditolak: [alasan]"
```

---

## 🎯 Keuntungan Solusi Ini

### 1. **Admin Selalu Bisa Login**
- Tidak perlu update database
- Tidak terpengaruh approval_status
- Tidak perlu SQL query

### 2. **Backward Compatible**
- Admin lama tetap bisa login
- Admin baru langsung bisa login
- Tidak perlu migrasi data

### 3. **Flexible**
- Bisa tambah role lain ke bypass list
- Mudah maintain
- Clear logic

### 4. **Security Tetap Terjaga**
- User biasa tetap harus diapprove
- Admin kontrol penuh
- Audit trail lengkap

---

## 📊 Role-Based Login Rules

| Role | Cek Approval? | Bisa Login? |
|------|---------------|-------------|
| **admin** | ❌ Tidak | ✅ Selalu |
| **reviewer** | ❌ Tidak | ✅ Selalu |
| kaprodi | ✅ Ya | Tergantung status |
| dosen | ✅ Ya | Tergantung status |
| user | ✅ Ya | Tergantung status |

---

## 🧪 Testing

### Test 1: Admin Login
```
1. Login dengan akun admin
2. Password benar
3. ✅ Langsung masuk dashboard
4. TIDAK ada pesan "menunggu persetujuan"
```

### Test 2: Reviewer Login
```
1. Login dengan akun reviewer
2. Password benar
3. ✅ Langsung masuk dashboard
4. TIDAK ada pesan "menunggu persetujuan"
```

### Test 3: User Baru (Pending)
```
1. Register akun baru (role: kaprodi)
2. Try login
3. ❌ Blocked: "Menunggu persetujuan admin"
4. Admin approve
5. Try login lagi
6. ✅ Login berhasil
```

### Test 4: User Rejected
```
1. Admin reject user dengan alasan
2. User try login
3. ❌ Blocked: "Akun ditolak: [alasan]"
```

---

## 🔧 Code Changes

### File: `app/Controllers/Auth.php`

**Before:**
```php
if (isset($user['approval_status'])) {
    if ($user['approval_status'] == 'pending') {
        // Block ALL users including admin
    }
}
```

**After:**
```php
$bypassRoles = ['admin', 'reviewer'];

if (!in_array($user['role'], $bypassRoles)) {
    if (isset($user['approval_status'])) {
        if ($user['approval_status'] == 'pending') {
            // Block only non-admin/reviewer users
        }
    }
}
```

---

## 💡 Menambah Role Bypass

Jika ingin role lain juga bypass approval check:

```php
// Tambahkan role ke array
$bypassRoles = ['admin', 'reviewer', 'superadmin', 'manager'];
```

---

## 🚨 Important Notes

### 1. Tidak Perlu SQL Update
- Solusi ini **tidak perlu** update database
- Admin bisa langsung login
- Lebih aman dan simple

### 2. Role Harus Benar
- Pastikan admin punya `role = 'admin'` di database
- Case sensitive! 'Admin' ≠ 'admin'

### 3. Password Harus Benar
- Bypass hanya untuk approval check
- Password tetap dicek
- Security tetap terjaga

---

## 🔍 Troubleshooting

### Admin Masih Tidak Bisa Login?

**Check 1: Role di Database**
```sql
SELECT id, name, email, role FROM users WHERE email = 'admin@example.com';
```
Pastikan `role = 'admin'` (lowercase)

**Check 2: Password**
```php
// Test password hash
password_verify('password123', $user['password']);
```

**Check 3: Clear Session**
```php
// Logout dulu, clear cookies, login lagi
```

**Check 4: Check Error Log**
```bash
# Lihat error log CodeIgniter
tail -f writable/logs/log-*.php
```

---

## 📋 Checklist

- [x] Update `Auth.php` dengan bypass logic
- [x] Test admin login
- [x] Test reviewer login
- [x] Test user biasa (pending)
- [x] Test user biasa (approved)
- [x] Test user rejected
- [ ] Deploy ke production
- [ ] Inform users

---

## 🎉 Summary

**Sebelum:**
- ❌ Admin tidak bisa login
- ❌ Harus update database
- ❌ Ribet dan error-prone

**Sesudah:**
- ✅ Admin langsung bisa login
- ✅ Tidak perlu update database
- ✅ Simple dan aman
- ✅ Backward compatible

---

**Status:** ✅ Fixed  
**Tanggal:** 2025-11-13  
**Priority:** 🔴 CRITICAL (Resolved)  
**Method:** Role-based bypass

---

## 📞 Support

Jika masih ada masalah:
1. Cek role di database (harus 'admin')
2. Cek password benar
3. Clear session/cookies
4. Lihat error log
5. Contact developer
