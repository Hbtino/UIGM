# Fix Notification - Step by Step Testing

## Perubahan yang Sudah Dilakukan:

1. ✅ Menambahkan detailed console logging di JavaScript
2. ✅ Mengubah Promise.all menjadi sequential fetch untuk debugging lebih baik
3. ✅ Menambahkan test controller untuk debugging
4. ✅ Menambahkan logging di SettingsController

## Langkah Testing:

### Step 1: Test Endpoint Langsung

**A. Test dengan Test Controller**
1. Login sebagai admin
2. Buka browser: `http://localhost:8080/test/notifications`
3. Lihat output:
   - Session info (harus logged in sebagai admin)
   - Pending requests count (harus 2)
   - Array data requests
   - JSON response

**Expected Output:**
```
Session Info:
Logged In: YES
User ID: 2
User Name: nabil muhammad
User Role: admin

Pending Requests Count: 2

Array data dengan 2 requests...
```

### Step 2: Test API Endpoint

**B. Test API Endpoint**
1. Masih login sebagai admin
2. Buka tab baru: `http://localhost:8080/settings/pending-password-requests`
3. Harus muncul JSON:
```json
{
  "success": true,
  "requests": [
    {
      "id": 1,
      "user_id": 16,
      "name": "...",
      "email": "...",
      "role": "...",
      "requested_at": "..."
    },
    {
      "id": 2,
      "user_id": 21,
      ...
    }
  ]
}
```

**Jika muncul:**
- `{"success":false,"message":"Unauthorized"}` → Session expired, logout dan login lagi
- `404 Not Found` → Route bermasalah, jalankan `php spark cache:clear`
- Empty array `{"success":true,"requests":[]}` → Data tidak ada di database

### Step 3: Test Dashboard Notification

**C. Test di Dashboard**
1. Login sebagai admin
2. Buka dashboard: `http://localhost:8080/dashboard`
3. **PENTING:** Buka Developer Tools (F12)
4. Klik tab "Console"
5. Lihat output console log:

**Expected Console Output:**
```
Initializing notification system...
=== Checking Pending Approvals ===
Base URL: http://localhost:8080/
User approvals response status: 200
User Approvals Data: {count: 0}
Password requests response status: 200
Password Requests Data: {success: true, requests: Array(2)}
User Count: 0
Password Count: 2
Total Count: 2
✓ Notification badge updated with count: 2
Notification check interval set to 30 seconds
```

6. Lihat bell icon di top bar
7. Harus ada badge merah dengan angka "2"
8. Klik bell icon
9. Harus muncul: "2 request ganti password"

### Step 4: Jika Masih Tidak Muncul

**D. Check Element HTML**
1. Masih di dashboard dengan F12 terbuka
2. Klik tab "Elements" atau "Inspector"
3. Tekan Ctrl+F untuk search
4. Cari: `notification-badge`
5. Pastikan element ada:
```html
<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" 
      id="notification-badge" 
      style="display: none; font-size: 0.7rem;">
    0
</span>
```

6. Cari juga: `notification-content`
7. Pastikan element ada

**Jika element tidak ada:**
- Dashboard view tidak ter-load dengan benar
- Clear browser cache (Ctrl+Shift+Del)
- Hard refresh (Ctrl+F5)

### Step 5: Check Network Tab

**E. Monitor Network Requests**
1. F12 → Tab "Network"
2. Filter: XHR
3. Refresh dashboard (F5)
4. Lihat 2 request:
   - `users/pending-count`
   - `settings/pending-password-requests`
5. Klik masing-masing request
6. Lihat tab "Response"
7. Pastikan response JSON benar

**Jika request tidak muncul:**
- JavaScript error (check Console tab)
- Base URL salah
- Route tidak ditemukan

### Step 6: Force Manual Check

**F. Manual Trigger**
1. Masih di dashboard dengan Console terbuka
2. Ketik di console:
```javascript
checkPendingApprovals();
```
3. Tekan Enter
4. Lihat output console
5. Badge harus muncul

### Step 7: Check Database

**G. Verify Database**
```sql
-- Check pending requests
SELECT * FROM password_change_requests WHERE status = 'pending';

-- Should return 2 rows
```

Atau dengan command:
```bash
php spark db:table password_change_requests
```

## Troubleshooting

### Problem 1: Console shows "Unauthorized"
**Solution:**
```
1. Logout
2. Clear browser cookies
3. Login kembali sebagai admin
4. Refresh dashboard
```

### Problem 2: Console shows "404 Not Found"
**Solution:**
```bash
php spark cache:clear
php spark routes | findstr "settings"
```

### Problem 3: Console shows empty requests array
**Solution:**
```sql
-- Check if data exists
SELECT * FROM password_change_requests WHERE status = 'pending';

-- If empty, create test data
INSERT INTO password_change_requests (user_id, new_password, status, requested_at)
VALUES (16, '$2y$10$test', 'pending', NOW());
```

### Problem 4: No console output at all
**Solution:**
- Check if you're logged in as admin
- Check `$user_role` variable in dashboard
- View page source, search for "checkPendingApprovals"
- If not found, PHP condition failed

### Problem 5: Badge element not found
**Solution:**
```javascript
// Run in console
document.getElementById('notification-badge');
// Should return: <span id="notification-badge" ...>

// If returns null:
// 1. Check HTML structure
// 2. Clear cache
// 3. Hard refresh (Ctrl+F5)
```

## Quick Fix Commands

```bash
# Clear all caches
php spark cache:clear

# Check routes
php spark routes | findstr "settings"

# Check database
php spark db:table password_change_requests

# Check logs
type writable\logs\log-2025-11-18.log | findstr "getPendingPasswordRequests"
```

## Expected Final Result

When everything works:
1. ✅ Console shows detailed logs
2. ✅ Badge appears with number "2"
3. ✅ Clicking bell shows "2 request ganti password"
4. ✅ Clicking link goes to password requests page
5. ✅ Page shows 2 pending requests

## Still Not Working?

Kirim screenshot dari:
1. Browser console (F12 → Console tab)
2. Network tab (F12 → Network → XHR filter)
3. Test controller output (`/test/notifications`)
4. Database query result

Atau share log file:
```
writable/logs/log-[today's date].log
```
