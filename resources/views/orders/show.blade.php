@extends('layouts.app')

@section('title', 'Order Details #' . str_pad($order->id, 6, '0', STR_PAD_LEFT))

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-0">
                                <i class="fas fa-file-invoice"></i> 
                                Order Details #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
                            </h4>
                            @if($order->booking_trx_id)
                                <small class="opacity-75">Transaction ID: {{ $order->booking_trx_id }}</small>
                            @endif
                        </div>
                        <div class="col-md-6 text-end">
                            <span class="badge fs-6 px-3 py-2 
                                @if($order->status == 'completed') bg-success
                                @elseif($order->status == 'processing') bg-info
                                @elseif($order->status == 'cancelled') bg-danger
                                @else bg-warning text-dark
                                @endif">
                                {{ ucfirst($order->status ?? 'Pending') }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2 justify-content-between align-items-center">
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Orders
                            </a>
                            <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit Order
                            </a>
                            <a href="{{ route('orders.invoice', $order) }}" class="btn btn-info" target="_blank">
                                <i class="fas fa-file-invoice"></i> Generate Invoice
                            </a>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            @if($order->status !== 'completed')
                                <button type="button" class="btn btn-success" onclick="updateOrderStatus({{ $order->id }}, 'completed')">
                                    <i class="fas fa-check"></i> Mark as Completed
                                </button>
                            @endif
                            <button type="button" class="btn btn-danger" onclick="deleteOrder({{ $order->id }})">
                                <i class="fas fa-trash"></i> Delete Order
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- Order Information -->
        <div class="col-lg-8">
            <!-- Order Basic Info -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-info-circle"></i> Order Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Order ID:</td>
                                    <td>#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Order Date:</td>
                                    <td>{{ $order->created_at->format('F d, Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Order Time:</td>
                                    <td>{{ $order->created_at->format('H:i A') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Last Updated:</td>
                                    <td>{{ $order->updated_at->format('F d, Y H:i A') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Order Status:</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->status == 'completed') bg-success
                                            @elseif($order->status == 'processing') bg-info
                                            @elseif($order->status == 'cancelled') bg-danger
                                            @else bg-warning text-dark
                                            @endif">
                                            {{ ucfirst($order->status ?? 'Pending') }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Payment Status:</td>
                                    <td>
                                        <span class="badge 
                                            @if($order->payment_status == 'paid' || $order->is_paid) bg-success
                                            @elseif($order->payment_status == 'failed') bg-danger
                                            @else bg-warning text-dark
                                            @endif">
                                            {{ ucfirst($order->payment_status ?? 'Pending') }}
                                        </span>
                                    </td>
                                </tr>
                                @if($order->payment_method)
                                <tr>
                                    <td class="fw-bold">Payment Method:</td>
                                    <td>{{ ucfirst($order->payment_method) }}</td>
                                </tr>
                                @endif
                                @if($order->tracking_number)
                                <tr>
                                    <td class="fw-bold">Tracking Number:</td>
                                    <td><code>{{ $order->tracking_number }}</code></td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-user"></i> Customer Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td class="fw-bold">Customer Name:</td>
                                    <td>{{ $order->customer->name ?? $order->customer_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Email:</td>
                                    <td>
                                        @if($order->customer && $order->customer->email)
                                            <a href="mailto:{{ $order->customer->email }}">{{ $order->customer->email }}</a>
                                        @elseif($order->customer_email)
                                            <a href="mailto:{{ $order->customer_email }}">{{ $order->customer_email }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Phone Number:</td>
                                    <td>
                                        @if($order->customer && $order->customer->phone)
                                            <a href="tel:{{ $order->customer->phone }}">{{ $order->customer->phone }}</a>
                                        @elseif($order->customer_phone)
                                            <a href="tel:{{ $order->customer_phone }}">{{ $order->customer_phone }}</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                @if($order->customer && $order->customer->address || $order->customer_address)
                                <tr>
                                    <td class="fw-bold">Shipping Address:</td>
                                    <td>{{ $order->customer->address ?? $order->customer_address ?? 'N/A' }}</td>
                                </tr>
                                @endif
                                @if($order->shipping_method)
                                <tr>
                                    <td class="fw-bold">Shipping Method:</td>
                                    <td>{{ ucfirst($order->shipping_method) }}</td>
                                </tr>
                                @endif
                                @if($order->shipping && $order->shipping->cost)
                                <tr>
                                    <td class="fw-bold">Shipping Cost:</td>
                                    <td>Rp {{ number_format($order->shipping->cost, 0, ',', '.') }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-list"></i> Order Items</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead class="table-dark">
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 40%">Product Name</th>
                                    <th style="width: 15%" class="text-center">Quantity</th>
                                    <th style="width: 20%" class="text-end">Unit Price</th>
                                    <th style="width: 20%" class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($order->items && $order->items->count() > 0)
                                    @foreach($order->items as $index => $item)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($item->product && $item->product->photo)
                                                    <img src="{{ asset('storage/' . $item->product->photo) }}" 
                                                         alt="{{ $item->product->name }}" 
                                                         class="rounded me-3" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                                <div>
                                                    <strong>{{ $item->product->name ?? $item->product_name ?? 'Custom Service' }}</strong>
                                                    @if($item->product && $item->product->description)
                                                        <br><small class="text-muted">{{ Str::limit($item->product->description, 100) }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary">{{ $item->quantity ?? 1 }}</span>
                                        </td>
                                        <td class="text-end">Rp {{ number_format($item->price ?? $item->unit_price ?? 0, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format(($item->quantity ?? 1) * ($item->price ?? $item->unit_price ?? 0), 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                @else
                                    <!-- Manual/Custom Order -->
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td>
                                            <div>
                                                <strong>{{ $order->product_type ?? 'Custom Printing Service' }}</strong>
                                                @if($order->service_type)
                                                    <br><small class="text-muted"><i class="fas fa-tag"></i> Service: {{ $order->service_type }}</small>
                                                @endif
                                                @if($order->paper_type)
                                                    <br><small class="text-muted"><i class="fas fa-file"></i> Paper: {{ $order->paper_type }}</small>
                                                @endif
                                                @if($order->size)
                                                    <br><small class="text-muted"><i class="fas fa-ruler"></i> Size: {{ $order->size }}</small>
                                                @endif
                                                @if($order->finishing)
                                                    <br><small class="text-muted"><i class="fas fa-magic"></i> Finishing: {{ $order->finishing }}</small>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-primary">{{ $order->quantity ?? 1 }}</span>
                                        </td>
                                        <td class="text-end">Rp {{ number_format($order->unit_price ?? 0, 0, ',', '.') }}</td>
                                        <td class="text-end fw-bold">Rp {{ number_format($order->sub_total_amount ?? 0, 0, ',', '.') }}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Order Notes -->
            @if($order->notes)
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0"><i class="fas fa-sticky-note"></i> Order Notes & Instructions</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-info border-0">
                        <i class="fas fa-info-circle"></i> {{ $order->notes }}
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Order Summary -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-calculator"></i> Order Summary</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td class="fw-bold">Subtotal:</td>
                            <td class="text-end">Rp {{ number_format($order->sub_total_amount ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @if($order->shipping_cost && $order->shipping_cost > 0)
                        <tr>
                            <td class="fw-bold">Shipping Cost:</td>
                            <td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        @if($order->tax_amount && $order->tax_amount > 0)
                        <tr>
                            <td class="fw-bold">Tax:</td>
                            <td class="text-end">Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        @if($order->discount_amount && $order->discount_amount > 0)
                        <tr>
                            <td class="fw-bold">Discount:</td>
                            <td class="text-end text-success">-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        @if($order->promo_code)
                        <tr>
                            <td class="fw-bold">Promo Code:</td>
                            <td class="text-end"><code>{{ $order->promo_code }}</code></td>
                        </tr>
                        @endif
                        <tr class="border-top border-2">
                            <td class="fw-bold fs-5 text-primary">Total Amount:</td>
                            <td class="text-end fw-bold fs-5 text-primary">Rp {{ number_format($order->grand_total_amount ?? $order->sub_total_amount ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="fas fa-bolt"></i> Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        @if($order->status !== 'completed')
                            <button type="button" class="btn btn-success" onclick="updateOrderStatus({{ $order->id }}, 'completed')">
                                <i class="fas fa-check"></i> Mark as Completed
                            </button>
                        @endif
                        @if($order->status !== 'processing')
                            <button type="button" class="btn btn-info" onclick="updateOrderStatus({{ $order->id }}, 'processing')">
                                <i class="fas fa-cog"></i> Mark as Processing
                            </button>
                        @endif
                        @if($order->status !== 'cancelled')
                            <button type="button" class="btn btn-outline-danger" onclick="updateOrderStatus({{ $order->id }}, 'cancelled')">
                                <i class="fas fa-times"></i> Cancel Order
                            </button>
                        @endif
                        <hr>
                        <a href="{{ route('orders.invoice', $order) }}" class="btn btn-outline-primary" target="_blank">
                            <i class="fas fa-download"></i> Download Invoice
                        </a>
                        <button type="button" class="btn btn-outline-secondary" onclick="printOrder({{ $order->id }})">
                            <i class="fas fa-print"></i> Print Order Details
                        </button>
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="fas fa-history"></i> Order Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Order Created</h6>
                                <p class="timeline-text">{{ $order->created_at->format('F d, Y H:i A') }}</p>
                            </div>
                        </div>
                        @if($order->updated_at != $order->created_at)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Last Updated</h6>
                                <p class="timeline-text">{{ $order->updated_at->format('F d, Y H:i A') }}</p>
                            </div>
                        </div>
                        @endif
                        @if($order->status == 'completed')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="timeline-title">Order Completed</h6>
                                <p class="timeline-text">Status: Completed</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Timeline -->
<style>
.timeline {
    position: relative;
    padding: 20px 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
    padding-left: 50px;
}

.timeline-marker {
    position: absolute;
    left: 8px;
    top: 0;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    border: 2px solid #fff;
}

.timeline-title {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
}

.timeline-text {
    font-size: 12px;
    color: #6c757d;
    margin: 0;
}
</style>

<!-- JavaScript for Actions -->
<script>
function updateOrderStatus(orderId, status) {
    if (confirm(`Are you sure you want to update the order status to "${status}"?`)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/orders/${orderId}/status`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'PATCH';
        
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        
        form.appendChild(csrfToken);
        form.appendChild(methodInput);
        form.appendChild(statusInput);
        document.body.appendChild(form);
        form.submit();
    }
}

function deleteOrder(orderId) {
    if (confirm('Are you sure you want to delete this order? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/orders/${orderId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfToken);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

function printOrder(orderId) {
    window.open(`/orders/${orderId}/invoice`, '_blank');
}
</script>
@endsection
