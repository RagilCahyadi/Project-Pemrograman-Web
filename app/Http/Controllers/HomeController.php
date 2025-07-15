<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the public homepage (no auth required)
     */
    public function home()
    {
        // Get statistics for homepage
        $stats = [
            'customers' => Customer::count() . '+',
            'orders' => Order::count() . '+',
            'products' => Product::count() . '+',
        ];

        return view('home', compact('stats'));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['home']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            // Basic statistics (fast queries)
            $totalProducts = Product::count();
            $totalCustomers = Customer::count();
            $totalOrders = Order::count();
            $totalContacts = Contact::count();
            $unreadContacts = Contact::unread()->count();
            $totalRevenue = Order::where('is_paid', true)->sum('grand_total_amount') ?? 0;
            
            // Order status counts
            $pendingOrders = Order::where('status', 'pending')->count();
            $processingOrders = Order::where('status', 'processing')->count();
            $completedOrders = Order::where('status', 'completed')->count();
            
            // Recent orders (limited and optimized)
            $recentOrders = Order::select('id', 'customer_name', 'customer_email', 'grand_total_amount', 'status', 'created_at')
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
                'total_revenue' => 0,
                'pending_orders' => 0,
                'processing_orders' => 0,
                'completed_orders' => 0,
                'recent_orders' => collect(),
                'monthly_revenue' => [],
                'popular_products' => collect()
            ];
            
            return view('dashboard', compact('stats'));
        }
    }

    /**
     * Get dashboard statistics for AJAX
     */
    public function stats()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_customers' => Customer::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('is_paid', true)->sum('grand_total_amount'),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'processing_orders' => Order::where('status', 'processing')->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'monthly_revenue' => Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(grand_total_amount) as revenue')
            )
            ->where('is_paid', true)
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('revenue', 'month'),
        ];

        return response()->json($stats);
    }

    /**
     * Handle contact form submission
     */
    public function sendContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000'
        ]);

        try {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'unread'
            ]);

            return redirect()->back()->with('contact_success', 
                'Pesan Anda telah berhasil dikirim! Tim kami akan segera menghubungi Anda.');
        } catch (\Exception $e) {
            return redirect()->back()->with('contact_error', 
                'Maaf, terjadi kesalahan saat mengirim pesan. Silakan coba lagi.');
        }
    }
}
