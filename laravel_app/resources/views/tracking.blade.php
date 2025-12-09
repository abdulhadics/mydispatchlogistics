@extends('layouts.app')

@section('title', 'Tracking - MyDispatch')
@section('description', 'Real-time tracking for your shipments. Know where your freight is at all times.')
@section('body_class', 'tracking-page')

@section('content')
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <h1>Real-Time Tracking</h1>
                <p class="p-lg">
                    Monitor your shipments with our advanced GPS tracking system.
                </p>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container-narrow">
            <div class="card text-center" style="padding: 4rem 2rem;">
                <div class="feature-icon" style="margin: 0 auto 2rem; width: 100px; height: 100px; font-size: 3rem;">
                    <i class="fas fa-satellite-dish"></i>
                </div>
                <h2>Track Your Shipment</h2>
                <p class="mb-4">Enter your tracking number below to get the latest status update.</p>

                <form action="#" class="login-form" style="max-width: 500px; margin: 0 auto;">
                    <div class="input-group mb-3">
                        <i class="fas fa-search input-icon"></i>
                        <input type="text" class="form-input" placeholder="Enter Tracking Number (e.g., TRK-12345678)"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">Track Now</button>
                </form>
            </div>
        </div>
    </section>
@endsection