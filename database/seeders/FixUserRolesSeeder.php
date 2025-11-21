<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FixUserRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update existing users that might have role_id column data
        // Check if any user exists
        $users = DB::table('users')->get();

        echo "Found " . $users->count() . " users in database\n";

        foreach ($users as $user) {
            echo "User: {$user->email} | Current role: " . ($user->role ?? 'NULL') . "\n";
        }

        // Create admin if not exists
        $adminExists = DB::table('users')->where('email', 'admin@coffeeshop.com')->exists();

        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Admin',
                'email' => 'admin@coffeeshop.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            echo "✅ Admin user created: admin@coffeeshop.com / admin123\n";
        } else {
            // Update existing admin to ensure role is correct
            DB::table('users')
                ->where('email', 'admin@coffeeshop.com')
                ->update(['role' => 'admin']);
            echo "✅ Admin user updated\n";
        }

        // Update any existing users without proper role
        DB::table('users')
            ->whereNull('role')
            ->orWhere('role', '')
            ->update(['role' => 'member']);

        echo "✅ All users updated with proper roles\n";
    }
}
