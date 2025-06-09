<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TentangKM extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo_id',
        'deskripsi',
        'visi',
        'misi',
        'presma',
        'prodi_presma',
    ];
}
