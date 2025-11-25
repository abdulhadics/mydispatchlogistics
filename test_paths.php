<?php
// Debug script to check paths
session_start();
require_once 'config/config.php';
require_once 'functions/helpers_simple.php';

echo "<h2>Path Debugging</h2>";
echo "<pre>";
echo "SCRIPT_NAME: " . $_SERVER['SCRIPT_NAME'] . "\n";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "REQUEST_URI: " . $_SERVER['REQUEST_URI'] . "\n";
echo "HTTP_HOST: " . $_SERVER['HTTP_HOST'] . "\n";
echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "\n";
echo "\n";
echo "dirname(SCRIPT_NAME): " . dirname($_SERVER['SCRIPT_NAME']) . "\n";
echo "getRootPath('functions/auth.php'): " . getRootPath('functions/auth.php') . "\n";
echo "\n";
echo "APP_URL: " . APP_URL . "\n";
echo "getAppBaseUrl(): " . getAppBaseUrl() . "\n";
echo "</pre>";

// Test if auth.php exists
$authPath = __DIR__ . '/functions/auth.php';
echo "<p>Auth.php exists: " . (file_exists($authPath) ? 'YES' : 'NO') . "</p>";
echo "<p>Auth.php path: " . $authPath . "</p>";
?>

