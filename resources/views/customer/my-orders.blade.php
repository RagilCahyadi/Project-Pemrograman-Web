@extends('layouts.app')

@section('title', 'My Orders - RNR Digital Printing')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-12">
            <!-- Header Section -->
            <div class="page-header mb-5">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h1 class="page-title">
                            <i class="bi bi-box-seam me-3"></i>My Orders
                        </h1>
                        <p class="page-subtitle text-muted">Track and manage your printing orders</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="welcome-badge">
                            <i class="bi bi-person-circle me-2"></i>
                            Welcome, <strong>{{ $user->name }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            @if($orders && $orders->count() > 0)
                <!-- Orders Summary Cards -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="bi bi-box"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ $orders->count() }}</h3>
                                <p>Total Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon pending">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ $orders->where('status', 'pending')->count() }}</h3>
                                <p>Pending</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon processing">
                                <i class="bi bi-gear"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ $orders->where('status', 'processing')->count() }}</h3>
                                <p>Processing</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon completed">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <div class="stat-content">
                                <h3>{{ $orders->where('status', 'completed')->count() }}</h3>
                                <p>Completed</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders List -->
                <div class="orders-container">
                    @foreach($orders as $order)
                        <div class="order-card">
                            <div class="order-header">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="order-info">
                                            <h5 class="order-id">
                                                @if($order->booking_trx_id)
                                                    {{ $order->booking_trx_id }}
                                                @else
                                                    ORD-{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                                                @endif
                                            </h5>
                                            <p class="order-date">
                                                <i class="bi bi-calendar3 me-2"></i>
                                                {{ $order->created_at->format('d M Y, H:i') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <div class="order-status-wrapper">
                                            <span class="order-status status-{{ $order->status ?? 'pending' }}">
                                                @switch($order->status ?? 'pending')
                                                    @case('pending')
                                                        <i class="bi bi-clock me-1"></i>Pending
                                                        @break
                                                    @case('processing')
                                                        <i class="bi bi-gear me-1"></i>Processing
                                                        @break
                                                    @case('shipped')
                                                        <i class="bi bi-truck me-1"></i>Shipped
                                                        @break
                                                    @case('completed')
                                                        <i class="bi bi-check-circle me-1"></i>Completed
                                                        @break
                                                    @case('cancelled')
                                                        <i class="bi bi-x-circle me-1"></i>Cancelled
                                                        @break
                                                    @default
                                                        <i class="bi bi-clock me-1"></i>Pending
                                                @endswitch
                                            </span>
                                            <span class="payment-status payment-{{ $order->payment_status ?? 'pending' }}">
                                                @if($order->is_paid)
                                                    <i class="bi bi-check-circle me-1"></i>Paid
                                                @else
                                                    <i class="bi bi-credit-card me-1"></i>{{ ucfirst($order->payment_status ?? 'Pending') }}
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="order-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="order-details">
                                            <h6 class="detail-title">
                                                <i class="bi bi-info-circle me-2"></i>Order Details
                                            </h6>
                                            
                                            <!-- Service Type -->
                                            <div class="detail-row">
                                                <span class="detail-label">Service:</span>
                                                <span class="detail-value">
                                                    @switch($order->service_type)
                                                        @case('packaging')
                                                            <i class="bi bi-box me-1"></i>Packaging & Sticker
                                                            @break
                                                        @case('banner')
                                                            <i class="bi bi-flag me-1"></i>Banner & Signage
                                                            @break
                                                        @case('uv_printing')
                                                            <i class="bi bi-printer me-1"></i>UV Printing
                                                            @break
                                                        @case('fancy_paper')
                                                            <i class="bi bi-file-text me-1"></i>Fancy Paper
                                                            @break
                                                        @default
                                                            <i class="bi bi-printer me-1"></i>{{ ucfirst($order->service_type ?? 'Digital Printing') }}
                                                    @endswitch
                                                </span>
                                            </div>

                                            <!-- Service Specific Details -->
                                            @if($order->paper_type)
                                            <div class="detail-row">
                                                <span class="detail-label">
                                                    @if($order->service_type === 'uv_printing')
                                                        Item Type:
                                                    @elseif($order->service_type === 'banner')
                                                        Material:
                                                    @else
                                                        Paper Type:
                                                    @endif
                                                </span>
                                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $order->paper_type)) }}</span>
                                            </div>
                                            @endif

                                            @if($order->size)
                                            <div class="detail-row">
                                                <span class="detail-label">Size:</span>
                                                <span class="detail-value">{{ $order->size }}</span>
                                            </div>
                                            @endif

                                            @if($order->finishing)
                                            <div class="detail-row">
                                                <span class="detail-label">
                                                    @if($order->service_type === 'uv_printing')
                                                        Printing Side:
                                                    @else
                                                        Finishing:
                                                    @endif
                                                </span>
                                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $order->finishing)) }}</span>
                                            </div>
                                            @endif

                                            <div class="detail-row">
                                                <span class="detail-label">Quantity:</span>
                                                <span class="detail-value">
                                                    <strong>{{ $order->quantity ?? 1 }}</strong>
                                                    @if($order->service_type === 'packaging')
                                                        pcs
                                                    @elseif($order->service_type === 'banner')
                                                        banner
                                                    @elseif($order->service_type === 'uv_printing')
                                                        pcs
                                                    @else
                                                        lembar
                                                    @endif
                                                </span>
                                            </div>

                                            @if($order->shipping_method)
                                            <div class="detail-row">
                                                <span class="detail-label">Shipping:</span>
                                                <span class="detail-value">
                                                    @switch($order->shipping_method)
                                                        @case('pickup')
                                                            <i class="bi bi-shop me-1"></i>Pickup
                                                            @break
                                                        @case('local')
                                                            <i class="bi bi-geo-alt me-1"></i>Local Delivery
                                                            @break
                                                        @case('regional')
                                                            <i class="bi bi-truck me-1"></i>Regional Shipping
                                                            @break
                                                        @case('national')
                                                            <i class="bi bi-send me-1"></i>National Shipping
                                                            @break
                                                        @case('express')
                                                            <i class="bi bi-lightning me-1"></i>Express Delivery
                                                            @break
                                                        @default
                                                            {{ ucfirst($order->shipping_method) }}
                                                    @endswitch
                                                </span>
                                            </div>
                                            @endif

                                            @if($order->notes)
                                            <div class="detail-row">
                                                <span class="detail-label">Notes:</span>
                                                <span class="detail-value">{{ $order->notes }}</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="order-pricing">
                                            <h6 class="pricing-title">
                                                <i class="bi bi-calculator me-2"></i>Pricing
                                            </h6>
                                            
                                            @if($order->sub_total_amount)
                                            <div class="price-row">
                                                <span>Subtotal:</span>
                                                <span>Rp {{ number_format($order->sub_total_amount, 0, ',', '.') }}</span>
                                            </div>
                                            @endif

                                            @if($order->shipping_cost)
                                            <div class="price-row">
                                                <span>Shipping:</span>
                                                <span>Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                                            </div>
                                            @endif

                                            @if($order->tax_amount)
                                            <div class="price-row">
                                                <span>Tax:</span>
                                                <span>Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                                            </div>
                                            @endif

                                            @if($order->discount_amount && $order->discount_amount > 0)
                                            <div class="price-row discount">
                                                <span>Discount:</span>
                                                <span>- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                                            </div>
                                            @endif

                                            <div class="price-row total">
                                                <span><strong>Total:</strong></span>
                                                <span><strong>Rp {{ number_format($order->grand_total_amount ?? $order->total_amount ?? 0, 0, ',', '.') }}</strong></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if($order->status === 'pending' || $order->payment_status === 'pending')
                            <div class="order-actions">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if(!$order->is_paid && $order->payment_status === 'pending')
                                        <div class="payment-reminder">
                                            <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                                            <span>Payment required to process this order</span>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        @if($order->status === 'pending')
                                        <a href="mailto:info@rnrdigitalprinting.com?subject=Order Inquiry: {{ $order->booking_trx_id ?? 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}" 
                                           class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-envelope me-1"></i>Contact Support
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="bi bi-box"></i>
                    </div>
                    <h3>No Orders Yet</h3>
                    <p>You haven't placed any orders yet. Start by exploring our services!</p>
                    <div class="empty-actions">
                        <a href="{{ route('services.packaging') }}" class="btn btn-primary me-2">
                            <i class="bi bi-box me-2"></i>Packaging Service
                        </a>
                        <a href="{{ route('services.banner') }}" class="btn btn-outline-primary me-2">
                            <i class="bi bi-flag me-2"></i>Banner Service
                        </a>
                        <a href="{{ route('services.uv-printing') }}" class="btn btn-outline-primary">
                            <i class="bi bi-printer me-2"></i>UV Printing
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
        border-radius: 15px;
        color: white;
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .welcome-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    /* Stats Cards */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 1.5rem;
    }

    .stat-icon.pending {
        background: linear-gradient(135deg, #ffa726 0%, #ff9800 100%);
    }

    .stat-icon.processing {
        background: linear-gradient(135deg, #42a5f5 0%, #2196f3 100%);
    }

    .stat-icon.completed {
        background: linear-gradient(135deg, #66bb6a 0%, #4caf50 100%);
    }

    .stat-content h3 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: #2c3e50;
    }

    .stat-content p {
        color: #6c757d;
        margin: 0;
        font-weight: 500;
    }

    /* Order Cards */
    .orders-container {
        margin-top: 2rem;
    }

    .order-card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        margin-bottom: 1.5rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .order-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .order-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem;
        border-bottom: 1px solid #dee2e6;
    }

    .order-id {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 0.25rem;
    }

    .order-date {
        color: #6c757d;
        margin: 0;
        font-size: 0.9rem;
    }

    .order-status-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 0.5rem;
    }

    .order-status, .payment-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
    }

    .order-status.status-pending {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .order-status.status-processing {
        background: #cce5ff;
        color: #0066cc;
        border: 1px solid #99d6ff;
    }

    .order-status.status-shipped {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .order-status.status-completed {
        background: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .order-status.status-cancelled {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .payment-status.payment-pending {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .payment-status.payment-paid {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .order-body {
        padding: 1.5rem;
    }

    .detail-title, .pricing-title {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .detail-row, .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 0;
        border-bottom: 1px solid #f8f9fa;
    }

    .detail-row:last-child, .price-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        font-weight: 500;
        color: #6c757d;
        min-width: 120px;
    }

    .detail-value {
        color: #2c3e50;
        font-weight: 500;
    }

    .price-row.discount {
        color: #28a745;
    }

    .price-row.total {
        border-top: 2px solid #dee2e6;
        margin-top: 0.5rem;
        padding-top: 1rem;
        font-size: 1.1rem;
    }

    .order-actions {
        background: #f8f9fa;
        padding: 1rem 1.5rem;
        border-top: 1px solid #dee2e6;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .payment-reminder {
        color: #856404;
        font-size: 0.9rem;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 2rem;
    }

    .empty-state h3 {
        color: #2c3e50;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #6c757d;
        margin-bottom: 2rem;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
        .order-status-wrapper {
            align-items: flex-start;
            margin-top: 1rem;
        }
        
        .stat-card {
            margin-bottom: 1rem;
        }
        
        .order-actions {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
    }
</style>
@endpush
