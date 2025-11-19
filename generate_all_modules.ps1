# PowerShell Script to Generate All 3 Modules
# Water Management, Waste Management, Education & Research

Write-Host "=========================================" -ForegroundColor Cyan
Write-Host "GENERATE ALL MODULES - UI GREENMETRIC" -ForegroundColor Cyan
Write-Host "=========================================" -ForegroundColor Cyan
Write-Host ""

# Check if energy_climate exists
if (-not (Test-Path "app/Controllers/EnergyClimateController.php")) {
    Write-Host "ERROR: Energy Climate module not found!" -ForegroundColor Red
    Write-Host "Please ensure Energy Climate module is complete first." -ForegroundColor Red
    exit 1
}

Write-Host "Step 1: Creating Water Management Module..." -ForegroundColor Yellow

# Water Management
Write-Host "  - Copying Models..." -ForegroundColor Gray
Copy-Item "app/Models/EnergyClimateModel.php" "app/Models/WaterManagementModel.php"
Copy-Item "app/Models/EnergyClimateRevisionModel.php" "app/Models/WaterManagementRevisionModel.php"

Write-Host "  - Copying Controller..." -ForegroundColor Gray
Copy-Item "app/Controllers/EnergyClimateController.php" "app/Controllers/WaterManagementController.php"

Write-Host "  - Copying Views..." -ForegroundColor Gray
if (Test-Path "app/Views/kriteria/water_management") {
    Remove-Item "app/Views/kriteria/water_management" -Recurse -Force
}
Copy-Item "app/Views/kriteria/energy_climate" "app/Views/kriteria/water_management" -Recurse

Write-Host "  - Creating upload folder..." -ForegroundColor Gray
New-Item -ItemType Directory -Force -Path "writable/uploads/water_management" | Out-Null

Write-Host "  - Replacing content..." -ForegroundColor Gray
# Replace in Models
(Get-Content "app/Models/WaterManagementModel.php") -replace 'energy_climate', 'water_management' -replace 'EnergyClimate', 'WaterManagement' | Set-Content "app/Models/WaterManagementModel.php"
(Get-Content "app/Models/WaterManagementRevisionModel.php") -replace 'energy_climate', 'water_management' -replace 'EnergyClimate', 'WaterManagement' | Set-Content "app/Models/WaterManagementRevisionModel.php"

# Replace in Controller
(Get-Content "app/Controllers/WaterManagementController.php") -replace 'energy_climate', 'water_management' -replace 'EnergyClimate', 'WaterManagement' -replace 'energy-climate', 'water-management' -replace 'Energy & Climate Change', 'Water Management' | Set-Content "app/Controllers/WaterManagementController.php"

# Replace in Views
Get-ChildItem "app/Views/kriteria/water_management" -Filter *.php -Recurse | ForEach-Object {
    (Get-Content $_.FullName) -replace 'energy_climate', 'water_management' -replace 'EnergyClimate', 'WaterManagement' -replace 'energy-climate', 'water-management' -replace 'Energy & Climate Change', 'Water Management' | Set-Content $_.FullName
}

Write-Host "  ✓ Water Management created!" -ForegroundColor Green
Write-Host ""

# Waste Management
Write-Host "Step 2: Creating Waste Management Module..." -ForegroundColor Yellow

Write-Host "  - Copying Models..." -ForegroundColor Gray
Copy-Item "app/Models/EnergyClimateModel.php" "app/Models/WasteManagementModel.php"
Copy-Item "app/Models/EnergyClimateRevisionModel.php" "app/Models/WasteManagementRevisionModel.php"

Write-Host "  - Copying Controller..." -ForegroundColor Gray
Copy-Item "app/Controllers/EnergyClimateController.php" "app/Controllers/WasteManagementController.php"

Write-Host "  - Copying Views..." -ForegroundColor Gray
if (Test-Path "app/Views/kriteria/waste_management") {
    Remove-Item "app/Views/kriteria/waste_management" -Recurse -Force
}
Copy-Item "app/Views/kriteria/energy_climate" "app/Views/kriteria/waste_management" -Recurse

Write-Host "  - Creating upload folder..." -ForegroundColor Gray
New-Item -ItemType Directory -Force -Path "writable/uploads/waste_management" | Out-Null

Write-Host "  - Replacing content..." -ForegroundColor Gray
# Replace in Models
(Get-Content "app/Models/WasteManagementModel.php") -replace 'energy_climate', 'waste_management' -replace 'EnergyClimate', 'WasteManagement' | Set-Content "app/Models/WasteManagementModel.php"
(Get-Content "app/Models/WasteManagementRevisionModel.php") -replace 'energy_climate', 'waste_management' -replace 'EnergyClimate', 'WasteManagement' | Set-Content "app/Models/WasteManagementRevisionModel.php"

# Replace in Controller
(Get-Content "app/Controllers/WasteManagementController.php") -replace 'energy_climate', 'waste_management' -replace 'EnergyClimate', 'WasteManagement' -replace 'energy-climate', 'waste-management' -replace 'Energy & Climate Change', 'Waste Management' | Set-Content "app/Controllers/WasteManagementController.php"

# Replace in Views
Get-ChildItem "app/Views/kriteria/waste_management" -Filter *.php -Recurse | ForEach-Object {
    (Get-Content $_.FullName) -replace 'energy_climate', 'waste_management' -replace 'EnergyClimate', 'WasteManagement' -replace 'energy-climate', 'waste-management' -replace 'Energy & Climate Change', 'Waste Management' | Set-Content $_.FullName
}

Write-Host "  ✓ Waste Management created!" -ForegroundColor Green
Write-Host ""

# Education & Research
Write-Host "Step 3: Creating Education & Research Module..." -ForegroundColor Yellow

Write-Host "  - Copying Models..." -ForegroundColor Gray
Copy-Item "app/Models/EnergyClimateModel.php" "app/Models/EducationResearchModel.php"
Copy-Item "app/Models/EnergyClimateRevisionModel.php" "app/Models/EducationResearchRevisionModel.php"

Write-Host "  - Copying Controller..." -ForegroundColor Gray
Copy-Item "app/Controllers/EnergyClimateController.php" "app/Controllers/EducationResearchController.php"

Write-Host "  - Copying Views..." -ForegroundColor Gray
if (Test-Path "app/Views/kriteria/education_research") {
    Remove-Item "app/Views/kriteria/education_research" -Recurse -Force
}
Copy-Item "app/Views/kriteria/energy_climate" "app/Views/kriteria/education_research" -Recurse

Write-Host "  - Creating upload folder..." -ForegroundColor Gray
New-Item -ItemType Directory -Force -Path "writable/uploads/education_research" | Out-Null

Write-Host "  - Replacing content..." -ForegroundColor Gray
# Replace in Models
(Get-Content "app/Models/EducationResearchModel.php") -replace 'energy_climate', 'education_research' -replace 'EnergyClimate', 'EducationResearch' | Set-Content "app/Models/EducationResearchModel.php"
(Get-Content "app/Models/EducationResearchRevisionModel.php") -replace 'energy_climate', 'education_research' -replace 'EnergyClimate', 'EducationResearch' | Set-Content "app/Models/EducationResearchRevisionModel.php"

# Replace in Controller
(Get-Content "app/Controllers/EducationResearchController.php") -replace 'energy_climate', 'education_research' -replace 'EnergyClimate', 'EducationResearch' -replace 'energy-climate', 'education-research' -replace 'Energy & Climate Change', 'Education & Research' | Set-Content "app/Controllers/EducationResearchController.php"

# Replace in Views
Get-ChildItem "app/Views/kriteria/education_research" -Filter *.php -Recurse | ForEach-Object {
    (Get-Content $_.FullName) -replace 'energy_climate', 'education_research' -replace 'EnergyClimate', 'EducationResearch' -replace 'energy-climate', 'education-research' -replace 'Energy & Climate Change', 'Education & Research' | Set-Content $_.FullName
}

Write-Host "  ✓ Education and Research created!" -ForegroundColor Green
Write-Host ""

Write-Host "=========================================" -ForegroundColor Cyan
Write-Host "GENERATION COMPLETE!" -ForegroundColor Green
Write-Host "=========================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "Files created:" -ForegroundColor Yellow
Write-Host "  ✓ 6 Models (3 main + 3 revisions)" -ForegroundColor Green
Write-Host "  ✓ 3 Controllers" -ForegroundColor Green
Write-Host "  ✓ 24 Views (8 per module)" -ForegroundColor Green
Write-Host "  ✓ 3 Upload folders" -ForegroundColor Green
Write-Host ""

Write-Host "NEXT STEPS:" -ForegroundColor Yellow
Write-Host "1. Update field names in each Model allowedFields" -ForegroundColor White
Write-Host "2. Update auto-calculation logic in each Model" -ForegroundColor White
Write-Host "3. Add routes in app/Config/Routes.php" -ForegroundColor White
Write-Host "4. Update dashboard links" -ForegroundColor White
Write-Host "5. Run migrations: php spark migrate" -ForegroundColor White
Write-Host "6. Test each module" -ForegroundColor White
Write-Host ""

Write-Host "For detailed field configurations, see:" -ForegroundColor Cyan
Write-Host "  - WATER_MANAGEMENT_COMPLETE.md" -ForegroundColor Gray
Write-Host "  - IMPLEMENTATION_ROADMAP.md" -ForegroundColor Gray
Write-Host ""

Write-Host "Done!" -ForegroundColor Green
