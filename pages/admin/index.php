<?php
requireAdmin();

$page_title = 'Admin Dashboard - MyDispatch';
$page_description = 'Administrative dashboard for managing users, loads, and system operations.';
$body_class = 'admin-page';

include '../../includes/header.php';
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
        <a href="?page=admin&section=users" class="admin-nav-link active">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        <a href="?page=admin&section=loads" class="admin-nav-link">
            <i class="fas fa-truck"></i>
            <span>Loads</span>
        </a>
        <a href="?page=admin&section=payments" class="admin-nav-link">
            <i class="fas fa-credit-card"></i>
            <span>Payments</span>
        </a>
        <a href="?page=admin&section=vehicles" class="admin-nav-link">
            <i class="fas fa-car"></i>
            <span>Vehicles</span>
        </a>
        <a href="?page=admin&section=messages" class="admin-nav-link">
            <i class="fas fa-envelope"></i>
            <span>Messages</span>
        </a>
        <a href="?page=admin&section=settings" class="admin-nav-link">
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

<style>
.admin-page {
    background: #0a0a0a;
    min-height: 100vh;
    padding-top: 2rem;
}

.admin-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

.admin-header {
    margin-bottom: 3rem;
}

.admin-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.admin-subtitle {
    color: #a3a3a3;
    font-size: 1.125rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all 0.3s ease;
}

.stat-card:hover {
    border-color: rgba(139, 92, 246, 0.3);
    transform: translateY(-2px);
}

.stat-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.stat-content h3 {
    font-size: 2rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.25rem;
}

.stat-content p {
    color: #a3a3a3;
    margin-bottom: 0.5rem;
}

.stat-change {
    font-size: 0.875rem;
    font-weight: 500;
    padding: 2px 8px;
    border-radius: 6px;
}

.stat-change.positive {
    color: #10b981;
    background: rgba(16, 185, 129, 0.1);
}

.stat-change.negative {
    color: #ef4444;
    background: rgba(239, 68, 68, 0.1);
}

.stat-change.neutral {
    color: #6b7280;
    background: rgba(107, 114, 128, 0.1);
}

.admin-nav {
    display: flex;
    gap: 1rem;
    margin-bottom: 3rem;
    overflow-x: auto;
    padding-bottom: 1rem;
}

.admin-nav-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 12px 20px;
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 12px;
    color: #a3a3a3;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.admin-nav-link:hover,
.admin-nav-link.active {
    background: rgba(139, 92, 246, 0.1);
    border-color: #a855f7;
    color: #a855f7;
}

.admin-content {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    min-height: 500px;
}

@media (max-width: 768px) {
    .admin-container {
        padding: 0 1rem;
    }
    
    .admin-title {
        font-size: 2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .admin-nav {
        flex-wrap: wrap;
    }
    
    .admin-content {
        padding: 1.5rem;
    }
}
</style>

<?php include '../../includes/footer.php'; ?>
