<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@fuelmonitoring.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'phone' => '08123456789',
            'employee_id' => 'ADM001',
        ]);

        // Create sample drivers
        User::create([
            'name' => 'Sopir 1',
            'email' => 'sopir1@fuelmonitoring.com',
            'password' => bcrypt('password'),
            'role' => 'driver',
            'phone' => '08111111111',
            'employee_id' => 'DRV001',
        ]);

        User::create([
            'name' => 'Sopir 2',
            'email' => 'sopir2@fuelmonitoring.com',
            'password' => bcrypt('password'),
            'role' => 'driver',
            'phone' => '08222222222',
            'employee_id' => 'DRV002',
        ]);
    }
}
