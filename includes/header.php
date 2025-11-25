<?php
// Calculate base path for assets
$script_path = $_SERVER['SCRIPT_NAME'];
$base_path = rtrim(dirname($script_path), '/\\');

// If we're in a subdirectory like /pages, go up one level
if (strpos($base_path, '/pages') !== false) {
    $base_path = dirname($base_path);
}

// Ensure base path is clean
$base_path = str_replace('\\', '/', $base_path);
if ($base_path === '/' || $base_path === '.') {
    $base_path = '';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? APP_NAME; ?></title>
    <meta name="description"
        content="<?php echo $page_description ?? 'Professional truck dispatch and logistics services'; ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>/assets/css/responsive.css">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?php echo $base_path; ?>/assets/images/favicon.ico">
</head>

<body class="<?php echo $body_class ?? ''; ?>">
    <!-- Navigation -->
    <?php
    // Use absolute path for includes
    $nav_path = __DIR__ . '/navigation.php';
    if (file_exists($nav_path)) {
        include $nav_path;
    }
    ?>

    <!-- Main Content -->
    <main class="main-content">