@extends('layouts.app')

@section('title', 'Our Services - MyDispatch')
@section('description', 'Explore our comprehensive truck dispatch services designed to maximize your earnings and efficiency.')
@section('body_class', 'services-page')

@section('content')
    <!-- Hero Section -->
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <h1>Our Services</h1>
                <p class="p-lg">
                    Comprehensive logistics solutions tailored for owner-operators and fleet managers.
                </p>
            </div>
        </div>
    </section>

    <!-- Services List -->
    <section class="features">
        <div class="container-narrow">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-truck-moving"></i>
                    </div>
                    <h3>Full Truckload (FTL)</h3>
                    <p>Dedicated truckload services ensuring your freight moves directly from pickup to delivery without
                        stops.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>Less Than Truckload (LTL)</h3>
                    <p>Cost-effective solutions for smaller shipments that don't require a full trailer.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-temperature-low"></i>
                    </div>
                    <h3>Refrigerated Transport</h3>
                    <p>Temperature-controlled shipping for perishable goods, ensuring freshness upon arrival.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-trailer"></i>
                    </div>
                    <h3>Flatbed Services</h3>
                    <p>Specialized equipment for oversized or irregularly shaped cargo that requires side or top loading.
                    </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>Expedited Shipping</h3>
                    <p>Time-critical delivery services for urgent shipments that need to get there yesterday.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-dollar"></i>
                    </div>
                    <h3>Factoring Assistance</h3>
                    <p>Help with cash flow management through our trusted factoring partners.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container-narrow">
            <div class="cta-content">
                <h2>Need a Custom Solution?</h2>
                <p>Contact us today to discuss your specific logistics requirements.</p>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                        <i class="fas fa-envelope"></i>
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection