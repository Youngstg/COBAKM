<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OP extends Model
{
    use HasFactory;

    protected $table = 'o_p_s';

    protected $fillable = [
        'nama_op',
        'kategori_op',
        'catatan_op',
        'gambar_op',
    ];
}
