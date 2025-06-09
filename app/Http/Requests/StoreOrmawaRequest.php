<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrmawaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_ormawa' => 'required|string|max:255',
            'logo_ormawa' => 'required|string|max:255',
            'nama_ketua' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'hmps' => 'required|boolean',
            'ukm' => 'required|boolean',
        ];
    }
}
