# 🚀 XAMPP Setup Guide - MyDispatch Logistics

Complete step-by-step guide to run this project using XAMPP.

## 📋 Prerequisites
 php -S localhost:8000

- XAMPP installed on your Windows machine
- Download from: https://www.apachefriends.org/download.html

---

## 🔧 Step-by-Step Setup

### Step 1: Install XAMPP (if not already installed)

1. Download XAMPP from https://www.apachefriends.org/download.html
2. Run the installer
3. Install to default location: `C:\xampp\`
4. During installation, select:
   - ✅ Apache
   - ✅ MySQL
   - ✅ phpMyAdmin

### Step 2: Copy Project to XAMPP

**Option A: Move your current project**
1. Copy your entire project folder to: `C:\xampp\htdocs\`
2. Rename the folder to something without spaces (recommended):
   - From: `HTMLSTORE TRUCK`
   - To: `htmlstore-truck` or `mydispatch`

**Option B: Keep current location and create symlink** (Advanced)
- Not recommended for beginners

**Recommended folder structure:**
```
C:\xampp\htdocs\
  └── htmlstore-truck\
      ├── assets\
      ├── config\
      ├── database\
      ├── functions\
      ├── includes\
      ├── pages\
      ├── index.php
      └── ...
```

### Step 3: Start XAMPP Services

1. Open **XAMPP Control Panel**
   - Search for "XAMPP Control Panel" in Windows Start menu
   - Or navigate to: `C:\xampp\xampp-control.exe`

2. Start the following services:
   - ✅ **Apache** - Click "Start" button (should turn green)
   - ✅ **MySQL** - Click "Start" button (should turn green)

3. Verify services are running:
   - Both should show green "Running" status
   - If Apache fails to start, check if port 80 is in use
   - If MySQL fails, check if port 3306 is in use

### Step 4: Create Database

**Method 1: Using phpMyAdmin (Easiest)**

1. Open your web browser
2. Go to: `http://localhost/phpmyadmin`
3. Click **"New"** in the left sidebar
4. Database name: `logistics_db`
5. Collation: `utf8mb4_general_ci` (or leave default)
6. Click **"Create"**

5. Import the schema:
   - Select `logistics_db` database (click on it in left sidebar)
   - Click **"Import"** tab at the top
   - Click **"Choose File"** button
   - Navigate to: `C:\xampp\htdocs\htmlstore-truck\database\schema.sql`
   - Click **"Go"** button at the bottom
   - Wait for "Import has been successfully finished" message

**Method 2: Using MySQL Command Line**

1. Open Command Prompt or PowerShell
2. Navigate to XAMPP MySQL:
   ```bash
   cd C:\xampp\mysql\bin
   ```
3. Run MySQL:
   ```bash
   mysql.exe -u root
   ```
4. Create database:
   ```sql
   CREATE DATABASE logistics_db;
   USE logistics_db;
   SOURCE C:/xampp/htdocs/htmlstore-truck/database/schema.sql;
   EXIT;
   ```

### Step 5: Update Configuration

1. Open the config file:
   - Navigate to: `C:\xampp\htdocs\htmlstore-truck\config\config.php`
   - Open with Notepad++ or any text editor

Step : Start PHP’s built-in server

Run:

php -S localhost:8000


You should see output like:

PHP 8.x Development Server (http://localhost:8000) started
tep 3: Open in browser

Go to:

http://localhost:8000


✅ Your site should now work exactly like before — no need for XAMPP or htdocs.
2. Update the APP_URL:
   ```php
   // Change this line:
   define('APP_URL', 'http://localhost:8000');
   
   // To this (replace 'htmlstore-truck' with your actual folder name):
   define('APP_URL', 'http://localhost/htmlstore-truck');
   ```

3. Verify database settings (usually these are correct):
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'logistics_db');
   define('DB_USER', 'root');
   define('DB_PASS', ''); // Usually empty for XAMPP
   ```

4. Save the file

### Step 6: Access Your Website

1. Open your web browser
2. Go to one of these URLs:
   - `http://localhost/htmlstore-truck`
   - `http://localhost/htmlstore-truck/index.php`
   - `http://localhost/htmlstore-truck/index_demo.php`

3. You should see your MyDispatch Logistics homepage!

---

## ✅ Testing Your Setup

### Test 1: Homepage Loads
- Visit: `http://localhost/htmlstore-truck`
- Should see the homepage with navigation

### Test 2: Database Connection
- Try to register a new user
- Check if data saves (go to phpMyAdmin → logistics_db → users table)

### Test 3: Login
Use these demo accounts (if imported from schema):
- **Admin**: `admin@logistics.com` / `admin123`
- **Driver**: `driver@example.com` / `driver123`
- **Customer**: `customer@example.com` / `customer123`

---

## 🐛 Troubleshooting

### Problem: Apache won't start

**Solution 1: Port 80 is in use**
1. Open XAMPP Control Panel
2. Click "Config" next to Apache
3. Select "httpd.conf"
4. Find `Listen 80` and change to `Listen 8080`
5. Save and restart Apache
6. Access site at: `http://localhost:8080/htmlstore-truck`

**Solution 2: Check Windows Services**
1. Press `Win + R`, type `services.msc`
2. Look for "World Wide Web Publishing Service" or "IIS"
3. If running, right-click → Stop
4. Try starting Apache again

### Problem: MySQL won't start

**Solution 1: Port 3306 is in use**
1. Open XAMPP Control Panel
2. Click "Config" next to MySQL
3. Select "my.ini"
4. Find `port=3306` and change to `port=3307`
5. Update config.php: `define('DB_HOST', 'localhost:3307');`
6. Save and restart MySQL

**Solution 2: Check if MySQL is already running**
1. Open Task Manager (Ctrl + Shift + Esc)
2. Look for "mysqld.exe" process
3. End the process if found
4. Try starting MySQL again

### Problem: "Database connection failed"

**Check:**
1. MySQL service is running (green in XAMPP)
2. Database `logistics_db` exists in phpMyAdmin
3. Config.php has correct credentials:
   ```php
   define('DB_USER', 'root');
   define('DB_PASS', ''); // Empty for XAMPP default
   ```

**Test connection:**
1. Go to: `http://localhost/phpmyadmin`
2. Try to access `logistics_db` database
3. If you can see it, database exists

### Problem: "404 Not Found" or "Page not found"

**Check:**
1. Project folder is in: `C:\xampp\htdocs\`
2. Folder name matches URL (case-sensitive on some systems)
3. Try: `http://localhost/htmlstore-truck/index.php` directly

### Problem: CSS/JS not loading

**Check:**
1. Open browser Developer Tools (F12)
2. Go to Network tab
3. Refresh page
4. Look for red (failed) requests
5. Check file paths in HTML source

### Problem: "Access Denied" or Permission Error

**Solution:**
1. Right-click project folder → Properties
2. Go to Security tab
3. Click "Edit"
4. Add "Everyone" with "Read & Execute" permissions
5. Apply to all files and folders

---

## 📁 Important File Locations

- **XAMPP Installation**: `C:\xampp\`
- **Web Root**: `C:\xampp\htdocs\`
- **Your Project**: `C:\xampp\htdocs\htmlstore-truck\`
- **phpMyAdmin**: `http://localhost/phpmyadmin`
- **Apache Config**: `C:\xampp\apache\conf\httpd.conf`
- **MySQL Config**: `C:\xampp\mysql\bin\my.ini`
- **PHP Config**: `C:\xampp\php\php.ini`
- **Error Logs**: `C:\xampp\apache\logs\error.log`

---

## 🎯 Quick Reference

| Task | URL/Command |
|------|-------------|
| Access Website | `http://localhost/htmlstore-truck` |
| phpMyAdmin | `http://localhost/phpmyadmin` |
| XAMPP Dashboard | `http://localhost/dashboard` |
| Start Apache | XAMPP Control Panel → Start |
| Start MySQL | XAMPP Control Panel → Start |
| Stop Services | XAMPP Control Panel → Stop |

---

## 💡 Pro Tips

1. **Keep XAMPP running** while developing
2. **Use browser Developer Tools** (F12) to debug
3. **Check error logs** if something breaks:
   - Apache: `C:\xampp\apache\logs\error.log`
   - PHP: Check your project's `error.log` file
4. **Backup database** before making changes:
   - phpMyAdmin → Select database → Export
5. **Use a code editor** like VS Code or Notepad++ for editing files
6. **Clear browser cache** if changes don't appear (Ctrl + F5)

---

## 🚀 Next Steps

Once your site is running:

1. ✅ Test all pages
2. ✅ Test user registration
3. ✅ Test login/logout
4. ✅ Test admin panel
5. ✅ Customize design/content
6. ✅ Add your own features

---

## 📞 Need Help?

If you're still having issues:

1. Check XAMPP Control Panel for error messages
2. Check Apache error log: `C:\xampp\apache\logs\error.log`
3. Check PHP error log in your project folder
4. Use browser Developer Tools (F12) → Console tab
5. Verify all steps were completed correctly

---

**Happy Coding! 🎉**

