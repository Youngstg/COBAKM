<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Produk;
use App\Models\TentangKM;
use App\Models\VarianProduk;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DummySeeder::class);
        $this->call(ATKSeeder::class);
        $this->call(TagATKSeeder::class);
        $this->call(BSWSeeder::class);
        $this->call(ATKTagATKSeeder::class);
        Produk::factory()->count(50)->create();
        VarianProduk::factory()->count(1000)->create();
        TentangKM::create([
            'logo_id' => 1,
            'deskripsi' => fake()->paragraph(3),
            'visi' => fake()->paragraph(1),
            'misi' => fake()->paragraph(1),
            'presma' => 'Ahmad Khadi Abdillah',
            'prodi_presma' => 'Teknik Industri',
        ]);

        $this->call(OrmawaSeeder::class);
    }
}
