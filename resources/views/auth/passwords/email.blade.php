<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - RNR Digital Printing</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #fd79a8;
            --secondary-color: #fdcb6e;
            --danger-color: #e17055;
            --success-color: #00b894;
            --warning-color: #fdcb6e;
            --dark-color: #2d3436;
        }
        
        body {
            background: linear-gradient(135deg, #fd79a8 0%, #fdcb6e 100%);
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
            max-width: 450px;
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
                90deg,
                transparent,
                transparent 2px,
                rgba(255, 255, 255, 0.1) 2px,
                rgba(255, 255, 255, 0.1) 4px
            );
            animation: moveHorizontal 25s linear infinite;
        }
        
        @keyframes moveHorizontal {
            0% { transform: translateX(0); }
            100% { transform: translateX(50px); }
        }
        
        .logo-container {
            position: relative;
            z-index: 2;
        }
        
        .logo-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            animation: swing 3s ease-in-out infinite;
        }
        
        @keyframes swing {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(10deg); }
            75% { transform: rotate(-10deg); }
        }
        
        .auth-body {
            padding: 40px 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(253, 121, 168, 0.1);
            border-radius: 15px;
            padding: 15px;
            height: auto;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(253, 121, 168, 0.25);
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
            box-shadow: 0 10px 25px rgba(253, 121, 168, 0.4);
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
            margin-top: 30px;
        }
        
        .auth-links a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .auth-links a:hover {
            color: var(--secondary-color);
            text-shadow: 0 0 10px rgba(253, 121, 168, 0.3);
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
        
        .alert-danger {
            background: linear-gradient(135deg, rgba(225, 112, 85, 0.1) 0%, rgba(225, 112, 85, 0.05) 100%);
            color: var(--danger-color);
            border-left: 4px solid var(--danger-color);
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
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }
        
        .shape:nth-child(1) {
            width: 120px;
            height: 120px;
            top: 15%;
            left: 85%;
            animation: float 9s ease-in-out infinite;
        }
        
        .shape:nth-child(2) {
            width: 80px;
            height: 80px;
            top: 75%;
            left: 15%;
            animation: float 7s ease-in-out infinite reverse;
        }
        
        .shape:nth-child(3) {
            width: 100px;
            height: 100px;
            top: 45%;
            left: 5%;
            animation: float 11s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-25px) rotate(180deg); }
        }
        
        .info-box {
            background: rgba(253, 121, 168, 0.1);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid var(--primary-color);
        }
        
        .info-box i {
            color: var(--primary-color);
            font-size: 1.2rem;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    
    <div class="auth-container">
        <div class="auth-card" data-aos="zoom-in" data-aos-duration="1000">
            <div class="auth-header">
                <div class="logo-container">
                    <div class="logo-icon">🔑</div>
                    <h2 class="mb-0">RNR Digital Printing</h2>
                    <p class="mb-0 opacity-75">Reset Password</p>
                </div>
            </div>
            
            <div class="auth-body">
                @if (session('status'))
                    <div class="alert alert-success" data-aos="bounce">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger" data-aos="shake">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif
                
                <div class="info-box" data-aos="fade-up" data-aos-delay="200">
                    <i class="bi bi-info-circle"></i>
                    <small>Masukkan email Anda untuk menerima link reset password</small>
                </div>
                
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    
                    <div class="form-floating" data-aos="fade-up" data-aos-delay="300">
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <label for="email"><i class="bi bi-envelope me-2"></i>Email Address</label>
                    </div>
                    
                    <div class="d-grid" data-aos="fade-up" data-aos-delay="400">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send me-2"></i>
                            Kirim Link Reset
                        </button>
                    </div>
                </form>
                
                <div class="auth-links" data-aos="fade-up" data-aos-delay="500">
                    <a href="{{ route('login') }}" class="d-block mb-2">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali ke Login
                    </a>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">
                            <i class="bi bi-person-plus me-1"></i>
                            Belum punya akun? Daftar sekarang
                        </a>
                    @endif
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
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Add floating animation to form controls
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 10px 25px rgba(253, 121, 168, 0.15)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = 'none';
            });
        });
        
        // Add click effect to button
        document.querySelector('.btn-primary').addEventListener('click', function(e) {
            let ripple = document.createElement('span');
            let rect = this.getBoundingClientRect();
            let size = Math.max(rect.width, rect.height);
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
        
        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
