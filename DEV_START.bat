@echo off
title Graduate Career Platform - Dev Server
echo ===========================================
echo   Starting Graduate Career Platform Dev
echo ===========================================
echo.
echo [1/2] Starting Laravel Backend (PHP Artisan Serve)...
start cmd /k "title Laravel Backend && php artisan serve"
echo.
echo [2/2] Starting React Frontend (NPM Run Dev)...
start cmd /k "title React Frontend && npm run dev"
echo.
echo ===========================================
echo   Both servers are starting in new windows.
echo   Happy coding!
echo ===========================================
pause
