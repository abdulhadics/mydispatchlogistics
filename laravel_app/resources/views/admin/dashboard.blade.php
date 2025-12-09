@extends('layouts.app')

@section('title', 'Admin Dashboard - MyDispatch')

@section('content')
    <div class="container" style="padding-top: 8rem; padding-bottom: 4rem;">
        <h1 class="h2 mb-4">Admin Dashboard</h1>

        <div class="row">
            <!-- Contact Submissions -->
            <div class="col-12 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Contact Submissions</h3>
                    </div>
                    <div class="card-body">
                        @if($contacts->isEmpty())
                            <p class="text-muted">No contact submissions yet.</p>
                        @else
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; color: #a3a3a3;">
                                    <thead>
                                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left;">
                                            <th style="padding: 1rem;">Date</th>
                                            <th style="padding: 1rem;">Name</th>
                                            <th style="padding: 1rem;">Email</th>
                                            <th style="padding: 1rem;">Message</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contacts as $contact)
                                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                                <td style="padding: 1rem;">{{ $contact->created_at->format('M d, Y H:i') }}</td>
                                                <td style="padding: 1rem;">{{ $contact->name }}</td>
                                                <td style="padding: 1rem;">{{ $contact->email }}</td>
                                                <td style="padding: 1rem;">{{ Str::limit($contact->message, 50) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Carrier Applications -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Carrier Applications</h3>
                    </div>
                    <div class="card-body">
                        @if($carriers->isEmpty())
                            <p class="text-muted">No carrier applications yet.</p>
                        @else
                            <div style="overflow-x: auto;">
                                <table style="width: 100%; border-collapse: collapse; color: #a3a3a3;">
                                    <thead>
                                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); text-align: left;">
                                            <th style="padding: 1rem;">Date</th>
                                            <th style="padding: 1rem;">Company</th>
                                            <th style="padding: 1rem;">MC#</th>
                                            <th style="padding: 1rem;">DOT#</th>
                                            <th style="padding: 1rem;">Contact</th>
                                            <th style="padding: 1rem;">Phone</th>
                                            <th style="padding: 1rem;">Equipment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($carriers as $carrier)
                                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                                                <td style="padding: 1rem;">{{ $carrier->created_at->format('M d, Y H:i') }}</td>
                                                <td style="padding: 1rem;">{{ $carrier->company_name }}</td>
                                                <td style="padding: 1rem;">{{ $carrier->mc_number }}</td>
                                                <td style="padding: 1rem;">{{ $carrier->dot_number }}</td>
                                                <td style="padding: 1rem;">{{ $carrier->contact_name }} <br>
                                                    <small>{{ $carrier->email }}</small></td>
                                                <td style="padding: 1rem;">{{ $carrier->phone }}</td>
                                                <td style="padding: 1rem;">{{ $carrier->equipment_type }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection