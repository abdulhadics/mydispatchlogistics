<?php
require_once __DIR__ . '/../config/config.php';

session_start();
session_destroy();

// Clear remember me cookie
setcookie('remember_token', '', time() - 3600, '/', '', false, true);

// Redirect to home page
header('Location: ' . APP_URL);
exit();
?>
