<?php
// Simple helper functions for MyDispatch Logistics (without database)

/**
 * Check if user is logged in (demo version)
 */
function isLoggedIn()
{
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

/**
 * Get current user information (demo version)
 */
function getUserInfo()
{
    if (!isLoggedIn()) {
        return null;
    }

    return [
        'id' => $_SESSION['user_id'] ?? null,
        'name' => $_SESSION['user_name'] ?? null,
        'email' => $_SESSION['user_email'] ?? null,
        'role' => $_SESSION['user_role'] ?? null
    ];
}

/**
 * Check if user is admin
 */
function isAdmin()
{
    $user = getUserInfo();
    return $user && ($user['role'] ?? '') === 'admin';
}

/**
 * Check if user is driver
 */
function isDriver()
{
    $user = getUserInfo();
    return $user && ($user['role'] ?? '') === 'driver';
}

/**
 * Check if user is customer
 */
function isCustomer()
{
    $user = getUserInfo();
    return $user && ($user['role'] ?? '') === 'customer';
}

/**
 * Require user to be logged in
 */
function requireAuth()
{
    if (!isLoggedIn()) {
        header('Location: ' . APP_URL . '/?page=login');
        exit();
    }
}

/**
 * Alias for requireAuth (for compatibility)
 */
function requireLogin()
{
    requireAuth();
}

/**
 * Require admin role
 */
function requireAdmin()
{
    requireAuth();

    $user = getUserInfo();
    if (!$user || $user['role'] !== 'admin') {
        header('Location: ' . APP_URL . '/?page=403');
        exit();
    }
}

/**
 * Generate CSRF token
 */
function generateCSRFToken()
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verifyCSRFToken($token)
{
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Sanitize input data
 */
function sanitizeInput($data)
{
    if (is_array($data)) {
        return array_map('sanitizeInput', $data);
    }
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

/**
 * Format currency
 */
function formatCurrency($amount, $currency = 'USD')
{
    return '$' . number_format($amount, 2);
}

/**
 * Format date
 */
function formatDate($date, $format = 'M j, Y')
{
    return date($format, strtotime($date));
}

/**
 * Redirect to a page
 */
function redirectTo($page)
{
    header('Location: ' . APP_URL . '/?page=' . $page);
    exit();
}

/**
 * Show flash message
 */
function setFlashMessage($type, $message)
{
    $_SESSION['flash'][$type] = $message;
}

/**
 * Get and clear flash message
 */
function getFlashMessage($type)
{
    if (isset($_SESSION['flash'][$type])) {
        $message = $_SESSION['flash'][$type];
        unset($_SESSION['flash'][$type]);
        return $message;
    }
    return null;
}

/**
 * Log error
 */
function logError($message, $context = [])
{
    $logMessage = date('Y-m-d H:i:s') . ' - ' . $message;
    if (!empty($context)) {
        $logMessage .= ' - Context: ' . json_encode($context);
    }
    error_log($logMessage);
}

/**
 * Get the base URL for the application
 */
function getAppBaseUrl()
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];

    // Get script name (usually index.php)
    $script = $_SERVER['SCRIPT_NAME'];
    $basePath = dirname($script);

    // Normalize
    $basePath = str_replace('\\', '/', $basePath);
    if ($basePath === '/' || $basePath === '.') {
        $basePath = '';
    }

    return $protocol . '://' . $host . $basePath;
}

/**
 * Get path to a file relative to root
 * Works correctly when pages are included via index.php
 */
function getRootPath($file)
{
    // Get the script that's actually running (index.php)
    $scriptName = $_SERVER['SCRIPT_NAME'];
    $basePath = dirname($scriptName);

    // Normalize path separators
    $basePath = str_replace('\\', '/', $basePath);

    // Clean up - if at root, basePath will be '/' or '.'
    if ($basePath === '/' || $basePath === '.') {
        return '/' . ltrim($file, '/');
    }

    // Remove leading slash if present, then add it back with basePath
    $file = ltrim($file, '/');
    return $basePath . '/' . $file;
}
?>