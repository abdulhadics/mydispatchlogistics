@echo off
REM MyDispatch Logistics - Windows Deployment Script
REM Run this script to prepare your application for production deployment

echo.
echo 🚀 MyDispatch Logistics - Production Deployment Script
echo ==================================================
echo.

REM Check if required files exist
echo 📋 Checking required files...

if exist "config\config.php" (
    echo ✅ config\config.php exists
) else (
    echo ❌ config\config.php missing - Please create this file
    pause
    exit /b 1
)

if exist "database\schema.sql" (
    echo ✅ database\schema.sql exists
) else (
    echo ❌ database\schema.sql missing - Please create this file
    pause
    exit /b 1
)

if exist ".htaccess" (
    echo ✅ .htaccess exists
) else (
    echo ❌ .htaccess missing - Please create this file
    pause
    exit /b 1
)

if exist "pages\404.php" (
    echo ✅ pages\404.php exists
) else (
    echo ❌ pages\404.php missing - Please create this file
    pause
    exit /b 1
)

if exist "pages\500.php" (
    echo ✅ pages\500.php exists
) else (
    echo ❌ pages\500.php missing - Please create this file
    pause
    exit /b 1
)

REM Create uploads directory if it doesn't exist
echo.
echo 📁 Creating uploads directory...
if not exist "uploads" mkdir uploads

REM Create error log file
echo 📝 Creating error log file...
if not exist "error.log" echo. > error.log

REM Check if PHP is available
echo.
echo 🐘 Checking PHP availability...
php -v >nul 2>&1
if %errorlevel% == 0 (
    echo ✅ PHP is available
    php -r "echo 'PHP Version: ' . PHP_VERSION . PHP_EOL;"
) else (
    echo ⚠️  PHP not found in PATH - Please install PHP or add to PATH
)

REM Create backup of config file
echo.
echo 💾 Creating backup of config file...
if exist "config\config.php" (
    copy "config\config.php" "config\config.php.backup" >nul
    echo ✅ Backup created: config\config.php.backup
)

REM Display deployment checklist
echo.
echo 📋 DEPLOYMENT CHECKLIST:
echo ========================
echo 1. ✅ Update config\config.php with production settings:
echo    - APP_URL: https://yourdomain.com
echo    - Database credentials from your hosting provider
echo    - Secret key: Generate a random 32-character string
echo.
echo 2. ✅ Upload all files to your web server:
echo    - Upload to public_html or www directory
echo    - Maintain folder structure
echo.
echo 3. ✅ Set up database:
echo    - Create database in hosting control panel
echo    - Import database\schema.sql via phpMyAdmin
echo    - Update admin password
echo.
echo 4. ✅ Configure server:
echo    - Ensure .htaccess file is uploaded
echo    - Set proper file permissions (644 for files, 755 for directories)
echo    - Enable SSL certificate
echo.
echo 5. ✅ Test your website:
echo    - Visit your domain
echo    - Test user registration/login
echo    - Test contact form
echo    - Test admin panel
echo.
echo 🎉 Deployment preparation complete!
echo.
echo Next steps:
echo - Update config\config.php with your production settings
echo - Upload files to your web server
echo - Set up database and test
echo.
echo For detailed instructions, see DEPLOYMENT.md
echo.
pause
