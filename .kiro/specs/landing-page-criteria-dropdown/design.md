# Design Document

## Overview

Implementasi dropdown menu "Kriteria" di landing page dengan 6 form terpisah untuk setiap kriteria UI GreenMetric. Dropdown akan ditempatkan di navigation bar antara menu "Program" dan "Berita", dengan setiap kriteria mengarah ke halaman form yang menampilkan informasi detail dan data statistik yang konsisten dengan dashboard.

## Architecture

### Frontend Components
- **Landing Page Navigation**: Modifikasi navigation bar untuk menambahkan dropdown "Kriteria"
- **Dropdown Component**: Komponen dropdown yang menampilkan 6 kriteria UI GreenMetric
- **Criteria Forms**: 6 halaman form terpisah untuk setiap kriteria
- **Data Integration**: Integrasi dengan data dashboard untuk konsistensi informasi

### Backend Components
- **Landing Controller**: Controller untuk menangani routing dan data landing page
- **Criteria Controller**: Controller baru untuk menangani form kriteria
- **Data Service**: Service untuk mengambil data kriteria dari dashboard
- **Route Configuration**: Konfigurasi routing untuk form kriteria

## Components and Interfaces

### 1. Navigation Bar Component
```php
// Modifikasi navigation bar di landing page
class LandingNavigation {
    - renderNavigationBar()
    - renderCriteriaDropdown()
    - getCriteriaList()
}
```

### 2. Criteria Controller
```php
class CriteriaController extends BaseController {
    + settingInfrastructure()
    + energyClimate()
    + wasteManagement()
    + waterManagement()
    + transportation()
    + educationResearch()
    - getCriteriaData($criteriaType)
    - renderCriteriaForm($data)
}
```

### 3. Criteria Data Service
```php
class CriteriaDataService {
    + getCriteriaStatistics($criteriaType)
    + getCriteriaTargets($criteriaType)
    + getCriteriaProgress($criteriaType)
    - mapDashboardData($criteriaType)
}
```

## Data Models

### Criteria Data Structure
```php
$criteriaData = [
    'name' => 'Setting & Infrastructure',
    'code' => 'SI',
    'description' => 'Detailed description of the criteria',
    'current_score' => 68,
    'target_2028' => 90,
    'progress_percentage' => 75,
    'status' => 'On Track',
    'icon' => 'building',
    'color' => '#667eea',
    'weight' => '15%',
    'details' => [
        'sub_criteria' => [...],
        'indicators' => [...],
        'achievements' => [...]
    ]
];
```

### Navigation Menu Structure
```php
$navigationMenu = [
    'deskripsi' => ['url' => '#deskripsi', 'label' => 'Deskripsi'],
    'statistik' => ['url' => '#statistik', 'label' => 'Statistik'],
    'program' => ['url' => '#program', 'label' => 'Program'],
    'kriteria' => [
        'label' => 'Kriteria',
        'dropdown' => true,
        'items' => [
            'si' => ['url' => '/kriteria/setting-infrastructure', 'label' => 'Setting & Infrastructure'],
            'ec' => ['url' => '/kriteria/energy-climate', 'label' => 'Energy & Climate Change'],
            'ws' => ['url' => '/kriteria/waste', 'label' => 'Waste'],
            'wr' => ['url' => '/kriteria/water', 'label' => 'Water'],
            'tr' => ['url' => '/kriteria/transportation', 'label' => 'Transportation'],
            'ed' => ['url' => '/kriteria/education-research', 'label' => 'Education & Research']
        ]
    ],
    'berita' => ['url' => '#berita', 'label' => 'Berita'],
    'informasi' => ['url' => '#informasi', 'label' => 'Informasi'],
    'login' => ['url' => '/login', 'label' => 'Login']
];
```

## Correctness Properties

*A property is a characteristic or behavior that should hold true across all valid executions of a system-essentially, a formal statement about what the system should do. Properties serve as the bridge between human-readable specifications and machine-verifiable correctness guarantees.*

### Property 1: Navigation Menu Consistency
*For any* landing page load, the navigation bar should display the "Kriteria" dropdown in the correct position between "Program" and "Berita" with all 6 criteria items
**Validates: Requirements 4.2**

### Property 2: Dropdown Functionality
*For any* user interaction with the "Kriteria" dropdown, clicking should toggle the dropdown visibility and clicking outside should close it
**Validates: Requirements 1.4**

### Property 3: Criteria Form Navigation
*For any* criteria item clicked in the dropdown, the system should navigate to the corresponding criteria form page
**Validates: Requirements 2.1, 2.2, 2.3, 2.4, 2.5, 2.6**

### Property 4: Data Consistency
*For any* criteria form displayed, the statistical data should match exactly with the corresponding data shown in the dashboard
**Validates: Requirements 5.1, 5.2, 5.3, 5.4**

### Property 5: Responsive Layout
*For any* screen size (desktop, tablet, mobile), the dropdown and criteria forms should display with appropriate responsive layout
**Validates: Requirements 6.1, 6.2, 6.3, 6.4, 6.5**

### Property 6: Form Content Completeness
*For any* criteria form page, it should display the criteria title, description, statistics, targets, and a back button
**Validates: Requirements 3.1, 3.2, 3.3, 3.4, 3.5**

## Error Handling

### Navigation Errors
- **Missing Criteria Data**: Jika data kriteria tidak tersedia, tampilkan pesan error yang user-friendly
- **Invalid Criteria Route**: Redirect ke landing page jika route kriteria tidak valid
- **Data Loading Failure**: Tampilkan skeleton loading atau fallback content

### Dropdown Errors
- **JavaScript Disabled**: Dropdown tetap berfungsi dengan fallback CSS-only
- **Mobile Touch Issues**: Implementasi touch-friendly dropdown untuk mobile devices
- **Browser Compatibility**: Ensure dropdown works across different browsers

### Form Display Errors
- **Missing Form Data**: Tampilkan placeholder content jika data kriteria tidak tersedia
- **Image Loading Failure**: Provide fallback icons untuk setiap kriteria
- **Responsive Issues**: Implement graceful degradation untuk berbagai screen sizes

## Testing Strategy

### Unit Testing
- Test navigation bar rendering dengan dropdown "Kriteria"
- Test setiap criteria controller method
- Test data service untuk konsistensi dengan dashboard
- Test responsive behavior pada berbagai screen sizes

### Property-Based Testing
- **Property Testing Framework**: PHPUnit dengan Faker untuk generate test data
- **Test Configuration**: Minimum 100 iterations per property test
- **Property Test Coverage**: Setiap correctness property harus diimplementasikan sebagai property-based test

### Integration Testing
- Test end-to-end navigation dari landing page ke criteria forms
- Test data integration antara dashboard dan criteria forms
- Test responsive behavior pada real devices
- Test browser compatibility untuk dropdown functionality

### Manual Testing
- User acceptance testing untuk navigation flow
- Visual testing untuk consistency dengan design
- Mobile device testing untuk touch interactions
- Performance testing untuk page load times