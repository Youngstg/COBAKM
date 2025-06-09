<?php

namespace Database\Seeders;

use App\Models\Ormawa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrmawaSeeder extends Seeder
{
    public function run()
    {
        Ormawa::create([
            'name' => 'Example HMPS',
            'slug' => Str::slug('Example HMPS'),
            'ketua' => 'Ketua HMPS',
            'website' => 'http://example.com',
            'details' => 'Details about Example HMPS',
            'dies_natalis' => '01 January 2024',
            'linkedin' => 'https://linkedin.com/example',
            'instagram' => 'https://instagram.com/example',
            'youtube' => 'https://youtube.com/example',
            'order' => 1,
            'hmps' => true,
            'ukm' => false,
        ]);

        Ormawa::create([
            'name' => 'Example UKM',
            'slug' => Str::slug('Example UKM'),
            'ketua' => 'Ketua UKM',
            'website' => 'http://example.com',
            'details' => 'Details about Example UKM',
            'dies_natalis' => '01 February 2024',
            'linkedin' => 'https://linkedin.com/example',
            'instagram' => 'https://instagram.com/example',
            'youtube' => 'https://youtube.com/example',
            'order' => 2,
            'hmps' => false,
            'ukm' => true,
        ]);
    }
}
