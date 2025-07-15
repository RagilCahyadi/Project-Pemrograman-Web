@extends('layouts.frontend')

@section('title', 'RNR Digital Printing - Dijamin Bagus')
@section('description', 'RNR Digital Printing menyediakan layanan cetak digital berkualitas tinggi. Cetak fancy paper, packaging, banner, UV printing dengan hasil dijamin bagus.')

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h1 class="display-4 fw-bold mb-4">
                    RNR Digital Printing
                    <span class="text-warning">Dijamin Bagus</span>
                </h1>
                <p class="lead mb-4">
                    Layanan digital printing berkualitas tinggi dengan teknologi terdepan. 
                    Hasil cetak yang tajam, warna yang akurat, dan kualitas yang konsisten.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#services" class="btn btn-light btn-lg">
                        <i class="bi bi-eye me-2"></i>Lihat Layanan
                    </a>
                    <a href="https://wa.me/6285156963404" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-whatsapp me-2"></i>Konsultasi Gratis
                    </a>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="text-center">
                    <img src="{{ asset('template/assets/hero-printing.jpg') }}" alt="Digital Printing" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row text-center">
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="display-4 text-primary fw-bold">{{ $stats['customers'] ?? '500+' }}</div>
                <h5>Pelanggan Puas</h5>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="display-4 text-success fw-bold">{{ $stats['orders'] ?? '1000+' }}</div>
                <h5>Pesanan Selesai</h5>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="display-4 text-warning fw-bold">{{ $stats['products'] ?? '50+' }}</div>
                <h5>Jenis Produk</h5>
            </div>
            <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="display-4 text-info fw-bold">5+</div>
                <h5>Tahun Pengalaman</h5>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="section-padding">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold">Layanan Kami</h2>
            <p class="lead">Berbagai macam layanan digital printing berkualitas tinggi</p>
        </div>
        
        <div class="row">
            <!-- Fancy Paper -->
            <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card service-card h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ asset('template/assets/fancy-paper.jpg') }}" class="img-fluid h-100 object-fit-cover" alt="Fancy Paper">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body h-100 d-flex flex-column">
                                <h5 class="card-title">
                                    <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                    Cetak Fancy Paper
                                </h5>
                                <p class="card-text flex-grow-1">
                                    HVS, Art Paper, Flyer, Brosur, Poster, Undangan dengan berbagai pilihan kertas berkualitas.
                                </p>
                                <div class="mt-auto">
                                    <span class="price-badge">Mulai Rp 5.000</span>
                                    <a href="{{ route('services.fancy-paper') }}" class="btn btn-primary btn-sm float-end">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Packaging -->
            <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card service-card h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ asset('template/assets/packaging.jpg') }}" class="img-fluid h-100 object-fit-cover" alt="Packaging">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body h-100 d-flex flex-column">
                                <h5 class="card-title">
                                    <i class="bi bi-box text-success me-2"></i>
                                    Packaging & Label
                                </h5>
                                <p class="card-text flex-grow-1">
                                    Label Stiker, Packaging Custom, Mug Sublim dengan hasil yang rapi dan tahan lama.
                                </p>
                                <div class="mt-auto">
                                    <span class="price-badge">Mulai Rp 3.000</span>
                                    <a href="{{ route('services.packaging') }}" class="btn btn-success btn-sm float-end">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Banner -->
            <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card service-card h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ asset('template/assets/banner.jpg') }}" class="img-fluid h-100 object-fit-cover" alt="Banner">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body h-100 d-flex flex-column">
                                <h5 class="card-title">
                                    <i class="bi bi-flag text-warning me-2"></i>
                                    Banner & Spanduk
                                </h5>
                                <p class="card-text flex-grow-1">
                                    Flexi Indoor/Outdoor, Backlit, Albatros dengan berbagai pilihan finishing profesional.
                                </p>
                                <div class="mt-auto">
                                    <span class="price-badge">Mulai Rp 15.000/m²</span>
                                    <a href="{{ route('services.banner') }}" class="btn btn-warning btn-sm float-end">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- UV Printing -->
            <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="card service-card h-100">
                    <div class="row g-0 h-100">
                        <div class="col-md-6">
                            <img src="{{ asset('template/assets/uv-printing.jpg') }}" class="img-fluid h-100 object-fit-cover" alt="UV Printing">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body h-100 d-flex flex-column">
                                <h5 class="card-title">
                                    <i class="bi bi-credit-card text-info me-2"></i>
                                    UV Printing
                                </h5>
                                <p class="card-text flex-grow-1">
                                    Akrilik Flatbed, ID Card, Lanyard, Custom Casing HP dengan teknologi UV terdepan.
                                </p>
                                <div class="mt-auto">
                                    <span class="price-badge">Mulai Rp 10.000</span>
                                    <a href="{{ route('services.uv-printing') }}" class="btn btn-info btn-sm float-end">
                                        Pesan Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How to Order Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold">Cara Pesan</h2>
            <p class="lead">3 langkah mudah untuk memesan</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center">
                    <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-1-circle-fill fs-1"></i>
                    </div>
                    <h4 class="mt-3">Pilih Layanan</h4>
                    <p>Pilih jenis layanan yang Anda butuhkan dari berbagai kategori yang tersedia.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center">
                    <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-2-circle-fill fs-1"></i>
                    </div>
                    <h4 class="mt-3">Upload Desain</h4>
                    <p>Upload file desain Anda atau konsultasikan kebutuhan desain dengan tim kami.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center">
                    <div class="bg-warning text-white rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="bi bi-3-circle-fill fs-1"></i>
                    </div>
                    <h4 class="mt-3">Bayar & Cetak</h4>
                    <p>Lakukan pembayaran dan pesanan Anda akan segera diproses dengan kualitas terbaik.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section-padding">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4" data-aos="fade-right">
                <h2 class="display-5 fw-bold">Tentang RNR Digital Printing</h2>
                <p class="lead">Lebih dari 5 tahun melayani kebutuhan digital printing dengan kualitas terbaik.</p>
                <p>
                    RNR Digital Printing adalah perusahaan yang bergerak di bidang jasa digital printing yang berlokasi di 
                    Kompleks PT. Semen Indonesia (Persero) Tbk, Gresik, East Java. Kami berkomitmen untuk memberikan 
                    layanan terbaik dengan hasil cetak yang berkualitas tinggi dan harga yang kompetitif.
                </p>
                <p>
                    Dengan pengalaman lebih dari 5 tahun dan didukung oleh teknologi printing terdepan, kami telah 
                    melayani berbagai kebutuhan klien mulai dari perorangan hingga perusahaan besar.
                </p>
                
                <div class="row mt-4">
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                            <span>Kualitas Terjamin</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                            <span>Pengerjaan Cepat</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                            <span>Harga Kompetitif</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success me-3 fs-4"></i>
                            <span>Layanan 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="row">
                    <div class="col-6 mb-3">
                        <img src="{{ asset('template/assets/about-1.jpg') }}" class="img-fluid rounded shadow" alt="About 1">
                    </div>
                    <div class="col-6 mb-3">
                        <img src="{{ asset('template/assets/about-2.jpg') }}" class="img-fluid rounded shadow" alt="About 2">
                    </div>
                    <div class="col-12">
                        <img src="{{ asset('template/assets/about-3.jpg') }}" class="img-fluid rounded shadow" alt="About 3">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold">Frequently Asked Questions</h2>
            <p class="lead">Pertanyaan yang sering diajukan</p>
        </div>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion" data-aos="fade-up">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Berapa lama waktu pengerjaan?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Waktu pengerjaan bervariasi tergantung jenis dan kompleksitas pesanan. Untuk pesanan reguler 
                                biasanya 1-3 hari kerja, sedangkan untuk pesanan express bisa diselesaikan dalam 24 jam.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Format file apa saja yang diterima?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Kami menerima berbagai format file seperti AI, PSD, CDR, PDF, JPG, PNG. Untuk hasil terbaik, 
                                disarankan menggunakan format vektor (AI, CDR) dengan resolusi tinggi.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apakah ada garansi untuk hasil cetak?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, kami memberikan garansi untuk hasil cetak. Jika ada kesalahan dari pihak kami, 
                                pesanan akan dicetak ulang tanpa biaya tambahan.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Bagaimana cara pembayaran?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Kami menerima pembayaran melalui transfer bank, e-wallet (OVO, GoPay, DANA), 
                                dan pembayaran tunai untuk pengambilan langsung.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section-padding bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold">Hubungi Kami</h2>
            <p class="lead">Ada pertanyaan atau ingin melakukan pemesanan? Hubungi kami sekarang!</p>
        </div>
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        @if(session('contact_success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle me-2"></i>
                                {{ session('contact_success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('contact_error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                {{ session('contact_error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST" data-aos="fade-up">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                           id="phone" name="phone" value="{{ old('phone') }}">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="subject" class="form-label">Subjek <span class="text-danger">*</span></label>
                                    <select class="form-select @error('subject') is-invalid @enderror" id="subject" name="subject" required>
                                        <option value="">Pilih Subjek</option>
                                        <option value="Pertanyaan Umum" {{ old('subject') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum</option>
                                        <option value="Konsultasi Cetak" {{ old('subject') == 'Konsultasi Cetak' ? 'selected' : '' }}>Konsultasi Cetak</option>
                                        <option value="Pemesanan" {{ old('subject') == 'Pemesanan' ? 'selected' : '' }}>Pemesanan</option>
                                        <option value="Komplain" {{ old('subject') == 'Komplain' ? 'selected' : '' }}>Komplain</option>
                                        <option value="Lainnya" {{ old('subject') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('subject')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="5" 
                                          placeholder="Tuliskan pesan Anda di sini..." required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="bi bi-send me-2"></i>Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Contact Info -->
        <div class="row mt-5">
            <div class="col-md-4 text-center mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="h1 text-primary mb-3">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <h5>Alamat</h5>
                <p class="text-muted">Kompleks PT. Semen Indonesia (Persero) Tbk, Gresik, East Java</p>
            </div>
            <div class="col-md-4 text-center mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="h1 text-primary mb-3">
                    <i class="bi bi-telephone"></i>
                </div>
                <h5>Telepon</h5>
                <p class="text-muted">
                    <a href="tel:0851-5696-3404" class="text-decoration-none">0851-5696-3404</a>
                </p>
            </div>
            <div class="col-md-4 text-center mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="h1 text-primary mb-3">
                    <i class="bi bi-envelope"></i>
                </div>
                <h5>Email</h5>
                <p class="text-muted">
                    <a href="mailto:info@rnrdigitalprinting.com" class="text-decoration-none">info@rnrdigitalprinting.com</a>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-primary text-white">
    <div class="container text-center" data-aos="fade-up">
        <h2 class="display-5 fw-bold mb-4">Siap Mencetak Impian Anda?</h2>
        <p class="lead mb-4">Hubungi kami sekarang untuk konsultasi gratis dan dapatkan penawaran terbaik!</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="https://wa.me/6285156963404" class="btn btn-light btn-lg">
                <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
            </a>
            <a href="tel:0851-5696-3404" class="btn btn-outline-light btn-lg">
                <i class="bi bi-telephone me-2"></i>Telepon Sekarang
            </a>
        </div>
    </div>
</section>
@endsection
