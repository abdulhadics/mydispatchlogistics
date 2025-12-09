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
                    <a href="{{ route('documents.view', ['type' => 'driver_schedule']) }}"
                        class="btn btn-outline btn-sm mt-4" target="_blank">
                        <i class="fas fa-file-alt"></i> View Schedule
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-tools"></i></div>
                    <h3>Maintenance Tracking</h3>
                    <p>Keep track of vehicle maintenance schedules to minimize downtime.</p>
                    <a href="{{ route('documents.view', ['type' => 'maintenance_log']) }}"
                        class="btn btn-outline btn-sm mt-4" target="_blank">
                        <i class="fas fa-file-medical"></i> View Logs
                    </a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-chart-pie"></i></div>
                    <h3>Performance Analytics</h3>
                    <p>Detailed reports on fleet performance, fuel usage, and profitability.</p>
                    <a href="{{ route('documents.view', ['type' => 'analytics_report']) }}"
                        class="btn btn-outline btn-sm mt-4" target="_blank">
                        <i class="fas fa-file-invoice-dollar"></i> View Report
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="section" style="background: rgba(255,255,255,0.02); padding: 4rem 0;">
        <div class="container-narrow">
            <h2 class="h3 text-center mb-5">Company Resources</h2>
            <div class="card">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Document Name</th>
                                <th>Type</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><i class="fas fa-file-pdf text-danger mr-2"></i> 2024 Compliance Guide.pdf</td>
                                <td>Policy</td>
                                <td>Oct 15, 2024</td>
                                <td><a href="{{ route('documents.view', ['type' => 'compliance']) }}" target="_blank"
                                        class="text-primary">Download</a></td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-file-excel text-success mr-2"></i> Q3 Fuel Efficiency Stats.xlsx</td>
                                <td>Report</td>
                                <td>Nov 01, 2024</td>
                                <td><a href="{{ route('documents.view', ['type' => 'fuel_stats']) }}" target="_blank"
                                        class="text-primary">Download</a></td>
                            </tr>
                            <tr>
                                <td><i class="fas fa-file-word text-blue mr-2"></i> Driver Onboarding Checklist.docx</td>
                                <td>Form</td>
                                <td>Dec 05, 2024</td>
                                <td><a href="{{ route('documents.view', ['type' => 'onboarding']) }}" target="_blank"
                                        class="text-primary">Download</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection