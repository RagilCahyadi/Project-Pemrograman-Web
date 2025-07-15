@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">
                        <i class="bi bi-plus-circle text-primary me-2"></i>
                        Tambah Produk Baru
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Tambah Baru</li>
                        </ol>
                    </nav>
                </div>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>
            
            <!-- Form -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                <div class="row">
                    <!-- Main Form -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Informasi Produk</h5>
                            </div>
                            <div class="card-body">
                                <!-- Product Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label fw-semibold">
                                        Nama Produk <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           value="{{ old('name') }}" 
                                           placeholder="Masukkan nama produk..."
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label fw-semibold">
                                        Deskripsi Produk <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="description" 
                                              id="description" 
                                              class="form-control @error('description') is-invalid @enderror" 
                                              rows="4" 
                                              placeholder="Jelaskan detail produk, spesifikasi, keunggulan..."
                                              required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">
                                        <i class="bi bi-info-circle me-1"></i>
                                        Deskripsi yang baik akan membantu pelanggan memahami produk Anda.
                                    </div>
                                </div>
                                
                                <!-- Category and Price Row -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="category_id" class="form-label fw-semibold">
                                                Kategori <span class="text-danger">*</span>
                                            </label>
                                            <select name="category_id" 
                                                    id="category_id" 
                                                    class="form-select @error('category_id') is-invalid @enderror" 
                                                    required>
                                                <option value="">Pilih kategori...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" 
                                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label fw-semibold">
                                                Harga <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="number" 
                                                       name="price" 
                                                       id="price" 
                                                       class="form-control @error('price') is-invalid @enderror" 
                                                       value="{{ old('price') }}" 
                                                       min="0" 
                                                       step="1000"
                                                       placeholder="0"
                                                       required>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-text">Harga dalam Rupiah (tanpa desimal)</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Stock Row -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="stock_quantity" class="form-label fw-semibold">
                                                Stok Awal
                                            </label>
                                            <input type="number" 
                                                   name="stock_quantity" 
                                                   id="stock_quantity" 
                                                   class="form-control @error('stock_quantity') is-invalid @enderror" 
                                                   value="{{ old('stock_quantity', 0) }}" 
                                                   min="0">
                                            @error('stock_quantity')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="form-text">Masukkan jumlah stok awal produk</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Product Features -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Fitur Produk</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="is_active" 
                                                       id="is_active" 
                                                       value="1" 
                                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    <i class="bi bi-eye text-success me-1"></i>
                                                    Produk Aktif
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check">
                                                <input class="form-check-input" 
                                                       type="checkbox" 
                                                       name="is_popular" 
                                                       id="is_popular" 
                                                       value="1" 
                                                       {{ old('is_popular') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_popular">
                                                    <i class="bi bi-fire text-danger me-1"></i>
                                                    Produk Populer
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Thumbnail Upload -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Foto Produk</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label fw-semibold">
                                        Foto Utama <span class="text-danger">*</span>
                                    </label>
                                    <input type="file" 
                                           name="thumbnail" 
                                           id="thumbnail" 
                                           class="form-control @error('thumbnail') is-invalid @enderror" 
                                           accept="image/*"
                                           required>
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Format: JPG, PNG, WebP (Max: 2MB)</div>
                                </div>
                                
                                <!-- Thumbnail Preview -->
                                <div id="thumbnailPreview" class="text-center" style="display: none;">
                                    <img id="thumbnailImage" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeThumbnail()">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                                
                                <!-- Additional Photos -->
                                <div class="mt-4">
                                    <label for="photos" class="form-label fw-semibold">
                                        Foto Tambahan
                                    </label>
                                    <input type="file" 
                                           name="photos[]" 
                                           id="photos" 
                                           class="form-control @error('photos') is-invalid @enderror" 
                                           accept="image/*"
                                           multiple>
                                    @error('photos')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div class="form-text">Pilih beberapa foto sekaligus (Max: 5 foto)</div>
                                </div>
                                
                                <!-- Additional Photos Preview -->
                                <div id="photosPreview" class="row mt-3"></div>
                            </div>
                        </div>
                        
                        <!-- Save Actions -->
                        <div class="card mt-4">
                            <div class="card-header">
                                <h5 class="mb-0">Publish</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="save" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>Simpan Produk
                                    </button>
                                    <button type="submit" name="action" value="save_and_new" class="btn btn-outline-primary">
                                        <i class="bi bi-plus-circle me-2"></i>Simpan & Tambah Baru
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary" onclick="saveDraft()">
                                        <i class="bi bi-file-earmark me-2"></i>Simpan Draft
                                    </button>
                                </div>
                                
                                <hr class="my-3">
                                
                                <div class="text-muted small">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Tips: Gunakan foto berkualitas tinggi dan deskripsi yang menarik untuk meningkatkan penjualan.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Character counters
    const metaTitle = document.getElementById('meta_title');
    const metaTitleCount = document.getElementById('metaTitleCount');
    const metaDescription = document.getElementById('meta_description');
    const metaDescCount = document.getElementById('metaDescCount');
    
    metaTitle.addEventListener('input', function() {
        metaTitleCount.textContent = this.value.length;
        if (this.value.length > 60) {
            metaTitleCount.parentElement.classList.add('text-danger');
        } else {
            metaTitleCount.parentElement.classList.remove('text-danger');
        }
    });
    
    metaDescription.addEventListener('input', function() {
        metaDescCount.textContent = this.value.length;
        if (this.value.length > 160) {
            metaDescCount.parentElement.classList.add('text-danger');
        } else {
            metaDescCount.parentElement.classList.remove('text-danger');
        }
    });
    
    // Auto-generate SKU from name
    const nameInput = document.getElementById('name');
    const skuInput = document.getElementById('sku');
    
    nameInput.addEventListener('input', function() {
        if (!skuInput.value || skuInput.value === 'AUTO-GENERATE') {
            const sku = this.value
                .toUpperCase()
                .replace(/[^A-Z0-9]/g, '')
                .substring(0, 8) + '-' + Date.now().toString().slice(-4);
            skuInput.value = sku;
        }
    });
    
    // Auto-fill meta fields
    nameInput.addEventListener('blur', function() {
        if (!metaTitle.value) {
            metaTitle.value = this.value;
            metaTitleCount.textContent = this.value.length;
        }
    });
    
    const descriptionInput = document.getElementById('description');
    descriptionInput.addEventListener('blur', function() {
        if (!metaDescription.value) {
            const desc = this.value.substring(0, 160);
            metaDescription.value = desc;
            metaDescCount.textContent = desc.length;
        }
    });
    
    // Thumbnail preview
    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnailPreview = document.getElementById('thumbnailPreview');
    const thumbnailImage = document.getElementById('thumbnailImage');
    
    thumbnailInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                thumbnailImage.src = e.target.result;
                thumbnailPreview.style.display = 'block';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    // Additional photos preview
    const photosInput = document.getElementById('photos');
    const photosPreview = document.getElementById('photosPreview');
    
    photosInput.addEventListener('change', function() {
        photosPreview.innerHTML = '';
        if (this.files) {
            Array.from(this.files).slice(0, 5).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-6 mb-2';
                    col.innerHTML = `
                        <div class="position-relative">
                            <img src="${e.target.result}" class="img-fluid rounded" style="height: 80px; width: 100%; object-fit: cover;">
                            <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1" onclick="removePhoto(${index})">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    `;
                    photosPreview.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        }
    });
    
    // Form validation
    const form = document.getElementById('productForm');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi.');
        }
    });
});

function removeThumbnail() {
    document.getElementById('thumbnail').value = '';
    document.getElementById('thumbnailPreview').style.display = 'none';
}

function removePhoto(index) {
    // This would need more complex logic to actually remove from file input
    event.target.closest('.col-6').remove();
}

function saveDraft() {
    const form = document.getElementById('productForm');
    const hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = 'is_active';
    hiddenInput.value = '0';
    form.appendChild(hiddenInput);
    
    // Temporarily remove required attributes
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        field.removeAttribute('required');
    });
    
    form.submit();
}
</script>
@endpush
