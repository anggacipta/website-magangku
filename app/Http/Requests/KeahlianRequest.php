<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeahlianRequest extends FormRequest
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
            'nama_keahlian' => 'required|unique:keahlians,nama_keahlian',
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
            'nama_keahlian.required' => 'Nama keahlian harus diisi',
            'nama_keahlian.unique' => 'Nama keahlian sudah ada',
        ];
    }
}
