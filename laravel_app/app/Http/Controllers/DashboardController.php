<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Load; // Added this use statement

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];
        $recentLoads = collect();
        $recentPayments = collect();

        if ($user->role === 'driver') {
            // Driver stats
            $stats['active_loads'] = $user->assignedLoads()->whereIn('status', ['assigned', 'in_transit'])->count();

            $stats['monthly_earnings'] = $user->assignedLoads()
                ->where('status', 'delivered')
                ->whereMonth('updated_at', now()->month)
                ->whereYear('updated_at', now()->year)
                ->sum('rate');

            $stats['total_miles'] = $user->assignedLoads()
                ->where('status', 'delivered')
                ->sum('miles');

            // Recent loads
            $recentLoads = $user->assignedLoads()->latest()->limit(5)->get();

            // Recent payments
            $recentPayments = $user->payments()->with('load')->latest()->limit(5)->get();

        } elseif ($user->role === 'customer') {
            // Customer stats
            $stats['active_shipments'] = Load::where('customer_id', $user->id)
                ->whereIn('status', ['assigned', 'in_transit', 'available'])
                ->count();

            $stats['total_spent'] = Load::where('customer_id', $user->id)->sum('rate');

            $delivered = Load::where('customer_id', $user->id)->where('status', 'delivered')->count();
            $total = Load::where('customer_id', $user->id)->count();
            $stats['on_time_delivery'] = $total > 0 ? round(($delivered / $total) * 100) : 0;

            // Recent shipments
            $recentLoads = Load::where('customer_id', $user->id)->latest()->limit(5)->get();
        }

        return view('dashboard', compact('user', 'stats', 'recentLoads', 'recentPayments'));
    }
}
