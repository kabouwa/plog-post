<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a specific row
        User::factory()->create([
            'username' => 'kabouwa',
            'password' => Hash::make('password'),
            'name' => 'Mohammed Kabouwa',
            'email' => 'kabouwa@admin.com',
            'bio' => "Hello to my profile, I'm from morocco, web devloper ",
            'is_admin' => true,
            
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        // to use factory must have a definition is their seeder
        User::factory(50)->create(); 
    }
}
