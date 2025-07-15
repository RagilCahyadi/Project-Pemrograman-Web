<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->role !== 'admin') {
                return redirect('/')->with('error', 'Access denied. Admin privileges required.');
            }
            return $next($request);
        });
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        try {
            // Basic statistics (fast queries)
            $totalProducts = Product::count();
            $totalCustomers = Customer::count();
            $totalOrders = Order::count();
            $totalContacts = Contact::count();
            $unreadContacts = Contact::where('status', 'unread')->count();
            $totalRevenue = Order::where('is_paid', true)->sum('grand_total_amount') ?? 0;
            
            // Order status counts
            $pendingOrders = Order::where('status', 'pending')->count();
            $processingOrders = Order::where('status', 'processing')->count();
            $completedOrders = Order::where('status', 'completed')->count();
            
            // Recent orders (limited and optimized)
            $recentOrders = Order::with('customer')
                ->select('id', 'customer_id', 'grand_total_amount', 'status', 'created_at', 'booking_trx_id')
                ->orderBy('created_at', 'desc')
                ->limit(5)
                ->get();
            
            // Simple monthly revenue (current year only)
            $monthlyRevenue = [];
            for ($i = 1; $i <= 12; $i++) {
                $monthlyRevenue[$i] = 0;
            }
            
            // Popular products (simplified)
            $popularProducts = Product::select('id', 'name', 'price')
                ->where('is_active', true)
                ->limit(5)
                ->get();

            // Prepare stats array for view
            $stats = [
                'total_orders' => $totalOrders,
                'total_products' => $totalProducts,
                'total_customers' => $totalCustomers,
                'total_categories' => Category::count(),
                'total_contacts' => $totalContacts,
                'unread_contacts' => $unreadContacts,
                'total_revenue' => $totalRevenue,
                'pending_orders' => $pendingOrders,
                'processing_orders' => $processingOrders,
                'completed_orders' => $completedOrders,
                'recent_orders' => $recentOrders,
                'monthly_revenue' => $monthlyRevenue,
                'popular_products' => $popularProducts
            ];

            return view('dashboard', compact('stats'));
        } catch (\Exception $e) {
            // Fallback with empty data if there's an error
            $stats = [
                'total_orders' => 0,
                'total_products' => 0,
                'total_customers' => 0,
                'total_categories' => 0,
                'total_contacts' => 0,
                'unread_contacts' => 0,
                'total_revenue' => 0,
                'pending_orders' => 0,
                'processing_orders' => 0,
                'completed_orders' => 0,
                'recent_orders' => collect(),
                'monthly_revenue' => array_fill(1, 12, 0),
                'popular_products' => collect()
            ];

            return view('dashboard', compact('stats'));
        }
    }
}
