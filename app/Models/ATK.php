<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
// Slug
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ATK extends Model
{
    use HasFactory;

    // Slug
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'a_t_k_s';

    protected $fillable = [
        'judul_atk',
        'penulis_atk',
        'gambar_atk',
        'kategori_atk',
        'konten_atk',
        'slug_atk',
        'features_atk',
        'published_at',
    ];

    public function tagatk()
    {
        return $this->belongsToMany(TagATK::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug_atk' => [
                'source' => 'judul_atk',
            ],
        ];
    }
}
