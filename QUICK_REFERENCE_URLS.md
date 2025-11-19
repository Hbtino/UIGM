# Quick Reference - URLs & Endpoints

## Main Pages

### Dashboard
```
URL: http://localhost:8080/dashboard
Method: GET
Access: All authenticated users
```

### Settings Page
```
URL: http://localhost:8080/settings
Method: GET
Access: All authenticated users
Features:
  - Admin: View profile only
  - Non-Admin: View profile + Request password change + History
```

### Password Requests (Admin Only)
```
URL: http://localhost:8080/settings/password-requests
Method: GET
Access: Admin only
Features:
  - View all pending password change requests
  - Approve/Reject requests
```

## API Endpoints

### 1. Request Password Change
```
URL: http://localhost:8080/settings/request-password-change
Method: POST
Access: Non-admin users only
Content-Type: application/x-www-form-urlencoded

Parameters:
  - new_password (required, min 6 chars)
  - confirm_password (required, must match new_password)

Response:
{
  "success": true/false,
  "message": "Success or error message",
  "errors": {} // if validation fails
}
```

### 2. Get Pending Password Requests (for notifications)
```
URL: http://localhost:8080/settings/pending-password-requests
Method: GET
Access: Admin only

Response:
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

### 3. Process Password Request
```
URL: http://localhost:8080/settings/process-password-request/{id}
Method: POST
Access: Admin only
Content-Type: application/x-www-form-urlencoded

Parameters:
  - action (required: "approve" or "reject")
  - notes (optional)

Response:
{
  "success": true/false,
  "message": "Success or error message"
}
```

### 4. Check Password Change Status (for user notifications)
```
URL: http://localhost:8080/settings/check-password-change-status
Method: GET
Access: All authenticated users

Response:
{
  "success": true,
  "has_notification": true/false,
  "message": "Password Anda telah berhasil diubah oleh admin",
  "processed_at": "2025-11-18 12:30:00"
}
```

### 5. Get Pending User Approvals Count
```
URL: http://localhost:8080/users/pending-count
Method: GET
Access: Admin only

Response:
{
  "count": 5
}
```

## Testing with cURL

### Request Password Change
```bash
curl -X POST http://localhost:8080/settings/request-password-change \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "new_password=newpass123&confirm_password=newpass123" \
  --cookie "ci_session=YOUR_SESSION_COOKIE"
```

### Get Pending Requests (Admin)
```bash
curl -X GET http://localhost:8080/settings/pending-password-requests \
  --cookie "ci_session=YOUR_ADMIN_SESSION_COOKIE"
```

### Approve Request (Admin)
```bash
curl -X POST http://localhost:8080/settings/process-password-request/1 \
  -H "Content-Type: application/x-www-form-urlencoded" \
  -d "action=approve&notes=Approved" \
  --cookie "ci_session=YOUR_ADMIN_SESSION_COOKIE"
```

### Check Password Status
```bash
curl -X GET http://localhost:8080/settings/check-password-change-status \
  --cookie "ci_session=YOUR_SESSION_COOKIE"
```

## Database Queries

### View All Password Change Requests
```sql
SELECT 
  pcr.*,
  u.name,
  u.email,
  u.role,
  admin.name as processed_by_name
FROM password_change_requests pcr
JOIN users u ON u.id = pcr.user_id
LEFT JOIN users admin ON admin.id = pcr.processed_by
ORDER BY pcr.requested_at DESC;
```

### View Pending Requests Only
```sql
SELECT 
  pcr.*,
  u.name,
  u.email,
  u.role
FROM password_change_requests pcr
JOIN users u ON u.id = pcr.user_id
WHERE pcr.status = 'pending'
ORDER BY pcr.requested_at DESC;
```

### View User's Request History
```sql
SELECT * 
FROM password_change_requests 
WHERE user_id = [USER_ID]
ORDER BY requested_at DESC;
```

### Count Pending Requests
```sql
SELECT COUNT(*) as pending_count
FROM password_change_requests
WHERE status = 'pending';
```

## Common Issues & Solutions

### Issue 1: "Unauthorized" Response
**Solution:** Make sure you're logged in and have the correct role
- Check session cookie exists
- Verify user role in database

### Issue 2: "Anda masih memiliki request yang belum diproses"
**Solution:** Wait for admin to process your pending request, or ask admin to reject it

### Issue 3: Password validation fails
**Solution:** 
- Ensure password is at least 6 characters
- Ensure confirm_password matches new_password

### Issue 4: Notification not showing
**Solution:**
- Check JavaScript console for errors
- Verify API endpoints are accessible
- Check if notification check interval is running (30 seconds)

### Issue 5: Admin can't see password requests
**Solution:**
- Verify user role is 'admin' in database
- Check if there are actually pending requests
- Clear browser cache

## File Locations

### Controllers
```
app/Controllers/SettingsController.php
```

### Models
```
app/Models/PasswordChangeRequestModel.php
```

### Views
```
app/Views/settings/index.php
app/Views/settings/password_requests.php
```

### Migration
```
app/Database/Migrations/2025-11-18-000001_CreatePasswordChangeRequests.php
```

### Routes
```
app/Config/Routes.php
(Search for: $routes->group('settings'))
```

## JavaScript Functions

### Dashboard Notifications (Admin)
```javascript
checkPendingApprovals()
// Runs every 30 seconds
// Checks for pending user approvals and password requests
```

### Dashboard Notifications (Non-Admin)
```javascript
checkPasswordChangeStatus()
// Runs every 30 seconds
// Checks if password has been changed in last 24 hours
```

### Settings Page
```javascript
// Password change form submission
document.getElementById('passwordChangeForm').addEventListener('submit', ...)
```

### Password Requests Page (Admin)
```javascript
processRequest(requestId, action)
// action: 'approve' or 'reject'
```

## Environment Variables

No additional environment variables needed. Uses existing CodeIgniter 4 configuration.

## Dependencies

- CodeIgniter 4.x
- Bootstrap 5.3.0
- Font Awesome 6.4.0
- Chart.js (for dashboard)

## Browser DevTools Tips

### Check Session
```javascript
// In browser console
document.cookie
```

### Check API Response
```javascript
// In Network tab
// Filter by: XHR
// Look for: pending-password-requests, check-password-change-status
```

### Debug Notifications
```javascript
// In Console tab
// Look for: "Error fetching notifications"
// Or: "Error checking password status"
```

## Next Steps After Implementation

1. ✅ Run migration: `php spark migrate`
2. ✅ Clear cache: `php spark cache:clear`
3. ✅ Test with non-admin user
4. ✅ Test with admin user
5. ✅ Verify notifications work
6. ✅ Check database records
7. ✅ Test on different browsers
8. ✅ Test mobile responsiveness

## Support

For issues or questions:
1. Check TESTING_PASSWORD_CHANGE_FEATURE.md
2. Check PASSWORD_CHANGE_REQUEST_FEATURE.md
3. Review error logs in `writable/logs/`
4. Check browser console for JavaScript errors
