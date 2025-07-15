@extends('layouts.services')

@section('title', 'Packaging & Label - RNR Digital Printing')
@section('description', 'Layanan cetak packaging dan label berkualitas tinggi. Label stiker, packaging custom, mug sublim dengan hasil yang rapi dan tahan lama.')

@push('styles')
<style>
    /* Hero Section Animations */
    .hero-section {
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
        filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3));
        animation: bounce 2s ease-in-out infinite;
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
        background: linear-gradient(90deg, transparent, rgba(40,167,69,0.4), transparent);
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
        border: 1px solid rgba(40, 167, 69, 0.1);
    }
    
    /* Ensure form elements are clickable and visible */
    .product-option, .material-option, .size-option, .finishing-card, .btn, .form-control, .form-select {
        position: relative;
        pointer-events: auto;
        z-index: 1;
        cursor: pointer;
    }
    
    .product-option, .material-option, .size-option, .finishing-card {
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    /* Make sure selected states are visible */
    .product-option.selected,
    .material-option.selected,
    .size-option.selected,
    .finishing-card.selected {
        border-color: #28a745 !important;
        background: rgba(40, 167, 69, 0.1) !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3) !important;
    }
    
    .form-header {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid rgba(40, 167, 69, 0.1);
    }
    
    .form-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(45deg, #28a745, #20c997);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        margin-right: 20px;
        animation: form-icon-bounce 2s ease-in-out infinite;
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
        background: linear-gradient(45deg, #28a745, #20c997);
        transition: width 0.3s ease;
    }
    
    .form-group:hover .label-text::after {
        width: 100%;
    }
    
    /* Product Type Selection Grid */
    .product-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
        margin-bottom: 10px;
    }
    
    .product-option {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(40, 167, 69, 0.2);
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
    
    .product-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .product-option:hover::before {
        left: 100%;
    }
    
    .product-option:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.2);
        border-color: rgba(40, 167, 69, 0.4);
    }
    
    .product-option.selected {
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    }
    
    .product-badge {
        width: 45px;
        height: 45px;
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 1.2rem;
        margin-right: 15px;
    }
    
    .product-info {
        display: flex;
        flex-direction: column;
        flex: 1;
    }
    
    .product-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.95rem;
        margin-bottom: 2px;
    }
    
    .product-desc {
        color: #6c757d;
        font-size: 0.8rem;
    }
    
    /* Material Selection */
    .material-selection {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }
    
    .material-option {
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
    
    .material-option::before {
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
    
    .material-option:hover::before {
        transform: translateY(0);
    }
    
    .material-option:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.2);
        border-color: #28a745;
    }
    
    .material-option.selected {
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
    }
    
    .material-icon {
        font-size: 1.5rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
    }
    
    .material-details {
        display: flex;
        flex-direction: column;
    }
    
    .material-name {
        font-weight: 600;
        color: #2c3e50;
        font-size: 0.9rem;
        margin-bottom: 3px;
    }
    
    .material-price {
        color: #28a745;
        font-weight: 600;
        font-size: 0.8rem;
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
        border: 2px solid rgba(255, 193, 7, 0.2);
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
    
    .size-option::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255, 193, 7, 0.1), rgba(253, 126, 20, 0.1));
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }
    
    .size-option:hover::before {
        transform: translateY(0);
    }
    
    .size-option:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(255, 193, 7, 0.2);
        border-color: #ffc107;
    }
    
    .size-option.selected {
        border-color: #ffc107;
        background: rgba(255, 193, 7, 0.1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
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
        border: 2px solid rgba(253, 126, 20, 0.3);
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
    
    .finishing-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(253, 126, 20, 0.1), rgba(255, 193, 7, 0.1));
        transform: scale(0) rotate(180deg);
        transition: transform 0.3s ease;
        border-radius: 50%;
    }
    
    .finishing-card:hover::before {
        transform: scale(2) rotate(0deg);
    }
    
    .finishing-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 25px rgba(253, 126, 20, 0.2);
        border-color: #fd7e14;
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
        border: 2px solid rgba(40, 167, 69, 0.2);
        border-radius: 15px;
        overflow: hidden;
        max-width: 200px;
    }
    
    .quantity-btn {
        width: 45px;
        height: 50px;
        border: none;
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        font-size: 1.2rem;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .quantity-btn::before {
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
    
    .quantity-btn:hover::before {
        width: 80px;
        height: 80px;
    }
    
    .quantity-btn:hover {
        background: linear-gradient(45deg, #218838, #1e9b82);
        transform: scale(1.1);
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.4);
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
        border: 2px dashed rgba(40, 167, 69, 0.3);
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
        background: linear-gradient(90deg, transparent, rgba(40, 167, 69, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .upload-area:hover::before {
        left: 100%;
    }
    
    .upload-area:hover {
        border-color: #28a745;
        background: rgba(40, 167, 69, 0.05);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 10px 30px rgba(40, 167, 69, 0.2);
    }
    
    .upload-icon {
        font-size: 2.5rem;
        color: #28a745;
        margin-bottom: 15px;
        animation: uploadPulse 2s ease-in-out infinite;
    }
    
    @keyframes uploadPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
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
        background: linear-gradient(135deg, #28a745, #20c997);
        color: white;
        border-color: #28a745;
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
    
    /* Enhanced Select */
    .select-wrapper {
        position: relative;
    }
    
    .enhanced-select {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(40, 167, 69, 0.2);
        border-radius: 15px;
        padding: 15px 20px;
        font-size: 1rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .enhanced-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        transform: translateY(-2px);
        background: white;
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
        border: 2px solid rgba(40, 167, 69, 0.2);
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
        color: #28a745;
        margin-top: 20px;
    }
    
    /* Enhanced Textarea */
    .textarea-wrapper {
        position: relative;
    }
    
    .enhanced-textarea {
        background: rgba(255, 255, 255, 0.9);
        border: 2px solid rgba(40, 167, 69, 0.2);
        border-radius: 15px;
        padding: 15px;
        resize: vertical;
        min-height: 100px;
        transition: all 0.3s ease;
    }
    
    .enhanced-textarea:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
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
    
    /* Product Specs */
    .product-specs {
        background: linear-gradient(145deg, white, #f8f9fa);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
        border: 1px solid rgba(40, 167, 69, 0.1);
    }
    
    .product-specs:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }
    
    .spec-icon-wrapper {
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #28a745, #20c997);
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
        border: 1px solid rgba(40, 167, 69, 0.1);
        transition: all 0.3s ease;
    }
    
    .spec-category:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.15);
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
        background: rgba(40, 167, 69, 0.05);
        border-radius: 10px;
        transition: all 0.3s ease;
    }
    
    .spec-item:hover {
        background: rgba(40, 167, 69, 0.1);
        transform: translateX(5px);
    }
    
    .spec-badge {
        width: 40px;
        height: 40px;
        background: linear-gradient(45deg, #28a745, #20c997);
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
    
    /* Price Display */
    .price-display {
        font-size: 2.5rem;
        font-weight: bold;
        background: linear-gradient(45deg, #28a745, #20c997);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: glow 2s ease-in-out infinite alternate;
    }
    
    @keyframes glow {
        from { filter: drop-shadow(0 0 5px rgba(40, 167, 69, 0.5)); }
        to { filter: drop-shadow(0 0 20px rgba(40, 167, 69, 0.8)); }
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
        background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        color: white;
        border-radius: 20px;
        padding: 25px;
        margin: 20px 0;
        box-shadow: 0 8px 32px rgba(40, 167, 69, 0.3);
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
    
    .promo-section #applyPromo {
        background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%) !important;
        border: none !important;
        color: white !important;
        font-weight: bold;
        padding: 12px 20px;
        border-radius: 0 12px 12px 0;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
    }
    
    .promo-section #applyPromo:hover {
        background: linear-gradient(135deg, #e0a800 0%, #dc6d02 100%) !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 193, 7, 0.4);
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
    
    .btn-success {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-success:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.4);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #28a745, #20c997);
        border: none;
        border-radius: 25px;
        padding: 12px 30px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(40, 167, 69, 0.4);
    }
    
    /* Form controls */
    .form-control, .form-select {
        border-radius: 15px;
        border: 2px solid transparent;
        background: rgba(255, 255, 255, 0.9);
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25);
        transform: translateY(-2px);
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
    
    /* Auto-visible for immediate display */
    .fade-in:nth-child(1) { animation: fadeInUp 0.6s ease forwards; }
    .fade-in:nth-child(2) { animation: fadeInUp 0.6s ease 0.2s forwards; }
    .fade-in:nth-child(3) { animation: fadeInUp 0.6s ease 0.4s forwards; }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
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
        border-top: 2px solid #28a745;
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
        background: linear-gradient(135deg, #28a745, #20c997);
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
        border: 1px solid rgba(40, 167, 69, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .testimonial-card::before {
        content: '"';
        position: absolute;
        top: -10px;
        right: 20px;
        font-size: 6rem;
        color: rgba(40, 167, 69, 0.1);
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
        background: linear-gradient(45deg, #28a745, #20c997);
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
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        border: 1px solid rgba(40, 167, 69, 0.1);
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
        background: linear-gradient(45deg, #28a745, #20c997);
    }

    .process-step:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .process-number {
        position: absolute;
        top: -25px;
        right: 15px;
        width: 50px;
        height: 50px;
        background: linear-gradient(45deg, #28a745, #20c997) !important;
        color: white !important;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900 !important;
        font-size: 1.6rem !important;
        box-shadow: 0 8px 25px rgba(40, 167, 69, 0.7), inset 0 2px 4px rgba(255,255,255,0.3);
        border: 4px solid white;
        z-index: 25 !important;
        text-shadow: 2px 2px 6px rgba(0,0,0,0.9) !important;
        font-family: 'Arial Black', Arial, sans-serif !important;
        animation: numberPulse 2s ease-in-out infinite;
    }

    @keyframes numberPulse {
        0%, 100% { 
            transform: scale(1); 
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.7), inset 0 2px 4px rgba(255,255,255,0.3); 
        }
        50% { 
            transform: scale(1.15); 
            box-shadow: 0 12px 35px rgba(40, 167, 69, 0.9), inset 0 2px 4px rgba(255,255,255,0.5); 
        }
    }
    
    .process-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(45deg, #28a745, #20c997);
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
                        <li class="breadcrumb-item active">Packaging & Label</li>
                    </ol>
                </nav>
                <h1 class="display-5 fw-bold mb-3">Packaging & Label</h1>
                <p class="lead">Label Stiker, Packaging Custom, Mug Sublim dengan hasil yang rapi dan tahan lama</p>
            </div>
            <div class="col-lg-4 text-center fade-in">
                <i class="bi bi-box hero-icon"></i>
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
                            <img src="{{ asset('template/assets/packaging-1.jpg') }}" class="d-block w-100" alt="Packaging 1">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('template/assets/packaging-2.jpg') }}" class="d-block w-100" alt="Packaging 2">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('template/assets/packaging-3.jpg') }}" class="d-block w-100" alt="Packaging 3">
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
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div>
                            <h5 class="mb-1">Spesifikasi Produk</h5>
                            <small class="text-muted">Detail lengkap produk packaging & label</small>
                        </div>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-tags text-success me-2"></i>
                                    <strong>Jenis Label Available</strong>
                                </div>
                                <div class="spec-grid">
                                    <div class="spec-item">
                                        <div class="spec-badge">VIN</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Vinyl Doff/Glossy</span>
                                            <span class="spec-desc">Tahan air & UV</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">BON</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Bontak Paper</span>
                                            <span class="spec-desc">Bahan kertas</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">TRA</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Transparan</span>
                                            <span class="spec-desc">Clear material</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">HOL</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Hologram</span>
                                            <span class="spec-desc">Anti counterfeit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-scissors text-warning me-2"></i>
                                    <strong>Cutting Options</strong>
                                </div>
                                <div class="spec-grid">
                                    <div class="spec-item">
                                        <div class="spec-badge">◼</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Square Cut</span>
                                            <span class="spec-desc">Potong kotak</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">✂</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Kiss Cut</span>
                                            <span class="spec-desc">Potong kiss</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">🔷</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Die Cut</span>
                                            <span class="spec-desc">Custom shape</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="spec-category">
                                <div class="spec-header">
                                    <i class="bi bi-box text-primary me-2"></i>
                                    <strong>Packaging Custom</strong>
                                </div>
                                <div class="spec-grid">
                                    <div class="spec-item">
                                        <div class="spec-badge">☕</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Mug Sublim</span>
                                            <span class="spec-desc">Custom print</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">📦</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Box Custom</span>
                                            <span class="spec-desc">Various size</span>
                                        </div>
                                    </div>
                                    <div class="spec-item">
                                        <div class="spec-badge">🛍</div>
                                        <div class="spec-details">
                                            <span class="spec-name">Paper Bag</span>
                                            <span class="spec-desc">Eco friendly</span>
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
                <form id="orderForm" class="form-section fade-in" action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="bi bi-basket"></i>
                        </div>
                        <div class="form-title">
                            <h4 class="mb-1">Form Pemesanan</h4>
                            <small class="text-muted">Isi detail pesanan packaging & label Anda</small>
                        </div>
                    </div>
                    
                    @csrf
                    
                    <!-- Hidden service type field -->
                    <input type="hidden" name="service_type" value="packaging">
                    
                    <!-- Product Type Selection -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-box text-success me-2"></i>
                            <span class="label-text">Jenis Produk</span>
                        </label>
                        <div class="product-grid">
                            <div class="product-option selected" data-value="label_stiker">
                                <div class="product-badge">🏷️</div>
                                <div class="product-info">
                                    <span class="product-name">Label Stiker</span>
                                    <span class="product-desc">Vinyl, Bontak, Transparan</span>
                                </div>
                            </div>
                            <div class="product-option" data-value="packaging_custom">
                                <div class="product-badge">📦</div>
                                <div class="product-info">
                                    <span class="product-name">Packaging Custom</span>
                                    <span class="product-desc">Mug, Box, Paper Bag</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="product_type" id="productType" value="label_stiker" required>
                    </div>
                    
                    <!-- Label Stiker Options -->
                    <div id="labelStikerOptions" class="product-options">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-tags text-success me-2"></i>
                                <span class="label-text">Jenis Material</span>
                            </label>
                            <div class="material-selection">
                                <div class="material-option selected" data-value="vinyl_doff" data-price="3000">
                                    <div class="material-icon">VD</div>
                                    <div class="material-details">
                                        <span class="material-name">Vinyl Doff</span>
                                        <span class="material-price">+Rp 3.000</span>
                                    </div>
                                </div>
                                <div class="material-option" data-value="vinyl_glossy" data-price="3500">
                                    <div class="material-icon">VG</div>
                                    <div class="material-details">
                                        <span class="material-name">Vinyl Glossy</span>
                                        <span class="material-price">+Rp 3.500</span>
                                    </div>
                                </div>
                                <div class="material-option" data-value="bontak" data-price="2500">
                                    <div class="material-icon">BT</div>
                                    <div class="material-details">
                                        <span class="material-name">Bontak</span>
                                        <span class="material-price">+Rp 2.500</span>
                                    </div>
                                </div>
                                <div class="material-option" data-value="transparan" data-price="4000">
                                    <div class="material-icon">TR</div>
                                    <div class="material-details">
                                        <span class="material-name">Transparan</span>
                                        <span class="material-price">+Rp 4.000</span>
                                    </div>
                                </div>
                                <div class="material-option" data-value="hologram" data-price="8000">
                                    <div class="material-icon">HG</div>
                                    <div class="material-details">
                                        <span class="material-name">Hologram</span>
                                        <span class="material-price">+Rp 8.000</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="material_type" id="materialType" value="vinyl_doff">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-scissors text-warning me-2"></i>
                                <span class="label-text">Jenis Cutting</span>
                            </label>
                            <div class="finishing-options">
                                <div class="finishing-card selected" data-value="kotak" data-price="0">
                                    <div class="finishing-icon">◼️</div>
                                    <div class="finishing-name">Square Cut</div>
                                    <div class="finishing-price">+Rp 0</div>
                                </div>
                                <div class="finishing-card" data-value="kiss_cut" data-price="1000">
                                    <div class="finishing-icon">✂️</div>
                                    <div class="finishing-name">Kiss Cut</div>
                                    <div class="finishing-price">+Rp 1.000</div>
                                </div>
                                <div class="finishing-card" data-value="die_cut" data-price="5000">
                                    <div class="finishing-icon">🔷</div>
                                    <div class="finishing-name">Die Cut</div>
                                    <div class="finishing-price">+Rp 5.000</div>
                                </div>
                            </div>
                            <input type="hidden" name="cut_type" id="cutType" value="kotak">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-rulers text-warning me-2"></i>
                                <span class="label-text">Ukuran Stiker</span>
                            </label>
                            <div class="size-selection">
                                <div class="size-option selected" data-value="5x5" data-multiplier="1">
                                    <div class="size-icon">5×5</div>
                                    <div class="size-details">
                                        <span class="size-name">Small</span>
                                        <span class="size-dim">5×5 cm</span>
                                    </div>
                                </div>
                                <div class="size-option" data-value="7x7" data-multiplier="1.5">
                                    <div class="size-icon">7×7</div>
                                    <div class="size-details">
                                        <span class="size-name">Medium</span>
                                        <span class="size-dim">7×7 cm</span>
                                    </div>
                                </div>
                                <div class="size-option" data-value="10x10" data-multiplier="2">
                                    <div class="size-icon">10×10</div>
                                    <div class="size-details">
                                        <span class="size-name">Large</span>
                                        <span class="size-dim">10×10 cm</span>
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
                            <input type="hidden" name="sticker_size" id="stickerSize" value="5x5">
                        </div>
                    </div>
                    
                    <!-- Packaging Custom Options -->
                    <div id="packagingCustomOptions" class="product-options" style="display: none;">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-box-seam text-primary me-2"></i>
                                <span class="label-text">Jenis Packaging</span>
                            </label>
                            <div class="material-selection">
                                <div class="material-option selected" data-value="mug_sublim" data-price="25000">
                                    <div class="material-icon">☕</div>
                                    <div class="material-details">
                                        <span class="material-name">Mug Sublim</span>
                                        <span class="material-price">+Rp 25.000</span>
                                    </div>
                                </div>
                                <div class="material-option" data-value="box_custom" data-price="15000">
                                    <div class="material-icon">📦</div>
                                    <div class="material-details">
                                        <span class="material-name">Box Custom</span>
                                        <span class="material-price">+Rp 15.000</span>
                                    </div>
                                </div>
                                <div class="material-option" data-value="paper_bag" data-price="8000">
                                    <div class="material-icon">🛍️</div>
                                    <div class="material-details">
                                        <span class="material-name">Paper Bag</span>
                                        <span class="material-price">+Rp 8.000</span>
                                    </div>
                                </div>
                                <div class="material-option" data-value="standing_pouch" data-price="12000">
                                    <div class="material-icon">📋</div>
                                    <div class="material-details">
                                        <span class="material-name">Standing Pouch</span>
                                        <span class="material-price">+Rp 12.000</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="packaging_type" id="packagingType" value="mug_sublim">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">
                                <i class="bi bi-rulers text-warning me-2"></i>
                                <span class="label-text">Ukuran/Kapasitas</span>
                            </label>
                            <div class="size-selection">
                                <div class="size-option selected" data-value="small" data-multiplier="1">
                                    <div class="size-icon">S</div>
                                    <div class="size-details">
                                        <span class="size-name">Small</span>
                                        <span class="size-dim">Kecil</span>
                                    </div>
                                </div>
                                <div class="size-option" data-value="medium" data-multiplier="1.5">
                                    <div class="size-icon">M</div>
                                    <div class="size-details">
                                        <span class="size-name">Medium</span>
                                        <span class="size-dim">Sedang</span>
                                    </div>
                                </div>
                                <div class="size-option" data-value="large" data-multiplier="2">
                                    <div class="size-icon">L</div>
                                    <div class="size-details">
                                        <span class="size-name">Large</span>
                                        <span class="size-dim">Besar</span>
                                    </div>
                                </div>
                                <div class="size-option" data-value="xl" data-multiplier="2.5">
                                    <div class="size-icon">XL</div>
                                    <div class="size-details">
                                        <span class="size-name">Extra Large</span>
                                        <span class="size-dim">Sangat besar</span>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="packaging_size" id="packagingSize" value="small">
                        </div>
                        
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
                                <div class="finishing-card" data-value="laminating" data-price="2000">
                                    <div class="finishing-icon">✨</div>
                                    <div class="finishing-name">Laminasi</div>
                                    <div class="finishing-price">+Rp 2.000</div>
                                </div>
                                <div class="finishing-card" data-value="emboss" data-price="5000">
                                    <div class="finishing-icon">🏷️</div>
                                    <div class="finishing-name">Emboss</div>
                                    <div class="finishing-price">+Rp 5.000</div>
                                </div>
                                <div class="finishing-card" data-value="hot_print" data-price="7000">
                                    <div class="finishing-icon">🔥</div>
                                    <div class="finishing-name">Hot Print</div>
                                    <div class="finishing-price">+Rp 7.000</div>
                                </div>
                            </div>
                            <input type="hidden" name="packaging_finishing" id="packagingFinishing" value="none">
                        </div>
                    </div>
                    
                    <!-- Quantity -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-calculator text-info me-2"></i>
                            <span class="label-text">Jumlah</span>
                        </label>
                        <div class="quantity-wrapper">
                            <button type="button" class="quantity-btn minus" data-action="decrease">-</button>
                            <input type="number" name="quantity" id="quantity" class="quantity-input" min="1" value="1" required>
                            <button type="button" class="quantity-btn plus" data-action="increase">+</button>
                        </div>
                        <div class="quantity-info">
                            <small class="text-muted">
                                <i class="bi bi-info-circle me-1"></i>
                                Tidak Ada Minimum Order
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
                                    <input type="number" name="custom_width" id="customWidth" class="form-control" placeholder="5">
                                    <span class="input-unit">cm</span>
                                </div>
                            </div>
                            <div class="dimension-separator">×</div>
                            <div class="dimension-group">
                                <label class="dimension-label">Tinggi</label>
                                <div class="input-with-unit">
                                    <input type="number" name="custom_height" id="customHeight" class="form-control" placeholder="5">
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
                        <div class="upload-area">
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
                    
                    <!-- Notes -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-chat-left-text text-secondary me-2"></i>
                            <span class="label-text">Catatan Khusus (Opsional)</span>
                        </label>
                        <div class="textarea-wrapper">
                            <textarea name="notes" id="notes" class="form-control enhanced-textarea" rows="4" placeholder="Instruksi khusus, warna, deadline, dll..."></textarea>
                            <div class="textarea-footer">
                                <span class="char-count">0/500 karakter</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Customer Information -->
                    <hr class="my-4">
                    <h5 class="mb-3"><i class="bi bi-person text-success me-2"></i>Informasi Kontak</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama Lengkap</label>
                            <input type="text" name="customer_name" id="customerName" class="form-control enhanced-select" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">No. Telepon</label>
                            <input type="tel" name="customer_phone" id="customerPhone" class="form-control enhanced-select" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="customer_email" id="customerEmail" class="form-control enhanced-select" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea name="customer_address" id="customerAddress" class="form-control enhanced-textarea" rows="2" required></textarea>
                    </div>
                    
                    <!-- Shipping -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Metode Pengiriman</label>
                        <select name="shipping_method" id="shippingMethod" class="form-select enhanced-select" required>
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
                            <button type="button" id="applyPromo" class="btn">
                                <i class="bi bi-check-circle me-1"></i>Gunakan
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
                        <span>Harga Dasar:</span>
                        <span id="basePrice">Rp 0</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Jumlah:</span>
                        <span id="quantityDisplay">0 pcs</span>
                    </div>
                    {{-- <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span id="subtotal">Rp 0</span>
                    </div> --}}
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
                        <span>Pajak (10%):</span>
                        <span id="tax">Rp 0</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong class="fs-5">Total:</strong>
                        <strong class="fs-4 text-success" id="totalPrice">Rp 0</strong>
                    </div>
                    
                    <button type="button" id="placeOrder" class="btn btn-primary btn-lg w-100 mt-3" disabled>
                        <i class="bi bi-cart-check me-2"></i>Lanjutkan ke Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5 fade-in">
            <h3 class="fw-bold">Portfolio Packaging & Label</h3>
            <p class="text-muted">Lihat hasil kerja berkualitas tinggi dari RNR Digital Printing</p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-tags portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Label Produk UMKM</h5>
                                <p>Vinyl Doff dengan hasil tajam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-box-seam portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Box Kemasan Makanan</h5>
                                <p>Custom design dengan finishing menarik</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 fade-in">
                <div class="portfolio-card">
                    <div class="portfolio-image">
                        <div class="portfolio-placeholder">
                            <i class="bi bi-cup portfolio-icon"></i>
                        </div>
                        <div class="portfolio-overlay">
                            <div class="portfolio-info">
                                <h5>Mug Sublim Custom</h5>
                                <p>Print berkualitas tahan lama</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Customer Testimonials -->
<section class="py-4">
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
                            <h6>Rina Sari</h6>
                            <small>Owner UMKM</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Label stiker untuk produk UMKM saya sangat berkualitas! Tahan air dan tidak mudah lepas. Hasil cetak vinyl doff sangat memuaskan!"
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
                            <h6>Budi Hartono</h6>
                            <small>Pemilik Cafe</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Paper bag custom untuk cafe kami sangat bagus! Design sesuai request dan kualitas bahan eco-friendly. Pelanggan suka!"
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
                            <small>Brand Manager</small>
                        </div>
                        <div class="testimonial-rating">
                            ⭐⭐⭐⭐⭐
                        </div>
                    </div>
                    <div class="testimonial-content">
                        "Mug sublim untuk merchandise company sangat cantik! Warna tajam dan awet dicuci berkali-kali. Recommended!"
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
            <p class="text-muted">Langkah mudah untuk memesan packaging & label berkualitas</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <div class="col-lg-3 col-md-6 fade-in">
                <div class="process-step">
                    <div class="process-number">1</div>
                    <div class="process-icon">
                        <i class="bi bi-box-seam"></i>
                    </div>
                    <h5>Pilih Produk</h5>
                    <p>Pilih jenis packaging/label dan spesifikasi yang diinginkan</p>
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
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <h3 class="text-center mb-4">Frequently Asked Questions</h3>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Berapa lama waktu pengerjaan packaging & label?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Untuk label stiker regular, waktu pengerjaan 1-2 hari kerja. Untuk packaging custom seperti mug sublim dan box custom, memerlukan 2-3 hari kerja. Tersedia juga layanan express dalam 24 jam dengan tambahan biaya.
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
                                Ya, kami melayani cetak dengan ukuran custom untuk semua jenis produk. Silakan pilih opsi "Custom Size" dan masukkan dimensi yang diinginkan. Tim kami akan memberikan quote harga sesuai spesifikasi.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Format file apa yang diterima untuk packaging & label?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Kami menerima format JPG, PNG, PDF, AI, PSD, CDR. Untuk hasil terbaik, gunakan format vektor (AI, CDR) dengan resolusi 300 DPI. Untuk mug sublim dan packaging 3D, sediakan file dengan bleed area.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Apakah ada minimum order untuk packaging & label?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Minimum order berbeda untuk setiap produk: Label stiker minimum 100 pcs, Paper bag minimum 50 pcs, Box custom minimum 25 pcs, Mug sublim minimum 12 pcs. Untuk quantity lebih besar, tersedia diskon menarik.
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Bagaimana ketahanan label stiker vinyl?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Label stiker vinyl kami tahan air, UV, dan cuaca ekstrem. Vinyl doff dan glossy dapat bertahan 3-5 tahun untuk penggunaan outdoor. Sangat cocok untuk produk UMKM, kemasan makanan, dan branding.
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
// Global variables
let currentProductType = 'label_stiker';
let appliedPromo = null;

// Base prices for different product types
const basePrices = {
    'label_stiker': 1000,
    'packaging_custom': 5000
};

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing packaging form...');
    
    // Check if all form elements exist
    checkFormElements();
    
    // Initialize form interactions
    initializeFormInteractions();
    
    // Initialize file upload
    initializeFileUpload();
    
    // Initialize order button
    initializeOrderButton();
    
    // Additional file upload initialization after a delay
    setTimeout(() => {
        console.log('Re-initializing file upload after delay...');
        initializeFileUpload();
    }, 100);
    
    // Initial price calculation after a short delay to ensure all elements are ready
    setTimeout(() => {
        console.log('Running initial price calculation...');
        
        // Ensure default selections are set
        initializeDefaultSelections();
        
        // Run price calculation
        calculatePrice();
        
        // Run price calculation again after another short delay for reliability
        setTimeout(() => {
            console.log('Running backup price calculation...');
            calculatePrice();
        }, 200);
    }, 500);
    
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
    
    console.log('Packaging form initialized successfully');
});

// Initialize default selections
function initializeDefaultSelections() {
    console.log('Initializing default selections...');
    
    // Set default product type
    currentProductType = 'label_stiker';
    
    // Ensure label stiker is selected by default
    const labelStikerOption = document.querySelector('.product-option[data-value="label_stiker"]');
    if (labelStikerOption) {
        document.querySelectorAll('.product-option').forEach(opt => opt.classList.remove('selected'));
        labelStikerOption.classList.add('selected');
        console.log('Label stiker option selected');
    }
    
    // Set default material selection for label stiker
    const defaultMaterial = document.querySelector('#labelStikerOptions .material-option[data-value="vinyl_doff"]');
    if (defaultMaterial) {
        document.querySelectorAll('#labelStikerOptions .material-option').forEach(opt => opt.classList.remove('selected'));
        defaultMaterial.classList.add('selected');
        console.log('Default material selected: vinyl_doff');
    }
    
    // Set default size selection
    const defaultSize = document.querySelector('#labelStikerOptions .size-option[data-value="5x5"]');
    if (defaultSize) {
        document.querySelectorAll('#labelStikerOptions .size-option').forEach(opt => opt.classList.remove('selected'));
        defaultSize.classList.add('selected');
        console.log('Default size selected: 5x5');
    }
    
    // Set default cut type
    const defaultCut = document.querySelector('#labelStikerOptions .finishing-card[data-value="kotak"]');
    if (defaultCut) {
        document.querySelectorAll('#labelStikerOptions .finishing-card').forEach(opt => opt.classList.remove('selected'));
        defaultCut.classList.add('selected');
        console.log('Default cut selected: kotak');
    }
    
    // Ensure quantity is set
    const quantityInput = document.getElementById('quantity');
    if (quantityInput && !quantityInput.value) {
        quantityInput.value = 1;
        console.log('Default quantity set: 1');
    }
    
    // Update hidden inputs
    const productTypeInput = document.getElementById('productType');
    if (productTypeInput) productTypeInput.value = 'label_stiker';
    
    const materialTypeInput = document.getElementById('materialType');
    if (materialTypeInput) materialTypeInput.value = 'vinyl_doff';
    
    const stickerSizeInput = document.getElementById('stickerSize');
    if (stickerSizeInput) stickerSizeInput.value = '5x5';
    
    const cutTypeInput = document.getElementById('cutType');
    if (cutTypeInput) cutTypeInput.value = 'kotak';
    
    // Show label stiker options and hide packaging options
    const labelOptions = document.getElementById('labelStikerOptions');
    const packagingOptions = document.getElementById('packagingCustomOptions');
    
    if (labelOptions) {
        labelOptions.style.display = 'block';
        console.log('Label options shown');
    }
    if (packagingOptions) {
        packagingOptions.style.display = 'none';
        console.log('Packaging options hidden');
    }
    
    console.log('Default selections initialized successfully');
    
    // Immediately calculate price after setting defaults
    setTimeout(() => {
        console.log('Calculating price immediately after defaults...');
        calculatePrice();
    }, 50);
}

// Initialize form interactions
function initializeFormInteractions() {
    console.log('Initializing packaging form interactions...');
    
    // Product type selection
    const productOptions = document.querySelectorAll('.product-option');
    console.log('Found product options:', productOptions.length);
    
    productOptions.forEach((option, index) => {
        console.log(`Setting up product option ${index}:`, option.dataset.value);
        option.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Product option clicked:', this.dataset.value);
            
            // Remove selected from all
            document.querySelectorAll('.product-option').forEach(opt => {
                opt.classList.remove('selected');
            });
            
            // Add selected to clicked
            this.classList.add('selected');
            
            const productType = this.dataset.value;
            currentProductType = productType;
            
            const productTypeInput = document.getElementById('productType');
            if (productTypeInput) {
                productTypeInput.value = productType;
                console.log('Updated product type input:', productType);
            }
            
            // Show/hide relevant options
            const labelOptions = document.getElementById('labelStikerOptions');
            const packagingOptions = document.getElementById('packagingCustomOptions');
            
            if (labelOptions) {
                labelOptions.style.display = productType === 'label_stiker' ? 'block' : 'none';
                console.log('Label options display:', labelOptions.style.display);
            }
            if (packagingOptions) {
                packagingOptions.style.display = productType === 'packaging_custom' ? 'block' : 'none';
                console.log('Packaging options display:', packagingOptions.style.display);
            }
            
            // Reset selections when switching product type
            resetSelections(productType);
            
            calculatePrice();
        });
    });
    
    // Material selection
    const materialOptions = document.querySelectorAll('.material-option');
    console.log('Found material options:', materialOptions.length);
    
    materialOptions.forEach((option, index) => {
        console.log(`Setting up material option ${index}:`, option.dataset.value);
        option.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Material option clicked:', this.dataset.value, 'Price:', this.dataset.price);
            
            const container = this.closest('.material-selection');
            if (container) {
                container.querySelectorAll('.material-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
            }
            this.classList.add('selected');
            
            // Update hidden input based on context
            if (currentProductType === 'label_stiker') {
                const materialTypeInput = document.getElementById('materialType');
                if (materialTypeInput) {
                    materialTypeInput.value = this.dataset.value;
                    console.log('Updated material type:', this.dataset.value);
                }
            } else {
                const packagingTypeInput = document.getElementById('packagingType');
                if (packagingTypeInput) {
                    packagingTypeInput.value = this.dataset.value;
                    console.log('Updated packaging type:', this.dataset.value);
                }
            }
            
            calculatePrice();
        });
    });
    
    // Size selection
    const sizeOptions = document.querySelectorAll('.size-option');
    console.log('Found size options:', sizeOptions.length);
    
    sizeOptions.forEach((option, index) => {
        console.log(`Setting up size option ${index}:`, option.dataset.value);
        option.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Size option clicked:', this.dataset.value, 'Multiplier:', this.dataset.multiplier);
            
            const container = this.closest('.size-selection');
            if (container) {
                container.querySelectorAll('.size-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
            }
            this.classList.add('selected');
            
            // Update hidden input based on context
            if (currentProductType === 'label_stiker') {
                const stickerSizeInput = document.getElementById('stickerSize');
                if (stickerSizeInput) {
                    stickerSizeInput.value = this.dataset.value;
                    console.log('Updated sticker size:', this.dataset.value);
                }
                
                // Show/hide custom dimensions
                const customDimensions = document.getElementById('customDimensions');
                if (customDimensions) {
                    customDimensions.style.display = this.dataset.value === 'custom' ? 'block' : 'none';
                }
            } else {
                const packagingSizeInput = document.getElementById('packagingSize');
                if (packagingSizeInput) {
                    packagingSizeInput.value = this.dataset.value;
                    console.log('Updated packaging size:', this.dataset.value);
                }
            }
            
            calculatePrice();
        });
    });
    
    // Finishing selection
    const finishingCards = document.querySelectorAll('.finishing-card');
    console.log('Found finishing options:', finishingCards.length);
    
    finishingCards.forEach((card, index) => {
        console.log(`Setting up finishing option ${index}:`, card.dataset.value);
        card.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Finishing option clicked:', this.dataset.value, 'Price:', this.dataset.price);
            
            const container = this.closest('.finishing-options');
            if (container) {
                container.querySelectorAll('.finishing-card').forEach(c => {
                    c.classList.remove('selected');
                });
            }
            this.classList.add('selected');
            
            // Update hidden input based on context
            if (currentProductType === 'label_stiker') {
                const cutTypeInput = document.getElementById('cutType');
                if (cutTypeInput) {
                    cutTypeInput.value = this.dataset.value;
                    console.log('Updated cut type:', this.dataset.value);
                }
            } else {
                const packagingFinishingInput = document.getElementById('packagingFinishing');
                if (packagingFinishingInput) {
                    packagingFinishingInput.value = this.dataset.value;
                    console.log('Updated packaging finishing:', this.dataset.value);
                }
            }
            
            calculatePrice();
        });
    });
    
    // Quantity controls
    setupQuantityControls();
    
    // Shipping method change
    const shippingMethod = document.getElementById('shippingMethod');
    if (shippingMethod) {
        shippingMethod.addEventListener('change', function() {
            console.log('Shipping method changed:', this.value);
            calculatePrice();
        });
    }
    
    // Promo code application
    const applyPromoBtn = document.getElementById('applyPromo');
    console.log('Found apply promo button:', applyPromoBtn);
    if (applyPromoBtn) {
        applyPromoBtn.addEventListener('click', function(e) {
            console.log('Apply promo button clicked!');
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
            console.log('Reset promo button clicked!');
            e.preventDefault();
            resetPromoCode();
        });
    }
    
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
                applyPromoCode();
            });
        }
    }, 500);
    
    // File upload - moved to separate section
    // initializeFileUpload(); // This is now called in main DOMContentLoaded
    
    // Character count for textarea
    const notesTextarea = document.getElementById('notes');
    const charCount = document.querySelector('.char-count');
    if (notesTextarea && charCount) {
        notesTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500 karakter`;
        });
    }
    
    // Customer info change validation
    const customerFields = ['customerName', 'customerEmail', 'customerPhone', 'customerAddress'];
    customerFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            field.addEventListener('input', checkFormValid);
            field.addEventListener('change', checkFormValid);
        }
    });
    
    console.log('All form interactions initialized');
}

// Reset selections when switching product type
function resetSelections(productType) {
    if (productType === 'label_stiker') {
        // Reset label stiker selections to defaults
        const defaultMaterial = document.querySelector('#labelStikerOptions .material-option[data-value="vinyl_doff"]');
        if (defaultMaterial) {
            document.querySelectorAll('#labelStikerOptions .material-option').forEach(opt => opt.classList.remove('selected'));
            defaultMaterial.classList.add('selected');
        }
        
        const defaultSize = document.querySelector('#labelStikerOptions .size-option[data-value="5x5"]');
        if (defaultSize) {
            document.querySelectorAll('#labelStikerOptions .size-option').forEach(opt => opt.classList.remove('selected'));
            defaultSize.classList.add('selected');
        }
        
        const defaultCut = document.querySelector('#labelStikerOptions .finishing-card[data-value="kotak"]');
        if (defaultCut) {
            document.querySelectorAll('#labelStikerOptions .finishing-card').forEach(opt => opt.classList.remove('selected'));
            defaultCut.classList.add('selected');
        }
    } else if (productType === 'packaging_custom') {
        // Reset packaging selections to defaults
        const defaultPackaging = document.querySelector('#packagingCustomOptions .material-option[data-value="mug_sublim"]');
        if (defaultPackaging) {
            document.querySelectorAll('#packagingCustomOptions .material-option').forEach(opt => opt.classList.remove('selected'));
            defaultPackaging.classList.add('selected');
        }
        
        const defaultSize = document.querySelector('#packagingCustomOptions .size-option[data-value="small"]');
        if (defaultSize) {
            document.querySelectorAll('#packagingCustomOptions .size-option').forEach(opt => opt.classList.remove('selected'));
            defaultSize.classList.add('selected');
        }
        
        const defaultFinishing = document.querySelector('#packagingCustomOptions .finishing-card[data-value="none"]');
        if (defaultFinishing) {
            document.querySelectorAll('#packagingCustomOptions .finishing-card').forEach(opt => opt.classList.remove('selected'));
            defaultFinishing.classList.add('selected');
        }
    }
}

// Setup quantity controls
function setupQuantityControls() {
    const quantityInput = document.getElementById('quantity');
    const decreaseBtn = document.querySelector('.quantity-btn[data-action="decrease"]');
    const increaseBtn = document.querySelector('.quantity-btn[data-action="increase"]');
    
    console.log('Setting up quantity controls:', { quantityInput, decreaseBtn, increaseBtn });
    
    if (decreaseBtn) {
        decreaseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (quantityInput) {
                let currentValue = parseInt(quantityInput.value) || 1;
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                    console.log('Quantity decreased to:', quantityInput.value);
                    calculatePrice();
                }
            }
        });
    }
    
    if (increaseBtn) {
        increaseBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (quantityInput) {
                let currentValue = parseInt(quantityInput.value) || 1;
                quantityInput.value = currentValue + 1;
                console.log('Quantity increased to:', quantityInput.value);
                calculatePrice();
            }
        });
    }
    
    if (quantityInput) {
        quantityInput.addEventListener('input', function() {
            if (this.value < 1) this.value = 1;
            console.log('Quantity input changed to:', this.value);
            calculatePrice();
        });
        
        quantityInput.addEventListener('change', function() {
            if (this.value < 1) this.value = 1;
            console.log('Quantity changed to:', this.value);
            calculatePrice();
        });
    }
}
// Price calculation function
function calculatePrice() {
    console.log('=== CALCULATING PRICE ===');
    console.log('Current product type:', currentProductType);
    
    const quantity = document.getElementById('quantity');
    
    if (!currentProductType) {
        console.warn('No product type selected, using default calculations');
        // Use default calculations
        const qty = parseInt(quantity?.value || 1);
        const defaultPrice = 5000;
        const subtotal = defaultPrice * qty;
        const shippingCost = 15000;
        const tax = subtotal * 0.10;
        const total = subtotal + shippingCost + tax;
        
        updatePriceDisplay(defaultPrice, qty, subtotal, 0, 0, shippingCost, tax, total);
        return {
            basePrice: defaultPrice,
            quantity: qty,
            subtotal: subtotal,
            additionalCost: 0,
            discount: 0,
            shippingCost: shippingCost,
            tax: tax,
            total: total
        };
    }
    
    if (!quantity || !quantity.value || quantity.value < 1) {
        console.warn('Invalid quantity:', quantity?.value);
        updatePriceDisplay(0, 0, 0, 0, 0, 0, 0, 0);
        return null;
    }
    
    let basePrice = basePrices[currentProductType] || 0;
    let qty = parseInt(quantity.value);
    let additionalCost = 0;
    let sizeMultiplier = 1;
    
    console.log('Base calculations:', { basePrice, qty, currentProductType });
    
    // Calculate costs based on product type
    if (currentProductType === 'label_stiker') {
        console.log('Calculating for label stiker...');
        
        // Material cost
        const selectedMaterial = document.querySelector('#labelStikerOptions .material-option.selected');
        console.log('Selected material element:', selectedMaterial);
        if (selectedMaterial) {
            const materialCost = parseInt(selectedMaterial.dataset.price || 0);
            additionalCost += materialCost;
            console.log('Material cost added:', materialCost, 'from', selectedMaterial.dataset.value);
        } else {
            console.warn('No material selected, using default cost');
            additionalCost += 1000; // Default material cost
        }
        
        // Cut type cost
        const selectedCut = document.querySelector('#labelStikerOptions .finishing-card.selected');
        console.log('Selected cut element:', selectedCut);
        if (selectedCut) {
            const cutCost = parseInt(selectedCut.dataset.price || 0);
            additionalCost += cutCost;
            console.log('Cut cost added:', cutCost, 'from', selectedCut.dataset.value);
        } else {
            console.warn('No cut type selected, using default cost');
            additionalCost += 500; // Default cut cost
        }
        
        // Size multiplier
        const selectedSize = document.querySelector('#labelStikerOptions .size-option.selected');
        console.log('Selected size element:', selectedSize);
        if (selectedSize) {
            sizeMultiplier = parseFloat(selectedSize.dataset.multiplier || 1);
            console.log('Size multiplier:', sizeMultiplier, 'from', selectedSize.dataset.value);
        } else {
            console.warn('No size selected, using default multiplier');
            sizeMultiplier = 1.5; // Default size multiplier
        }
        
    } else if (currentProductType === 'packaging_custom') {
        console.log('Calculating for packaging custom...');
        
        // Packaging type cost
        const selectedPackaging = document.querySelector('#packagingCustomOptions .material-option.selected');
        if (selectedPackaging) {
            const packagingCost = parseInt(selectedPackaging.dataset.price || 0);
            additionalCost += packagingCost;
            console.log('Packaging cost added:', packagingCost, 'from', selectedPackaging.dataset.value);
        } else {
            console.warn('No packaging type selected, using default cost');
            additionalCost += 2000; // Default packaging cost
        }
        
        // Size multiplier
        const selectedSize = document.querySelector('#packagingCustomOptions .size-option.selected');
        if (selectedSize) {
            sizeMultiplier = parseFloat(selectedSize.dataset.multiplier || 1);
            console.log('Size multiplier:', sizeMultiplier, 'from', selectedSize.dataset.value);
        } else {
            console.warn('No packaging size selected, using default multiplier');
            sizeMultiplier = 2.0; // Default packaging size multiplier
        }
        
        // Finishing cost
        const selectedFinishing = document.querySelector('#packagingCustomOptions .finishing-card.selected');
        if (selectedFinishing) {
            const finishingCost = parseInt(selectedFinishing.dataset.price || 0);
            additionalCost += finishingCost;
            console.log('Finishing cost added:', finishingCost, 'from', selectedFinishing.dataset.value);
        } else {
            console.warn('No finishing selected, using default cost');
            additionalCost += 1000; // Default finishing cost
        }
    }
    
    // Calculate totals
    let itemPrice = basePrice + additionalCost;
    let itemSubtotal = (itemPrice * sizeMultiplier) * qty;
    let subtotalWithOptions = itemSubtotal;
    
    console.log('Intermediate calculations:', { 
        basePrice, 
        additionalCost, 
        itemPrice, 
        sizeMultiplier, 
        qty,
        itemSubtotal, 
        subtotalWithOptions 
    });
    
    // Apply promo discount
    let discount = 0;
    if (appliedPromo) {
        if (appliedPromo.type === 'percentage') {
            discount = subtotalWithOptions * appliedPromo.value;
        } else {
            discount = Math.min(appliedPromo.value, subtotalWithOptions);
        }
        console.log('Discount applied:', discount, 'from promo:', appliedPromo);
    }
    
    let subtotalAfterDiscount = subtotalWithOptions - discount;
    
    // Shipping cost
    const shippingMethod = document.getElementById('shippingMethod');
    let shippingCost = 15000; // Default shipping cost
    if (shippingMethod && shippingMethod.value) {
        const shippingOption = shippingMethod.options[shippingMethod.selectedIndex];
        if (shippingOption && shippingOption.dataset.cost) {
            shippingCost = parseInt(shippingOption.dataset.cost);
            console.log('Shipping cost:', shippingCost, 'from', shippingMethod.value);
        } else {
            console.log('Using default shipping cost:', shippingCost);
        }
    } else {
        console.log('No shipping method selected, using default:', shippingCost);
    }
    
    // Tax calculation (10%)
    let tax = subtotalAfterDiscount * 0.10;
    
    // Final total
    let total = subtotalAfterDiscount + shippingCost + tax;
    
    console.log('Final calculations:', { 
        subtotalAfterDiscount, 
        shippingCost, 
        tax, 
        total 
    });
    
    // Update displays
    updatePriceDisplay(itemPrice, qty, itemSubtotal, additionalCost, discount, shippingCost, tax, total);
    
    console.log('=== PRICE CALCULATION COMPLETE ===');
    
    // Return price data for form submission
    return {
        basePrice: itemPrice,
        quantity: qty,
        subtotal: itemSubtotal,
        additionalCost: additionalCost,
        discount: discount,
        shippingCost: shippingCost,
        tax: tax,
        total: total
    };
}

// Update price display
function updatePriceDisplay(itemPrice, qty, subtotal, additionalCost, discount, shippingCost, tax, total) {
    console.log('Updating price display:', { itemPrice, qty, subtotal, additionalCost, discount, shippingCost, tax, total });
    
    const elements = {
        basePrice: document.getElementById('basePrice'),
        quantityDisplay: document.getElementById('quantityDisplay'),
        subtotal: document.getElementById('subtotal'), // This might be null if commented out
        additionalCost: document.getElementById('additionalCost'),
        discountRow: document.getElementById('discountRow'),
        discount: document.getElementById('discount'),
        shippingCost: document.getElementById('shippingCost'),
        tax: document.getElementById('tax'),
        totalPrice: document.getElementById('totalPrice')
    };
    
    // Format numbers to rupiah format
    const formatRupiah = (number) => {
        return new Intl.NumberFormat('id-ID').format(number);
    };
    
    // Check if elements exist before updating
    if (elements.basePrice) {
        elements.basePrice.textContent = 'Rp ' + formatRupiah(itemPrice);
        console.log('Base price updated:', itemPrice);
    } else {
        console.warn('basePrice element not found');
    }
    
    if (elements.quantityDisplay) {
        elements.quantityDisplay.textContent = qty + ' pcs';
    } else {
        console.warn('quantityDisplay element not found');
    }
    
    // Only update subtotal if element exists (it's commented out in HTML)
    if (elements.subtotal) {
        elements.subtotal.textContent = 'Rp ' + formatRupiah(subtotal);
        console.log('Subtotal updated:', subtotal);
    }
    
    if (elements.additionalCost) {
        elements.additionalCost.textContent = 'Rp ' + formatRupiah(additionalCost);
    } else {
        console.warn('additionalCost element not found');
    }
    
    if (discount > 0) {
        if (elements.discountRow) elements.discountRow.style.display = 'flex';
        if (elements.discount) elements.discount.textContent = '- Rp ' + formatRupiah(discount);
    } else {
        if (elements.discountRow) elements.discountRow.style.display = 'none';
    }
    
    if (elements.shippingCost) {
        elements.shippingCost.textContent = 'Rp ' + formatRupiah(shippingCost);
    } else {
        console.warn('shippingCost element not found');
    }
    
    if (elements.tax) {
        elements.tax.textContent = 'Rp ' + formatRupiah(tax);
    } else {
        console.warn('tax element not found');
    }
    
    if (elements.totalPrice) {
        elements.totalPrice.textContent = 'Rp ' + formatRupiah(total);
        console.log('Total price updated:', total);
    } else {
        console.warn('totalPrice element not found');
    }
    
    // Enable order button if form is ready
    checkFormValid();
}

// Apply promo code
function applyPromoCode() {
    console.log('Applying promo code...');
    const promoInput = document.getElementById('promoCode');
    const feedback = document.getElementById('promoFeedback');
    const applyBtn = document.getElementById('applyPromo');
    
    if (!promoInput) {
        console.error('Promo input not found');
        return;
    }
    
    const code = promoInput.value.trim().toUpperCase();
    console.log('Promo code entered:', code);
    
    const promoCodes = {
        'HEMAT10': { type: 'percentage', value: 0.10, description: 'Diskon 10%' },
        'NEWUSER15': { type: 'percentage', value: 0.15, description: 'Diskon 15% User Baru' },
        'GRATIS50': { type: 'fixed', value: 50000, description: 'Gratis Ongkir Rp 50.000' }
    };
    
    if (promoCodes[code]) {
        appliedPromo = promoCodes[code];
        promoInput.disabled = true;
        console.log('Promo code applied:', appliedPromo);
        
        if (applyBtn) {
            applyBtn.textContent = 'Terapkan';
            applyBtn.disabled = true;
            applyBtn.classList.remove('btn-primary');
            applyBtn.classList.add('btn-success');
        }
        
        // Show reset button
        const resetBtn = document.getElementById('resetPromo');
        if (resetBtn) resetBtn.style.display = 'inline-block';
        
        if (feedback) {
            feedback.innerHTML = `<small class="text-success"><i class="bi bi-check-circle me-1"></i>Berhasil! ${promoCodes[code].description}</small>`;
            feedback.style.display = 'block';
        }
        
        showAlert('success', `Kode promo ${code} berhasil diterapkan! ${promoCodes[code].description}`);
        calculatePrice();
    } else {
        console.log('Invalid promo code:', code);
        if (feedback) {
            feedback.innerHTML = `<small class="text-danger"><i class="bi bi-x-circle me-1"></i>Kode promo tidak valid</small>`;
            feedback.style.display = 'block';
        }
        showAlert('error', 'Kode promo tidak valid atau sudah expired');
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
        applyBtn.classList.add('btn-primary');
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

// Check if form is valid for submission
function checkFormValid() {
    const productSelected = document.querySelector('.product-option.selected');
    const materialSelected = document.querySelector('.material-option.selected');
    const sizeSelected = document.querySelector('.size-option.selected');
    const finishingSelected = document.querySelector('.finishing-card.selected');
    const quantity = document.getElementById('quantity');
    const customerName = document.getElementById('customerName');
    const customerEmail = document.getElementById('customerEmail');
    const customerPhone = document.getElementById('customerPhone');
    const customerAddress = document.getElementById('customerAddress');
    const orderBtn = document.getElementById('placeOrder');
    
    const isValid = currentProductType && 
                   productSelected && 
                   materialSelected && 
                   sizeSelected && 
                   finishingSelected &&
                   quantity?.value && 
                   parseInt(quantity.value) > 0 &&
                   customerName?.value?.trim() &&
                   customerEmail?.value?.trim() &&
                   customerPhone?.value?.trim() &&
                   customerAddress?.value?.trim();
    
    if (orderBtn) {
        orderBtn.disabled = !isValid;
    }
    
    return isValid;
}

// Additional utility functions

// Check form elements existence
function checkFormElements() {
    const elements = [
        'quantity', 'customerName', 'customerEmail', 'customerPhone', 
        'customerAddress', 'shippingMethod', 'promoCode', 'placeOrder',
        'basePrice', 'quantityDisplay', 'subtotal', 'additionalCost',
        'shippingCost', 'tax', 'totalPrice'
    ];
    
    console.log('=== FORM ELEMENTS CHECK ===');
    elements.forEach(id => {
        const element = document.getElementById(id);
        console.log(`${id}:`, element ? '✓ Found' : '✗ Missing');
    });
    
    // Check for selection containers
    const containers = [
        '.product-option', '.material-option', '.size-option', '.finishing-card'
    ];
    containers.forEach(selector => {
        const elements = document.querySelectorAll(selector);
        console.log(`${selector}:`, elements.length, 'elements found');
    });
    
    console.log('=== END CHECK ===');
}

// Initialize order button functionality  
function initializeOrderButton() {
    const orderBtn = document.getElementById('placeOrder');
    if (!orderBtn) {
        console.error('Order button not found!');
        return;
    }
    
    orderBtn.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('Order button clicked');
        
        if (!validateForm()) {
            console.log('Form validation failed');
            return;
        }
        
        console.log('Form validation passed, placing order...');
        placeOrder();
    });
    
    console.log('Order button initialized successfully');
}

// Advanced form validation
function validateForm() {
    console.log('Validating form...');
    const errors = [];
    
    // Check product selection
    if (!currentProductType) {
        errors.push('Pilih jenis produk');
    }
    
    const productSelected = document.querySelector('.product-option.selected');
    if (!productSelected) {
        errors.push('Pilih jenis produk');
    }
    
    // Check material selection
    const materialSelected = document.querySelector('.material-option.selected');
    if (!materialSelected) {
        errors.push('Pilih jenis material');
    }
    
    // Check size selection
    const sizeSelected = document.querySelector('.size-option.selected');
    if (!sizeSelected) {
        errors.push('Pilih ukuran');
    }
    
    // Check finishing selection
    const finishingSelected = document.querySelector('.finishing-card.selected');
    if (!finishingSelected) {
        errors.push('Pilih jenis finishing');
    }
    
    // Check quantity
    const quantity = document.getElementById('quantity');
    if (!quantity || !quantity.value || parseInt(quantity.value) < 1) {
        errors.push('Masukkan jumlah yang valid');
    }
    
    // Check customer information
    const requiredFields = [
        { id: 'customerName', name: 'Nama lengkap' },
        { id: 'customerEmail', name: 'Email' },
        { id: 'customerPhone', name: 'Nomor telepon' },
        { id: 'customerAddress', name: 'Alamat' },
        { id: 'shippingMethod', name: 'Metode pengiriman' }
    ];
    
    requiredFields.forEach(field => {
        const element = document.getElementById(field.id);
        if (!element || !element.value.trim()) {
            errors.push(field.name);
        }
    });
    
    // Email validation
    const email = document.getElementById('customerEmail');
    if (email && email.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            errors.push('Format email tidak valid');
        }
    }
    
    // Phone validation
    const phone = document.getElementById('customerPhone');
    if (phone && phone.value) {
        const phoneRegex = /^[\d\-\+\(\)\s]+$/;
        if (!phoneRegex.test(phone.value) || phone.value.replace(/\D/g, '').length < 10) {
            errors.push('Format nomor telepon tidak valid');
        }
    }
    
    const isValid = errors.length === 0;
    
    if (!isValid) {
        showAlert('error', 'Lengkapi field berikut:\n• ' + errors.join('\n• '));
    }
    
    console.log('Form validation result:', { isValid, errors });
    return isValid;
}

// Expose utility functions for debugging
window.checkFormElements = checkFormElements;
window.testFormValidation = validateForm;
window.getFormData = collectFormData;

// Debug function untuk membantu troubleshooting
window.debugPricing = function() {
    console.log('=== DEBUG PRICING ===');
    console.log('Current Product Type:', currentProductType);
    console.log('Base Prices:', basePrices);
    console.log('Applied Promo:', appliedPromo);
    
    const quantity = document.getElementById('quantity');
    console.log('Quantity Element:', quantity);
    console.log('Quantity Value:', quantity?.value);
    
    console.log('=== Label Stiker Options ===');
    const labelMaterial = document.querySelector('#labelStikerOptions .material-option.selected');
    const labelSize = document.querySelector('#labelStikerOptions .size-option.selected');
    const labelCut = document.querySelector('#labelStikerOptions .finishing-card.selected');
    console.log('Selected Material:', labelMaterial?.dataset);
    console.log('Selected Size:', labelSize?.dataset);
    console.log('Selected Cut:', labelCut?.dataset);
    
    console.log('=== Packaging Options ===');
    const packagingType = document.querySelector('#packagingCustomOptions .material-option.selected');
    const packagingSize = document.querySelector('#packagingCustomOptions .size-option.selected');
    const packagingFinishing = document.querySelector('#packagingCustomOptions .finishing-card.selected');
    console.log('Selected Packaging:', packagingType?.dataset);
    console.log('Selected Size:', packagingSize?.dataset);
    console.log('Selected Finishing:', packagingFinishing?.dataset);
    
    console.log('=== Price Elements ===');
    const priceElements = ['basePrice', 'quantityDisplay', 'subtotal', 'additionalCost', 'shippingCost', 'tax', 'totalPrice'];
    priceElements.forEach(id => {
        const element = document.getElementById(id);
        console.log(`${id}:`, element?.textContent);
    });
    
    console.log('=== END DEBUG ===');
};
    
// Expose functions for debugging
window.recalculatePrice = calculatePrice;
window.getCurrentProductType = () => currentProductType;
    
console.log('Debug functions exposed: window.debugPricing(), window.recalculatePrice(), window.getCurrentProductType()');

// Show alert function
function showAlert(type, message) {
    console.log(`Alert [${type}]:`, message);
    
    // Create alert element
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'error' ? 'danger' : type} alert-dismissible fade show position-fixed`;
    alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 400px;';
    
    alertDiv.innerHTML = `
        <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
    
    document.body.appendChild(alertDiv);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (alertDiv.parentNode) {
            alertDiv.remove();
        }
    }, 5000);
}

// Collect form data function
function collectFormData() {
    const formData = new FormData();
    
    // Service type for packaging
    formData.append('service_type', 'packaging');
    
    // Product details
    formData.append('product_type', currentProductType);
    formData.append('quantity', document.getElementById('quantity')?.value || '1');
    
    // Add product-specific data
    if (currentProductType === 'label_stiker') {
        const materialType = document.getElementById('materialType');
        const stickerSize = document.getElementById('stickerSize');
        const cutType = document.getElementById('cutType');
        
        if (materialType) formData.append('material_type', materialType.value);
        if (stickerSize) formData.append('sticker_size', stickerSize.value);
        if (cutType) formData.append('cut_type', cutType.value);
    } else if (currentProductType === 'packaging_custom') {
        const packagingType = document.getElementById('packagingType');
        const packagingSize = document.getElementById('packagingSize');
        const packagingFinishing = document.getElementById('packagingFinishing');
        
        if (packagingType) formData.append('packaging_type', packagingType.value);
        if (packagingSize) formData.append('packaging_size', packagingSize.value);
        if (packagingFinishing) formData.append('packaging_finishing', packagingFinishing.value);
    }
    
    // Customer information
    const customerFields = ['customerName', 'customerEmail', 'customerPhone', 'customerAddress'];
    customerFields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        if (field) {
            // Proper field name mapping
            let fieldName = fieldId.replace('customer', 'customer_');
            fieldName = fieldName.replace('Name', 'name')
                                .replace('Email', 'email')
                                .replace('Phone', 'phone')
                                .replace('Address', 'address');
            formData.append(fieldName, field.value);
        }
    });
    
    // Shipping and notes
    const shippingMethod = document.getElementById('shippingMethod');
    const notes = document.getElementById('notes');
    
    if (shippingMethod) formData.append('shipping_method', shippingMethod.value);
    if (notes) formData.append('notes', notes.value);
    
    // File upload
    const designFile = document.getElementById('designFile');
    if (designFile && designFile.files.length > 0) {
        formData.append('design_file', designFile.files[0]);
    }
    
    // Promo code
    if (appliedPromo) {
        formData.append('promo_code', document.getElementById('promoCode')?.value || '');
    }
    
    // Price calculations
    console.log('About to calculate price, currentProductType:', currentProductType);
    const priceData = calculatePrice();
    console.log('Price data from calculatePrice():', priceData);
    
    if (priceData && priceData.total > 0) {
        formData.append('unit_price', priceData.basePrice || 0);
        formData.append('subtotal', priceData.subtotal || 0);
        formData.append('shipping_cost', priceData.shippingCost || 0);
        formData.append('tax_amount', priceData.tax || 0);
        formData.append('discount', priceData.discount || 0);
        formData.append('total', priceData.total || 0);
        console.log('Used calculated price data');
    } else {
        console.warn('Invalid price data from calculatePrice(), using manual fallback');
        // Manual fallback calculation based on visible form data
        const quantity = parseInt(document.getElementById('quantity')?.value || 1);
        let basePrice = 1000; // Default base price
        let additionalCost = 0;
        let sizeMultiplier = 1;
        
        // Determine base price from current product type
        if (currentProductType === 'packaging_custom') {
            basePrice = 5000;
            additionalCost = 3000; // Material + finishing
            sizeMultiplier = 2.0;
        } else if (currentProductType === 'label_stiker') {
            basePrice = 1000;
            additionalCost = 1500; // Material + cut
            sizeMultiplier = 1.5;
        }
        
        const itemPrice = basePrice + additionalCost;
        const subtotal = (itemPrice * sizeMultiplier) * quantity;
        const shippingCost = 15000;
        const tax = subtotal * 0.10;
        const total = subtotal + shippingCost + tax;
        
        formData.append('unit_price', itemPrice);
        formData.append('subtotal', subtotal);
        formData.append('shipping_cost', shippingCost);
        formData.append('tax_amount', tax);
        formData.append('discount', 0);
        formData.append('total', total);
        
        console.log('Used manual fallback calculation:', {
            quantity, basePrice, additionalCost, itemPrice, subtotal, shippingCost, tax, total
        });
    }
    
    // Add CSRF token
    const csrfToken = document.querySelector('input[name="_token"]')?.value;
    if (csrfToken) {
        formData.append('_token', csrfToken);
    }
    
    return formData;
}

// Place order function
function placeOrder() {
    console.log('Placing order...');
    
    if (!validateForm()) {
        console.log('Form validation failed');
        showAlert('error', 'Harap lengkapi semua field yang diperlukan');
        return;
    }
    
    const orderBtn = document.getElementById('placeOrder');
    if (orderBtn) {
        orderBtn.disabled = true;
        orderBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
    }
    
    try {
        const formData = collectFormData();
        
        // Log collected data for debugging
        console.log('Collected form data:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}:`, value);
        }
        
        // Submit form data to server
        fetch('{{ route("checkout.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                               document.querySelector('input[name="_token"]')?.value || '',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            
            if (!response.ok) {
                return response.text().then(text => {
                    console.error('Error response:', text);
                    throw new Error(`HTTP error! status: ${response.status}, body: ${text}`);
                });
            }
            
            // Check if response is JSON
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                return response.json();
            } else {
                // If not JSON, probably a redirect response
                console.log('Non-JSON response, likely a redirect');
                window.location.href = '{{ url("/checkout") }}';
                return;
            }
        })
        .then(data => {
            if (data && data.success) {
                console.log('Order submitted successfully:', data);
                showAlert('success', 'Pesanan berhasil! Mengalihkan ke halaman checkout...');
                
                // Redirect to checkout page after short delay
                setTimeout(() => {
                    window.location.href = data.redirect_url || '{{ url("/checkout") }}';
                }, 1000);
                
            } else if (data && data.error) {
                throw new Error(data.message || 'Terjadi kesalahan saat memproses pesanan');
            } else {
                // Fallback: direct redirect
                console.log('No JSON response, redirecting directly');
                window.location.href = '{{ url("/checkout") }}';
            }
        })
        .catch(error => {
            console.error('Error submitting order:', error);
            
            // Fallback: Try direct form submission
            console.log('Attempting fallback form submission...');
            submitFormDirectly();
        });
        
    } catch (error) {
        console.error('Error preparing order:', error);
        
        // Fallback: Try direct form submission
        console.log('Attempting fallback form submission...');
        submitFormDirectly();
    }
}

// Fallback function for direct form submission
function submitFormDirectly() {
    try {
        const form = document.getElementById('orderForm');
        const orderBtn = document.getElementById('placeOrder');
        
        if (!form) {
            throw new Error('Form not found');
        }
        
        console.log('Using direct form submission');
        
        // Ensure the form has all necessary data
        const formData = collectFormData();
        
        // Clear any existing hidden inputs (except CSRF token)
        const existingHidden = form.querySelectorAll('input[type="hidden"]:not([name="_token"])');
        existingHidden.forEach(input => {
            if (input.name !== '_token') {
                input.remove();
            }
        });
        
        // Add form data as hidden inputs
        for (let [key, value] of formData.entries()) {
            if (key !== 'design_file' && key !== '_token') { // Handle file separately, keep existing CSRF token
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = key;
                hiddenInput.value = value;
                form.appendChild(hiddenInput);
            }
        }
        
        // Ensure form settings are correct
        form.action = '{{ route("checkout.store") }}';
        form.method = 'POST';
        form.enctype = 'multipart/form-data';
        
        console.log('Form action:', form.action);
        console.log('Form method:', form.method);
        console.log('Form data added, submitting...');
        
        showAlert('info', 'Mengirim data pesanan...');
        
        // Submit the form
        form.submit();
        
    } catch (error) {
        console.error('Error with direct form submission:', error);
        
        // Final fallback: redirect to checkout with basic parameters
        console.log('Using final fallback - redirect with parameters...');
        redirectToCheckoutWithParams();
    }
}

// Final fallback: Redirect to checkout with URL parameters
function redirectToCheckoutWithParams() {
    try {
        const params = new URLSearchParams();
        
        // Add basic order information as URL parameters
        params.append('product_type', currentProductType);
        params.append('quantity', document.getElementById('quantity')?.value || '1');
        
        // Add customer info
        const customerName = document.getElementById('customerName')?.value || '';
        const customerEmail = document.getElementById('customerEmail')?.value || '';
        const customerPhone = document.getElementById('customerPhone')?.value || '';
        
        if (customerName) params.append('customer_name', customerName);
        if (customerEmail) params.append('customer_email', customerEmail);
        if (customerPhone) params.append('customer_phone', customerPhone);
        
        // Calculate total price for reference
        const totalElement = document.getElementById('totalPrice');
        if (totalElement) {
            const totalText = totalElement.textContent.replace(/[^\d]/g, '');
            if (totalText) params.append('total', totalText);
        }
        
        showAlert('info', 'Mengalihkan ke halaman checkout...');
        
        // Redirect to checkout with parameters
        setTimeout(() => {
            window.location.href = `{{ url("/checkout") }}?${params.toString()}`;
        }, 1000);
        
    } catch (error) {
        console.error('Error with parameter redirect:', error);
        showAlert('error', 'Terjadi kesalahan. Silakan coba lagi atau hubungi customer service.');
        
        const orderBtn = document.getElementById('placeOrder');
        if (orderBtn) {
            orderBtn.disabled = false;
            orderBtn.innerHTML = '<i class="bi bi-cart-check me-2"></i>Lanjutkan ke Checkout';
        }
    }
}

// Initialize file upload
function initializeFileUpload() {
    console.log('Initializing file upload...');
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.getElementById('designFile');
    
    console.log('Upload elements found:', { uploadArea: !!uploadArea, fileInput: !!fileInput });
    
    if (!uploadArea || !fileInput) {
        console.error('Upload elements not found!');
        return;
    }
    
    // Initialize upload area content if empty
    if (!uploadArea.innerHTML.trim()) {
        uploadArea.innerHTML = `
            <div class="upload-icon">
                <i class="bi bi-cloud-arrow-up"></i>
            </div>
            <div class="upload-text">
                <span class="upload-title">Klik untuk upload file desain</span>
                <span class="upload-subtitle">atau drag & drop file di sini</span>
            </div>
        `;
    }
    
    // Remove any existing event listeners by cloning elements
    const newUploadArea = uploadArea.cloneNode(true);
    uploadArea.parentNode.replaceChild(newUploadArea, uploadArea);
    
    const newFileInput = fileInput.cloneNode(true);
    fileInput.parentNode.replaceChild(newFileInput, fileInput);
    
    // Get fresh references
    const freshUploadArea = document.querySelector('.upload-area');
    const freshFileInput = document.getElementById('designFile');
    
    // Click handler for upload area
    freshUploadArea.addEventListener('click', function(e) {
        console.log('Upload area clicked');
        e.preventDefault();
        e.stopPropagation();
        freshFileInput.click();
    });
    
    // File input change
    freshFileInput.addEventListener('change', function(e) {
        console.log('File input changed, files:', e.target.files);
        const files = e.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            console.log('File selected:', file.name, file.size, file.type);
            updateFileInfo(file);
        }
    });
    
    // Drag and drop events with better error handling
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        freshUploadArea.addEventListener(eventName, function(e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });
    
    freshUploadArea.addEventListener('dragenter', function(e) {
        console.log('Drag enter');
        this.classList.add('drag-over');
    });
    
    freshUploadArea.addEventListener('dragover', function(e) {
        console.log('Drag over');
        this.classList.add('drag-over');
    });
    
    freshUploadArea.addEventListener('dragleave', function(e) {
        // Only remove drag-over if we're actually leaving the upload area
        if (!this.contains(e.relatedTarget)) {
            console.log('Drag leave');
            this.classList.remove('drag-over');
        }
    });
    
    freshUploadArea.addEventListener('drop', function(e) {
        console.log('File dropped');
        this.classList.remove('drag-over');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            const file = files[0];
            console.log('Dropped file:', file.name, file.size, file.type);
            
            // Set the file to the input using more reliable method
            try {
                const dt = new DataTransfer();
                dt.items.add(file);
                freshFileInput.files = dt.files;
                
                updateFileInfo(file);
            } catch (error) {
                console.error('Error setting dropped file:', error);
                // Fallback: trigger change event manually
                updateFileInfo(file);
            }
        }
    });
    
    console.log('File upload initialized successfully');
}

// Update file info display
function updateFileInfo(file) {
    console.log('Updating file info for:', file.name);
    const uploadArea = document.querySelector('.upload-area');
    if (!uploadArea) {
        console.error('Upload area not found for file info update');
        return;
    }
    
    const fileSize = (file.size / 1024 / 1024).toFixed(2);
    const fileName = file.name;
    
    // Enhanced file type validation
    const allowedTypes = [
        'image/jpeg', 
        'image/jpg', 
        'image/png', 
        'application/pdf',
        'image/vnd.adobe.photoshop', // PSD
        'application/postscript', // AI
        'application/x-coreldraw' // CDR
    ];
    
    const allowedExtensions = ['.jpg', '.jpeg', '.png', '.pdf', '.ai', '.psd', '.cdr'];
    
    const fileExtension = fileName.toLowerCase().substring(fileName.lastIndexOf('.'));
    const isValidType = allowedTypes.includes(file.type) || allowedExtensions.includes(fileExtension);
    
    console.log('File validation:', {
        name: fileName,
        type: file.type,
        extension: fileExtension,
        size: fileSize + ' MB',
        isValid: isValidType
    });
    
    if (!isValidType) {
        showAlert('error', 'Format file tidak didukung. Gunakan JPG, PNG, PDF, AI, PSD, atau CDR.');
        resetFileInput();
        return;
    }
    
    if (file.size > 10 * 1024 * 1024) { // 10MB
        showAlert('error', 'Ukuran file terlalu besar. Maksimal 10MB.');
        resetFileInput();
        return;
    }
    
    // Show success message
    showAlert('success', `File "${fileName}" berhasil diupload!`);
    
    uploadArea.innerHTML = `
        <div class="d-flex justify-content-between align-items-center p-3">
            <div class="d-flex align-items-center">
                <i class="bi bi-file-earmark-check text-success me-2" style="font-size: 1.5rem;"></i>
                <div>
                    <strong>${fileName}</strong>
                    <div class="text-muted small">${fileSize} MB</div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeFile()">
                <i class="bi bi-x"></i>
            </button>
        </div>
    `;
    uploadArea.classList.add('file-uploaded');
    console.log('File info updated successfully');
    
    // Re-validate form to enable order button if all conditions are met
    checkFormValid();
}

// Reset file input helper function
function resetFileInput() {
    const fileInput = document.getElementById('designFile');
    if (fileInput) {
        fileInput.value = '';
    }
}

// Remove uploaded file
function removeFile() {
    console.log('Removing uploaded file');
    const fileInput = document.getElementById('designFile');
    const uploadArea = document.querySelector('.upload-area');
    
    if (fileInput) {
        fileInput.value = '';
        console.log('File input cleared');
    }
    
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
        console.log('Upload area reset');
        
        // Re-initialize upload functionality after reset
        setTimeout(() => {
            initializeFileUpload();
        }, 100);
    }
    
    // Re-validate form
    checkFormValid();
    
    showAlert('info', 'File berhasil dihapus');
}

// Expose removeFile function globally for onclick handler
window.removeFile = removeFile;

// Debug file upload function
window.debugFileUpload = function() {
    console.log('=== DEBUG FILE UPLOAD ===');
    const uploadArea = document.querySelector('.upload-area');
    const fileInput = document.getElementById('designFile');
    
    console.log('Upload Area:', uploadArea);
    console.log('File Input:', fileInput);
    console.log('File Input Value:', fileInput?.value);
    console.log('File Input Files:', fileInput?.files);
    console.log('Upload Area Classes:', uploadArea?.className);
    console.log('Upload Area Content:', uploadArea?.innerHTML.slice(0, 100) + '...');
    
    if (fileInput?.files?.length > 0) {
        const file = fileInput.files[0];
        console.log('Current File:', {
            name: file.name,
            size: file.size,
            type: file.type,
            lastModified: new Date(file.lastModified)
        });
    } else {
        console.log('No file selected');
    }
    
    console.log('=== END DEBUG ===');
};

// Test file upload function
window.testFileUpload = function() {
    console.log('Testing file upload initialization...');
    initializeFileUpload();
    console.log('File upload re-initialized');
};

// Debug form submission function
window.debugFormSubmission = function() {
    console.log('=== DEBUG FORM SUBMISSION ===');
    console.log('Form element:', document.getElementById('orderForm'));
    console.log('Current product type:', currentProductType);
    console.log('Form validation result:', validateForm());
    
    const formData = collectFormData();
    console.log('Collected form data:');
    for (let [key, value] of formData.entries()) {
        console.log(`${key}:`, value);
    }
    
    console.log('=== END DEBUG ===');
};

// Test order submission function  
window.testOrderSubmission = function() {
    console.log('Testing order submission...');
    if (validateForm()) {
        placeOrder();
    } else {
        console.log('Form validation failed');
    }
};

// Manual price calculation trigger for testing
window.triggerPriceCalculation = function() {
    console.log('=== MANUAL PRICE CALCULATION TRIGGER ===');
    calculatePrice();
};

// Force initialize and calculate price
window.forceInitAndCalculate = function() {
    console.log('=== FORCE INIT AND CALCULATE ===');
    initializeDefaultSelections();
    setTimeout(() => {
        calculatePrice();
    }, 100);
};

// Format currency function
function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0
    }).format(amount);
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
    document.querySelectorAll('.product-option.selected').forEach(el => el.classList.remove('selected'));
    document.querySelectorAll('.material-option.selected').forEach(el => el.classList.remove('selected'));
    document.querySelectorAll('.size-option.selected').forEach(el => el.classList.remove('selected'));
    document.querySelectorAll('.finishing-card.selected').forEach(el => el.classList.remove('selected'));
    
    // Reset file upload
    removeFile();
    
    // Reset promo code
    resetPromoCode();
    
    // Reset global variables
    currentProductType = 'label_stiker';
    appliedPromo = null;
    
    // Hide custom dimensions
    const customDimensions = document.getElementById('customDimensions');
    if (customDimensions) customDimensions.style.display = 'none';
    
    // Reset price display
    updatePriceDisplay(0, 0, 0, 0, 0, 0, 0, 0);
    
    // Disable order button and reset text
    const orderBtn = document.getElementById('placeOrder');
    if (orderBtn) {
        orderBtn.disabled = true;
        orderBtn.innerHTML = '<i class="bi bi-cart-check me-2"></i>Lanjutkan ke Checkout';
    }
}
</script>
@endpush
