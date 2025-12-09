<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Load;
use App\Models\User;
use App\Models\Category;
use App\Models\Rule;
use App\Models\Notification;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $stats = [];
        $recentLoads = collect();
        $recentPayments = collect();
        $recentUsers = collect();
        $usersByRole = [];
        $loadsByStatus = [];
        $categories = collect();
        $rules = collect();

        if ($user->role === 'admin') {
            // Admin gets full system analytics
            $stats['total_users'] = User::count();
            $stats['active_users'] = User::where('status', 'active')->count();
            $stats['total_loads'] = Load::count();
            $stats['pending_loads'] = Load::where('status', 'pending')->count();
            $stats['in_transit'] = Load::where('status', 'in_transit')->count();
            $stats['delivered'] = Load::where('status', 'delivered')->count();
            $stats['total_categories'] = Category::count();
            $stats['active_rules'] = Rule::where('is_active', true)->count();
            $stats['monthly_revenue'] = Load::where('status', 'delivered')
                ->whereMonth('created_at', now()->month)
                ->sum('rate');

            // Recent users
            $recentUsers = User::latest()->take(5)->get();

            // Recent loads (all)
            $recentLoads = Load::with('customer', 'driver')->latest()->take(5)->get();

            // User distribution by role
            $usersByRole = User::select('role', DB::raw('count(*) as count'))
                ->groupBy('role')
                ->get()
                ->pluck('count', 'role')
                ->toArray();

            // Load status distribution
            $loadsByStatus = Load::select('status', DB::raw('count(*) as count'))
                ->groupBy('status')
                ->get()
                ->pluck('count', 'status')
                ->toArray();

            // Categories and Rules
            $categories = Category::where('is_active', true)->orderBy('sort_order')->get();
            $rules = Rule::where('is_active', true)->latest()->take(5)->get();

        } elseif ($user->role === 'driver') {
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
            $recentPayments = $user->payments()->with('loadData')->latest()->limit(5)->get();

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

        // Get unread notifications count for header
        $unreadNotifications = Notification::where('user_id', $user->id)
            ->where('is_read', false)
            ->count();

        return view('dashboard', compact(
            'user',
            'stats',
            'recentLoads',
            'recentPayments',
            'recentUsers',
            'usersByRole',
            'loadsByStatus',
            'categories',
            'rules',
            'unreadNotifications'
        ));
    }
}
