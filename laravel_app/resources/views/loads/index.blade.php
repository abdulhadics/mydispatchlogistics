@extends('layouts.app')

@section('title', 'Available Loads')
@section('body_class', 'loads-page')

@section('content')
    <div class="container" style="padding-top: 2rem; padding-bottom: 2rem;">
        <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <h1 class="h2 mb-0">Available Loads</h1>
                <a href="{{ route('loads.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Post New Load
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Load #</th>
                            <th>Pickup</th>
                            <th>Delivery</th>
                            <th>Dates</th>
                            <th>Rate</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($loads as $load)
                            <tr>
                                <td>
                                    <span class="text-white font-weight-bold">{{ $load->load_number }}</span>
                                </td>
                                <td>{{ $load->pickup_location }}</td>
                                <td>{{ $load->delivery_location }}</td>
                                <td>
                                    {{ $load->pickup_date->format('M d') }} - {{ $load->delivery_date->format('M d') }}
                                </td>
                                <td class="text-white font-weight-bold">${{ number_format($load->rate, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $load->status === 'available' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($load->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('loads.show', $load->id) }}" class="btn btn-outline btn-sm">
                                        View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <p class="text-muted">No loads available.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <style>
        /* Additional Table Styles matching the theme */
        .table-responsive {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            color: #a3a3a3;
        }

        .table th {
            text-align: left;
            padding: 1rem;
            border-bottom: 2px solid rgba(38, 38, 38, 0.8);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.875rem;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(38, 38, 38, 0.8);
            vertical-align: middle;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .badge-secondary {
            background: rgba(115, 115, 115, 0.1);
            color: #a3a3a3;
            border: 1px solid rgba(115, 115, 115, 0.3);
        }

        .btn-sm {
            padding: 6px 16px;
            font-size: 0.875rem;
        }
    </style>
@endsection