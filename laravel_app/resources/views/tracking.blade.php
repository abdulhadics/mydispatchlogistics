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

                <form action="{{ route('tracking.track') }}" method="POST" class="login-form"
                    style="max-width: 500px; margin: 0 auto;">
                    @csrf
                    <div class="input-group mb-3">
                        <i class="fas fa-search input-icon"></i>
                        <input type="text" name="tracking_number" class="form-input"
                            placeholder="Enter Tracking Number (e.g., SHIPPO_DELIVERED)" value="{{ $trackingNumber ?? '' }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-full">Track Now</button>
                </form>

                @if(isset($result))
                    <div class="mt-8 text-left"
                        style="max-width: 600px; margin: 2rem auto 0; background: rgba(255,255,255,0.05); padding: 1.5rem; border-radius: 12px;">
                        <h3 class="h4 mb-4">Tracking Status</h3>

                        @if(isset($result['tracking_status']))
                            <div class="mb-4">
                                <span class="badge badge-primary"
                                    style="background: #8b5cf6; color: white; padding: 5px 10px; border-radius: 4px;">
                                    {{ $result['tracking_status']['status'] ?? 'UNKNOWN' }}
                                </span>
                                <p class="mt-2 text-white">{{ $result['tracking_status']['status_details'] ?? '' }}</p>
                                <p class="text-muted text-sm">
                                    {{ isset($result['tracking_status']['status_date']) ? \Carbon\Carbon::parse($result['tracking_status']['status_date'])->format('F j, Y g:i A') : '' }}
                                </p>
                            </div>

                            @if(isset($result['tracking_history']))
                                <h4 class="h5 mb-3 text-gray-300">History</h4>
                                <ul style="list-style: none; padding: 0;">
                                    @foreach($result['tracking_history'] as $history)
                                        <li class="mb-3 pb-3 border-b border-gray-700">
                                            <p class="text-white font-medium">{{ $history['status'] ?? '' }}</p>
                                            <p class="text-sm text-gray-400">{{ $history['status_details'] ?? '' }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ isset($history['status_date']) ? \Carbon\Carbon::parse($history['status_date'])->format('M d, Y g:i A') : '' }}
                                                - {{ $history['location']['city'] ?? '' }}, {{ $history['location']['state'] ?? '' }}
                                            </p>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        @else
                            <div class="alert alert-warning">
                                No tracking information found for this number.
                            </div>
                            @if(config('app.debug'))
                                <pre
                                    class="text-xs text-gray-500 mt-4 overflow-auto">{{ json_encode($result, JSON_PRETTY_PRINT) }}</pre>
                            @endif
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection