# Password Change Request - Quick Start Guide

## 🚀 Quick Setup (Already Done!)

✅ Migration created and run
✅ Model created
✅ Controller created  
✅ Views created
✅ Routes configured
✅ Notifications integrated

## 📍 Access URLs

### For Non-Admin Users
```
http://localhost:8080/settings
```
- View profile
- Request password change
- See request history

### For Admin Users
```
http://localhost:8080/settings/password-requests
```
- View all pending requests
- Approve/reject requests

## 🎯 Quick Test (5 Minutes)

### Step 1: Test as Non-Admin (2 min)
1. Login dengan user non-admin (dosen/kaprodi/mahasiswa)
2. Klik "Pengaturan" di sidebar
3. Isi form:
   - Password Baru: `test123456`
   - Konfirmasi: `test123456`
4. Klik "Kirim Request"
5. ✅ Lihat request muncul di riwayat dengan status "Menunggu"

### Step 2: Test as Admin (2 min)
1. Logout, login sebagai admin
2. ✅ Lihat badge merah di bell icon (ada angka)
3. Klik bell icon
4. ✅ Lihat "1 request ganti password"
5. Klik link tersebut
6. Klik tombol "Setujui" (hijau)
7. Konfirmasi
8. ✅ Request hilang dari list

### Step 3: Verify (1 min)
1. Logout dari admin
2. Login dengan user non-admin tadi
3. ✅ Lihat badge di bell icon
4. Klik bell icon
5. ✅ Lihat "Password Anda telah berhasil diubah oleh admin"
6. Logout
7. Login dengan password BARU (`test123456`)
8. ✅ Login berhasil!

## 🎨 Design Features

### Sidebar (Sesuai Gambar 2)
- ✅ Green gradient background
- ✅ POLBAN logo dengan leaf icon
- ✅ 3 sections: MENU UTAMA, KRITERIA SDGS, SISTEM
- ✅ Active state dengan highlight hijau
- ✅ Hover effect dengan indent

### Settings Page (Sesuai Gambar 1)
- ✅ Green header dengan title
- ✅ White content area
- ✅ Profile info (readonly)
- ✅ Password change form (non-admin only)
- ✅ Request history dengan color-coded badges

### Notifications
- ✅ Bell icon di top bar
- ✅ Red badge dengan count
- ✅ Dropdown dengan links
- ✅ Auto-refresh setiap 30 detik

## 🔑 Key Features

### For Non-Admin
- ✅ Request password change
- ✅ View request history
- ✅ See status (pending/approved/rejected)
- ✅ Get notification when approved
- ✅ Cannot submit duplicate pending request

### For Admin
- ✅ View all pending requests
- ✅ See user details (name, email, role)
- ✅ Approve or reject requests
- ✅ Get notifications for new requests
- ✅ Admin tidak perlu request (bisa langsung ganti)

## 🔒 Security

- ✅ Password di-hash dengan bcrypt
- ✅ Authentication required
- ✅ Role-based authorization
- ✅ Validation (min 6 chars, must match)
- ✅ SQL injection protection

## 📱 Responsive

- ✅ Desktop: Full sidebar
- ✅ Tablet: Collapsed sidebar (icon only)
- ✅ Mobile: Hamburger menu

## 🐛 Troubleshooting

### "Unauthorized" error
→ Make sure you're logged in

### "Anda masih memiliki request yang belum diproses"
→ Wait for admin to process your pending request

### Notification not showing
→ Wait 30 seconds (auto-refresh interval)
→ Check browser console for errors

### Password not changing
→ Check if admin approved the request
→ Check database: `SELECT * FROM password_change_requests WHERE user_id = X`

## 📊 Database Check

```sql
-- View all requests
SELECT * FROM password_change_requests;

-- View pending only
SELECT * FROM password_change_requests WHERE status = 'pending';

-- View with user info
SELECT pcr.*, u.name, u.email, u.role 
FROM password_change_requests pcr
JOIN users u ON u.id = pcr.user_id;
```

## 📚 Full Documentation

For detailed information, see:
- `PASSWORD_CHANGE_REQUEST_FEATURE.md` - Complete feature docs
- `TESTING_PASSWORD_CHANGE_FEATURE.md` - Testing guide
- `QUICK_REFERENCE_URLS.md` - API endpoints
- `IMPLEMENTATION_COMPLETE_SUMMARY.md` - Implementation summary

## ✅ Checklist

Before going live:
- [ ] Test with non-admin user
- [ ] Test with admin user
- [ ] Verify notifications work
- [ ] Test password validation
- [ ] Test duplicate prevention
- [ ] Check database records
- [ ] Test on different browsers
- [ ] Test mobile responsiveness
- [ ] Review security measures
- [ ] Check error logs

## 🎉 You're Ready!

Fitur sudah lengkap dan siap digunakan. Silakan test sesuai guide di atas.

**Happy Testing! 🚀**
