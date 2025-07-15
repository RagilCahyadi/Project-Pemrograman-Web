@extends('layouts.app')

@section('title', 'Admin Dashboard')

@push('styles')
<style>
    .stats-card {
        transition: transform 0.2s ease-in-out;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 15px;
    }
    
    .stats-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    
    .icon-bg {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin: 0 auto 15px;
    }
    
    .quick-action-card {
        transition: all 0.2s ease-in-out;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-radius: 10px;
    }
    
    .quick-action-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    
    .chart-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h2 mb-1 text-gray-800">
                        <i class="bi bi-speedometer2 text-primary me-2"></i>
                        Admin Dashboard
                    </h1>
                    <p class="text-muted">Welcome to RNR Digital Printing Management System</p>
                </div>
                <div class="text-end">
                    <span class="badge bg-primary px-3 py-2">{{ now()->format('l, F j, Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <div class="icon-bg bg-primary bg-opacity-10">
                        <i class="bi bi-cart3 text-primary"></i>
                    </div>
                    <h5 class="card-title text-muted mb-2">Total Orders</h5>
                    <h2 class="text-primary mb-0">{{ number_format($stats['total_orders']) }}</h2>
                    <small class="text-success">
                        <i class="bi bi-arrow-up"></i> Active orders
                    </small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <div class="icon-bg bg-success bg-opacity-10">
                        <i class="bi bi-currency-dollar text-success"></i>
                    </div>
                    <h5 class="card-title text-muted mb-2">Total Revenue</h5>
                    <h2 class="text-success mb-0">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h2>
                    <small class="text-success">
                        <i class="bi bi-arrow-up"></i> All time
                    </small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <div class="icon-bg bg-info bg-opacity-10">
                        <i class="bi bi-box-seam text-info"></i>
                    </div>
                    <h5 class="card-title text-muted mb-2">Total Products</h5>
                    <h2 class="text-info mb-0">{{ number_format($stats['total_products']) }}</h2>
                    <small class="text-info">
                        <i class="bi bi-check-circle"></i> Active products
                    </small>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stats-card h-100">
                <div class="card-body text-center">
                    <div class="icon-bg bg-warning bg-opacity-10">
                        <i class="bi bi-people text-warning"></i>
                    </div>
                    <h5 class="card-title text-muted mb-2">Total Customers</h5>
                    <h2 class="text-warning mb-0">{{ number_format($stats['total_customers']) }}</h2>
                    <small class="text-warning">
                        <i class="bi bi-person-plus"></i> Registered users
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card chart-card">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-lightning text-primary me-2"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card quick-action-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-plus-circle text-primary mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="card-title">Add Product</h6>
                                    <a href="{{ route('products.create') }}" class="btn btn-outline-primary btn-sm">
                                        Create New
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card quick-action-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-cart-plus text-success mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="card-title">View Orders</h6>
                                    <a href="{{ route('orders.index') }}" class="btn btn-outline-success btn-sm">
                                        Manage Orders
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card quick-action-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-people text-info mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="card-title">Customers</h6>
                                    <a href="{{ route('customers.index') }}" class="btn btn-outline-info btn-sm">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card quick-action-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-tags text-warning mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="card-title">Categories</h6>
                                    <a href="{{ route('categories.index') }}" class="btn btn-outline-warning btn-sm">
                                        Manage Categories
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card quick-action-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-envelope text-secondary mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="card-title">Messages</h6>
                                    <a href="{{ route('contacts.index') }}" class="btn btn-outline-secondary btn-sm">
                                        View Messages
                                        @if(($stats['unread_contacts'] ?? 0) > 0)
                                            <span class="badge bg-danger">{{ $stats['unread_contacts'] }}</span>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
                            <div class="card quick-action-card h-100">
                                <div class="card-body text-center">
                                    <i class="bi bi-box text-primary mb-2" style="font-size: 2rem;"></i>
                                    <h6 class="card-title">Products</h6>
                                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-sm">
                                        View All
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders and Contact Messages -->
    <div class="row">
        <div class="col-lg-8 mb-4">
            <div class="card chart-card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-clock-history text-primary me-2"></i>
                        Recent Orders
                    </h5>
                    <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm">View All</a>
                </div>
                <div class="card-body">
                    @if($stats['recent_orders']->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats['recent_orders'] as $order)
                                    <tr>
                                        <td><strong>#{{ $order->id }}</strong></td>
                                        <td>
                                            <div>
                                                <strong>{{ $order->customer ? $order->customer->name : 'Unknown Customer' }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $order->customer ? $order->customer->email : 'No email' }}</small>
                                            </div>
                                        </td>
                                        <td><span class="fw-bold text-success">Rp {{ number_format($order->grand_total_amount, 0, ',', '.') }}</span></td>
                                        <td>
                                            <span class="badge bg-{{ $order->status === 'completed' ? 'success' : ($order->status === 'processing' ? 'warning' : 'secondary') }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                            <p class="text-muted mt-3">No recent orders found.</p>
                            <a href="{{ route('orders.create') }}" class="btn btn-primary">Create First Order</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card chart-card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-envelope text-primary me-2"></i>
                        Contact Messages
                        @if($stats['unread_contacts'] > 0)
                            <span class="badge bg-danger">{{ $stats['unread_contacts'] }} new</span>
                        @endif
                    </h5>
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary btn-sm">View All</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 text-center">
                            <div class="icon-bg bg-primary bg-opacity-10 mb-3">
                                <i class="bi bi-envelope-fill text-primary"></i>
                            </div>
                            <h4 class="text-primary">{{ $stats['total_contacts'] }}</h4>
                            <small class="text-muted">Total Messages</small>
                        </div>
                        <div class="col-6 text-center">
                            <div class="icon-bg bg-danger bg-opacity-10 mb-3">
                                <i class="bi bi-exclamation-circle text-danger"></i>
                            </div>
                            <h4 class="text-danger">{{ $stats['unread_contacts'] }}</h4>
                            <small class="text-muted">Unread</small>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('contacts.index') }}" class="btn btn-primary w-100">
                            <i class="bi bi-eye me-2"></i>
                            View All Messages
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Additional Stats -->
            <div class="card chart-card mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">
                        <i class="bi bi-graph-up text-primary me-2"></i>
                        System Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Categories</span>
                        <span class="fw-bold text-info">{{ $stats['total_categories'] ?? 0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Pending Orders</span>
                        <span class="fw-bold text-warning">{{ $stats['pending_orders'] ?? 0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Processing Orders</span>
                        <span class="fw-bold text-info">{{ $stats['processing_orders'] ?? 0 }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-muted">Completed Orders</span>
                        <span class="fw-bold text-success">{{ $stats['completed_orders'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
