@extends('layouts.app')

@section('title', 'Load Details')

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
        <div class="card" style="max-width: 900px; margin: 0 auto;">
            <div class="card-header"
                style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(38, 38, 38, 0.8); padding-bottom: 1rem; margin-bottom: 1.5rem;">
                <h1 class="h3 mb-0">Load #{{ $load->load_number }}</h1>
                <span class="badge badge-{{ $load->status === 'available' ? 'success' : 'secondary' }}"
                    style="font-size: 1rem; padding: 6px 16px;">
                    {{ ucfirst($load->status) }}
                </span>
            </div>

            <div class="load-details-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
                <!-- Route Info -->
                <div>
                    <h3 class="h4"
                        style="color: #a3a3a3; border-bottom: 1px solid rgba(38, 38, 38, 0.8); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                        Route Information</h3>
                    <div class="mb-4">
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Pickup</p>
                        <p class="text-white font-weight-bold mb-1" style="font-size: 1.125rem;">
                            {{ $load->pickup_location }}</p>
                        <p class="text-muted" style="font-size: 0.875rem;">{{ $load->pickup_date->format('F j, Y g:i A') }}
                        </p>
                    </div>
                    <div class="mb-4">
                        <p class="text-muted mb-1" style="font-size: 0.875rem;">Delivery</p>
                        <p class="text-white font-weight-bold mb-1" style="font-size: 1.125rem;">
                            {{ $load->delivery_location }}</p>
                        <p class="text-muted" style="font-size: 0.875rem;">
                            {{ $load->delivery_date->format('F j, Y g:i A') }}</p>
                    </div>
                </div>

                <!-- Load Details -->
                <div>
                    <h3 class="h4"
                        style="color: #a3a3a3; border-bottom: 1px solid rgba(38, 38, 38, 0.8); padding-bottom: 0.5rem; margin-bottom: 1rem;">
                        Load Details</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="mb-4">
                            <p class="text-muted mb-1" style="font-size: 0.875rem;">Weight</p>
                            <p class="text-white font-weight-bold">{{ number_format($load->weight) }} lbs</p>
                        </div>
                        <div class="mb-4">
                            <p class="text-muted mb-1" style="font-size: 0.875rem;">Rate</p>
                            <p class="text-white font-weight-bold" style="font-size: 1.25rem; color: #10b981;">
                                ${{ number_format($load->rate, 2) }}</p>
                        </div>
                    </div>

                    @if($load->special_requirements)
                        <div class="mb-4">
                            <p class="text-muted mb-1" style="font-size: 0.875rem;">Description / Special Requirements</p>
                            <p class="text-white" style="background: rgba(23, 23, 23, 0.8); padding: 1rem; border-radius: 8px;">
                                {{ $load->special_requirements }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Customer Info -->
            <div class="mt-4 pt-4"
                style="border-top: 1px solid rgba(38, 38, 38, 0.8); margin-top: 2rem; padding-top: 1.5rem;">
                <h3 class="h4" style="color: #a3a3a3; margin-bottom: 1rem;">Posted By</h3>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div
                        style="width: 40px; height: 40px; background: rgba(139, 92, 246, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #a855f7;">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="text-white font-weight-bold mb-0">{{ $load->customer->name ?? 'Unknown' }}</p>
                        <p class="text-muted mb-0" style="font-size: 0.875rem;">Customer ID: {{ $load->customer_id }}</p>
                    </div>
                </div>
            </div>

            <div class="text-right mt-4" style="margin-top: 2rem;">
                <a href="{{ route('loads.index') }}" class="btn btn-outline" style="margin-right: 1rem;">Back to List</a>
                @if($load->status === 'available')
                    <button class="btn btn-primary">
                        Book This Load
                    </button>
                @endif
            </div>
        </div>
    </div>

    <style>
        .text-muted {
            color: #a3a3a3;
        }

        .font-weight-bold {
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .load-details-grid {
                grid-template-columns: 1fr !important;
                gap: 2rem !important;
            }
        }
    </style>
@endsection