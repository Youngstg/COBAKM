<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama' => $this->nama,
            'no_wa' => $this->no_wa,
            'total_harga' => $this->total_harga,
            'status_barang' => $this->status_barang,
            'nama_penerima' => $this->nama_penerima,
            'no_wa_penerima' => $this->no_wa_penerima,
            'bukti_penerima' => $this->bukti_penerima,
            'payment' => new PaymentResource($this->payment),
            'created_at' => $this->created_at,

        ];
    }
}
