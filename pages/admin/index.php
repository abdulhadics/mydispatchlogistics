<?php
requireAdmin();

$page_title = 'Admin Dashboard - MyDispatch';
$page_description = 'Administrative dashboard for managing users, loads, and system operations.';
$body_class = 'admin-page';

include 'includes/header.php';
?>

<div class="admin-container">
    <div class="admin-header">
        <h1 class="admin-title">
            <i class="fas fa-cog"></i>
            Admin Dashboard
        </h1>
        <p class="admin-subtitle">Manage your logistics operations</p>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3>1,247</h3>
                <p>Total Users</p>
                <span class="stat-change positive">+12% this month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-truck"></i>
            </div>
            <div class="stat-content">
                <h3>856</h3>
                <p>Active Loads</p>
                <span class="stat-change positive">+8% this month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-content">
                <h3>$2.4M</h3>
                <p>Revenue</p>
                <span class="stat-change positive">+15% this month</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-content">
                <h3>4.8</h3>
                <p>Rating</p>
                <span class="stat-change neutral">No change</span>
            </div>
        </div>
    </div>

    <!-- Admin Navigation -->
    <div class="admin-nav">
        <?php $section = $_GET['section'] ?? 'users'; ?>
        <a href="?page=admin&section=users" class="admin-nav-link <?php echo $section === 'users' ? 'active' : ''; ?>">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        <a href="?page=admin&section=loads" class="admin-nav-link <?php echo $section === 'loads' ? 'active' : ''; ?>">
            <i class="fas fa-truck"></i>
            <span>Loads</span>
        </a>
        <a href="?page=admin&section=payments"
            class="admin-nav-link <?php echo $section === 'payments' ? 'active' : ''; ?>">
            <i class="fas fa-credit-card"></i>
            <span>Payments</span>
        </a>
        <a href="?page=admin&section=vehicles"
            class="admin-nav-link <?php echo $section === 'vehicles' ? 'active' : ''; ?>">
            <i class="fas fa-car"></i>
            <span>Vehicles</span>
        </a>
        <a href="?page=admin&section=messages"
            class="admin-nav-link <?php echo $section === 'messages' ? 'active' : ''; ?>">
            <i class="fas fa-envelope"></i>
            <span>Messages</span>
        </a>
        <a href="?page=admin&section=settings"
            class="admin-nav-link <?php echo $section === 'settings' ? 'active' : ''; ?>">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
    </div>

    <!-- Admin Content -->
    <div class="admin-content">
        <?php
        $section = $_GET['section'] ?? 'users';

        switch ($section) {
            case 'users':
                include 'users.php';
                break;
            case 'loads':
                include 'loads.php';
                break;
            case 'payments':
                include 'payments.php';
                break;
            case 'vehicles':
                include 'vehicles.php';
                break;
            case 'messages':
                include 'messages.php';
                break;
            case 'settings':
                include 'settings.php';
                break;
            default:
                include 'users.php';
                break;
        }
        ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>