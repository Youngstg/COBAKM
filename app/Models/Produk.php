<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
    ];

    public function varianProduk()
    {
        return $this->hasMany(VarianProduk::class);
    }

    public function photos()
    {
        return $this->hasMany(Photos::class);
    }
}
