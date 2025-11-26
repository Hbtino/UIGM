# Implementation Plan

- [x] 1. Create database migration for remember_token_active column


  - Create migration file to add `remember_token_active` TINYINT(1) DEFAULT 1 to users table
  - Set default value to 1 for all existing records
  - Run migration to update database schema
  - _Requirements: 3.1, 3.2_

- [x] 2. Update Auth Controller logout method


  - [x] 2.1 Modify Auth::logout() to set remember_token_active = 0


    - Load UserModel
    - Get current user_id from session
    - Update database: set remember_token_active = 0 for current user
    - _Requirements: 1.1, 1.4, 2.1_
  
  - [x] 2.2 Update cookie clearing to use CodeIgniter helper

    - Load cookie helper
    - Replace setcookie() calls with delete_cookie()
    - Clear 'remember_token' cookie
    - Clear 'user_id' cookie
    - _Requirements: 1.2, 2.2_
  
  - [x] 2.3 Ensure proper cleanup sequence

    - Verify order: deactivate token → clear cookies → destroy session → redirect
    - Add error handling for database update failures
    - Ensure session is destroyed even if DB update fails
    - _Requirements: 1.3, 1.5_

- [x] 3. Update BaseController checkRememberMe method


  - [x] 3.1 Add token active status check


    - After finding user by token, check if remember_token_active == 1
    - If token is inactive (0), clear cookies and return without auto-login
    - Only proceed with auto-login if token is active
    - _Requirements: 2.1, 2.3, 2.4, 2.5_
  
  - [x] 3.2 Update cookie clearing for inactive tokens


    - Use delete_cookie() helper instead of setcookie()
    - Clear both remember_token and user_id cookies
    - _Requirements: 2.2_

- [x] 4. Update Auth Controller loginProcess method


  - [x] 4.1 Add token reactivation logic


    - When Remember Me is checked, check if user already has a token
    - If token exists, reactivate it: set remember_token_active = 1
    - If no token exists, generate new token with remember_token_active = 1
    - Update token expiry date
    - _Requirements: 3.2, 3.4_
  
  - [x] 4.2 Ensure cookies are set correctly

    - Set remember_token cookie with httpOnly and secure flags
    - Set user_id cookie with same parameters
    - Use consistent cookie parameters across the application
    - _Requirements: 3.3_

- [x] 5. Remove duplicate logout method from Login Controller


  - Delete the logout() method from Login Controller
  - Ensure all logout routes point to Auth::logout()
  - Verify no other controllers have duplicate logout implementations
  - _Requirements: 4.1, 4.3_

- [x] 6. Checkpoint - Ensure all tests pass


  - Ensure all tests pass, ask the user if questions arise.

