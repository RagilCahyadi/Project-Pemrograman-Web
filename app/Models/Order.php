<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'customer_id',
        'service_type',
        'product_type',
        'paper_type',
        'size',
        'finishing',
        'quantity',
        'unit_price',
        'sub_total_amount',
        'shipping_cost',
        'tax_amount',
        'discount_amount',
        'grand_total_amount',
        'shipping_method',
        'payment_method',
        'promo_code',
        'notes',
        'status',
        'payment_status',
        'is_paid',
        'booking_trx_id',
        'promo_code_id',
        'shipping_id',
        'tracking_number',
        // For checkout process
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_address',
    ];

    protected $appends = [
        'total_amount'
    ];

    public static function generateUniqueTrxId(): string
    {
        do {
            // Format: TRX-YYYYMMDD-XXXX (4 karakter acak uppercase)
            $trxId = 'TRX-' . now()->format('Ymd') . '-' . Str::upper(Str::random(4));
        } while (self::where('booking_trx_id', $trxId)->exists()); // Cek ke database untuk memastikan unik

        return $trxId;
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class);
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }
    
    // Accessor for backward compatibility
    public function getTotalAmountAttribute()
    {
        return $this->grand_total_amount;
    }
    
    // Customer info accessors for checkout without customer_id
    public function getCustomerNameAttribute($value)
    {
        return $value ?? $this->customer?->name;
    }
    
    public function getCustomerEmailAttribute($value)
    {
        return $value ?? $this->customer?->email;
    }
    
    public function getCustomerPhoneAttribute($value)
    {
        return $value ?? $this->customer?->phone;
    }
    
    public function getCustomerAddressAttribute($value)
    {
        return $value ?? $this->customer?->address;
    }
}