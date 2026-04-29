<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDocumentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /** 
     * Get the validation rules that apply to the request. numeric|digits:7
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'productor' => 'required|regex:/^[A-Za-zÀ-ÿ .]+$/',
            'inicio_huerto' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'certificado' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
            'CURP' => 'required|string|min:18|max:18',
            'lada' => 'required|numeric|digits:3',
            'telefono' => 'required|numeric|digits:7',
            /*
            'CURP' => ['nullable','required_if:ine,NULL','string','min:18','max:18','unique:documentos,CURP'],
            'lada' => ['nullable','required_if:correo,""','numeric','digits:3'],
            'telefono' => ['nullable','required_if:correo,""','numeric','digits:7'],
            'ine' => ['nullable','required_if:CURP,""','mimes:jpg,jpeg,png,pdf', 'max:5120'],
            'correo' => ['nullable','required_if:lada,""','string','email:rfc,dns','max:50','unique:documentos,correo'],*/
        ];
        
    }
    /*
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
    */
}
