<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        $user = User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
        ]);

        $user->assignRole('admin');

        $user = User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@example.com',
            'password' => bcrypt('secret'),
        ]);

        $user->assignRole('editor');

        $user = User::factory()->create([
            'name' => 'Test Viewer',
            'email' => 'viewewr@example.com',
            'password' => bcrypt('secret'),
        ]);

        $user->assignRole('viewer');
    }
}
