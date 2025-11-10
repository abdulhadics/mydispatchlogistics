# Setup Guide - MyDispatch Logistics PHP

This guide will help you set up the MyDispatch Logistics PHP application on your local development environment.

## 🚀 Quick Start

### Option 1: Using XAMPP (Recommended for Beginners)

1. **Download and Install XAMPP**
   - Download from: https://www.apachefriends.org/
   - Install XAMPP on your system
   - Start Apache and MySQL services from XAMPP Control Panel

2. **Setup the Project**
   ```bash
   # Copy project to XAMPP htdocs folder
   cp -r htmlstore-truck-php C:/xampp/htdocs/
   ```

3. **Database Setup**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Create new database: `logistics_db`
   - Import the schema: File → Import → Choose `database/schema.sql`

4. **Configuration**
   ```bash
   # Copy config file
   cp config/config.example.php config/config.php
   ```
   - Edit `config/config.php` with your settings
   - Default XAMPP settings usually work out of the box

5. **Access the Application**
   - Open: http://localhost/htmlstore-truck-php

### Option 2: Using WAMP (Windows)

1. **Download and Install WAMP**
   - Download from: http://www.wampserver.com/
   - Install and start WAMP services

2. **Setup the Project**
   ```bash
   # Copy project to WAMP www folder
   cp -r htmlstore-truck-php C:/wamp64/www/
   ```

3. **Follow steps 3-5 from XAMPP setup**

### Option 3: Using MAMP (Mac)

1. **Download and Install MAMP**
   - Download from: https://www.mamp.info/
   - Install and start MAMP services

2. **Setup the Project**
   ```bash
   # Copy project to MAMP htdocs folder
   cp -r htmlstore-truck-php /Applications/MAMP/htdocs/
   ```

3. **Follow steps 3-5 from XAMPP setup**

### Option 4: Using PHP Built-in Server

1. **Prerequisites**
   - PHP 7.4+ installed
   - MySQL server running

2. **Setup Database**
   ```bash
   # Create database
   mysql -u root -p -e "CREATE DATABASE logistics_db;"
   
   # Import schema
   mysql -u root -p logistics_db < database/schema.sql
   ```

3. **Configuration**
   ```bash
   # Copy config file
   cp config/config.example.php config/config.php
   
   # Edit config.php with your database credentials
   ```

4. **Start Server**
   ```bash
   # Start PHP development server
   php -S localhost:8000
   ```

5. **Access the Application**
   - Open: http://localhost:8000

## 🔧 Configuration Details

### Database Configuration

Edit `config/config.php`:

```php
// Database Configuration
define('DB_HOST', 'localhost');        // Database host
define('DB_NAME', 'logistics_db');     // Database name
define('DB_USER', 'root');             // Database username
define('DB_PASS', '');                 // Database password
```

### Application URL

Update the APP_URL to match your setup:

```php
// For XAMPP/WAMP/MAMP
define('APP_URL', 'http://localhost/htmlstore-truck-php');

// For PHP built-in server
define('APP_URL', 'http://localhost:8000');

// For custom port
define('APP_URL', 'http://localhost:3000');
```

## 🗄️ Database Setup

### Method 1: Using phpMyAdmin (XAMPP/WAMP/MAMP)

1. Open phpMyAdmin in your browser
2. Click "New" to create a database
3. Name it `logistics_db`
4. Select the database
5. Click "Import" tab
6. Choose `database/schema.sql` file
7. Click "Go"

### Method 2: Using Command Line

```bash
# Connect to MySQL
mysql -u root -p

# Create database
CREATE DATABASE logistics_db;

# Exit MySQL
exit;

# Import schema
mysql -u root -p logistics_db < database/schema.sql
```

### Method 3: Using MySQL Workbench

1. Open MySQL Workbench
2. Connect to your MySQL server
3. Create new schema named `logistics_db`
4. Open SQL script: `database/schema.sql`
5. Execute the script

## 🔐 Demo Accounts

After setting up the database, you can use these demo accounts:

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@logistics.com | admin123 |
| Driver | driver@example.com | driver123 |
| Customer | customer@example.com | customer123 |

## 🐛 Troubleshooting

### Common Issues

1. **Database Connection Error**
   - Check if MySQL service is running
   - Verify database credentials in `config/config.php`
   - Ensure database `logistics_db` exists

2. **Page Not Found (404)**
   - Check if web server is running
   - Verify project is in correct directory
   - Check URL path

3. **Permission Denied**
   - Ensure web server has read access to project files
   - Check file permissions (should be 644 for files, 755 for directories)

4. **CSS/JS Not Loading**
   - Check if assets folder exists and is accessible
   - Verify file paths in HTML
   - Clear browser cache

5. **Login Not Working**
   - Check if database was imported correctly
   - Verify demo accounts exist in database
   - Check PHP error logs

### Debug Mode

To enable debug mode, edit `config/config.php`:

```php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

### Check PHP Version

```bash
php -v
```

Ensure you have PHP 7.4 or higher.

### Check MySQL Connection

Create a test file `test_db.php`:

```php
<?php
require_once 'config/config.php';
require_once 'config/database.php';

try {
    $db = getDB();
    echo "Database connection successful!";
} catch (Exception $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>
```

## 📁 File Permissions

### Linux/Mac
```bash
# Set proper permissions
find . -type f -exec chmod 644 {} \;
find . -type d -exec chmod 755 {} \;

# Make uploads directory writable
chmod 755 uploads/
```

### Windows
- Right-click project folder → Properties → Security
- Ensure web server user has read/execute permissions

## 🔄 Updates

To update the application:

1. Backup your database
2. Replace application files
3. Run any new database migrations
4. Update configuration if needed
5. Test the application

## 📞 Support

If you encounter issues:

1. Check this troubleshooting guide
2. Review PHP and MySQL error logs
3. Verify all requirements are met
4. Contact your instructor for help

## 🎯 Next Steps

After successful setup:

1. Explore the admin panel
2. Test user registration/login
3. Try the contact form
4. Review the code structure
5. Customize as needed for your course project

---

**Note**: This setup guide assumes basic familiarity with web development. If you're new to PHP/MySQL, consider starting with XAMPP for the easiest setup experience.
