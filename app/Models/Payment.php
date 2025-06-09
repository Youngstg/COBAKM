<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_harga',
        'transaksi_id',
        'metode_pembayaran',
        'status_pembayaran',
        'redirect_url',
        'token',
    ];
}
