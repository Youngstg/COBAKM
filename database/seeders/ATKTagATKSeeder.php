<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ATKTagATKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pivot = [
            [
                'a_t_k_id' => 1,
                'tag_a_t_k_id' => 1,
            ],
            [
                'a_t_k_id' => 1,
                'tag_a_t_k_id' => 2,
            ],
            [
                'a_t_k_id' => 2,
                'tag_a_t_k_id' => 1,
            ],
            [
                'a_t_k_id' => 2,
                'tag_a_t_k_id' => 3,
            ],

        ];
        DB::table('a_t_k_tag_a_t_k')->insert($pivot);
    }
}
