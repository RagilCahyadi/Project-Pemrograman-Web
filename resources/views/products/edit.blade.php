@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">
                        <i class="bi bi-pencil text-primary me-2"></i>
                        Edit Produk: {{ $product->name }}
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">Edit {{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="btn-group">
                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-info">
                        <i class="bi bi-eye me-2"></i>Lihat
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
            
            <!-- Form -->
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                @method('PUT')
                
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
                                           value="{{ old('name', $product->name) }}" 
                                           placeholder="Masukkan nama produk..."
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="category_id" class="form-label fw-semibold">
                                        Kategori <span class="text-danger">*</span>
                                    </label>
                                    <select name="category_id" 
                                            id="category_id" 
                                            class="form-select @error('category_id') is-invalid @enderror"
                                            required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Price and Stock -->
                                <div class="row">
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
                                                       value="{{ old('price', $product->price) }}" 
                                                       placeholder="0"
                                                       min="0"
                                                       step="1000"
                                                       required>
                                                @error('price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="stock" class="form-label fw-semibold">
                                                Stok <span class="text-danger">*</span>
                                            </label>
                                            <input type="number" 
                                                   name="stock" 
                                                   id="stock" 
                                                   class="form-control @error('stock') is-invalid @enderror" 
                                                   value="{{ old('stock', $product->stock) }}" 
                                                   placeholder="0"
                                                   min="0"
                                                   required>
                                            @error('stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="about" class="form-label fw-semibold">
                                        Deskripsi <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="about" 
                                              id="about" 
                                              class="form-control @error('about') is-invalid @enderror" 
                                              rows="4" 
                                              placeholder="Masukkan deskripsi produk..."
                                              required>{{ old('about', $product->about) }}</textarea>
                                    @error('about')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <!-- Thumbnail -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Foto Utama</h5>
                            </div>
                            <div class="card-body">
                                @if($product->thumbnail)
                                    <div class="mb-3 text-center">
                                        <img src="{{ Storage::url($product->thumbnail) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid rounded"
                                             style="max-height: 200px; object-fit: cover;"
                                             id="currentThumbnail">
                                    </div>
                                @endif
                                
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label fw-semibold">
                                        @if($product->thumbnail)
                                            Ganti Foto Utama
                                        @else
                                            Foto Utama <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <input type="file" 
                                           name="thumbnail" 
                                           id="thumbnail" 
                                           class="form-control @error('thumbnail') is-invalid @enderror" 
                                           accept="image/jpeg,image/png,image/jpg"
                                           @if(!$product->thumbnail) required @endif>
                                    <div class="form-text">
                                        Format: JPEG, PNG, JPG. Maksimal 2MB.
                                    </div>
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <!-- Settings -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Pengaturan</h5>
                            </div>
                            <div class="card-body">
                                <!-- Status -->
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="is_active" 
                                               id="is_active"
                                               value="1"
                                               {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_active">
                                            Produk Aktif
                                        </label>
                                    </div>
                                    <small class="text-muted">Produk aktif akan ditampilkan di website</small>
                                </div>
                                
                                <!-- Popular -->
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               name="is_popular" 
                                               id="is_popular"
                                               value="1"
                                               {{ old('is_popular', $product->is_popular) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_popular">
                                            Produk Populer
                                        </label>
                                    </div>
                                    <small class="text-muted">Produk populer akan ditampilkan di halaman utama</small>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-check-circle me-2"></i>Update Produk
                                    </button>
                                    <a href="{{ route('products.show', $product) }}" class="btn btn-outline-info">
                                        <i class="bi bi-eye me-2"></i>Lihat Produk
                                    </a>
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
    // Preview thumbnail
    const thumbnailInput = document.getElementById('thumbnail');
    const currentThumbnail = document.getElementById('currentThumbnail');
    
    if (thumbnailInput) {
        thumbnailInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (currentThumbnail) {
                        currentThumbnail.src = e.target.result;
                    } else {
                        // Create new image preview if none exists
                        const imgContainer = document.createElement('div');
                        imgContainer.className = 'mb-3 text-center';
                        imgContainer.innerHTML = `
                            <img src="${e.target.result}" 
                                 alt="Preview" 
                                 class="img-fluid rounded"
                                 style="max-height: 200px; object-fit: cover;"
                                 id="currentThumbnail">
                        `;
                        thumbnailInput.parentNode.insertBefore(imgContainer, thumbnailInput);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Form validation
    const form = document.getElementById('productForm');
    form.addEventListener('submit', function(e) {
        const price = document.getElementById('price').value;
        const stock = document.getElementById('stock').value;
        
        if (price < 0) {
            e.preventDefault();
            alert('Harga tidak boleh negatif');
            return false;
        }
        
        if (stock < 0) {
            e.preventDefault();
            alert('Stok tidak boleh negatif');
            return false;
        }
    });
});
</script>
@endpush
