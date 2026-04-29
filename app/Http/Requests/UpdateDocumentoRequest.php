<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'productor' => 'required|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+(?:\s+[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+){1,5}(?:\s+[-\sa-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+)?$/',
            'inicio_huerto' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'certificado' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'CURP' => 'required|string|min:18|max:18',
            'lada' => 'required|numeric|digits:3',
            'telefono' => 'required|numeric|digits:7',
            'observaciones' => 'nullable|string|max:250',
        ];
    }
}
