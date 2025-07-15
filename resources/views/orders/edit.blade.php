@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Edit Pesanan</h1>
                    <p class="text-muted">Order #{{ $order->booking_trx_id ?? 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div>
                    <a href="{{ route('orders.show', $order) }}" class="btn btn-outline-info me-2">
                        <i class="bi bi-eye me-2"></i>Lihat Detail
                    </a>
                    <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>

            <!-- Edit Form -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('orders.update', $order) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Customer <span class="text-danger">*</span></label>
                                            <select class="form-select @error('customer_id') is-invalid @enderror" name="customer_id" required>
                                                <option value="">Pilih Customer</option>
                                                @foreach($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>
                                                        {{ $customer->name }} ({{ $customer->email }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select class="form-select @error('status') is-invalid @enderror" name="status" required>
                                                <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ old('status', $order->status) == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="completed" {{ old('status', $order->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Shipping Method</label>
                                            <select class="form-select @error('shipping_id') is-invalid @enderror" name="shipping_id">
                                                <option value="">Pilih Metode Pengiriman</option>
                                                @foreach($shippings as $shipping)
                                                    <option value="{{ $shipping->id }}" {{ old('shipping_id', $order->shipping_id) == $shipping->id ? 'selected' : '' }}>
                                                        {{ $shipping->name }} - Rp {{ number_format($shipping->price) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('shipping_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Promo Code</label>
                                            <select class="form-select @error('promo_code_id') is-invalid @enderror" name="promo_code_id">
                                                <option value="">Tanpa Promo</option>
                                                @foreach($promoCodes as $promo)
                                                    <option value="{{ $promo->id }}" {{ old('promo_code_id', $order->promo_code_id) == $promo->id ? 'selected' : '' }}>
                                                        {{ $promo->code }} ({{ $promo->discount_amount }}% off)
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('promo_code_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Payment Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_paid" id="is_paid" 
                                               {{ old('is_paid', $order->is_paid) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_paid">
                                            Pesanan sudah dibayar
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tracking Number</label>
                                    <input type="text" class="form-control @error('tracking_number') is-invalid @enderror" 
                                           name="tracking_number" value="{{ old('tracking_number', $order->tracking_number) }}"
                                           placeholder="Masukkan nomor resi pengiriman">
                                    @error('tracking_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Catatan</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror" name="notes" rows="3" 
                                             placeholder="Catatan pesanan, instruksi khusus, dll...">{{ old('notes', $order->notes) }}</textarea>
                                    @error('notes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Batal</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>Update Pesanan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Order Summary -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Ringkasan Pesanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Customer:</strong><br>
                                {{ $order->customer ? $order->customer->name : $order->customer_name }}
                                <br><small class="text-muted">{{ $order->customer ? $order->customer->email : $order->customer_email }}</small>
                            </div>

                            <div class="mb-3">
                                <strong>Order Date:</strong><br>
                                {{ $order->created_at->format('d M Y H:i') }}
                            </div>

                            @if($order->items && $order->items->count() > 0)
                                <div class="mb-3">
                                    <strong>Items:</strong><br>
                                    @foreach($order->items as $item)
                                        <div class="d-flex justify-content-between small">
                                            <span>{{ $item->product->name ?? 'Custom Item' }}</span>
                                            <span>{{ $item->quantity }}x</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>Total:</strong>
                                <strong class="text-success">Rp {{ number_format($order->grand_total_amount ?? 0) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
