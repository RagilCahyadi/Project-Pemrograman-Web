@extends('layouts.app')

@section('title', 'Manajemen Pesanan')

@push('styles')
<style>
    .order-card {
        transition: transform 0.2s ease-in-out;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        border-left: 4px solid transparent;
    }
    
    .order-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    
    .order-card.status-pending {
        border-left-color: #ffc107;
    }
    
    .order-card.status-processing {
        border-left-color: #17a2b8;
    }
    
    .order-card.status-completed {
        border-left-color: #28a745;
    }
    
    .order-card.status-cancelled {
        border-left-color: #dc3545;
    }
    
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
    }
    
    .search-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
    }
    
    .action-buttons .btn {
        margin: 0 2px;
        min-width: 40px;
    }
    
    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .order-number {
        font-family: 'Courier New', monospace;
        font-weight: bold;
        color: #495057;
    }
    
    .order-items {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
        margin: 10px 0;
    }
    
    .status-timeline {
        display: flex;
        justify-content: space-between;
        margin: 15px 0;
        position: relative;
    }
    
    .status-step {
        flex: 1;
        text-align: center;
        position: relative;
        z-index: 2;
    }
    
    .status-step::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: #e9ecef;
        z-index: -1;
    }
    
    .status-step.active::before {
        background: #28a745;
    }
    
    .status-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        color: #6c757d;
    }
    
    .status-step.active .status-icon {
        background: #28a745;
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Manajemen Pesanan</h1>
                    <p class="text-muted">Kelola pesanan dan status pengerjaan</p>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-primary me-2" onclick="exportOrders()">
                        <i class="bi bi-download me-2"></i>Export
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal">
                        <i class="bi bi-plus-lg me-2"></i>Tambah Pesanan
                    </button>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stats-card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-cart display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $orders->count() }}</h3>
                            <p class="mb-0">Total Pesanan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-clock display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $orders->where('status', 'pending')->count() }}</h3>
                            <p class="mb-0">Menunggu</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-gear display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $orders->where('status', 'processing')->count() }}</h3>
                            <p class="mb-0">Diproses</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-check-circle display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $orders->where('status', 'completed')->count() }}</h3>
                            <p class="mb-0">Selesai</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="search-box">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Cari Pesanan</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Nomor pesanan, customer...">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select id="statusFilter" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="pending">Menunggu</option>
                            <option value="processing">Diproses</option>
                            <option value="completed">Selesai</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Periode</label>
                        <select id="periodFilter" class="form-select">
                            <option value="">Semua Periode</option>
                            <option value="today">Hari Ini</option>
                            <option value="week">Minggu Ini</option>
                            <option value="month">Bulan Ini</option>
                            <option value="year">Tahun Ini</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Urutkan</label>
                        <select id="sortBy" class="form-select">
                            <option value="created_at_desc">Terbaru</option>
                            <option value="created_at">Terlama</option>
                            <option value="total_amount_desc">Nilai Tertinggi</option>
                            <option value="total_amount">Nilai Terendah</option>
                            <option value="order_number">Nomor Pesanan</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="resetFilter" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise me-1"></i>Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="row" id="ordersGrid">
                @forelse($orders as $order)
                    <div class="col-lg-6 mb-4 order-item" 
                         data-search="{{ strtolower($order->booking_trx_id . ' ' . ($order->customer ? $order->customer->name : $order->customer_name)) }}" 
                         data-status="{{ $order->status }}"
                         data-created="{{ $order->created_at->format('Y-m-d') }}"
                         data-amount="{{ $order->grand_total_amount }}">
                        <div class="card order-card status-{{ $order->status }} h-100">
                            <div class="card-body">
                                <div class="order-header">
                                    <div>
                                        <h6 class="order-number mb-1">#{{ $order->booking_trx_id ?? 'ORD-' . str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</h6>
                                        <small class="text-muted">{{ $order->created_at->format('d M Y H:i') }}</small>
                                    </div>
                                    <span class="badge bg-{{ $order->status === 'pending' ? 'warning' : ($order->status === 'processing' ? 'info' : ($order->status === 'completed' ? 'success' : 'danger')) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>{{ $order->customer ? $order->customer->name : $order->customer_name }}</strong>
                                    <div class="small text-muted">
                                        <i class="bi bi-envelope me-1"></i>{{ $order->customer ? $order->customer->email : $order->customer_email }}
                                        @if($order->customer ? $order->customer->phone : $order->customer_phone)
                                            <br><i class="bi bi-telephone me-1"></i>{{ $order->customer ? $order->customer->phone : $order->customer_phone }}
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="order-items">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="small">
                                            @if($order->items && $order->items->count() > 0)
                                                Items ({{ $order->items->count() }})
                                            @else
                                                Service Order
                                            @endif
                                        </strong>
                                        <strong class="text-success">Rp {{ number_format($order->grand_total_amount ?? 0) }}</strong>
                                    </div>
                                    
                                    @if($order->items && $order->items->count() > 0)
                                        @foreach($order->items->take(2) as $item)
                                            <div class="d-flex justify-content-between small">
                                                <span>{{ $item->product->name ?? 'Custom Service' }}</span>
                                                <span>{{ $item->quantity }}x Rp {{ number_format($item->price) }}</span>
                                            </div>
                                        @endforeach
                                        @if($order->items->count() > 2)
                                            <div class="small text-muted">+{{ $order->items->count() - 2 }} item lainnya</div>
                                        @endif
                                    @else
                                        {{-- Show service details for service-based orders --}}
                                        <div class="d-flex justify-content-between small">
                                            <span>
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
                                            <span>{{ $order->quantity ?? 1 }}x {{ $order->paper_type ? ucfirst(str_replace('_', ' ', $order->paper_type)) : 'Item' }}</span>
                                        </div>
                                        @if($order->size)
                                            <div class="small text-muted">Size: {{ $order->size }}</div>
                                        @endif
                                        @if($order->finishing)
                                            <div class="small text-muted">Finishing: {{ ucfirst(str_replace('_', ' ', $order->finishing)) }}</div>
                                        @endif
                                    @endif
                                </div>
                                
                                <!-- Status Timeline -->
                                <div class="status-timeline">
                                    <div class="status-step {{ in_array($order->status, ['pending', 'processing', 'completed']) ? 'active' : '' }}">
                                        <div class="status-icon">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <small>Pending</small>
                                    </div>
                                    <div class="status-step {{ in_array($order->status, ['processing', 'completed']) ? 'active' : '' }}">
                                        <div class="status-icon">
                                            <i class="bi bi-gear"></i>
                                        </div>
                                        <small>Processing</small>
                                    </div>
                                    <div class="status-step {{ $order->status === 'completed' ? 'active' : '' }}">
                                        <div class="status-icon">
                                            <i class="bi bi-check"></i>
                                        </div>
                                        <small>Completed</small>
                                    </div>
                                </div>
                                
                                @if($order->notes)
                                    <div class="mt-2">
                                        <small class="text-muted">
                                            <i class="bi bi-sticky me-1"></i>
                                            {{ Str::limit($order->notes, 80) }}
                                        </small>
                                    </div>
                                @endif
                                
                                <div class="action-buttons text-center mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="viewOrder({{ $order->id }})" 
                                            title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" 
                                            onclick="editOrder({{ $order->id }})" 
                                            title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-info dropdown-toggle" 
                                                data-bs-toggle="dropdown" title="Update Status">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'pending')">
                                                <i class="bi bi-clock text-warning me-2"></i>Pending
                                            </a></li>
                                            <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'processing')">
                                                <i class="bi bi-gear text-info me-2"></i>Processing
                                            </a></li>
                                            <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'completed')">
                                                <i class="bi bi-check-circle text-success me-2"></i>Completed
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="#" onclick="updateStatus({{ $order->id }}, 'cancelled')">
                                                <i class="bi bi-x-circle text-danger me-2"></i>Cancel
                                            </a></li>
                                        </ul>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-success" 
                                            onclick="printOrder({{ $order->id }})" 
                                            title="Print Invoice">
                                        <i class="bi bi-printer"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteOrder({{ $order->id }})" 
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-cart display-1 text-muted"></i>
                            <h3 class="text-muted mt-3">Belum Ada Pesanan</h3>
                            <p class="text-muted">Pesanan akan muncul di sini ketika customer melakukan pemesanan</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderModal">
                                <i class="bi bi-plus-lg me-2"></i>Tambah Pesanan Manual
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Order Modal -->
<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="orderForm">
                @csrf
                <input type="hidden" id="orderId" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Customer <span class="text-danger">*</span></label>
                                <select class="form-select" id="customerId" name="customer_id" required>
                                    <option value="">Pilih Customer</option>
                                    @foreach($customers ?? [] as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} ({{ $customer->email }})</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Nomor Pesanan</label>
                                <input type="text" class="form-control" id="orderNumber" name="order_number" readonly>
                                <div class="form-text">Akan dibuat otomatis</div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" id="orderStatus" name="status">
                                    <option value="pending">Pending</option>
                                    <option value="processing">Processing</option>
                                    <option value="completed">Completed</option>
                                    <option value="cancelled">Cancelled</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Total Amount</label>
                                <input type="number" class="form-control" id="totalAmount" name="total_amount" min="0" step="0.01">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Shipping Address</label>
                                <textarea class="form-control" id="shippingAddress" name="shipping_address" rows="3"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select" id="paymentMethod" name="payment_method">
                                    <option value="transfer">Transfer Bank</option>
                                    <option value="ovo">OVO</option>
                                    <option value="gopay">GoPay</option>
                                    <option value="dana">DANA</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control" id="orderNotes" name="notes" rows="3" 
                                         placeholder="Catatan pesanan, instruksi khusus, dll..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <span class="spinner-border spinner-border-sm me-2 d-none"></span>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Search and filter functionality
    $('#searchInput').on('input', function() {
        filterOrders();
    });
    
    $('#statusFilter, #periodFilter, #sortBy').on('change', function() {
        filterOrders();
    });
    
    $('#resetFilter').on('click', function() {
        $('#searchInput').val('');
        $('#statusFilter').val('');
        $('#periodFilter').val('');
        $('#sortBy').val('created_at_desc');
        filterOrders();
    });
    
    // Form submission
    $('#orderForm').on('submit', function(e) {
        e.preventDefault();
        saveOrder();
    });
    
    // Reset modal when closed
    $('#orderModal').on('hidden.bs.modal', function() {
        resetForm();
    });
});

function filterOrders() {
    const search = $('#searchInput').val().toLowerCase();
    const status = $('#statusFilter').val();
    const period = $('#periodFilter').val();
    const sort = $('#sortBy').val();
    
    let items = $('.order-item').toArray();
    
    // Filter by search, status, and period
    items.forEach(item => {
        const searchText = $(item).data('search');
        const itemStatus = $(item).data('status');
        const createdDate = new Date($(item).data('created'));
        const now = new Date();
        
        let show = true;
        
        if (search && !searchText.includes(search)) {
            show = false;
        }
        
        if (status && itemStatus !== status) {
            show = false;
        }
        
        if (period) {
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
            const weekStart = new Date(today.getTime() - (today.getDay() * 24 * 60 * 60 * 1000));
            const monthStart = new Date(now.getFullYear(), now.getMonth(), 1);
            const yearStart = new Date(now.getFullYear(), 0, 1);
            
            switch (period) {
                case 'today':
                    if (createdDate < today) show = false;
                    break;
                case 'week':
                    if (createdDate < weekStart) show = false;
                    break;
                case 'month':
                    if (createdDate < monthStart) show = false;
                    break;
                case 'year':
                    if (createdDate < yearStart) show = false;
                    break;
            }
        }
        
        $(item).toggle(show);
    });
    
    // Sort items
    items = $('.order-item:visible').toArray();
    
    items.sort((a, b) => {
        const aData = $(a).data();
        const bData = $(b).data();
        
        switch (sort) {
            case 'created_at':
                return new Date(aData.created) - new Date(bData.created);
            case 'created_at_desc':
                return new Date(bData.created) - new Date(aData.created);
            case 'total_amount':
                return aData.amount - bData.amount;
            case 'total_amount_desc':
                return bData.amount - aData.amount;
            case 'order_number':
                return aData.search.localeCompare(bData.search);
            default:
                return 0;
        }
    });
    
    // Re-append sorted items
    const container = $('#ordersGrid');
    items.forEach(item => {
        container.append(item);
    });
}

function editOrder(id) {
    window.location.href = `/orders/${id}/edit`;
}

function viewOrder(id) {
    window.location.href = `/orders/${id}`;
}

function updateStatus(id, status) {
    const statusNames = {
        'pending': 'Pending',
        'processing': 'Processing',
        'completed': 'Completed',
        'cancelled': 'Cancelled'
    };
    
    if (!confirm(`Apakah Anda yakin ingin mengubah status pesanan menjadi ${statusNames[status]}?`)) {
        return;
    }
    
    // Create and submit a form
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/orders/${id}/status`;
    form.style.display = 'none';
    
    // Add CSRF token
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.appendChild(csrfInput);
    
    // Add method spoofing for PATCH
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'PATCH';
    form.appendChild(methodInput);
    
    // Add status data
    const statusInput = document.createElement('input');
    statusInput.type = 'hidden';
    statusInput.name = 'status';
    statusInput.value = status;
    form.appendChild(statusInput);
    
    // Add form to body and submit
    document.body.appendChild(form);
    form.submit();
}

function printOrder(id) {
    window.open(`/orders/${id}/invoice`, '_blank');
}

function exportOrders() {
    window.open('/orders/export', '_blank');
}

function saveOrder() {
    const form = $('#orderForm');
    const formData = new FormData(form[0]);
    const id = $('#orderId').val();
    const url = id ? `/orders/${id}` : '/orders';
    const method = id ? 'PUT' : 'POST';
    
    if (method === 'PUT') {
        formData.append('_method', 'PUT');
    }
    
    $('#submitBtn').prop('disabled', true)
        .find('.spinner-border').removeClass('d-none');
    
    $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .done(function(response) {
        showAlert('success', response.message);
        $('#orderModal').modal('hide');
        setTimeout(() => window.location.reload(), 1000);
    })
    .fail(function(xhr) {
        const errors = xhr.responseJSON?.errors || {};
        
        // Clear previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').text('');
        
        // Show field errors
        Object.keys(errors).forEach(field => {
            const input = $(`[name="${field}"]`);
            input.addClass('is-invalid');
            input.siblings('.invalid-feedback').text(errors[field][0]);
        });
        
        showAlert('danger', xhr.responseJSON?.message || 'Terjadi kesalahan');
    })
    .always(function() {
        $('#submitBtn').prop('disabled', false)
            .find('.spinner-border').addClass('d-none');
    });
}

function deleteOrder(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus pesanan ini?\nTindakan ini tidak dapat dibatalkan.')) {
        return;
    }
    
    // Create and submit a form instead of using AJAX
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/orders/${id}`;
    form.style.display = 'none';
    
    // Add CSRF token
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    form.appendChild(csrfInput);
    
    // Add method spoofing for DELETE
    const methodInput = document.createElement('input');
    methodInput.type = 'hidden';
    methodInput.name = '_method';
    methodInput.value = 'DELETE';
    form.appendChild(methodInput);
    
    // Add form to body and submit
    document.body.appendChild(form);
    form.submit();
}

function resetForm() {
    $('#orderForm')[0].reset();
    $('#orderId').val('');
    $('#modalTitle').text('Tambah Pesanan');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');
}

function showAlert(type, message) {
    const alert = $(`
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `);
    
    $('.container-fluid').prepend(alert);
    
    setTimeout(() => {
        alert.remove();
    }, 5000);
}
</script>
@endpush
