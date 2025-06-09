<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
// Slug
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BSW extends Model
{
    use HasFactory;

    // Slug
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'b_s_w_s';

    protected $fillable = [
        'id',
        'judul_bsw',
        'slug_bsw',
        'gambar_bsw',
        'konten_bsw',
    ];

    public function bsw()
    {
        return $this->hasMany(LinkBSW::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug_bsw' => [
                'source' => 'judul_bsw',
            ],
        ];
    }
}
