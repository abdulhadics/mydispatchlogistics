@extends('layouts.app')

@section('title', 'Pricing - MyDispatch')
@section('description', 'Transparent pricing for our dispatch services. No hidden fees, just results.')
@section('body_class', 'pricing-page')

@section('content')
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <h1>Simple, Transparent Pricing</h1>
                <p class="p-lg">
                    Choose the plan that fits your business needs.
                </p>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container-narrow">
            <div class="features-grid">
                <div class="feature-card">
                    <h3>Standard</h3>
                    <div class="price" style="font-size: 2.5rem; font-weight: 800; color: #a855f7; margin: 1rem 0;">5%</div>
                    <p>Per Load</p>
                    <ul style="list-style: none; text-align: left; margin-top: 1.5rem;">
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Load Negotiation</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Paperwork Handling</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Credit Checks</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> 24/7 Support</li>
                    </ul>
                    <a href="{{ route('signup') }}" class="btn btn-outline btn-full mt-4">Get Started</a>
                </div>

                <div class="feature-card" style="border-color: #a855f7; background: rgba(168, 85, 247, 0.1);">
                    <div class="badge"
                        style="background: #a855f7; color: white; padding: 0.25rem 0.5rem; border-radius: 4px; display: inline-block; margin-bottom: 0.5rem;">
                        Most Popular</div>
                    <h3>Premium</h3>
                    <div class="price" style="font-size: 2.5rem; font-weight: 800; color: #a855f7; margin: 1rem 0;">7%</div>
                    <p>Per Load</p>
                    <ul style="list-style: none; text-align: left; margin-top: 1.5rem;">
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> All Standard Features</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Factoring Assistance</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Fuel Card Program</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Dedicated Dispatcher</li>
                    </ul>
                    <a href="{{ route('signup') }}" class="btn btn-primary btn-full mt-4">Get Started</a>
                </div>

                <div class="feature-card">
                    <h3>Fleet</h3>
                    <div class="price" style="font-size: 2.5rem; font-weight: 800; color: #a855f7; margin: 1rem 0;">Custom
                    </div>
                    <p>For 5+ Trucks</p>
                    <ul style="list-style: none; text-align: left; margin-top: 1.5rem;">
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Volume Discounts</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Fleet Management Tools</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Priority Support</li>
                        <li class="mb-2"><i class="fas fa-check text-success mr-2"></i> Custom Reporting</li>
                    </ul>
                    <a href="{{ route('contact') }}" class="btn btn-outline btn-full mt-4">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>
@endsection