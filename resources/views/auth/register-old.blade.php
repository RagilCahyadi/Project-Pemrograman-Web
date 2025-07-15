<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - RNR Digital Printing</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #00b894;
            --secondary-color: #00cec9;
            --danger-color: #e17055;
            --success-color: #00b894;
            --warning-color: #fdcb6e;
            --dark-color: #2d3436;
        }
        
        body {
            background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
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
            padding: 30px;
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
                45deg,
                transparent,
                transparent 2px,
                rgba(255, 255, 255, 0.05) 2px,
                rgba(255, 255, 255, 0.05) 4px
            );
            animation: slide 15s linear infinite;
        }
        
        @keyframes slide {
            0% { transform: translateX(0); }
            100% { transform: translateX(50px); }
        }
        
        .logo-container {
            position: relative;
            z-index: 2;
        }
        
        .logo-icon {
            font-size: 2.5rem;
            margin-bottom: 10px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        .auth-body {
            padding: 30px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(0, 184, 148, 0.1);
            border-radius: 15px;
            padding: 15px;
            height: auto;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background: white;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 184, 148, 0.25);
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
            box-shadow: 0 10px 25px rgba(0, 184, 148, 0.4);
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
            text-shadow: 0 0 10px rgba(0, 184, 148, 0.3);
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            margin-bottom: 20px;
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
            width: 100px;
            height: 100px;
            top: 20%;
            left: 80%;
            animation: float 8s ease-in-out infinite;
        }
        
        .shape:nth-child(2) {
            width: 150px;
            height: 150px;
            top: 60%;
            left: 10%;
            animation: float 10s ease-in-out infinite reverse;
        }
        
        .shape:nth-child(3) {
            width: 80px;
            height: 80px;
            top: 10%;
            left: 20%;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-30px) rotate(180deg); }
        }
        
        .password-strength {
            margin-top: 10px;
            height: 5px;
            background: #e9ecef;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .password-strength-bar {
            height: 100%;
            transition: all 0.3s ease;
            border-radius: 3px;
        }
        
        .strength-weak { background: #e17055; width: 25%; }
        .strength-fair { background: #fdcb6e; width: 50%; }
        .strength-good { background: #00cec9; width: 75%; }
        .strength-strong { background: #00b894; width: 100%; }
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
                    <div class="logo-icon">🖨️</div>
                    <h2 class="mb-0">RNR Digital Printing</h2>
                    <p class="mb-0 opacity-75">Daftar Akun Baru</p>
                </div>
            </div>
            
            <div class="auth-body">
                @if ($errors->any())
                    <div class="alert alert-danger" data-aos="shake">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="form-floating" data-aos="fade-up" data-aos-delay="200">
                        <input type="text" class="form-control" id="name" name="name" 
                               placeholder="Nama Lengkap" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <label for="name"><i class="bi bi-person me-2"></i>Nama Lengkap</label>
                    </div>
                    
                    <div class="form-floating" data-aos="fade-up" data-aos-delay="300">
                        <input type="email" class="form-control" id="email" name="email" 
                               placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
                        <label for="email"><i class="bi bi-envelope me-2"></i>Email Address</label>
                    </div>
                    
                    <div class="form-floating" data-aos="fade-up" data-aos-delay="400">
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Password" required autocomplete="new-password">
                        <label for="password"><i class="bi bi-lock me-2"></i>Password</label>
                        <div class="password-strength">
                            <div class="password-strength-bar" id="strengthBar"></div>
                        </div>
                    </div>
                    
                    <div class="form-floating" data-aos="fade-up" data-aos-delay="500">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" 
                               placeholder="Konfirmasi Password" required autocomplete="new-password">
                        <label for="password_confirmation"><i class="bi bi-lock-fill me-2"></i>Konfirmasi Password</label>
                    </div>
                    
                    <div class="d-grid" data-aos="fade-up" data-aos-delay="600">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-person-plus me-2"></i>
                            Daftar Sekarang
                        </button>
                    </div>
                    
                    <div class="d-grid mt-3" data-aos="fade-up" data-aos-delay="650">
                        <a href="{{ route('login') }}" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Sudah Memiliki Akun
                        </a>
                    </div>
                </form>
                
                <div class="auth-links" data-aos="fade-up" data-aos-delay="700">
                    <small class="text-light">
                        <i class="bi bi-shield-check me-1"></i>
                        Data Anda Aman & Terlindungi
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
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Password strength checker
        const passwordInput = document.getElementById('password');
        const strengthBar = document.getElementById('strengthBar');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            updateStrengthBar(strength);
        });
        
        function calculatePasswordStrength(password) {
            let score = 0;
            
            if (password.length >= 8) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/\d/.test(password)) score++;
            if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) score++;
            
            return score;
        }
        
        function updateStrengthBar(strength) {
            strengthBar.className = 'password-strength-bar';
            
            switch(strength) {
                case 0:
                case 1:
                    strengthBar.classList.add('strength-weak');
                    break;
                case 2:
                    strengthBar.classList.add('strength-fair');
                    break;
                case 3:
                case 4:
                    strengthBar.classList.add('strength-good');
                    break;
                case 5:
                    strengthBar.classList.add('strength-strong');
                    break;
            }
        }
        
        // Add floating animation to form controls
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 10px 25px rgba(0, 184, 148, 0.15)';
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
        
        // Password confirmation validation
        const passwordConfirmation = document.getElementById('password_confirmation');
        
        passwordConfirmation.addEventListener('input', function() {
            if (passwordInput.value !== this.value) {
                this.style.borderColor = '#e17055';
            } else {
                this.style.borderColor = '#00b894';
            }
        });
    </script>
</body>
</html>
