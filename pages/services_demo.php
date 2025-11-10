<?php
$page_title = 'Our Services - MyDispatch';
$page_description = 'Professional truck dispatch and logistics services for owner-operators and fleets.';
$body_class = 'services-page';

include 'includes/header_demo.php';
include 'includes/navigation_demo.php';
?>

<div class="services-container">
    <div class="services-header">
        <h1 class="services-title">Our Services</h1>
        <p class="services-subtitle">
            Comprehensive truck dispatch and logistics solutions designed to maximize your earnings and streamline your operations.
        </p>
    </div>

    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-truck"></i>
            </div>
            <h3>Load Dispatching</h3>
            <p>Professional load dispatching services that connect you with the best freight opportunities across the United States.</p>
            <ul class="service-features">
                <li>Real-time load matching</li>
                <li>Premium rate negotiation</li>
                <li>24/7 dispatch support</li>
                <li>Dedicated dispatcher</li>
            </ul>
            <div class="service-price">Starting at $150/month</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <h3>Fleet Management</h3>
            <p>Complete fleet management solutions to optimize routes, reduce costs, and improve efficiency.</p>
            <ul class="service-features">
                <li>Route optimization</li>
                <li>Fuel cost tracking</li>
                <li>Driver management</li>
                <li>Performance analytics</li>
            </ul>
            <div class="service-price">Starting at $500/month</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-satellite-dish"></i>
            </div>
            <h3>Real-time Tracking</h3>
            <p>Advanced GPS tracking and real-time location updates to keep you connected with your fleet.</p>
            <ul class="service-features">
                <li>GPS tracking</li>
                <li>Real-time updates</li>
                <li>Geofencing alerts</li>
                <li>Mobile app access</li>
            </ul>
            <div class="service-price">Starting at $25/month</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <h3>Payment Processing</h3>
            <p>Fast and secure payment processing with quick pay options and detailed financial reporting.</p>
            <ul class="service-features">
                <li>Quick pay options</li>
                <li>Direct deposit</li>
                <li>Financial reporting</li>
                <li>Invoice management</li>
            </ul>
            <div class="service-price">Starting at $50/month</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-headset"></i>
            </div>
            <h3>24/7 Support</h3>
            <p>Round-the-clock customer support from experienced logistics professionals who understand your business.</p>
            <ul class="service-features">
                <li>24/7 phone support</li>
                <li>Live chat assistance</li>
                <li>Emergency dispatch</li>
                <li>Issue resolution</li>
            </ul>
            <div class="service-price">Included with all plans</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3>Analytics & Reporting</h3>
            <p>Comprehensive analytics and detailed reporting to help you make data-driven business decisions.</p>
            <ul class="service-features">
                <li>Performance metrics</li>
                <li>Revenue tracking</li>
                <li>Custom reports</li>
                <li>Trend analysis</li>
            </ul>
            <div class="service-price">Starting at $75/month</div>
        </div>
    </div>

    <div class="services-cta">
        <h2>Ready to Get Started?</h2>
        <p>Choose the services that fit your business needs and start maximizing your trucking operations today.</p>
        <div class="cta-buttons">
            <a href="?page=contact" class="btn btn-primary">
                <i class="fas fa-phone"></i>
                Contact Us
            </a>
            <a href="?page=pricing" class="btn btn-outline">
                <i class="fas fa-dollar-sign"></i>
                View Pricing
            </a>
        </div>
    </div>
</div>

<style>
.services-page {
    background: #0a0a0a;
    min-height: 100vh;
    padding-top: 2rem;
}

.services-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.services-header {
    text-align: center;
    margin-bottom: 4rem;
}

.services-title {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.services-subtitle {
    font-size: 1.25rem;
    color: #a3a3a3;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.service-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    transition: all 0.3s ease;
}

.service-card:hover {
    border-color: rgba(139, 92, 246, 0.5);
    transform: translateY(-4px);
}

.service-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    margin-bottom: 1.5rem;
}

.service-card h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    margin-bottom: 1rem;
}

.service-card p {
    color: #a3a3a3;
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.service-features {
    list-style: none;
    padding: 0;
    margin-bottom: 1.5rem;
}

.service-features li {
    color: #e5e5e5;
    margin-bottom: 0.5rem;
    padding-left: 1.5rem;
    position: relative;
}

.service-features li::before {
    content: '✓';
    color: #10b981;
    position: absolute;
    left: 0;
    font-weight: bold;
}

.service-price {
    font-size: 1.25rem;
    font-weight: 600;
    color: #a855f7;
    text-align: center;
    padding-top: 1rem;
    border-top: 1px solid rgba(38, 38, 38, 0.8);
}

.services-cta {
    text-align: center;
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 3rem 2rem;
}

.services-cta h2 {
    font-size: 2rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.services-cta p {
    color: #a3a3a3;
    margin-bottom: 2rem;
    font-size: 1.125rem;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .services-container {
        padding: 0 1rem;
    }
    
    .services-title {
        font-size: 2rem;
    }
    
    .services-subtitle {
        font-size: 1rem;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .service-card {
        padding: 1.5rem;
    }
    
    .services-cta {
        padding: 2rem 1.5rem;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-buttons .btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
