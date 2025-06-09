<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 888,
                'nama_role' => 'SuperAdmin',
            ],
            [
                'id' => 999,
                'nama_role' => 'OP',
            ],
            [
                'id' => 1000,
                'nama_role' => 'Penristek',
            ],
            [
                'id' => 1111,
                'nama_role' => 'Ekraf',
            ],
            [
                'id' => 2222,
                'nama_role' => 'PIM',
            ],
        ];
        Role::query()->insert($roles);
    }
}
