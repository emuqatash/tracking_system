<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // replace 'password' with your desired password
            'account_id' => 1,
            'email_verified_at' => now(),
            // possibly create and assign more info here...
        ])->assignRole('Admin');
    }
}
