<?php

namespace Database\Seeders;

use App\Models\BSW;
use App\Models\LinkBSW;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BSWSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $bsw = [
            [
                'judul_bsw' => 'Beasiswa Fulbright untuk Studi di Amerika',
                'slug_bsw' => 'Beasiswa-Fulbright-ntuk-Studi-di-Amerika',
                'gambar_bsw' => '1X7fnFkV3rVCn-Ol32qqqGASIQd4xi1jT',
                'konten_bsw' => '<p>Beasiswa Fulbright adalah program beasiswa internasional yang diselenggarakan oleh pemerintah Amerika Serikat. Program ini menyediakan kesempatan bagi siswa, sarjana, dan profesional Indonesia untuk menempuh studi atau penelitian di perguruan tinggi terkemuka di Amerika Serikat. Beasiswa ini bertujuan untuk memperkuat hubungan budaya dan akademik antara Indonesia dan Amerika Serikat serta memberikan kesempatan kepada para penerima untuk mengembangkan diri dan berkontribusi pada masyarakat Indonesia setelah kembali dari Amerika Serikat.</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'judul_bsw' => 'Beasiswa Chevening untuk Studi di Inggris',
                'slug_bsw' => 'Beasiswa-Chevening-untuk-Studi-di-Inggris',
                'gambar_bsw' => '1X7fnFkV3rVCn-Ol32qqqGASIQd4xi1jT',
                'konten_bsw' => '<p>Beasiswa Chevening adalah program beasiswa pemerintah Inggris yang memberikan kesempatan kepada para pemimpin masa depan dari berbagai negara, termasuk Indonesia, untuk menempuh studi lanjutan di universitas-universitas terkemuka di Inggris. Beasiswa ini mencakup seluruh biaya kuliah, tunjangan hidup, dan beberapa manfaat lainnya. Melalui program ini, para penerima beasiswa Chevening dapat mengakses pendidikan berkualitas tinggi, memperluas jaringan internasional, dan mendapatkan pengalaman belajar yang berharga untuk diaplikasikan dalam pekerjaan dan kontribusi mereka di Indonesia setelah kembali.</p>',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        BSW::query()->insert($bsw);

        $link_bsw = [
            [
                'bsw_id' => '1',
                'judul_link' => 'link beasiswa 1',
                'link' => 'https://www.google.com/',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'bsw_id' => '2',
                'judul_link' => 'link beasiswa 2',
                'link' => 'https://www.google.com/',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        linkBSW::query()->insert($link_bsw);
    }
}
