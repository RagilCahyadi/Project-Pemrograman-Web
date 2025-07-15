@extends('layouts.checkout')

@section('title', 'Checkout - Fancy Paper Printing')

@section('content')
<div class="checkout-container">
    <!-- Animated Background -->
    <div class="animated-bg">
        <div class="bg-circle circle-1"></div>
        <div class="bg-circle circle-2"></div>
        <div class="bg-circle circle-3"></div>
    </div>
    
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Header with Animation -->
                <div class="checkout-header text-center mb-5">
                    <div class="header-icon mb-3">
                        <i class="bi bi-cart-check-fill"></i>
                    </div>
                    <h2 class="fw-bold gradient-text mb-3">Checkout</h2>
                    <p class="text-muted">Lengkapi informasi untuk menyelesaikan pesanan Anda</p>
                    
                    <!-- Progress Indicator -->
                    <div class="progress-indicator mt-4">
                        <div class="progress-step completed">
                            <div class="step-circle">
                                <i class="bi bi-check"></i>
                            </div>
                            <span>Form Pesanan</span>
                        </div>
                        <div class="progress-line completed"></div>
                        <div class="progress-step active">
                            <div class="step-circle">
                                <i class="bi bi-credit-card"></i>
                            </div>
                            <span>Checkout</span>
                        </div>
                        <div class="progress-line"></div>
                        <div class="progress-step">
                            <div class="step-circle">
                                <i class="bi bi-check-circle"></i>
                            </div>
                            <span>Selesai</span>
                        </div>
                    </div>
                </div>

                @if(session('error'))
                    <div class="alert alert-danger glass-card fade-in">
                        <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
                    </div>
                @endif

                <div class="row">
                    <!-- Order Summary -->
                    <div class="col-lg-5 mb-4">
                        <div class="glass-card order-summary">
                            <div class="card-header-glass">
                                <h5 class="mb-0">
                                    <i class="bi bi-cart-check me-2"></i>
                                    Ringkasan Pesanan
                                </h5>
                            </div>
                            <div class="card-body-glass">
                                @if(isset($orderData) && !empty($orderData))
                                    <div class="product-details mb-4">
                                        <h6 class="section-title">
                                            <i class="bi bi-box me-2"></i>Detail Produk
                                        </h6>
                                        <div class="detail-item">
                                            <span class="detail-label">Layanan:</span>
                                            <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['service_type'] ?? 'Fancy Paper')) }}</span>
                                        </div>
                                        <div class="detail-item">
                                            <span class="detail-label">Produk:</span>
                                            <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['product_type'] ?? '')) }}</span>
                                        </div>
                                                          @if(isset($orderData['service_type']) && $orderData['service_type'] === 'packaging')
                            @if(isset($orderData['material_type']))
                            <div class="detail-item">
                                <span class="detail-label">Material:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['material_type'])) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['packaging_type']))
                            <div class="detail-item">
                                <span class="detail-label">Jenis Packaging:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['packaging_type'])) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['sticker_size']))
                            <div class="detail-item">
                                <span class="detail-label">Ukuran Stiker:</span>
                                <span class="detail-value">{{ $orderData['sticker_size'] }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['packaging_size']))
                            <div class="detail-item">
                                <span class="detail-label">Ukuran Packaging:</span>
                                <span class="detail-value">{{ ucfirst($orderData['packaging_size']) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['cut_type']))
                            <div class="detail-item">
                                <span class="detail-label">Jenis Cutting:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['cut_type'])) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['packaging_finishing']))
                            <div class="detail-item">
                                <span class="detail-label">Finishing:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['packaging_finishing'])) }}</span>
                            </div>
                            @endif
                        @elseif(isset($orderData['service_type']) && $orderData['service_type'] === 'banner')
                            @if(isset($orderData['banner_type']))
                            <div class="detail-item">
                                <span class="detail-label">Jenis Banner:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['banner_type'])) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['signage_type']))
                            <div class="detail-item">
                                <span class="detail-label">Jenis Signage:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['signage_type'])) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['banner_material']))
                            <div class="detail-item">
                                <span class="detail-label">Material Banner:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['banner_material'])) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['signage_material']))
                            <div class="detail-item">
                                <span class="detail-label">Material Signage:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['signage_material'])) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['banner_size']))
                            <div class="detail-item">
                                <span class="detail-label">Ukuran Banner:</span>
                                <span class="detail-value">{{ $orderData['banner_size'] }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['custom_width']) && isset($orderData['custom_height']))
                            <div class="detail-item">
                                <span class="detail-label">Ukuran Custom:</span>
                                <span class="detail-value">{{ $orderData['custom_width'] }} x {{ $orderData['custom_height'] }} cm</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['banner_finishing']))
                            <div class="detail-item">
                                <span class="detail-label">Finishing:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['banner_finishing'])) }}</span>
                            </div>
                            @endif
                        @elseif(isset($orderData['service_type']) && $orderData['service_type'] === 'uv_printing')
                            @if(isset($orderData['uv_item_type']))
                            <div class="detail-item">
                                <span class="detail-label">Jenis Item UV:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['uv_item_type'])) }}</span>
                            </div>
                            @endif
                            
                            @if(isset($orderData['printing_side']))
                            <div class="detail-item">
                                <span class="detail-label">Sisi Cetak:</span>
                                <span class="detail-value">{{ ucfirst(str_replace('_', ' ', $orderData['printing_side'])) }}</span>
                            </div>
                            @endif
                                        @else
                                            @if(isset($orderData['paper_type']))
                                            <div class="detail-item">
                                                <span class="detail-label">Kertas:</span>
                                                <span class="detail-value">{{ $orderData['paper_type'] }}</span>
                                            </div>
                                            @endif
                                            
                                            @if(isset($orderData['size']))
                                            <div class="detail-item">
                                                <span class="detail-label">Ukuran:</span>
                                                <span class="detail-value">{{ $orderData['size'] }}</span>
                                            </div>
                                            @endif
                                            
                                            @if(isset($orderData['finishing']))
                                            <div class="detail-item">
                                                <span class="detail-label">Finishing:</span>
                                                <span class="detail-value">{{ $orderData['finishing'] }}</span>
                                            </div>
                                            @endif
                                        @endif
                                                          <div class="detail-item">
                            <span class="detail-label">Jumlah:</span>
                            <span class="detail-value">{{ $orderData['quantity'] ?? 1 }} 
                                @if(isset($orderData['service_type']))
                                    @if($orderData['service_type'] === 'packaging')
                                        pcs
                                    @elseif($orderData['service_type'] === 'banner')
                                        {{ $orderData['product_type'] === 'banner' ? 'banner' : 'unit' }}
                                    @elseif($orderData['service_type'] === 'uv_printing')
                                        pcs
                                    @else
                                        lembar
                                    @endif
                                @else
                                    lembar
                                @endif
                            </span>
                        </div>
                                    </div>

                                    <div class="price-breakdown">
                                        <h6 class="section-title">
                                            <i class="bi bi-calculator me-2"></i>Rincian Harga
                                        </h6>
                                        <div class="price-item">
                                            <span>Subtotal:</span>
                                            <span>Rp {{ number_format($orderData['subtotal'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="price-item">
                                            <span>Ongkos Kirim:</span>
                                            <span>Rp {{ number_format($orderData['shipping_cost'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        @if(isset($orderData['discount']) && $orderData['discount'] > 0)
                                        <div class="price-item discount">
                                            <span><i class="bi bi-gift me-1"></i>Diskon:</span>
                                            <span>- Rp {{ number_format($orderData['discount'], 0, ',', '.') }}</span>
                                        </div>
                                        @endif
                                        <div class="price-item">
                                            <span>Pajak (11%):</span>
                                            <span>Rp {{ number_format($orderData['tax_amount'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="price-divider"></div>
                                        <div class="price-item total">
                                            <span>Total:</span>
                                            <span class="total-amount">Rp {{ number_format($orderData['total'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    @if(isset($orderData['promo_code']) && $orderData['promo_code'])
                                    <div class="promo-applied">
                                        <i class="bi bi-gift-fill me-2"></i>
                                        Kode promo "{{ $orderData['promo_code'] }}" diterapkan
                                    </div>
                                    @endif
                                @else
                                    <div class="alert alert-warning glass-alert">
                                        <i class="bi bi-exclamation-circle me-2"></i>
                                        Data pesanan tidak ditemukan. Silakan kembali ke halaman layanan.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Customer Information Form -->
                    <div class="col-lg-7">
                        <div class="glass-card customer-form">
                            <div class="card-header-glass">
                                <h5 class="mb-0">
                                    <i class="bi bi-person-fill me-2"></i>
                                    Informasi Pelanggan
                                </h5>
                            </div>
                            <div class="card-body-glass">
                                <form method="POST" action="{{ route('checkout.process') }}" class="checkout-form">
                                    @csrf

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label for="customer_name" class="form-label">
                                                <i class="bi bi-person me-2"></i>Nama Lengkap
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-control enhanced-input @error('customer_name') is-invalid @enderror" 
                                                   id="customer_name" name="customer_name" 
                                                   value="{{ old('customer_name', $orderData['customer_name'] ?? '') }}" required>
                                            @error('customer_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="customer_email" class="form-label">
                                                <i class="bi bi-envelope me-2"></i>Email
                                                <span class="required">*</span>
                                            </label>
                                            <input type="email" class="form-control enhanced-input @error('customer_email') is-invalid @enderror" 
                                                   id="customer_email" name="customer_email" 
                                                   value="{{ old('customer_email', $orderData['customer_email'] ?? '') }}" required>
                                            @error('customer_email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="customer_phone" class="form-label">
                                            <i class="bi bi-telephone me-2"></i>Nomor Telepon
                                            <span class="required">*</span>
                                        </label>
                                        <input type="tel" class="form-control enhanced-input @error('customer_phone') is-invalid @enderror" 
                                               id="customer_phone" name="customer_phone" 
                                               value="{{ old('customer_phone', $orderData['customer_phone'] ?? '') }}" required>
                                        @error('customer_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="customer_address" class="form-label">
                                            <i class="bi bi-geo-alt me-2"></i>Alamat Lengkap
                                            <span class="required">*</span>
                                        </label>
                                        <textarea class="form-control enhanced-textarea @error('customer_address') is-invalid @enderror" 
                                                  id="customer_address" name="customer_address" rows="3" required>{{ old('customer_address', $orderData['customer_address'] ?? '') }}</textarea>
                                        @error('customer_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_method" class="form-label">
                                            <i class="bi bi-credit-card me-2"></i>Metode Pembayaran
                                            <span class="required">*</span>
                                        </label>
                                        <select class="form-select enhanced-select @error('payment_method') is-invalid @enderror" 
                                                id="payment_method" name="payment_method" required>
                                            <option value="">Pilih metode pembayaran</option>
                                            <option value="bank_transfer" {{ (old('payment_method') == 'bank_transfer') ? 'selected' : '' }}>
                                                <i class="bi bi-bank"></i> Transfer Bank
                                            </option>
                                            <option value="cash_on_delivery" {{ (old('payment_method') == 'cash_on_delivery') ? 'selected' : '' }}>
                                                <i class="bi bi-cash-coin"></i> Cash on Delivery (COD)
                                            </option>
                                            <option value="e_wallet" {{ (old('payment_method') == 'e_wallet') ? 'selected' : '' }}>
                                                <i class="bi bi-wallet2"></i> E-Wallet
                                            </option>
                                        </select>
                                        @error('payment_method')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="notes" class="form-label">
                                            <i class="bi bi-chat-left-text me-2"></i>Catatan Tambahan
                                        </label>
                                        <textarea class="form-control enhanced-textarea" id="notes" name="notes" rows="3" 
                                                  placeholder="Catatan khusus untuk pesanan Anda...">{{ old('notes', $orderData['notes'] ?? '') }}</textarea>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary-gradient btn-lg btn-block">
                                            <i class="bi bi-check-circle me-2"></i>
                                            Buat Pesanan
                                        </button>
                                        <a href="{{ 
                                            isset($orderData['service_type']) ? 
                                            (
                                                $orderData['service_type'] === 'packaging' ? route('services.packaging') :
                                                ($orderData['service_type'] === 'banner' ? route('services.banner') :
                                                ($orderData['service_type'] === 'uv_printing' ? route('services.uv-printing') :
                                                route('services.fancy-paper')))
                                            ) : 
                                            route('services.fancy-paper') 
                                        }}" class="btn btn-outline-secondary btn-lg">
                                            <i class="bi bi-arrow-left me-2"></i>
                                            Kembali ke Form
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Root Variables */
    :root {
        --primary-gradient: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
        --secondary-gradient: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
        --success-gradient: linear-gradient(135deg, #059669 0%, #047857 100%);
        --glass-bg: rgba(255, 255, 255, 0.95);
        --glass-border: rgba(255, 255, 255, 0.3);
        --shadow-soft: 0 8px 32px rgba(0, 0, 0, 0.15);
        --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.2);
        --text-primary: #1f2937;
        --text-secondary: #6b7280;
        --text-white: #ffffff;
        --accent-blue: #3b82f6;
        --accent-purple: #8b5cf6;
    }

    /* Background & Container */
    .checkout-container {
        min-height: 100vh;
        background: #e6ebf2;
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        margin: 20px;
    }

    .animated-bg {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
    }

    .bg-circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(59, 130, 246, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .circle-1 {
        width: 200px;
        height: 200px;
        top: 10%;
        left: 10%;
        animation-delay: 0s;
    }

    .circle-2 {
        width: 150px;
        height: 150px;
        top: 60%;
        right: 15%;
        animation-delay: 2s;
    }

    .circle-3 {
        width: 100px;
        height: 100px;
        bottom: 20%;
        left: 60%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    /* Header Styles */
    .checkout-header {
        position: relative;
        z-index: 1;
        animation: fadeInDown 1s ease-out;
    }

    .header-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        background: var(--primary-gradient);
        backdrop-filter: blur(10px);
        border: 1px solid var(--glass-border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: var(--shadow-soft);
        animation: pulse 2s infinite;
    }

    .header-icon i {
        font-size: 2.5rem;
        color: var(--text-white);
    }

    .gradient-text {
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        color: var(--text-primary);
        font-size: 2.5rem;
        font-weight: 700;
    }

    /* Progress Indicator */
    .progress-indicator {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 500px;
        margin: 0 auto;
    }

    .progress-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .step-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(148, 163, 184, 0.3);
        border: 2px solid rgba(148, 163, 184, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
        transition: all 0.3s ease;
        color: var(--text-primary);
    }

    .progress-step.completed .step-circle {
        background: var(--success-gradient);
        border-color: #047857;
        animation: bounceIn 0.6s ease-out;
        color: var(--text-white);
    }

    .progress-step.active .step-circle {
        background: var(--primary-gradient);
        border-color: #1e40af;
        animation: pulse 2s infinite;
        color: var(--text-white);
    }

    .progress-line {
        flex: 1;
        height: 2px;
        background: rgba(148, 163, 184, 0.3);
        margin: 0 20px;
        margin-bottom: 30px;
    }

    .progress-line.completed {
        background: var(--success-gradient);
    }

    .progress-step span {
        color: var(--text-primary);
        font-size: 0.875rem;
        font-weight: 500;
    }

    /* Glass Cards */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        box-shadow: var(--shadow-soft);
        overflow: hidden;
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        animation: fadeInUp 0.8s ease-out;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-hover);
    }

    .card-header-glass {
        background: rgba(255, 255, 255, 0.9);
        border-bottom: 1px solid rgba(148, 163, 184, 0.2);
        padding: 1.5rem;
        color: var(--text-primary);
    }

    .card-header-glass h5 {
        margin: 0;
        font-weight: 600;
        font-size: 1.25rem;
        color: var(--text-primary);
    }

    .card-body-glass {
        padding: 2rem;
        color: var(--text-primary);
    }

    /* Order Summary Styles */
    .order-summary {
        animation-delay: 0.2s;
    }

    .section-title {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid rgba(148, 163, 184, 0.2);
        font-size: 1.1rem;
    }

    .detail-item, .price-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid rgba(148, 163, 184, 0.1);
    }

    .detail-label {
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    .detail-value {
        color: var(--text-primary);
        font-weight: 500;
    }

    .price-item.discount {
        color: #4ade80;
    }

    .price-item.total {
        border-top: 2px solid rgba(148, 163, 184, 0.3);
        padding-top: 1rem;
        margin-top: 1rem;
        font-weight: 600;
        font-size: 1.1rem;
    }

    .total-amount {
        background: var(--success-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .price-divider {
        height: 1px;
        background: rgba(148, 163, 184, 0.2);
        margin: 1rem 0;
    }

    .promo-applied {
        background: rgba(5, 150, 105, 0.1);
        border: 1px solid rgba(5, 150, 105, 0.3);
        border-radius: 10px;
        padding: 1rem;
        margin-top: 1rem;
        color: #047857;
        text-align: center;
        font-weight: 500;
    }

    /* Form Styles */
    .customer-form {
        animation-delay: 0.4s;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        color: var(--text-primary);
        font-weight: 600;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        font-size: 1rem;
    }

    .required {
        color: #dc2626;
        margin-left: 4px;
    }

    .enhanced-input,
    .enhanced-textarea,
    .enhanced-select {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(148, 163, 184, 0.3);
        border-radius: 15px;
        color: var(--text-primary);
        padding: 1rem 1.25rem;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .enhanced-input:focus,
    .enhanced-textarea:focus,
    .enhanced-select:focus {
        background: rgba(255, 255, 255, 1);
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        outline: none;
        color: var(--text-primary);
    }

    .enhanced-input::placeholder,
    .enhanced-textarea::placeholder {
        color: var(--text-secondary);
    }

    .enhanced-select option {
        background: #ffffff;
        color: var(--text-primary);
    }

    /* Form Actions */
    .form-actions {
        display: grid;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-primary-gradient {
        background: var(--primary-gradient);
        border: none;
        border-radius: 15px;
        padding: 1rem 2rem;
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--text-white);
        transition: all 0.3s ease;
        box-shadow: var(--shadow-soft);
        position: relative;
        overflow: hidden;
    }

    .btn-primary-gradient:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-hover);
        background: var(--secondary-gradient);
        color: var(--text-white);
    }

    .btn-primary-gradient:active {
        transform: translateY(-1px);
    }

    .btn-outline-secondary {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(148, 163, 184, 0.3);
        border-radius: 15px;
        color: var(--text-primary);
        padding: 1rem 2rem;
        font-weight: 500;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-outline-secondary:hover {
        background: rgba(255, 255, 255, 1);
        border-color: var(--accent-blue);
        color: var(--text-primary);
        transform: translateY(-2px);
        text-decoration: none;
    }

    /* Alert Styles */
    .glass-alert {
        background: rgba(251, 191, 36, 0.1);
        border: 1px solid rgba(251, 191, 36, 0.3);
        border-radius: 15px;
        color: #d97706;
        backdrop-filter: blur(10px);
    }

    .fade-in {
        animation: fadeInDown 0.5s ease-out;
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    @keyframes bounceIn {
        0% {
            opacity: 0;
            transform: scale(0.3);
        }
        50% {
            opacity: 1;
            transform: scale(1.05);
        }
        70% {
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .progress-indicator {
            flex-direction: column;
            gap: 1rem;
        }
        
        .progress-line {
            display: none;
        }
        
        .gradient-text {
            font-size: 2rem;
        }
        
        .bg-circle {
            display: none;
        }
    }

    /* Loading State */
    .checkout-form button[type="submit"]:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        position: relative;
    }

    .checkout-form button[type="submit"]:disabled::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced form validation and UX
    const form = document.querySelector('.checkout-form');
    const submitBtn = form.querySelector('button[type="submit"]');
    const inputs = form.querySelectorAll('input, textarea, select');
    
    // Add floating label effect
    inputs.forEach(input => {
        const label = input.previousElementSibling;
        
        // Check if field has value on load
        if (input.value) {
            label.classList.add('focused');
        }
        
        input.addEventListener('focus', () => {
            label.classList.add('focused');
        });
        
        input.addEventListener('blur', () => {
            if (!input.value) {
                label.classList.remove('focused');
            }
        });
        
        // Real-time validation feedback
        input.addEventListener('input', () => {
            validateField(input);
        });
    });
    
    // Form validation
    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        
        // Remove existing validation classes
        field.classList.remove('is-invalid', 'is-valid');
        
        // Required field validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
        }
        
        // Email validation
        if (field.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            isValid = emailRegex.test(value);
        }
        
        // Phone validation
        if (field.type === 'tel' && value) {
            const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
            isValid = phoneRegex.test(value);
        }
        
        // Apply validation classes
        if (value) {
            field.classList.add(isValid ? 'is-valid' : 'is-invalid');
        }
        
        return isValid;
    }
    
    // Enhanced form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validate all fields
        let allValid = true;
        inputs.forEach(input => {
            if (!validateField(input)) {
                allValid = false;
            }
        });
        
        if (!allValid) {
            // Show error animation
            form.classList.add('shake');
            setTimeout(() => form.classList.remove('shake'), 500);
            return;
        }
        
        // Show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise me-2 spin"></i>Memproses...';
        
        // Add loading animation
        const originalText = submitBtn.textContent;
        
        // Submit form after short delay for UX
        setTimeout(() => {
            form.submit();
        }, 1000);
    });
    
    // Smooth scroll to form on validation error
    if (document.querySelector('.is-invalid')) {
        document.querySelector('.customer-form').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
    
    // Progress bar animation
    const progressSteps = document.querySelectorAll('.progress-step');
    progressSteps.forEach((step, index) => {
        setTimeout(() => {
            step.style.opacity = '0';
            step.style.transform = 'translateY(20px)';
            step.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                step.style.opacity = '1';
                step.style.transform = 'translateY(0)';
            }, 100);
        }, index * 200);
    });
    
    // Card entrance animation
    const cards = document.querySelectorAll('.glass-card');
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.8s ease-out forwards';
            }
        });
    }, observerOptions);
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        cardObserver.observe(card);
    });
    
    // Payment method selection enhancement
    const paymentSelect = document.getElementById('payment_method');
    if (paymentSelect) {
        paymentSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const icon = selectedOption.getAttribute('data-icon');
            
            // Add visual feedback for payment method selection
            if (this.value) {
                this.style.borderColor = '#667eea';
                this.style.background = 'rgba(102, 126, 234, 0.1)';
            } else {
                this.style.borderColor = 'rgba(255, 255, 255, 0.2)';
                this.style.background = 'rgba(255, 255, 255, 0.1)';
            }
        });
    }
    
    // Auto-resize textarea
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
    
    // Add tooltips for required fields
    const requiredFields = document.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        field.setAttribute('title', 'Field ini wajib diisi');
    });
});

// Additional CSS for animations
const additionalStyles = `
    <style>
        .focused {
            transform: translateY(-20px) scale(0.9);
            color: #667eea !important;
        }
        
        .is-valid {
            border-color: #4ade80 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%234ade80' d='m2.3 6.73.94-.94 1.82 1.82 2.86-2.86.94.94L4.06 9.4L2.3 6.73z'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }
        
        .is-invalid {
            border-color: #f56565 !important;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23f56565'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath d='m5.5 5.5 1 1m0-1-1 1'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 1rem;
        }
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .spin {
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Enhanced hover effects */
        .enhanced-input:hover,
        .enhanced-textarea:hover,
        .enhanced-select:hover {
            border-color: rgba(59, 130, 246, 0.5);
            transform: translateY(-2px);
        }
        
        /* Ripple effect for buttons */
        .btn-primary-gradient {
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary-gradient::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transition: width 0.6s, height 0.6s;
            transform: translate(-50%, -50%);
            z-index: 0;
        }
        
        .btn-primary-gradient:active::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-primary-gradient * {
            position: relative;
            z-index: 1;
        }
    </style>
`;

document.head.insertAdjacentHTML('beforeend', additionalStyles);
</script>
@endpush
