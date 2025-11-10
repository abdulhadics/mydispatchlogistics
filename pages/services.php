<?php
$page_title = 'Services - MyDispatch';
$page_description = 'Professional truck dispatch and logistics services for owner-operators and fleets.';
$body_class = 'services-page';

include 'includes/header.php';
?>

<div class="services-container">
    <div class="services-header">
        <h1 class="services-title">Our Services</h1>
        <p class="services-subtitle">
            Comprehensive logistics solutions designed to maximize your trucking business potential
        </p>
    </div>

    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-truck"></i>
            </div>
            <h3 class="service-title">Load Dispatching</h3>
            <p class="service-description">
                Professional load dispatching services with access to thousands of freight opportunities. 
                Our experienced dispatchers work 24/7 to keep your trucks moving and profitable.
            </p>
            <ul class="service-features">
                <li><i class="fas fa-check"></i> 24/7 Dispatch Support</li>
                <li><i class="fas fa-check"></i> Access to Premium Loads</li>
                <li><i class="fas fa-check"></i> Rate Negotiation</li>
                <li><i class="fas fa-check"></i> Load Planning & Routing</li>
            </ul>
            <div class="service-price">Starting at $150/month</div>
        </div>

        <div class="service-card featured">
            <div class="service-badge">Most Popular</div>
            <div class="service-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <h3 class="service-title">Fleet Management</h3>
            <p class="service-description">
                Complete fleet management solution with real-time tracking, maintenance scheduling, 
                and performance analytics to optimize your operations.
            </p>
            <ul class="service-features">
                <li><i class="fas fa-check"></i> Real-time GPS Tracking</li>
                <li><i class="fas fa-check"></i> Maintenance Scheduling</li>
                <li><i class="fas fa-check"></i> Performance Analytics</li>
                <li><i class="fas fa-check"></i> Driver Management</li>
                <li><i class="fas fa-check"></i> Fuel Optimization</li>
            </ul>
            <div class="service-price">Starting at $500/month</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-credit-card"></i>
            </div>
            <h3 class="service-title">Payment Processing</h3>
            <p class="service-description">
                Fast and secure payment processing with same-day settlements. 
                Get paid quickly for your deliveries with our streamlined payment system.
            </p>
            <ul class="service-features">
                <li><i class="fas fa-check"></i> Same-day Settlements</li>
                <li><i class="fas fa-check"></i> Secure Transactions</li>
                <li><i class="fas fa-check"></i> Multiple Payment Methods</li>
                <li><i class="fas fa-check"></i> Detailed Reporting</li>
            </ul>
            <div class="service-price">2.5% per transaction</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <h3 class="service-title">Analytics & Reporting</h3>
            <p class="service-description">
                Comprehensive analytics and reporting tools to track your business performance, 
                identify opportunities, and make data-driven decisions.
            </p>
            <ul class="service-features">
                <li><i class="fas fa-check"></i> Revenue Tracking</li>
                <li><i class="fas fa-check"></i> Cost Analysis</li>
                <li><i class="fas fa-check"></i> Performance Metrics</li>
                <li><i class="fas fa-check"></i> Custom Reports</li>
            </ul>
            <div class="service-price">Included with Fleet Management</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-headset"></i>
            </div>
            <h3 class="service-title">24/7 Support</h3>
            <p class="service-description">
                Round-the-clock customer support from experienced professionals who understand 
                the trucking industry and are committed to your success.
            </p>
            <ul class="service-features">
                <li><i class="fas fa-check"></i> Phone & Email Support</li>
                <li><i class="fas fa-check"></i> Live Chat Available</li>
                <li><i class="fas fa-check"></i> Emergency Assistance</li>
                <li><i class="fas fa-check"></i> Industry Expertise</li>
            </ul>
            <div class="service-price">Included with all plans</div>
        </div>

        <div class="service-card">
            <div class="service-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h3 class="service-title">Insurance & Compliance</h3>
            <p class="service-description">
                Comprehensive insurance and compliance management to protect your business 
                and ensure you meet all regulatory requirements.
            </p>
            <ul class="service-features">
                <li><i class="fas fa-check"></i> Insurance Management</li>
                <li><i class="fas fa-check"></i> DOT Compliance</li>
                <li><i class="fas fa-check"></i> Safety Training</li>
                <li><i class="fas fa-check"></i> Audit Support</li>
            </ul>
            <div class="service-price">Custom pricing</div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="services-cta">
        <div class="cta-content">
            <h2>Ready to Get Started?</h2>
            <p>Choose the services that best fit your business needs and start maximizing your profits today.</p>
            <div class="cta-buttons">
                <a href="?page=contact" class="btn btn-primary">
                    <i class="fas fa-phone"></i>
                    Get Free Quote
                </a>
                <a href="?page=signup" class="btn btn-outline">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </a>
            </div>
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
    position: relative;
}

.service-card:hover {
    border-color: rgba(139, 92, 246, 0.3);
    transform: translateY(-4px);
}

.service-card.featured {
    border-color: #a855f7;
    background: rgba(139, 92, 246, 0.05);
}

.service-badge {
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.service-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: 1.5rem;
}

.service-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    margin-bottom: 1rem;
}

.service-description {
    color: #a3a3a3;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.service-features {
    list-style: none;
    margin-bottom: 2rem;
}

.service-features li {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    color: #e5e5e5;
    margin-bottom: 0.75rem;
    font-size: 0.875rem;
}

.service-features i {
    color: #10b981;
    font-size: 0.75rem;
}

.service-price {
    font-size: 1.125rem;
    font-weight: 600;
    color: #a855f7;
    text-align: center;
    padding: 1rem;
    background: rgba(139, 92, 246, 0.1);
    border-radius: 8px;
    border: 1px solid rgba(139, 92, 246, 0.3);
}

.services-cta {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 3rem 2rem;
    text-align: center;
}

.cta-content h2 {
    font-size: 2rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.cta-content p {
    color: #a3a3a3;
    font-size: 1.125rem;
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
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
    
    .services-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .service-card {
        padding: 1.5rem;
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
