<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'alamat_sekre',
        'no_cp',
        'email',
        'sosmed',
        'hak_cipta',
    ];

    protected $casts = [
        'no_cp' => 'array',
        'sosmed' => 'array',
    ];
}
