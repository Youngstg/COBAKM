<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nama' => 'Test User',
            'id_role' => 888,
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'nama' => 'Test User Ekraf',
            'id_role' => 1111,
            'email' => 'ekraf@example.com',
        ]);

        User::factory()->create([
            'nama' => 'Test User PIM',
            'id_role' => 2222,
            'email' => 'pim@example.com',
        ]);
    }
}
