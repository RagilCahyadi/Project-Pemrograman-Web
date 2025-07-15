<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Fancy Paper',
                'slug' => 'fancy-paper',
                'icon' => 'bi-file-earmark-text',
                'is_active' => true
            ],
            [
                'name' => 'Packaging & Label',
                'slug' => 'packaging-label',
                'icon' => 'bi-box-seam',
                'is_active' => true
            ],
            [
                'name' => 'Banner & Spanduk',
                'slug' => 'banner-spanduk',
                'icon' => 'bi-flag',
                'is_active' => true
            ],
            [
                'name' => 'UV Printing',
                'slug' => 'uv-printing',
                'icon' => 'bi-printer',
                'is_active' => true
            ],
            [
                'name' => 'Digital Printing',
                'slug' => 'digital-printing',
                'icon' => 'bi-display',
                'is_active' => true
            ],
            [
                'name' => 'Cetak Foto',
                'slug' => 'cetak-foto',
                'icon' => 'bi-camera',
                'is_active' => true
            ],
            [
                'name' => 'Merchandise',
                'slug' => 'merchandise',
                'icon' => 'bi-bag',
                'is_active' => true
            ],
            [
                'name' => 'Sticker & Vinyl',
                'slug' => 'sticker-vinyl',
                'icon' => 'bi-stickies',
                'is_active' => true
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
