<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ormawa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'ketua', 'website', 'details', 'dies_natalis', 'linkedin', 'instagram', 'youtube', 'image',
        'order', 'hmps', 'ukm',
    ];
}
