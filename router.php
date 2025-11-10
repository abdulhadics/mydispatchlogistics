<?php
// Simple router for MyDispatch Logistics

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

// Remove leading slash
$path = ltrim($path, '/');

// Route to main index
if ($path === '' || $path === 'index.php') {
    include 'index.php';
} else {
    // For other paths, try to serve the file directly
    $file = __DIR__ . '/' . $path;
    
    if (file_exists($file) && is_file($file)) {
        // Serve static files
        return false;
    } else {
        // Route everything else to main index
        include 'index.php';
    }
}
?>
