@extends('layouts.app')

@section('title', 'Manajemen Customer')

@push('styles')
<style>
    .customer-card {
        transition: transform 0.2s ease-in-out;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .customer-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    
    .customer-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        font-weight: bold;
        margin: 0 auto 15px;
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
    
    .order-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #28a745;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        font-weight: bold;
    }
    
    .customer-stats {
        background: #f8f9fa;
        border-radius: 8px;
        padding: 10px;
        margin: 10px 0;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h3 mb-0">Manajemen Customer</h1>
                    <p class="text-muted">Kelola data customer dan riwayat pesanan</p>
                </div>
                <a href="{{ route('customers.create') }}" class="btn btn-primary">
                    <i class="bi bi-person-plus me-2"></i>Tambah Customer
                </a>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stats-card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-people display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $customers->count() }}</h3>
                            <p class="mb-0">Total Customer</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-person-check display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $customers->filter(function($c) { return $c->orders->count() > 0; })->count() }}</h3>
                            <p class="mb-0">Customer Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-cart-check display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $customers->sum(function($c) { return $c->orders->count(); }) }}</h3>
                            <p class="mb-0">Total Pesanan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-currency-dollar display-4 mb-2"></i>
                            <h3 class="mb-0">Rp {{ number_format($customers->sum(function($c) { return $c->orders->sum('grand_total_amount'); })) }}</h3>
                            <p class="mb-0">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="search-box">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari Customer</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Nama, email, telepon...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Filter</label>
                        <select id="customerFilter" class="form-select">
                            <option value="">Semua Customer</option>
                            <option value="has_orders">Punya Pesanan</option>
                            <option value="no_orders">Belum Pernah Pesan</option>
                            <option value="vip">Customer VIP (>5 pesanan)</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Urutkan</label>
                        <select id="sortBy" class="form-select">
                            <option value="name">Nama A-Z</option>
                            <option value="name_desc">Nama Z-A</option>
                            <option value="orders_count">Jumlah Pesanan</option>
                            <option value="total_spent">Total Pembelian</option>
                            <option value="created_at">Terdaftar Terbaru</option>
                            <option value="last_order">Pesanan Terakhir</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="resetFilter" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise me-1"></i>Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Customers Grid -->
            <div class="row" id="customersGrid">
                @forelse($customers as $customer)
                    <div class="col-lg-4 col-md-6 mb-4 customer-item" 
                         data-name="{{ strtolower($customer->name . ' ' . $customer->email . ' ' . $customer->phone) }}" 
                         data-orders="{{ $customer->orders->count() }}"
                         data-total="{{ $customer->orders->sum('grand_total_amount') }}"
                         data-created="{{ $customer->created_at->format('Y-m-d') }}"
                         data-last-order="{{ $customer->orders->max('created_at') ? \Carbon\Carbon::parse($customer->orders->max('created_at'))->format('Y-m-d') : '' }}">
                        <div class="card customer-card h-100 position-relative">
                            @if($customer->orders->count() > 0)
                                <div class="order-badge">{{ $customer->orders->count() }}</div>
                            @endif
                            
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="customer-avatar">
                                        {{ strtoupper(substr($customer->name, 0, 2)) }}
                                    </div>
                                    <h5 class="card-title mb-1">{{ $customer->name }}</h5>
                                    <p class="text-muted small mb-2">{{ $customer->email }}</p>
                                    @if($customer->orders->count() >= 5)
                                        <span class="badge bg-warning text-dark">VIP Customer</span>
                                    @elseif($customer->orders->count() > 0)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">New</span>
                                    @endif
                                </div>
                                
                                <div class="customer-stats">
                                    <div class="row text-center">
                                        <div class="col-4">
                                            <div class="fw-bold text-primary">{{ $customer->orders->count() }}</div>
                                            <small class="text-muted">Pesanan</small>
                                        </div>
                                        <div class="col-8">
                                            <div class="fw-bold text-success">Rp {{ number_format($customer->orders->sum('grand_total_amount')) }}</div>
                                            <small class="text-muted">Total Pembelian</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-telephone me-2 text-muted"></i>
                                        <small>{{ $customer->phone ?? 'Tidak ada' }}</small>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="bi bi-geo-alt me-2 text-muted"></i>
                                        <small>{{ Str::limit($customer->address ?? 'Alamat belum diisi', 30) }}</small>
                                    </div>
                                    @if($customer->orders->count() > 0)
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-clock me-2 text-muted"></i>
                                            <small>Terakhir pesan: {{ $customer->orders->max('created_at') ? \Carbon\Carbon::parse($customer->orders->max('created_at'))->diffForHumans() : '-' }}</small>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="action-buttons text-center mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="viewCustomer({{ $customer->id }})" 
                                            title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" 
                                            onclick="editCustomer({{ $customer->id }})" 
                                            title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-info" 
                                            onclick="viewOrders({{ $customer->id }})" 
                                            title="Lihat Pesanan">
                                        <i class="bi bi-cart"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteCustomer({{ $customer->id }})" 
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>
                                    Terdaftar: {{ $customer->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-people display-1 text-muted"></i>
                            <h3 class="text-muted mt-3">Belum Ada Customer</h3>
                            <p class="text-muted">Customer akan muncul otomatis saat ada pesanan masuk</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customerModal">
                                <i class="bi bi-person-plus me-2"></i>Tambah Customer Manual
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Customer Modal -->
<div class="modal fade" id="customerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="customerForm">
                @csrf
                <input type="hidden" id="customerId" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customerName" name="name" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="customerEmail" name="email" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">No. Telepon</label>
                                <input type="tel" class="form-control" id="customerPhone" name="phone">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" id="customerAddress" name="address" rows="4" 
                                         placeholder="Alamat lengkap customer"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Catatan</label>
                                <textarea class="form-control" id="customerNotes" name="notes" rows="3" 
                                         placeholder="Catatan tentang customer (opsional)"></textarea>
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

<!-- View Customer Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

<!-- Orders Modal -->
<div class="modal fade" id="ordersModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat Pesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="ordersModalBody">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Search functionality
    $('#searchInput').on('input', function() {
        filterCustomers();
    });
    
    $('#customerFilter, #sortBy').on('change', function() {
        filterCustomers();
    });
    
    $('#resetFilter').on('click', function() {
        $('#searchInput').val('');
        $('#customerFilter').val('');
        $('#sortBy').val('name');
        filterCustomers();
    });
    
    // Form submission
    $('#customerForm').on('submit', function(e) {
        e.preventDefault();
        saveCustomer();
    });
    
    // Reset modal when closed
    $('#customerModal').on('hidden.bs.modal', function() {
        resetForm();
    });
});

function filterCustomers() {
    const search = $('#searchInput').val().toLowerCase();
    const filter = $('#customerFilter').val();
    const sort = $('#sortBy').val();
    
    let items = $('.customer-item').toArray();
    
    // Filter by search and type
    items.forEach(item => {
        const name = $(item).data('name');
        const orders = $(item).data('orders');
        
        let show = true;
        
        if (search && !name.includes(search)) {
            show = false;
        }
        
        if (filter) {
            switch (filter) {
                case 'has_orders':
                    if (orders === 0) show = false;
                    break;
                case 'no_orders':
                    if (orders > 0) show = false;
                    break;
                case 'vip':
                    if (orders < 5) show = false;
                    break;
            }
        }
        
        $(item).toggle(show);
    });
    
    // Sort items
    items = $('.customer-item:visible').toArray();
    
    items.sort((a, b) => {
        const aData = $(a).data();
        const bData = $(b).data();
        
        switch (sort) {
            case 'name':
                return aData.name.localeCompare(bData.name);
            case 'name_desc':
                return bData.name.localeCompare(aData.name);
            case 'orders_count':
                return bData.orders - aData.orders;
            case 'total_spent':
                return bData.total - aData.total;
            case 'created_at':
                return new Date(bData.created) - new Date(aData.created);
            case 'last_order':
                return new Date(bData.lastOrder || 0) - new Date(aData.lastOrder || 0);
            default:
                return 0;
        }
    });
    
    // Re-append sorted items
    const container = $('#customersGrid');
    items.forEach(item => {
        container.append(item);
    });
}

function editCustomer(id) {
    $.get(`/customers/${id}/edit`)
        .done(function(data) {
            $('#modalTitle').text('Edit Customer');
            $('#customerId').val(data.id);
            $('#customerName').val(data.name);
            $('#customerEmail').val(data.email);
            $('#customerPhone').val(data.phone);
            $('#customerAddress').val(data.address);
            $('#customerNotes').val(data.notes);
            $('#customerModal').modal('show');
        })
        .fail(function() {
            showAlert('danger', 'Gagal memuat data customer');
        });
}

function viewCustomer(id) {
    $.get(`/customers/${id}`)
        .done(function(data) {
            $('#viewModalBody').html(data);
            $('#viewModal').modal('show');
        })
        .fail(function() {
            showAlert('danger', 'Gagal memuat detail customer');
        });
}

function viewOrders(id) {
    $.get(`/customers/${id}/orders`)
        .done(function(data) {
            $('#ordersModalBody').html(data);
            $('#ordersModal').modal('show');
        })
        .fail(function() {
            showAlert('danger', 'Gagal memuat riwayat pesanan');
        });
}

function saveCustomer() {
    const form = $('#customerForm');
    const formData = new FormData(form[0]);
    const id = $('#customerId').val();
    const url = id ? `/customers/${id}` : '/customers';
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
        $('#customerModal').modal('hide');
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

function deleteCustomer(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus customer ini?\nData pesanan customer akan tetap ada.')) {
        return;
    }
    
    $.ajax({
        url: `/customers/${id}`,
        type: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    .done(function(response) {
        showAlert('success', response.message);
        setTimeout(() => window.location.reload(), 1000);
    })
    .fail(function() {
        showAlert('danger', 'Gagal menghapus customer');
    });
}

function resetForm() {
    $('#customerForm')[0].reset();
    $('#customerId').val('');
    $('#modalTitle').text('Tambah Customer');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');
}

// View customer function - redirect to show page
function viewCustomer(id) {
    console.log('View customer clicked, ID:', id);
    window.location.href = `/customers/${id}`;
}

// Edit customer function - redirect to edit page
function editCustomer(id) {
    console.log('Edit customer clicked, ID:', id);
    window.location.href = `/customers/${id}/edit`;
}

// View orders function - redirect to orders filtered by customer
function viewOrders(id) {
    console.log('View orders clicked, ID:', id);
    window.location.href = `/orders?customer_id=${id}`;
}

// Delete customer function with confirmation
function deleteCustomer(id) {
    console.log('Delete customer clicked, ID:', id);
    const customerName = $(`.customer-card:has([onclick*="${id}"])`).find('h6').text().trim() || 'customer ini';
    
    if (!confirm(`🗑️ HAPUS CUSTOMER\n\nCustomer: ${customerName}\n\n⚠️ PERINGATAN:\n• Customer akan DIHAPUS PERMANEN\n• Jika ada pesanan, customer TIDAK DAPAT dihapus\n• Tindakan ini TIDAK DAPAT DIBATALKAN\n\nApakah Anda yakin ingin melanjutkan?`)) {
        return;
    }
    
    // Create a form and submit it (more reliable than AJAX for redirects)
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/customers/${id}`;
    
    // Add CSRF token
    const csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = $('meta[name="csrf-token"]').attr('content');
    form.appendChild(csrfToken);
    
    // Add DELETE method
    const methodField = document.createElement('input');
    methodField.type = 'hidden';
    methodField.name = '_method';
    methodField.value = 'DELETE';
    form.appendChild(methodField);
    
    document.body.appendChild(form);
    form.submit();
}

function showAlert(type, message) {
    const alert = $(`
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
            <strong>${type === 'success' ? 'Berhasil!' : 'Error!'}</strong> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `);
    
    $('.container-fluid').prepend(alert);
    
    setTimeout(() => {
        alert.alert('close');
    }, 5000);
}

// Initialize success/error messages
$(document).ready(function() {
    // Auto-hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert-dismissible').alert('close');
    }, 5000);
    
    @if(session('success'))
        showAlert('success', '{{ session('success') }}');
    @endif
    
    @if(session('error'))
        showAlert('danger', '{{ session('error') }}');
    @endif
});
</script>
@endpush
