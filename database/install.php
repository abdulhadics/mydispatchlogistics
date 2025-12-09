<?php
/**
 * Quick Database Installation Script
 * This will create all tables and insert demo data
 */

require_once '../config/config.php';

// Create connection without database first
try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST,
        DB_USER,
        DB_PASS
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create database if it doesn't exist
    $conn->exec("CREATE DATABASE IF NOT EXISTS " . DB_NAME);
    $conn->exec("USE " . DB_NAME);
    
    echo "<h2>✅ Database Created/Selected: " . DB_NAME . "</h2>";
    
    // Read and execute schema
    $schemaFile = __DIR__ . '/schema.sql';
    if (file_exists($schemaFile)) {
        $sql = file_get_contents($schemaFile);
        
        // Split by semicolons and execute each statement
        $statements = array_filter(
            array_map('trim', explode(';', $sql)),
            function($stmt) {
                return !empty($stmt) && !preg_match('/^--/', $stmt);
            }
        );
        
        foreach ($statements as $statement) {
            if (!empty(trim($statement))) {
                try {
                    $conn->exec($statement);
                } catch (PDOException $e) {
                    // Ignore "table already exists" errors
                    if (strpos($e->getMessage(), 'already exists') === false) {
                        echo "<p>⚠️ Warning: " . $e->getMessage() . "</p>";
                    }
                }
            }
        }
        
        echo "<h3>✅ Tables Created Successfully!</h3>";
        
        // Check tables
        $result = $conn->query("SHOW TABLES");
        $tables = $result->fetchAll(PDO::FETCH_COLUMN);
        echo "<p><strong>Tables created:</strong> " . implode(', ', $tables) . "</p>";
        
        // Check users
        $stmt = $conn->query("SELECT COUNT(*) FROM users");
        $userCount = $stmt->fetchColumn();
        echo "<p><strong>Users in database:</strong> $userCount</p>";
        
        if ($userCount > 0) {
            echo "<h3>🎉 Installation Complete!</h3>";
            echo "<p>You can now:</p>";
            echo "<ul>";
            echo "<li><a href='../index.php?page=login'>Login</a> (admin@logistics.com / admin123)</li>";
            echo "<li><a href='../index.php?page=home'>Visit Homepage</a></li>";
            echo "<li><a href='../setup_database.php'>Check Database Status</a></li>";
            echo "</ul>";
        }
        
    } else {
        echo "<p>❌ Schema file not found: $schemaFile</p>";
    }
    
} catch (PDOException $e) {
    echo "<h2>❌ Error:</h2>";
    echo "<p>" . $e->getMessage() . "</p>";
    echo "<p><strong>Make sure:</strong></p>";
    echo "<ul>";
    echo "<li>MySQL service is running</li>";
    echo "<li>Database credentials in config/config.php are correct</li>";
    echo "<li>User has permission to create databases</li>";
    echo "</ul>";
}
?>

<style>
body {
    font-family: Arial, sans-serif;
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    background: #f5f5f5;
}
h2, h3 {
    color: #333;
}
ul {
    margin: 10px 0;
    padding-left: 20px;
}
a {
    color: #0066cc;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
</style>

