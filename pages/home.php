<?php
$page_title = 'MyDispatch - Professional Truck Dispatch Services';
$page_description = 'Premium dispatch for owner-operators and fleets across the United States. Better rates, faster loads, and 24/7 support.';
$body_class = 'home-page';

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container-narrow">
        <div class="hero-content">
            <div class="hero-grid">
                <div class="hero-text">
                    <div class="badge">Logistics & Transportation</div>
                    <h1>Dark, Modern Truck Dispatching</h1>
                    <p class="p-lg">
                        Premium dispatch for owner-operators and fleets across the United States. 
                        Better rates, faster loads, and 24/7 support.
                    </p>
                    <div class="hero-actions">
                        <a href="?page=contact" class="btn btn-primary">
                            <i class="fas fa-rocket"></i>
                            Get Started
                        </a>
                        <a href="?page=services" class="btn btn-outline">
                            <i class="fas fa-eye"></i>
                            View Services
                        </a>
                    </div>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1920&auto=format&fit=crop" 
                         alt="Modern trucking and logistics" 
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container-narrow">
        <div class="stats-grid">
            <div class="stat-item">
                <h3>500+</h3>
                <p>Happy Clients</p>
            </div>
            <div class="stat-item">
                <h3>10,000+</h3>
                <p>Loads Dispatched</p>
            </div>
            <div class="stat-item">
                <h3>24/7</h3>
                <p>Support</p>
            </div>
            <div class="stat-item">
                <h3>98%</h3>
                <p>On-Time Rate</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features">
    <div class="container-narrow">
        <h2 class="h2 text-center mb-4">Why Choose Our Dispatch</h2>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-bolt"></i>
                </div>
                <h3>Fast & Efficient</h3>
                <p>Quick load matching and smart routing to keep wheels turning and profits flowing.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3>Reliable Support</h3>
                <p>Real humans, 24/7. Issues solved before they slow you down on the road.</p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <h3>Better Rates</h3>
                <p>Negotiation experts securing premium rates through our extensive network.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials">
    <div class="container-narrow">
        <h2 class="h2 text-center mb-4">What Our Clients Say</h2>
        
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>"MyDispatch has transformed my trucking business. The rates are consistently better, and the support team is always there when I need them."</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop&crop=face" alt="John Smith">
                    </div>
                    <div class="author-info">
                        <h4>John Smith</h4>
                        <p>Owner Operator</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>"The technology platform is incredible. Real-time tracking and automated load matching have increased our efficiency by 40%."</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&crop=face" alt="Sarah Johnson">
                    </div>
                    <div class="author-info">
                        <h4>Sarah Johnson</h4>
                        <p>Fleet Manager</p>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card">
                <div class="testimonial-content">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>"Professional, reliable, and always looking out for my best interests. I wouldn't trust anyone else with my dispatch needs."</p>
                </div>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&crop=face" alt="Mike Davis">
                    </div>
                    <div class="author-info">
                        <h4>Mike Davis</h4>
                        <p>Independent Driver</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta">
    <div class="container-narrow text-center">
        <h2 class="h2 mb-4">Ready to Boost Your Trucking Business?</h2>
        <p class="p-lg mb-4">
            Join carriers nationwide who trust our dispatch to maximize earnings with less hassle.
        </p>
        <a href="?page=contact" class="btn btn-primary btn-lg">
            <i class="fas fa-phone"></i>
            Contact Us Now
        </a>
    </div>
</section>

<style>
.testimonials {
    padding: 6rem 0;
    background: #0a0a0a;
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.testimonial-card {
    background: rgba(23, 23, 23, 0.6);
    border: 1px solid rgba(38, 38, 38, 0.8);
    border-radius: 16px;
    padding: 2rem;
    transition: all 0.3s ease;
}

.testimonial-card:hover {
    border-color: rgba(139, 92, 246, 0.3);
    transform: translateY(-4px);
}

.testimonial-content {
    margin-bottom: 1.5rem;
}

.stars {
    display: flex;
    gap: 0.25rem;
    margin-bottom: 1rem;
    color: #fbbf24;
}

.testimonial-content p {
    color: #a3a3a3;
    font-style: italic;
    line-height: 1.6;
}

.testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.author-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
}

.author-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.author-info h4 {
    color: white;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.author-info p {
    color: #a3a3a3;
    font-size: 0.875rem;
}

.cta {
    padding: 6rem 0;
    background: linear-gradient(135deg, #1a1a1a 0%, #0a0a0a 100%);
    border-top: 1px solid rgba(38, 38, 38, 0.8);
}

.btn-lg {
    padding: 16px 32px;
    font-size: 1.125rem;
}

@media (max-width: 768px) {
    .testimonials-grid {
        grid-template-columns: 1fr;
    }
    
    .testimonial-card {
        padding: 1.5rem;
    }
}
</style>

<?php include 'includes/footer.php'; ?>
