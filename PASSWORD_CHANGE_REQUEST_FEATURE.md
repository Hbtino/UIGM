# Password Change Request Feature

## Overview
Fitur ini memungkinkan user non-admin untuk request ganti password yang harus disetujui oleh admin. User akan mendapat notifikasi ketika password mereka sudah diganti.

## Features Implemented

### 1. Database Migration
- **File**: `app/Database/Migrations/2025-11-18-000001_CreatePasswordChangeRequests.php`
- **Table**: `password_change_requests`
- **Columns**:
  - `id` - Primary key
  - `user_id` - Foreign key ke users table
  - `new_password` - Hashed password baru
  - `status` - ENUM (pending, approved, rejected)
  - `requested_at` - Timestamp request
  - `processed_at` - Timestamp diproses
  - `processed_by` - Admin yang memproses
  - `notes` - Catatan dari admin

### 2. Model
- **File**: `app/Models/PasswordChangeRequestModel.php`
- **Methods**:
  - `getPendingRequests()` - Get semua pending requests dengan user info
  - `getPendingCount()` - Count pending requests
  - `getUserRequests($userId)` - Get request history user tertentu

### 3. Controller
- **File**: `app/Controllers/SettingsController.php`
- **Methods**:
  - `index()` - Halaman pengaturan user
  - `requestPasswordChange()` - Submit request ganti password
  - `getPendingPasswordRequests()` - API untuk notifikasi admin
  - `passwordRequests()` - Halaman admin untuk review requests
  - `processPasswordRequest($requestId)` - Approve/reject request
  - `checkPasswordChangeStatus()` - API untuk notifikasi user

### 4. Views

#### Settings Page (Non-Admin)
- **File**: `app/Views/settings/index.php`
- **Features**:
  - Sidebar dengan menu navigasi (sesuai gambar 2)
  - Form request ganti password
  - Riwayat request dengan status (pending/approved/rejected)
  - Validasi password minimal 6 karakter
  - Konfirmasi password

#### Password Requests Page (Admin Only)
- **File**: `app/Views/settings/password_requests.php`
- **Features**:
  - List semua pending password change requests
  - Informasi user (nama, email, role)
  - Timestamp request
  - Tombol Approve/Reject
  - Empty state jika tidak ada request

### 5. Notification System

#### Admin Notifications (Dashboard)
- Notifikasi untuk:
  - Pending user approvals
  - Pending password change requests
- Badge menampilkan total count
- Dropdown dengan link ke masing-masing halaman

#### User Notifications (Dashboard)
- Notifikasi ketika password berhasil diganti
- Muncul dalam 24 jam setelah approval
- Badge dan dropdown notification

### 6. Routes
```php
$routes->group('settings', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'SettingsController::index');
    $routes->post('request-password-change', 'SettingsController::requestPasswordChange');
    $routes->get('pending-password-requests', 'SettingsController::getPendingPasswordRequests');
    $routes->get('password-requests', 'SettingsController::passwordRequests');
    $routes->post('process-password-request/(:num)', 'SettingsController::processPasswordRequest/$1');
    $routes->get('check-password-change-status', 'SettingsController::checkPasswordChangeStatus');
});
```

## User Flow

### Non-Admin User
1. Login ke sistem
2. Klik menu "Pengaturan" di sidebar
3. Isi form "Ganti Password":
   - Password Baru (min 6 karakter)
   - Konfirmasi Password Baru
4. Klik "Kirim Request"
5. Request masuk ke status "Menunggu"
6. User dapat melihat riwayat request di halaman yang sama
7. Ketika admin approve, user mendapat notifikasi di dashboard (bell icon)
8. Password otomatis berubah setelah approval

### Admin User
1. Login ke sistem
2. Melihat notifikasi di dashboard (bell icon) jika ada:
   - Pending user approvals
   - Pending password change requests
3. Klik notifikasi "X request ganti password"
4. Masuk ke halaman Password Change Requests
5. Review setiap request dengan informasi:
   - Nama user
   - Email
   - Role
   - Waktu request
6. Klik "Setujui" atau "Tolak"
7. Password user otomatis berubah jika disetujui

## Security Features
1. **Password Hashing**: Password di-hash sebelum disimpan di database
2. **Authentication**: Semua endpoint dilindungi auth filter
3. **Authorization**: 
   - Non-admin tidak bisa approve request
   - Admin tidak perlu request (bisa langsung ganti)
4. **Validation**:
   - Password minimal 6 karakter
   - Konfirmasi password harus match
   - Cek duplicate pending request

## API Endpoints

### POST /settings/request-password-change
Request ganti password (non-admin only)
```json
{
  "new_password": "newpass123",
  "confirm_password": "newpass123"
}
```

### GET /settings/pending-password-requests
Get pending requests untuk notifikasi admin
```json
{
  "success": true,
  "requests": [...]
}
```

### GET /settings/password-requests
Halaman admin untuk review requests (HTML)

### POST /settings/process-password-request/{id}
Approve/reject request
```json
{
  "action": "approve", // or "reject"
  "notes": "Optional notes"
}
```

### GET /settings/check-password-change-status
Check status untuk notifikasi user
```json
{
  "success": true,
  "has_notification": true,
  "message": "Password Anda telah berhasil diubah oleh admin",
  "processed_at": "2025-11-18 12:00:00"
}
```

## Design Implementation

### Sidebar (Sesuai Gambar 2)
- Background: Green gradient (#149823ff to #0b5804ff)
- Sections:
  - MENU UTAMA: Dashboard
  - KRITERIA SDGS: 6 menu kriteria
  - SISTEM: Manajemen User (admin only), Laporan, Pengaturan, Keluar
- Active state: Light green background dengan border kiri hijau
- Hover effect: Slight indent dan background change

### Settings Page (Sesuai Gambar 1)
- Header: Green gradient dengan judul dan deskripsi
- Sections:
  - Informasi Profil (readonly)
  - Ganti Password (form untuk non-admin)
  - Riwayat Request (dengan status badges)
- Status badges:
  - Pending: Yellow background
  - Approved: Green background
  - Rejected: Red background

## Testing Checklist
- [ ] Non-admin dapat submit password change request
- [ ] Admin melihat notifikasi di dashboard
- [ ] Admin dapat approve request
- [ ] Password user berubah setelah approval
- [ ] User melihat notifikasi setelah password diganti
- [ ] Admin dapat reject request
- [ ] User melihat riwayat request dengan status
- [ ] Validasi password berfungsi
- [ ] Tidak bisa submit duplicate pending request
- [ ] Admin tidak melihat form request password

## Future Enhancements
1. Email notification ketika password diganti
2. Reason field untuk rejection
3. Password strength indicator
4. Bulk approve/reject
5. Export request history
