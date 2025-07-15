<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'promo_codes';

    protected $fillable = [
        'code',
        'discount_amount',
        'is_active',
    ];
    
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}