<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dummy extends Model
{
    use HasFactory;

    protected $table = 'dummy';

    protected $fillable = [
        'nama_dummy',
        'link_dummy',
        'foto_dummy',
    ];
}
