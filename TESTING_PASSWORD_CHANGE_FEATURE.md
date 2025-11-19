# Testing Guide - Password Change Request Feature

## Prerequisites
1. Database migration sudah dijalankan (tabel `password_change_requests` sudah ada)
2. Minimal ada 2 user:
   - 1 Admin user
   - 1 Non-admin user (dosen/kaprodi/mahasiswa)

## Test Scenarios

### Scenario 1: Non-Admin Request Password Change

**Steps:**
1. Login sebagai non-admin user (dosen/kaprodi/mahasiswa)
2. Klik menu "Pengaturan" di sidebar
3. Scroll ke section "Ganti Password"
4. Isi form:
   - Password Baru: `newpass123`
   - Konfirmasi Password Baru: `newpass123`
5. Klik tombol "Kirim Request"

**Expected Result:**
- Alert success muncul: "Request ganti password berhasil dikirim. Menunggu persetujuan admin."
- Form di-reset
- Halaman reload dan request muncul di "Riwayat Request" dengan status "Menunggu" (badge kuning)

### Scenario 2: Admin View Notification

**Steps:**
1. Login sebagai admin
2. Perhatikan bell icon di top bar dashboard
3. Klik bell icon

**Expected Result:**
- Badge merah muncul dengan angka (jumlah pending requests)
- Dropdown menampilkan:
  - "X request ganti password" dengan icon key berwarna biru
  - Link mengarah ke halaman password requests

### Scenario 3: Admin Approve Password Request

**Steps:**
1. Masih login sebagai admin
2. Klik notifikasi "X request ganti password"
3. Halaman Password Change Requests terbuka
4. Lihat informasi request:
   - Nama user
   - Email
   - Role
   - Timestamp request
5. Klik tombol "Setujui" (hijau)
6. Konfirmasi dialog

**Expected Result:**
- Alert konfirmasi muncul
- Request card hilang dari list
- Password user berubah di database
- Status request di database menjadi "approved"

### Scenario 4: User View Password Changed Notification

**Steps:**
1. Logout dari admin
2. Login kembali sebagai non-admin user yang tadi request
3. Perhatikan bell icon di dashboard
4. Klik bell icon

**Expected Result:**
- Badge merah muncul dengan angka 1
- Dropdown menampilkan:
  - "Password Anda telah berhasil diubah oleh admin" dengan icon check berwarna hijau
  - Link mengarah ke halaman settings

### Scenario 5: User Login with New Password

**Steps:**
1. Logout dari user
2. Login dengan password LAMA

**Expected Result:**
- Login GAGAL (password salah)

**Steps:**
3. Login dengan password BARU (`newpass123`)

**Expected Result:**
- Login BERHASIL
- Masuk ke dashboard

### Scenario 6: Admin Reject Password Request

**Steps:**
1. Login sebagai non-admin user lain
2. Submit password change request
3. Logout, login sebagai admin
4. Buka Password Change Requests
5. Klik tombol "Tolak" (merah)
6. Konfirmasi dialog

**Expected Result:**
- Request card hilang
- Status di database menjadi "rejected"
- Password user TIDAK berubah

### Scenario 7: Duplicate Request Prevention

**Steps:**
1. Login sebagai non-admin user
2. Submit password change request
3. Tanpa logout, submit request lagi

**Expected Result:**
- Alert error: "Anda masih memiliki request yang belum diproses"
- Request tidak dibuat

### Scenario 8: Admin Cannot Request Password

**Steps:**
1. Login sebagai admin
2. Klik menu "Pengaturan"

**Expected Result:**
- Halaman settings terbuka
- Section "Ganti Password" TIDAK muncul
- Hanya section "Informasi Profil" yang muncul

### Scenario 9: Password Validation

**Steps:**
1. Login sebagai non-admin
2. Buka halaman Pengaturan
3. Isi form dengan password < 6 karakter:
   - Password Baru: `123`
   - Konfirmasi: `123`
4. Submit

**Expected Result:**
- Alert error dengan validasi message

**Steps:**
5. Isi form dengan password tidak match:
   - Password Baru: `newpass123`
   - Konfirmasi: `different123`
6. Submit

**Expected Result:**
- Alert error: password tidak match

### Scenario 10: Request History Display

**Steps:**
1. Login sebagai non-admin yang sudah pernah request
2. Buka halaman Pengaturan
3. Scroll ke "Riwayat Request"

**Expected Result:**
- Semua request history muncul dengan:
  - Status badge (Menunggu/Disetujui/Ditolak)
  - Timestamp request
  - Timestamp processed (jika sudah diproses)
  - Notes dari admin (jika ada)

## Database Verification

### Check Password Change Requests Table
```sql
SELECT * FROM password_change_requests;
```

**Expected Columns:**
- id
- user_id
- new_password (hashed)
- status (pending/approved/rejected)
- requested_at
- processed_at
- processed_by
- notes

### Check User Password Changed
```sql
SELECT id, name, email, password FROM users WHERE id = [user_id];
```

**Verify:**
- Password hash berubah setelah approval

## UI/UX Verification

### Settings Page (Non-Admin)
- [ ] Sidebar hijau dengan gradient
- [ ] Logo POLBAN di header sidebar
- [ ] Menu sections: MENU UTAMA, KRITERIA SDGS, SISTEM
- [ ] Active menu "Pengaturan" dengan highlight hijau
- [ ] Top bar dengan user info dan avatar
- [ ] Settings header dengan background hijau
- [ ] Form ganti password dengan 2 input fields
- [ ] Button "Kirim Request" dengan style hijau
- [ ] Riwayat request dengan color-coded status badges

### Password Requests Page (Admin)
- [ ] Clean white background
- [ ] Page header dengan title dan back button
- [ ] Request cards dengan border bottom
- [ ] User info displayed clearly
- [ ] Timestamp formatted nicely
- [ ] Green "Setujui" button
- [ ] Red "Tolak" button
- [ ] Empty state jika tidak ada request

### Dashboard Notifications
- [ ] Bell icon di top bar
- [ ] Red badge dengan count
- [ ] Dropdown dengan proper styling
- [ ] Icons untuk setiap notification type
- [ ] Links berfungsi dengan benar

## Performance Testing

### Load Testing
1. Create 10+ password change requests
2. Check admin notification load time
3. Check password requests page load time

**Expected:**
- Page loads < 2 seconds
- No database query issues

### Concurrent Testing
1. Multiple users submit requests simultaneously
2. Admin processes multiple requests

**Expected:**
- No race conditions
- All requests processed correctly

## Security Testing

### Authorization
1. Try accessing `/settings/password-requests` as non-admin

**Expected:**
- Redirect to dashboard or 403 error

2. Try POST to `/settings/process-password-request/1` as non-admin

**Expected:**
- Unauthorized response

### Password Security
1. Check database for password storage

**Expected:**
- Passwords are hashed (bcrypt/argon2)
- No plain text passwords

### SQL Injection
1. Try injecting SQL in password fields

**Expected:**
- Properly escaped/parameterized queries
- No SQL injection possible

## Browser Compatibility
Test on:
- [ ] Chrome
- [ ] Firefox
- [ ] Edge
- [ ] Safari (if available)

## Mobile Responsiveness
Test on mobile viewport:
- [ ] Sidebar collapses properly
- [ ] Forms are usable
- [ ] Buttons are tappable
- [ ] Text is readable

## Bug Report Template

If you find any issues, report with:
```
**Bug Title:** [Short description]

**Steps to Reproduce:**
1. 
2. 
3. 

**Expected Result:**
[What should happen]

**Actual Result:**
[What actually happened]

**Screenshots:**
[If applicable]

**Environment:**
- Browser: 
- User Role: 
- Database: 
```

## Success Criteria

All scenarios pass ✓
- [ ] Non-admin can request password change
- [ ] Admin receives notifications
- [ ] Admin can approve/reject requests
- [ ] User password changes after approval
- [ ] User receives notification after change
- [ ] Validation works correctly
- [ ] No duplicate requests allowed
- [ ] Admin cannot request password
- [ ] UI matches design requirements
- [ ] Security measures in place
