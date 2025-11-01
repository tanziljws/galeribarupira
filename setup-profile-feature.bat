@echo off
echo ========================================
echo User Profile Feature Setup
echo ========================================
echo.

echo Step 1: Running database migration...
php artisan migrate
echo.

echo Step 2: Creating storage link...
php artisan storage:link
echo.

echo Step 3: Creating profile photos directory...
if not exist "storage\app\public\profile_photos" mkdir "storage\app\public\profile_photos"
echo Profile photos directory created!
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo You can now:
echo 1. Login to your account
echo 2. Go to http://127.0.0.1:8000/beranda
echo 3. Click on your profile in the navbar
echo 4. View your likes and bookmarks
echo 5. Edit your profile and upload a photo
echo.
echo Note: Profile only appears on the beranda page!
echo.
pause
