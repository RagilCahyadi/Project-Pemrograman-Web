@extends('layouts.services')

@section('title', 'Cetak Fancy Paper - RNR Digital Printing')
@section('description', 'Layanan cetak fancy paper berkualitas tinggi. HVS, Art Paper, Flyer, Brosur, Poster, Undangan dengan berbagai pilihan kertas berkualitas.')

@push('styles')
<style>
    /* Hero Section Animations */
    .hero-section {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        background: linear-gradient(45deg, #667eea, #764ba2);
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
        font-weight: 700;
        font-size: 1rem;
        background: rgba(40, 167, 69, 0.1);
        padding: 4px 8px;
        border-radius: 6px;
        border: 1px solid rgba(40, 167, 69, 0.3);
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
        font-weight: 700;
        font-size: 0.95rem;
        background: rgba(253, 126, 20, 0.1);
        padding: 4px 8px;
        border-radius: 6px;
        border: 1px solid rgba(253, 126, 20, 0.3);
        margin-top: 5px;
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
        font-size: 1.5rem;
        font-weight: 700;
        background: transparent;
        color: #2c3e50;
        padding: 0 15px;
        min-width: 80px;
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
    
    /* Process Steps */
    .process-step {
        text-align: center;
        padding: 30px 20px;
        background: linear-gradient(145deg, white, #f8f9fa);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid rgba(102, 126, 234, 0.1);
        overflow: hidden;
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
        top: -15px;
        right: 20px;
        width: 30px;
        height: 30px;
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
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
        padding: 25px;
        border-left: 5px solid #28a745;
        animation: slideInRight 0.5s ease;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .price-breakdown .d-flex {
        padding: 8px 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    
    .price-breakdown .d-flex:last-child {
        border-bottom: none;
        padding-top: 15px;
        margin-top: 10px;
        border-top: 2px solid #28a745;
    }
    
    .price-breakdown span {
        font-size: 16px;
        font-weight: 500;
    }
    
    .price-breakdown span:last-child {
        font-weight: 600;
        color: #2c3e50;
        font-size: 16px;
    }
    
    .price-breakdown .fs-4,
    .price-breakdown .fs-5 {
        font-size: 1.5rem !important;
        font-weight: 700 !important;
    }
    
    .price-breakdown #totalPrice {
        font-size: 1.75rem !important;
        font-weight: 800 !important;
        color: #007bff !important;
        text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }
    
    .price-breakdown span.updating {
        animation: highlightUpdate 0.5s ease;
    }
    
    @keyframes highlightUpdate {
        0% { background-color: rgba(0, 123, 255, 0.1); transform: scale(1); }
        50% { background-color: rgba(0, 123, 255, 0.2); transform: scale(1.05); }
        100% { background-color: transparent; transform: scale(1); }
    }
    
    .price-breakdown .d-flex span:last-child {
        transition: all 0.3s ease;
        padding: 2px 6px;
        border-radius: 4px;
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
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .promo-section::before {
        content: '✨';
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 2rem;
        animation: twinkle 1.5s ease-in-out infinite;
    }
    
    @keyframes twinkle {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.2); }
    }
    
    /* Button Animations */
    .btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255, 255, 255, 0.3);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.3s, height 0.3s;
    }
    
    .btn:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
    }
    
    /* Fade in animations */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.6s ease;
    }
    
    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Loading animation for price calculation */
    .loading-price {
        position: relative;
    }
    
    .loading-price::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        border: 2px solid #f3f3f3;
        border-top: 2px solid #667eea;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        transform: translate(-50%, -50%);
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="hero-section text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 fade-in">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-white-50">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active">Cetak Fancy Paper</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">Cetak Fancy Paper</h1>
                <p class="lead">HVS, Art Paper, Flyer, Brosur, Poster, Undangan dengan berbagai pilihan kertas berkualitas tinggi</p>
            </div>
            <div class="col-lg-4 text-center fade-in">
                <i class="bi bi-file-earmark-text hero-icon"></i>
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
                            <img src="{{ asset('template/assets/fancy-paper-1.jpg') }}" class="d-block w-100" alt="Fancy Paper 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('template/assets/fancy-paper-2.jpg') }}" class="d-block w-100" alt="Fancy Paper 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('template/assets/fancy-paper-3.jpg') }}" class="d-block w-100" alt="Fancy Paper 3">
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
                            <i class="bi bi-info-circle text-primary spec-icon"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Spesifikasi Produk</h5>
                            <small class="text-muted">Detail lengkap produk fancy paper</small>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                    <strong>Jenis Kertas Available</strong>
                                </div>
                                <div class="spec-grid">
                                    <div class="spec-item">
                                        <div class="spec-badge">HVS</div>
                                        <div class="spec-details">
                                            <span class="spec-name">HVS Premium</span>
                                            <span class="spec-desc">70-80 GSM</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">ART</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Art Paper</span>
                                            <span class="spec-desc">150-260 GSM</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">LIN</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Linen Texture</span>
                                            <span class="spec-desc">200 GSM</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">JAS</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Jasmine</span>
                                            <span class="spec-desc">180 GSM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-rulers text-success me-2"></i>
                                    <strong>Ukuran Tersedia</strong>
                                </div>
                                <div class="size-options">
                                    <div class="size-card">
                                        <div class="size-icon">A4</div>
                                        <div class="size-dim">21×29.7 cm</div>
                                    </div>
                                    <div class="size-card">
                                        <div class="size-icon">A3</div>
                                        <div class="size-dim">29.7×42 cm</div>
                                    </div>
                                    <div class="size-card custom">
                                        <div class="size-icon">📐</div>
                                        <div class="size-dim">Custom Size</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-star text-warning me-2"></i>
                                    <strong>Finishing Options</strong>
                                </div>
                                <div class="finishing-tags">
                                    <span class="finishing-tag">✨ Laminasi Doff</span>
                                    <span class="finishing-tag">💎 Laminasi Glossy</span>
                                    <span class="finishing-tag">✂️ Potong Presisi</span>
                                    <span class="finishing-tag">📋 Lipat Rapi</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="quality-guarantee">
                                <div class="guarantee-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div class="guarantee-text">
                                    <strong>Garansi Kualitas</strong>
                                    <span>Hasil cetak tajam, warna akurat, dan tahan lama</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Form -->
            <div class="col-lg-6">
                <form id="orderForm" class="form-section fade-in">
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
                            <i class="bi bi-box text-primary me-2"></i>
                            <span class="label-text">Jenis Produk</span>
                        </label>
                        <div class="select-wrapper">
                            <select name="product_type" id="productType" class="form-select enhanced-select" required>
                                <option value="">Pilih jenis produk</option>
                                <option value="flyer" data-icon="📄">Flyer - Promosi Event</option>
                                <option value="brosur" data-icon="📋">Brosur - Company Profile</option>
                                <option value="poster" data-icon="🎨">Poster - Advertising</option>
                                <option value="undangan" data-icon="💌">Undangan - Special Event</option>
                                <option value="kartu_nama" data-icon="💳">Kartu Nama - Business Card</option>
                                <option value="leaflet" data-icon="📝">Leaflet - Information</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Paper Type -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-file-earmark text-success me-2"></i>
                            <span class="label-text">Jenis Kertas</span>
                        </label>
                        <div class="paper-grid">
                            <div class="paper-option selected" data-value="hvs" data-price="0">
                                <div class="paper-badge">HVS</div>
                                <div class="paper-info">
                                    <span class="paper-name">HVS Premium</span>
                                    <span class="paper-weight">70-80 GSM</span>
                                    <span class="paper-price">+Rp 0</span>
                                </div>
                            </div>
                            <div class="paper-option" data-value="art_paper" data-price="2000">
                                <div class="paper-badge">ART</div>
                                <div class="paper-info">
                                    <span class="paper-name">Art Paper</span>
                                    <span class="paper-weight">150 GSM</span>
                                    <span class="paper-price">+Rp 2.000</span>
                                </div>
                            </div>
                            <div class="paper-option" data-value="linen" data-price="5000">
                                <div class="paper-badge">LIN</div>
                                <div class="paper-info">
                                    <span class="paper-name">Linen</span>
                                    <span class="paper-weight">200 GSM</span>
                                    <span class="paper-price">+Rp 5.000</span>
                                </div>
                            </div>
                            <div class="paper-option" data-value="jasmine" data-price="7000">
                                <div class="paper-badge">JAS</div>
                                <div class="paper-info">
                                    <span class="paper-name">Jasmine</span>
                                    <span class="paper-weight">180 GSM</span>
                                    <span class="paper-price">+Rp 7.000</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="paper_type" id="paperType" value="hvs" required>
                    </div>
                    
                    <!-- Size Selection -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-rulers text-warning me-2"></i>
                            <span class="label-text">Ukuran Kertas</span>
                        </label>
                        <div class="size-selection">
                            <div class="size-option selected" data-value="a4" data-multiplier="1">
                                <div class="size-icon">A4</div>
                                <div class="size-details">
                                    <span class="size-name">A4 Standard</span>
                                    <span class="size-dim">21×29.7 cm</span>
                                </div>
                            </div>
                            <div class="size-option" data-value="a3" data-multiplier="2">
                                <div class="size-icon">A3</div>
                                <div class="size-details">
                                    <span class="size-name">A3 Large</span>
                                    <span class="size-dim">29.7×42 cm</span>
                                </div>
                            </div>
                            <div class="size-option" data-value="custom" data-multiplier="1">
                                <div class="size-icon">📐</div>
                                <div class="size-details">
                                    <span class="size-name">Custom</span>
                                    <span class="size-dim">Sesuai kebutuhan</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="size" id="size" value="a4" required>
                    </div>
                    
                    <!-- Finishing Options -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-star text-warning me-2"></i>
                            <span class="label-text">Finishing</span>
                        </label>
                        <div class="finishing-options">
                            <div class="finishing-card selected" data-value="none" data-price="0">
                                <div class="finishing-icon">📄</div>
                                <div class="finishing-name">Tanpa Finishing</div>
                                <div class="finishing-price">+Rp 0</div>
                            </div>
                            <div class="finishing-card" data-value="laminating_doff" data-price="3000">
                                <div class="finishing-icon">✨</div>
                                <div class="finishing-name">Laminasi Doff</div>
                                <div class="finishing-price">+Rp 3.000</div>
                            </div>
                            <div class="finishing-card" data-value="laminating_glossy" data-price="3000">
                                <div class="finishing-icon">💎</div>
                                <div class="finishing-name">Laminasi Glossy</div>
                                <div class="finishing-price">+Rp 3.000</div>
                            </div>
                        </div>
                        <input type="hidden" name="finishing" id="finishing" value="none">
                    </div>
                    
                    <!-- Quantity -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-calculator text-info me-2"></i>
                            <span class="label-text">Jumlah (lembar)</span>
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
                </form>
            </div>
        </div>
        
        <!-- Price Summary -->
        <div class="row mt-4">
            <div class="col-lg-6 offset-lg-6">
                <div class="price-breakdown">
                    <h5 class="mb-3"><i class="bi bi-calculator text-success me-2"></i>Ringkasan Harga</h5>
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span><strong>Harga Dasar:</strong></span>
                        <span id="basePrice" class="fw-bold">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><strong>Jumlah:</strong></span>
                        <span id="quantityDisplay" class="fw-bold text-primary">0 lembar</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><strong>Subtotal:</strong></span>
                        <span id="subtotal" class="fw-bold">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><strong>Biaya Tambahan:</strong></span>
                        <span id="additionalCost" class="fw-bold">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2" id="discountRow" style="display: none;">
                        <span><strong>Diskon:</strong></span>
                        <span id="discount" class="text-success fw-bold">- Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><strong>Ongkos Kirim:</strong></span>
                        <span id="shippingCost" class="fw-bold">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span><strong>Pajak (10%):</strong></span>
                        <span id="tax" class="fw-bold">Rp 0</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong class="fs-5">Total:</strong>
                        <strong class="fs-4 text-primary" id="totalPrice">Rp 0</strong>
                    </div>
                    
                    <button type="button" id="placeOrder" class="btn btn-primary btn-lg w-100 mt-3" disabled>
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
            <p class="text-muted">Lihat hasil kerja fancy paper berkualitas dari RNR Digital Printing</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-file-earmark-text portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Flyer Event</h5>
                                <p>Art Paper 150 GSM, Laminasi Glossy</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-file-earmark-richtext portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Brosur Company</h5>
                                <p>Linen 200 GSM, Lipat 3</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-heart portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Undangan Wedding</h5>
                                <p>Jasmine 180 GSM, Laminasi Doff</p>
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
                            <h6>Sarah Maharani</h6>
                            <small>Event Organizer</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Hasil cetak flyer untuk event kami sangat memuaskan! Warna tajam dan kertas berkualitas. Pasti akan order lagi!"
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
                            <h6>Budi Santoso</h6>
                            <small>Pemilik Usaha</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Brosur company profile kami dicetak dengan sempurna. Detail gambar sangat jelas dan finishing laminasi rapi."
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
                            <h6>Maya Indira</h6>
                            <small>Bride to be</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Undangan pernikahan kami cantik sekali! Kertas jasmine memberikan kesan mewah dan elegan."
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Process Steps -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 fade-in">
            <h3 class="fw-bold">Proses Pemesanan</h3>
            <p class="text-muted">Langkah mudah untuk memesan fancy paper berkualitas</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">1</div>
                    <div class="process-icon">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h5>Pilih Produk</h5>
                    <p>Pilih jenis fancy paper dan spesifikasi yang diinginkan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">2</div>
                    <div class="process-icon">
                        <i class="bi bi-cloud-upload"></i>
                    </div>
                    <h5>Upload Desain</h5>
                    <p>Upload file desain atau konsultasi dengan tim kami</p>
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
                    <p>Proses cetak dan pengiriman sesuai jadwal</p>
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
                                Berapa lama waktu pengerjaan fancy paper?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Untuk fancy paper regular, waktu pengerjaan 1-2 hari kerja. Untuk pesanan express, bisa diselesaikan dalam 24 jam dengan tambahan biaya.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah bisa cetak dengan ukuran custom?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, kami melayani cetak dengan ukuran custom. Silakan pilih opsi "Custom Size" dan masukkan dimensi yang diinginkan. Tim kami akan memberikan quote harga.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Format file apa yang diterima?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Kami menerima format JPG, PNG, PDF, AI, PSD, CDR. Untuk hasil terbaik, gunakan format vektor (AI, CDR) dengan resolusi 300 DPI.
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
function selectPaper(element, value) {
    console.log('Paper selected:', value);
    
    // Remove selected from all paper options
    document.querySelectorAll('.paper-option').forEach(opt => {
        opt.classList.remove('selected');
    });
    
    // Add selected to clicked element
    element.classList.add('selected');
    
    // Update hidden input
    document.getElementById('paperType').value = value;
    
    // Recalculate price
    calculatePrice();
}

function selectSize(element, value) {
    console.log('Size selected:', value);
    
    // Remove selected from all size options
    document.querySelectorAll('.size-option').forEach(opt => {
        opt.classList.remove('selected');
    });
    
    // Add selected to clicked element
    element.classList.add('selected');
    
    // Update hidden input
    document.getElementById('size').value = value;
    
    // Show/hide custom dimensions
    const customDimensions = document.getElementById('customDimensions');
    if (value === 'custom') {
        customDimensions.style.display = 'block';
    } else {
        customDimensions.style.display = 'none';
    }
    
    // Recalculate price
    calculatePrice();
}

function selectFinishing(element, value) {
    console.log('Finishing selected:', value);
    
    // Remove selected from all finishing cards
    document.querySelectorAll('.finishing-card').forEach(opt => {
        opt.classList.remove('selected');
    });
    
    // Add selected to clicked element
    element.classList.add('selected');
    
    // Update hidden input
    document.getElementById('finishing').value = value;
    
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
    
    // Size selection interaction
    const sizeOptions = document.querySelectorAll('.size-option');
    console.log('Found size options:', sizeOptions.length);
    
    sizeOptions.forEach(option => {
        option.addEventListener('click', function() {
            console.log('Size option clicked:', this.dataset.value);
            
            // Remove selected class from all options
            document.querySelectorAll('.size-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Update hidden input
            const sizeInput = document.getElementById('size');
            if (sizeInput) {
                sizeInput.value = this.dataset.value;
                console.log('Updated size input to:', this.dataset.value);
            }
            
            // Show/hide custom dimensions
            const customDimensions = document.getElementById('customDimensions');
            if (this.dataset.value === 'custom') {
                customDimensions.style.display = 'block';
            } else {
                customDimensions.style.display = 'none';
            }
            
            // Recalculate price
            calculatePrice();
        });
    });
    
    // Finishing selection interaction
    const finishingCards = document.querySelectorAll('.finishing-card');
    console.log('Found finishing cards:', finishingCards.length);
    
    finishingCards.forEach(card => {
        card.addEventListener('click', function() {
            console.log('Finishing card clicked:', this.dataset.value);
            
            // Remove selected class from all cards
            document.querySelectorAll('.finishing-card').forEach(c => {
                c.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            this.classList.add('selected');
            
            // Update hidden input
            const finishingInput = document.getElementById('finishing');
            if (finishingInput) {
                finishingInput.value = this.dataset.value;
                console.log('Updated finishing input to:', this.dataset.value);
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
    
    // Product type change
    const productTypeSelect = document.getElementById('productType');
    if (productTypeSelect) {
        productTypeSelect.addEventListener('change', function() {
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
    
    console.log('Fancy Paper form initialized successfully');
    
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

// Form validation
function validateForm() {
    const productType = document.getElementById('productType');
    const paperSelected = document.querySelector('.paper-option.selected');
    const sizeSelected = document.querySelector('.size-option.selected');
    const finishingSelected = document.querySelector('.finishing-card.selected');
    const quantity = document.getElementById('quantity');
    const customerName = document.getElementById('customerName');
    const customerEmail = document.getElementById('customerEmail');
    const customerPhone = document.getElementById('customerPhone');
    
    let isValid = true;
    let errors = [];
    
    if (!productType || !productType.value) {
        errors.push('Pilih jenis produk');
        isValid = false;
    }
    
    if (!paperSelected) {
        errors.push('Pilih jenis kertas');
        isValid = false;
    }
    
    if (!sizeSelected) {
        errors.push('Pilih ukuran kertas');
        isValid = false;
    }
    
    if (!finishingSelected) {
        errors.push('Pilih jenis finishing');
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
    document.querySelectorAll('.size-option.selected').forEach(el => el.classList.remove('selected'));
    document.querySelectorAll('.finishing-card.selected').forEach(el => el.classList.remove('selected'));
    
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
    document.getElementById('paperType').value = '';
    document.getElementById('size').value = '';
    document.getElementById('finishing').value = '';
    
    // Hide custom dimensions
    const customDimensions = document.getElementById('customDimensions');
    if (customDimensions) customDimensions.style.display = 'none';
    
    // Reset price display
    updatePriceDisplay(0, 0, 0, 0, 0, 0, 0);
    
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
            service_type: 'fancy_paper',
            product_type: formData.productType,
            paper_type: formData.paperType,
            size: formData.size,
            finishing: formData.finishing,
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
    const productType = document.getElementById('productType');
    const selectedPaper = document.querySelector('.paper-option.selected');
    const selectedSize = document.querySelector('.size-option.selected');
    
    let basePrice = 500;
    const productTypePrices = {
        'flyer': 500, 'brosur': 800, 'poster': 1200,
        'undangan': 1000, 'kartu_nama': 300, 'leaflet': 600
    };
    
    if (productType && productType.value) {
        basePrice = productTypePrices[productType.value] || 500;
    }
    
    let paperCost = selectedPaper ? parseInt(selectedPaper.dataset.price) || 0 : 0;
    let sizeMultiplier = selectedSize ? parseFloat(selectedSize.dataset.multiplier) || 1 : 1;
    
    return (basePrice + paperCost) * sizeMultiplier;
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
    const selectedFinishing = document.querySelector('.finishing-card.selected');
    const quantity = document.getElementById('quantity');
    const qty = parseInt(quantity?.value) || 1;
    const finishingCost = selectedFinishing ? parseInt(selectedFinishing.dataset.price) || 0 : 0;
    return finishingCost * qty;
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
    const productType = document.getElementById('productType');
    const paperSelected = document.querySelector('.paper-option.selected');
    const sizeSelected = document.querySelector('.size-option.selected');
    const finishingSelected = document.querySelector('.finishing-card.selected');
    const quantity = document.getElementById('quantity');
    const shippingMethod = document.getElementById('shippingMethod');
    const customerName = document.getElementById('customerName');
    const customerEmail = document.getElementById('customerEmail');
    const customerPhone = document.getElementById('customerPhone');
    const customerAddress = document.getElementById('customerAddress');
    const notes = document.getElementById('notes');
    const promoCode = document.getElementById('promoCode');
    
    return {
        productType: productType?.value || '',
        paperType: paperSelected?.textContent?.trim() || '',
        size: sizeSelected?.textContent?.trim() || '',
        finishing: finishingSelected?.textContent?.trim() || '',
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
    return `*PESANAN FANCY PAPER*

*Detail Pesanan:*
📄 Jenis Produk: ${data.productType}
📝 Jenis Kertas: ${data.paperType}
📏 Ukuran: ${data.size}
✨ Finishing: ${data.finishing}
🔢 Jumlah: ${data.quantity} lembar
🚚 Pengiriman: ${data.shipping}

*Detail Pelanggan:*
👤 Nama: ${data.customerName}
📧 Email: ${data.customerEmail}
📱 Telepon: ${data.customerPhone}

${data.notes ? `*Catatan:*\n${data.notes}\n` : ''}
${data.promoCode ? `*Kode Promo:* ${data.promoCode}\n` : ''}
*Total Harga: ${data.totalPrice}*

Terima kasih telah mempercayai layanan kami! 🙏`;
}

// Check if form is valid for submission
function checkFormValid() {
    const productType = document.getElementById('productType');
    const paperSelected = document.querySelector('.paper-option.selected');
    const sizeSelected = document.querySelector('.size-option.selected');
    const finishingSelected = document.querySelector('.finishing-card.selected');
    const quantity = document.getElementById('quantity');
    const orderBtn = document.getElementById('placeOrder');
    
    const isValid = productType?.value && 
                   paperSelected && 
                   sizeSelected && 
                   finishingSelected && 
                   quantity?.value && 
                   parseInt(quantity.value) > 0;
    
    if (orderBtn) {
        orderBtn.disabled = !isValid;
    }
    
    return isValid;
}

// Price calculation function
function calculatePrice() {
    const quantity = document.getElementById('quantity');
    const productType = document.getElementById('productType');
    const shippingMethod = document.getElementById('shippingMethod');
    
    if (!quantity || !quantity.value || quantity.value < 1) {
        updatePriceDisplay(0, 0, 0, 0, 0, 0, 0);
        return;
    }
    
    let basePrice = 500; // Base price per piece
    let qty = parseInt(quantity.value);
    
    // Product type base price
    const productTypePrices = {
        'flyer': 500,
        'brosur': 800,
        'poster': 1200,
        'undangan': 1000,
        'kartu_nama': 300,
        'leaflet': 600
    };
    
    if (productType && productType.value) {
        basePrice = productTypePrices[productType.value] || 500;
    }
    
    // Paper type addition
    const selectedPaper = document.querySelector('.paper-option.selected');
    let paperCost = 0;
    if (selectedPaper) {
        paperCost = parseInt(selectedPaper.dataset.price) || 0;
    }
    
    // Size multiplier
    const selectedSize = document.querySelector('.size-option.selected');
    let sizeMultiplier = 1;
    if (selectedSize) {
        sizeMultiplier = parseFloat(selectedSize.dataset.multiplier) || 1;
    }
    
    // Finishing addition
    const selectedFinishing = document.querySelector('.finishing-card.selected');
    let finishingCost = 0;
    if (selectedFinishing) {
        finishingCost = parseInt(selectedFinishing.dataset.price) || 0;
    }
    
    // Calculate base prices
    let itemPrice = (basePrice + paperCost) * sizeMultiplier;
    let subtotal = itemPrice * qty;
    let finishingTotal = finishingCost * qty;
    let baseTotal = subtotal + finishingTotal;
    
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
    updatePriceDisplay(baseTotal, subtotal, finishingTotal, discount, shippingCost, taxAmount, total);
}

// Update price display function
function updatePriceDisplay(baseTotal, subtotal, finishingCost, discount, shippingCost, taxAmount, total) {
    const quantity = document.getElementById('quantity');
    const qty = parseInt(quantity?.value) || 1;
    
    // Helper function to add highlight animation
    function highlightElement(element) {
        if (element) {
            element.classList.remove('updating');
            setTimeout(() => element.classList.add('updating'), 10);
            setTimeout(() => element.classList.remove('updating'), 500);
        }
    }
    
    // Update quantity display with better formatting
    const quantityDisplay = document.getElementById('quantityDisplay');
    if (quantityDisplay) {
        quantityDisplay.textContent = `${qty.toLocaleString('id-ID')} lembar`;
        quantityDisplay.style.fontWeight = '700';
        quantityDisplay.style.fontSize = '1.1rem';
        highlightElement(quantityDisplay);
    }
    
    // Update base price with enhanced styling
    const basePriceEl = document.getElementById('basePrice');
    if (basePriceEl) {
        basePriceEl.textContent = formatCurrency(subtotal);
        basePriceEl.style.fontWeight = '700';
        basePriceEl.style.fontSize = '1.1rem';
        highlightElement(basePriceEl);
    }
    
    // Update additional costs with enhanced styling
    const additionalCostEl = document.getElementById('additionalCost');
    if (additionalCostEl) {
        additionalCostEl.textContent = formatCurrency(finishingCost);
        additionalCostEl.style.fontWeight = '700';
        additionalCostEl.style.fontSize = '1.1rem';
        highlightElement(additionalCostEl);
    }
    
    // Update subtotal with enhanced styling
    const subtotalEl = document.getElementById('subtotal');
    if (subtotalEl) {
        subtotalEl.textContent = formatCurrency(baseTotal);
        subtotalEl.style.fontWeight = '700';
        subtotalEl.style.fontSize = '1.1rem';
        highlightElement(subtotalEl);
    }
    
    // Update discount with enhanced styling
    const discountRow = document.getElementById('discountRow');
    const discountEl = document.getElementById('discount');
    
    if (discount > 0) {
        if (discountRow) {
            discountRow.style.display = 'flex';
        }
        if (discountEl) {
            discountEl.textContent = '- ' + formatCurrency(discount);
            discountEl.style.fontWeight = '700';
            discountEl.style.fontSize = '1.1rem';
            highlightElement(discountEl);
        }
    } else {
        if (discountRow) discountRow.style.display = 'none';
    }
    
    // Update shipping cost with enhanced styling
    const shippingCostEl = document.getElementById('shippingCost');
    if (shippingCostEl) {
        shippingCostEl.textContent = formatCurrency(shippingCost);
        shippingCostEl.style.fontWeight = '700';
        shippingCostEl.style.fontSize = '1.1rem';
        highlightElement(shippingCostEl);
    }
    
    // Update tax with enhanced styling
    const taxEl = document.getElementById('tax');
    if (taxEl) {
        taxEl.textContent = formatCurrency(taxAmount);
        taxEl.style.fontWeight = '700';
        taxEl.style.fontSize = '1.1rem';
        highlightElement(taxEl);
    }
    
    // Update total with maximum visibility
    const totalEl = document.getElementById('totalPrice');
    if (totalEl) {
        totalEl.textContent = formatCurrency(total);
        totalEl.style.fontWeight = '800';
        totalEl.style.fontSize = '1.8rem';
        totalEl.style.color = '#007bff';
        totalEl.style.textShadow = '0 1px 3px rgba(0,0,0,0.2)';
        highlightElement(totalEl);
    }
    
    // Enable/disable order button
    checkFormValid();
}

// Enhanced format currency function with better visibility
function formatCurrency(amount) {
    const formatted = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(Math.round(amount));
    
    return formatted;
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

// Form validation
function validateForm() {
    const productType = document.getElementById('productType');
    const paperSelected = document.querySelector('.paper-option.selected');
    const sizeSelected = document.querySelector('.size-option.selected');
    const finishingSelected = document.querySelector('.finishing-card.selected');
    const quantity = document.getElementById('quantity');
    const customerName = document.getElementById('customerName');
    const customerEmail = document.getElementById('customerEmail');
    const customerPhone = document.getElementById('customerPhone');
    
    let isValid = true;
    let errors = [];
    
    if (!productType || !productType.value) {
        errors.push('Pilih jenis produk');
        isValid = false;
    }
    
    if (!paperSelected) {
        errors.push('Pilih jenis kertas');
        isValid = false;
    }
    
    if (!sizeSelected) {
        errors.push('Pilih ukuran kertas');
        isValid = false;
    }
    
    if (!finishingSelected) {
        errors.push('Pilih jenis finishing');
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

</script>
@endpush

@push('scripts')
<script src="{{ asset('js/services-animations.js') }}"></script>
@endpush
