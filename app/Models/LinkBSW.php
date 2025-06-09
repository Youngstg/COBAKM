<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkBSW extends Model
{
    use HasFactory;

    protected $table = 'link_b_s_w_s';

    protected $fillable = [
        'id',
        'bsw_id',
        'judul_link',
        'link',
    ];

    public function bsw()
    {
        return $this->belongsTo(BSW::class, 'bsw_id', 'id');
    }
}
