<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Reset Password - RNR Digital Printing</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3b82f6;
            --secondary-color: #1e40af;
            --danger-color: #e17055;
            --success-color: #00b894;
            --warning-color: #fdcb6e;
            --dark-color: #2d3436;
        }
        
        body {
            background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }
        
        .auth-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            position: relative;
        }
        
        .auth-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                120deg,
                transparent,
                transparent 3px,
                rgba(255, 255, 255, 0.1) 3px,
                rgba(255, 255, 255, 0.1) 6px
            );
            animation: diagonal 20s linear infinite;
        }
        
        @keyframes diagonal {
            0% { transform: translateX(0) translateY(0); }
            100% { transform: translateX(50px) translateY(50px); }
        }
        
        .logo-container {
            position: relative;
            z-index: 2;
        }
        
        .logo-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            animation: rotate 4s linear infinite;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .auth-body {
            padding: 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(59, 130, 246, 0.1);
            border-radius: 15px;
            padding: 15px;
            height: auto;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(59, 130, 246, 0.25);
            transform: translateY(-2px);
        }
        
        .form-floating > label {
            color: #666;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
            border-radius: 15px;
            padding: 15px 30px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.4);
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .auth-links {
            text-align: center;
            margin-top: 25px;
        }
        
        .auth-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .auth-links a:hover {
            color: var(--secondary-color);
            text-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: linear-gradient(135deg, rgba(0, 184, 148, 0.1) 0%, rgba(0, 184, 148, 0.05) 100%);
            color: var(--success-color);
            border-left: 4px solid var(--success-color);
        }
        
        .floating-shapes {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .shape {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape1 {
            top: 10%;
            left: 10%;
            width: 80px;
            height: 80px;
            background: #fff;
            border-radius: 50%;
            animation-delay: 0s;
        }
        
        .shape2 {
            top: 20%;
            right: 10%;
            width: 60px;
            height: 60px;
            background: #fff;
            transform: rotate(45deg);
            animation-delay: 2s;
        }
        
        .shape3 {
            bottom: 10%;
            left: 20%;
            width: 100px;
            height: 100px;
            background: #fff;
            clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(10deg); }
        }
        
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        }
        
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Floating Shapes -->
    <div class="floating-shapes">
        <div class="shape shape1"></div>
        <div class="shape shape2"></div>
        <div class="shape shape3"></div>
    </div>
    
    <div class="auth-container">
        <div class="auth-card" data-aos="zoom-in" data-aos-duration="800">
            <div class="auth-header">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h3 class="mb-0">Reset Password</h3>
                    <p class="mb-0 opacity-75">Buat password baru untuk akun Anda</p>
                </div>
            </div>
            
            <div class="auth-body">
                @if (session('status'))
                    <div class="alert alert-success" data-aos="fade-down">
                        {{ session('status') }}
                    </div>
                @endif
                
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    
                    <input type="hidden" name="token" value="{{ $token }}">
                    
                    <div class="form-floating" data-aos="fade-up" data-aos-delay="200">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ $email ?? old('email') }}" 
                               placeholder="Email" required autocomplete="email" autofocus>
                        <label for="email"><i class="bi bi-envelope me-2"></i>Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-floating" data-aos="fade-up" data-aos-delay="300">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" placeholder="Password Baru" required autocomplete="new-password">
                        <label for="password"><i class="bi bi-lock me-2"></i>Password Baru</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="form-floating" data-aos="fade-up" data-aos-delay="400">
                        <input type="password" class="form-control" id="password-confirm" 
                               name="password_confirmation" placeholder="Konfirmasi Password" required autocomplete="new-password">
                        <label for="password-confirm"><i class="bi bi-lock-fill me-2"></i>Konfirmasi Password</label>
                    </div>
                    
                    <div class="d-grid" data-aos="fade-up" data-aos-delay="500">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-shield-check me-2"></i>
                            Reset Password
                        </button>
                    </div>
                    
                    <div class="d-grid mt-3" data-aos="fade-up" data-aos-delay="550">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Kembali ke Login
                        </a>
                    </div>
                </form>
                
                <div class="auth-links" data-aos="fade-up" data-aos-delay="600">
                    <small class="text-muted">
                        <i class="bi bi-shield-check me-1"></i>
                        Password Anda Akan Dienkripsi dengan Aman
                    </small>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({
            duration: 600,
            easing: 'ease-in-out',
            once: true
        });
        
        // Add ripple effect to buttons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('click', function(e) {
                const rect = this.getBoundingClientRect();
                const ripple = document.createElement('span');
                const size = Math.max(rect.width, rect.height);
                
                ripple.classList.add('ripple');
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.background = 'rgba(255, 255, 255, 0.3)';
                ripple.style.transform = 'scale(0)';
                ripple.style.animation = 'ripple 0.6s linear';
                ripple.style.pointerEvents = 'none';
                
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            });
        });
    </script>
</body>
</html>
