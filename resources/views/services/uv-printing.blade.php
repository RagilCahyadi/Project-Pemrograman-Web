@extends('layouts.services')

@section('title', 'Cetak UV Printing - RNR Digital Printing')
@section('description', 'Layanan cetak UV Printing berkualitas tinggi pada berbagai media. ID Card, Lanyard, Casing HP, Plakat Akrilik dengan teknologi UV terbaik.')

@push('styles')
<style>
    /* Hero Section Animations */
    .hero-section {
        background: linear-gradient(135deg, #8e2de2 0%, #4a00e0 100%);
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.15"/><circle cx="90" cy="40" r="0.8" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        animation: float 20s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(1deg); }
    }
    
    .hero-icon {
        font-size: 5rem;
        /* animation removed to prevent interference */
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-20px); }
        60% { transform: translateY(-10px); }
    }
    
    /* Product Carousel Enhancements */
    .product-carousel {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        transition: transform 0.3s ease;
    }
    
    .product-carousel:hover {
        transform: translateY(-10px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.2);
    }
    
    .product-carousel .carousel-item img {
        height: 400px;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    
    .product-carousel:hover .carousel-item.active img {
        transform: scale(1.05);
    }
    
    /* Animated Cards */
    .animated-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 30px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .animated-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: left 0.6s ease;
    }
    
    .animated-card:hover::before {
        left: 100%;
    }
    
    .animated-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    /* Form Enhancements */
    .form-section {
        background: linear-gradient(145deg, #f8f9fa, #e9ecef);
        border-radius: 25px;
        padding: 35px;
        margin-bottom: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        position: relative;
        border: 1px solid rgba(102, 126, 234, 0.1);
        z-index: 10;
        /* Removed overflow: hidden and ::after to prevent button blocking */
    }
    
    /* Ensure form elements are clickable */
    .paper-option, .size-option, .finishing-card, .btn, .form-control, .form-select {
        position: relative;
        z-index: 20;
        pointer-events: auto;
    }
    
    .form-header {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(102, 126, 234, 0.1);
    }
    
    .form-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #8e2de2, #4a00e0);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        margin-right: 20px;
        /* animation removed to prevent button interference */
    }
    
    @keyframes form-icon-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
    
    .form-title h4 {
        color: #2c3e50;
        font-weight: 700;
        margin: 0;
    }
    
    .form-group {
        margin-bottom: 25px;
        position: relative;
    }
    
    .form-label {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-weight: 600;
        color: #2c3e50;
        font-size: 1rem;
    }
    
    .label-text {
        position: relative;
    }
    
    .label-text::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        transition: width 0.3s ease;
    }
    
    .form-group:hover .label-text::after {
        width: 100%;
    }
    
    /* Enhanced Select */
    .select-wrapper {
        position: relative;
    }
    
    .enhanced-select {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 15px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .enhanced-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        transform: translateY(-2px);
        background: white;
    }
    
    /* Paper Selection Grid */
    .paper-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 10px;
    }
    
    .paper-option {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 15px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    .paper-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        border-color: rgba(102, 126, 234, 0.4);
    }
    
    .paper-option:hover::before {
        left: 100%;
    }
    
    .paper-option.selected {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }
    
    .paper-badge {
        width: 45px;
        height: 45px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        margin-right: 15px;
    }
    
    .paper-info {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    
    .paper-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
        margin-bottom: 2px;
    }
    
    .paper-weight {
        color: #6c757d;
        font-size: 0.8rem;
        margin-bottom: 2px;
    }
    
    .paper-price {
        color: #28a745;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    /* Size Selection */
    .size-selection {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .size-option {
        flex: 1;
        min-width: 120px;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(40, 167, 69, 0.2);
        border-radius: 15px;
        padding: 20px 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    .size-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.2);
        border-color: rgba(40, 167, 69, 0.4);
    }
    
    .size-option.selected {
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    }
    
    .size-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(40, 167, 69, 0.1), rgba(32, 201, 151, 0.1));
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    
    .size-option:hover::before {
        transform: translateY(0);
    }
    
    .size-option:hover {
        border-color: #28a745;
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.2);
    }
    
    .size-icon {
        font-size: 1.5rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
    }
    
    .size-details {
        display: flex;
        flex-direction: column;
    }
    
    .size-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
        margin-bottom: 3px;
    }
    
    .size-dim {
        color: #6c757d;
        font-size: 0.8rem;
    }
    
    /* Finishing Options */
    .finishing-options {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .finishing-card {
        flex: 1;
        min-width: 100px;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(255, 193, 7, 0.3);
        border-radius: 15px;
        padding: 18px 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    .finishing-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.2);
        border-color: rgba(255, 193, 7, 0.5);
    }
    
    .finishing-card.selected {
        border-color: #ffc107;
        background: rgba(255, 193, 7, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
    }
    
    .finishing-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.1), rgba(253, 126, 20, 0.1));
        transform: scale(0);
        transition: transform 0.3s ease;
        border-radius: 15px;
    }
    
    .finishing-card:hover::before {
        transform: scale(1);
    }
    
    .finishing-card:hover {
        border-color: #ffc107;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
    }
    
    .finishing-icon {
        font-size: 1.8rem;
        margin-bottom: 8px;
        display: block;
    }
    
    .finishing-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.85rem;
        margin-bottom: 5px;
    }
    
    .finishing-price {
        color: #fd7e14;
        font-weight: 600;
        font-size: 0.8rem;
    }
    
    /* Quantity Controls */
    .quantity-wrapper {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 15px;
        overflow: hidden;
        max-width: 200px;
    }
    
    .quantity-btn {
        width: 45px;
        height: 50px;
        border: none;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .quantity-btn:hover {
        background: linear-gradient(45deg, #5a6fd8, #6d42a0);
        transform: scale(1.1);
    }
    
    .quantity-btn:active {
        transform: scale(0.95);
    }
    
    .quantity-input {
        flex: 1;
        border: none;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 600;
        background: transparent;
        color: #2c3e50;
        padding: 0 15px;
    }
    
    .quantity-input:focus {
        outline: none;
        box-shadow: none;
    }
    
    .quantity-info {
        margin-top: 8px;
    }
    
    /* File Upload */
    .upload-area {
        border: 2px dashed rgba(102, 126, 234, 0.3);
        border-radius: 15px;
        padding: 30px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
        position: relative;
        overflow: hidden;
    }
    
    .upload-area::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .upload-area:hover::before {
        left: 100%;
    }
    
    .upload-area:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
        transform: translateY(-2px);
    }
    
    .upload-icon {
        font-size: 2.5rem;
        color: #667eea;
        margin-bottom: 15px;
        /* animation removed to prevent button interference */
    }
    
    @keyframes upload-bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .upload-text {
        display: flex;
        flex-direction: column;
    }
    
    .upload-title {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1rem;
        margin-bottom: 5px;
    }
    
    .upload-subtitle {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .upload-area.drag-over {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
        border-color: #3498db;
        transform: scale(1.02);
    }
    
    .upload-area.file-uploaded {
        background: linear-gradient(135deg, #27ae60, #2ecc71);
        color: white;
        border-color: #27ae60;
    }
    
    .file-input {
        display: none;
    }
    
    .upload-info {
        margin-top: 10px;
        text-align: center;
    }
    
    /* Custom Dimensions */
    .dimension-inputs {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .dimension-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .dimension-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 8px;
    }
    
    .input-with-unit {
        position: relative;
        display: flex;
        align-items: center;
    }
    
    .input-with-unit .form-control {
        padding-right: 40px;
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 12px;
    }
    
    .input-unit {
        position: absolute;
        right: 15px;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .dimension-separator {
        font-size: 1.5rem;
        font-weight: bold;
        color: #667eea;
        margin-top: 20px;
    }
    
    /* Enhanced Textarea */
    .textarea-wrapper {
        position: relative;
    }
    
    .enhanced-textarea {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(102, 126, 234, 0.2);
        border-radius: 15px;
        padding: 15px;
        resize: vertical;
        min-height: 100px;
        transition: all 0.3s ease;
    }
    
    .enhanced-textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        background: white;
    }
    
    .textarea-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 8px;
    }
    
    .char-count {
        font-size: 0.8rem;
        color: #6c757d;
    }
    
    /* Price Summary Card */
    .price-summary-card {
        background: linear-gradient(145deg, white, #f8f9fa);
        border: 2px solid rgba(102, 126, 234, 0.1);
        border-radius: 20px;
        padding: 25px;
        margin-top: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        position: relative;
        overflow: hidden;
    }
    
    .price-summary-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(45deg, #667eea, #764ba2);
    }
    
    .price-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(102, 126, 234, 0.1);
    }
    
    .price-header h5 {
        color: #2c3e50;
        margin: 0;
        font-weight: 700;
        display: flex;
        align-items: center;
    }
    
    .price-details {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }
    
    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 8px 0;
        font-size: 0.95rem;
    }
    
    .price-row.total {
        border-top: 2px solid rgba(102, 126, 234, 0.2);
        padding-top: 15px;
        margin-top: 10px;
        font-size: 1.1rem;
        font-weight: 700;
    }
    
    .price-row span:first-child {
        color: #6c757d;
    }
    
    .price-row span:last-child {
        color: #2c3e50;
        font-weight: 600;
    }
    
    .price-row.total span {
        color: #2c3e50;
    }
    
    /* Portfolio Gallery */
    .portfolio-card {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
    }
    
    .portfolio-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    }
    
    .portfolio-image {
        position: relative;
        height: 250px;
        overflow: hidden;
    }
    
    .portfolio-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .portfolio-icon {
        font-size: 4rem;
        color: white;
        opacity: 0.8;
    }
    
    .portfolio-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(transparent, rgba(0,0,0,0.8));
        padding: 30px 20px 20px;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    
    .portfolio-card:hover .portfolio-overlay {
        transform: translateY(0);
    }
    
    .portfolio-info h5 {
        color: white;
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .portfolio-info p {
        color: rgba(255,255,255,0.8);
        font-size: 0.9rem;
        margin: 0;
    }
    
    /* Testimonials */
    .testimonial-card {
        background: linear-gradient(145deg, white, #f8f9fa);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(102, 126, 234, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .testimonial-card::before {
        content: '"';
        position: absolute;
        top: -10px;
        right: 20px;
        font-size: 6rem;
        color: rgba(102, 126, 234, 0.1);
        font-family: serif;
    }
    
    .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .testimonial-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }
    
    .testimonial-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: linear-gradient(45deg, #667eea, #764ba2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        color: white;
        font-size: 1.5rem;
    }
    
    .testimonial-info {
        flex: 1;
    }
    
    .testimonial-info h6 {
        margin: 0;
        font-weight: 600;
        color: #2c3e50;
    }
    
    .testimonial-info small {
        color: #6c757d;
    }
    
    .testimonial-rating {
        font-size: 0.9rem;
    }
    
    .testimonial-content {
        font-style: italic;
        color: #555;
        line-height: 1.6;
        position: relative;
        z-index: 1;
    }
    
    /* Process Steps */    .process-step {
        text-align: center;
        padding: 30px 20px;
        background: linear-gradient(145deg, white, #f8f9fa);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid rgba(102, 126, 234, 0.1);
        overflow: visible; /* Allow numbers to show outside */
        margin-top: 30px; /* Add space for numbers */
    }

    .process-step::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(45deg, #667eea, #764ba2);
    }

    .process-step:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .process-number {
        position: absolute;
        top: -25px;
        right: 15px;
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #FF6B35, #F7931E) !important;
        color: white !important;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900 !important;
        font-size: 1.6rem !important;
        box-shadow: 0 8px 25px rgba(255, 107, 53, 0.7), inset 0 2px 4px rgba(255,255,255,0.3);
        border: 4px solid white;
        z-index: 25 !important;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.9) !important;
        font-family: 'Arial Black', Arial, sans-serif !important;
        animation: numberPulse 2s ease-in-out infinite;
    }

    @keyframes numberPulse {
        0%, 100% { 
            transform: scale(1); 
            box-shadow: 0 8px 25px rgba(255, 107, 53, 0.7), inset 0 2px 4px rgba(255,255,255,0.3); 
        }
        50% { 
            transform: scale(1.15); 
            box-shadow: 0 12px 35px rgba(255, 107, 53, 0.9), inset 0 2px 4px rgba(255,255,255,0.5); 
        }
    }
    
    .process-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 2rem;
        margin: 0 auto 20px;
        animation: process-pulse 2s ease-in-out infinite;
    }
    
    @keyframes process-pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .process-step h5 {
        color: #2c3e50;
        font-weight: 600;
        margin-bottom: 15px;
    }
    
    .process-step p {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.5;
        margin: 0;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.1); }
    }
    
    .form-control, .form-select {
        border-radius: 15px;
        border: 2px solid transparent;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        transform: translateY(-2px);
    }
    
    /* Product Specs */
    .product-specs {
        background: linear-gradient(145deg, white, #f8f9fa);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(102, 126, 234, 0.1);
    }
    
    .product-specs:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .spec-icon-wrapper {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    
    .spec-category {
        background: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        padding: 20px;
        border: 1px solid rgba(102, 126, 234, 0.1);
        transition: all 0.3s ease;
    }
    
    .spec-category:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
    }
    
    .spec-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        font-size: 1.1rem;
        color: #2c3e50;
    }
    
    .spec-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .spec-item {
        display: flex;
        align-items: center;
        padding: 10px;
        background: rgba(102, 126, 234, 0.05);
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .spec-item:hover {
        background: rgba(102, 126, 234, 0.1);
        transform: translateX(5px);
    }
    
    .spec-badge {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
        margin-right: 12px;
    }
    
    .spec-details {
        display: flex;
        flex-direction: column;
    }
    
    .spec-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
    }
    
    .spec-desc {
        color: #6c757d;
        font-size: 0.8rem;
    }
    
    .size-options {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .size-card {
        flex: 1;
        min-width: 80px;
        background: rgba(40, 167, 69, 0.1);
        border: 2px solid rgba(40, 167, 69, 0.2);
        border-radius: 12px;
        padding: 15px 10px;
        text-align: center;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .size-card:hover {
        background: rgba(40, 167, 69, 0.2);
        border-color: #28a745;
        transform: translateY(-3px);
    }
    
    .size-card.custom {
        background: rgba(255, 193, 7, 0.1);
        border-color: rgba(255, 193, 7, 0.3);
    }
    
    .size-card.custom:hover {
        background: rgba(255, 193, 7, 0.2);
        border-color: #ffc107;
    }
    
    .size-icon {
        font-size: 1.2rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    
    .size-dim {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 500;
    }
    
    .finishing-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .finishing-tag {
        background: linear-gradient(45deg, #ffc107, #fd7e14);
        color: white;
        padding: 8px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .finishing-tag:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
    }
    
    .quality-guarantee {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        padding: 20px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        box-shadow: 0 5px 20px rgba(40, 167, 69, 0.3);
    }
    
    .guarantee-icon {
        font-size: 2rem;
        margin-right: 15px;
        animation: shield-pulse 2s ease-in-out infinite;
    }
    
    @keyframes shield-pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }
    
    .guarantee-text {
        display: flex;
        flex-direction: column;
    }
    
    .guarantee-text strong {
        font-size: 1.1rem;
        margin-bottom: 5px;
    }
    
    .guarantee-text span {
        opacity: 0.9;
        font-size: 0.9rem;
    }
    
    .spec-icon {
        animation: rotate 4s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    /* Price Display */
    .price-display {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(45deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { filter: drop-shadow(0 0 5px rgba(102, 126, 234, 0.5)); }
        to { filter: drop-shadow(0 0 20px rgba(102, 126, 234, 0.8)); }
    }
    
    .price-breakdown {
        background: linear-gradient(145deg, #e8f5e8, #d4edda);
        border-radius: 15px;
        padding: 20px;
        border-left: 5px solid #28a745;
        animation: slideInRight 0.5s ease;
    }
    
    @keyframes slideInRight {
        from { transform: translateX(50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* Promo Section */
    .promo-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 20px;
        padding: 25px;
        margin: 20px 0;
        box-shadow: 0 8px 32px rgba(102, 126, 234, 0.3);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .promo-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        animation: promoShine 3s ease-in-out infinite;
    }
    
    @keyframes promoShine {
        0%, 100% { transform: translateX(-50%) translateY(-50%) rotate(0deg); }
        50% { transform: translateX(-45%) translateY(-45%) rotate(5deg); }
    }
    
    .promo-section .d-flex {
        position: relative;
        z-index: 2;
    }
    
    .promo-section .bi-gift {
        font-size: 1.2rem;
        color: #ffd700;
        filter: drop-shadow(0 2px 4px rgba(0,0,0,0.3));
    }
    
    .promo-section .input-group {
        margin-top: 15px;
        position: relative;
        z-index: 2;
    }
    
    .promo-section .form-control {
        background: rgba(255, 255, 255, 0.95);
        border: 2px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px 0 0 12px;
        padding: 12px 15px;
        font-weight: 500;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .promo-section .form-control:focus {
        background: rgba(255, 255, 255, 1);
        border-color: #ffd700;
        box-shadow: 0 0 0 3px rgba(255, 215, 0, 0.2);
        outline: none;
    }
    
    .promo-section .form-control::placeholder {
        color: #888;
        font-style: italic;
    }
    
    .promo-section #applyPromo {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
        border: none !important;
        color: white !important;
        font-weight: bold;
        padding: 12px 20px;
        border-radius: 0 12px 12px 0;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .promo-section #applyPromo::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .promo-section #applyPromo:hover::before {
        left: 100%;
    }
    
    .promo-section #applyPromo:hover {
        background: linear-gradient(135deg, #218838 0%, #1e9b82 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
    }
    
    .promo-section #applyPromo:disabled {
        background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
        transform: none;
        box-shadow: 0 2px 8px rgba(108, 117, 125, 0.2);
    }
    
    .promo-section #resetPromo {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
        border: none !important;
        color: white !important;
        font-weight: bold;
        padding: 12px 15px;
        border-radius: 8px;
        margin-left: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
    }
    
    .promo-section #resetPromo:hover {
        background: linear-gradient(135deg, #c82333 0%, #bd2130 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    }
    
    #promoFeedback {
        padding: 10px 0;
        position: relative;
        z-index: 2;
    }
    
    #promoFeedback .text-success {
        color: #d4edda !important;
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        background: rgba(40, 167, 69, 0.2);
        padding: 8px 12px;
        border-radius: 8px;
        border-left: 4px solid #28a745;
    }
    
    #promoFeedback .text-danger {
        color: #f8d7da !important;
        font-weight: 600;
        text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        background: rgba(220, 53, 69, 0.2);
        padding: 8px 12px;
        border-radius: 8px;
        border-left: 4px solid #dc3545;
    }
    
    .promo-section small {
        position: relative;
        z-index: 2;
        font-weight: 500;
        text-shadow: 0 1px 2px rgba(0,0,0,0.3);
        background: rgba(255, 255, 255, 0.1);
        padding: 8px 12px;
        border-radius: 8px;
        display: inline-block;
        backdrop-filter: blur(5px);
    }
    
    /* UV Item Selection Grid */
    .uv-item-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        margin-bottom: 10px;
    }
    
    .uv-item-option {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(142, 45, 226, 0.2);
        border-radius: 15px;
        padding: 20px 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        position: relative;
        overflow: hidden;
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    .uv-item-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(142, 45, 226, 0.2);
        border-color: rgba(142, 45, 226, 0.4);
    }
    
    .uv-item-option.selected {
        border-color: #8e2de2;
        background: rgba(142, 45, 226, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(142, 45, 226, 0.3);
    }
    
    .uv-item-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(142, 45, 226, 0.1), transparent);
        transition: left 0.6s ease;
    }
    
    .uv-item-option:hover::before {
        left: 100%;
    }
    
    .uv-item-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #8e2de2, #4a00e0);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 15px;
    }
    
    .uv-item-info {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .uv-item-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
        margin-bottom: 3px;
    }
    
    .uv-item-desc {
        color: #6c757d;
        font-size: 0.8rem;
        margin-bottom: 5px;
    }
    
    .uv-item-price {
        color: #8e2de2;
        font-weight: 600;
        font-size: 0.85rem;
    }
    
    /* Media queries for responsive UV item grid */
    @media (max-width: 768px) {
        .uv-item-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    @media (max-width: 480px) {
        .uv-item-grid {
            grid-template-columns: 1fr;
        }
    }
    
    /* Price Breakdown Styles */
    .price-breakdown {
        background: linear-gradient(145deg, #e8f5e8, #d4edda);
        border-radius: 15px;
        padding: 20px;
        border-left: 5px solid #28a745;
        animation: slideInRight 0.5s ease;
    }
    
    @keyframes slideInRight {
        from { transform: translateX(50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* Specification Styles */
    .spec-icon-wrapper {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #8e2de2, #4a00e0);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
    }
    
    .spec-icon {
        font-size: 1.8rem;
    }
    
    .spec-category {
        margin-bottom: 20px;
    }
    
    .spec-header {
        margin-bottom: 15px;
        font-weight: 600;
        color: #2c3e50;
        display: flex;
        align-items: center;
    }
    
    .spec-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 10px;
    }
    
    .spec-item {
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        padding: 10px;
        border: 1px solid rgba(142, 45, 226, 0.1);
    }
    
    .spec-badge {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #8e2de2, #4a00e0);
        color: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.8rem;
        margin-right: 10px;
    }
    
    .spec-details {
        display: flex;
        flex-direction: column;
    }
    
    .spec-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.85rem;
        margin-bottom: 2px;
    }
    
    .spec-desc {
        color: #6c757d;
        font-size: 0.75rem;
    }
    
    .size-options {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .size-badge {
        display: flex;
        align-items: center;
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .feature-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }
    
    .feature-item {
        display: flex;
        align-items: flex-start;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 10px;
        padding: 15px;
        border: 1px solid rgba(142, 45, 226, 0.1);
    }
    
    .feature-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #8e2de2, #4a00e0);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        margin-right: 12px;
        flex-shrink: 0;
    }
    
    .feature-text {
        display: flex;
        flex-direction: column;
    }
    
    .feature-text strong {
        color: #2c3e50;
        font-size: 0.9rem;
        margin-bottom: 3px;
    }
    
    .feature-text span {
        color: #6c757d;
        font-size: 0.8rem;
        line-height: 1.3;
    }
</style>
@endpush

@section('content')

<!-- Hero Section -->
<section class="hero-section text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 fade-in">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white-50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active">UV Printing</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">UV Printing Premium</h1>
                <p class="lead">Cetak UV berkualitas tinggi untuk ID Card, Lanyard, Casing HP, Plakat Akrilik dan berbagai item lainnya dengan teknologi UV terbaik</p>
            </div>
            <div class="col-lg-4 text-center fade-in">
                <i class="bi bi-printer hero-icon"></i>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6 mb-4 fade-in">
                <div id="productCarousel" class="carousel slide product-carousel" data-bs-ride="carousel">
                    <div class="carousel-inner rounded-3">
                        <div class="carousel-item active">
                            <div class="uv-printing-placeholder" style="height: 400px; background: linear-gradient(135deg, #8e2de2, #4a00e0); display: flex; align-items: center; justify-content: center; color: white;">
                                <div class="text-center">
                                    <i class="bi bi-credit-card-2-front" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                                    <h4>ID Card UV Printing</h4>
                                    <p>Cetak ID Card berkualitas tinggi</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="uv-printing-placeholder" style="height: 400px; background: linear-gradient(135deg, #8e2de2, #4a00e0); display: flex; align-items: center; justify-content: center; color: white;">
                                <div class="text-center">
                                    <i class="bi bi-tag" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                                    <h4>Lanyard UV Printing</h4>
                                    <p>Tali ID Card dengan cetakan UV</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="uv-printing-placeholder" style="height: 400px; background: linear-gradient(135deg, #8e2de2, #4a00e0); display: flex; align-items: center; justify-content: center; color: white;">
                                <div class="text-center">
                                    <i class="bi bi-phone" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                                    <h4>Custom Casing HP</h4>
                                    <p>Personalisasi casing dengan UV</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
                
                <!-- Product Specifications -->
                <div class="product-specs mt-4 fade-in">
                    <div class="d-flex align-items-center mb-4">
                        <div class="spec-icon-wrapper me-3">
                            <i class="bi bi-info-circle spec-icon"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Spesifikasi Produk</h5>
                            <small class="text-muted">Detail lengkap produk UV Printing</small>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-printer text-primary me-2"></i>
                                    <strong>Jenis Item UV Printing</strong>
                                </div>
                                <div class="spec-grid">
                                    <div class="spec-item">
                                        <div class="spec-badge">ID</div>
                                        <div class="spec-details">
                                            <span class="spec-name">ID Card PVC</span>
                                            <span class="spec-desc">Premium Quality</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">LY</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Lanyard</span>
                                            <span class="spec-desc">Tali ID Card</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">HP</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Casing HP</span>
                                            <span class="spec-desc">Custom Case</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">AK</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Plakat Akrilik</span>
                                            <span class="spec-desc">Premium Award</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-palette text-success me-2"></i>
                                    <strong>Kualitas UV Printing</strong>
                                </div>
                                <div class="size-options">
                                    <div class="size-badge">
                                        <i class="bi bi-shield-check me-2"></i>
                                        <span>Tahan Air & UV</span>
                                    </div>
                                    <div class="size-badge">
                                        <i class="bi bi-palette me-2"></i>
                                        <span>Warna Vibrant</span>
                                    </div>
                                    <div class="size-badge">
                                        <i class="bi bi-eye me-2"></i>
                                        <span>Detail Tajam</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-clock text-warning me-2"></i>
                                    <strong>Waktu Produksi</strong>
                                </div>
                                <div class="size-options">
                                    <div class="size-badge">
                                        <i class="bi bi-lightning me-2"></i>
                                        <span>1-2 Hari Kerja</span>
                                    </div>
                                    <div class="size-badge">
                                        <i class="bi bi-rocket me-2"></i>
                                        <span>Express: 24 Jam</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-award text-warning me-2"></i>
                                    <strong>Keunggulan UV Printing</strong>
                                </div>
                                <div class="feature-grid">
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="bi bi-droplet-half"></i>
                                        </div>
                                        <div class="feature-text">
                                            <strong>Tahan Air</strong>
                                            <span>Hasil cetak tahan terhadap air dan kelembaban</span>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="bi bi-sun"></i>
                                        </div>
                                        <div class="feature-text">
                                            <strong>Anti UV</strong>
                                            <span>Warna tidak pudar terkena sinar matahari</span>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="bi bi-gem"></i>
                                        </div>
                                        <div class="feature-text">
                                            <strong>Permukaan Halus</strong>
                                            <span>Finish berkualitas tinggi dan tahan lama</span>
                                        </div>
                                    </div>
                                    <div class="feature-item">
                                        <div class="feature-icon">
                                            <i class="bi bi-shield-check"></i>
                                        </div>
                                        <div class="feature-text">
                                            <strong>Garansi Kualitas</strong>
                                            <span>Hasil cetak tajam, warna akurat, dan tahan lama</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Form -->
            <div class="col-lg-6">
                <form id="orderForm" method="POST" action="{{ route('checkout.store') }}" class="form-section fade-in">
                    @csrf
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="bi bi-basket"></i>
                        </div>
                        <div class="form-title">
                            <h4 class="mb-1">Form Pemesanan</h4>
                            <small class="text-muted">Isi detail pesanan Anda</small>
                        </div>
                    </div>
                    
                    <!-- Product Selection -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-printer text-primary me-2"></i>
                            <span class="label-text">Jenis Item UV Printing</span>
                        </label>
                        <div class="uv-item-grid">
                            <div class="uv-item-option" data-value="id_card" data-price="7000">
                                <div class="uv-item-icon">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </div>
                                <div class="uv-item-info">
                                    <span class="uv-item-name">ID Card PVC</span>
                                    <span class="uv-item-desc">Premium Quality</span>
                                    <span class="uv-item-price">Rp 7.000</span>
                                </div>
                            </div>
                            <div class="uv-item-option" data-value="lanyard" data-price="15000">
                                <div class="uv-item-icon">
                                    <i class="bi bi-tag"></i>
                                </div>
                                <div class="uv-item-info">
                                    <span class="uv-item-name">Lanyard</span>
                                    <span class="uv-item-desc">Tali ID Card</span>
                                    <span class="uv-item-price">Rp 15.000</span>
                                </div>
                            </div>
                            <div class="uv-item-option" data-value="tiket_gelang" data-price="4000">
                                <div class="uv-item-icon">
                                    <i class="bi bi-ticket-perforated"></i>
                                </div>
                                <div class="uv-item-info">
                                    <span class="uv-item-name">Tiket Gelang</span>
                                    <span class="uv-item-desc">Wristband</span>
                                    <span class="uv-item-price">Rp 4.000</span>
                                </div>
                            </div>
                            <div class="uv-item-option" data-value="casing_hp" data-price="30000">
                                <div class="uv-item-icon">
                                    <i class="bi bi-phone"></i>
                                </div>
                                <div class="uv-item-info">
                                    <span class="uv-item-name">Casing HP</span>
                                    <span class="uv-item-desc">Custom Case</span>
                                    <span class="uv-item-price">Rp 30.000</span>
                                </div>
                            </div>
                            <div class="uv-item-option" data-value="plakat_akrilik" data-price="50000">
                                <div class="uv-item-icon">
                                    <i class="bi bi-award"></i>
                                </div>
                                <div class="uv-item-info">
                                    <span class="uv-item-name">Plakat Akrilik</span>
                                    <span class="uv-item-desc">Premium Award</span>
                                    <span class="uv-item-price">Rp 50.000</span>
                                </div>
                            </div>
                            <div class="uv-item-option" data-value="gantungan_kunci" data-price="8000">
                                <div class="uv-item-icon">
                                    <i class="bi bi-key"></i>
                                </div>
                                <div class="uv-item-info">
                                    <span class="uv-item-name">Gantungan Kunci</span>
                                    <span class="uv-item-desc">Custom Keychain</span>
                                    <span class="uv-item-price">Rp 8.000</span>
                                </div>
                            </div>
                            <div class="uv-item-option" data-value="media_flatbed" data-price="25000">
                                <div class="uv-item-icon">
                                    <i class="bi bi-grid-3x3"></i>
                                </div>
                                <div class="uv-item-info">
                                    <span class="uv-item-name">Media Flatbed</span>
                                    <span class="uv-item-desc">Lainnya</span>
                                    <span class="uv-item-price">Rp 25.000</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="uv_item_type" id="uvItemType" required>
                    </div>
                    
                    <!-- Printing Side -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-layers text-success me-2"></i>
                            <span class="label-text">Sisi Cetak</span>
                        </label>
                        <div class="paper-grid">
                            <div class="paper-option selected" data-value="1_sisi" data-price="0">
                                <div class="paper-badge">1</div>
                                <div class="paper-info">
                                    <span class="paper-name">1 Sisi</span>
                                    <span class="paper-weight">Satu Sisi</span>
                                    <span class="paper-price">Harga Normal</span>
                                </div>
                            </div>
                            <div class="paper-option" data-value="2_sisi" data-price="15000">
                                <div class="paper-badge">2</div>
                                <div class="paper-info">
                                    <span class="paper-name">2 Sisi</span>
                                    <span class="paper-weight">Dua Sisi</span>
                                    <span class="paper-price">+Rp 15.000</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="printing_side" id="printingSide" value="1_sisi" required>
                    </div>
                    
                    <!-- Note for Custom Dimensions -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-info-circle text-info me-2"></i>
                            <span class="label-text">Catatan Khusus</span>
                        </label>
                        <div class="textarea-wrapper">
                            <textarea name="notes" id="notes" class="form-control enhanced-textarea" placeholder="Contoh: Untuk Casing HP iPhone 13 Pro, desain di bagian belakang, ada cetak putih di bawah warna" rows="4"></textarea>
                            <div class="textarea-footer">
                                <small class="char-count text-muted">Maksimal 500 karakter</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-calculator text-info me-2"></i>
                            <span class="label-text">Jumlah (pcs)</span>
                        </label>
                        <div class="quantity-wrapper">
                            <button type="button" class="quantity-btn minus" data-action="decrease">-</button>
                            <input type="number" name="quantity" id="quantity" class="quantity-input" min="1" value="1" required>
                            <button type="button" class="quantity-btn plus" data-action="increase">+</button>
                        </div>
                        <div class="quantity-info">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Tidak ada minimum order
                            </small>
                        </div>
                    </div>
                    
                    <!-- File Upload -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-cloud-upload text-info me-2"></i>
                            <span class="label-text">Upload File Desain</span>
                        </label>
                        <div class="upload-area" onclick="document.getElementById('designFile').click()">
                            <div class="upload-icon">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>
                            <div class="upload-text">
                                <span class="upload-title">Klik untuk upload file desain</span>
                                <span class="upload-subtitle">atau drag & drop file di sini</span>
                            </div>
                            <input type="file" name="design_file" id="designFile" class="file-input" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd,.cdr">
                        </div>
                        <div class="upload-info">
                            <small class="text-muted">
                                📁 Format: JPG, PNG, PDF, AI, PSD, CDR | 💾 Max: 10MB
                            </small>
                        </div>
                    </div>
                    
                    <!-- Custom Dimensions -->
                    <div id="customDimensions" class="form-group" style="display: none;">
                        <label class="form-label">
                            <i class="bi bi-aspect-ratio text-warning me-2"></i>
                            <span class="label-text">Ukuran Custom</span>
                        </label>
                        <div class="dimension-inputs">
                            <div class="dimension-group">
                                <label class="dimension-label">Lebar</label>
                                <div class="input-with-unit">
                                    <input type="number" name="custom_width" id="customWidth" class="form-control" placeholder="21">
                                    <span class="input-unit">cm</span>
                                </div>
                            </div>
                            <div class="dimension-separator">×</div>
                            <div class="dimension-group">
                                <label class="dimension-label">Tinggi</label>
                                <div class="input-with-unit">
                                    <input type="number" name="custom_height" id="customHeight" class="form-control" placeholder="29.7">
                                    <span class="input-unit">cm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-chat-left-text text-secondary me-2"></i>
                            <span class="label-text">Catatan Khusus (Opsional)</span>
                        </label>
                        <div class="textarea-wrapper">
                            <textarea name="notes" id="notes" class="form-control enhanced-textarea" rows="4" placeholder="Tuliskan instruksi khusus, permintaan warna, atau detail lainnya..."></textarea>
                            <div class="textarea-footer">
                                <span class="char-count">0/500 karakter</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Customer Information -->
                    <hr class="my-4">
                    <h5 class="mb-3"><i class="bi bi-person text-primary me-2"></i>Informasi Kontak</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="customer_name" id="customerName" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="tel" name="customer_phone" id="customerPhone" class="form-control" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="customer_email" id="customerEmail" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea name="customer_address" id="customerAddress" class="form-control" rows="2" required></textarea>
                    </div>
                    
                    <!-- Shipping -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Metode Pengiriman</label>
                        <select name="shipping_method" id="shippingMethod" class="form-select" required>
                            <option value="">Pilih metode pengiriman</option>
                            <option value="pickup" data-cost="0">Ambil Sendiri (Gratis)</option>
                            <option value="local" data-cost="15000">Pengiriman Lokal Gresik (Rp 15.000)</option>
                            <option value="regional" data-cost="25000">Pengiriman Regional Jatim (Rp 25.000)</option>
                            <option value="national" data-cost="50000">Pengiriman Nasional (Rp 50.000)</option>
                            <option value="express" data-cost="75000">Express Same Day (Rp 75.000)</option>
                        </select>
                    </div>
                    
                    <!-- Promo Code -->
                    <div class="promo-section">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-gift me-2"></i>
                            <strong style="font-size: 1.1rem;">Punya Kode Promo?</strong>
                        </div>
                        <div class="input-group">
                            <input type="text" name="promo_code" id="promoCode" class="form-control" placeholder="Masukkan kode promo...">
                            <button type="button" id="applyPromo" class="btn btn-success">
                                <i class="bi bi-check-circle me-1"></i>Gunakan
                            </button>
                            <button type="button" id="resetPromo" class="btn btn-outline-danger" style="display: none;">
                                <i class="bi bi-arrow-clockwise me-1"></i>Reset
                            </button>
                        </div>
                        <div id="promoFeedback" class="mt-3" style="display: none;">
                            <!-- Feedback akan muncul di sini -->
                        </div>
                        <small class="d-block mt-3">
                            <i class="bi bi-info-circle me-1"></i>
                            Kode tersedia: <strong>HEMAT10</strong>, <strong>NEWUSER15</strong>, <strong>GRATIS50</strong>
                        </small>
                    </div>
                    
                    <!-- Hidden pricing inputs for checkout -->
                    <input type="hidden" name="total_price" id="totalPriceInput">
                    <input type="hidden" name="service_type" value="uv_printing">
                    <input type="hidden" name="product_type" value="uv_printing">
                    <input type="hidden" name="unit_price" id="unitPriceInput">
                    <input type="hidden" name="subtotal" id="subtotalInput">
                    <input type="hidden" name="shipping_cost" id="shippingCostInput">
                    <input type="hidden" name="tax_amount" id="taxAmountInput">
                    <input type="hidden" name="discount" id="discountInput">
                    <input type="hidden" name="total" id="totalInput">
                    
                </form>
            </div>
        </div>
        
        <!-- Price Summary -->
        <div class="row mt-4">
            <div class="col-lg-6 offset-lg-6">
                <div class="price-breakdown">
                    <h5 class="mb-3"><i class="bi bi-calculator text-success me-2"></i>Ringkasan Harga</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span>Harga Dasar:</span>
                        <span id="basePrice">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Jumlah:</span>
                        <span id="quantityDisplay">0 pcs</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Biaya Tambahan:</span>
                        <span id="additionalCost">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2" id="discountRow" style="display: none;">
                        <span>Diskon:</span>
                        <span id="discount" class="text-success">- Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Ongkos Kirim:</span>
                        <span id="shippingCost">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Pajak (11%):</span>
                        <span id="tax">Rp 0</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong class="fs-5">Total:</strong>
                        <strong class="fs-4 text-primary" id="totalPrice">Rp 0</strong>
                    </div>
                    
                    <button type="button" id="placeOrder" class="btn btn-primary btn-lg w-100 mt-3">
                        <i class="bi bi-cart-check me-2"></i>Lanjutkan ke Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Gallery Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 fade-in">
            <h3 class="fw-bold">Portfolio Hasil Kerja</h3>
            <p class="text-muted">Lihat hasil UV Printing berkualitas dari RNR Digital Printing</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-credit-card-2-front portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>ID Card PVC</h5>
                                <p>Cetak UV premium, tahan lama</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-phone portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Custom Casing HP</h5>
                                <p>Personalisasi dengan UV printing</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-award portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Plakat Akrilik</h5>
                                <p>UV printing dengan varnish spot</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Customer Testimonials -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5 fade-in">
            <h3 class="fw-bold">Testimoni Pelanggan</h3>
            <p class="text-muted">Kepuasan pelanggan adalah prioritas utama kami</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 fade-in">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="testimonial-info">
                            <h6>Andi Pratama</h6>
                            <small>Event Organizer</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "ID Card event kami dicetak dengan UV printing sangat berkualitas! Tahan air dan tidak mudah pudar. Recommended!"
                    </div>
                </div>
            </div>
            <div class="col-lg-4 fade-in">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="testimonial-info">
                            <h6>Lisa Permata</h6>
                            <small>Pemilik Cafe</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Casing HP custom untuk merchandise cafe sangat bagus! Cetakan UV nya awet dan warna sangat vibrant."
                    </div>
                </div>
            </div>
            <div class="col-lg-4 fade-in">
                <div class="testimonial-card">
                    <div class="testimonial-header">
                        <div class="testimonial-avatar">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="testimonial-info">
                            <h6>Dimas Arya</h6>
                            <small>HRD Manager</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Plakat akrilik untuk penghargaan karyawan hasilnya premium! UV printing memberikan efek yang elegant."
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Steps -->
<section class="py-5" style="padding-top: 4rem !important;">
    <div class="container">
        <div class="text-center mb-5 fade-in">
            <h3 class="fw-bold">Proses Pemesanan</h3>
            <p class="text-muted">Langkah mudah untuk memesan UV Printing berkualitas</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">1</div>
                    <div class="process-icon">
                        <i class="bi bi-printer"></i>
                    </div>
                    <h5>Pilih Item</h5>
                    <p>Pilih jenis item UV printing dan sisi cetak yang diinginkan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">2</div>
                    <div class="process-icon">
                        <i class="bi bi-cloud-upload"></i>
                    </div>
                    <h5>Upload Desain</h5>
                    <p>Upload file desain dengan format vektor untuk hasil terbaik</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">3</div>
                    <div class="process-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <h5>Konfirmasi & Bayar</h5>
                    <p>Konfirmasi pesanan dan lakukan pembayaran</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">4</div>
                    <div class="process-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h5>Cetak & Kirim</h5>
                    <p>Proses UV printing dan pengiriman sesuai jadwal</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-light">
    <div class="container">
        <h3 class="text-center mb-4">Frequently Asked Questions</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Berapa lama waktu pengerjaan UV printing?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Untuk UV printing regular, waktu pengerjaan 2-3 hari kerja. Untuk pesanan express, bisa diselesaikan dalam 24-48 jam dengan tambahan biaya.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Media apa saja yang bisa dicetak dengan UV?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Kami bisa mencetak pada berbagai media seperti PVC, akrilik, kayu, metal, plastik, kulit, keramik, dan media keras lainnya yang tidak bisa dicetak dengan printer biasa.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apakah hasil UV printing tahan lama?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, UV printing sangat tahan lama. Hasil cetakan tahan air, tahan gores, anti UV, dan tidak mudah pudar meskipun terkena cuaca atau sinar matahari langsung.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Simple selection functions
function selectPrintingSide(element, value) {
    console.log('Printing side selected:', value);
    
    // Remove selected from all printing side options
    document.querySelectorAll('.paper-option').forEach(opt => {
        opt.classList.remove('selected');
    });
    
    // Add selected to clicked element
    element.classList.add('selected');
    
    // Update hidden input
    document.getElementById('printingSide').value = value;
    
    // Recalculate price
    calculatePrice();
}

function selectUvItem(element, value) {
    console.log('UV item selected:', value);
    
    // Update select value
    document.getElementById('uvItemType').value = value;
    
    // Recalculate price
    calculatePrice();
}

// Initialize form interactions
function initializeFormInteractions() {
    console.log('Initializing form interactions...');
    
    // Paper selection interaction
    const paperOptions = document.querySelectorAll('.paper-option');
    console.log('Found paper options:', paperOptions.length);
    
    paperOptions.forEach(option => {
        option.addEventListener('click', function() {
            console.log('Paper option clicked:', this.dataset.value);
            
            // Remove selected class from all options
            document.querySelectorAll('.paper-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Update hidden input
            const paperTypeInput = document.getElementById('paperType');
            if (paperTypeInput) {
                paperTypeInput.value = this.dataset.value;
                console.log('Updated paperType input to:', this.dataset.value);
            }
            
            // Recalculate price
            calculatePrice();
        });
    });
    
    // Printing side selection interaction
    const printingSideOptions = document.querySelectorAll('.paper-option');
    console.log('Found printing side options:', printingSideOptions.length);
    
    printingSideOptions.forEach(option => {
        option.addEventListener('click', function() {
            console.log('Printing side option clicked:', this.dataset.value);
            
            // Remove selected class from all options
            document.querySelectorAll('.paper-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Update hidden input
            const printingSideInput = document.getElementById('printingSide');
            if (printingSideInput) {
                printingSideInput.value = this.dataset.value;
                console.log('Updated printing side input to:', this.dataset.value);
            }
            
            // Recalculate price
            calculatePrice();
        });
    });
    
    // UV Item Selection
    const uvItemOptions = document.querySelectorAll('.uv-item-option');
    const uvItemTypeInput = document.getElementById('uvItemType');
    
    uvItemOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all options
            uvItemOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Update hidden input value
            if (uvItemTypeInput) {
                uvItemTypeInput.value = this.getAttribute('data-value');
            }
            
            // Recalculate price
            calculatePrice();
        });
    });
    
    // Quantity controls
    const quantityInput = document.getElementById('quantity');
    const decreaseBtn = document.querySelector('.quantity-btn[data-action="decrease"]');
    const increaseBtn = document.querySelector('.quantity-btn[data-action="increase"]');
    
    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
                calculatePrice();
            }
        });
    }
    
    if (increaseBtn) {
        increaseBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value) || 1;
            quantityInput.value = currentValue + 1;
            calculatePrice();
        });
    }
    
    if (quantityInput) {
        quantityInput.addEventListener('input', function() {
            if (this.value < 1) this.value = 1;
            calculatePrice();
        });
    }
    
    // File upload interaction
    const dropZone = document.querySelector('.upload-area');
    const fileInput = document.getElementById('designFile');
    
    if (dropZone && fileInput) {
        // Click to upload (already handled by onclick in HTML)
        
        // File selection
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                updateFileInfo(this.files[0]);
            }
        });
        
        // Drag and drop
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            this.classList.add('dragover');
        });
        
        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
        });
        
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            this.classList.remove('dragover');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                updateFileInfo(files[0]);
            }
        });
    }
    
    // Promo code application
    const applyPromoBtn = document.getElementById('applyPromo');
    console.log('Found apply promo button:', applyPromoBtn); // Debug
    if (applyPromoBtn) {
        applyPromoBtn.addEventListener('click', function(e) {
            console.log('Apply promo button clicked!'); // Debug
            e.preventDefault();
            applyPromoCode();
        });
    } else {
        console.error('Apply promo button not found!');
    }
    
    // Promo code reset
    const resetPromoBtn = document.getElementById('resetPromo');
    if (resetPromoBtn) {
        resetPromoBtn.addEventListener('click', function(e) {
            console.log('Reset promo button clicked!'); // Debug
            e.preventDefault();
            resetPromoCode();
        });
    }
    
    // Shipping method change
    const shippingMethodSelect = document.getElementById('shippingMethod');
    if (shippingMethodSelect) {
        shippingMethodSelect.addEventListener('change', function() {
            calculatePrice();
        });
    }
    
    // UV item type change
    const uvItemTypeSelect = document.getElementById('uvItemType');
    if (uvItemTypeSelect) {
        uvItemTypeSelect.addEventListener('change', function() {
            calculatePrice();
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize file upload
    initializeFileUpload();
    
    // Initialize form interactions
    initializeFormInteractions();
    
    // Initialize order button
    initializeOrderButton();
    
    // Initial price calculation
    calculatePrice();
    
    // BACKUP: Direct promo button listener
    console.log('Setting up backup promo button listener...');
    setTimeout(function() {
        const promoBtn = document.getElementById('applyPromo');
        console.log('Backup check - promo button found:', promoBtn);
        if (promoBtn) {
            // Remove any existing listeners and add new one
            const newBtn = promoBtn.cloneNode(true);
            promoBtn.parentNode.replaceChild(newBtn, promoBtn);
            
            newBtn.addEventListener('click', function(e) {
                console.log('BACKUP: Promo button clicked via backup listener!');
                e.preventDefault();
                e.stopPropagation();
                
                // Call promo function directly
                const promoInput = document.getElementById('promoCode');
                const feedback = document.getElementById('promoFeedback');
                
                if (!promoInput) {
                    console.error('Promo input not found');
                    return;
                }
                
                const code = promoInput.value.trim().toUpperCase();
                console.log('Processing promo code:', code);
                
                const promoCodes = {
                    'HEMAT10': { type: 'percentage', value: 0.10, description: 'Diskon 10%' },
                    'NEWUSER15': { type: 'percentage', value: 0.15, description: 'Diskon 15% User Baru' },
                    'GRATIS50': { type: 'fixed', value: 50000, description: 'Gratis Ongkir Rp 50.000' }
                };
                
                if (promoCodes[code]) {
                    console.log('Valid promo code!');
                    window.appliedPromo = promoCodes[code];
                    promoInput.disabled = true;
                    newBtn.textContent = 'Terapkan';
                    newBtn.disabled = true;
                    newBtn.classList.add('btn-success');
                    
                    // Show reset button
                    const resetBtn = document.getElementById('resetPromo');
                    if (resetBtn) resetBtn.style.display = 'inline-block';
                    
                    // Show success feedback
                    if (feedback) {
                        feedback.innerHTML = `<small class="text-success"><i class="bi bi-check-circle me-1"></i>Berhasil digunakan! ${promoCodes[code].description}</small>`;
                        feedback.style.display = 'block';
                    }
                    
                    calculatePrice();
                } else {
                    console.log('Invalid promo code');
                    if (feedback) {
                        feedback.innerHTML = `<small class="text-danger"><i class="bi bi-x-circle me-1"></i>Kode promo tidak valid atau sudah expired</small>`;
                        feedback.style.display = 'block';
                    }
                }
            });
        }
    }, 500);
    
    console.log('UV Printing form initialized successfully');
    
    // Fade in animation on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);
    
    // Observe all fade-in elements
    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
});

// Initialize file upload functionality
function initializeFileUpload() {
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.getElementById('designFile');
    
    if (!uploadArea || !fileInput) return;
    
    // Click to upload
    uploadArea.addEventListener('click', function() {
        fileInput.click();
    });
    
    // File input change
    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            updateFileInfo(file);
        }
    });
    
    // Drag and drop functionality
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('drag-over');
    });
    
    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('drag-over');
    });
    
    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('drag-over');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            fileInput.files = files;
            updateFileInfo(file);
        }
    });
}

// Update file information display
function updateFileInfo(file) {
    const uploadArea = document.querySelector('.upload-area');
    const uploadInfo = document.querySelector('.upload-info');
    
    if (uploadArea && uploadInfo) {
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        
        // Replace upload area with file info
        uploadArea.innerHTML = `
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-check text-success me-2" style="font-size: 1.5rem;"></i>
                    <div>
                        <strong>${file.name}</strong>
                        <div class="text-muted small">${fileSize} MB</div>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile()">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        `;
        uploadArea.classList.add('file-uploaded');
    }
}

// Remove uploaded file
function removeFile() {
    const fileInput = document.getElementById('designFile');
    const uploadArea = document.querySelector('.upload-area');
    
    if (fileInput) fileInput.value = '';
    
    if (uploadArea) {
        uploadArea.innerHTML = `
            <div class="upload-icon">
                <i class="bi bi-cloud-arrow-up"></i>
            </div>
            <div class="upload-text">
                <span class="upload-title">Klik untuk upload file desain</span>
                <span class="upload-subtitle">atau drag & drop file di sini</span>
            </div>
        `;
        uploadArea.classList.remove('file-uploaded');
    }
}

// Update hidden pricing inputs for checkout
function updateHiddenPricingInputs(unitPrice, subtotal, shippingCost, taxAmount, discount, total) {
    const unitPriceInput = document.getElementById('unitPriceInput');
    const subtotalInput = document.getElementById('subtotalInput');
    const shippingCostInput = document.getElementById('shippingCostInput');
    const taxAmountInput = document.getElementById('taxAmountInput');
    const discountInput = document.getElementById('discountInput');
    const totalInput = document.getElementById('totalInput');
    const totalPriceInput = document.getElementById('totalPriceInput');
    
    if (unitPriceInput) unitPriceInput.value = unitPrice;
    if (subtotalInput) subtotalInput.value = subtotal;
    if (shippingCostInput) shippingCostInput.value = shippingCost;
    if (taxAmountInput) taxAmountInput.value = taxAmount;
    if (discountInput) discountInput.value = discount;
    if (totalInput) totalInput.value = total;
    if (totalPriceInput) totalPriceInput.value = total;
}

// Form validation
function validateForm() {
    const uvItemType = document.getElementById('uvItemType');
    const printingSideSelected = document.querySelector('.paper-option.selected'); // Reusing class for printing side
    const quantity = document.getElementById('quantity');
    const customerName = document.getElementById('customerName');
    const customerEmail = document.getElementById('customerEmail');
    const customerPhone = document.getElementById('customerPhone');
    
    let isValid = true;
    let errors = [];
    
    if (!uvItemType || !uvItemType.value) {
        errors.push('Pilih jenis item UV printing');
        isValid = false;
    }
    
    if (!printingSideSelected) {
        errors.push('Pilih sisi printing');
        isValid = false;
    }
    
    if (!quantity || quantity.value < 1) {
        errors.push('Masukkan jumlah yang valid');
        isValid = false;
    }
    
    if (!customerName || !customerName.value.trim()) {
        errors.push('Masukkan nama lengkap');
        isValid = false;
    }
    
    if (!customerEmail || !customerEmail.value.trim()) {
        errors.push('Masukkan email');
        isValid = false;
    }
    
    if (!customerPhone || !customerPhone.value.trim()) {
        errors.push('Masukkan nomor telepon');
        isValid = false;
    }
    
    if (!isValid) {
        showAlert('error', 'Lengkapi semua field yang diperlukan:\n• ' + errors.join('\n• '));
    }
    
    return isValid;
}

// Show alert messages
function showAlert(type, message) {
    const alertContainer = document.getElementById('alertContainer') || createAlertContainer();
    
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'error' ? 'danger' : 'success'} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        <strong>${type === 'error' ? 'Error!' : 'Berhasil!'}</strong> ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    alertContainer.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentElement) {
            alertDiv.remove();
        }
    }, 5000);
}

// Create alert container if not exists
function createAlertContainer() {
    const container = document.createElement('div');
    container.id = 'alertContainer';
    container.style.cssText = 'position: fixed; top: 20px; right: 20px; z-index: 9999; max-width: 400px;';
    document.body.appendChild(container);
    return container;
}

// Show success message on form submission
function showSuccessMessage() {
    showAlert('success', 'Pesanan berhasil dikirim! Kami akan menghubungi Anda segera.');
    
    // Reset form after success
    setTimeout(() => {
        resetForm();
    }, 2000);
}

// Reset form to initial state
function resetForm() {
    const form = document.getElementById('orderForm');
    if (form) {
        form.reset();
    }
    
    // Reset all selections
    document.querySelectorAll('.paper-option.selected').forEach(el => el.classList.remove('selected'));
    
    // Reset file upload
    removeFile();
    
    // Reset promo code
    const promoInput = document.getElementById('promoCode');
    const applyBtn = document.getElementById('applyPromo');
    if (promoInput) {
        promoInput.disabled = false;
        promoInput.value = '';
    }
    if (applyBtn) {
        applyBtn.disabled = false;
        applyBtn.textContent = 'Terapkan';
    }
    window.appliedPromo = null;
    
    // Reset hidden inputs
    const printingSideInput = document.getElementById('printingSide');
    if (printingSideInput) printingSideInput.value = '';
    
    // Reset price display
    updatePriceDisplay(0, 0, 0, 0, 0, 0, 0);
    updateHiddenPricingInputs(0, 0, 0, 0, 0, 0);
    
    // Disable order button
    const orderBtn = document.getElementById('placeOrder');
    if (orderBtn) orderBtn.disabled = true;
}

// Initialize order button functionality
function initializeOrderButton() {
    const orderBtn = document.getElementById('placeOrder');
    if (!orderBtn) return;
    
    orderBtn.addEventListener('click', function() {
        if (!validateForm()) return;
        
        // Get all form data
        const formData = collectFormData();
        
        // Prepare order data for checkout
        const orderData = {
            service_type: 'uv_printing',
            product_type: 'uv_printing',
            uv_item_type: formData.uvItemType,
            printing_side: formData.printingSide,
            quantity: parseInt(formData.quantity),
            unit_price: calculateUnitPrice(),
            subtotal: calculateSubtotal(),
            shipping_cost: calculateShippingCost(),
            tax_amount: calculateTaxAmount(),
            discount: calculateDiscount(),
            total: calculateTotal(),
            shipping_method: formData.shippingMethod,
            promo_code: window.appliedPromo ? formData.promoCode : null,
            customer_name: formData.customerName,
            customer_email: formData.customerEmail,
            customer_phone: formData.customerPhone,
            customer_address: formData.customerAddress,
            notes: formData.notes
        };
        
        // Update hidden inputs
        document.getElementById('unitPriceInput').value = orderData.unit_price;
        document.getElementById('subtotalInput').value = orderData.subtotal;
        document.getElementById('shippingCostInput').value = orderData.shipping_cost;
        document.getElementById('taxAmountInput').value = orderData.tax_amount;
        document.getElementById('discountInput').value = orderData.discount;
        document.getElementById('totalInput').value = orderData.total;
        
        // Create form and submit to checkout
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("checkout.store") }}';
        
        // Add CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = csrfToken.getAttribute('content');
            form.appendChild(csrfInput);
        }
        
        // Add order data
        for (const [key, value] of Object.entries(orderData)) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            form.appendChild(input);
        }
        
        document.body.appendChild(form);
        form.submit();
    });
}

// Helper functions for price calculation
function calculateUnitPrice() {
    const uvItemType = document.getElementById('uvItemType');
    const selectedPrintingSide = document.querySelector('.paper-option.selected');
    
    let basePrice = 7000; // Default base price for UV printing
    
    // UV Item type base prices
    const uvItemPrices = {
        'id_card': 7000,
        'lanyard': 15000,
        'tiket_gelang': 4000,
        'casing_hp': 30000,
        'plakat_akrilik': 50000,
        'gantungan_kunci': 8000,
        'media_flatbed': 25000
    };
    
    if (uvItemType && uvItemType.value) {
        basePrice = uvItemPrices[uvItemType.value] || 7000;
    }
    
    // Printing side additional cost
    let printingSideCost = selectedPrintingSide ? parseInt(selectedPrintingSide.dataset.price) || 0 : 0;
    
    return basePrice + printingSideCost;
}

function calculateSubtotal() {
    const quantity = document.getElementById('quantity');
    const qty = parseInt(quantity?.value) || 1;
    return calculateUnitPrice() * qty;
}

function calculateShippingCost() {
    const shippingMethod = document.getElementById('shippingMethod');
    const shippingCosts = {
        'pickup': 0, 'local': 15000, 'regional': 25000,
        'national': 50000, 'express': 75000
    };
    return shippingMethod ? shippingCosts[shippingMethod.value] || 0 : 0;
}

function calculateDiscount() {
    if (!window.appliedPromo) return 0;
    
    const subtotal = calculateSubtotal();
    const finishingCost = calculateFinishingCost();
    const baseTotal = subtotal + finishingCost;
    
    if (window.appliedPromo.type === 'percentage') {
        return baseTotal * window.appliedPromo.value;
    } else if (window.appliedPromo.type === 'fixed') {
        const shippingCost = calculateShippingCost();
        return Math.min(window.appliedPromo.value, shippingCost);
    }
    return 0;
}

function calculateFinishingCost() {
    // UV printing doesn't have finishing cost, only printing side cost included in base price
    return 0;
}

function calculateTaxAmount() {
    const subtotal = calculateSubtotal();
    const finishingCost = calculateFinishingCost();
    const discount = calculateDiscount();
    const shippingCost = calculateShippingCost();
    const baseTotal = subtotal + finishingCost;
    return (baseTotal - discount + shippingCost) * 0.11;
}

function calculateTotal() {
    const subtotal = calculateSubtotal();
    const finishingCost = calculateFinishingCost();
    const discount = calculateDiscount();
    const shippingCost = calculateShippingCost();
    const taxAmount = calculateTaxAmount();
    return subtotal + finishingCost - discount + shippingCost + taxAmount;
}

// Collect all form data
function collectFormData() {
    const uvItemType = document.getElementById('uvItemType');
    const printingSideSelected = document.querySelector('.paper-option.selected'); // Reusing class for printing side
    const quantity = document.getElementById('quantity');
    const shippingMethod = document.getElementById('shippingMethod');
    const customerName = document.getElementById('customerName');
    const customerEmail = document.getElementById('customerEmail');
    const customerPhone = document.getElementById('customerPhone');
    const customerAddress = document.getElementById('customerAddress');
    const notes = document.getElementById('notes');
    const promoCode = document.getElementById('promoCode');
    
    return {
        uvItemType: uvItemType?.value || '',
        printingSide: printingSideSelected?.textContent?.trim() || '',
        quantity: quantity?.value || '1',
        shippingMethod: shippingMethod?.value || '',
        customerName: customerName?.value || '',
        customerEmail: customerEmail?.value || '',
        customerPhone: customerPhone?.value || '',
        customerAddress: customerAddress?.value || '',
        notes: notes?.value || '',
        promoCode: promoCode?.value || '',
        totalPrice: document.getElementById('totalPrice')?.textContent || ''
    };
}

// Create WhatsApp message
function createWhatsAppMessage(data) {
    return `*PESANAN UV PRINTING*

*Detail Pesanan:*
�️ Jenis Item: ${data.uvItemType}
� Sisi Printing: ${data.printingSide}
🔢 Jumlah: ${data.quantity} pcs
🚚 Pengiriman: ${data.shippingMethod}

*Detail Pelanggan:*
👤 Nama: ${data.customerName}
📧 Email: ${data.customerEmail}
📱 Telepon: ${data.customerPhone}
🏠 Alamat: ${data.customerAddress}

${data.notes ? `*Catatan:*\n${data.notes}\n` : ''}
${data.promoCode ? `*Kode Promo:* ${data.promoCode}\n` : ''}
*Total Harga: ${data.totalPrice}*

Terima kasih telah mempercayai layanan UV Printing kami! 🙏`;
}

// Check if form is valid for submission
function checkFormValid() {
    const uvItemType = document.getElementById('uvItemType');
    const selectedUvItem = document.querySelector('.uv-item-option.selected');
    const printingSideSelected = document.querySelector('.paper-option.selected');
    const quantity = document.getElementById('quantity');
    const submitBtn = document.getElementById('submitOrder');
    
    const isValid = (uvItemType?.value || selectedUvItem) && 
                   printingSideSelected && 
                   quantity?.value && 
                   parseInt(quantity.value) > 0;
    
    if (submitBtn) {
        submitBtn.disabled = !isValid;
    }
    
    return isValid;
}

// Price calculation function
function calculatePrice() {
    const quantity = document.getElementById('quantity');
    const uvItemType = document.getElementById('uvItemType');
    const shippingMethod = document.getElementById('shippingMethod');
    
    if (!quantity || !quantity.value || quantity.value < 1) {
        updatePriceDisplay(0, 0, 0, 0, 0, 0, 0);
        updateHiddenPricingInputs(0, 0, 0, 0, 0, 0);
        return;
    }
    
    let basePrice = 7000; // Default base price per piece for UV printing
    let qty = parseInt(quantity.value);
    
    // Get selected UV item from card selection
    const selectedUvItem = document.querySelector('.uv-item-option.selected');
    
    if (selectedUvItem) {
        basePrice = parseInt(selectedUvItem.getAttribute('data-price')) || 7000;
    } else if (uvItemType && uvItemType.value) {
        // Fallback to hidden input value
        const uvItemPrices = {
            'id_card': 7000,
            'lanyard': 15000,
            'tiket_gelang': 4000,
            'casing_hp': 30000,
            'plakat_akrilik': 50000,
            'gantungan_kunci': 8000,
            'media_flatbed': 25000
        };
        basePrice = uvItemPrices[uvItemType.value] || 7000;
    }
    
    // Printing side addition
    const selectedPrintingSide = document.querySelector('.paper-option.selected');
    let printingSideCost = 0;
    if (selectedPrintingSide) {
        printingSideCost = parseInt(selectedPrintingSide.dataset.price) || 0;
    }
    
    // Calculate base prices
    let itemPrice = basePrice + printingSideCost;
    let subtotal = itemPrice * qty;
    let baseTotal = subtotal;
    
    // Shipping cost
    let shippingCost = 0;
    if (shippingMethod && shippingMethod.value) {
        const shippingCosts = {
            'pickup': 0,
            'local': 15000,
            'regional': 25000,
            'national': 50000,
            'express': 75000
        };
        shippingCost = shippingCosts[shippingMethod.value] || 0;
    }
    
    // Apply promo discount
    let discount = 0;
    if (window.appliedPromo) {
        if (window.appliedPromo.type === 'percentage') {
            discount = baseTotal * window.appliedPromo.value;
        } else if (window.appliedPromo.type === 'fixed') {
            discount = Math.min(window.appliedPromo.value, shippingCost);
            if (window.appliedPromo.value >= shippingCost) {
                shippingCost = 0;
                discount = window.appliedPromo.value;
            }
        }
    }
    
    // Tax calculation (11% PPN)
    let taxAmount = (baseTotal - discount + shippingCost) * 0.11;
    
    // Final total
    let total = baseTotal - discount + shippingCost + taxAmount;
    
    // Update price display
    updatePriceDisplay(baseTotal, subtotal, 0, discount, shippingCost, taxAmount, total);
    
    // Update hidden pricing inputs
    updateHiddenPricingInputs(baseTotal / qty, subtotal, shippingCost, taxAmount, discount, total);
}

// Update price display function
function updatePriceDisplay(baseTotal, subtotal, finishingCost, discount, shippingCost, taxAmount, total) {
    const quantity = document.getElementById('quantity');
    const qty = parseInt(quantity?.value) || 1;
    
    // Update quantity display
    const quantityDisplay = document.getElementById('quantityDisplay');
    if (quantityDisplay) quantityDisplay.textContent = qty + ' pcs';
    
    // Update base price
    const basePriceEl = document.getElementById('basePrice');
    if (basePriceEl) basePriceEl.textContent = formatCurrency(subtotal);
    
    // Update additional costs (UV printing side cost)
    const additionalCostEl = document.getElementById('additionalCost');
    if (additionalCostEl) additionalCostEl.textContent = formatCurrency(0); // No additional finishing for UV printing
    
    // Update subtotal
    const subtotalEl = document.getElementById('subtotal');
    if (subtotalEl) subtotalEl.textContent = formatCurrency(baseTotal);
    
    // Update discount
    const discountRow = document.getElementById('discountRow');
    const discountEl = document.getElementById('discount');
    
    if (discount > 0) {
        if (discountRow) {
            discountRow.style.display = 'flex';
        }
        if (discountEl) {
            discountEl.textContent = '- ' + formatCurrency(discount);
        }
    } else {
        if (discountRow) discountRow.style.display = 'none';
    }
    
    // Update shipping cost
    const shippingCostEl = document.getElementById('shippingCost');
    if (shippingCostEl) shippingCostEl.textContent = formatCurrency(shippingCost);
    
    // Update tax
    const taxEl = document.getElementById('tax');
    if (taxEl) taxEl.textContent = formatCurrency(taxAmount);
    
    // Update total
    const totalEl = document.getElementById('totalPrice');
    if (totalEl) totalEl.textContent = formatCurrency(total);
    
    // Update hidden total price input for form submission
    const totalPriceInput = document.getElementById('totalPriceInput');
    if (totalPriceInput) totalPriceInput.value = total;
    
    // Enable/disable order button
    checkFormValid();
}

// Format currency function
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
}

// Apply promo code
function applyPromoCode() {
    console.log('applyPromoCode called'); // Debug
    const promoInput = document.getElementById('promoCode');
    const applyBtn = document.getElementById('applyPromo');
    const feedback = document.getElementById('promoFeedback');
    
    console.log('Elements found:', { promoInput, applyBtn, feedback }); // Debug
    
    if (!promoInput || !applyBtn) {
        console.error('Required elements not found');
        return;
    }
    
    const code = promoInput.value.trim().toUpperCase();
    console.log('Promo code entered:', code); // Debug
    
    const promoCodes = {
        'HEMAT10': { type: 'percentage', value: 0.10, description: 'Diskon 10%' },
        'NEWUSER15': { type: 'percentage', value: 0.15, description: 'Diskon 15% User Baru' },
        'GRATIS50': { type: 'fixed', value: 50000, description: 'Gratis Ongkir Rp 50.000' }
    };
    
    if (promoCodes[code]) {
        console.log('Valid promo code found'); // Debug
        window.appliedPromo = promoCodes[code];
        promoInput.disabled = true;
        applyBtn.textContent = 'Terapkan';
        applyBtn.disabled = true;
        applyBtn.classList.add('btn-success');
        applyBtn.classList.remove('btn-light');
        
        // Show reset button
        const resetBtn = document.getElementById('resetPromo');
        if (resetBtn) {
            resetBtn.style.display = 'inline-block';
        }
        
        // Show success feedback
        if (feedback) {
            feedback.innerHTML = `<small class="text-success"><i class="bi bi-check-circle me-1"></i>Berhasil digunakan! ${promoCodes[code].description}</small>`;
            feedback.style.display = 'block';
        }
        
        calculatePrice();
    } else {
        console.log('Invalid promo code'); // Debug
        // Show error feedback
        if (feedback) {
            feedback.innerHTML = `<small class="text-danger"><i class="bi bi-x-circle me-1"></i>Kode promo tidak valid atau sudah expired</small>`;
            feedback.style.display = 'block';
        }
    }
}

// Reset promo code
function resetPromoCode() {
    const promoInput = document.getElementById('promoCode');
    const applyBtn = document.getElementById('applyPromo');
    const resetBtn = document.getElementById('resetPromo');
    const feedback = document.getElementById('promoFeedback');
    
    // Reset promo state
    window.appliedPromo = null;
    
    // Reset UI elements
    if (promoInput) {
        promoInput.disabled = false;
        promoInput.value = '';
    }
    
    if (applyBtn) {
        applyBtn.disabled = false;
        applyBtn.textContent = 'Gunakan';
        applyBtn.classList.remove('btn-success');
        applyBtn.classList.add('btn-success');
    }
    
    if (resetBtn) {
        resetBtn.style.display = 'none';
    }
    
    // Hide feedback
    if (feedback) {
        feedback.style.display = 'none';
        feedback.innerHTML = '';
    }
    
    // Recalculate price
    calculatePrice();
}
</script>
@endpush
