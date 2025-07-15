@extends('layouts.app')

@section('title', 'Kategori Produk')

@push('styles')
<style>
    .category-card {
        transition: transform 0.2s ease-in-out;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .category-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    }
    
    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
    }
    
    .action-buttons .btn {
        margin: 0 2px;
        min-width: 40px;
    }
    
    .category-icon {
        width: 60px;
        height: 60px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #6c757d;
        margin: 0 auto 15px;
    }
    
    .search-box {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 20px;
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
                    <h1 class="h3 mb-0">Manajemen Kategori</h1>
                    <p class="text-muted">Kelola kategori produk printing</p>
                </div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
                </button>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card stats-card h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-grid display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $categories->count() }}</h3>
                            <p class="mb-0">Total Kategori</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-check-circle display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $categories->where('is_active', true)->count() }}</h3>
                            <p class="mb-0">Kategori Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-pause-circle display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $categories->where('is_active', false)->count() }}</h3>
                            <p class="mb-0">Kategori Non-Aktif</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white h-100">
                        <div class="card-body text-center">
                            <i class="bi bi-box display-4 mb-2"></i>
                            <h3 class="mb-0">{{ $categories->sum(function($cat) { return $cat->products->count(); }) }}</h3>
                            <p class="mb-0">Total Produk</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter -->
            <div class="search-box">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Cari Kategori</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-search"></i>
                            </span>
                            <input type="text" id="searchInput" class="form-control" placeholder="Nama kategori...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select id="statusFilter" class="form-select">
                            <option value="">Semua Status</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Urutkan</label>
                        <select id="sortBy" class="form-select">
                            <option value="name">Nama A-Z</option>
                            <option value="name_desc">Nama Z-A</option>
                            <option value="created_at">Terbaru</option>
                            <option value="created_at_desc">Terlama</option>
                            <option value="products_count">Jumlah Produk</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" id="resetFilter" class="btn btn-outline-secondary w-100">
                            <i class="bi bi-arrow-clockwise me-1"></i>Reset
                        </button>
                    </div>
                </div>
            </div>

            <!-- Categories Grid -->
            <div class="row" id="categoriesGrid">
                @forelse($categories as $category)
                    <div class="col-lg-4 col-md-6 mb-4 category-item" 
                         data-name="{{ strtolower($category->name) }}" 
                         data-status="{{ $category->is_active ? '1' : '0' }}"
                         data-created="{{ $category->created_at->format('Y-m-d') }}"
                         data-products="{{ $category->products->count() }}">
                        <div class="card category-card h-100">
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="category-icon">
                                        <i class="bi bi-{{ $category->icon ?? 'grid-3x3-gap' }}"></i>
                                    </div>
                                    <h5 class="card-title mb-2">{{ $category->name }}</h5>
                                    <span class="badge bg-{{ $category->is_active ? 'success' : 'secondary' }} mb-2">
                                        {{ $category->is_active ? 'Aktif' : 'Non-Aktif' }}
                                    </span>
                                </div>
                                
                                @if($category->description)
                                    <p class="card-text text-muted small">{{ Str::limit($category->description, 100) }}</p>
                                @endif
                                
                                <div class="row text-center mb-3">
                                    <div class="col-6">
                                        <div class="fw-bold text-primary">{{ $category->products->count() }}</div>
                                        <small class="text-muted">Produk</small>
                                    </div>
                                    <div class="col-6">
                                        <div class="fw-bold text-success">{{ $category->products->where('is_active', true)->count() }}</div>
                                        <small class="text-muted">Aktif</small>
                                    </div>
                                </div>
                                
                                <div class="action-buttons text-center">
                                    <button type="button" class="btn btn-sm btn-outline-primary" 
                                            onclick="viewCategory({{ $category->id }})" 
                                            title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning" 
                                            onclick="editCategory({{ $category->id }})" 
                                            title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-{{ $category->is_active ? 'secondary' : 'success' }}" 
                                            onclick="toggleStatus({{ $category->id }}, {{ $category->is_active ? 'false' : 'true' }})" 
                                            title="{{ $category->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                        <i class="bi bi-{{ $category->is_active ? 'pause' : 'play' }}"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                            onclick="deleteCategory({{ $category->id }})" 
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>
                                    Dibuat: {{ $category->created_at->format('d M Y') }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="bi bi-grid display-1 text-muted"></i>
                            <h3 class="text-muted mt-3">Belum Ada Kategori</h3>
                            <p class="text-muted">Mulai dengan menambahkan kategori produk pertama</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                                <i class="bi bi-plus-lg me-2"></i>Tambah Kategori
                            </button>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle">Tambah Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="categoryForm">
                @csrf
                <input type="hidden" id="categoryId" name="id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="categoryName" name="name" required>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="categoryDescription" name="description" rows="4" 
                                         placeholder="Deskripsi kategori (opsional)"></textarea>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Slug URL</label>
                                <input type="text" class="form-control" id="categorySlug" name="slug" readonly>
                                <div class="form-text">URL akan dibuat otomatis dari nama kategori</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Icon</label>
                                <select class="form-select" id="categoryIcon" name="icon">
                                    <option value="">Pilih Icon</option>
                                    <option value="printer">🖨️ Printer</option>
                                    <option value="palette">🎨 Palette</option>
                                    <option value="image">🖼️ Image</option>
                                    <option value="tags">🏷️ Tags</option>
                                    <option value="box">📦 Box</option>
                                    <option value="flag">🚩 Flag</option>
                                    <option value="grid-3x3-gap">⚏ Grid</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="categoryStatus" name="is_active" checked>
                                    <label class="form-check-label" for="categoryStatus">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label class="form-label">Urutan</label>
                                <input type="number" class="form-control" id="categoryOrder" name="sort_order" value="0" min="0">
                                <div class="form-text">Urutan tampil (0 = paling atas)</div>
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

<!-- View Category Modal -->
<div class="modal fade" id="viewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Kategori</h5>
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
    // Auto-generate slug from name
    $('#categoryName').on('input', function() {
        const name = $(this).val();
        const slug = name.toLowerCase()
            .replace(/[^a-z0-9 -]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
        $('#categorySlug').val(slug);
    });
    
    // Search functionality
    $('#searchInput').on('input', function() {
        filterCategories();
    });
    
    $('#statusFilter, #sortBy').on('change', function() {
        filterCategories();
    });
    
    $('#resetFilter').on('click', function() {
        $('#searchInput').val('');
        $('#statusFilter').val('');
        $('#sortBy').val('name');
        filterCategories();
    });
    
    // Form submission
    $('#categoryForm').on('submit', function(e) {
        e.preventDefault();
        saveCategory();
    });
    
    // Reset modal when closed
    $('#categoryModal').on('hidden.bs.modal', function() {
        resetForm();
    });
});

function filterCategories() {
    const search = $('#searchInput').val().toLowerCase();
    const status = $('#statusFilter').val();
    const sort = $('#sortBy').val();
    
    let items = $('.category-item').toArray();
    
    // Filter by search
    items.forEach(item => {
        const name = $(item).data('name');
        const itemStatus = $(item).data('status').toString();
        
        let show = true;
        
        if (search && !name.includes(search)) {
            show = false;
        }
        
        if (status && itemStatus !== status) {
            show = false;
        }
        
        $(item).toggle(show);
    });
    
    // Sort items
    items = $('.category-item:visible').toArray();
    
    items.sort((a, b) => {
        const aData = $(a).data();
        const bData = $(b).data();
        
        switch (sort) {
            case 'name':
                return aData.name.localeCompare(bData.name);
            case 'name_desc':
                return bData.name.localeCompare(aData.name);
            case 'created_at':
                return new Date(bData.created) - new Date(aData.created);
            case 'created_at_desc':
                return new Date(aData.created) - new Date(bData.created);
            case 'products_count':
                return bData.products - aData.products;
            default:
                return 0;
        }
    });
    
    // Re-append sorted items
    const container = $('#categoriesGrid');
    items.forEach(item => {
        container.append(item);
    });
}

function editCategory(id) {
    $.get(`/categories/${id}/edit`)
        .done(function(data) {
            $('#modalTitle').text('Edit Kategori');
            $('#categoryId').val(data.id);
            $('#categoryName').val(data.name);
            $('#categoryDescription').val(data.description);
            $('#categorySlug').val(data.slug);
            $('#categoryIcon').val(data.icon);
            $('#categoryStatus').prop('checked', data.is_active);
            $('#categoryOrder').val(data.sort_order || 0);
            $('#categoryModal').modal('show');
        })
        .fail(function() {
            showAlert('danger', 'Gagal memuat data kategori');
        });
}

function viewCategory(id) {
    $.get(`/categories/${id}`)
        .done(function(data) {
            $('#viewModalBody').html(data);
            $('#viewModal').modal('show');
        })
        .fail(function() {
            showAlert('danger', 'Gagal memuat detail kategori');
        });
}

function saveCategory() {
    const form = $('#categoryForm');
    const formData = new FormData(form[0]);
    const id = $('#categoryId').val();
    const url = id ? `/categories/${id}` : '/categories';
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
        $('#categoryModal').modal('hide');
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

function toggleStatus(id, status) {
    const action = status ? 'mengaktifkan' : 'menonaktifkan';
    
    if (!confirm(`Apakah Anda yakin ingin ${action} kategori ini?`)) {
        return;
    }
    
    $.ajax({
        url: `/categories/${id}`,
        type: 'PUT',
        data: {
            is_active: status,
            _token: $('meta[name="csrf-token"]').attr('content')
        }
    })
    .done(function(response) {
        showAlert('success', response.message);
        setTimeout(() => window.location.reload(), 1000);
    })
    .fail(function() {
        showAlert('danger', 'Gagal mengubah status kategori');
    });
}

function deleteCategory(id) {
    if (!confirm('Apakah Anda yakin ingin menghapus kategori ini?\nProduk dalam kategori ini akan tetap ada tetapi tidak memiliki kategori.')) {
        return;
    }
    
    $.ajax({
        url: `/categories/${id}`,
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
        showAlert('danger', 'Gagal menghapus kategori');
    });
}

function resetForm() {
    $('#categoryForm')[0].reset();
    $('#categoryId').val('');
    $('#modalTitle').text('Tambah Kategori');
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');
    $('#categoryStatus').prop('checked', true);
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
