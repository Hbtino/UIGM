# Design Document

## Overview

Dokumen ini menjelaskan desain solusi untuk memperbaiki fungsi logout yang saat ini mengalami masalah auto-login setelah logout. Masalah utama adalah BaseController mengecek cookie remember me pada setiap request, termasuk saat redirect setelah logout, yang menyebabkan user langsung login kembali.

Solusi yang akan diimplementasikan:
1. Menambahkan flag session untuk menandai proses logout sedang berlangsung
2. Memodifikasi BaseController untuk skip auto-login saat flag logout aktif
3. Memastikan urutan pembersihan data yang benar (database → cookies → session)
4. Menggunakan helper cookie CodeIgniter untuk penghapusan cookie yang lebih reliable

## Architecture

### Current Flow (Problematic)
```
User clicks Logout
    ↓
Auth::logout() called
    ↓
Clear remember token in DB
    ↓
Clear cookies (setcookie)
    ↓
Destroy session
    ↓
Redirect to /login
    ↓
BaseController::initController() called
    ↓
checkRememberMe() executed
    ↓
Cookie still exists → Auto-login!
```

### New Flow (Fixed)
```
User clicks Logout
    ↓
Auth::logout() called
    ↓
Set remember_token_active = 0 in DB
    ↓
Clear cookies using delete_cookie()
    ↓
Destroy session
    ↓
Redirect to /login
    ↓
BaseController::initController() called
    ↓
checkRememberMe() checks token_active → Skip auto-login
    ↓
User stays logged out

--- On another device with valid cookie ---
User opens website
    ↓
BaseController::initController() called
    ↓
checkRememberMe() finds valid cookie
    ↓
Check DB: token matches AND token_active = 1
    ↓
Auto-login successful (different device still works)
```

## Components and Interfaces

### 1. Auth Controller (app/Controllers/Auth.php)

**Modified Method:**
- `logout()`: Enhanced logout method with proper cleanup sequence

**Responsibilities:**
- Set remember_token_active = 0 in database (deactivate token)
- Clear cookies using CodeIgniter helper
- Destroy session
- Redirect to login page with success message

### 2. BaseController (app/Controllers/BaseController.php)

**Modified Method:**
- `checkRememberMe()`: Add check for token active status

**Responsibilities:**
- Skip auto-login if already logged in
- Validate remember token against database
- Check if remember_token_active = 1 before auto-login
- Clear cookies if token is inactive or invalid
- Set session data if token is valid and active

### 3. Login Controller (app/Controllers/Login.php)

**Action Required:**
- Remove duplicate logout method (keep only in Auth controller)
- Ensure consistency across codebase

## Data Models

### Session Data Structure
```php
[
    'user_id' => int,
    'name' => string,
    'email' => string,
    'role' => string,
    'logged_in' => bool
]
```

No changes to session structure needed. Logout control is handled via database flag.

### Cookie Structure
```php
// Cookies to be cleared
'remember_token' => string (64 chars hex)
'user_id' => int
```

### Database - users table
```sql
remember_token VARCHAR(255) NULL
remember_token_expires DATETIME NULL
remember_token_active TINYINT(1) DEFAULT 1  // NEW: Flag to mark token as active/inactive
```

When user logs out, we set `remember_token_active = 0` instead of clearing the token. This allows:
- Token remains in database for future use
- User can login again from another device with valid cookie
- Logout only affects the current session, not the token itself


## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system-essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

### Property Reflection

After analyzing all acceptance criteria, most of them are specific examples of the logout flow rather than universal properties. However, we identified one key property:

**Property 1: Logout consistency across user roles**
*For any* user role (admin, reviewer, staff, dosen, kaprodi), the logout process should execute the same cleanup steps: clear database token, clear cookies, destroy session, and redirect to login.
**Validates: Requirements 3.2**

### Example-Based Tests

Since most acceptance criteria are specific examples rather than universal properties, they will be tested using unit tests:

**Example 1: Database token deactivated**
Test that after logout, the remember_token_active in the database is 0.
**Validates: Requirements 1.1**

**Example 2: Cookies cleared properly**
Test that after logout, remember_token and user_id cookies are not present in the response.
**Validates: Requirements 1.2**

**Example 3: Session destroyed**
Test that after logout, session data is empty or logged_in is false.
**Validates: Requirements 1.3**

**Example 4: Auto-login prevented with inactive token**
Test that after logout (token_active = 0), accessing the login page doesn't trigger auto-login even if cookies exist.
**Validates: Requirements 1.4, 2.1, 2.4**

**Example 5: Redirect with success message**
Test that logout redirects to /login with a success flash message.
**Validates: Requirements 1.5**

**Example 6: Cookies cleared before redirect**
Test that cookies are cleared before the redirect response is sent.
**Validates: Requirements 2.2**

**Example 7: Protected page access after logout**
Test that accessing a protected page after logout redirects to login without auto-login.
**Validates: Requirements 2.3**

**Example 8: No auto-login after browser close**
Test that after logout and session clear (simulating browser close), accessing the site doesn't auto-login.
**Validates: Requirements 2.5**

## Error Handling

### Cookie Deletion Failures
- **Issue**: Cookies might not be deleted due to browser settings or path mismatches
- **Solution**: Use CodeIgniter's `delete_cookie()` helper with explicit parameters (name, domain, path, prefix)
- **Fallback**: Set token_active = 0 first, so even if cookies persist, they become invalid for auto-login

### Session Destruction Failures
- **Issue**: Session might not be destroyed properly
- **Solution**: Use `session()->destroy()` which handles all cleanup
- **Verification**: Check `session()->get('logged_in')` returns null after logout

### Database Update Failures
- **Issue**: Database update to set token_active = 0 might fail
- **Solution**: Wrap in try-catch, log errors, but continue with logout process
- **Rationale**: User should still be logged out (session destroyed, cookies cleared) even if DB update fails

### Race Conditions
- **Issue**: Multiple simultaneous logout requests
- **Solution**: Check if session exists before processing logout
- **Idempotency**: Logout should be safe to call multiple times

## Testing Strategy

### Unit Testing Approach

We will use PHPUnit for unit testing the logout functionality. Tests will focus on:

1. **Logout Flow Tests**
   - Test that logout sets remember_token_active = 0
   - Test that logout clears cookies
   - Test that logout destroys session
   - Test that logout redirects to login page
   - Test that logout sets appropriate flash messages

2. **Auto-Login Prevention Tests**
   - Test that checkRememberMe() skips when token_active = 0
   - Test that checkRememberMe() skips when already logged in
   - Test that checkRememberMe() clears cookies when token is inactive
   - Test that checkRememberMe() works when token_active = 1

3. **Token Reactivation Tests**
   - Test that logging in with Remember Me reactivates existing token
   - Test that token can be used on another device after reactivation

3. **Integration Tests**
   - Test complete logout flow from button click to login page
   - Test that after logout, protected pages are inaccessible
   - Test that after logout, login page doesn't auto-login

### Property-Based Testing Approach

We will use a PHP property-based testing library (e.g., Eris or php-quickcheck) for testing universal properties.

**Property Test 1: Logout consistency across user roles**
- **Library**: Eris or php-quickcheck
- **Iterations**: Minimum 100
- **Tag**: `**Feature: fix-logout-functionality, Property 1: Logout consistency across user roles**`
- **Test**: Generate random user roles, create users with those roles, login, then logout. Verify that for all roles, the same cleanup steps occur (token_active set to 0, cookies cleared, session destroyed).

### Test Configuration

- **Framework**: PHPUnit (already configured in project)
- **Property Testing Library**: Eris (to be added)
- **Test Location**: `tests/unit/Controllers/AuthTest.php`
- **Property Test Location**: `tests/property/LogoutPropertyTest.php`
- **Minimum Iterations**: 100 for property tests

### Test Execution

```bash
# Run all tests
vendor/bin/phpunit

# Run only logout tests
vendor/bin/phpunit tests/unit/Controllers/AuthTest.php

# Run only property tests
vendor/bin/phpunit tests/property/LogoutPropertyTest.php
```

## Implementation Notes

### Cookie Helper Usage

CodeIgniter 4 provides a `delete_cookie()` helper that should be used instead of raw `setcookie()`:

```php
// Load cookie helper
helper('cookie');

// Delete cookie properly
delete_cookie('remember_token');
delete_cookie('user_id');
```

This ensures cookies are deleted with the correct parameters (domain, path, prefix) that match how they were set.

### Token Active Flag Approach

We use a database flag `remember_token_active` to control whether a token can be used for auto-login:

1. **When user logs in with "Remember Me"**:
   - Generate token
   - Set `remember_token_active = 1`
   - Set cookies

2. **When user logs out**:
   - Set `remember_token_active = 0` (deactivate token)
   - Clear cookies from current browser
   - Destroy session
   - Redirect to login

3. **When checkRememberMe() runs**:
   - Check if cookie exists
   - Validate token matches database
   - Check if `remember_token_active = 1`
   - Only auto-login if all conditions are met

### Benefits of This Approach

1. **Multi-device support**: User can logout from one device without affecting other devices
2. **Token reusability**: When user logs in again with "Remember Me", we can reactivate the same token
3. **Security**: Inactive tokens cannot be used for auto-login
4. **Simplicity**: No need for session flags or complex logic

### Implementation Details

1. **In Auth::logout()**:
   - Set `remember_token_active = 0` in database
   - Use `delete_cookie()` helper to clear cookies
   - Destroy session
   - Redirect to login

2. **In Auth::loginProcess()** (when Remember Me is checked):
   - If user already has a token, reactivate it: `remember_token_active = 1`
   - If no token exists, generate new one with `remember_token_active = 1`

3. **In BaseController::checkRememberMe()**:
   - Add check: `if ($user['remember_token_active'] != 1) { clear cookies; return; }`
   - This prevents auto-login with inactive tokens

## Security Considerations

1. **Token Deactivation**: Always set token_active = 0 first to prevent auto-login with existing cookies
2. **Cookie Security**: Use httpOnly and secure flags when setting cookies
3. **Session Security**: Use `session()->destroy()` to properly clean up all session data
4. **CSRF Protection**: Logout should be a GET request (as currently implemented) or POST with CSRF token
5. **Timing Attacks**: Logout should complete quickly regardless of user state
6. **Token Reuse**: Inactive tokens can be reactivated on next login, reducing database writes

## Performance Considerations

1. **Database Query**: One UPDATE query to set token_active = 0 (minimal impact)
2. **Cookie Operations**: Two cookie deletions (negligible impact)
3. **Session Destruction**: One session destroy operation (minimal impact)
4. **Redirect**: Standard HTTP redirect (no performance concern)
5. **Token Reactivation**: On next login, UPDATE instead of INSERT (slightly faster)

Overall, logout performance impact is negligible, and token reuse provides minor performance benefit.

## Deployment Considerations

1. **Database Migration Required**: Need to add `remember_token_active` column to users table
2. **Migration Script**: Will set default value to 1 for existing tokens
3. **No Configuration Changes**: No changes to app configuration needed
4. **Backward Compatibility**: Existing sessions and cookies will work normally after migration
5. **Testing**: Should be tested in staging before production deployment
6. **Rollback**: Revert code changes and optionally drop the new column
