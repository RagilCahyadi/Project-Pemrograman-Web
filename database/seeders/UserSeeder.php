<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin RNR Digital Printing',
                'email' => 'admin@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Manager RNR',
                'email' => 'manager@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('manager123'),
                'role' => 'manager',
            ],
            [
                'name' => 'Staff Produksi',
                'email' => 'produksi@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('produksi123'),
                'role' => 'staff',
            ],
            [
                'name' => 'Staff Marketing',
                'email' => 'marketing@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('marketing123'),
                'role' => 'staff',
            ],
            [
                'name' => 'Customer Service',
                'email' => 'cs@rnrdigitalprinting.com',
                'email_verified_at' => now(),
                'password' => Hash::make('cs123'),
                'role' => 'staff',
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
