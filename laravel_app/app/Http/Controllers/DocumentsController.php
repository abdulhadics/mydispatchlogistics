<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function view($type)
    {
        $documents = [
            'driver_schedule' => [
                'title' => 'Weekly Driver Schedule',
                'content' => '
                    <h3>Driver Schedule - Week of Dec 9, 2024</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr><th>Driver</th><th>Route</th><th>Vehicle</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>John Doe</td><td>NY to CA</td><td>Truck #101</td><td>Active</td></tr>
                            <tr><td>Jane Smith</td><td>TX to FL</td><td>Truck #105</td><td>Scheduled</td></tr>
                            <tr><td>Mike Johnson</td><td>Local Delivery</td><td>Van #202</td><td>Completed</td></tr>
                        </tbody>
                    </table>
                '
            ],
            'maintenance_log' => [
                'title' => 'Vehicle Maintenance Log',
                'content' => '
                    <h3>Maintenance Log - Q4 2024</h3>
                    <ul>
                        <li><strong>Truck #101:</strong> Oil Change - Completed Oct 15</li>
                        <li><strong>Truck #105:</strong> Brake Inspection - Scheduled Dec 20</li>
                        <li><strong>Van #202:</strong> Tire Rotation - Completed Nov 05</li>
                    </ul>
                '
            ],
            'analytics_report' => [
                'title' => 'Performance Analytics Report',
                'content' => '
                    <h3>Q3 Performance Summary</h3>
                    <p><strong>Total Miles:</strong> 150,000</p>
                    <p><strong>Fuel Efficiency:</strong> 7.5 MPG (Up 5%)</p>
                    <p><strong>On-Time Delivery Rate:</strong> 98.5%</p>
                    <div style="background: #eee; height: 200px; display: flex; align-items: center; justify-content: center; margin-top: 20px;">
                        [Chart Placeholder]
                    </div>
                '
            ],
            'compliance' => [
                'title' => '2024 Compliance Guide',
                'content' => '<p>This document outlines the safety and compliance standards for all drivers...</p>'
            ],
            'fuel_stats' => [
                'title' => 'Q3 Fuel Efficiency Stats',
                'content' => '<p>Detailed breakdown of fuel consumption by vehicle...</p>'
            ],
            'onboarding' => [
                'title' => 'Driver Onboarding Checklist',
                'content' => '<ul><li>License Verification</li><li>Background Check</li><li>Safety Training</li></ul>'
            ]
        ];

        $document = $documents[$type] ?? [
            'title' => 'Document Not Found',
            'content' => '<p>The requested document could not be found.</p>'
        ];

        return view('documents.view', compact('document'));
    }
}
