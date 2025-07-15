<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@gmail.com',
                'phone' => '081234567890',
                'address' => 'Jl. Merdeka No. 123',
                'city' => 'Surabaya',
                'post_code' => '60119'
            ],
            [
                'name' => 'Siti Aminah',
                'email' => 'siti.aminah@yahoo.com',
                'phone' => '082345678901',
                'address' => 'Jl. Sudirman No. 456',
                'city' => 'Surabaya',
                'post_code' => '60271'
            ],
            [
                'name' => 'Ahmad Fauzi',
                'email' => 'ahmad.fauzi@hotmail.com',
                'phone' => '083456789012',
                'address' => 'Jl. Gatot Subroto No. 789',
                'city' => 'Sidoarjo',
                'post_code' => '61215'
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'phone' => '084567890123',
                'address' => 'Jl. Diponegoro No. 321',
                'city' => 'Malang',
                'post_code' => '65112'
            ],
            [
                'name' => 'Rizki Pratama',
                'email' => 'rizki.pratama@gmail.com',
                'phone' => '085678901234',
                'address' => 'Jl. Ahmad Yani No. 654',
                'city' => 'Surabaya',
                'post_code' => '60234'
            ],
            [
                'name' => 'Maya Sari',
                'email' => 'maya.sari@yahoo.com',
                'phone' => '086789012345',
                'address' => 'Jl. Pahlawan No. 987',
                'city' => 'Gresik',
                'post_code' => '61111'
            ],
            [
                'name' => 'Hendra Gunawan',
                'email' => 'hendra.gunawan@gmail.com',
                'phone' => '087890123456',
                'address' => 'Jl. Kartini No. 147',
                'city' => 'Surabaya',
                'post_code' => '60286'
            ],
            [
                'name' => 'Lina Marlina',
                'email' => 'lina.marlina@hotmail.com',
                'phone' => '088901234567',
                'address' => 'Jl. Cut Nyak Dien No. 258',
                'city' => 'Mojokerto',
                'post_code' => '61321'
            ],
            [
                'name' => 'Tono Susanto',
                'email' => 'tono.susanto@gmail.com',
                'phone' => '089012345678',
                'address' => 'Jl. RA Kartini No. 369',
                'city' => 'Surabaya',
                'post_code' => '60157'
            ],
            [
                'name' => 'Indira Sari',
                'email' => 'indira.sari@yahoo.com',
                'phone' => '081123456789',
                'address' => 'Jl. Veteran No. 741',
                'city' => 'Pasuruan',
                'post_code' => '67116'
            ],
            [
                'name' => 'CV. Maju Jaya',
                'email' => 'info@majujaya.co.id',
                'phone' => '082234567890',
                'address' => 'Jl. Raya Industri No. 15',
                'city' => 'Surabaya',
                'post_code' => '60188'
            ],
            [
                'name' => 'PT. Sukses Mandiri',
                'email' => 'marketing@suksesmandiri.com',
                'phone' => '083345678901',
                'address' => 'Jl. Jenderal Sudirman No. 88',
                'city' => 'Surabaya',
                'post_code' => '60271'
            ],
            [
                'name' => 'UMKM Berkah',
                'email' => 'umkmberkah@gmail.com',
                'phone' => '084456789012',
                'address' => 'Jl. Masjid No. 12',
                'city' => 'Sidoarjo',
                'post_code' => '61234'
            ],
            [
                'name' => 'Koperasi Sejahtera',
                'email' => 'kopersejahtera@yahoo.com',
                'phone' => '085567890123',
                'address' => 'Jl. Koperasi No. 45',
                'city' => 'Malang',
                'post_code' => '65145'
            ],
            [
                'name' => 'Sekolah Harapan Bangsa',
                'email' => 'admin@harapanbangsa.sch.id',
                'phone' => '086678901234',
                'address' => 'Jl. Pendidikan No. 67',
                'city' => 'Surabaya',
                'post_code' => '60112'
            ]
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
