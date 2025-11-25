<?php
requireAuth();

$user = getUserInfo();
$db = getDB();
$page_title = 'Dashboard - MyDispatch';
$page_description = 'Your personal dashboard for managing logistics operations.';
$body_class = 'dashboard-page';

// Get real data from database
$stats = [];
$recentLoads = [];
$recentPayments = [];

try {
    if ($user['role'] === 'driver') {
        // Driver stats
        $stmt = $db->prepare("SELECT COUNT(*) as active_loads FROM loads WHERE driver_id = ? AND status IN ('assigned', 'in_transit')");
        $stmt->execute([$user['id']]);
        $stats['active_loads'] = $stmt->fetch(PDO::FETCH_ASSOC)['active_loads'] ?? 0;

        $stmt = $db->prepare("SELECT SUM(rate) as total_earnings FROM loads WHERE driver_id = ? AND status = 'delivered' AND MONTH(updated_at) = MONTH(CURRENT_DATE()) AND YEAR(updated_at) = YEAR(CURRENT_DATE())");
        $stmt->execute([$user['id']]);
        $stats['monthly_earnings'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_earnings'] ?? 0;

        $stmt = $db->prepare("SELECT SUM(miles) as total_miles FROM loads WHERE driver_id = ? AND status = 'delivered'");
        $stmt->execute([$user['id']]);
        $stats['total_miles'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_miles'] ?? 0;

        // Recent loads
        $stmt = $db->prepare("SELECT * FROM loads WHERE driver_id = ? ORDER BY created_at DESC LIMIT 5");
        $stmt->execute([$user['id']]);
        $recentLoads = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Recent payments
        $stmt = $db->prepare("SELECT p.*, l.load_number FROM payments p LEFT JOIN loads l ON p.load_id = l.id WHERE p.driver_id = ? ORDER BY p.created_at DESC LIMIT 5");
        $stmt->execute([$user['id']]);
        $recentPayments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } elseif ($user['role'] === 'customer') {
        // Customer stats
        $stmt = $db->prepare("SELECT COUNT(*) as active_shipments FROM loads WHERE customer_id = ? AND status IN ('assigned', 'in_transit', 'available')");
        $stmt->execute([$user['id']]);
        $stats['active_shipments'] = $stmt->fetch(PDO::FETCH_ASSOC)['active_shipments'] ?? 0;

        $stmt = $db->prepare("SELECT SUM(rate) as total_spent FROM loads WHERE customer_id = ?");
        $stmt->execute([$user['id']]);
        $stats['total_spent'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_spent'] ?? 0;

        $stmt = $db->prepare("SELECT COUNT(*) as delivered FROM loads WHERE customer_id = ? AND status = 'delivered'");
        $stmt->execute([$user['id']]);
        $delivered = $stmt->fetch(PDO::FETCH_ASSOC)['delivered'] ?? 0;

        $stmt = $db->prepare("SELECT COUNT(*) as total FROM loads WHERE customer_id = ?");
        $stmt->execute([$user['id']]);
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
        $stats['on_time_delivery'] = $total > 0 ? round(($delivered / $total) * 100) : 0;

        // Recent shipments
        $stmt = $db->prepare("SELECT * FROM loads WHERE customer_id = ? ORDER BY created_at DESC LIMIT 5");
        $stmt->execute([$user['id']]);
        $recentLoads = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (Exception $e) {
    // If database query fails, use default values
    error_log('Dashboard query error: ' . $e->getMessage());
}

include 'includes/header.php';
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="welcome-section">
            <h1 class="welcome-title">
                Welcome back, <?php echo htmlspecialchars($user['name']); ?>!
            </h1>
            <p class="welcome-subtitle">
                Here's what's happening with your <?php echo ucfirst($user['role']); ?> account.
            </p>
        </div>

        <div class="quick-actions">
            <a href="?page=contact" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                New Load
            </a>
            <a href="?page=tracking" class="btn btn-outline">
                <i class="fas fa-map-marked-alt"></i>
                Track Shipment
            </a>
        </div>
    </div>

    <?php if ($user['role'] === 'driver'): ?>
        <!-- Driver Dashboard -->
        <div class="dashboard-grid">
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $stats['active_loads'] ?? 0; ?></h3>
                        <p>Active Loads</p>
                        <span class="stat-change positive">Current</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo formatCurrency($stats['monthly_earnings'] ?? 0); ?></h3>
                        <p>This Month</p>
                        <span class="stat-change positive">Earnings</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo number_format($stats['total_miles'] ?? 0); ?></h3>
                        <p>Miles Driven</p>
                        <span class="stat-change neutral">Total</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <h3>4.8</h3>
                        <p>Rating</p>
                        <span class="stat-change positive">Excellent</span>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="content-grid">
                    <div class="content-card">
                        <div class="card-header">
                            <h3>Recent Loads</h3>
                            <a href="#" class="card-action">View All</a>
                        </div>
                        <div class="card-content">
                            <?php if (empty($recentLoads)): ?>
                                <div class="empty-state">
                                    <p>No loads found</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($recentLoads as $load): ?>
                                    <div class="load-item">
                                        <div class="load-info">
                                            <div class="load-route"><?php echo htmlspecialchars($load['pickup_location']); ?> →
                                                <?php echo htmlspecialchars($load['delivery_location']); ?></div>
                                            <div class="load-details">
                                                <?php echo htmlspecialchars($load['equipment_type'] ?: 'N/A'); ?>
                                                <?php if ($load['weight']): ?>• <?php echo number_format($load['weight']); ?>
                                                    lbs<?php endif; ?>
                                                • <?php echo formatCurrency($load['rate']); ?>
                                            </div>
                                        </div>
                                        <div class="load-status status-<?php echo str_replace('_', '-', $load['status']); ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $load['status'])); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="content-card">
                        <div class="card-header">
                            <h3>Payment History</h3>
                            <a href="#" class="card-action">View All</a>
                        </div>
                        <div class="card-content">
                            <?php if (empty($recentPayments)): ?>
                                <div class="empty-state">
                                    <p>No payments found</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($recentPayments as $payment): ?>
                                    <div class="payment-item">
                                        <div class="payment-info">
                                            <div class="payment-amount"><?php echo formatCurrency($payment['amount']); ?></div>
                                            <div class="payment-date">
                                                <?php echo date('M j, Y', strtotime($payment['created_at'])); ?></div>
                                            <?php if ($payment['load_number']): ?>
                                                <div class="payment-load">Load: <?php echo htmlspecialchars($payment['load_number']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="payment-status status-<?php echo $payment['status']; ?>">
                                            <?php echo ucfirst($payment['status']); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php elseif ($user['role'] === 'customer'): ?>
        <!-- Customer Dashboard -->
        <div class="dashboard-grid">
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $stats['active_shipments'] ?? 0; ?></h3>
                        <p>Active Shipments</p>
                        <span class="stat-change positive">Current</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo formatCurrency($stats['total_spent'] ?? 0); ?></h3>
                        <p>Total Spent</p>
                        <span class="stat-change positive">All Time</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h3><?php echo $stats['on_time_delivery'] ?? 0; ?>%</h3>
                        <p>On-Time Delivery</p>
                        <span class="stat-change positive">Rate</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="stat-content">
                        <h3>4.9</h3>
                        <p>Service Rating</p>
                        <span class="stat-change positive">Outstanding</span>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="content-grid">
                    <div class="content-card">
                        <div class="card-header">
                            <h3>Recent Shipments</h3>
                            <a href="#" class="card-action">View All</a>
                        </div>
                        <div class="card-content">
                            <?php if (empty($recentLoads)): ?>
                                <div class="empty-state">
                                    <p>No shipments found</p>
                                </div>
                            <?php else: ?>
                                <?php foreach ($recentLoads as $load): ?>
                                    <div class="shipment-item">
                                        <div class="shipment-info">
                                            <div class="shipment-route"><?php echo htmlspecialchars($load['pickup_location']); ?> →
                                                <?php echo htmlspecialchars($load['delivery_location']); ?></div>
                                            <div class="shipment-details">
                                                <?php echo htmlspecialchars($load['equipment_type'] ?: 'N/A'); ?>
                                                <?php if ($load['weight']): ?>• <?php echo number_format($load['weight']); ?>
                                                    lbs<?php endif; ?>
                                                • <?php echo formatCurrency($load['rate']); ?>
                                            </div>
                                        </div>
                                        <div class="shipment-status status-<?php echo str_replace('_', '-', $load['status']); ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $load['status'])); ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="content-card">
                        <div class="card-header">
                            <h3>Quick Actions</h3>
                        </div>
                        <div class="card-content">
                            <div class="quick-action-buttons">
                                <a href="?page=contact" class="quick-action-btn">
                                    <i class="fas fa-plus"></i>
                                    <span>New Shipment</span>
                                </a>
                                <a href="?page=tracking" class="quick-action-btn">
                                    <i class="fas fa-search"></i>
                                    <span>Track Package</span>
                                </a>
                                <a href="#" class="quick-action-btn">
                                    <i class="fas fa-file-invoice"></i>
                                    <span>Get Quote</span>
                                </a>
                                <a href="#" class="quick-action-btn">
                                    <i class="fas fa-headset"></i>
                                    <span>Contact Support</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- Default Dashboard -->
        <div class="dashboard-grid">
            <div class="stats-cards">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="stat-content">
                        <h3>Welcome!</h3>
                        <p>Get Started</p>
                        <span class="stat-change positive">Explore features</span>
                    </div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="content-card">
                    <div class="card-header">
                        <h3>Getting Started</h3>
                    </div>
                    <div class="card-content">
                        <div class="getting-started">
                            <div class="step-item">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4>Complete Your Profile</h4>
                                    <p>Add your company information and preferences</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4>Explore Services</h4>
                                    <p>Learn about our dispatch and logistics services</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4>Contact Us</h4>
                                    <p>Get in touch to start your logistics journey</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>



<?php include 'includes/footer.php'; ?>