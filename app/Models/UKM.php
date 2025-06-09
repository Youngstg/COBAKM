<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UKM extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ketua',
        'website',
        'details',
        'image',
        'dies_natalis',
        'linkedin',
        'instagram',
        'youtube',
        'order',
    ];

    public function getTypeAttribute()
    {
        return 'UKM';
    }
}
