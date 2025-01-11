<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AngkatanRequest extends FormRequest
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
            'tahun_angkatan' => 'required|unique:angkatans,tahun_angkatan',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'tahun_angkatan.required' => 'Tahun angkatan harus diisi',
            'tahun_angkatan.unique' => 'Tahun angkatan sudah ada',
        ];
    }
}
