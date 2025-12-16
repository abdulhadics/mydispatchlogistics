<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Admin User
        User::updateOrCreate(
            ['email' => 'fa23bcshadi@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('12345678'),
                'role' => 'admin',
                'status' => 'active',
                'email_verified_at' => null,
            ]
        );

        // Driver User
        User::updateOrCreate(
            ['email' => 'driver@example.com'],
            [
                'name' => 'John Driver',
                'password' => bcrypt('driver123'),
                'role' => 'driver',
                'status' => 'active',
                'phone' => '555-0101',
                'company' => 'Fast Trucking LLC',
                'mc_number' => 'MC123456',
                'email_verified_at' => null,
            ]
        );

        // Customer User
        User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Jane Customer',
                'password' => bcrypt('customer123'),
                'role' => 'customer',
                'status' => 'active',
                'phone' => '555-0202',
                'company' => 'Retail Goods Inc.',
                'email_verified_at' => null,
            ]
        );
    }
}
