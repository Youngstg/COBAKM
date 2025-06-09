<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail',
        'judul',
        'deskripsi',
        'kategori',
        'narasumber',
        'pewawancara',
        'link',
        'features_podcast',
        'top_podcast',
        'order',
    ];

    protected $casts = [
        'features' => 'boolean',
        'top' => 'boolean',
    ];
}
