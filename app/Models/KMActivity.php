<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KMActivity extends Model
{
    use HasFactory;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $fillable = [
        'title_kmac',
        'ketuplak_kmac',
        'gambar_kmac',
        'slug_kmac',
        'konten_kmac',
        'deskripsi_kmac',
        'tgl_pelaksanaan',
        'features_kmac',
    ];

    protected $casts = [
        'tgl_pelaksanaan' => 'datetime',
    ];

    public function tags()
    {
        return $this->belongsToMany(TagATK::class, 'activity_tag', 'activity_id', 'tag_id');
    }

    public function sluggable(): array
    {
        return [
            'slug_kmac' => [
                'source' => 'title_kmac',
            ],
        ];
    }
}
