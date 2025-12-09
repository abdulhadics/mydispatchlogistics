<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ShippoTrackingService;

class TrackingController extends Controller
{
    protected $trackingService;

    public function __construct(ShippoTrackingService $trackingService)
    {
        $this->trackingService = $trackingService;
    }

    public function index()
    {
        return view('tracking');
    }

    public function track(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);

        $trackingNumber = $request->input('tracking_number');
        $result = $this->trackingService->track($trackingNumber);

        return view('tracking', compact('result', 'trackingNumber'));
    }
}
