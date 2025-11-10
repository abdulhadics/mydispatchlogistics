<?php
// Application Configuration - Copy this file to config.php and update values

// Application Settings
define('APP_NAME', 'MyDispatch Logistics');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/htmlstore-truck-php'); // Update this to your actual URL

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'logistics_db');
define('DB_USER', 'root'); // Update with your MySQL username
define('DB_PASS', ''); // Update with your MySQL password

// Security Configuration
define('SECRET_KEY', 'your-secret-key-here-change-this'); // Change this to a random string
define('SESSION_TIMEOUT', 3600); // 1 hour in seconds

// Email Configuration (for future use)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'your-email@gmail.com'); // Update with your email
define('SMTP_PASS', 'your-app-password'); // Update with your email password

// File Upload Configuration
define('UPLOAD_PATH', 'uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB in bytes

// Timezone
date_default_timezone_set('America/New_York'); // Update to your timezone

// Error Reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1); // Set to 0 in production
?>
