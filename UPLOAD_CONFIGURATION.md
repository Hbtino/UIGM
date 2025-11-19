# Upload Configuration - Profile Photo

## Current Settings

**Maximum File Size: 10MB**

Updated in:
- ✅ View (settings/index.php) - UI text and JavaScript validation
- ✅ Controller (SettingsController.php) - Backend validation

## PHP Configuration Check

If you encounter issues uploading files larger than 2MB, you may need to update PHP configuration:

### Check Current PHP Settings

Create a file `phpinfo.php` in `public/` folder:
```php
<?php
phpinfo();
?>
```

Then open: `http://localhost:8080/phpinfo.php`

Look for these values:
- `upload_max_filesize` - Should be >= 10M
- `post_max_size` - Should be >= 10M
- `memory_limit` - Should be >= 128M

### Update PHP Settings (if needed)

#### Option 1: Edit php.ini (Recommended)

Location: `C:\xampp\php\php.ini`

Find and update these lines:
```ini
upload_max_filesize = 10M
post_max_size = 10M
memory_limit = 128M
max_execution_time = 300
```

Then restart Apache.

#### Option 2: .htaccess (Alternative)

Add to `public/.htaccess`:
```apache
php_value upload_max_filesize 10M
php_value post_max_size 10M
php_value memory_limit 128M
php_value max_execution_time 300
```

**Note:** This only works if PHP is running as Apache module, not FastCGI.

#### Option 3: .user.ini (For FastCGI)

Create `public/.user.ini`:
```ini
upload_max_filesize = 10M
post_max_size = 10M
memory_limit = 128M
max_execution_time = 300
```

### Restart Apache

After making changes:
```bash
# Stop Apache
net stop Apache2.4

# Start Apache
net start Apache2.4
```

Or use XAMPP Control Panel:
1. Stop Apache
2. Start Apache

### Verify Changes

1. Refresh `http://localhost:8080/phpinfo.php`
2. Check if values are updated
3. Try uploading a file > 2MB

### Security Note

**Don't forget to delete `phpinfo.php` after checking!**
```bash
del public\phpinfo.php
```

## Current Validation Flow

### 1. Client-Side (JavaScript)
```javascript
// Max 10MB = 10 * 1024 * 1024 bytes
if (file.size > 10 * 1024 * 1024) {
    alert('File too large');
}
```

### 2. Server-Side (PHP)
```php
// Max 10MB
if ($file->getSize() > 10 * 1024 * 1024) {
    return error('File too large');
}
```

### 3. PHP Configuration
```ini
upload_max_filesize = 10M  # Must be >= 10M
post_max_size = 10M        # Must be >= 10M
```

## Troubleshooting

### Issue: Upload fails silently
**Cause:** PHP upload_max_filesize too small
**Solution:** Increase in php.ini

### Issue: "File too large" error
**Cause:** post_max_size too small
**Solution:** Increase post_max_size in php.ini

### Issue: Upload timeout
**Cause:** max_execution_time too short
**Solution:** Increase max_execution_time in php.ini

### Issue: Memory error
**Cause:** memory_limit too low
**Solution:** Increase memory_limit in php.ini

## Recommended PHP Settings for Production

```ini
; File Uploads
file_uploads = On
upload_max_filesize = 10M
max_file_uploads = 20

; POST Data
post_max_size = 10M

; Memory & Execution
memory_limit = 256M
max_execution_time = 300
max_input_time = 300

; Security
allow_url_fopen = Off
allow_url_include = Off
```

## File Type Restrictions

Currently allowed:
- JPG/JPEG
- PNG

To add more types, update:

**Controller:**
```php
$allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
```

**View:**
```html
<input type="file" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
```

## Storage Considerations

### Disk Space

With 10MB max per user:
- 100 users = 1GB max
- 1000 users = 10GB max

### Optimization Recommendations

1. **Image Compression**
   - Use image optimization library (e.g., Intervention Image)
   - Compress images on upload
   - Reduce to reasonable dimensions (e.g., 500x500px)

2. **Storage Cleanup**
   - Delete old photos when new one uploaded ✅ (Already implemented)
   - Periodic cleanup of orphaned files

3. **CDN/Cloud Storage** (Future)
   - Move to AWS S3, Google Cloud Storage, etc.
   - Reduce server load
   - Better scalability

## Current Implementation Status

✅ 10MB max file size
✅ JPG, PNG support
✅ Client-side validation
✅ Server-side validation
✅ Old file deletion
✅ Unique filename generation
✅ Secure upload directory
✅ Display in dashboard
✅ Display in settings

## Testing Checklist

- [ ] Upload file < 10MB → Success
- [ ] Upload file > 10MB → Error message
- [ ] Upload non-image file → Error message
- [ ] Upload JPG → Success
- [ ] Upload PNG → Success
- [ ] Upload GIF → Error (not allowed)
- [ ] Delete photo → Success
- [ ] Photo displays in dashboard → Success
- [ ] Photo displays in settings → Success
- [ ] Old photo deleted when new uploaded → Success
