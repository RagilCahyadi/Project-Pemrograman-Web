<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PromoCode;

class PromoCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promoCodes = [
            [
                'code' => 'WELCOME20',
                'discount_amount' => 20000,
                'is_active' => true
            ],
            [
                'code' => 'NEWCUSTOMER',
                'discount_amount' => 15000,
                'is_active' => true
            ],
            [
                'code' => 'BULK50',
                'discount_amount' => 50000,
                'is_active' => true
            ],
            [
                'code' => 'WEDDING10',
                'discount_amount' => 25000,
                'is_active' => true
            ],
            [
                'code' => 'RAMADAN2025',
                'discount_amount' => 30000,
                'is_active' => true
            ],
            [
                'code' => 'LEBARAN50',
                'discount_amount' => 75000,
                'is_active' => true
            ],
            [
                'code' => 'STUDENT15',
                'discount_amount' => 10000,
                'is_active' => true
            ],
            [
                'code' => 'EXPIRED10',
                'discount_amount' => 5000,
                'is_active' => false
            ]
        ];

        foreach ($promoCodes as $promoCode) {
            PromoCode::create($promoCode);
        }
    }
}
