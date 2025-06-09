<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
// Slug
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaiData extends Model
{
    use HasFactory;

    // Slug
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'sai';

    protected $guarded = ['id'];

    protected $fillable = [
        'judul_sai',
        'logo_sai',
        'sub_judul_sai',
        'desk_sub_judul_sai',
        'slug_sub_sai',
    ];

    public function arsip()
    {
        return $this->hasMany(Arsip::class);
    }

    public function sluggable(): array
    {
        return [
            'slug_sub_sai' => [
                'source' => 'sub_judul_sai',
            ],
        ];
    }
}
