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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@logistics.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        // Driver User
        User::create([
            'name' => 'John Driver',
            'email' => 'driver@example.com',
            'password' => bcrypt('driver123'),
            'role' => 'driver',
            'status' => 'active',
            'phone' => '555-0101',
            'company' => 'Fast Trucking LLC',
            'mc_number' => 'MC123456',
        ]);

        // Customer User
        User::create([
            'name' => 'Jane Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('customer123'),
            'role' => 'customer',
            'status' => 'active',
            'phone' => '555-0202',
            'company' => 'Retail Goods Inc.',
        ]);
    }
}
