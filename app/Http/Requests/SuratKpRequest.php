<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SuratKpRequest extends FormRequest
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
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date',
            'nama_perusahaan' => 'required|string',
            'alamat_perusahaan' => 'required|string',
            'mahasiswa' => 'required|array',
            'mahasiswa.*.nama' => 'required|string',
            'status_surat' => 'nullable|numeric',
        ];
    }
}
