@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="mb-1">
                        <i class="bi bi-eye text-primary me-2"></i>
                        Detail Produk: {{ $product->name }}
                    </h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Produk</a></li>
                            <li class="breadcrumb-item active">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="btn-group">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-2"></i>Edit
                    </a>
                </div>
            </div>
            
            <div class="row">
                <!-- Product Image -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Foto Produk</h5>
                        </div>
                        <div class="card-body text-center">
                            @if($product->thumbnail)
                                <img src="{{ Storage::url($product->thumbnail) }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid rounded mb-3"
                                     style="max-height: 300px; object-fit: cover;">
                            @elseif($product->photos->first())
                                <img src="{{ Storage::url($product->photos->first()->photo_path ?? $product->photos->first()->photo_url) }}" 
                                     alt="{{ $product->name }}" 
                                     class="img-fluid rounded mb-3"
                                     style="max-height: 300px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center rounded mb-3" 
                                     style="height: 300px;">
                                    <div class="text-center">
                                        <i class="bi bi-image display-1 text-muted"></i>
                                        <p class="text-muted mt-2">Tidak ada foto</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($product->photos->count() > 1)
                                <div class="row">
                                    @foreach($product->photos->skip(1) as $photo)
                                        <div class="col-4 mb-2">
                                            <img src="{{ Storage::url($photo->photo_path ?? $photo->photo_url) }}" 
                                                 alt="{{ $product->name }}" 
                                                 class="img-thumbnail"
                                                 style="height: 80px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <!-- Product Information -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Produk</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="150">Nama Produk:</th>
                                            <td><strong>{{ $product->name }}</strong></td>
                                        </tr>
                                        <tr>
                                            <th>Kategori:</th>
                                            <td>
                                                <span class="badge bg-secondary">{{ $product->category->name }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Harga:</th>
                                            <td><strong class="text-success fs-5">{{ $product->formatted_price }}</strong></td>
                                        </tr>
                                        <tr>
                                            <th>Stok:</th>
                                            <td>
                                                @if($product->stock > 10)
                                                    <span class="badge bg-success">{{ $product->stock }} unit</span>
                                                @elseif($product->stock > 0)
                                                    <span class="badge bg-warning">{{ $product->stock }} unit</span>
                                                @else
                                                    <span class="badge bg-danger">Habis</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="150">Status:</th>
                                            <td>
                                                @if($product->is_active)
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>Aktif
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-x-circle me-1"></i>Tidak Aktif
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Populer:</th>
                                            <td>
                                                @if($product->is_popular)
                                                    <span class="badge bg-warning">
                                                        <i class="bi bi-star-fill me-1"></i>Ya
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">Tidak</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Dibuat:</th>
                                            <td>{{ $product->created_at->format('d M Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Diperbarui:</th>
                                            <td>{{ $product->updated_at->format('d M Y H:i') }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            
                            @if($product->about)
                                <div class="mt-4">
                                    <h6>Deskripsi Produk:</h6>
                                    <div class="bg-light p-3 rounded">
                                        {!! nl2br(e($product->about)) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Order Statistics -->
                    @if($product->orderItems->count() > 0)
                    <div class="card mt-4">
                        <div class="card-header">
                            <h5 class="mb-0">Statistik Penjualan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-bag-check display-6 text-primary"></i>
                                        <h4 class="mt-2 mb-0">{{ $product->orderItems->count() }}</h4>
                                        <small class="text-muted">Total Pesanan</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-graph-up display-6 text-success"></i>
                                        <h4 class="mt-2 mb-0">{{ $product->orderItems->sum('quantity') }}</h4>
                                        <small class="text-muted">Unit Terjual</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-currency-dollar display-6 text-warning"></i>
                                        <h4 class="mt-2 mb-0">Rp {{ number_format($product->orderItems->sum(function($item) { return $item->quantity * $item->price; }), 0, ',', '.') }}</h4>
                                        <small class="text-muted">Total Pendapatan</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
