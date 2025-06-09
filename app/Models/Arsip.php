<?php

namespace App\Models;

// Slug
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;

    protected $table = 'arp';

    protected $guarded = ['id'];

    protected $fillable = [
        'id_sai',
        'judul_arp',
        'link_arp',
        'tgl_arp',
        'publisher_arp',
    ];

    public function saidata()
    {
        return $this->belongsTo(SaiData::class, 'id_sai', 'id');
    }
}
