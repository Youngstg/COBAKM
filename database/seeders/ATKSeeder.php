<?php

namespace Database\Seeders;

use App\Models\ATK;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ATKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            [
                'id' => 1,
                'judul_atk' => 'Upgrading Staff Ahli Kabinet Wangsabatih KM-ITERA',
                'penulis_atk' => 'John Doe',
                'konten_atk' => '<p>Pada Sabtu 27 Mei 2023 KM-ITERA mengadakan kegiatan upgrading bagi Staff Ahli Kabinet Wangsabatih, dalam kegiatan tersebut KM ITERA turut mengundang Marketing Lead Of Gojek Lampung, Audli Natakusuma dan Bara Creative Studio Lampung Sebagai narasumber pengisi acara. Kegiatan Upgrading ini bertujuan untuk memperkuat pengetahuan mengenai peningkatan soft skill dan peningkatan kualitas diri bagi para staff untuk memperkuat peningkatan kinerja para staff ke depannya.</p>
                <p>Dengan adanya kegiatan upgrading ini diharapkan dapat menjadi wawasan baru dan peningkatan kualitas kinerja yang lebih baik bagi Staff Ahli Kabinet Wangsabatih KM ITERA 2023.</p>
                <p>________<br>KM-ITERA<br>Kementrian Koordinator Komunikasi dan Informasi</p>',
                'slug_atk' => 'upgrading-staff-ahli-kabinet-wangsabatih-km-itera',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'gambar_atk' => '1xbliaGFEIU1qYN6NkRqNidfms13PhJq4',
            ],
            [
                'id' => 2,
                'judul_atk' => 'GRAND LAUNCHING: KOMINFO',
                'penulis_atk' => 'Fulan',
                'konten_atk' => '<p>[ GRAND LAUNCHING: KOMINFO ]<br><br>Kemenkoan KOMINFO KM-ITERA Kabinet Wangsabatih yang bertanggung jawab untuk memproduksi konten-konten menarik serta mempublikasikan informasi aktual dan terpercaya<br><br>Menteri Pengembangan Informasi dan Media:<br>Michelle Ayu Nastiti (IF&rsquo;20)<br><br>Staf Ahli Pengembangan Informasi dan Media:<br>Maharani Triza Putri (IF&rsquo;21)<br>Rafli Ardiansah (TI&rsquo;21)<br>Maharani Putri Qohar (BM&rsquo;21)<br>Syafira Wulandari (IF&rsquo;20)<br>Habib Mustofa (TG&rsquo;21)<br>Monica Adella Aisyah R. (IF&rsquo;20)<br>Alfie Syahrin (PWK&rsquo;21)<br><br>Menteri Desain Komunikasi Strategis:<br>Muhammad Jannathias Omali Prawana (TT&rsquo;20)<br><br>Staf Ahli Desain Komunikasi Strategis :<br>Afwa Fuadi Nugraha (SD&rsquo;21)<br>Nofri Ramadanil (SAP&rsquo;21)<br>Muhammad Delfi Mulia Rachman Hasibuan (SI&rsquo;20)<br>Luthfie Adli Wistoro (ARL&rsquo;20)<br>Vina Tri Amanda (SLL&rsquo;21)<br>Dinda Putri Syahran (TI&rsquo;21)<br><br>________<br>KM-ITERA<br>Kementerian Koordinator Komunikasi dan Informasi</p>',
                'slug_atk' => 'grand-launching-kominfo',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'published_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'gambar_atk' => '1xbliaGFEIU1qYN6NkRqNidfms13PhJq4',
            ],
        ];
        ATK::query()->insert($articles);
    }
}
