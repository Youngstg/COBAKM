<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ali extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'alis';

    protected $fillable = [
        'nama_ali',
        'jabatan_ali',
        'kp_ali',
        'pkj_ali',
        'thn_ali',
        'prodi_ali',
        'foto_ali',
    ];
}
