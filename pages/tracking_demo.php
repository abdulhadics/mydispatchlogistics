<?php
$page_title = 'Load Tracking - MyDispatch';
$page_description = 'Real-time load tracking and shipment monitoring.';
$body_class = 'tracking-page';

include 'includes/header_demo.php';
include 'includes/navigation_demo.php';
?>

<div class="tracking-container">
    <div class="tracking-header">
        <h1 class="tracking-title">Load Tracking</h1>
        <p class="tracking-subtitle">
            Real-time tracking and monitoring of your shipments across the United States.
        </p>
    </div>

    <div class="tracking-search">
        <div class="search-card">
            <h3>Track Your Shipment</h3>
            <p>Enter your tracking number or load ID to get real-time updates</p>
            <form class="tracking-form">
                <div class="form-group">
                    <input type="text" placeholder="Enter tracking number" class="form-input">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        Track
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="tracking-demo">
        <div class="demo-header">
            <h2>Live Tracking Demo</h2>
            <p>See how our real-time tracking system works</p>
        </div>

        <div class="tracking-map">
            <div class="map-placeholder">
                <i class="fas fa-map-marked-alt"></i>
                <h3>Interactive Map</h3>
                <p>Real-time GPS tracking with route optimization</p>
            </div>
        </div>

        <div class="tracking-details">
            <div class="detail-card">
                <h4>Load Information</h4>
                <div class="detail-item">
                    <span class="label">Load ID:</span>
                    <span class="value">LD-2024-001234</span>
                </div>
                <div class="detail-item">
                    <span class="label">Pickup:</span>
                    <span class="value">Dallas, TX</span>
                </div>
                <div class="detail-item">
                    <span class="label">Delivery:</span>
                    <span class="value">Los Angeles, CA</span>
                </div>
                <div class="detail-item">
                    <span class="label">Distance:</span>
                    <span class="value">1,440 miles</span>
                </div>
                <div class="detail-item">
                    <span class="label">ETA:</span>
                    <span class="value">2 days 8 hours</span>
                </div>
            </div>

            <div class="detail-card">
                <h4>Current Status</h4>
                <div class="status-timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h5>Pickup Complete</h5>
                            <p>Dallas, TX - 2 hours ago</p>
                        </div>
                    </div>
                    <div class="timeline-item active">
                        <div class="timeline-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="timeline-content">
                            <h5>In Transit</h5>
                            <p>Current location: Austin, TX</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="timeline-content">
                            <h5>Delivery</h5>
                            <p>Los Angeles, CA - Estimated</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="detail-card">
                <h4>Driver Information</h4>
                <div class="driver-info">
                    <div class="driver-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="driver-details">
                        <h5>John Smith</h5>
                        <p>Driver ID: DR-001</p>
                        <p>Phone: (555) 123-4567</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tracking-features">
        <h2>Tracking Features</h2>
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-satellite"></i>
                </div>
                <h4>Real-time GPS</h4>
                <p>Live location updates every 30 seconds</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-bell"></i>
                </div>
                <h4>Smart Alerts</h4>
                <p>Get notified of delays, arrivals, and issues</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-route"></i>
                </div>
                <h4>Route Optimization</h4>
                <p>Automatic route updates for efficiency</p>
            </div>
            <div class="feature-item">
                <div class="feature-icon">
                    <i class="fas fa-mobile-alt"></i>
                </div>
                <h4>Mobile Access</h4>
                <p>Track shipments on any device</p>
            </div>
        </div>
    </div>
</div>

<style>
.tracking-page {
    background: #0a0a0a;
    min-height: 100vh;
    padding-top: 2rem;
}

.tracking-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.tracking-header {
    text-align: center;
    margin-bottom: 3rem;
}

.tracking-title {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.tracking-subtitle {
    font-size: 1.25rem;
    color: #a3a3a3;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.tracking-search {
    margin-bottom: 3rem;
}

.search-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    max-width: 600px;
    margin: 0 auto;
}

.search-card h3 {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.search-card p {
    color: #a3a3a3;
    margin-bottom: 2rem;
}

.tracking-form {
    display: flex;
    gap: 1rem;
    max-width: 400px;
    margin: 0 auto;
}

.tracking-form .form-input {
    flex: 1;
    padding: 12px 16px;
    background: rgba(23, 23, 23, 0.8);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 8px;
    color: white;
    font-size: 1rem;
}

.tracking-form .form-input:focus {
    outline: none;
    border-color: #a855f7;
    box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
}

.tracking-demo {
    margin-bottom: 4rem;
}

.demo-header {
    text-align: center;
    margin-bottom: 2rem;
}

.demo-header h2 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.demo-header p {
    color: #a3a3a3;
    font-size: 1.125rem;
}

.tracking-map {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    height: 400px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.map-placeholder {
    text-align: center;
    color: #a3a3a3;
}

.map-placeholder i {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: #a855f7;
}

.map-placeholder h3 {
    color: white;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.tracking-details {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.detail-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 12px;
    padding: 1.5rem;
}

.detail-card h4 {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.detail-item {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 1px solid rgba(38, 38, 38, 0.5);
}

.detail-item:last-child {
    margin-bottom: 0;
    border-bottom: none;
}

.detail-item .label {
    color: #a3a3a3;
    font-weight: 500;
}

.detail-item .value {
    color: white;
    font-weight: 600;
}

.status-timeline {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.timeline-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.timeline-item.completed .timeline-icon {
    background: #10b981;
    color: white;
}

.timeline-item.active .timeline-icon {
    background: #a855f7;
    color: white;
}

.timeline-item:not(.completed):not(.active) .timeline-icon {
    background: rgba(38, 38, 38, 0.8);
    color: #737373;
}

.timeline-content h5 {
    color: white;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.timeline-content p {
    color: #a3a3a3;
    font-size: 0.875rem;
}

.driver-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.driver-avatar {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
}

.driver-details h5 {
    color: white;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.driver-details p {
    color: #a3a3a3;
    font-size: 0.875rem;
    margin-bottom: 0.125rem;
}

.tracking-features {
    text-align: center;
    margin-bottom: 4rem;
}

.tracking-features h2 {
    color: white;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 2rem;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.feature-item {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
}

.feature-item:hover {
    border-color: rgba(139, 92, 246, 0.5);
    transform: translateY(-2px);
}

.feature-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin: 0 auto 1rem;
}

.feature-item h4 {
    color: white;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.feature-item p {
    color: #a3a3a3;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .tracking-container {
        padding: 0 1rem;
    }
    
    .tracking-title {
        font-size: 2rem;
    }
    
    .tracking-subtitle {
        font-size: 1rem;
    }
    
    .tracking-form {
        flex-direction: column;
    }
    
    .tracking-details {
        grid-template-columns: 1fr;
    }
    
    .features-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
