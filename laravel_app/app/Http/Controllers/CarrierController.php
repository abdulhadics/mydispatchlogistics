<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrier;

class CarrierController extends Controller
{
    public function index()
    {
        return view('carrier-setup');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'mc_number' => 'required|string|max:255',
            'dot_number' => 'required|string|max:255',
            'contact_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'equipment_type' => 'required|string',
        ]);

        Carrier::create($validated);

        return redirect()->route('carrier-setup')->with('success', 'Carrier application submitted successfully!');
    }
}
