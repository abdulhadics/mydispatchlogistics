<?php
/**
 * MyDispatch Logistics - Database Setup Script
 * Run this script to set up your local database
 */

echo "<h2>🚀 MyDispatch Logistics - Database Setup</h2>";
echo "<hr>";

// Include configuration
require_once 'config/config.php';
require_once 'config/database.php';

try {
    // Test database connection
    echo "<p>📡 Testing database connection...</p>";
    $db = getDB();
    
    if ($db === null) {
        throw new Exception("Database connection failed - check your MySQL server");
    }
    
    echo "<p>✅ Database connection successful!</p>";
    
    // Check if database exists
    echo "<p>🔍 Checking if database exists...</p>";
    $result = $db->query("SHOW TABLES");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);
    
    if (empty($tables)) {
        echo "<p>⚠️ Database is empty. You need to import the schema.</p>";
        echo "<p><strong>Next steps:</strong></p>";
        echo "<ol>";
        echo "<li>Install MySQL (XAMPP/WAMP recommended)</li>";
        echo "<li>Create database 'logistics_db'</li>";
        echo "<li>Import database/schema.sql via phpMyAdmin or MySQL command line</li>";
        echo "</ol>";
        
        echo "<h3>📋 Quick Setup Options:</h3>";
        echo "<h4>Option 1: XAMPP (Recommended)</h4>";
        echo "<ul>";
        echo "<li>Download XAMPP from <a href='https://www.apachefriends.org/' target='_blank'>apachefriends.org</a></li>";
        echo "<li>Start Apache and MySQL services</li>";
        echo "<li>Go to <a href='http://localhost/phpmyadmin' target='_blank'>phpMyAdmin</a></li>";
        echo "<li>Create database 'logistics_db'</li>";
        echo "<li>Import database/schema.sql file</li>";
        echo "</ul>";
        
        echo "<h4>Option 2: MySQL Command Line</h4>";
        echo "<pre>";
        echo "mysql -u root -p\n";
        echo "CREATE DATABASE logistics_db;\n";
        echo "USE logistics_db;\n";
        echo "SOURCE database/schema.sql;\n";
        echo "EXIT;";
        echo "</pre>";
        
    } else {
        echo "<p>✅ Database tables found: " . count($tables) . " tables</p>";
        echo "<ul>";
        foreach ($tables as $table) {
            echo "<li>$table</li>";
        }
        echo "</ul>";
        
        // Check if demo users exist
        $stmt = $db->prepare("SELECT COUNT(*) FROM users");
        $stmt->execute();
        $userCount = $stmt->fetchColumn();
        
        echo "<p>👥 Users in database: $userCount</p>";
        
        if ($userCount > 0) {
            echo "<p>🎉 Database is ready! You can now:</p>";
            echo "<ul>";
            echo "<li><a href='?page=home'>Visit Homepage</a></li>";
            echo "<li><a href='?page=login'>Login</a> (admin@logistics.com / admin123)</li>";
            echo "<li><a href='?page=contact'>Test Contact Form</a></li>";
            echo "<li><a href='?page=admin'>Admin Panel</a></li>";
            echo "</ul>";
        } else {
            echo "<p>⚠️ No users found. Database schema might not be imported correctly.</p>";
        }
    }
    
} catch (Exception $e) {
    echo "<p>❌ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<p><strong>Common solutions:</strong></p>";
    echo "<ul>";
    echo "<li>Install and start MySQL service</li>";
    echo "<li>Check database credentials in config/config.php</li>";
    echo "<li>Ensure database 'logistics_db' exists</li>";
    echo "<li>For XAMPP: Start MySQL service in XAMPP Control Panel</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<p><strong>🔗 Your website is running at:</strong> <a href='http://localhost:8000' target='_blank'>http://localhost:8000</a></p>";

// Show current configuration
echo "<h3>⚙️ Current Configuration:</h3>";
echo "<ul>";
echo "<li><strong>App URL:</strong> " . APP_URL . "</li>";
echo "<li><strong>Database Host:</strong> " . DB_HOST . "</li>";
echo "<li><strong>Database Name:</strong> " . DB_NAME . "</li>";
echo "<li><strong>Database User:</strong> " . DB_USER . "</li>";
echo "<li><strong>PHP Version:</strong> " . PHP_VERSION . "</li>";
echo "</ul>";
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background: #f5f5f5;
}
h2, h3, h4 {
    color: #333;
}
p {
    margin: 10px 0;
}
ul, ol {
    margin: 10px 0;
    padding-left: 20px;
}
pre {
    background: #f0f0f0;
    padding: 10px;
    border-radius: 5px;
    overflow-x: auto;
}
a {
    color: #0066cc;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
hr {
    border: none;
    border-top: 1px solid #ddd;
    margin: 20px 0;
}
</style>
