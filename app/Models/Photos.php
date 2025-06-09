<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;

    protected $fillable = [
        'url_photo',
        'produk_id',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
