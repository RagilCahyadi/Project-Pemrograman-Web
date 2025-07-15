<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shipping;

class ShippingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippings = [
            [
                'courier' => 'Ambil di Tempat',
                'shipping_cost' => 0,
                'estimated_delivery' => '0 hari'
            ],
            [
                'courier' => 'Delivery Surabaya',
                'shipping_cost' => 15000,
                'estimated_delivery' => '1-2 hari'
            ],
            [
                'courier' => 'JNE Regular',
                'shipping_cost' => 12000,
                'estimated_delivery' => '2-3 hari'
            ],
            [
                'courier' => 'JNE YES',
                'shipping_cost' => 25000,
                'estimated_delivery' => '1-2 hari'
            ],
            [
                'courier' => 'J&T Express',
                'shipping_cost' => 10000,
                'estimated_delivery' => '2-4 hari'
            ],
            [
                'courier' => 'Pos Indonesia',
                'shipping_cost' => 8000,
                'estimated_delivery' => '3-5 hari'
            ],
            [
                'courier' => 'Sicepat',
                'shipping_cost' => 11000,
                'estimated_delivery' => '2-3 hari'
            ],
            [
                'courier' => 'AnterAja',
                'shipping_cost' => 13000,
                'estimated_delivery' => '2-4 hari'
            ],
            [
                'courier' => 'Delivery Luar Kota',
                'shipping_cost' => 50000,
                'estimated_delivery' => '3-5 hari'
            ],
            [
                'courier' => 'Express Delivery',
                'shipping_cost' => 75000,
                'estimated_delivery' => 'Same Day'
            ]
        ];

        foreach ($shippings as $shipping) {
            Shipping::create($shipping);
        }
    }
}
