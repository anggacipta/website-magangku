<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LowonganMagangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'posisi' => 'required|string',
            'deskripsi' => 'required|string',
            'lokasi_id' => 'required|exists:lokasi,id',
            'durasi' => 'required|string',
        ];
    }
}
