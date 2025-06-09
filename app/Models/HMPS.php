<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HMPS extends Model
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

    // Add a type attribute to differentiate between UKM and HMPS
    public function getTypeAttribute()
    {
        return 'HMPS';
    }
}
