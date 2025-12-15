@echo off
set GIT_EDITOR=true
git config core.editor true
git add .
git commit -m "Complete UIGM project with all features and criteria pages"
git remote remove origin
git remote add origin https://github.com/Hbtino/UIGM.git
git push -u origin main
pause