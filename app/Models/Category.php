<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'icon', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    // Scope untuk filter kategori aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk kategori printing services
    public function scopePrintingServices($query)
    {
        return $query->whereIn('slug', [
            'business-cards', 'flyers', 'banners', 'stickers', 
            'brochures', 'posters', 'invitations', 'certificates'
        ]);
    }

    // Accessor untuk URL slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}