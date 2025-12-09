<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Load;
use Illuminate\Support\Facades\Auth;

class LoadController extends Controller
{
    public function index()
    {
        $loads = Load::with('customer')->latest()->get();
        return view('loads.index', compact('loads'));
    }

    public function create()
    {
        return view('loads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'delivery_location' => 'required|string|max:255',
            'pickup_date' => 'required|date',
            'delivery_date' => 'required|date|after:pickup_date',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $load = new Load();
        $load->load_number = 'LD-' . strtoupper(uniqid());
        $load->customer_id = Auth::id(); // Assuming the creator is the customer
        $load->pickup_location = $validated['pickup_location'];
        $load->delivery_location = $validated['delivery_location'];
        $load->pickup_date = $validated['pickup_date'];
        $load->delivery_date = $validated['delivery_date'];
        $load->weight = $validated['weight'];
        $load->rate = $validated['price']; // Map price to rate
        $load->special_requirements = $validated['description']; // Map description
        $load->status = 'pending'; // Default status as requested
        $load->save();

        return redirect()->route('loads.index')->with('success', 'Load created successfully.');
    }

    public function show($id)
    {
        $load = Load::with(['customer', 'driver'])->findOrFail($id);
        return view('loads.show', compact('load'));
    }
}
