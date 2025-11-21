<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if not exists
        User::firstOrCreate(
            ['email' => 'admin@coffeeshop.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        // Create member user for testing if not exists
        User::firstOrCreate(
            ['email' => 'member@coffeeshop.com'],
            [
                'name' => 'Member Test',
                'password' => Hash::make('member123'),
                'role' => 'member',
            ]
        );

        echo "✅ Admin user created: admin@coffeeshop.com / admin123\n";
        echo "✅ Member user created: member@coffeeshop.com / member123\n";
    }
}
