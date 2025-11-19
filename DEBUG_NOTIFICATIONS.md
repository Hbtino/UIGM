# Debug Notifications - Password Change Requests

## Langkah-langkah Debug

### 1. Test Endpoint Manually

#### Test di Browser (Admin Login)
```
http://localhost:8080/settings/pending-password-requests
```

**Expected Response:**
```json
{
  "success": true,
  "requests": [
    {
      "id": 1,
      "user_id": 5,
      "name": "John Doe",
      "email": "john@example.com",
      "role": "dosen",
      "requested_at": "2025-11-18 12:00:00"
    }
  ]
}
```

### 2. Check Database

```sql
-- Cek apakah ada pending requests
SELECT * FROM password_change_requests WHERE status = 'pending';

-- Cek dengan join users
SELECT 
    pcr.*,
    u.name,
    u.email,
    u.role
FROM password_change_requests pcr
JOIN users u ON u.id = pcr.user_id
WHERE pcr.status = 'pending';
```

### 3. Check Browser Console

1. Login sebagai admin
2. Buka Dashboard
3. Tekan F12 untuk buka Developer Tools
4. Klik tab "Console"
5. Lihat output:
   - `User Approvals: {count: X}`
   - `Password Requests: {success: true, requests: [...]}`

### 4. Check Network Tab

1. Buka Developer Tools (F12)
2. Klik tab "Network"
3. Filter: XHR
4. Refresh dashboard
5. Cari request ke:
   - `users/pending-count`
   - `settings/pending-password-requests`
6. Klik request tersebut
7. Lihat Response

### 5. Common Issues

#### Issue 1: 404 Not Found
**Cause:** Route tidak ditemukan
**Solution:** 
- Cek `app/Config/Routes.php`
- Pastikan route `settings/pending-password-requests` ada
- Clear route cache: `php spark cache:clear`

#### Issue 2: 403 Unauthorized
**Cause:** User bukan admin atau session expired
**Solution:**
- Logout dan login kembali sebagai admin
- Cek session: `var_dump(session()->get('user_role'))`

#### Issue 3: Empty Array
**Cause:** Tidak ada pending requests di database
**Solution:**
- Submit password change request dari user non-admin
- Cek database: `SELECT * FROM password_change_requests WHERE status = 'pending'`

#### Issue 4: CORS Error
**Cause:** Cross-origin request blocked
**Solution:**
- Pastikan base_url benar di `.env`
- Cek `app/Config/App.php` - baseURL

#### Issue 5: JavaScript Error
**Cause:** Syntax error atau undefined variable
**Solution:**
- Cek browser console untuk error message
- Pastikan `notification-badge` dan `notification-content` element ada

### 6. Manual Test Flow

#### Step 1: Create Test Request
1. Login sebagai non-admin (dosen/kaprodi/mahasiswa)
2. Go to: `http://localhost:8080/settings`
3. Fill password change form
4. Submit
5. Check database:
```sql
SELECT * FROM password_change_requests ORDER BY id DESC LIMIT 1;
```

#### Step 2: Check Admin Notification
1. Logout
2. Login sebagai admin
3. Go to dashboard
4. Open browser console (F12)
5. Look for console.log output:
   - `User Approvals: ...`
   - `Password Requests: ...`
6. Check notification bell icon
7. Should show badge with count

#### Step 3: Verify API Response
Open in browser (while logged in as admin):
```
http://localhost:8080/settings/pending-password-requests
```

Should return JSON with requests array.

### 7. Force Refresh Notification

Add this to browser console (while on dashboard as admin):
```javascript
checkPendingApprovals();
```

This will manually trigger the notification check.

### 8. Check Session

Add this temporarily to `app/Controllers/SettingsController.php` in `getPendingPasswordRequests()`:
```php
public function getPendingPasswordRequests()
{
    // Debug
    log_message('debug', 'Session logged_in: ' . (session()->get('logged_in') ? 'true' : 'false'));
    log_message('debug', 'Session user_role: ' . session()->get('user_role'));
    
    if (!session()->get('logged_in') || session()->get('user_role') !== 'admin') {
        return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
    }
    
    $requests = $this->passwordRequestModel->getPendingRequests();
    
    // Debug
    log_message('debug', 'Pending requests count: ' . count($requests));
    
    return $this->response->setJSON([
        'success' => true,
        'requests' => $requests
    ]);
}
```

Then check logs in `writable/logs/log-[date].log`

### 9. Test with cURL

```bash
# Get session cookie first by logging in
# Then use the cookie in this request:

curl -X GET http://localhost:8080/settings/pending-password-requests \
  -H "Cookie: ci_session=YOUR_SESSION_COOKIE_HERE" \
  -v
```

### 10. Quick Fix Test

If nothing works, try this quick test:

1. Open `app/Views/dashboard/index.php`
2. Find the notification check function
3. Add alert for debugging:

```javascript
function checkPendingApprovals() {
    Promise.all([
        fetch('<?= base_url('users/pending-count') ?>').then(r => r.json()),
        fetch('<?= base_url('settings/pending-password-requests') ?>').then(r => r.json())
    ])
    .then(([userApprovals, passwordRequests]) => {
        // DEBUG ALERT
        alert('User Approvals: ' + userApprovals.count + '\nPassword Requests: ' + (passwordRequests.requests ? passwordRequests.requests.length : 0));
        
        // ... rest of code
    })
}
```

This will show a popup with the counts.

## Expected Behavior

When everything works correctly:

1. Non-admin submits password change request
2. Database has new row in `password_change_requests` with status='pending'
3. Admin logs in to dashboard
4. Within 30 seconds (or immediately on page load), notification badge appears
5. Badge shows total count (user approvals + password requests)
6. Clicking bell icon shows dropdown with both types of notifications
7. Clicking "X request ganti password" goes to password requests page
8. Admin can approve/reject from there

## Still Not Working?

Check these files for typos:
- `app/Config/Routes.php` - Route definition
- `app/Controllers/SettingsController.php` - Method name
- `app/Models/PasswordChangeRequestModel.php` - Query
- `app/Views/dashboard/index.php` - JavaScript fetch URL
- Database table name: `password_change_requests`
