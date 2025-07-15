<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = Order::with(['customer', 'items.product'])
                     ->withCount('items')
                     ->latest()
                     ->get();
        
        $customers = Customer::orderBy('name')->get();
        
        return view('orders.index', compact('orders', 'customers'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        $shippings = Shipping::all();
        $promoCodes = PromoCode::where('is_active', true)->get();
        
        return view('orders.create', compact('customers', 'products', 'shippings', 'promoCodes'));
    }

    public function store(Request $request)
    {
        // Handle different types of order creation
        if ($request->has('products') && is_array($request->products)) {
            // Product-based order (from create form)
            return $this->storeProductOrder($request);
        } else {
            // Simple manual order (from modal)
            return $this->storeManualOrder($request);
        }
    }

    private function storeProductOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'shipping_id' => 'required|exists:shippings,id',
            'promo_code_id' => 'nullable|exists:promo_codes,id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Create order
        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'shipping_id' => $validated['shipping_id'],
            'promo_code_id' => $validated['promo_code_id'],
            'order_date' => now(),
            'sub_total_amount' => 0,
            'discount_amount' => 0,
            'grand_total_amount' => 0,
            'booking_trx_id' => 'TRX-' . time(),
        ]);

        // Calculate totals and create order items
        $subTotal = 0;
        foreach ($validated['products'] as $productData) {
            $product = Product::find($productData['id']);
            $quantity = $productData['quantity'];
            $price = $product->price;
            
            $order->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);
            
            $subTotal += $price * $quantity;
        }

        // Calculate discount and grand total
        $discountAmount = 0;
        if ($order->promo_code_id) {
            $promoCode = PromoCode::find($order->promo_code_id);
            $discountAmount = $promoCode->discount_amount;
        }

        $shipping = Shipping::find($validated['shipping_id']);
        $grandTotal = $subTotal - $discountAmount + $shipping->price;

        $order->update([
            'sub_total_amount' => $subTotal,
            'discount_amount' => $discountAmount,
            'grand_total_amount' => $grandTotal,
        ]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    private function storeManualOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'payment_method' => 'nullable|string',
            'shipping_address' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'grand_total_amount' => $validated['total_amount'],
            'sub_total_amount' => $validated['total_amount'],
            'discount_amount' => 0,
            'status' => $validated['status'],
            'payment_method' => $validated['payment_method'],
            'shipping_address' => $validated['shipping_address'],
            'notes' => $validated['notes'],
            'order_date' => now(),
            'booking_trx_id' => 'ORD-' . time(),
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order created successfully!'
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order created successfully!');
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'items.product', 'shipping', 'promoCode', 'payments']);
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        $customers = Customer::all();
        $shippings = Shipping::all();
        $promoCodes = PromoCode::where('is_active', true)->get();
        
        return view('orders.edit', compact('order', 'customers', 'shippings', 'promoCodes'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'shipping_id' => 'nullable|exists:shippings,id',
            'promo_code_id' => 'nullable|exists:promo_codes,id',
            'status' => 'required|in:pending,processing,completed,cancelled',
            'is_paid' => 'boolean',
            'tracking_number' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $validated['is_paid'] = $request->has('is_paid');
        $order->update($validated);

        return redirect()->route('orders.index')->with('success', 'Order updated successfully!');
    }

    public function destroy(Order $order)
    {
        try {
            $order->items()->delete();
            $order->payments()->delete();
            $order->delete();

            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order deleted successfully!'
                ]);
            }

            return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete order: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->route('orders.index')->with('error', 'Failed to delete order: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => $validated['status']]);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Order status updated successfully!'
            ]);
        }

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully!');
    }

    public function myOrders()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to view your orders.');
        }
        
        // Find customer by user's email
        $customer = Customer::where('email', $user->email)->first();
        
        // Get orders for this customer/user
        $orders = collect();
        
        if ($customer) {
            // Get orders by customer_id
            $customerOrders = Order::where('customer_id', $customer->id)->get();
            $orders = $orders->merge($customerOrders);
        }
        
        // Also get orders by email (for orders created without customer_id)
        $emailOrders = Order::where('customer_email', $user->email)->get();
        $orders = $orders->merge($emailOrders);
        
        // Remove duplicates and sort by creation date
        $orders = $orders->unique('id')->sortByDesc('created_at');
        
        return view('customer.my-orders', compact('orders', 'user'));
    }

    public function invoice(Order $order)
    {
        $order->load(['customer', 'items.product', 'shipping', 'promoCode']);
        return view('orders.invoice', compact('order'));
    }

    public function export()
    {
        $orders = Order::with(['customer', 'items.product'])
                      ->latest()
                      ->get();
        
        // Generate CSV export
        $filename = 'orders-export-' . date('Y-m-d-H-i-s') . '.csv';
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function() use ($orders) {
            $file = fopen('php://output', 'w');
            
            // CSV headers
            fputcsv($file, [
                'Order ID', 'Order Number', 'Customer', 'Email', 'Phone', 
                'Total Amount', 'Status', 'Payment Method', 'Order Date', 'Notes'
            ]);

            // CSV data
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->id,
                    $order->booking_trx_id ?? 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT),
                    $order->customer ? $order->customer->name : $order->customer_name,
                    $order->customer ? $order->customer->email : $order->customer_email,
                    $order->customer ? $order->customer->phone : $order->customer_phone,
                    $order->grand_total_amount,
                    $order->status,
                    $order->payment_method,
                    $order->created_at->format('Y-m-d H:i:s'),
                    $order->notes
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function stats()
    {
        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'processing' => Order::where('status', 'processing')->count(),
            'completed' => Order::where('status', 'completed')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
            'today' => Order::whereDate('created_at', today())->count(),
            'this_month' => Order::whereMonth('created_at', now()->month)->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('grand_total_amount'),
        ];

        return response()->json($stats);
    }
}
