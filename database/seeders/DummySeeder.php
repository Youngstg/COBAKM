<?php

namespace Database\Seeders;

use App\Models\Dummy;
use Illuminate\Database\Seeder;

class DummySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dummy::query()->insert(
            [
                [
                    'id' => 1,
                    'nama_dummy' => 'Logo KM',
                    'link_dummy' => 'https://drive.google.com/file/d/10kZRTPyNSfjxOWZxnKJWOAVVgzezW5j-/view?usp=sharing',
                    'foto_dummy' => '10kZRTPyNSfjxOWZxnKJWOAVVgzezW5j-',
                ],
                [
                    'id' => 2,
                    'nama_dummy' => 'Banding UKT',
                    'link_dummy' => 'https://google.com',
                    'foto_dummy' => '1fCmMlNFnTz-Rvq0wnmOzWjDPoLUOu4JL',
                ],
                [
                    'id' => 3,
                    'nama_dummy' => 'PIK-R',
                    'link_dummy' => 'https://google.com',
                    'foto_dummy' => '1fCmMlNFnTz-Rvq0wnmOzWjDPoLUOu4JL',
                ],
                [
                    'id' => 4,
                    'nama_dummy' => 'Sukma KM',
                    'link_dummy' => 'https://google.com',
                    'foto_dummy' => '1fCmMlNFnTz-Rvq0wnmOzWjDPoLUOu4JL',
                ],
                [
                    'id' => 5,
                    'nama_dummy' => 'Alumni Sheet',
                    'link_dummy' => 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTA9O2MDsEnun-pdXnAQ8eIvyHOeDYVrgk85AIvdFLmCu9H5qXg_pcjBrcbc27umARpd4P1dRnHJewR/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false',
                    'foto_dummy' => '1fCmMlNFnTz-Rvq0wnmOzWjDPoLUOu4JL',
                ],
                [
                    'id' => 6,
                    'nama_dummy' => 'Link Peminjaman Operasional',
                    'link_dummy' => 'https://link',
                    'foto_dummy' => '1fCmMlNFnTz-Rvq0wnmOzWjDPoLUOu4JL',
                ],
                [
                    'id' => 7,
                    'nama_dummy' => 'Link Pengembalian Operasional',
                    'link_dummy' => 'https://link',
                    'foto_dummy' => '1fCmMlNFnTz-Rvq0wnmOzWjDPoLUOu4JL',
                ],
            ]
        );
    }
}
