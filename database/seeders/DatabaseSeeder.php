<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userRole' => 'admin',
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        User::factory()->create([
            'name' => 'Manager',
            'email' => "manager@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userRole' => 'manager',
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        User::factory()->create([
            'name' => 'Cashier',
            'email' => "cashier@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userRole' => 'cashier',
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        User::factory()->create([
            'name' => 'Staff',
            'email' => "staff@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userRole' => 'staff',
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        User::factory()->create([
            'name' => 'Customer',
            'email' => "customer@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'userRole' => 'customer',
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        $this->call([
            CategoryModelSeeder::class,
            MenuModelSeeder::class,
            TableModelSeeder::class,
        ]);

        
    }
}
