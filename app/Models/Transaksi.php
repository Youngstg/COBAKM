<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_wa',
        'email',
        'total_harga',
        'status_barang',
        'nama_penerima',
        'no_wa_penerima',
        'bukti_penerimaan',
        'uuid',
    ];

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The "type" of the primary key ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The boot method of the model.
     *
     * @return void
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    public function daftar_produk(): HasMany
    {
        return $this->hasMany(ItemTransaksi::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }
}
