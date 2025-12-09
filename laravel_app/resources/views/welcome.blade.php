@extends('layouts.app')

@section('title', 'MyDispatch - Professional Truck Dispatch Services')
@section('description', 'Premium dispatch for owner-operators and fleets across the United States. Better rates, faster loads, and 24/7 support.')
@section('body_class', 'home-page')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content">
                <div class="hero-grid">
                    <div class="hero-text">
                        <div class="badge">Logistics & Transportation</div>
                        <h1>Premium Truck Dispatching</h1>
                        <p class="p-lg">
                            Premium dispatch for owner-operators and fleets across the United States.
                            Better rates, faster loads, and 24/7 support.
                        </p>
                        <div class="hero-actions">
                            <a href="{{ route('signup') }}" class="btn btn-primary">
                                <i class="fas fa-rocket"></i>
                                Get Started
                            </a>
                            <a href="#" class="btn btn-outline">
                                <i class="fas fa-eye"></i>
                                View Services
                            </a>
                        </div>
                    </div>
                    <div class="hero-image" id="truck-container" style="height: 400px; width: 100%; cursor: move;">
                        <!-- 3D Truck will be rendered here -->
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/controls/OrbitControls.js"></script>
                    <script src="{{ asset('assets/js/truck-3d.js') }}"></script>
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
                    <h3>99.8%</h3>
                    <p>On-Time Delivery</p>
                </div>
                <div class="stat-item">
                    <h3>24/7</h3>
                    <p>Support Available</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container-narrow">
            <div class="section-header">
                <h2>Why Choose MyDispatch?</h2>
                <p>We provide comprehensive dispatch services that help you maximize your earnings and minimize your
                    headaches.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3>Higher Rates</h3>
                    <p>Access to premium freight with better rates than the open market. Our network of shippers pays top
                        dollar for reliable service.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Fast Payment</h3>
                    <p>Quick pay options and reliable payment processing. Get paid within 24-48 hours of delivery
                        completion.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3>24/7 Support</h3>
                    <p>Round-the-clock dispatch support and customer service. We're here when you need us, day or night.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h3>Smart Matching</h3>
                    <p>AI-powered load matching based on your preferences, history, and current location for maximum
                        efficiency.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-satellite-dish"></i>
                    </div>
                    <h3>Real-time Tracking</h3>
                    <p>Advanced GPS tracking and real-time updates to keep you connected with your fleet and customers.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3>Analytics & Reports</h3>
                    <p>Comprehensive analytics and detailed reporting to help you make data-driven business decisions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container-narrow">
            <div class="cta-content">
                <h2>Ready to Maximize Your Earnings?</h2>
                <p>Join thousands of truckers who trust MyDispatch for their logistics needs. Start earning more today.</p>
                <div class="cta-actions">
                    <a href="{{ route('signup') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-rocket"></i>
                        Get Started Now
                    </a>
                    <a href="#" class="btn btn-outline btn-lg">
                        <i class="fas fa-dollar-sign"></i>
                        View Pricing
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection