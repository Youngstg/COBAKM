<?php

namespace Database\Seeders;

use App\Models\TagATK;
use Illuminate\Database\Seeder;

class TagATKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            [
                'id' => 1,
                'nama_tag' => 'KM ITERA',
                'slug_tag' => 'km-itera',
            ],
            [
                'id' => 2,
                'nama_tag' => 'PMB ITERA',
                'slug_tag' => 'pmb-itera',
            ],
            [
                'id' => 3,
                'nama_tag' => 'Kementerian TI',
                'slug_tag' => 'kementerian-ti',
            ],
        ];
        TagATK::query()->insert($tags);
    }
}
