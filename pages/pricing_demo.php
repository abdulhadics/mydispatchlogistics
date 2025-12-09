<?php
$page_title = 'Pricing - MyDispatch';
$page_description = 'Affordable pricing plans for truck dispatch and logistics services.';
$body_class = 'pricing-page';

include 'includes/header_demo.php';
include 'includes/navigation_demo.php';
?>

<div class="pricing-container">
    <div class="pricing-header">
        <h1 class="pricing-title">Simple, Transparent Pricing</h1>
        <p class="pricing-subtitle">
            Choose the plan that fits your business needs. No hidden fees, no surprises.
        </p>
    </div>

    <div class="pricing-grid">
        <div class="pricing-card">
            <div class="pricing-header-card">
                <h3>Starter</h3>
                <div class="pricing-price">
                    <span class="currency">$</span>
                    <span class="amount">150</span>
                    <span class="period">/month</span>
                </div>
                <p class="pricing-description">Perfect for owner-operators</p>
            </div>
            <div class="pricing-features">
                <ul>
                    <li><i class="fas fa-check"></i> Load dispatching</li>
                    <li><i class="fas fa-check"></i> Basic support</li>
                    <li><i class="fas fa-check"></i> Payment processing</li>
                    <li><i class="fas fa-check"></i> Mobile app access</li>
                    <li><i class="fas fa-check"></i> Basic reporting</li>
                </ul>
            </div>
            <div class="pricing-footer">
                <a href="?page=contact" class="btn btn-outline">Get Started</a>
            </div>
        </div>

        <div class="pricing-card featured">
            <div class="pricing-badge">Most Popular</div>
            <div class="pricing-header-card">
                <h3>Professional</h3>
                <div class="pricing-price">
                    <span class="currency">$</span>
                    <span class="amount">300</span>
                    <span class="period">/month</span>
                </div>
                <p class="pricing-description">Ideal for small fleets</p>
            </div>
            <div class="pricing-features">
                <ul>
                    <li><i class="fas fa-check"></i> Everything in Starter</li>
                    <li><i class="fas fa-check"></i> Real-time tracking</li>
                    <li><i class="fas fa-check"></i> Advanced analytics</li>
                    <li><i class="fas fa-check"></i> Priority support</li>
                    <li><i class="fas fa-check"></i> Fleet management</li>
                    <li><i class="fas fa-check"></i> Custom reporting</li>
                </ul>
            </div>
            <div class="pricing-footer">
                <a href="?page=contact" class="btn btn-primary">Get Started</a>
            </div>
        </div>

        <div class="pricing-card">
            <div class="pricing-header-card">
                <h3>Enterprise</h3>
                <div class="pricing-price">
                    <span class="currency">$</span>
                    <span class="amount">500</span>
                    <span class="period">/month</span>
                </div>
                <p class="pricing-description">For large fleets</p>
            </div>
            <div class="pricing-features">
                <ul>
                    <li><i class="fas fa-check"></i> Everything in Professional</li>
                    <li><i class="fas fa-check"></i> Dedicated dispatcher</li>
                    <li><i class="fas fa-check"></i> API integration</li>
                    <li><i class="fas fa-check"></i> 24/7 phone support</li>
                    <li><i class="fas fa-check"></i> Custom solutions</li>
                    <li><i class="fas fa-check"></i> White-label options</li>
                </ul>
            </div>
            <div class="pricing-footer">
                <a href="?page=contact" class="btn btn-outline">Contact Sales</a>
            </div>
        </div>
    </div>

    <div class="pricing-faq">
        <h2>Frequently Asked Questions</h2>
        <div class="faq-grid">
            <div class="faq-item">
                <h4>Is there a setup fee?</h4>
                <p>No setup fees for any of our plans. You only pay the monthly subscription.</p>
            </div>
            <div class="faq-item">
                <h4>Can I change plans anytime?</h4>
                <p>Yes, you can upgrade or downgrade your plan at any time with no penalties.</p>
            </div>
            <div class="faq-item">
                <h4>What payment methods do you accept?</h4>
                <p>We accept all major credit cards, bank transfers, and ACH payments.</p>
            </div>
            <div class="faq-item">
                <h4>Is there a contract?</h4>
                <p>No long-term contracts required. You can cancel anytime with 30 days notice.</p>
            </div>
        </div>
    </div>

    <div class="pricing-cta">
        <h2>Ready to Get Started?</h2>
        <p>Join thousands of truckers who trust MyDispatch for their logistics needs.</p>
        <a href="?page=contact" class="btn btn-primary btn-lg">
            <i class="fas fa-rocket"></i>
            Start Your Free Trial
        </a>
    </div>
</div>

<style>
.pricing-page {
    background: #0a0a0a;
    min-height: 100vh;
    padding-top: 2rem;
}

.pricing-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.pricing-header {
    text-align: center;
    margin-bottom: 4rem;
}

.pricing-title {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
}

.pricing-subtitle {
    font-size: 1.25rem;
    color: #a3a3a3;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

.pricing-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.pricing-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    transition: all 0.3s ease;
    position: relative;
}

.pricing-card:hover {
    border-color: rgba(139, 92, 246, 0.5);
    transform: translateY(-4px);
}

.pricing-card.featured {
    border-color: rgba(139, 92, 246, 0.8);
    transform: scale(1.05);
}

.pricing-badge {
    position: absolute;
    top: -12px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
    padding: 8px 24px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.pricing-header-card {
    text-align: center;
    margin-bottom: 2rem;
}

.pricing-header-card h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: white;
    margin-bottom: 1rem;
}

.pricing-price {
    display: flex;
    align-items: baseline;
    justify-content: center;
    margin-bottom: 1rem;
}

.currency {
    font-size: 1.5rem;
    color: #a855f7;
    font-weight: 600;
}

.amount {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin: 0 0.25rem;
}

.period {
    font-size: 1rem;
    color: #a3a3a3;
}

.pricing-description {
    color: #a3a3a3;
    font-size: 1rem;
}

.pricing-features ul {
    list-style: none;
    padding: 0;
    margin-bottom: 2rem;
}

.pricing-features li {
    color: #e5e5e5;
    margin-bottom: 0.75rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.pricing-features i {
    color: #10b981;
    font-size: 0.875rem;
}

.pricing-footer {
    text-align: center;
}

.faq-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.faq-item {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 12px;
    padding: 1.5rem;
}

.faq-item h4 {
    color: white;
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.75rem;
}

.faq-item p {
    color: #a3a3a3;
    line-height: 1.6;
}

.pricing-cta {
    text-align: center;
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 3rem 2rem;
}

.pricing-cta h2 {
    font-size: 2rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
}

.pricing-cta p {
    color: #a3a3a3;
    margin-bottom: 2rem;
    font-size: 1.125rem;
}

.btn-lg {
    padding: 16px 32px;
    font-size: 1.125rem;
}

@media (max-width: 768px) {
    .pricing-container {
        padding: 0 1rem;
    }
    
    .pricing-title {
        font-size: 2rem;
    }
    
    .pricing-subtitle {
        font-size: 1rem;
    }
    
    .pricing-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .pricing-card.featured {
        transform: none;
    }
    
    .pricing-cta {
        padding: 2rem 1.5rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
