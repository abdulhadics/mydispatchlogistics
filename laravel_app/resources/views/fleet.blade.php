@extends('layouts.app')

@section('title', 'Fleet Services - MyDispatch')
@section('description', 'Optimize your fleet operations with our advanced dispatching and management services.')
@section('body_class', 'fleet-page')

@section('content')
    <section class="hero">
        <div class="container-narrow">
            <div class="hero-content text-center">
                <h1>Fleet Management</h1>
                <p class="p-lg">
                    Scale your operations with our comprehensive fleet solutions.
                </p>
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container-narrow">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-users-cog"></i></div>
                    <h3>Driver Management</h3>
                    <p>Tools to manage driver schedules, performance, and compliance.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-tools"></i></div>
                    <h3>Maintenance Tracking</h3>
                    <p>Keep track of vehicle maintenance schedules to minimize downtime.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-chart-pie"></i></div>
                    <h3>Performance Analytics</h3>
                    <p>Detailed reports on fleet performance, fuel usage, and profitability.</p>
                </div>
            </div>
        </div>
    </section>
@endsection