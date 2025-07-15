// Services Page Animations
document.addEventListener('DOMContentLoaded', function() {
    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                // Add staggered delay for multiple elements
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 100);
            }
        });
    }, observerOptions);
    
    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
    
    // Smooth scroll for internal links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Enhanced form interactions
    const formInputs = document.querySelectorAll('.form-control, .form-select');
    formInputs.forEach(input => {
        // Add focus effects
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('input-focused');
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.classList.remove('input-focused');
        });
        
        // Add ripple effect on change
        input.addEventListener('change', function() {
            const ripple = document.createElement('div');
            ripple.classList.add('ripple-effect');
            this.parentElement.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Material option animations
    const materialOptions = document.querySelectorAll('.material-option');
    materialOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all options
            materialOptions.forEach(opt => opt.classList.remove('selected'));
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Animate selection
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });
    
    // Button hover effects with sound simulation
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            // Create hover effect
            const hoverEffect = document.createElement('div');
            hoverEffect.style.cssText = `
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                background: rgba(255,255,255,0.3);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                pointer-events: none;
                transition: all 0.4s ease;
                z-index: 1;
            `;
            
            this.style.position = 'relative';
            this.appendChild(hoverEffect);
            
            setTimeout(() => {
                hoverEffect.style.width = '200px';
                hoverEffect.style.height = '200px';
            }, 10);
            
            setTimeout(() => {
                if (hoverEffect.parentNode) {
                    hoverEffect.remove();
                }
            }, 400);
        });
    });
    
    // Parallax effect for hero sections
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroSections = document.querySelectorAll('.hero-section');
        
        heroSections.forEach(hero => {
            const speed = 0.5;
            hero.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
    
    // Price calculation loading animation
    function showPriceLoading() {
        const priceDisplay = document.getElementById('totalPrice');
        if (priceDisplay) {
            priceDisplay.classList.add('loading-price');
            priceDisplay.textContent = '';
            
            // Simulate loading time
            setTimeout(() => {
                priceDisplay.classList.remove('loading-price');
                // Trigger original price calculation if it exists
                if (typeof calculatePrice === 'function') {
                    calculatePrice();
                }
            }, 800);
        }
    }
    
    // Add loading animation to form inputs
    const priceInputs = document.querySelectorAll('#orderForm select, #orderForm input');
    priceInputs.forEach(input => {
        input.addEventListener('change', showPriceLoading);
    });
    
    // Accordion smooth animations
    const accordionButtons = document.querySelectorAll('.accordion-button');
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = document.querySelector(this.getAttribute('data-bs-target'));
            if (target) {
                if (target.classList.contains('show')) {
                    target.style.animation = 'slideUp 0.3s ease';
                } else {
                    target.style.animation = 'slideDown 0.3s ease';
                }
            }
        });
    });
    
    // Add custom animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes slideUp {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(-10px); }
        }
        
        .ripple-effect {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            background: radial-gradient(circle, rgba(0,123,255,0.3) 0%, transparent 70%);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: ripple 0.6s ease;
            pointer-events: none;
            z-index: 1;
        }
        
        @keyframes ripple {
            0% {
                width: 20px;
                height: 20px;
                opacity: 1;
            }
            100% {
                width: 100px;
                height: 100px;
                opacity: 0;
            }
        }
        
        .input-focused {
            transform: translateY(-2px);
            transition: transform 0.3s ease;
        }
    `;
    document.head.appendChild(style);
});

// Initialize animations when page loads
window.addEventListener('load', function() {
    // Trigger initial fade-in for elements already in view
    const visibleElements = document.querySelectorAll('.fade-in');
    visibleElements.forEach((el, index) => {
        const rect = el.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom > 0) {
            setTimeout(() => {
                el.classList.add('visible');
            }, index * 100);
        }
    });
});
