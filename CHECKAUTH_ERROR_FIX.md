# Fix checkAuth() Error - SELESAI

## Problem

Error `$this->checkAuth()` berwarna merah di StatisticsController karena method `checkAuth()` belum didefinisikan.

## Solution Implemented

### 1. Added checkAuth() Method

```php
/**
 * Check authentication for admin access
 */
private function checkAuth()
{
    $isLoggedIn = $this->session->get('isLoggedIn') || $this->session->get('logged_in');
    $userRole = $this->session->get('role');

    if (!$isLoggedIn || $userRole !== 'admin') {
        return redirect()->to('/login')->with('error', 'Akses ditolak. Hanya admin yang dapat mengakses halaman ini.');
    }

    return true;
}
```

### 2. Updated Method Calls

**Before:**

```php
public function dashboardStats()
{
    $this->checkAuth(); // Error: method tidak ada
    // ...
}
```

**After:**

```php
public function dashboardStats()
{
    $authCheck = $this->checkAuth();
    if ($authCheck !== true) {
        return $authCheck; // Return redirect if not authenticated
    }
    // ...
}
```

### 3. Methods Fixed

- `dashboardStats()` - Dashboard Statistics management page
- `charts()` - Charts & Indicators management page

## Authentication Logic

- Checks both `isLoggedIn` and `logged_in` session keys (compatibility)
- Verifies user role is 'admin'
- Returns redirect to login if unauthorized
- Returns `true` if authenticated successfully

## Result

✅ Error `$this->checkAuth()` sudah teratasi  
✅ Authentication berfungsi dengan baik  
✅ Server berjalan tanpa error  
✅ Kedua halaman management dapat diakses oleh admin

## Files Modified

- `app/Controllers/StatisticsController.php`
  - Added `checkAuth()` method
  - Updated `dashboardStats()` method
  - Updated `charts()` method
