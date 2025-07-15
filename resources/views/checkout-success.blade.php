@extends('layouts.checkout')

@section('title', 'Pesanan Berhasil - Fancy Paper Printing')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Success Message -->
            <div class="text-center mb-5">
                <div class="success-icon mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
                </div>
                <h2 class="fw-bold text-success mb-3">Pesanan Berhasil Dibuat!</h2>
                <p class="text-muted">Terima kasih atas pesanan Anda. Kami akan segera memproses pesanan Anda.</p>
            </div>

            @if(isset($order) && $order)
            <!-- Order Details -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-receipt me-2"></i>Detail Pesanan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Nomor Pesanan:</strong> <span class="text-primary">#{{ $order->id ?? '' }}</span></p>
                            <p class="mb-2"><strong>Tanggal Pesanan:</strong> {{ $order->created_at ? $order->created_at->format('d F Y, H:i') : '' }}</p>
                            <p class="mb-2"><strong>Status:</strong> <span class="badge bg-warning">Menunggu Konfirmasi</span></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Total Pembayaran:</strong> <span class="text-success fw-bold">Rp {{ number_format($order->total_amount ?? 0, 0, ',', '.') }}</span></p>
                            <p class="mb-2"><strong>Metode Pembayaran:</strong> {{ ucfirst(str_replace('_', ' ', $order->payment_method ?? '')) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-person-fill me-2"></i>Informasi Pelanggan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Nama:</strong> {{ $order->customer_name ?? '' }}</p>
                            <p class="mb-2"><strong>Email:</strong> {{ $order->customer_email ?? '' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Telepon:</strong> {{ $order->customer_phone ?? '' }}</p>
                            <p class="mb-2"><strong>Alamat:</strong> {{ $order->customer_address ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Next Steps -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-info-circle me-2"></i>Langkah Selanjutnya</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Konfirmasi Pesanan</h6>
                            <p class="small text-muted">Tim kami akan menghubungi Anda dalam 1-2 jam untuk konfirmasi detail pesanan.</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Pembayaran</h6>
                            <p class="small text-muted">Instruksi pembayaran akan dikirim setelah konfirmasi pesanan.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-primary">Produksi</h6>
                            <p class="small text-muted">Setelah pembayaran diterima, kami akan mulai memproduksi pesanan Anda.</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-primary">Pengiriman</h6>
                            <p class="small text-muted">Pesanan akan dikirim sesuai alamat yang telah Anda berikan.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="card shadow-sm mb-4">
                <div class="card-body text-center">
                    <h6 class="text-primary mb-3">Butuh Bantuan?</h6>
                    <p class="mb-3">Jika Anda memiliki pertanyaan tentang pesanan, jangan ragu untuk menghubungi kami:</p>
                    <div class="row justify-content-center">
                        <div class="col-md-4">
                            <a href="tel:+6281234567890" class="btn btn-outline-primary btn-sm w-100 mb-2">
                                <i class="bi bi-telephone me-2"></i>Telepon
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="mailto:info@fancypaperprinting.com" class="btn btn-outline-primary btn-sm w-100 mb-2">
                                <i class="bi bi-envelope me-2"></i>Email
                            </a>
                        </div>
                        <div class="col-md-4">
                            <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-success btn-sm w-100 mb-2">
                                <i class="bi bi-whatsapp me-2"></i>WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg me-3">
                    <i class="bi bi-house me-2"></i>Kembali ke Beranda
                </a>
                <a href="{{ route('services.fancy-paper') }}" class="btn btn-outline-primary btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>Pesan Lagi
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .success-icon {
        animation: bounceIn 1s ease-in-out;
    }
    
    @keyframes bounceIn {
        0%, 20%, 40%, 60%, 80% {
            animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
        }
        0% {
            opacity: 0;
            transform: scale3d(.3, .3, .3);
        }
        20% {
            transform: scale3d(1.1, 1.1, 1.1);
        }
        40% {
            transform: scale3d(.9, .9, .9);
        }
        60% {
            opacity: 1;
            transform: scale3d(1.03, 1.03, 1.03);
        }
        80% {
            transform: scale3d(.97, .97, .97);
        }
        100% {
            opacity: 1;
            transform: scale3d(1, 1, 1);
        }
    }
    
    .card {
        border: none;
        border-radius: 15px;
    }
    
    .card-header {
        border-radius: 15px 15px 0 0 !important;
        border-bottom: none;
    }
    
    .btn {
        border-radius: 10px;
        padding: 12px 20px;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .badge {
        padding: 8px 12px;
        font-size: 0.875rem;
    }
</style>
@endpush
