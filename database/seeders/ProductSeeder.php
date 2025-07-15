<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories
        $fancyPaper = Category::where('slug', 'fancy-paper')->first();
        $packaging = Category::where('slug', 'packaging-label')->first();
        $banner = Category::where('slug', 'banner-spanduk')->first();
        $uvPrinting = Category::where('slug', 'uv-printing')->first();
        $digitalPrinting = Category::where('slug', 'digital-printing')->first();
        $cetakFoto = Category::where('slug', 'cetak-foto')->first();
        $merchandise = Category::where('slug', 'merchandise')->first();
        $sticker = Category::where('slug', 'sticker-vinyl')->first();

        $products = [
            // Fancy Paper Products
            [
                'name' => 'Undangan Pernikahan Premium',
                'slug' => 'undangan-pernikahan-premium',
                'thumbnail' => 'template/assets/portfolio-wedding.jpg',
                'about' => 'Undangan pernikahan eksklusif dengan bahan fancy paper berkualitas tinggi. Tersedia berbagai desain elegan dengan finishing foil, emboss, dan UV spot.',
                'price' => 50000,
                'stock' => 100,
                'category_id' => $fancyPaper->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Kartu Nama Fancy Paper',
                'slug' => 'kartu-nama-fancy-paper',
                'thumbnail' => 'template/assets/service-fancy-paper.jpg',
                'about' => 'Kartu nama profesional dengan bahan fancy paper yang memberikan kesan mewah dan berkelas untuk bisnis Anda.',
                'price' => 15000,
                'stock' => 500,
                'category_id' => $fancyPaper->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Sertifikat & Piagam',
                'slug' => 'sertifikat-piagam',
                'thumbnail' => 'template/assets/portfolio-certificate.jpg',
                'about' => 'Sertifikat dan piagam dengan bahan fancy paper premium, cocok untuk penghargaan dan sertifikat resmi.',
                'price' => 25000,
                'stock' => 200,
                'category_id' => $fancyPaper->id,
                'is_popular' => false,
                'is_active' => true
            ],

            // Packaging & Label Products
            [
                'name' => 'Label Stiker Premium',
                'slug' => 'label-stiker-premium',
                'thumbnail' => 'template/assets/service-packaging.jpg',
                'about' => 'Label stiker berkualitas tinggi dengan bahan tahan air dan UV resistant. Cocok untuk produk makanan, minuman, dan kosmetik.',
                'price' => 5000,
                'stock' => 1000,
                'category_id' => $packaging->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Kemasan Makanan Custom',
                'slug' => 'kemasan-makanan-custom',
                'thumbnail' => 'template/assets/portfolio-packaging.jpg',
                'about' => 'Kemasan makanan food grade dengan desain custom sesuai brand Anda. Aman untuk makanan dan minuman.',
                'price' => 8000,
                'stock' => 300,
                'category_id' => $packaging->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Mug Sublim Premium',
                'slug' => 'mug-sublim-premium',
                'thumbnail' => 'template/assets/hero-printing.jpg',
                'about' => 'Mug ceramic dengan printing sublimasi yang tahan lama dan tidak mudah pudar. Kualitas printing tajam dan detail.',
                'price' => 35000,
                'stock' => 150,
                'category_id' => $packaging->id,
                'is_popular' => false,
                'is_active' => true
            ],

            // Banner & Spanduk Products
            [
                'name' => 'Spanduk MMT',
                'slug' => 'spanduk-mmt',
                'thumbnail' => 'template/assets/service-banner.jpg',
                'about' => 'Spanduk berbahan MMT 440 gram dengan kualitas printing outdoor terbaik. Tahan cuaca dan UV resistant.',
                'price' => 25000,
                'stock' => 50,
                'category_id' => $banner->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Banner X-Banner',
                'slug' => 'banner-x-banner',
                'thumbnail' => 'template/assets/portfolio-banner.jpg',
                'about' => 'X-Banner portable dengan stand aluminium yang mudah dibawa kemana-mana. Cocok untuk promosi dan display.',
                'price' => 150000,
                'stock' => 25,
                'category_id' => $banner->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Roll Banner Premium',
                'slug' => 'roll-banner-premium',
                'thumbnail' => 'template/assets/service-banner.jpg',
                'about' => 'Roll banner dengan kualitas premium dan stand yang kokoh. Mudah digunakan dan tahan lama.',
                'price' => 200000,
                'stock' => 20,
                'category_id' => $banner->id,
                'is_popular' => false,
                'is_active' => true
            ],

            // UV Printing Products
            [
                'name' => 'UV Printing Akrilik',
                'slug' => 'uv-printing-akrilik',
                'thumbnail' => 'template/assets/service-uv-printing.jpg',
                'about' => 'Printing UV pada material akrilik dengan hasil yang tajam dan tahan lama. Cocok untuk signage dan display premium.',
                'price' => 75000,
                'stock' => 75,
                'category_id' => $uvPrinting->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'UV Printing Kayu',
                'slug' => 'uv-printing-kayu',
                'thumbnail' => 'template/assets/portfolio-uv.jpg',
                'about' => 'Printing UV pada material kayu dengan detail yang sempurna. Memberikan kesan natural dan premium.',
                'price' => 60000,
                'stock' => 100,
                'category_id' => $uvPrinting->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'UV Printing Logam',
                'slug' => 'uv-printing-logam',
                'thumbnail' => 'template/assets/service-uv-printing.jpg',
                'about' => 'Printing UV pada material logam untuk hasil yang tahan lama dan berkualitas industrial grade.',
                'price' => 100000,
                'stock' => 30,
                'category_id' => $uvPrinting->id,
                'is_popular' => false,
                'is_active' => true
            ],

            // Digital Printing Products
            [
                'name' => 'Brosur Digital Printing',
                'slug' => 'brosur-digital-printing',
                'thumbnail' => 'template/assets/portfolio-brochure.jpg',
                'about' => 'Brosur dengan teknologi digital printing berkualitas tinggi. Warna tajam dan detail sempurna.',
                'price' => 3000,
                'stock' => 2000,
                'category_id' => $digitalPrinting->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Flyer Promosi',
                'slug' => 'flyer-promosi',
                'thumbnail' => 'template/assets/service-digital.jpg',
                'about' => 'Flyer promosi dengan kualitas digital printing terbaik. Cocok untuk marketing dan promosi bisnis.',
                'price' => 2000,
                'stock' => 3000,
                'category_id' => $digitalPrinting->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Poster A3',
                'slug' => 'poster-a3',
                'thumbnail' => 'template/assets/portfolio-poster.jpg',
                'about' => 'Poster ukuran A3 dengan kualitas digital printing premium. Cocok untuk display dan promosi.',
                'price' => 12000,
                'stock' => 500,
                'category_id' => $digitalPrinting->id,
                'is_popular' => false,
                'is_active' => true
            ],

            // Cetak Foto Products
            [
                'name' => 'Cetak Foto 4R',
                'slug' => 'cetak-foto-4r',
                'thumbnail' => 'template/assets/service-photo.jpg',
                'about' => 'Cetak foto ukuran 4R dengan kualitas lab photo professional. Hasil tajam dan tahan lama.',
                'price' => 2500,
                'stock' => 1000,
                'category_id' => $cetakFoto->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Canvas Photo Print',
                'slug' => 'canvas-photo-print',
                'thumbnail' => 'template/assets/portfolio-photo.jpg',
                'about' => 'Cetak foto pada canvas untuk hasil yang artistik dan premium. Cocok untuk dekorasi rumah dan kantor.',
                'price' => 85000,
                'stock' => 80,
                'category_id' => $cetakFoto->id,
                'is_popular' => true,
                'is_active' => true
            ],

            // Merchandise Products
            [
                'name' => 'Kaos Custom DTF',
                'slug' => 'kaos-custom-dtf',
                'thumbnail' => 'template/assets/service-merchandise.jpg',
                'about' => 'Kaos custom dengan teknologi DTF printing. Hasil tajam, tahan lama, dan tidak mudah pudar atau retak.',
                'price' => 45000,
                'stock' => 200,
                'category_id' => $merchandise->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Tote Bag Custom',
                'slug' => 'tote-bag-custom',
                'thumbnail' => 'template/assets/portfolio-merchandise.jpg',
                'about' => 'Tote bag dengan sablon custom berkualitas tinggi. Bahan kanvas premium dan hasil sablon yang awet.',
                'price' => 35000,
                'stock' => 150,
                'category_id' => $merchandise->id,
                'is_popular' => true,
                'is_active' => true
            ],

            // Sticker & Vinyl Products
            [
                'name' => 'Stiker Vinyl Cutting',
                'slug' => 'stiker-vinyl-cutting',
                'thumbnail' => 'template/assets/service-sticker.jpg',
                'about' => 'Stiker vinyl cutting dengan presisi tinggi. Tahan air, UV resistant, dan mudah dipasang.',
                'price' => 15000,
                'stock' => 800,
                'category_id' => $sticker->id,
                'is_popular' => true,
                'is_active' => true
            ],
            [
                'name' => 'Stiker Transparan',
                'slug' => 'stiker-transparan',
                'thumbnail' => 'template/assets/portfolio-sticker.jpg',
                'about' => 'Stiker transparan berkualitas tinggi dengan adhesive yang kuat. Cocok untuk branding dan promosi.',
                'price' => 12000,
                'stock' => 600,
                'category_id' => $sticker->id,
                'is_popular' => false,
                'is_active' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
