<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrmawaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'nama_ormawa' => 'sometimes|required|string|max:255',
            'logo_ormawa' => 'sometimes|required|string|max:255',
            'nama_ketua' => 'sometimes|required|string|max:255',
            'deskripsi' => 'sometimes|required|string',
            'hmps' => 'sometimes|required|boolean',
            'ukm' => 'sometimes|required|boolean',
        ];
    }
}
