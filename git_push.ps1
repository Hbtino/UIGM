# Set environment variables
$env:GIT_EDITOR = "true"

# Configure git
git config core.editor "true"

# Add all files
Write-Host "Adding all files..."
git add .

# Commit changes
Write-Host "Committing changes..."
git commit -m "Complete UIGM project with all features and criteria pages"

# Remove existing origin if exists
Write-Host "Setting up remote..."
git remote remove origin 2>$null

# Add remote origin
git remote add origin https://github.com/Hbtino/UIGM.git

# Push to main branch
Write-Host "Pushing to GitHub..."
git push -u origin main

Write-Host "Done!"