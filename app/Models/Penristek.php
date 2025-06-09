<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
// Slug
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penristek extends Model
{
    use HasFactory;

    // Slug
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'penristek';

    protected $fillable = [
        'judul',
        'tgl_up',
        'slug',
        'gambar',
        'deskripsi',
        'link_penristek',
    ];

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'judul',
            ],
        ];
    }
}
