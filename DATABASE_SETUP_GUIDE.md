# 🗄️ Database Setup Guide - Step by Step

This guide will help you set up the database for MyDispatch Logistics. Follow these steps in order.

---

## ✅ Step 1: Start MySQL Service

### If using XAMPP:
1. Open **XAMPP Control Panel**
2. Find **MySQL** in the list
3. Click the **"Start"** button
4. Wait until it shows **"Running"** (green status)

### If using WAMP:
1. Open **WAMP Control Panel**
2. Make sure MySQL service is running (icon should be green)

### If using MAMP:
1. Open **MAMP**
2. Click **"Start Servers"**
3. Wait for MySQL to start

### If using standalone MySQL:
- Make sure MySQL service is running in Windows Services

---

## ✅ Step 2: Open phpMyAdmin

1. Open your web browser
2. Go to: **http://localhost/phpmyadmin**
3. You should see the phpMyAdmin interface

**If phpMyAdmin doesn't open:**
- Make sure Apache is also running (for XAMPP/WAMP)
- Check that you're using the correct URL

---

## ✅ Step 3: Create the Database

1. In phpMyAdmin, look at the left sidebar
2. Click the **"New"** button (or "Databases" tab at the top)
3. In the "Database name" field, type: **`logistics_db`**
4. Leave "Collation" as default (or select `utf8mb4_general_ci`)
5. Click the **"Create"** button
6. You should see a success message and the database appear in the left sidebar

---

## ✅ Step 4: Import the Database Schema

1. Click on **`logistics_db`** in the left sidebar (to select it)
2. Click the **"Import"** tab at the top
3. Click the **"Choose File"** or **"Browse"** button
4. Navigate to your project folder: **`D:\HTMLSTORE TRUCK\database\schema.sql`**
5. Select the **`schema.sql`** file
6. Scroll down and click the **"Go"** button at the bottom
7. Wait for the import to complete
8. You should see: **"Import has been successfully finished"**

**What this does:**
- Creates all the necessary tables (users, loads, contact_messages, etc.)
- Adds demo data (admin user, sample services, testimonials)

---

## ✅ Step 5: Verify Database Setup

1. In phpMyAdmin, make sure **`logistics_db`** is selected
2. Click the **"Structure"** tab
3. You should see a list of tables like:
   - `users`
   - `loads`
   - `contact_messages`
   - `services`
   - `testimonials`
   - And more...

4. Click on the **`users`** table
5. Click the **"Browse"** tab
6. You should see at least 3 demo users:
   - Admin User
   - John Driver
   - Jane Customer

**If you see the tables and users, your database is set up correctly! ✅**

---

## ✅ Step 6: Test Your Website

1. Go back to your website: **http://localhost/htmlstore-truck** (or your URL)
2. Try the **Contact** page - it should work now!
3. Try to **Login** with:
   - Email: `admin@logistics.com`
   - Password: `admin123`

---

## 🐛 Troubleshooting

### Problem: "Database connection failed"

**Check these:**
1. ✅ MySQL service is running (green in XAMPP)
2. ✅ Database `logistics_db` exists in phpMyAdmin
3. ✅ Your `config/config.php` has these settings:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'logistics_db');
   define('DB_USER', 'root');
   define('DB_PASS', '');  // Usually empty for XAMPP
   ```

### Problem: "Import failed" in phpMyAdmin

**Solutions:**
1. Make sure you selected the database first (click on `logistics_db`)
2. Check that the `schema.sql` file exists
3. Try increasing the upload size limit in phpMyAdmin:
   - Click "Settings" → "Import"
   - Increase "Maximum upload size"

### Problem: MySQL won't start

**Solutions:**
1. Check if port 3306 is already in use
2. Restart your computer
3. Check Windows Services for conflicting MySQL services
4. For XAMPP: Try running as Administrator

### Problem: Can't find schema.sql file

**Check:**
- File should be at: `D:\HTMLSTORE TRUCK\database\schema.sql`
- If missing, you may need to recreate it or download it again

---

## 📋 Quick Checklist

Before you start:
- [ ] MySQL service is running
- [ ] phpMyAdmin opens in browser
- [ ] You know where your project folder is located

During setup:
- [ ] Created database `logistics_db`
- [ ] Imported `schema.sql` file
- [ ] Verified tables exist
- [ ] Verified demo users exist

After setup:
- [ ] Website loads without database errors
- [ ] Contact form works
- [ ] Can login with demo account

---

## 🎯 What's Next?

Once your database is set up:

1. **Test the contact form** - Submit a message and check if it saves
2. **Test login** - Use the demo accounts
3. **Explore the admin panel** - Login as admin and see what's available
4. **Customize** - Start modifying the code for your needs

---

## 💡 Need More Help?

If you're still stuck:

1. **Check the error message** - It usually tells you what's wrong
2. **Verify MySQL is running** - This is the #1 cause of issues
3. **Check file paths** - Make sure you're importing from the correct location
4. **Try the setup script** - Visit: `http://localhost/htmlstore-truck/setup_database.php` (if available)

---

**Good luck! 🚀**

