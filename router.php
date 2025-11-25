<?php
// Simple router for MyDispatch Logistics

$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$query = parse_url($request, PHP_URL_QUERY);

// Remove leading slash
$path = ltrim($path, '/');

// Always route through index.php for query string requests or root access
if ($query || $path === '' || $path === 'index.php') {
    include 'index.php';
} else {
    // For other paths, try to serve the file directly
    $file = __DIR__ . '/' . $path;

    if (file_exists($file) && is_file($file)) {
        // Serve static files (CSS, JS, images, etc.)
        return false;
    } else {
        // Route everything else to main index
        include 'index.php';
    }
}
?>