<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VarianProduk>
 */
class VarianProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'stok' => $this->faker->numberBetween(0, 100), // Menghasilkan stok acak antara 0 hingga 100
            'harga' => $this->faker->numberBetween(10000, 100000), // Menghasilkan harga acak antara 10.000 hingga 100.000
            'produk_id' => Produk::inRandomOrder()->first()->id, // Menghasilkan Produk secara otomatis atau menggunakan yang sudah ada
            'nama_varian' => $this->faker->words(3, true),
            'ukuran' => $this->faker->randomLetter,
        ];
    }
}
