<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VarianProduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'stok',
        'harga',
        'produk_id',
        'url_foto',
        'nama_varian',
        'ukuran',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
