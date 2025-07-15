<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $order->booking_trx_id ?? 'INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none !important; }
            .container { max-width: none !important; }
        }
        
        .invoice-header {
            border-bottom: 3px solid #007bff;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .company-logo {
            font-size: 28px;
            font-weight: bold;
            color: #007bff;
        }
        
        .invoice-title {
            font-size: 32px;
            font-weight: bold;
            color: #333;
        }
        
        .invoice-details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }
        
        .customer-details {
            background-color: #fff;
            border: 1px solid #dee2e6;
            padding: 20px;
            border-radius: 8px;
        }
        
        .items-table {
            margin: 30px 0;
        }
        
        .items-table th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
            padding: 15px 10px;
        }
        
        .items-table td {
            padding: 12px 10px;
            vertical-align: middle;
        }
        
        .total-section {
            background-color: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        
        .grand-total {
            font-size: 24px;
            font-weight: bold;
            color: #007bff;
        }
        
        .status-badge {
            font-size: 14px;
            padding: 8px 16px;
            border-radius: 20px;
        }
        
        .payment-status-paid {
            background-color: #d1f2eb;
            color: #0c5460;
            border: 1px solid #b2dfdb;
        }
        
        .payment-status-pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
        }
        
        .payment-status-failed {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        .order-status-completed {
            background-color: #d1f2eb;
            color: #0c5460;
        }
        
        .order-status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .order-status-processing {
            background-color: #cce7ff;
            color: #004085;
        }
        
        .footer-info {
            margin-top: 50px;
            padding-top: 30px;
            border-top: 2px solid #dee2e6;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <!-- Print Button -->
        <div class="no-print mb-3">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="fas fa-print"></i> Print Invoice
                </button>
            </div>
        </div>

        <!-- Invoice Header -->
        <div class="invoice-header">
            <div class="row">
                <div class="col-md-6">
                    <div class="company-logo">
                        <i class="fas fa-print"></i> RNR Digital Printing
                    </div>
                    <p class="text-muted mb-0">Professional Printing Services</p>
                </div>
                <div class="col-md-6 text-end">
                    <h1 class="invoice-title">INVOICE</h1>
                    <p class="text-muted mb-0">{{ date('F d, Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Invoice & Order Details -->
        <div class="row">
            <div class="col-md-8">
                <div class="invoice-details">
                    <h5 class="mb-3"><i class="fas fa-file-invoice"></i> Invoice Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Invoice Number:</strong><br>
                            <span class="text-primary">{{ $order->booking_trx_id ?? 'INV-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="col-md-6">
                            <strong>Order Number:</strong><br>
                            <span class="text-primary">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Order Date:</strong><br>
                            {{ $order->created_at->format('F d, Y') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Due Date:</strong><br>
                            {{ $order->created_at->addDays(30)->format('F d, Y') }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="customer-details">
                    <h5 class="mb-3"><i class="fas fa-user"></i> Order Status</h5>
                    <div class="mb-2">
                        <strong>Payment Status:</strong><br>
                        <span class="status-badge payment-status-{{ strtolower($order->payment_status ?? 'pending') }}">
                            {{ ucfirst($order->payment_status ?? 'Pending') }}
                        </span>
                    </div>
                    <div class="mb-2">
                        <strong>Order Status:</strong><br>
                        <span class="status-badge order-status-{{ strtolower($order->status ?? 'pending') }}">
                            {{ ucfirst($order->status ?? 'Pending') }}
                        </span>
                    </div>
                    @if($order->tracking_number)
                    <div class="mt-2">
                        <strong>Tracking Number:</strong><br>
                        <code>{{ $order->tracking_number }}</code>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Customer Information -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="customer-details">
                    <h5 class="mb-3"><i class="fas fa-user-circle"></i> Bill To</h5>
                    <strong>{{ $order->customer->name ?? $order->customer_name ?? 'N/A' }}</strong><br>
                    @if($order->customer && $order->customer->email)
                        <i class="fas fa-envelope text-muted"></i> {{ $order->customer->email }}<br>
                    @elseif($order->customer_email)
                        <i class="fas fa-envelope text-muted"></i> {{ $order->customer_email }}<br>
                    @endif
                    @if($order->customer && $order->customer->phone)
                        <i class="fas fa-phone text-muted"></i> {{ $order->customer->phone }}<br>
                    @elseif($order->customer_phone)
                        <i class="fas fa-phone text-muted"></i> {{ $order->customer_phone }}<br>
                    @endif
                    @if($order->customer && $order->customer->address)
                        <i class="fas fa-map-marker-alt text-muted"></i> {{ $order->customer->address }}
                    @elseif($order->customer_address)
                        <i class="fas fa-map-marker-alt text-muted"></i> {{ $order->customer_address }}
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="customer-details">
                    <h5 class="mb-3"><i class="fas fa-building"></i> From</h5>
                    <strong>RNR Digital Printing</strong><br>
                    <i class="fas fa-envelope text-muted"></i> info@rnrdigitalprinting.com<br>
                    <i class="fas fa-phone text-muted"></i> +62 123 456 789<br>
                    <i class="fas fa-map-marker-alt text-muted"></i> Jakarta, Indonesia<br>
                    <i class="fas fa-globe text-muted"></i> www.rnrdigitalprinting.com
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="items-table">
            <h5 class="mb-3"><i class="fas fa-list"></i> Order Items</h5>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th style="width: 40%">Item Description</th>
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
                                    <strong>{{ $item->product->name ?? $item->product_name ?? 'Custom Service' }}</strong>
                                    @if($item->product && $item->product->description)
                                        <br><small class="text-muted">{{ Str::limit($item->product->description, 100) }}</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->quantity ?? 1 }}</td>
                                <td class="text-end">Rp {{ number_format($item->price ?? $item->unit_price ?? 0, 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format(($item->quantity ?? 1) * ($item->price ?? $item->unit_price ?? 0), 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        @else
                            <!-- Manual/Custom Order -->
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <strong>{{ $order->product_type ?? 'Custom Printing Service' }}</strong>
                                    @if($order->service_type)
                                        <br><small class="text-muted">Service: {{ $order->service_type }}</small>
                                    @endif
                                    @if($order->paper_type)
                                        <br><small class="text-muted">Paper: {{ $order->paper_type }}</small>
                                    @endif
                                    @if($order->size)
                                        <br><small class="text-muted">Size: {{ $order->size }}</small>
                                    @endif
                                    @if($order->finishing)
                                        <br><small class="text-muted">Finishing: {{ $order->finishing }}</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $order->quantity ?? 1 }}</td>
                                <td class="text-end">Rp {{ number_format($order->unit_price ?? 0, 0, ',', '.') }}</td>
                                <td class="text-end">Rp {{ number_format($order->sub_total_amount ?? 0, 0, ',', '.') }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Totals Section -->
        <div class="row">
            <div class="col-md-6">
                @if($order->notes)
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-sticky-note"></i> Order Notes</h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $order->notes }}</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="total-section">
                    <table class="table table-borderless">
                        <tr>
                            <td><strong>Subtotal:</strong></td>
                            <td class="text-end">Rp {{ number_format($order->sub_total_amount ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @if($order->shipping_cost && $order->shipping_cost > 0)
                        <tr>
                            <td><strong>Shipping Cost:</strong></td>
                            <td class="text-end">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        @if($order->tax_amount && $order->tax_amount > 0)
                        <tr>
                            <td><strong>Tax:</strong></td>
                            <td class="text-end">Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        @if($order->discount_amount && $order->discount_amount > 0)
                        <tr>
                            <td><strong>Discount:</strong></td>
                            <td class="text-end text-success">-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                        </tr>
                        @endif
                        @if($order->promo_code)
                        <tr>
                            <td><strong>Promo Code:</strong></td>
                            <td class="text-end"><code>{{ $order->promo_code }}</code></td>
                        </tr>
                        @endif
                        <tr class="border-top">
                            <td class="grand-total">TOTAL AMOUNT:</td>
                            <td class="text-end grand-total">Rp {{ number_format($order->grand_total_amount ?? $order->sub_total_amount ?? 0, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        @if($order->payment_method)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-credit-card"></i> Payment Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <strong>Payment Method:</strong><br>
                                {{ ucfirst($order->payment_method) }}
                            </div>
                            <div class="col-md-4">
                                <strong>Payment Status:</strong><br>
                                <span class="badge bg-{{ $order->is_paid ? 'success' : 'warning' }}">
                                    {{ $order->is_paid ? 'Paid' : 'Unpaid' }}
                                </span>
                            </div>
                            @if($order->shipping_method)
                            <div class="col-md-4">
                                <strong>Shipping Method:</strong><br>
                                {{ ucfirst($order->shipping_method) }}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Footer -->
        <div class="footer-info text-center">
            <p class="mb-1"><strong>Thank you for your business!</strong></p>
            <p class="mb-1">For any questions regarding this invoice, please contact us at <strong>info@rnrdigitalprinting.com</strong></p>
            <p class="mb-0">This is an automatically generated invoice - no signature required.</p>
            <hr>
            <p class="mb-0">© {{ date('Y') }} RNR Digital Printing. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
