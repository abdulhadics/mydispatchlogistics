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
                                            <div class="load-route"><?php echo htmlspecialchars($load['pickup_location']); ?> → <?php echo htmlspecialchars($load['delivery_location']); ?></div>
                                            <div class="load-details">
                                                <?php echo htmlspecialchars($load['equipment_type'] ?: 'N/A'); ?> 
                                                <?php if ($load['weight']): ?>• <?php echo number_format($load['weight']); ?> lbs<?php endif; ?> 
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
                                            <div class="payment-date"><?php echo date('M j, Y', strtotime($payment['created_at'])); ?></div>
                                            <?php if ($payment['load_number']): ?>
                                                <div class="payment-load">Load: <?php echo htmlspecialchars($payment['load_number']); ?></div>
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
                                            <div class="shipment-route"><?php echo htmlspecialchars($load['pickup_location']); ?> → <?php echo htmlspecialchars($load['delivery_location']); ?></div>
                                            <div class="shipment-details">
                                                <?php echo htmlspecialchars($load['equipment_type'] ?: 'N/A'); ?> 
                                                <?php if ($load['weight']): ?>• <?php echo number_format($load['weight']); ?> lbs<?php endif; ?> 
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

<style>
.dashboard-page {
    background: #0a0a0a;
    min-height: 100vh;
    padding-top: 2rem;
}

.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 3rem;
    gap: 2rem;
}

.welcome-section h1 {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.5rem;
}

.welcome-subtitle {
    color: #a3a3a3;
    font-size: 1.125rem;
}

.quick-actions {
    display: flex;
    gap: 1rem;
    flex-shrink: 0;
}

.stats-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
}

.stat-content h3 {
    font-size: 1.75rem;
    font-weight: 800;
    color: white;
    margin-bottom: 0.25rem;
}

.stat-content p {
    color: #a3a3a3;
    margin-bottom: 0.5rem;
}

.content-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.content-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    overflow: hidden;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid rgba(38, 38, 38, 0.8);
}

.card-header h3 {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
}

.card-action {
    color: #a855f7;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
}

.card-action:hover {
    color: #c084fc;
}

.card-content {
    padding: 1.5rem;
}

.load-item,
.shipment-item,
.payment-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(38, 38, 38, 0.5);
}

.load-item:last-child,
.shipment-item:last-child,
.payment-item:last-child {
    border-bottom: none;
}

.load-route,
.shipment-route {
    color: white;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

.load-details,
.shipment-details {
    color: #a3a3a3;
    font-size: 0.875rem;
}

.payment-amount {
    color: white;
    font-weight: 600;
    font-size: 1.125rem;
    margin-bottom: 0.25rem;
}

.payment-date {
    color: #a3a3a3;
    font-size: 0.875rem;
}

.status-in-transit,
.status-pending,
.status-completed {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 500;
    text-transform: uppercase;
}

.status-in-transit {
    background: rgba(245, 158, 11, 0.1);
    color: #fcd34d;
}

.status-pending {
    background: rgba(59, 130, 246, 0.1);
    color: #93c5fd;
}

.status-completed,
.status-delivered {
    background: rgba(16, 185, 129, 0.1);
    color: #6ee7b7;
}

.status-available {
    background: rgba(59, 130, 246, 0.1);
    color: #93c5fd;
}

.status-assigned {
    background: rgba(245, 158, 11, 0.1);
    color: #fcd34d;
}

.status-cancelled {
    background: rgba(239, 68, 68, 0.1);
    color: #fca5a5;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: #737373;
}

.payment-load {
    font-size: 0.75rem;
    color: #737373;
    margin-top: 0.25rem;
}

.quick-action-buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.quick-action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    padding: 1.5rem;
    background: rgba(38, 38, 38, 0.5);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 12px;
    color: #a3a3a3;
    text-decoration: none;
    transition: all 0.3s ease;
}

.quick-action-btn:hover {
    background: rgba(139, 92, 246, 0.1);
    border-color: #a855f7;
    color: #a855f7;
}

.quick-action-btn i {
    font-size: 1.5rem;
}

.quick-action-btn span {
    font-size: 0.875rem;
    font-weight: 500;
}

.getting-started {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.step-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.step-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    flex-shrink: 0;
}

.step-content h4 {
    color: white;
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.step-content p {
    color: #a3a3a3;
    font-size: 0.875rem;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 0 1rem;
    }
    
    .dashboard-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .welcome-section h1 {
        font-size: 2rem;
    }
    
    .quick-actions {
        width: 100%;
        justify-content: center;
    }
    
    .stats-cards {
        grid-template-columns: 1fr;
    }
    
    .content-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-action-buttons {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
