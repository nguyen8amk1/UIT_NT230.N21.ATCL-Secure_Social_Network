<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Call the RoleSeeder to seed roles
        $this->call(RoleSeeder::class);

        // Create a user with specified attributes
        User::factory()->create([
            'email' => 'admin@gmail.com', // User's email
            'email_verified_at' => null, // Email verification date (null for now)
            'role_id' => 2, // User's role ID
        ]);
    }
}
