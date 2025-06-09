<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
// Slug
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagATK extends Model
{
    use HasFactory;

    // Slug
    use Sluggable;
    use SluggableScopeHelpers;

    protected $table = 'tag_a_t_k_s';

    protected $fillable = [
        'id',
        'nama_tag',
        'slug_tag',
    ];

    public function atk()
    {
        return $this->belongsToMany(ATK::class);
    }

    public function activities()
    {
        return $this->belongsToMany(KMActivity::class, 'activity_tag', 'tag_id', 'activity_id');
    }

    /**
     * Return the sluggable configuration array for this model.
     */
    public function sluggable(): array
    {
        return [
            'slug_tag' => [
                'source' => 'nama_tag',
                'onUpdate' => true,
            ],
        ];
    }
}
