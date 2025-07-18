<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipping extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shipping';

    protected $fillable = [
        'courier',
        'shipping_cost',
        'estimated_delivery',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}