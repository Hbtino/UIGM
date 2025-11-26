# Design Document - Fixed Sidebar Layout

## Overview

Sistem akan menggunakan layout dengan fixed sidebar di sisi kiri yang konsisten di seluruh aplikasi dashboard. Layout ini menggunakan template CodeIgniter 4 dengan struktur view yang modular, memungkinkan konten dinamis berubah sesuai menu yang diklik sambil mempertahankan sidebar dan topbar yang tetap. Warna hijau POLBAN (#149823) akan dipertahankan sebagai identitas visual utama.

## Architecture

### Layout Structure

```
┌─────────────────────────────────────────────────────────┐
│                    Fixed Sidebar (280px)                │
│  ┌──────────────────────────────────────────────────┐  │
│  │  Sidebar Header (Logo + Title)                   │  │
│  ├──────────────────────────────────────────────────┤  │
│  │  Menu Section 1: Menu Utama                      │  │
│  │    - Dashboard                                   │  │
│  ├──────────────────────────────────────────────────┤  │
│  │  Menu Section 2: Kriteria SDGs                   │  │
│  │    - Pengaturan & Infrastruktur                  │  │
│  │    - Energi & Perubahan Iklim                    │  │
│  │    - Pengelolaan Air                             │  │
│  │    - Pengelolaan Limbah                          │  │
│  │    - Transportasi                                │  │
│  │    - Pendidikan & Penelitian                     │  │
│  ├──────────────────────────────────────────────────┤  │
│  │  Menu Section 3: Sistem                          │  │
│  │    - Manajemen User (admin only)                 │  │
│  │    - Laporan (with submenu)                      │  │
│  │    - Pengaturan                                  │  │
│  │    - Logout                                      │  │
│  └──────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│                    Main Content Area                     │
│  ┌──────────────────────────────────────────────────┐  │
│  │  Topbar (Sticky)                                 │  │
│  │  ┌────────────────┬──────────────────────────┐  │  │
│  │  │ Page Title     │  User Info + Avatar      │  │  │
│  │  │ Breadcrumb     │                          │  │  │
│  │  └────────────────┴──────────────────────────┘  │  │
│  ├──────────────────────────────────────────────────┤  │
│  │  Content Area (Dynamic)                          │  │
│  │                                                  │  │
│  │  [Content changes based on selected menu]       │  │
│  │                                                  │  │
│  └──────────────────────────────────────────────────┘  │
└─────────────────────────────────────────────────────────┘
```

### View Template Hierarchy

```
layouts/sidebar_layout.php (Base Template)
├── Section: styles (Optional CSS)
├── Sidebar Component
│   ├── Sidebar Header
│   └── Sidebar Menu
├── Main Content
│   ├── Topbar Component
│   └── Content Area
│       └── Section: content (Dynamic Content)
└── Section: scripts (Optional JavaScript)
```

## Components and Interfaces

### 1. Base Layout Template (sidebar_layout.php)

**Location:** `app/Views/layouts/sidebar_layout.php`

**Responsibilities:**
- Provide fixed sidebar structure
- Provide topbar with user information
- Define content sections for child views
- Handle responsive behavior for mobile devices
- Include necessary CSS and JavaScript libraries

**Data Requirements:**
```php
[
    'title' => string,           // Page title
    'page' => string,            // Current page identifier for active menu
    'breadcrumb' => string,      // Breadcrumb text
    'user_name' => string,       // Logged in user name
    'user_role' => string,       // User role (admin, dosen, kaprodi, etc)
    'profile_photo' => string|null, // Profile photo filename
    'pending_users' => int       // Count of pending users (admin only)
]
```

### 2. Sidebar Component

**Structure:**
- **Sidebar Header**: Logo, application name, tagline
- **Menu Sections**: Grouped menu items with section titles
- **Menu Items**: Individual navigation links with icons
- **Submenu**: Collapsible submenu for hierarchical navigation

**Menu Item States:**
- Default: `rgba(255,255,255,0.9)` text color
- Hover: `rgba(255,255,255,0.1)` background, padding-left increases
- Active: `rgba(255,255,255,0.15)` background, 4px white left border, bold text

**Submenu Behavior:**
- Toggle on click
- Icon rotation (180deg) when open
- Darker background `rgba(0,0,0,0.2)`
- Deeper indentation (62px padding-left)

### 3. Topbar Component

**Structure:**
- **Left Section**: Page title and breadcrumb
- **Right Section**: User information with avatar

**Styling:**
- Background: white
- Box shadow: `0 2px 10px rgba(0,0,0,0.05)`
- Position: sticky (top: 0)
- Z-index: 999

### 4. Content Area

**Responsibilities:**
- Display dynamic content based on selected menu
- Maintain consistent padding (30px)
- Responsive padding adjustment for mobile (20px)

### 5. Mobile Toggle Button

**Behavior:**
- Hidden on desktop (>768px)
- Visible on mobile (≤768px)
- Fixed position at bottom-right
- Toggles sidebar visibility

## Data Models

### View Data Structure

Each controller method that renders a view using sidebar layout must pass the following data:

```php
$data = [
    // Required fields
    'title' => 'Page Title',
    'page' => 'page-identifier',  // Used for active menu highlighting
    'user_name' => session()->get('name'),
    'user_role' => session()->get('role'),
    
    // Optional fields
    'breadcrumb' => 'Home / Current Page',
    'profile_photo' => $user['profile_photo'] ?? null,
    'pending_users' => $pendingCount ?? 0,  // Admin only
    
    // Page-specific data
    // ... additional data for the specific page
];
```

### Page Identifier Mapping

| Page | Identifier | Route |
|------|-----------|-------|
| Dashboard | `dashboard` | `/dashboard` |
| Pengaturan & Infrastruktur | `setting-infrastructure` | `/setting-infrastructure` |
| Energi & Perubahan Iklim | `energy-climate` | `/energy-climate` |
| Pengelolaan Air | `water-management` | `/water-management` |
| Pengelolaan Limbah | `waste-management` | `/waste-management` |
| Transportasi | `transportation` | `/transportation` |
| Pendidikan & Penelitian | `education-research` | `/education-research` |
| Manajemen User | `users` | `/users` |
| Laporan Dosen | `laporan` | `/laporan` |
| Laporan Kaprodi | `laporan_kaprodi` | `/laporan/kaprodi` |
| Riwayat Laporan | `riwayat_laporan` | `/laporan/riwayat-*` |
| Pengaturan | `settings` | `/settings` |

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system-essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*


### Property Reflection

After reviewing all testable properties from the prework, I've identified several areas where properties can be consolidated:

**Consolidation Opportunities:**
1. Properties 1.1, 1.2, 1.3, 1.4, 1.5 all test sidebar CSS properties - can be combined into one comprehensive sidebar styling property
2. Properties 2.3 and 8.5 both test active menu highlighting - these are redundant
3. Properties 9.1-9.6 are all testing the same pattern for different pages - can be combined into one property
4. Properties 7.2, 7.3, 7.4 test similar role-based visibility - can be consolidated

**Properties to Keep:**
- Sidebar has correct fixed positioning and styling (combines 1.1-1.5)
- Menu navigation works correctly (2.1)
- Correct content is displayed for each page (2.2)
- Active menu is highlighted correctly (2.3, 8.5 combined)
- Topbar displays correct title and breadcrumb (2.4, 2.5 combined)
- Submenu structure and behavior (3.1-3.5 can be tested together)
- Mobile responsive behavior (4.1-4.5)
- User avatar display logic (5.2, 5.3 combined)
- Topbar displays user information (5.1, 5.4 combined)
- Role-based menu visibility (7.1-7.5 combined)
- SDGs pages use sidebar layout consistently (9.1-9.7 combined)

### Correctness Properties

Property 1: Sidebar fixed positioning and styling
*For any* page using sidebar layout, the sidebar element should have position: fixed, left: 0, width: 280px, background-color: #149823, and overflow-y: auto
**Validates: Requirements 1.1, 1.2, 1.3, 1.4**

Property 2: Main content responsive margin
*For any* page using sidebar layout, when viewport width > 768px, the main content area should have margin-left: 280px, and when viewport width <= 768px, it should have margin-left: 0
**Validates: Requirements 1.5, 4.5**

Property 3: Menu navigation functionality
*For any* menu item in the sidebar, clicking the menu item should navigate to the correct URL associated with that menu
**Validates: Requirements 2.1**

Property 4: Content display matches route
*For any* page identifier, when that page is loaded, the main content area should display the view content associated with that page identifier
**Validates: Requirements 2.2**

Property 5: Active menu highlighting
*For any* page with a given page identifier, the menu item matching that identifier should have the 'active' class with background rgba(255,255,255,0.15) and 4px white left border
**Validates: Requirements 2.3, 8.5**

Property 6: Topbar title and breadcrumb accuracy
*For any* page, the topbar should display the title and breadcrumb text that matches the current page's data
**Validates: Requirements 2.4, 2.5**

Property 7: Submenu structure and toggle behavior
*For any* menu item with submenu, it should display a chevron-down icon, and clicking it should toggle the submenu visibility and rotate the icon 180 degrees
**Validates: Requirements 3.1, 3.2, 3.3**

Property 8: Submenu styling
*For any* submenu when displayed, it should have background rgba(0,0,0,0.2) and submenu items should have padding-left: 62px
**Validates: Requirements 3.4**

Property 9: Submenu navigation and active state
*For any* submenu item, clicking it should navigate to the correct URL and mark that submenu item as active
**Validates: Requirements 3.5**

Property 10: Mobile sidebar visibility
*For any* page, when viewport width <= 768px, the sidebar should have left: -280px (hidden) and the mobile toggle button should be visible
**Validates: Requirements 4.1, 4.2**

Property 11: Mobile sidebar toggle
*For any* page on mobile, clicking the toggle button should add 'show' class to sidebar, changing its left position to 0
**Validates: Requirements 4.3**

Property 12: User avatar display logic
*For any* page, when profile_photo is set, the avatar should display an img element with that photo, and when profile_photo is null, it should display the first letter of user_name with background #149823
**Validates: Requirements 5.2, 5.3**

Property 13: Topbar user information display
*For any* page, the topbar should contain user avatar, user_name, and user_role elements
**Validates: Requirements 5.1, 5.4**

Property 14: Topbar styling
*For any* page, the topbar should have background: white, position: sticky, top: 0, and box-shadow: 0 2px 10px rgba(0,0,0,0.05)
**Validates: Requirements 5.5**

Property 15: Role-based menu visibility
*For any* user role, only menu items appropriate for that role should be rendered in the sidebar (admin sees all, dosen sees dosen menus, kaprodi sees kaprodi menus)
**Validates: Requirements 7.1, 7.2, 7.3, 7.4, 7.5**

Property 16: SDGs pages use sidebar layout consistently
*For any* SDGs criteria page (setting-infrastructure, energy-climate, water-management, waste-management, transportation, education-research), the page should extend from sidebar_layout.php and have the correct page identifier for active menu highlighting
**Validates: Requirements 9.1, 9.2, 9.3, 9.4, 9.5, 9.6, 9.7**

## Error Handling

### Session Validation
- All pages using sidebar layout must check for valid session
- Redirect to login page if session is not valid
- Display appropriate error message

### Missing Data Handling
- If required data (title, page, user_name, user_role) is missing, use default values
- Log warning when required data is missing

### File Not Found
- If profile photo file doesn't exist, fall back to initials display
- No error should be shown to user

### Role Validation
- Validate user role before rendering role-specific menus
- Invalid roles should default to minimal menu set

## Testing Strategy

### Unit Testing

Unit tests will verify specific examples and edge cases:

1. **Template Rendering Tests**
   - Test that sidebar_layout.php renders correctly with minimal data
   - Test that all required sections are present
   - Test edge case: missing optional data (profile_photo, breadcrumb)

2. **Active Menu Logic Tests**
   - Test specific page identifiers map to correct active menu
   - Test edge case: invalid page identifier defaults to no active menu

3. **Role-Based Menu Tests**
   - Test admin role shows all menus
   - Test dosen role shows only dosen menus
   - Test kaprodi role shows only kaprodi menus
   - Test edge case: unknown role shows minimal menus

4. **Avatar Display Tests**
   - Test with valid profile photo
   - Test with null profile photo
   - Test with empty string user name

### Property-Based Testing

Property-based tests will verify universal properties across all inputs using **PHPUnit with Eris** (PHP property-based testing library):

**Configuration:**
- Minimum 100 iterations per property test
- Each property test must reference the design document property number

**Property Tests:**

1. **Property 1: Sidebar fixed positioning and styling**
   - Generate: random page data with valid structure
   - Test: sidebar element has correct CSS properties
   - Tag: `Feature: fixed-sidebar-layout, Property 1: Sidebar fixed positioning and styling`

2. **Property 2: Main content responsive margin**
   - Generate: random viewport widths
   - Test: main content margin-left is correct for viewport size
   - Tag: `Feature: fixed-sidebar-layout, Property 2: Main content responsive margin`

3. **Property 3: Menu navigation functionality**
   - Generate: random menu items from available menus
   - Test: each menu item has correct href attribute
   - Tag: `Feature: fixed-sidebar-layout, Property 3: Menu navigation functionality`

4. **Property 4: Content display matches route**
   - Generate: random page identifiers
   - Test: correct view is rendered for each identifier
   - Tag: `Feature: fixed-sidebar-layout, Property 4: Content display matches route`

5. **Property 5: Active menu highlighting**
   - Generate: random page identifiers
   - Test: menu item with matching identifier has active class
   - Tag: `Feature: fixed-sidebar-layout, Property 5: Active menu highlighting`

6. **Property 6: Topbar title and breadcrumb accuracy**
   - Generate: random page data with title and breadcrumb
   - Test: topbar displays correct title and breadcrumb
   - Tag: `Feature: fixed-sidebar-layout, Property 6: Topbar title and breadcrumb accuracy`

7. **Property 7: Submenu structure and toggle behavior**
   - Generate: random submenu states (open/closed)
   - Test: submenu has correct structure and toggle works
   - Tag: `Feature: fixed-sidebar-layout, Property 7: Submenu structure and toggle behavior`

8. **Property 8: Submenu styling**
   - Generate: random submenu items
   - Test: submenu has correct background and padding
   - Tag: `Feature: fixed-sidebar-layout, Property 8: Submenu styling`

9. **Property 9: Submenu navigation and active state**
   - Generate: random submenu items
   - Test: submenu items have correct href and active state
   - Tag: `Feature: fixed-sidebar-layout, Property 9: Submenu navigation and active state`

10. **Property 10: Mobile sidebar visibility**
    - Generate: random mobile viewport widths (≤768px)
    - Test: sidebar is hidden and toggle button is visible
    - Tag: `Feature: fixed-sidebar-layout, Property 10: Mobile sidebar visibility`

11. **Property 11: Mobile sidebar toggle**
    - Generate: random mobile states
    - Test: toggle button adds 'show' class to sidebar
    - Tag: `Feature: fixed-sidebar-layout, Property 11: Mobile sidebar toggle`

12. **Property 12: User avatar display logic**
    - Generate: random user data with/without profile_photo
    - Test: avatar displays correctly based on profile_photo presence
    - Tag: `Feature: fixed-sidebar-layout, Property 12: User avatar display logic`

13. **Property 13: Topbar user information display**
    - Generate: random user data
    - Test: topbar contains all required user information elements
    - Tag: `Feature: fixed-sidebar-layout, Property 13: Topbar user information display`

14. **Property 14: Topbar styling**
    - Generate: random page data
    - Test: topbar has correct CSS properties
    - Tag: `Feature: fixed-sidebar-layout, Property 14: Topbar styling`

15. **Property 15: Role-based menu visibility**
    - Generate: random user roles (admin, dosen, kaprodi, etc.)
    - Test: only appropriate menus are rendered for each role
    - Tag: `Feature: fixed-sidebar-layout, Property 15: Role-based menu visibility`

16. **Property 16: SDGs pages use sidebar layout consistently**
    - Generate: random SDGs page identifiers
    - Test: each SDGs page extends sidebar_layout and has correct active menu
    - Tag: `Feature: fixed-sidebar-layout, Property 16: SDGs pages use sidebar layout consistently`

### Integration Testing

Integration tests will verify the complete flow:

1. **Full Page Rendering**
   - Test complete page rendering with sidebar layout
   - Verify all components are present and styled correctly

2. **Navigation Flow**
   - Test navigation from dashboard to each SDGs page
   - Verify sidebar remains consistent across navigation

3. **Role-Based Access**
   - Test complete user flow for each role
   - Verify correct menus are visible and functional

## Implementation Notes

### CodeIgniter 4 View Inheritance

Views using sidebar layout should follow this pattern:

```php
<?= $this->extend('layouts/sidebar_layout') ?>

<?= $this->section('content') ?>
<!-- Page content here -->
<?= $this->endSection() ?>

<?= $this->section('styles') ?>
<!-- Optional additional CSS -->
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<!-- Optional additional JavaScript -->
<?= $this->endSection() ?>
```

### Controller Data Preparation

Controllers should prepare data in this format:

```php
public function index()
{
    $session = session();
    if (!$session->get('logged_in')) {
        return redirect()->to('/login');
    }
    
    // Get user data
    $userModel = new \App\Models\UserModel();
    $user = $userModel->find($session->get('user_id'));
    
    $data = [
        'title' => 'Page Title',
        'page' => 'page-identifier',
        'breadcrumb' => 'Home / Current Page',
        'user_name' => $session->get('name'),
        'user_role' => $session->get('role'),
        'profile_photo' => $user['profile_photo'] ?? null,
        // Page-specific data...
    ];
    
    return view('path/to/view', $data);
}
```

### CSS Organization

- Base sidebar styles are in sidebar_layout.php `<style>` section
- Page-specific styles use the `styles` section
- Maintain POLBAN green (#149823) for all sidebar elements
- Use consistent spacing and transitions (0.3s)

### JavaScript Organization

- Base sidebar JavaScript (toggle, submenu) is in sidebar_layout.php
- Page-specific JavaScript uses the `scripts` section
- Use vanilla JavaScript for better performance
- Ensure mobile responsiveness

### Responsive Breakpoints

- Desktop: > 768px (sidebar visible, 280px width)
- Mobile: ≤ 768px (sidebar hidden, toggle button visible)

### Browser Compatibility

- Modern browsers (Chrome, Firefox, Safari, Edge)
- CSS Grid and Flexbox support required
- ES6 JavaScript support required
