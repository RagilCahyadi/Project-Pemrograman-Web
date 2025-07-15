@extends('layouts.services')

@section('title', 'Banner & Signage - RNR Digital Printing')
@section('description', 'Layanan cetak banner dan signage berkualitas tinggi. X-Banner, Roll Banner, Neon Box dengan hasil cetak tajam dan tahan lama.')

@push('styles')
<style>
    /* Hero Section Animations */
    .hero-section {
        background: linear-gradient(135deg, #fd7e14 0%, #e83e8c 100%);
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
        animation: banner-wave 3s ease-in-out infinite;
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
    }
    
    @keyframes banner-wave {
        0%, 100% { transform: translateY(0) rotateZ(0deg) scaleX(1); }
        25% { transform: translateY(-10px) rotateZ(2deg) scaleX(1.1); }
        50% { transform: translateY(-20px) rotateZ(0deg) scaleX(1); }
        75% { transform: translateY(-10px) rotateZ(-2deg) scaleX(1.1); }
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
        background: linear-gradient(90deg, transparent, rgba(253,126,20,0.4), transparent);
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
        border: 1px solid rgba(253, 126, 20, 0.1);
        z-index: 10;
    }
    
    /* Ensure form elements are clickable */
    .banner-option, .signage-option, .material-option, .size-option, .finishing-card, .btn, .form-control, .form-select {
        position: relative;
        z-index: 20;
        pointer-events: auto;
    }
    
    .form-header {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(253, 126, 20, 0.1);
    }
    
    .form-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        margin-right: 20px;
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
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
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
        border: 2px solid rgba(253, 126, 20, 0.2);
        border-radius: 15px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .enhanced-select:focus {
        border-color: #fd7e14;
        box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25);
        transform: translateY(-2px);
        background: white;
    }
    
    /* Product Type Selection Grid */
    .product-type-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 10px;
    }
    
    .product-type-option {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(253, 126, 20, 0.2);
        border-radius: 15px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        user-select: none;
    }
    
    .product-type-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.2);
        border-color: rgba(253, 126, 20, 0.4);
    }
    
    .product-type-option.selected {
        border-color: #fd7e14;
        background: rgba(253, 126, 20, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.3);
    }
    
    .product-type-badge {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-right: 15px;
    }
    
    .product-type-info {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    
    .product-type-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 1rem;
        margin-bottom: 2px;
    }
    
    .product-type-desc {
        color: #6c757d;
        font-size: 0.85rem;
    }
    
    /* Banner Options Grid */
    .banner-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 10px;
    }
    
    .banner-option {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(253, 126, 20, 0.2);
        border-radius: 15px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        user-select: none;
    }
    
    .banner-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.2);
        border-color: rgba(253, 126, 20, 0.4);
    }
    
    .banner-option.selected {
        border-color: #fd7e14;
        background: rgba(253, 126, 20, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.3);
    }
    
    .banner-badge {
        width: 45px;
        height: 45px;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
        margin-right: 15px;
    }
    
    .banner-info {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    
    .banner-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
        margin-bottom: 2px;
    }
    
    .banner-desc {
        color: #6c757d;
        font-size: 0.8rem;
        margin-bottom: 2px;
    }
    
    .banner-price {
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
        border: 2px solid rgba(253, 126, 20, 0.2);
        border-radius: 15px;
        padding: 15px 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        user-select: none;
    }
    
    .size-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.2);
        border-color: rgba(253, 126, 20, 0.4);
    }
    
    .size-option.selected {
        border-color: #fd7e14;
        background: rgba(253, 126, 20, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.3);
    }
    
    .size-icon {
        font-size: 1.2rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 5px;
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
        border: 2px solid rgba(253, 126, 20, 0.3);
        border-radius: 15px;
        padding: 18px 12px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        user-select: none;
    }
    
    .finishing-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.2);
        border-color: rgba(253, 126, 20, 0.5);
    }
    
    .finishing-card.selected {
        border-color: #fd7e14;
        background: rgba(253, 126, 20, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.3);
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
        border: 2px solid rgba(253, 126, 20, 0.2);
        border-radius: 15px;
        overflow: hidden;
        max-width: 200px;
    }
    
    .quantity-btn {
        width: 45px;
        height: 50px;
        border: none;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .quantity-btn:hover {
        background: linear-gradient(45deg, #e96d0e, #d63384);
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
        border: 2px dashed rgba(253, 126, 20, 0.3);
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
        background: linear-gradient(90deg, transparent, rgba(253, 126, 20, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .upload-area:hover::before {
        left: 100%;
    }
    
    .upload-area:hover {
        border-color: #fd7e14;
        background: rgba(253, 126, 20, 0.05);
        transform: translateY(-2px);
    }
    
    .upload-icon {
        font-size: 2.5rem;
        color: #fd7e14;
        margin-bottom: 15px;
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
        background: linear-gradient(135deg, #fd7e14, #e83e8c);
        color: white;
        border-color: #fd7e14;
        transform: scale(1.02);
    }
    
    .upload-area.file-uploaded {
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border-color: #28a745;
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
        border: 2px solid rgba(253, 126, 20, 0.2);
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
        color: #fd7e14;
        margin-top: 20px;
    }
    
    /* Enhanced Textarea */
    .textarea-wrapper {
        position: relative;
    }
    
    .enhanced-textarea {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(253, 126, 20, 0.2);
        border-radius: 15px;
        padding: 15px;
        resize: vertical;
        min-height: 100px;
        transition: all 0.3s ease;
    }
    
    .enhanced-textarea:focus {
        border-color: #fd7e14;
        box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25);
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
        border: 2px solid rgba(253, 126, 20, 0.1);
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
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
    }
    
    .price-header {
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(253, 126, 20, 0.1);
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
        border-top: 2px solid rgba(253, 126, 20, 0.2);
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
    
    .form-control, .form-select {
        border-radius: 15px;
        border: 2px solid transparent;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #fd7e14;
        box-shadow: 0 0 0 0.2rem rgba(253, 126, 20, 0.25);
        transform: translateY(-2px);
    }
    
    /* Product Specs */
    .product-specs {
        background: linear-gradient(145deg, white, #f8f9fa);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(253, 126, 20, 0.1);
    }
    
    .product-specs:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .spec-icon-wrapper {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
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
        border: 1px solid rgba(253, 126, 20, 0.1);
        transition: all 0.3s ease;
    }
    
    .spec-category:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.15);
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
        background: rgba(253, 126, 20, 0.05);
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .spec-item:hover {
        background: rgba(253, 126, 20, 0.1);
        transform: translateX(5px);
    }
    
    .spec-badge {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
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
    
    .spec-icon {
        animation: banner-swing 4s ease-in-out infinite;
    }
    
    @keyframes banner-swing {
        0%, 100% { transform: rotate(0deg); }
        25% { transform: rotate(5deg); }
        75% { transform: rotate(-5deg); }
    }
    
    /* Price Display */
    .price-display {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { filter: drop-shadow(0 0 5px rgba(253, 126, 20, 0.5)); }
        to { filter: drop-shadow(0 0 20px rgba(253, 126, 20, 0.8)); }
    }
    
    .price-breakdown {
        background: linear-gradient(145deg, #fff3cd, #ffeaa7);
        border-radius: 15px;
        padding: 20px;
        border-left: 5px solid #fd7e14;
        animation: slideInRight 0.5s ease;
    }
    
    @keyframes slideInRight {
        from { transform: translateX(50px); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    /* Promo Section */
    .promo-section {
        background: linear-gradient(45deg, #fd7e14, #e83e8c, #6f42c1);
        background-size: 300% 300%;
        animation: gradientShift 3s ease infinite;
        color: white;
        border-radius: 15px;
        padding: 20px;
        margin: 15px 0;
        position: relative;
        overflow: hidden;
    }
    
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .promo-section::before {
        content: '🎯';
        position: absolute;
        top: 10px;
        right: 20px;
        font-size: 2rem;
        animation: target-spin 2s linear infinite;
    }
    
    @keyframes target-spin {
        0% { transform: rotate(0deg) scale(1); }
        50% { transform: rotate(180deg) scale(1.1); }
        100% { transform: rotate(360deg) scale(1); }
    }
    
    /* Material Options */
    .material-option {
        border: 2px solid #dee2e6;
        border-radius: 15px;
        padding: 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        background: white;
    }
    
    .material-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(253,126,20,0.1), rgba(232,62,140,0.1));
        transform: translateX(-100%);
        transition: transform 0.3s ease;
    }
    
    .material-option:hover::before {
        transform: translateX(0);
    }
    
    .material-option:hover {
        border-color: #fd7e14;
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 10px 25px rgba(253, 126, 20, 0.2);
    }
    
    .material-option.selected {
        border-color: #fd7e14;
        background: rgba(253, 126, 20, 0.1);
        transform: scale(1.02);
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
    
    .btn-warning {
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: white;
    }
    
    .btn-warning:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(253, 126, 20, 0.4);
        color: white;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(253, 126, 20, 0.4);
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
        border-top: 2px solid #fd7e14;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        transform: translate(-50%, -50%);
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
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
        background: linear-gradient(135deg, #fd7e14, #e83e8c);
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
        border: 1px solid rgba(253, 126, 20, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .testimonial-card::before {
        content: '"';
        position: absolute;
        top: -10px;
        right: 20px;
        font-size: 6rem;
        color: rgba(253, 126, 20, 0.1);
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
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
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
        border: 1px solid rgba(253, 126, 20, 0.1);
        overflow: visible;
        margin-top: 30px;
    }

    .process-step::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
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
        background: linear-gradient(45deg, #fd7e14, #e83e8c) !important;
        color: white !important;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900 !important;
        font-size: 1.6rem !important;
        box-shadow: 0 8px 25px rgba(253, 126, 20, 0.7), inset 0 2px 4px rgba(255,255,255,0.3);
        border: 4px solid white;
        z-index: 25 !important;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.9) !important;
        font-family: 'Arial Black', Arial, sans-serif !important;
        animation: numberPulse 2s ease-in-out infinite;
    }

    @keyframes numberPulse {
        0%, 100% { 
            transform: scale(1); 
            box-shadow: 0 8px 25px rgba(253, 126, 20, 0.7), inset 0 2px 4px rgba(255,255,255,0.3); 
        }
        50% { 
            transform: scale(1.15); 
            box-shadow: 0 12px 35px rgba(253, 126, 20, 0.9), inset 0 2px 4px rgba(255,255,255,0.5); 
        }
    }
    
    .process-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #fd7e14, #e83e8c);
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
    
    /* Additional styles for material options */
    .size-badge {
        background: #007bff;
        color: white;
        padding: 2px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        margin-left: 8px;
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
                        <li class="breadcrumb-item active">Banner & Signage</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">Banner & Signage</h1>
                <p class="lead">X-Banner, Roll Banner, Neon Box dengan hasil cetak tajam dan tahan lama</p>
            </div>
            <div class="col-lg-4 text-center fade-in">
                <i class="bi bi-megaphone hero-icon"></i>
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
                            <img src="https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=500" class="d-block w-100" alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1586281010691-7b0eaa00c96c?w=500" class="d-block w-100" alt="Banner 2">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=500" class="d-block w-100" alt="Signage 1">
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
                            <small class="text-muted">Detail lengkap banner & signage</small>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-flag text-primary me-2"></i>
                                    <strong>Jenis Banner Available</strong>
                                </div>
                                <div class="spec-grid">
                                    <div class="spec-item">
                                        <div class="spec-badge">X-B</div>
                                        <div class="spec-details">
                                            <span class="spec-name">X-Banner</span>
                                            <span class="spec-desc">Portable + Stand</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">ROLL</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Roll Banner</span>
                                            <span class="spec-desc">Roll Up System</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">BACK</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Backdrop</span>
                                            <span class="spec-desc">Background Event</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">NEON</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Neon Box</span>
                                            <span class="spec-desc">LED Lighting</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-palette text-success me-2"></i>
                                    <strong>Material Tersedia</strong>
                                </div>
                                <div class="spec-grid">
                                    <div class="spec-item">
                                        <div class="spec-badge">FLX</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Flexi China</span>
                                            <span class="spec-desc">Outdoor Standard</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">KOR</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Flexi Korea</span>
                                            <span class="spec-desc">Premium Quality</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-signpost text-warning me-2"></i>
                                    <strong>Signage Options</strong>
                                </div>
                                <div class="spec-grid">
                                    <div class="spec-item">
                                        <div class="spec-badge">LED</div>
                                        <div class="spec-details">
                                            <span class="spec-name">LED Sign</span>
                                            <span class="spec-desc">Digital Display</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">3D</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Letter Timbul</span>
                                            <span class="spec-desc">3D Dimension</span>
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
                <form id="orderForm" class="form-section fade-in" method="POST" action="{{ route('checkout.store') }}">
                    @csrf
                    <input type="hidden" name="service_type" value="banner">
                    <input type="hidden" name="total_price" id="totalPriceInput">
                    <input type="hidden" name="unit_price" id="unitPriceInput">
                    <input type="hidden" name="subtotal" id="subtotalInput">
                    <input type="hidden" name="shipping_cost" id="shippingCostInput">
                    <input type="hidden" name="tax_amount" id="taxAmountInput">
                    <input type="hidden" name="discount" id="discountInput">
                    <input type="hidden" name="total" id="totalInput">
                    
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="bi bi-basket"></i>
                        </div>
                        <div class="form-title">
                            <h4 class="mb-1">Form Pemesanan</h4>
                            <small class="text-muted">Isi detail pesanan banner & signage Anda</small>
                        </div>
                    </div>
                    
                    <!-- Product Type Selection -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-box text-primary me-2"></i>
                            <span class="label-text">Jenis Produk</span>
                        </label>
                        <div class="product-type-grid">
                            <div class="product-type-option selected" data-value="banner">
                                <div class="product-type-badge">
                                    <i class="bi bi-flag"></i>
                                </div>
                                <div class="product-type-info">
                                    <span class="product-type-name">Banner</span>
                                    <span class="product-type-desc">X-Banner, Roll Banner, Backdrop</span>
                                </div>
                            </div>
                            <div class="product-type-option" data-value="signage">
                                <div class="product-type-badge">
                                    <i class="bi bi-signpost"></i>
                                </div>
                                <div class="product-type-info">
                                    <span class="product-type-name">Signage</span>
                                    <span class="product-type-desc">Neon Box, LED Sign, Letter Timbul</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="product_type" id="productType" value="banner" required>
                    </div>
                    
                    <!-- Banner Options -->
                    <div id="bannerOptions" class="product-options">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-flag text-success me-2"></i>
                                <span class="label-text">Jenis Banner</span>
                            </label>
                            <div class="banner-grid">
                                <div class="banner-option selected" data-value="x_banner" data-price="75000">
                                    <div class="banner-badge">X-B</div>
                                    <div class="banner-info">
                                        <span class="banner-name">X-Banner</span>
                                        <span class="banner-desc">termasuk stand</span>
                                        <span class="banner-price">Rp 75.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="roll_banner" data-price="150000">
                                    <div class="banner-badge">ROLL</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Roll Banner</span>
                                        <span class="banner-desc">Roll Up</span>
                                        <span class="banner-price">Rp 150.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="backdrop" data-price="50000">
                                    <div class="banner-badge">BACK</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Backdrop</span>
                                        <span class="banner-desc">Background</span>
                                        <span class="banner-price">Rp 50.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="standing" data-price="125000">
                                    <div class="banner-badge">STAN</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Standing</span>
                                        <span class="banner-desc">Display Stand</span>
                                        <span class="banner-price">Rp 125.000</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="banner_type" id="bannerType" value="x_banner">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-palette text-warning me-2"></i>
                                <span class="label-text">Material Banner</span>
                            </label>
                            <div class="banner-grid">
                                <div class="banner-option selected" data-value="flexi_china" data-price="0">
                                    <div class="banner-badge">FLX</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Flexi China</span>
                                        <span class="banner-desc">Outdoor Standard</span>
                                        <span class="banner-price">+Rp 0</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="flexi_korea" data-price="15000">
                                    <div class="banner-badge">KOR</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Flexi Korea</span>
                                        <span class="banner-desc">Premium</span>
                                        <span class="banner-price">+Rp 15.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="kain_satin" data-price="20000">
                                    <div class="banner-badge">SAT</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Kain Satin</span>
                                        <span class="banner-desc">Indoor</span>
                                        <span class="banner-price">+Rp 20.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="one_way" data-price="35000">
                                    <div class="banner-badge">ONE</div>
                                    <div class="banner-info">
                                        <span class="banner-name">One Way</span>
                                        <span class="banner-desc">Vision</span>
                                        <span class="banner-price">+Rp 35.000</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="banner_material" id="bannerMaterial" value="flexi_china">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-rulers text-info me-2"></i>
                                <span class="label-text">Ukuran Banner</span>
                            </label>
                            <div class="size-selection">
                                <div class="size-option selected" data-value="60x160" data-multiplier="1">
                                    <div class="size-icon">📏</div>
                                    <div class="size-details">
                                        <span class="size-name">Standard</span>
                                        <span class="size-dim">60×160 cm</span>
                                    </div>
                                </div>
                                <div class="size-option" data-value="80x180" data-multiplier="1.5">
                                    <div class="size-icon">📐</div>
                                    <div class="size-details">
                                        <span class="size-name">Medium</span>
                                        <span class="size-dim">80×180 cm</span>
                                    </div>
                                </div>
                                <div class="size-option" data-value="100x200" data-multiplier="2">
                                    <div class="size-icon">📊</div>
                                    <div class="size-details">
                                        <span class="size-name">Large</span>
                                        <span class="size-dim">100×200 cm</span>
                                    </div>
                                </div>
                                <div class="size-option" data-value="custom" data-multiplier="1">
                                    <div class="size-icon">🔧</div>
                                    <div class="size-details">
                                        <span class="size-name">Custom</span>
                                        <span class="size-dim">Sesuai kebutuhan</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="banner_size" id="bannerSize" value="60x160">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-star text-warning me-2"></i>
                                <span class="label-text">Finishing Banner</span>
                            </label>
                            <div class="finishing-options">
                                <div class="finishing-card selected" data-value="none" data-price="0">
                                    <div class="finishing-icon">📄</div>
                                    <div class="finishing-name">Tanpa Finishing</div>
                                    <div class="finishing-price">+Rp 0</div>
                                </div>
                                <div class="finishing-card" data-value="eyelet" data-price="5000">
                                    <div class="finishing-icon">⚪</div>
                                    <div class="finishing-name">Eyelet</div>
                                    <div class="finishing-price">+Rp 5.000</div>
                                </div>
                                <div class="finishing-card" data-value="hem" data-price="8000">
                                    <div class="finishing-icon">✂️</div>
                                    <div class="finishing-name">Hem Jahit</div>
                                    <div class="finishing-price">+Rp 8.000</div>
                                </div>
                                <div class="finishing-card" data-value="laminating" data-price="15000">
                                    <div class="finishing-icon">✨</div>
                                    <div class="finishing-name">Laminasi</div>
                                    <div class="finishing-price">+Rp 15.000</div>
                                </div>
                            </div>
                            <input type="hidden" name="banner_finishing" id="bannerFinishing" value="none">
                        </div>
                    </div>
                    
                    <!-- Signage Options -->
                    <div id="signageOptions" class="product-options" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-signpost text-success me-2"></i>
                                <span class="label-text">Jenis Signage</span>
                            </label>
                            <div class="banner-grid">
                                <div class="banner-option selected" data-value="neon_box" data-price="500000">
                                    <div class="banner-badge">NEON</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Neon Box</span>
                                        <span class="banner-desc">LED Backlight</span>
                                        <span class="banner-price">Rp 500.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="led_sign" data-price="750000">
                                    <div class="banner-badge">LED</div>
                                    <div class="banner-info">
                                        <span class="banner-name">LED Sign</span>
                                        <span class="banner-desc">Digital Display</span>
                                        <span class="banner-price">Rp 750.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="acrylic_sign" data-price="200000">
                                    <div class="banner-badge">ACR</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Acrylic Sign</span>
                                        <span class="banner-desc">Modern Style</span>
                                        <span class="banner-price">Rp 200.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="letter_timbul" data-price="100000">
                                    <div class="banner-badge">3D</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Letter Timbul</span>
                                        <span class="banner-desc">3D Dimension</span>
                                        <span class="banner-price">Rp 100.000</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="signage_type" id="signageType" value="neon_box">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-palette text-warning me-2"></i>
                                <span class="label-text">Material Signage</span>
                            </label>
                            <div class="banner-grid">
                                <div class="banner-option selected" data-value="acrylic" data-price="0">
                                    <div class="banner-badge">ACR</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Acrylic</span>
                                        <span class="banner-desc">Standard</span>
                                        <span class="banner-price">+Rp 0</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="stainless" data-price="50000">
                                    <div class="banner-badge">SS</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Stainless</span>
                                        <span class="banner-desc">Steel Premium</span>
                                        <span class="banner-price">+Rp 50.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="aluminum" data-price="25000">
                                    <div class="banner-badge">ALU</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Aluminum</span>
                                        <span class="banner-desc">Lightweight</span>
                                        <span class="banner-price">+Rp 25.000</span>
                                    </div>
                                </div>
                                <div class="banner-option" data-value="brass" data-price="75000">
                                    <div class="banner-badge">BRS</div>
                                    <div class="banner-info">
                                        <span class="banner-name">Brass</span>
                                        <span class="banner-desc">Kuningan</span>
                                        <span class="banner-price">+Rp 75.000</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="signage_material" id="signageMaterial" value="acrylic">
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
                                Minimum order 1 pcs
                            </small>
                        </div>
                    </div>
                    
                    <!-- Custom Dimensions (conditional) -->
                    <div id="customDimensions" class="form-group" style="display: none;">
                        <label class="form-label">
                            <i class="bi bi-aspect-ratio text-warning me-2"></i>
                            <span class="label-text">Ukuran Custom</span>
                        </label>
                        <div class="dimension-inputs">
                            <div class="dimension-group">
                                <label class="dimension-label">Lebar</label>
                                <div class="input-with-unit">
                                    <input type="number" name="custom_width" id="customWidth" class="form-control" placeholder="60">
                                    <span class="input-unit">cm</span>
                                </div>
                            </div>
                            <div class="dimension-separator">×</div>
                            <div class="dimension-group">
                                <label class="dimension-label">Tinggi</label>
                                <div class="input-with-unit">
                                    <input type="number" name="custom_height" id="customHeight" class="form-control" placeholder="160">
                                    <span class="input-unit">cm</span>
                                </div>
                            </div>
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
                            <input type="file" name="design_file" id="designFile" class="file-input" accept=".jpg,.jpeg,.png,.pdf,.ai,.psd,.cdr,.eps" multiple>
                        </div>
                        <div class="upload-info">
                            <small class="text-muted">
                                📁 Format: JPG, PNG, PDF, AI, PSD, CDR, EPS | 💾 Max: 15MB per file
                            </small>
                        </div>
                    </div>
                    
                    <!-- Notes -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-chat-left-text text-secondary me-2"></i>
                            <span class="label-text">Catatan Tambahan (Opsional)</span>
                        </label>
                        <div class="textarea-wrapper">
                            <textarea name="notes" id="notes" class="form-control enhanced-textarea" rows="4" placeholder="Instruksi khusus, warna, deadline, lokasi instalasi, dll..."></textarea>
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
                            <option value="local" data-cost="25000">Pengiriman Lokal Gresik (Rp 25.000)</option>
                            <option value="regional" data-cost="75000">Pengiriman Regional Jatim (Rp 75.000)</option>
                            <option value="national" data-cost="150000">Pengiriman Nasional (Rp 150.000)</option>
                            <option value="express" data-cost="200000">Express Same Day (Rp 200.000)</option>
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
                <div class="price-summary-card">
                    <div class="price-header">
                        <h5><i class="bi bi-calculator text-primary me-2"></i>Ringkasan Harga</h5>
                        <small class="text-muted">Detail kalkulasi biaya pesanan</small>
                    </div>
                    
                    <div class="price-details">
                        <div class="price-row">
                            <span>Harga Dasar:</span>
                            <span id="basePrice">Rp 0</span>
                        </div>
                        <div class="price-row">
                            <span>Jumlah:</span>
                            <span id="quantityDisplay">0 pcs</span>
                        </div>
                        <div class="price-row">
                            <span>Biaya Tambahan:</span>
                            <span id="additionalCost">Rp 0</span>
                        </div>
                        <div class="price-row" id="discountRow" style="display: none;">
                            <span>Diskon:</span>
                            <span id="discount" class="text-success">- Rp 0</span>
                        </div>
                        <div class="price-row">
                            <span>Ongkos Kirim:</span>
                            <span id="shippingCost">Rp 0</span>
                        </div>
                        <div class="price-row">
                            <span>Pajak (10%):</span>
                            <span id="tax">Rp 0</span>
                        </div>
                        <div class="price-row total">
                            <span>Total:</span>
                            <span id="totalPrice">Rp 0</span>
                        </div>
                    </div>
                    
                    <button type="submit" form="orderForm" id="placeOrder" class="btn btn-primary btn-lg w-100 mt-3" disabled>
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
            <h3 class="fw-bold">Portfolio Banner & Signage</h3>
            <p class="text-muted">Lihat hasil kerja banner & signage berkualitas dari RNR Digital Printing</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-flag portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>X-Banner Event</h5>
                                <p>Flexi Korea Premium, Stand Portable</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-megaphone portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Roll Banner Premium</h5>
                                <p>Roll Up System, Flexi Korea</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-lightbulb portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Neon Box Toko</h5>
                                <p>LED Backlight, Acrylic Premium</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-signpost portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>LED Sign Modern</h5>
                                <p>Digital Display, Stainless Steel</p>
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
                            <h6>Ahmad Zulkarnain</h6>
                            <small>Event Organizer</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Banner X-Banner untuk event kami sangat berkualitas! Stand kokoh dan hasil cetaknya tajam. Pasti akan order lagi!"
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
                            <h6>Sari Dewi</h6>
                            <small>Pemilik Toko</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Neon Box untuk toko kami tampak sangat menarik! LED-nya terang dan awet. Pelanggan lebih mudah menemukan toko kami."
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
                            <small>Marketing Manager</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Roll banner untuk pameran sangat praktis! Mudah dibawa kemana-mana dan kualitas cetaknya profesional."
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
            <h3 class="fw-bold">Proses Pemesanan Banner & Signage</h3>
            <p class="text-muted">Langkah mudah untuk memesan banner & signage berkualitas</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">1</div>
                    <div class="process-icon">
                        <i class="bi bi-flag"></i>
                    </div>
                    <h5>Pilih Jenis Banner</h5>
                    <p>Pilih jenis banner atau signage dan spesifikasi yang sesuai kebutuhan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">2</div>
                    <div class="process-icon">
                        <i class="bi bi-cloud-upload"></i>
                    </div>
                    <h5>Upload Desain</h5>
                    <p>Upload file desain banner atau konsultasi dengan tim kreatif kami</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">3</div>
                    <div class="process-icon">
                        <i class="bi bi-credit-card"></i>
                    </div>
                    <h5>Konfirmasi & Bayar</h5>
                    <p>Konfirmasi pesanan dan lakukan pembayaran sesuai metode pilihan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">4</div>
                    <div class="process-icon">
                        <i class="bi bi-truck"></i>
                    </div>
                    <h5>Produksi & Kirim</h5>
                    <p>Proses produksi banner dan pengiriman atau instalasi sesuai jadwal</p>
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
                                Berapa lama waktu pengerjaan banner dan signage?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Untuk banner (X-Banner, Roll Banner) waktu pengerjaan 1-2 hari kerja. Untuk signage (Neon Box, LED Sign) membutuhkan 3-5 hari kerja tergantung kompleksitas desain.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Apakah bisa cetak banner dengan ukuran custom?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, kami melayani cetak banner dengan ukuran custom sesuai kebutuhan. Silakan pilih opsi "Custom Size" dan masukkan dimensi yang diinginkan.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apa perbedaan Flexi China dan Flexi Korea?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Flexi China adalah material standar untuk outdoor dengan kualitas baik. Flexi Korea adalah material premium dengan ketahanan lebih lama dan hasil cetak lebih tajam.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah menyediakan jasa instalasi signage?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Ya, kami menyediakan jasa instalasi untuk signage seperti Neon Box dan LED Sign. Tim teknis kami berpengalaman dalam instalasi dengan standar keamanan yang tinggi.
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
document.addEventListener('DOMContentLoaded', function() {
    // Initialize form interactions
    initializeFormInteractions();
    
    // Initialize file upload
    initializeFileUpload();
    
    // Initialize order button
    initializeOrderButton();
    
    // Initial price calculation
    calculatePrice();
    
    console.log('Banner form initialized successfully');
    
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

// Global variables
let currentProductType = 'banner';
let appliedPromo = null;

// Initialize form interactions
function initializeFormInteractions() {
    console.log('Initializing form interactions...');
    
    // Product type selection
    const productTypeOptions = document.querySelectorAll('.product-type-option');
    productTypeOptions.forEach(option => {
        option.addEventListener('click', function() {
            console.log('Product type clicked:', this.dataset.value);
            
            // Remove selected class from all options
            document.querySelectorAll('.product-type-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Update hidden input
            const productTypeInput = document.getElementById('productType');
            if (productTypeInput) {
                productTypeInput.value = this.dataset.value;
                currentProductType = this.dataset.value;
            }
            
            // Show/hide relevant options
            if (this.dataset.value === 'banner') {
                document.getElementById('bannerOptions').style.display = 'block';
                document.getElementById('signageOptions').style.display = 'none';
            } else {
                document.getElementById('bannerOptions').style.display = 'none';
                document.getElementById('signageOptions').style.display = 'block';
            }
            
            calculatePrice();
        });
    });
    
    // Banner type selection
    const bannerOptions = document.querySelectorAll('#bannerOptions .banner-option');
    bannerOptions.forEach((option, index) => {
        option.addEventListener('click', function() {
            const parent = this.closest('.form-group');
            const hiddenInput = parent.querySelector('input[type="hidden"]');
            
            // Remove selected class from siblings
            parent.querySelectorAll('.banner-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Update hidden input
            if (hiddenInput) {
                hiddenInput.value = this.dataset.value;
            }
            
            calculatePrice();
        });
    });
    
    // Size selection
    const sizeOptions = document.querySelectorAll('.size-option');
    sizeOptions.forEach(option => {
        option.addEventListener('click', function() {
            // Remove selected class from all options
            document.querySelectorAll('.size-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Update hidden input
            const sizeInput = document.getElementById('bannerSize');
            if (sizeInput) {
                sizeInput.value = this.dataset.value;
            }
            
            // Show/hide custom dimensions
            const customDimensions = document.getElementById('customDimensions');
            if (this.dataset.value === 'custom') {
                customDimensions.style.display = 'block';
            } else {
                customDimensions.style.display = 'none';
            }
            
            calculatePrice();
        });
    });
    
    // Finishing selection
    const finishingCards = document.querySelectorAll('.finishing-card');
    finishingCards.forEach(card => {
        card.addEventListener('click', function() {
            // Remove selected class from all cards
            document.querySelectorAll('.finishing-card').forEach(c => {
                c.classList.remove('selected');
            });
            
            // Add selected class to clicked card
            this.classList.add('selected');
            
            // Update hidden input
            const finishingInput = document.getElementById('bannerFinishing');
            if (finishingInput) {
                finishingInput.value = this.dataset.value;
            }
            
            calculatePrice();
        });
    });
    
    // Signage options (similar to banner options)
    const signageOptions = document.querySelectorAll('#signageOptions .banner-option');
    signageOptions.forEach(option => {
        option.addEventListener('click', function() {
            const parent = this.closest('.form-group');
            const hiddenInput = parent.querySelector('input[type="hidden"]');
            
            // Remove selected class from siblings
            parent.querySelectorAll('.banner-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Update hidden input
            if (hiddenInput) {
                hiddenInput.value = this.dataset.value;
            }
            
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
    
    // Shipping method change
    const shippingMethodSelect = document.getElementById('shippingMethod');
    if (shippingMethodSelect) {
        shippingMethodSelect.addEventListener('change', function() {
            calculatePrice();
        });
    }
    
    // Promo code application
    const applyPromoBtn = document.getElementById('applyPromo');
    if (applyPromoBtn) {
        applyPromoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            applyPromoCode();
        });
    }
    
    // Promo code reset
    const resetPromoBtn = document.getElementById('resetPromo');
    if (resetPromoBtn) {
        resetPromoBtn.addEventListener('click', function(e) {
            e.preventDefault();
            resetPromoCode();
        });
    }
    
    // Character count for notes
    const notesTextarea = document.getElementById('notes');
    const charCount = document.querySelector('.char-count');
    if (notesTextarea && charCount) {
        notesTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500 karakter`;
            
            if (length > 500) {
                charCount.style.color = '#dc3545';
                this.value = this.value.substring(0, 500);
            } else {
                charCount.style.color = '#6c757d';
            }
        });
    }
}

// Initialize file upload functionality
function initializeFileUpload() {
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.getElementById('designFile');
    
    if (!uploadArea || !fileInput) return;
    
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
    
    if (uploadArea) {
        const fileSize = (file.size / 1024 / 1024).toFixed(2);
        
        // Replace upload area content with file info
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
        
        // Re-add click listener
        uploadArea.onclick = function() {
            document.getElementById('designFile').click();
        };
    }
}

// Price calculation function
function calculatePrice() {
    const quantity = document.getElementById('quantity');
    const shippingMethod = document.getElementById('shippingMethod');
    
    if (!quantity || !quantity.value || quantity.value < 1) {
        updatePriceDisplay(0, 0, 0, 0, 0, 0, 0);
        return;
    }
    
    let basePrice = 35000; // Default base price
    let qty = parseInt(quantity.value);
    
    // Calculate base price based on product type and selections
    let additionalCost = 0;
    let sizeMultiplier = 1;
    
    if (currentProductType === 'banner') {
        // Banner type cost
        const selectedBannerType = document.querySelector('#bannerOptions .form-group:first-of-type .banner-option.selected');
        if (selectedBannerType) {
            basePrice = parseInt(selectedBannerType.dataset.price) || basePrice;
        }
        
        // Material cost
        const selectedMaterial = document.querySelector('#bannerOptions .form-group:nth-of-type(2) .banner-option.selected');
        if (selectedMaterial) {
            additionalCost += parseInt(selectedMaterial.dataset.price) || 0;
        }
        
        // Size multiplier
        const selectedSize = document.querySelector('.size-option.selected');
        if (selectedSize) {
            sizeMultiplier = parseFloat(selectedSize.dataset.multiplier) || 1;
        }
        
        // Finishing cost
        const selectedFinishing = document.querySelector('.finishing-card.selected');
        if (selectedFinishing) {
            additionalCost += parseInt(selectedFinishing.dataset.price) || 0;
        }
    } else if (currentProductType === 'signage') {
        // Signage type cost
        const selectedSignageType = document.querySelector('#signageOptions .form-group:first-of-type .banner-option.selected');
        if (selectedSignageType) {
            basePrice = parseInt(selectedSignageType.dataset.price) || basePrice;
        }
        
        // Material cost
        const selectedMaterial = document.querySelector('#signageOptions .form-group:nth-of-type(2) .banner-option.selected');
        if (selectedMaterial) {
            additionalCost += parseInt(selectedMaterial.dataset.price) || 0;
        }
    }
    
    // Calculate totals
    let itemPrice = basePrice + additionalCost;
    let subtotal = (itemPrice * sizeMultiplier) * qty;
    
    // Shipping cost
    let shippingCost = 0;
    if (shippingMethod && shippingMethod.value) {
        const shippingOption = shippingMethod.options[shippingMethod.selectedIndex];
        if (shippingOption && shippingOption.dataset.cost) {
            shippingCost = parseInt(shippingOption.dataset.cost);
        }
    }
    
    // Apply promo discount
    let discount = 0;
    if (appliedPromo) {
        if (appliedPromo.type === 'percentage') {
            discount = subtotal * appliedPromo.value;
        } else if (appliedPromo.type === 'fixed') {
            discount = Math.min(appliedPromo.value, shippingCost);
        }
    }
    
    // Tax calculation (10%)
    let tax = (subtotal - discount + shippingCost) * 0.10;
    
    // Final total
    let total = subtotal - discount + shippingCost + tax;
    
    // Update price display
    updatePriceDisplay(basePrice, subtotal, additionalCost * qty, discount, shippingCost, tax, total);
    
    // Update hidden inputs for form submission
    const totalPriceInput = document.getElementById('totalPriceInput');
    const unitPriceInput = document.getElementById('unitPriceInput');
    const subtotalInput = document.getElementById('subtotalInput');
    const shippingCostInput = document.getElementById('shippingCostInput');
    const taxAmountInput = document.getElementById('taxAmountInput');
    const discountInput = document.getElementById('discountInput');
    const totalInput = document.getElementById('totalInput');
    
    if (totalPriceInput) totalPriceInput.value = total;
    if (unitPriceInput) unitPriceInput.value = itemPrice;
    if (subtotalInput) subtotalInput.value = subtotal;
    if (shippingCostInput) shippingCostInput.value = shippingCost;
    if (taxAmountInput) taxAmountInput.value = tax;
    if (discountInput) discountInput.value = discount;
    if (totalInput) totalInput.value = total;
}

// Update price display function
function updatePriceDisplay(basePrice, subtotal, additionalCost, discount, shippingCost, tax, total) {
    const quantity = document.getElementById('quantity');
    const qty = parseInt(quantity?.value) || 1;
    
    // Update display elements
    const basePriceEl = document.getElementById('basePrice');
    if (basePriceEl) basePriceEl.textContent = formatCurrency(subtotal);
    
    const quantityDisplayEl = document.getElementById('quantityDisplay');
    if (quantityDisplayEl) quantityDisplayEl.textContent = qty + ' pcs';
    
    const additionalCostEl = document.getElementById('additionalCost');
    if (additionalCostEl) additionalCostEl.textContent = formatCurrency(additionalCost);
    
    // Update discount
    const discountRow = document.getElementById('discountRow');
    const discountEl = document.getElementById('discount');
    
    if (discount > 0) {
        if (discountRow) discountRow.style.display = 'flex';
        if (discountEl) discountEl.textContent = '- ' + formatCurrency(discount);
    } else {
        if (discountRow) discountRow.style.display = 'none';
    }
    
    const shippingCostEl = document.getElementById('shippingCost');
    if (shippingCostEl) shippingCostEl.textContent = formatCurrency(shippingCost);
    
    const taxEl = document.getElementById('tax');
    if (taxEl) taxEl.textContent = formatCurrency(tax);
    
    const totalEl = document.getElementById('totalPrice');
    if (totalEl) totalEl.textContent = formatCurrency(total);
    
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
    const promoInput = document.getElementById('promoCode');
    const applyBtn = document.getElementById('applyPromo');
    const feedback = document.getElementById('promoFeedback');
    
    if (!promoInput || !applyBtn) return;
    
    const code = promoInput.value.trim().toUpperCase();
    
    const promoCodes = {
        'HEMAT10': { type: 'percentage', value: 0.10, description: 'Diskon 10%' },
        'NEWUSER15': { type: 'percentage', value: 0.15, description: 'Diskon 15% User Baru' },
        'GRATIS50': { type: 'fixed', value: 50000, description: 'Gratis Ongkir Rp 50.000' }
    };
    
    if (promoCodes[code]) {
        appliedPromo = promoCodes[code];
        promoInput.disabled = true;
        applyBtn.textContent = 'Terapkan';
        applyBtn.disabled = true;
        applyBtn.classList.add('btn-success');
        applyBtn.classList.remove('btn-light');
        
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
    appliedPromo = null;
    
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
    
    if (resetBtn) resetBtn.style.display = 'none';
    
    // Hide feedback
    if (feedback) {
        feedback.style.display = 'none';
        feedback.innerHTML = '';
    }
    
    // Recalculate price
    calculatePrice();
}

// Check if form is valid for submission
function checkFormValid() {
    const productType = document.getElementById('productType');
    const quantity = document.getElementById('quantity');
    const orderBtn = document.getElementById('placeOrder');
    
    const isValid = productType?.value && 
                   quantity?.value && 
                   parseInt(quantity.value) > 0;
    
    if (orderBtn) {
        orderBtn.disabled = !isValid;
    }
    
    return isValid;
}

// Initialize order button functionality
function initializeOrderButton() {
    // Form submission is now handled by the form's action and method attributes
    // The button is type="submit" so it will trigger form submission to checkout
    console.log('Order button initialized for checkout submission');
}
</script>
@endpush
