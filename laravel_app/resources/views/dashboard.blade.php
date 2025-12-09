@extends('layouts.app')

@section('title', 'Dashboard - MyDispatch')
@section('description', 'Your personal dashboard for managing logistics operations.')
@section('body_class', 'dashboard-page')

@section('content')
    <div class="dashboard-container">
        <div class="dashboard-header">
            <div class="welcome-section">
                <h1 class="welcome-title">
                    Welcome back, {{ $user->name }}!
                </h1>
                <p class="welcome-subtitle">
                    Here's what's happening with your {{ ucfirst($user->role) }} account.
                </p>
            </div>

            <div class="quick-actions">
                <a href="{{ route('contact') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i>
                    New Load
                </a>
                <a href="{{ route('tracking') }}" class="btn btn-outline">
                    <i class="fas fa-map-marked-alt"></i>
                    Track Shipment
                </a>
            </div>
        </div>

        @if ($user->role === 'driver')
            <!-- Driver Dashboard -->
            <div class="dashboard-grid">
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['active_loads'] ?? 0 }}</h3>
                            <p>Active Loads</p>
                            <span class="stat-change positive">Current</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-content">
                            <h3>${{ number_format($stats['monthly_earnings'] ?? 0, 2) }}</h3>
                            <p>This Month</p>
                            <span class="stat-change positive">Earnings</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ number_format($stats['total_miles'] ?? 0) }}</h3>
                            <p>Miles Driven</p>
                            <span class="stat-change neutral">Total</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3>4.8</h3>
                            <p>Rating</p>
                            <span class="stat-change positive">Excellent</span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-content">
                    <div class="content-grid">
                        <div class="content-card">
                            <div class="card-header">
                                <h3>Recent Loads</h3>
                                <a href="#" class="card-action">View All</a>
                            </div>
                            <div class="card-content">
                                @if ($recentLoads->isEmpty())
                                    <div class="empty-state">
                                        <p>No loads found</p>
                                    </div>
                                @else
                                    @foreach ($recentLoads as $load)
                                        <div class="load-item">
                                            <div class="load-info">
                                                <div class="load-route">{{ $load->pickup_location }} → {{ $load->delivery_location }}
                                                </div>
                                                <div class="load-details">
                                                    {{ $load->equipment_type ?: 'N/A' }}
                                                    @if ($load->weight)• {{ number_format($load->weight) }} lbs @endif
                                                    • ${{ number_format($load->rate, 2) }}
                                                </div>
                                            </div>
                                            <div class="load-status status-{{ str_replace('_', '-', $load->status) }}">
                                                {{ ucfirst(str_replace('_', ' ', $load->status)) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="content-card">
                            <div class="card-header">
                                <h3>Payment History</h3>
                                <a href="#" class="card-action">View All</a>
                            </div>
                            <div class="card-content">
                                @if ($recentPayments->isEmpty())
                                    <div class="empty-state">
                                        <p>No payments found</p>
                                    </div>
                                @else
                                    @foreach ($recentPayments as $payment)
                                        <div class="payment-item">
                                            <div class="payment-info">
                                                <div class="payment-amount">${{ number_format($payment->amount, 2) }}</div>
                                                <div class="payment-date">{{ $payment->created_at->format('M j, Y') }}</div>
                                                @if ($payment->load)
                                                    <div class="payment-load">Load: {{ $payment->load->load_number }}</div>
                                                @endif
                                            </div>
                                            <div class="payment-status status-{{ $payment->status }}">
                                                {{ ucfirst($payment->status) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif ($user->role === 'customer')
            <!-- Customer Dashboard -->
            <div class="dashboard-grid">
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-shipping-fast"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['active_shipments'] ?? 0 }}</h3>
                            <p>Active Shipments</p>
                            <span class="stat-change positive">Current</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-content">
                            <h3>${{ number_format($stats['total_spent'] ?? 0, 2) }}</h3>
                            <p>Total Spent</p>
                            <span class="stat-change positive">All Time</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['on_time_delivery'] ?? 0 }}%</h3>
                            <p>On-Time Delivery</p>
                            <span class="stat-change positive">Rate</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="stat-content">
                            <h3>4.9</h3>
                            <p>Service Rating</p>
                            <span class="stat-change positive">Outstanding</span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-content">
                    <div class="content-grid">
                        <div class="content-card">
                            <div class="card-header">
                                <h3>Recent Shipments</h3>
                                <a href="#" class="card-action">View All</a>
                            </div>
                            <div class="card-content">
                                @if ($recentLoads->isEmpty())
                                    <div class="empty-state">
                                        <p>No shipments found</p>
                                    </div>
                                @else
                                    @foreach ($recentLoads as $load)
                                        <div class="shipment-item">
                                            <div class="shipment-info">
                                                <div class="shipment-route">{{ $load->pickup_location }} →
                                                    {{ $load->delivery_location }}</div>
                                                <div class="shipment-details">
                                                    {{ $load->equipment_type ?: 'N/A' }}
                                                    @if ($load->weight)• {{ number_format($load->weight) }} lbs @endif
                                                    • ${{ number_format($load->rate, 2) }}
                                                </div>
                                            </div>
                                            <div class="shipment-status status-{{ str_replace('_', '-', $load->status) }}">
                                                {{ ucfirst(str_replace('_', ' ', $load->status)) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="content-card">
                            <div class="card-header">
                                <h3>Quick Actions</h3>
                            </div>
                            <div class="card-content">
                                <div class="quick-action-buttons">
                                    <a href="{{ route('contact') }}" class="quick-action-btn">
                                        <i class="fas fa-plus"></i>
                                        <span>New Shipment</span>
                                    </a>
                                    <a href="{{ route('tracking') }}" class="quick-action-btn">
                                        <i class="fas fa-search"></i>
                                        <span>Track Package</span>
                                    </a>
                                    <a href="#" class="quick-action-btn">
                                        <i class="fas fa-file-invoice"></i>
                                        <span>Get Quote</span>
                                    </a>
                                    <a href="#" class="quick-action-btn">
                                        <i class="fas fa-headset"></i>
                                        <span>Contact Support</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif ($user->role === 'admin')
            <!-- Admin Dashboard -->
            <div class="dashboard-grid">
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['total_users'] ?? 0 }}</h3>
                            <p>Total Users</p>
                            <span class="stat-change positive">{{ $stats['active_users'] ?? 0 }} Active</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-truck-loading"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['total_loads'] ?? 0 }}</h3>
                            <p>Total Loads</p>
                            <span class="stat-change neutral">{{ $stats['in_transit'] ?? 0 }} In Transit</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-content">
                            <h3>${{ number_format($stats['monthly_revenue'] ?? 0, 2) }}</h3>
                            <p>Monthly Revenue</p>
                            <span class="stat-change positive">This Month</span>
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-gavel"></i>
                        </div>
                        <div class="stat-content">
                            <h3>{{ $stats['active_rules'] ?? 0 }}</h3>
                            <p>Active Rules</p>
                            <span class="stat-change neutral">{{ $stats['total_categories'] ?? 0 }} Categories</span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-content">
                    <div class="content-grid">
                        <div class="content-card">
                            <div class="card-header">
                                <h3>Recent Users</h3>
                                <a href="{{ route('admin.users') }}" class="card-action">Manage All</a>
                            </div>
                            <div class="card-content">
                                @if ($recentUsers->isEmpty())
                                    <div class="empty-state">
                                        <p>No users found</p>
                                    </div>
                                @else
                                    @foreach ($recentUsers as $recentUser)
                                        <div class="load-item">
                                            <div class="load-info">
                                                <div class="load-route">{{ $recentUser->name }}</div>
                                                <div class="load-details">
                                                    {{ $recentUser->email }} • Joined {{ $recentUser->created_at->diffForHumans() }}
                                                </div>
                                            </div>
                                            <span class="status-badge {{ $recentUser->status }}">{{ ucfirst($recentUser->role) }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="content-card">
                            <div class="card-header">
                                <h3>Quick Admin Actions</h3>
                            </div>
                            <div class="card-content">
                                <div class="quick-action-buttons">
                                    <a href="{{ route('admin.users') }}" class="quick-action-btn">
                                        <i class="fas fa-users-cog"></i>
                                        <span>Manage Users</span>
                                    </a>
                                    <a href="{{ route('admin.categories') }}" class="quick-action-btn">
                                        <i class="fas fa-folder-plus"></i>
                                        <span>Categories</span>
                                    </a>
                                    <a href="{{ route('admin.rules') }}" class="quick-action-btn">
                                        <i class="fas fa-gavel"></i>
                                        <span>Rules</span>
                                    </a>
                                    <a href="{{ route('loads.index') }}" class="quick-action-btn">
                                        <i class="fas fa-truck"></i>
                                        <span>All Loads</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Analytics Charts Placeholder -->
                    <div class="content-card" style="margin-top: 2rem;">
                        <div class="card-header">
                            <h3>System Analytics</h3>
                        </div>
                        <div class="card-content">
                            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                                <div>
                                    <h4 style="color: #737373; font-size: 0.875rem; margin-bottom: 1rem;">Users by Role</h4>
                                    @foreach($usersByRole as $role => $count)
                                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                            <span style="text-transform: capitalize;">{{ $role }}</span>
                                            <span style="color: #a855f7; font-weight: 600;">{{ $count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    <h4 style="color: #737373; font-size: 0.875rem; margin-bottom: 1rem;">Loads by Status</h4>
                                    @foreach($loadsByStatus as $status => $count)
                                        <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                            <span style="text-transform: capitalize;">{{ str_replace('_', ' ', $status) }}</span>
                                            <span style="color: #22c55e; font-weight: 600;">{{ $count }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- Default Dashboard -->
            <div class="dashboard-grid">
                <div class="stats-cards">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="stat-content">
                            <h3>Welcome!</h3>
                            <p>Get Started</p>
                            <span class="stat-change positive">Explore features</span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-content">
                    <div class="content-card">
                        <div class="card-header">
                            <h3>Getting Started</h3>
                        </div>
                        <div class="card-content">
                            <div class="getting-started">
                                <div class="step-item">
                                    <div class="step-number">1</div>
                                    <div class="step-content">
                                        <h4>Complete Your Profile</h4>
                                        <p>Add your company information and preferences</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">2</div>
                                    <div class="step-content">
                                        <h4>Explore Services</h4>
                                        <p>Learn about our dispatch and logistics services</p>
                                    </div>
                                </div>
                                <div class="step-item">
                                    <div class="step-number">3</div>
                                    <div class="step-content">
                                        <h4>Contact Us</h4>
                                        <p>Get in touch to start your logistics journey</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <style>
        .dashboard-container {
            padding: 2rem 0;
            min-height: 80vh;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .welcome-title {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .welcome-subtitle {
            color: #a3a3a3;
        }

        .quick-actions {
            display: flex;
            gap: 1rem;
        }

        .dashboard-grid {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
        }

        .stat-card {
            background: rgba(23, 23, 23, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            background: rgba(23, 23, 23, 0.8);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: rgba(168, 85, 247, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #a855f7;
            font-size: 1.5rem;
        }

        .stat-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .stat-content p {
            font-size: 0.875rem;
            color: #a3a3a3;
            margin-bottom: 0.25rem;
        }

        .stat-change {
            font-size: 0.75rem;
            font-weight: 500;
        }

        .stat-change.positive {
            color: #22c55e;
        }

        .stat-change.negative {
            color: #ef4444;
        }

        .stat-change.neutral {
            color: #a3a3a3;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .content-card {
            background: rgba(23, 23, 23, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1.5rem;
            height: 100%;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .card-header h3 {
            font-size: 1.25rem;
            color: #fff;
        }

        .card-action {
            color: #a855f7;
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.3s ease;
        }

        .card-action:hover {
            color: #c084fc;
        }

        .load-item,
        .shipment-item,
        .payment-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .load-item:last-child,
        .shipment-item:last-child,
        .payment-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .load-route,
        .shipment-route {
            font-weight: 500;
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .load-details,
        .shipment-details {
            font-size: 0.875rem;
            color: #a3a3a3;
        }

        .payment-amount {
            font-weight: 600;
            color: #fff;
        }

        .payment-date {
            font-size: 0.875rem;
            color: #a3a3a3;
        }

        .payment-load {
            font-size: 0.75rem;
            color: #737373;
        }

        .status-assigned,
        .status-in-transit,
        .status-available {
            color: #3b82f6;
            background: rgba(59, 130, 246, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-delivered,
        .status-completed,
        .status-paid {
            color: #22c55e;
            background: rgba(34, 197, 94, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-pending {
            color: #eab308;
            background: rgba(234, 179, 8, 0.1);
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .quick-action-buttons {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .quick-action-btn {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #fff;
            transition: all 0.3s ease;
        }

        .quick-action-btn:hover {
            background: rgba(168, 85, 247, 0.1);
            color: #a855f7;
        }

        .quick-action-btn i {
            font-size: 1.5rem;
        }

        .empty-state {
            text-align: center;
            padding: 2rem 0;
            color: #737373;
        }

        .getting-started {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .step-item {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }

        .step-number {
            width: 32px;
            height: 32px;
            background: rgba(168, 85, 247, 0.1);
            color: #a855f7;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            flex-shrink: 0;
        }

        .step-content h4 {
            color: #fff;
            margin-bottom: 0.25rem;
        }

        .step-content p {
            color: #a3a3a3;
            font-size: 0.875rem;
        }

        @media (max-width: 992px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .quick-actions {
                width: 100%;
            }

            .quick-actions .btn {
                flex: 1;
                justify-content: center;
            }
        }
    </style>
@endsection