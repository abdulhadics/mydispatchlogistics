# 🖥️ MyDispatch Logistics - Localhost Setup Guide

## 🚀 Quick Start Options

### **Option 1: XAMPP (Recommended for Beginners)**

XAMPP includes Apache, MySQL, PHP, and phpMyAdmin - everything you need!

1. **Download XAMPP**
   - Go to: https://www.apachefriends.org/download.html
   - Download XAMPP for Windows
   - Install with default settings

2. **Start Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services
   - Both should show green "Running" status

3. **Set Up Project**
   ```bash
   # Copy your project to XAMPP htdocs folder
   C:\xampp\htdocs\htmlstore-truck\
   ```

4. **Access Your Website**
   - Open browser: `http://localhost/htmlstore-truck`
   - Or: `http://localhost/htmlstore-truck/index.php`

### **Option 2: WAMP (Windows Alternative)**

1. **Download WAMP**
   - Go to: http://www.wampserver.com/
   - Download and install WAMP

2. **Start WAMP**
   - Launch WAMP Server
   - Wait for all services to start (green icon)

3. **Set Up Project**
   ```bash
   # Copy your project to WAMP www folder
   C:\wamp64\www\htmlstore-truck\
   ```

4. **Access Your Website**
   - Open browser: `http://localhost/htmlstore-truck`

### **Option 3: Using PHP Built-in Server (Current Setup)**

You already have PHP running! Let's set up the database:

1. **Install MySQL**
   - Download MySQL: https://dev.mysql.com/downloads/mysql/
   - Or use XAMPP/WAMP (includes MySQL)

2. **Start MySQL Service**
   ```bash
   # If using XAMPP/WAMP, start MySQL from control panel
   # If standalone MySQL, start MySQL service in Windows Services
   ```

3. **Create Database**
   ```bash
   # Open Command Prompt or PowerShell as Administrator
   mysql -u root -p
   # Enter password (usually empty for root)
   
   # In MySQL console:
   CREATE DATABASE logistics_db;
   USE logistics_db;
   SOURCE database/schema.sql;
   EXIT;
   ```

4. **Access Your Website**
   - Your PHP server is already running on: `http://localhost:8000`

## 🗄️ Database Setup (Any Option)

### **Method 1: Using phpMyAdmin (Easiest)**

1. **Access phpMyAdmin**
   - XAMPP: `http://localhost/phpmyadmin`
   - WAMP: `http://localhost/phpmyadmin`

2. **Create Database**
   - Click "New" in left sidebar
   - Database name: `logistics_db`
   - Click "Create"

3. **Import Schema**
   - Select `logistics_db` database
   - Click "Import" tab
   - Choose file: `database/schema.sql`
   - Click "Go"

### **Method 2: Using MySQL Command Line**

```bash
# Open Command Prompt/PowerShell
mysql -u root -p

# Enter password (usually empty, just press Enter)
CREATE DATABASE logistics_db;
USE logistics_db;
SOURCE "D:/HTMLSTORE TRUCK/database/schema.sql";
EXIT;
```

### **Method 3: Using MySQL Workbench**

1. **Download MySQL Workbench**
   - Go to: https://dev.mysql.com/downloads/workbench/

2. **Connect to MySQL**
   - Create new connection
   - Host: localhost
   - Port: 3306
   - Username: root
   - Password: (usually empty)

3. **Import Schema**
   - Open SQL script: `database/schema.sql`
   - Execute the script

## 🎯 Testing Your Website

### **1. Basic Access Test**
- Open browser: `http://localhost:8000`
- You should see your MyDispatch homepage

### **2. Database Connection Test**
- Try to register a new user
- Check if data saves to database

### **3. Login Test**
Use these demo credentials:
- **Admin**: `admin@logistics.com` / `admin123`
- **Driver**: `driver@example.com` / `driver123`
- **Customer**: `customer@example.com` / `customer123`

### **4. Feature Tests**
- ✅ Homepage loads
- ✅ User registration works
- ✅ Login/logout works
- ✅ Contact form submits
- ✅ Admin panel accessible
- ✅ Database saves data

## 🔧 Troubleshooting

### **PHP Server Not Starting**
```bash
# Check if port 8000 is in use
netstat -an | findstr :8000

# Try different port
php -S localhost:8080
```

### **Database Connection Error**
1. **Check MySQL is running**
   ```bash
   # Check MySQL service status
   Get-Service -Name "*mysql*"
   ```

2. **Verify database credentials in config/config.php**
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'logistics_db');
   define('DB_USER', 'root');
   define('DB_PASS', ''); // Usually empty for localhost
   ```

3. **Test database connection**
   ```bash
   mysql -u root -p -e "SHOW DATABASES;"
   ```

### **File Permission Issues**
- Ensure PHP can read all files
- Check if uploads directory is writable

### **CSS/JS Not Loading**
- Check file paths in browser developer tools
- Ensure all files uploaded correctly
- Clear browser cache

## 🎉 Success Indicators

Your website is working correctly when:

1. **Homepage loads** with dark theme design
2. **Navigation works** - can click between pages
3. **Forms work** - registration, login, contact form
4. **Database saves data** - new users appear in database
5. **Admin panel accessible** - can login as admin
6. **Responsive design** - works on mobile/tablet

## 📱 Mobile Testing

Test your website on mobile:
1. **Browser Developer Tools**
   - Press F12 → Toggle device toolbar
   - Test different screen sizes

2. **Actual Mobile Device**
   - Connect phone to same WiFi network
   - Visit: `http://YOUR_COMPUTER_IP:8000`
   - Find your IP: `ipconfig` in Command Prompt

## 🚀 Next Steps

Once localhost is working:

1. **Test all features thoroughly**
2. **Fix any bugs or issues**
3. **Customize design/content as needed**
4. **Prepare for live deployment**
5. **Deploy to hosting provider**

## 💡 Pro Tips

- **Keep XAMPP/WAMP running** while developing
- **Use browser developer tools** to debug issues
- **Check error logs** in your project folder
- **Backup your database** before making changes
- **Test on different browsers** (Chrome, Firefox, Edge)

---

**Need Help?**
- Check error logs in your project folder
- Use browser developer tools (F12)
- Ensure all services are running
- Verify file permissions
