<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;

// Public routes
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::post('/contact', [HomeController::class, 'sendContact'])->name('contact.send');

// Service routes (public)
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/fancy-paper', [ServiceController::class, 'fancyPaper'])->name('fancy-paper');
    Route::get('/packaging', [ServiceController::class, 'packaging'])->name('packaging');
    Route::get('/banner', [ServiceController::class, 'banner'])->name('banner');
    Route::get('/uv-printing', [ServiceController::class, 'uvPrinting'])->name('uv-printing');
    Route::post('/calculate-price', [ServiceController::class, 'calculatePrice'])->name('calculate-price');
    Route::post('/place-order', [ServiceController::class, 'placeOrder'])->name('place-order');
});

// Checkout routes (public)
Route::get('/checkout', [ServiceController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [ServiceController::class, 'storeOrderData'])->name('checkout.store');
Route::post('/checkout/process', [ServiceController::class, 'processCheckout'])->name('checkout.process');
Route::get('/checkout/success/{order}', [ServiceController::class, 'checkoutSuccess'])->name('checkout.success');

// Authentication routes
Auth::routes();

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Customer Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('dashboard.home');
    
    // Order management for customers
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my-orders');
});

// Admin Dashboard Route (Admin only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
});

// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Admin login routes (only for guests)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    });
    
    // Admin protected routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    });
});

// Admin CRUD Routes (Admin only)
Route::middleware(['auth', 'admin'])->group(function () {
    // Product CRUD (Admin only)
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/upload-photo', [ProductController::class, 'uploadPhoto'])->name('products.upload-photo');
    Route::delete('products/{product}/photos/{photo}', [ProductController::class, 'deletePhoto'])->name('products.delete-photo');
    
    // Category CRUD (Admin only)
    Route::resource('categories', CategoryController::class);
    
    // Customer CRUD (Admin only)
    Route::resource('customers', CustomerController::class);
    
    // Order CRUD (Admin only)
    Route::get('orders/export', [OrderController::class, 'export'])->name('orders.export');
    Route::resource('orders', OrderController::class);
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::patch('orders/{order}/payment', [OrderController::class, 'updatePayment'])->name('orders.update-payment');
    Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    
    // Contact management (Admin only)
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
    Route::patch('contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contacts.updateStatus');
});

// API routes for AJAX (Admin only)
Route::prefix('api')->middleware(['auth', 'admin'])->group(function () {
    Route::get('products/search', [ProductController::class, 'search'])->name('api.products.search');
    Route::get('customers/search', [CustomerController::class, 'search'])->name('api.customers.search');
    Route::get('orders/stats', [OrderController::class, 'stats'])->name('api.orders.stats');
    Route::get('dashboard/stats', [HomeController::class, 'stats'])->name('api.dashboard.stats');
    Route::patch('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('api.categories.toggle-status');
});

// Test route for my-orders (remove in production)
Route::get('/test-my-orders', function() {
    // Simulate authenticated user
    $user = App\Models\User::where('email', 'customer@example.com')->first();
    if (!$user) {
        return 'Test user not found. Please run the tinker command to create test data.';
    }
    
    // Find customer by user's email
    $customer = App\Models\Customer::where('email', $user->email)->first();
    
    if (!$customer) {
        $orders = collect();
    } else {
        $orders = App\Models\Order::where('customer_id', $customer->id)
                      ->orWhere('customer_email', $user->email)
                      ->orderBy('created_at', 'desc')
                      ->get();
    }
    
    return view('customer.my-orders', compact('orders', 'user'));
})->name('test.my-orders');

// Test route for delete functionality (remove in production)
Route::get('/test-delete', function() {
    return view('test-delete');
})->name('test.delete');
