<?php
session_start();
require_once 'config/config.php';
require_once 'config/database.php';
require_once 'functions/helpers_simple.php';

// Handle routing
$page = $_GET['page'] ?? 'home';

// Define allowed pages
$allowed_pages = [
    'home' => 'pages/home_demo.php',
    'services' => 'pages/services_demo.php',
    'pricing' => 'pages/pricing_demo.php',
    'tracking' => 'pages/tracking_demo.php',
    'carrier-setup' => 'pages/carrier_setup_demo.php',
    'contact' => 'pages/contact.php',
    'login' => 'pages/login.php',
    'signup' => 'pages/signup.php',
    'dashboard' => 'pages/dashboard.php',
    'admin' => 'pages/admin/index.php',
    'blog' => 'pages/404.php', // Blog page not implemented yet - shows 404
    '404' => 'pages/404.php',
    '500' => 'pages/500.php'
];

// Check if page exists
if (array_key_exists($page, $allowed_pages)) {
    $page_file = $allowed_pages[$page];
    if (file_exists($page_file)) {
        include $page_file;
    } else {
        include 'pages/404.php';
    }
} else {
    include 'pages/404.php';
}
?>
