<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CopyUpdateDocumentoRequest extends FormRequest
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
        // Si el campo 'ine' no es nulo, entonces 'CURP' e 'ine' deben ser nullable
        $rules = [
            'productor' => 'required|max:100|regex:/^[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+(?:\s+[a-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+){1,5}(?:\s+[-\sa-zA-ZáéíóúÁÉÍÓÚüÜñÑ]+)?$/',
            'inicio_huerto' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'certificado' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'correo' => ['nullable', 'required_if:lada,""', 'string', 'email:rfc,dns', 'max:50', 'unique:documentos,correo,'.$this->documento->id.',id'],
            'lada' => ['nullable', 'required_if:correo,""', 'numeric', 'digits:3'],
            'telefono' => ['nullable', 'required_if:correo,""', 'numeric', 'digits:7'],
            'observaciones' => 'nullable|string|max:250',
        ];

        // Si 'ine' es no nulo, tanto 'ine' como 'CURP' pueden ser nullable
        if ($this->documento->ine !== null) {
            $rules['ine'] = ['nullable', 'mimes:jpg,jpeg,png,pdf', 'max:5120'];
            $rules['CURP'] = ['nullable', 'string', 'min:18', 'max:18', 'unique:documentos,CURP,'.$this->documento->id.',id'];
        } else {
            // Si 'ine' es nulo, entonces 'CURP' se vuelve obligatorio, y 'ine' también se vuelve obligatorio
            $rules['ine'] = ['nullable', 'required_if:CURP,""', 'mimes:jpg,jpeg,png,pdf', 'max:5120'];
            $rules['CURP'] = ['nullable', 'required_if:ine,NULL', 'string', 'min:18', 'max:18', 'unique:documentos,CURP,'.$this->documento->id.',id'];
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'ine.required_if' => 'El campo INE es obligatorio.',
            'CURP.required_if' => 'El campo CURP es obligatorio.',
            'correo.required_if' => 'El campo correo es obligatorio.',
            'lada.required_if' => 'El campo lada es obligatorio.',
            'telefono.required_if' => 'El campo telefono es obligatorio.',
        ];
    }
}
