<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AngkatanUpdateRequest extends FormRequest
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
            'tahun_angkatan' => 'required|string',
        ];
    }
}
