<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kbt extends Model
{
    use HasFactory;

    protected $table = 'k_b_t';

    protected $fillable = [
        'id',
        'nama_kbt',
        'nama_presma',
        'prodi_presma',
        'logo_kbt',
        'foto_kbt',
        'tahun_kbt',
        'desk_kbt',
        'status_kbt',
        'slug_kbt',
    ];
}
