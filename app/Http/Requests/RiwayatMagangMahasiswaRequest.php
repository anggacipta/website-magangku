<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RiwayatMagangMahasiswaRequest extends FormRequest
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
            'nama_perusahaan' => ['required', 'string', 'max:255'],
            'posisi' => ['required', 'string', 'max:255'],
            'tanggal_mulai' => ['required', 'date_format:m/d/Y'],
            'tanggal_selesai' => ['required', 'date_format:m/d/Y'],
            'deskripsi' => ['required', 'string'],
            'foto_kegiatan' => ['nullable', 'image', 'max:2048', 'mimes:png,jpg,jpeg'],
        ];
    }
}
